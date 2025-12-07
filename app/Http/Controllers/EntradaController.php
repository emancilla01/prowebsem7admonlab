<?php

namespace App\Http\Controllers;

use App\Models\Entrada;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EntradaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Entrada::query();

        // Search
        if ($q = $request->input('q')) {
            $query->where(function ($sub) use ($q) {
                $sub->where('quien_envio', 'like', "%{$q}%")
                    ->orWhere('quien_recibio', 'like', "%{$q}%")
                    ->orWhere('lugar', 'like', "%{$q}%");
            });
        }

        // Sorting
        $allowedSorts = ['fecha', 'hora', 'quien_envio', 'quien_recibio', 'lugar'];
        $sort = $request->input('sort', 'fecha');
        $direction = $request->input('direction', 'desc') === 'asc' ? 'asc' : 'desc';
        if (!in_array($sort, $allowedSorts)) {
            $sort = 'fecha';
        }

        $entradas = $query->orderBy($sort, $direction)->paginate(5)->withQueryString();

        return view('entradas.index', compact('entradas', 'sort', 'direction'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('entradas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'fecha' => ['required', 'date'],
            'hora' => ['required'],
            'quien_envio' => ['required', 'string', 'max:100'],
            'quien_recibio' => ['required', 'string', 'max:100'],
            'lugar' => ['required', 'string', 'max:150'],
        ]);

        Entrada::create($data);

        return redirect()->route('entradas.index')->with('success', 'Entrada creada correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Entrada $entrada)
    {
        return view('entradas.show', compact('entrada'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Entrada $entrada)
    {
        return view('entradas.edit', compact('entrada'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Entrada $entrada): RedirectResponse
    {
        $data = $request->validate([
            'fecha' => ['required', 'date'],
            'hora' => ['required'],
            'quien_envio' => ['required', 'string', 'max:100'],
            'quien_recibio' => ['required', 'string', 'max:100'],
            'lugar' => ['required', 'string', 'max:150'],
        ]);

        $entrada->update($data);

        return redirect()->route('entradas.index')->with('success', 'Entrada actualizada correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Entrada $entrada): RedirectResponse
    {
        $entrada->delete();

        return redirect()->route('entradas.index')->with('success', 'Entrada eliminada.');
    }
}
