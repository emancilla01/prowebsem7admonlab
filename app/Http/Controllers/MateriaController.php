<?php

namespace App\Http\Controllers;

use App\Models\Materia;
use App\Models\Carrera;
use Illuminate\Http\Request;

class MateriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $q = request()->input('q');

        $query = Materia::with('carrera');
        if ($q) {
            $query->where('nombre', 'like', "%{$q}%")
                  ->orWhere('clave', 'like', "%{$q}%");
        }

        $sort = request()->input('sort');
        $dir = request()->input('dir') === 'desc' ? 'desc' : 'asc';
        if ($sort === 'nombre') {
            $query->orderBy('nombre', $dir);
        } elseif ($sort === 'created_at') {
            $query->orderBy('created_at', $dir);
        }

        $materias = $query->paginate(5)->withQueryString();

        return view('materias.index', compact('materias'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $carreras = Carrera::pluck('nombre_carrera', 'id_carrera');
        return view('materias.create', compact('carreras'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate(Materia::rules());
        Materia::create($data);

        return redirect()->route('materias.index')->with('success', 'Materia creada correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Materia $materia)
    {
        $materia->load('carrera');
        return view('materias.show', compact('materia'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Materia $materia)
    {
        $carreras = Carrera::pluck('nombre_carrera', 'id_carrera');
        return view('materias.edit', compact('materia', 'carreras'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Materia $materia)
    {
        $data = $request->validate(Materia::rules($materia->id));
        $materia->update($data);

        return redirect()->route('materias.index')->with('success', 'Materia actualizada correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Materia $materia)
    {
        $materia->delete();

        return redirect()->route('materias.index')->with('success', 'Materia eliminada.');
    }
}
