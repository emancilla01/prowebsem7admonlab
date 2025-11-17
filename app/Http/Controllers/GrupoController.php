<?php

namespace App\Http\Controllers;

use App\Models\Grupo;
use App\Models\Materia;
use App\Models\Periodo;
use App\Models\Personal;
use App\Models\Carrera;
use Illuminate\Http\Request;

class GrupoController extends Controller
{
    public function index()
    {
        $q = request()->input('q');

        $query = Grupo::with('materia');
        if ($q) {
            $query->where('nombre_grupo', 'like', "%{$q}%")
                  ->orWhere('clave_grupo', 'like', "%{$q}%");
        }

        $sort = request()->input('sort');
        $dir = request()->input('dir') === 'desc' ? 'desc' : 'asc';
        if ($sort === 'nombre_grupo') {
            $query->orderBy('nombre_grupo', $dir);
        }

        $grupos = $query->paginate(5)->withQueryString();

        return view('grupos.index', compact('grupos'));
    }

    public function create()
    {
        $materias = Materia::pluck('nombre', 'id');
        $periodos = Periodo::pluck('nombre', 'id');
        $personals = Personal::pluck('nombre', 'id');
        $carreras = Carrera::pluck('nombre_carrera', 'id_carrera');

        return view('grupos.create', compact('materias', 'periodos', 'personals', 'carreras'));
    }

    public function store(Request $request)
    {
        $data = $request->validate(Grupo::rules());
        Grupo::create($data);

        return redirect()->route('grupos.index')->with('success', 'Grupo creado correctamente.');
    }

    public function show(Grupo $grupo)
    {
        $grupo->load('materia', 'periodo', 'personal', 'carrera');
        return view('grupos.show', compact('grupo'));
    }

    public function edit(Grupo $grupo)
    {
        $materias = Materia::pluck('nombre', 'id');
        $periodos = Periodo::pluck('nombre', 'id');
        $personals = Personal::pluck('nombre', 'id');
        $carreras = Carrera::pluck('nombre_carrera', 'id_carrera');

        return view('grupos.edit', compact('grupo', 'materias', 'periodos', 'personals', 'carreras'));
    }

    public function update(Request $request, Grupo $grupo)
    {
        $data = $request->validate(Grupo::rules($grupo->id));
        $grupo->update($data);

        return redirect()->route('grupos.index')->with('success', 'Grupo actualizado correctamente.');
    }

    public function destroy(Grupo $grupo)
    {
        $grupo->delete();

        return redirect()->route('grupos.index')->with('success', 'Grupo eliminado.');
    }
}
