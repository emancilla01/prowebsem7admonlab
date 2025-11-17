<?php

namespace App\Http\Controllers;

use App\Models\Grupo;
use App\Models\GrupoLab;
use App\Models\EspacioTrabajo;
use Illuminate\Http\Request;

class GrupoLabController extends Controller
{
    public function index(Grupo $grupo)
    {
        $q = request()->input('q');

        $query = GrupoLab::with('espacio')->where('id_grupo', $grupo->id);

        if ($q) {
            $query->where(function($sub) use ($q) {
                $sub->where('horario', 'like', "%{$q}%")
                    ->orWhereHas('espacio', function($esp) use ($q) {
                        $esp->where('nombre_espacio', 'like', "%{$q}%");
                    });
            });
        }

        $sort = request()->input('sort');
        $dir = request()->input('dir') === 'desc' ? 'desc' : 'asc';
        if ($sort === 'id_espacio') {
            $query->orderBy('id_espacio', $dir);
        } else {
            $query->orderBy('id', 'asc');
        }

        $labs = $query->paginate(10)->withQueryString();

        return view('gruposlab.index', compact('grupo', 'labs'));
    }

    public function create(Grupo $grupo)
    {
        $espacios = EspacioTrabajo::pluck('nombre_espacio', 'id_espacio');
        return view('gruposlab.create', compact('grupo', 'espacios'));
    }

    public function store(Request $request, Grupo $grupo)
    {
        $data = $request->validate([
            'id_espacio' => ['required', 'exists:espacios_trabajo,id_espacio'],
            'horario' => ['nullable', 'string', 'max:100'],
        ]);
        $data['id_grupo'] = $grupo->id;
        GrupoLab::create($data);

        return redirect()->route('grupos.labs.index', $grupo)->with('success', 'Laboratorio agregado.');
    }

    public function edit(GrupoLab $lab)
    {
        $grupo = $lab->grupo;
        $espacios = EspacioTrabajo::pluck('nombre_espacio', 'id_espacio');
        return view('gruposlab.edit', compact('lab', 'grupo', 'espacios'));
    }

    public function update(Request $request, GrupoLab $lab)
    {
        $data = $request->validate([
            'id_espacio' => ['required', 'exists:espacios_trabajo,id_espacio'],
            'horario' => ['nullable', 'string', 'max:100'],
        ]);

        $lab->update($data);

        return redirect()->route('grupos.labs.index', $lab->grupo)->with('success', 'Laboratorio actualizado.');
    }

    public function show(GrupoLab $lab)
    {
        $lab->load('espacio', 'grupo');
        $grupo = $lab->grupo;
        return view('gruposlab.show', compact('lab', 'grupo'));
    }

    public function destroy(GrupoLab $lab)
    {
        $grupo = $lab->grupo;
        $lab->delete();
        return redirect()->route('grupos.labs.index', $grupo)->with('success', 'Laboratorio eliminado.');
    }
}
