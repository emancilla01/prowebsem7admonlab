<?php

namespace App\Http\Controllers;

use App\Models\Personal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
        $rules = Personal::rules();
        $rules['photo'] = ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,webp', 'max:2048'];

        $data = $request->validate($rules);

        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('personals', 'public');
            $data['photo'] = $path;
        }

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
        $rules = Personal::rules($personal->id);
        $rules['photo'] = ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,webp', 'max:2048'];

        $data = $request->validate($rules);

        if ($request->hasFile('photo')) {
            if ($personal->photo && Storage::disk('public')->exists($personal->photo)) {
                Storage::disk('public')->delete($personal->photo);
            }
            $path = $request->file('photo')->store('personals', 'public');
            $data['photo'] = $path;
        }

        $personal->update($data);

        return redirect()->route('personal.index')->with('success', 'Registro actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Personal $personal)
    {
        if ($personal->photo && Storage::disk('public')->exists($personal->photo)) {
            Storage::disk('public')->delete($personal->photo);
        }

        $personal->delete();

        return redirect()->route('personal.index')->with('success', 'Registro eliminado.');
    }
    
    // public function apipersonal()
    // {
    //     $personal = Personal::all();
    //     if ($personal) {
    //         return response()->json($personal);
    //     } else {
    //         return response()->json(['error' => 'Personal not found'], 404);
    //     }
    // }

    // API endpoint for JS clients. Accepts optional query param `letras`.
    public function apipersonal(Request $request)
    {
        $letras = $request->query('letras', '');
        $pattern = $letras === '' ? '%' : "%{$letras}%";

        $personal = Personal::where('nombre', 'like', $pattern)->get();

        return response()->json($personal);
    }
    
}
