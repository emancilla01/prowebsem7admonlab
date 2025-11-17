<?php

namespace App\Http\Controllers;

use App\Models\EcmDetequcom;
use App\Models\EcmEqucommob;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class EcmDetequcomController extends Controller
{
    public function index(Request $request)
    {
        $id_ecm = $request->input('id_ecm');
        $query = EcmDetequcom::query();
        if ($id_ecm) {
            $query->where('id_ecm', $id_ecm);
        }
        $items = $query->paginate(10)->withQueryString();
        return view('ecmdete.index', compact('items', 'id_ecm'));
    }

    public function create(Request $request)
    {
        $id_ecm = $request->input('id_ecm');
        return view('ecmdete.create', compact('id_ecm'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'id_ecm' => ['required', 'exists:ecm_equcommob,id'],
            'serial' => ['nullable', 'string', 'max:100'],
            'modelo' => ['nullable', 'string', 'max:100'],
            'marca' => ['nullable', 'string', 'max:100'],
            'descripcion' => ['nullable', 'string', 'max:200'],
            'estado' => ['nullable', 'string', 'max:20'],
            'fecha_adquisicion' => ['nullable', 'date'],
            'ubicacion' => ['nullable', 'string', 'max:100'],
        ]);

        EcmDetequcom::create($data);
        return Redirect::route('ecm_detequcom.index', ['id_ecm' => $data['id_ecm']])->with('success', 'Equipo creado.');
    }

    public function show(EcmDetequcom $ecm_detequcom)
    {
        $item = $ecm_detequcom;
        $item->load('ecm');
        return view('ecmdete.show', compact('item'));
    }

    public function edit(EcmDetequcom $ecm_detequcom)
    {
        $item = $ecm_detequcom;
        return view('ecmdete.edit', compact('item'));
    }

    public function update(Request $request, EcmDetequcom $ecm_detequcom)
    {
        $data = $request->validate([
            'serial' => ['nullable', 'string', 'max:100'],
            'modelo' => ['nullable', 'string', 'max:100'],
            'marca' => ['nullable', 'string', 'max:100'],
            'descripcion' => ['nullable', 'string', 'max:200'],
            'estado' => ['nullable', 'string', 'max:20'],
            'fecha_adquisicion' => ['nullable', 'date'],
            'ubicacion' => ['nullable', 'string', 'max:100'],
        ]);

        $ecm_detequcom->update($data);
        return Redirect::route('ecm_detequcom.index', ['id_ecm' => $ecm_detequcom->id_ecm])->with('success', 'Equipo actualizado.');
    }

    public function destroy(EcmDetequcom $ecm_detequcom)
    {
        $id_ecm = $ecm_detequcom->id_ecm;
        $ecm_detequcom->delete();
        return Redirect::route('ecm_detequcom.index', ['id_ecm' => $id_ecm])->with('success', 'Equipo eliminado.');
    }
}
