<?php

namespace App\Http\Controllers;

use App\Models\Salida;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class SalidasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Salida::query();

        if ($q = $request->input('q')) {
            $query->where(function ($sub) use ($q) {
                $sub->where('quien_autorizo', 'like', "%{$q}%")
                    ->orWhere('quien_registro', 'like', "%{$q}%")
                    ->orWhere('fecha', 'like', "%{$q}%");
            });
        }

        // sorting
        $allowed = ['id', 'fecha', 'hora', 'quien_autorizo', 'quien_registro'];
        $sort = $request->input('sort', 'fecha');
        $dir = strtolower($request->input('dir', 'desc')) === 'asc' ? 'asc' : 'desc';
        if (! in_array($sort, $allowed)) {
            $sort = 'fecha';
        }

        $salidas = $query->orderBy($sort, $dir)->paginate(5)->withQueryString();

        return view('salidas.index', compact('salidas', 'sort', 'dir'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('salidas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'fecha' => ['required', 'date'],
            'hora' => ['required'],
            'quien_autorizo' => ['required', 'string', 'max:100'],
            'quien_registro' => ['required', 'string', 'max:100'],
        ]);

        Salida::create($data);

        return redirect()->route('salidas.index')->with('success', 'Salida creada correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Salida $salida)
    {
        return view('salidas.show', compact('salida'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Salida $salida)
    {
        return view('salidas.edit', compact('salida'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Salida $salida): RedirectResponse
    {
        $data = $request->validate([
            'fecha' => ['required', 'date'],
            'hora' => ['required'],
            'quien_autorizo' => ['required', 'string', 'max:100'],
            'quien_registro' => ['required', 'string', 'max:100'],
        ]);

        $salida->update($data);

        return redirect()->route('salidas.index')->with('success', 'Salida actualizada correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Salida $salida): RedirectResponse
    {
        $salida->delete();

        return redirect()->route('salidas.index')->with('success', 'Salida eliminada.');
    }
}
