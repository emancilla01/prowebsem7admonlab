<?php

namespace App\Http\Controllers;

use App\Models\Personal;
use Illuminate\Http\Request;

class PersonalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // No explicit sorting requested — use default ordering and paginate 5 per page
        $personals = Personal::paginate(5);
        return view('personal.index', compact('personals'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('personal.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate(Personal::rules());

        Personal::create($data);

        return redirect()->route('personal.index')->with('success', 'Registro creado correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Personal $personal)
    {
        return view('personal.show', compact('personal'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Personal $personal)
    {

        return view('personal.edit', compact('personal'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Personal $personal)
    {
        $data = $request->validate(Personal::rules($personal->id));

        $personal->update($data);

        return redirect()->route('personal.index')->with('success', 'Registro actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Personal $personal)
    {
        $personal->delete();

        return redirect()->route('personal.index')->with('success', 'Registro eliminado.');
    }
}
