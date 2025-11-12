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
        // Support a simple GET search via ?q=... that searches nombre, apellido and email.
        $q = request()->input('q');

        $query = Personal::query();
        if ($q) {
            $query->where('nombre', 'like', "%{$q}%")
                  ->orWhere('apellido_pat', 'like', "%{$q}%")
                  ->orWhere('apellido_mat', 'like', "%{$q}%")
                  ->orWhere('email', 'like', "%{$q}%");
        }

        // Sorting support: ?sort=nombre&dir=asc|desc
        $sort = request()->input('sort');
        $dir = request()->input('dir') === 'desc' ? 'desc' : 'asc';
        if ($sort === 'nombre') {
            $query->orderBy('nombre', $dir);
        } elseif ($sort === 'created_at') {
            $query->orderBy('created_at', $dir);
        }

        $personals = $query->paginate(5)->withQueryString();

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
