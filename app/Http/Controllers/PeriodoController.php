<?php

namespace App\Http\Controllers;

use App\Models\Periodo;
use Illuminate\Http\Request;

class PeriodoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Support a simple GET search via ?q=... that searches nombre
        $q = request()->input('q');

        $query = Periodo::query();
        if ($q) {
            $query->where('nombre', 'like', "%{$q}%");
        }

        // Sorting support
        $sort = request()->input('sort');
        $dir = request()->input('dir') === 'desc' ? 'desc' : 'asc';
        if ($sort === 'nombre') {
            $query->orderBy('nombre', $dir);
        } elseif ($sort === 'created_at') {
            $query->orderBy('created_at', $dir);
        }

        $periodos = $query->paginate(5)->withQueryString();

        return view('periodos.index', compact('periodos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('periodos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate(Periodo::rules());

        Periodo::create($data);

        return redirect()->route('periodos.index')->with('success', 'Periodo creado correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Periodo $periodo)
    {
        return view('periodos.show', compact('periodo'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Periodo $periodo)
    {
        return view('periodos.edit', compact('periodo'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Periodo $periodo)
    {
        $data = $request->validate(Periodo::rules($periodo->id));
        $periodo->update($data);

        return redirect()->route('periodos.index')->with('success', 'Periodo actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Periodo $periodo)
    {
        $periodo->delete();

        return redirect()->route('periodos.index')->with('success', 'Periodo eliminado.');
    }

    /**
     * Return JSON list of periodos for API/JS
     */
    public function apiperiodos()
    {
        return response()->json(Periodo::all());
    }
}
