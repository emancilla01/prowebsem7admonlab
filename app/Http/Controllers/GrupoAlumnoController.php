<?php

namespace App\Http\Controllers;

use App\Models\Grupo;
use App\Models\GrupoAlumno;
use Illuminate\Http\Request;

class GrupoAlumnoController extends Controller
{
    public function index(Grupo $grupo)
    {
        $q = request()->input('q');

        $query = GrupoAlumno::where('id_grupo', $grupo->id)->with('grupo');

        if ($q) {
            $query->where(function($sub) use ($q) {
                $sub->where('matricula', 'like', "%{$q}%")
                    ->orWhere('nombre_alumno', 'like', "%{$q}%");
            });
        }

        $sort = request()->input('sort');
        $dir = request()->input('dir') === 'desc' ? 'desc' : 'asc';
        if ($sort === 'nombre_alumno') {
            $query->orderBy('nombre_alumno', $dir);
        } else {
            $query->orderBy('id', 'asc');
        }

        $alumnos = $query->paginate(5)->withQueryString();

        return view('gruposalumnos.index', compact('grupo', 'alumnos'));
    }

    public function create(Grupo $grupo)
    {
        $grupos = Grupo::pluck('nombre_grupo', 'id');
        return view('gruposalumnos.create', compact('grupo', 'grupos'));
    }

    public function store(Request $request, Grupo $grupo)
    {
        $data = $request->validate([
            'id_grupo' => ['required', 'exists:grupos,id'],
            'matricula' => ['required', 'string', 'max:30'],
            'nombre_alumno' => ['required', 'string', 'max:150'],
        ]);

        $data['id_grupo'] = $grupo->id;
        GrupoAlumno::create($data);

        return redirect()->route('grupos.alumnos.index', $grupo)->with('success', 'Alumno agregado.');
    }

    public function edit(GrupoAlumno $alumno)
    {
        $grupo = $alumno->grupo;
        $grupos = Grupo::pluck('nombre_grupo', 'id');
        return view('gruposalumnos.edit', compact('alumno', 'grupo', 'grupos'));
    }

    public function update(Request $request, GrupoAlumno $alumno)
    {
        $data = $request->validate([
            'id_grupo' => ['required', 'exists:grupos,id'],
            'matricula' => ['required', 'string', 'max:30'],
            'nombre_alumno' => ['required', 'string', 'max:150'],
        ]);

        $alumno->update($data);

        return redirect()->route('grupos.alumnos.index', $alumno->grupo)->with('success', 'Alumno actualizado.');
    }

    public function show(GrupoAlumno $alumno)
    {
        $alumno->load('grupo');
        $grupo = $alumno->grupo;
        return view('gruposalumnos.show', compact('alumno', 'grupo'));
    }

    public function destroy(GrupoAlumno $alumno)
    {
        $grupo = $alumno->grupo;
        $alumno->delete();
        return redirect()->route('grupos.alumnos.index', $grupo)->with('success', 'Alumno eliminado.');
    }

    /**
     * Return JSON list of alumnos for a given grupo
     */
    public function apialumnos(Grupo $grupo)
    {
        return response()->json(GrupoAlumno::where('id_grupo', $grupo->id)->get());
    }
}
