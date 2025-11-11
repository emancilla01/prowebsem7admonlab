<?php

namespace App\Http\Controllers;

use App\Models\Software;
use Illuminate\Http\Request;

class SoftwareController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $softwares = Software::paginate(5);
        return view('software.index', compact('softwares'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('software.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate(Software::rules());

        Software::create($data);

        return redirect()->route('software.index')->with('success', 'Registro creado correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Software $software)
    {
        return view('software.show', ['software' => $software]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Software $software)
    {
        return view('software.edit', ['software' => $software]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Software $software)
    {
        $data = $request->validate(Software::rules($software->id_software));

        $software->update($data);

        return redirect()->route('software.index')->with('success', 'Registro actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Software $software)
    {
        $software->delete();

        return redirect()->route('software.index')->with('success', 'Registro eliminado.');
    }
}
