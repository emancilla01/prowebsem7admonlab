<?php

namespace App\Http\Controllers;

use App\Models\Grupo;
use App\Models\GrupoAlumno;
use Illuminate\Http\Request;

class GrupoAlumnoController extends Controller
{
    public function index(Grupo $grupo)
    {
        $alumnos = GrupoAlumno::where('id_grupo', $grupo->id)->paginate(10)->withQueryString();
        return view('grupos.alumnos.index', compact('grupo', 'alumnos'));
    }

    public function create(Grupo $grupo)
    {
        return view('grupos.alumnos.create', compact('grupo'));
    }

    public function store(Request $request, Grupo $grupo)
    {
        $data = $request->validate([
            'alumno_nombre' => 'required|string|max:255',
            'alumno_matricula' => 'required|string|max:100',
        ]);
        $data['id_grupo'] = $grupo->id;
        GrupoAlumno::create($data);

        return redirect()->route('grupos.alumnos.index', $grupo)->with('success', 'Alumno agregado.');
    }

    public function destroy(GrupoAlumno $alumno)
    {
        $grupo = $alumno->grupo;
        $alumno->delete();
        return redirect()->route('grupos.alumnos.index', $grupo)->with('success', 'Alumno eliminado.');
    }
}
