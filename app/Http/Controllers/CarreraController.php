<?php

namespace App\Http\Controllers;

use App\Models\Carrera;
use Illuminate\Http\Request;

class CarreraController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Support a simple GET search via ?q=... that searches nombre_clase, clave and coordinator
        $q = request()->input('q');

        $query = Carrera::query();
        if ($q) {
            $query->where('nombre_carrera', 'like', "%{$q}%")
                  ->orWhere('clave_carrera', 'like', "%{$q}%")
                  ->orWhere('coordinador', 'like', "%{$q}%");
        }

        $carreras = $query->paginate(5)->withQueryString();

        return view('carreras.index', compact('carreras'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('carreras.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate(Carrera::rules());

        Carrera::create($data);

        return redirect()->route('carreras.index')->with('success', 'Registro creado correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Carrera $carrera)
    {
        return view('carreras.show', compact('carrera'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Carrera $carrera)
    {
        return view('carreras.edit', compact('carrera'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Carrera $carrera)
    {
        $data = $request->validate(Carrera::rules($carrera->id_carrera));

        $carrera->update($data);

        return redirect()->route('carreras.index')->with('success', 'Registro actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Carrera $carrera)
    {
        $carrera->delete();

        return redirect()->route('carreras.index')->with('success', 'Registro eliminado.');
    }
}
