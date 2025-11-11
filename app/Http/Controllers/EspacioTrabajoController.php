<?php

namespace App\Http\Controllers;

use App\Models\EspacioTrabajo;
use Illuminate\Http\Request;

class EspacioTrabajoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $espacios = EspacioTrabajo::paginate(5);
        return view('espaciosdetrabajo.index', compact('espacios'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('espaciosdetrabajo.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate(EspacioTrabajo::rules());

        EspacioTrabajo::create($data);

    return redirect()->route('espaciosdetrabajo.index')->with('success', 'Registro creado correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(EspacioTrabajo $espacio_trabajo)
    {
        return view('espaciosdetrabajo.show', ['espacio' => $espacio_trabajo]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(EspacioTrabajo $espacio_trabajo)
    {
        return view('espaciosdetrabajo.edit', ['espacio' => $espacio_trabajo]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, EspacioTrabajo $espacio_trabajo)
    {
        $data = $request->validate(EspacioTrabajo::rules($espacio_trabajo->id_espacio));

        $espacio_trabajo->update($data);

    return redirect()->route('espaciosdetrabajo.index')->with('success', 'Registro actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(EspacioTrabajo $espacio_trabajo)
    {
        $espacio_trabajo->delete();

    return redirect()->route('espaciosdetrabajo.index')->with('success', 'Registro eliminado.');
    }
}
