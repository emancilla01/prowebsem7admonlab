<?php

namespace App\Http\Controllers;

use App\Models\Salida;
use App\Models\SalidaDetalle;
use App\Models\EntradaDetalle;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class SalidaDetalleController extends Controller
{
    /**
     * Display a listing of the resource for a given Salida.
     */
    public function index(Request $request, Salida $salida)
    {
        $query = $salida->detalles()->with('entradaDetalle');

        if ($q = $request->input('q')) {
            $query->where('motivo_de_salida', 'like', "%{$q}%")
                ->orWhereHas('entradaDetalle', function ($s) use ($q) {
                    $s->where('no_serie', 'like', "%{$q}%");
                });
        }

        $detalles = $query->orderBy('id', 'desc')->paginate(5)->withQueryString();

        return view('salidasdet.index', compact('salida', 'detalles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Salida $salida)
    {
        $entradas = EntradaDetalle::select('id', 'no_serie')->orderBy('id', 'desc')->get();

        return view('salidasdet.create', compact('salida', 'entradas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Salida $salida): RedirectResponse
    {
        $data = $request->validate([
            'id_entradadetalle' => ['required', 'exists:entradasdetalle,id'],
            'motivo_de_salida' => ['required', 'string', 'max:255'],
        ]);

        // Create via relationship so id_salida is set automatically
        $salida->detalles()->create($data);

        return redirect()->route('salidas.detalle.index', $salida)->with('success', 'Detalle agregado.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Salida $salida, SalidaDetalle $detalle)
    {
        if ($detalle->id_salida != $salida->id) {
            abort(404);
        }

        return view('salidasdet.edit', compact('salida', 'detalle'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Salida $salida, SalidaDetalle $detalle)
    {
        if ($detalle->id_salida != $salida->id) {
            abort(404);
        }

        $detalle->load('entradaDetalle');

        return view('salidasdet.show', compact('salida', 'detalle'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Salida $salida, SalidaDetalle $detalle): RedirectResponse
    {
        if ($detalle->id_salida != $salida->id) {
            abort(404);
        }

        $data = $request->validate([
            'motivo_de_salida' => ['required', 'string', 'max:255'],
        ]);

        $detalle->update($data);

        return redirect()->route('salidas.detalle.index', $salida)->with('success', 'Detalle actualizado.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Salida $salida, SalidaDetalle $detalle): RedirectResponse
    {
        if ($detalle->id_salida != $salida->id) {
            abort(404);
        }

        $detalle->delete();

        return redirect()->route('salidas.detalle.index', $salida)->with('success', 'Detalle eliminado.');
    }
}
