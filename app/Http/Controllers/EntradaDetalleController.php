<?php

namespace App\Http\Controllers;

use App\Models\Entrada;
use App\Models\EntradaDetalle;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;

class EntradaDetalleController extends Controller
{
    /**
     * Display a listing of the resource for a given Entrada.
     */
    public function index(Request $request, Entrada $entrada)
    {
        // Build base query for the detalles belonging to this entrada
        $base = \App\Models\EntradaDetalle::query()->where('id_entrada', $entrada->id);

        // eager load relations used in the view
        $base->with(['ecmDetequcom', 'ecmDetmob', 'espacioTrabajo']);

        // search across no_serie, related espacio nombre, ECM serial and ECM codigo
        if ($q = $request->input('q')) {
            $base->where(function ($sub) use ($q) {
                $sub->where('no_serie', 'like', "%{$q}%")
                    ->orWhereHas('espacioTrabajo', function ($s) use ($q) {
                        $s->where('nombre_espacio', 'like', "%{$q}%");
                    })
                    ->orWhereHas('ecmDetequcom', function ($s) use ($q) {
                        $s->where('serial', 'like', "%{$q}%");
                    })
                    ->orWhereHas('ecmDetmob', function ($s) use ($q) {
                        $s->where('codigo', 'like', "%{$q}%");
                    });
            });
        }

        // sorting
        $allowed = ['id', 'no_serie', 'created_at', 'espacio'];
        $sort = $request->input('sort', 'id');
        $dir = strtolower($request->input('dir', 'desc')) === 'asc' ? 'asc' : 'desc';

        if (! in_array($sort, $allowed)) {
            $sort = 'id';
        }

        if ($sort === 'espacio') {
            // sort by espacios_trabajo.nombre_espacio using a left join
            $base = \App\Models\EntradaDetalle::select('entradasdetalle.*')
                ->where('id_entrada', $entrada->id)
                ->leftJoin('espacios_trabajo', 'entradasdetalle.id_espaciotrabajo', '=', 'espacios_trabajo.id_espacio')
                ->orderBy('espacios_trabajo.nombre_espacio', $dir)
                ->with(['ecmDetequcom', 'ecmDetmob', 'espacioTrabajo']);

            if ($q) {
                // replicate search when joined
                $base->where(function ($sub) use ($q) {
                    $sub->where('no_serie', 'like', "%{$q}%")
                        ->orWhere('espacios_trabajo.nombre_espacio', 'like', "%{$q}%")
                        ->orWhereExists(function ($query) use ($q) {
                            $query->select(DB::raw(1))
                                ->from('ecm_detequcom')
                                ->whereColumn('ecm_detequcom.id', 'entradasdetalle.id_ecm_dete')
                                ->where('ecm_detequcom.serial', 'like', "%{$q}%");
                        })
                        ->orWhereExists(function ($query) use ($q) {
                            $query->select(DB::raw(1))
                                ->from('ecm_detmob')
                                ->whereColumn('ecm_detmob.id', 'entradasdetalle.id_ecm_detm')
                                ->where('ecm_detmob.codigo', 'like', "%{$q}%");
                        });
                });
            }
        } else {
            $base->orderBy('entradasdetalle.' . $sort, $dir);
        }

        $detalles = $base->paginate(10)->withQueryString();

        return view('entradasdet.index', compact('entrada', 'detalles', 'sort', 'dir'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Entrada $entrada)
    {
        return view('entradasdet.create', compact('entrada'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Entrada $entrada): RedirectResponse
    {
        $data = $request->validate([
            'id_ecm_dete' => ['nullable', 'exists:ecm_detequcom,id'],
            'id_ecm_detm' => ['nullable', 'exists:ecm_detmob,id'],
            'no_serie' => ['required', 'string', 'max:100'],
            'id_espaciotrabajo' => ['required', 'exists:espacios_trabajo,id_espacio'],
        ]);

        // Create via relationship so id_entrada is set automatically
        $entrada->detalles()->create($data);

        return redirect()->route('entradas.detalle.index', $entrada)->with('success', 'Detalle agregado.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Entrada $entrada, EntradaDetalle $detalle)
    {
        if ($detalle->id_entrada != $entrada->id) {
            abort(404);
        }

        return view('entradasdet.show', compact('entrada', 'detalle'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Entrada $entrada, EntradaDetalle $detalle)
    {
        if ($detalle->id_entrada != $entrada->id) {
            abort(404);
        }

        return view('entradasdet.edit', compact('entrada', 'detalle'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Entrada $entrada, EntradaDetalle $detalle): RedirectResponse
    {
        if ($detalle->id_entrada != $entrada->id) {
            abort(404);
        }

        $data = $request->validate([
            'id_ecm_dete' => ['nullable', 'exists:ecm_detequcom,id'],
            'id_ecm_detm' => ['nullable', 'exists:ecm_detmob,id'],
            'no_serie' => ['required', 'string', 'max:100'],
            'id_espaciotrabajo' => ['required', 'exists:espacios_trabajo,id_espacio'],
        ]);

        $detalle->update($data);

        return redirect()->route('entradas.detalle.index', $entrada)->with('success', 'Detalle actualizado.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Entrada $entrada, EntradaDetalle $detalle): RedirectResponse
    {
        if ($detalle->id_entrada != $entrada->id) {
            abort(404);
        }

        $detalle->delete();

        return redirect()->route('entradas.detalle.index', $entrada)->with('success', 'Detalle eliminado.');
    }
}
