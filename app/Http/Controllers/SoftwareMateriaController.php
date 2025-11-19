<?php

namespace App\Http\Controllers;

use App\Models\SoftwareMateria;
use App\Models\Software;
use App\Models\Materia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class SoftwareMateriaController extends Controller
{
    public function index(Request $request, $software = null)
    {
        $q = $request->input('q');
        $sort = $request->input('sort');
        $dir = $request->input('dir') === 'asc' ? 'asc' : 'desc';

        $query = SoftwareMateria::query()->with(['software','materia']);

        // If route provided software id (nested), filter
        $softwareId = $software ?? $request->input('software');
        if ($softwareId) {
            $query->where('id_software', $softwareId);
        }

        if ($q) {
            $query->whereHas('software', function($sub) use ($q) {
                $sub->where('nombre_software', 'like', "%{$q}%");
            })->orWhereHas('materia', function($sub) use ($q) {
                $sub->where('nombre', 'like', "%{$q}%");
            });
        }

        if ($sort === 'materia') {
            $query->join('materias','software_materias.id_materia','=','materias.id')
                  ->orderBy('materias.nombre', $dir)
                  ->select('software_materias.*');
        } else {
            $query->orderBy('id','desc');
        }

        $items = $query->paginate(5)->withQueryString();

        return view('softwarematerias.index', compact('items','softwareId'));
    }

    public function create(Request $request, $software = null)
    {
        $softwareId = $software ?? $request->input('software');
        $softwares = Software::pluck('nombre_software','id_software');
        $materias = Materia::pluck('nombre','id');
        return view('softwarematerias.create', compact('softwareId','softwares','materias'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'id_software' => ['required','exists:software,id_software'],
            'id_materia' => ['required','exists:materias,id'],
            'observaciones' => ['nullable','string','max:255'],
        ]);

        SoftwareMateria::create($data);
        return Redirect::route('software.materias.index', ['software' => $data['id_software']])->with('success','Registro creado.');
    }

    public function show(SoftwareMateria $software_materia)
    {
        $item = $software_materia->load('software','materia');
        return view('softwarematerias.show', compact('item'));
    }

    public function edit(SoftwareMateria $software_materia)
    {
        $item = $software_materia->load('software','materia');
        $softwares = Software::pluck('nombre_software','id_software');
        $materias = Materia::pluck('nombre','id');
        return view('softwarematerias.edit', compact('item','softwares','materias'));
    }

    public function update(Request $request, SoftwareMateria $software_materia)
    {
        $data = $request->validate([
            'id_software' => ['required','exists:software,id_software'],
            'id_materia' => ['required','exists:materias,id'],
            'observaciones' => ['nullable','string','max:255'],
        ]);

        $software_materia->update($data);
        return Redirect::route('software.materias.index', ['software' => $data['id_software']])->with('success','Registro actualizado.');
    }

    public function destroy(SoftwareMateria $software_materia)
    {
        $softwareId = $software_materia->id_software;
        $software_materia->delete();
        return Redirect::route('software.materias.index', ['software' => $softwareId])->with('success','Registro eliminado.');
    }
}
