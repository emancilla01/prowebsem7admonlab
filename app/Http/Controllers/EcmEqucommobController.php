<?php

namespace App\Http\Controllers;

use App\Models\EcmEqucommob;
use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rule;

class EcmEqucommobController extends Controller
{
    public function index(Request $request)
    {
        $q = $request->input('q');

        $query = EcmEqucommob::with('categoria');

        if ($q) {
            $query->where(function ($sub) use ($q) {
                $sub->where('codigo', 'like', "%{$q}%")
                    ->orWhere('descripcion', 'like', "%{$q}%");
            });
        }

        $sort = $request->input('sort');
        $dir = $request->input('dir') === 'desc' ? 'desc' : 'asc';
        if (in_array($sort, ['codigo', 'descripcion'])) {
            $query->orderBy($sort, $dir);
        } else {
            $query->orderBy('id', 'asc');
        }

        $ecms = $query->paginate(5)->withQueryString();

        return view('ecm.index', compact('ecms'));
    }

    public function create()
    {
        $categorias = Categoria::pluck('nombre', 'id');
        return view('ecm.create', compact('categorias'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'codigo' => ['required', 'string', 'max:50', 'unique:ecm_equcommob,codigo'],
            'descripcion' => ['required', 'string', 'max:200'],
            'id_categoria' => ['required', 'exists:categorias,id'],
            'tipo' => ['required', Rule::in(['equipo', 'mobiliario'])],
            'estado' => ['required', Rule::in(['activo', 'baja', 'mtto'])],
            'fecha_alta' => ['nullable', 'date'],
        ]);

        EcmEqucommob::create($data);

        return Redirect::route('ecm_equcommob.index')->with('success', 'ECM creado.');
    }

    public function show(EcmEqucommob $ecm_equcommob)
    {
        $ecm_equcommob->load('categoria');
        $ecm = $ecm_equcommob;
        return view('ecm.show', compact('ecm'));
    }

    public function edit(EcmEqucommob $ecm_equcommob)
    {
        $categorias = Categoria::pluck('nombre', 'id');
        $ecm = $ecm_equcommob;
        return view('ecm.edit', compact('ecm', 'categorias'));
    }

    public function update(Request $request, EcmEqucommob $ecm_equcommob)
    {
        $data = $request->validate([
            'codigo' => ['required', 'string', 'max:50', Rule::unique('ecm_equcommob', 'codigo')->ignore($ecm_equcommob->id)],
            'descripcion' => ['required', 'string', 'max:200'],
            'id_categoria' => ['required', 'exists:categorias,id'],
            'tipo' => ['required', Rule::in(['equipo', 'mobiliario'])],
            'estado' => ['required', Rule::in(['activo', 'baja', 'mtto'])],
            'fecha_alta' => ['nullable', 'date'],
        ]);

        $ecm_equcommob->update($data);

        return Redirect::route('ecm_equcommob.index')->with('success', 'ECM actualizado.');
    }

    public function destroy(EcmEqucommob $ecm_equcommob)
    {
        $ecm_equcommob->delete();
        return Redirect::route('ecm_equcommob.index')->with('success', 'ECM eliminado.');
    }

    /**
     * Return JSON list of equipos for a given category
     */
    public function apiequiposPorCategoria(Categoria $categoria)
    {
        return response()->json(EcmEqucommob::where('id_categoria', $categoria->id)->where('tipo', 'equipo')->get());
    }

    /**
     * Return JSON list of mobiliario for a given category
     */
    public function apimobiliarioPorCategoria(Categoria $categoria)
    {
        return response()->json(EcmEqucommob::where('id_categoria', $categoria->id)->where('tipo', 'mobiliario')->get());
    }
}
