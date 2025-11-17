<?php

namespace App\Http\Controllers;

use App\Models\EcmDetmob;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class EcmDetmobController extends Controller
{
    public function index(Request $request)
    {
        $id_ecm = $request->input('id_ecm');
        $query = EcmDetmob::query();
        if ($id_ecm) {
            $query->where('id_ecm', $id_ecm);
        }
        $items = $query->paginate(10)->withQueryString();
        return view('ecmdetm.index', compact('items', 'id_ecm'));
    }

    public function create(Request $request)
    {
        $id_ecm = $request->input('id_ecm');
        return view('ecmdetm.create', compact('id_ecm'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'id_ecm' => ['required', 'exists:ecm_equcommob,id'],
            'codigo' => ['nullable', 'string', 'max:100'],
            'descripcion' => ['nullable', 'string', 'max:200'],
            'material' => ['nullable', 'string', 'max:100'],
            'estado' => ['nullable', 'string', 'max:20'],
            'fecha_adquisicion' => ['nullable', 'date'],
            'ubicacion' => ['nullable', 'string', 'max:100'],
        ]);

        EcmDetmob::create($data);
        return Redirect::route('ecm_detmob.index', ['id_ecm' => $data['id_ecm']])->with('success', 'Mobiliario creado.');
    }

    public function show(EcmDetmob $ecm_detmob)
    {
        $item = $ecm_detmob;
        $item->load('ecm');
        return view('ecmdetm.show', compact('item'));
    }

    public function edit(EcmDetmob $ecm_detmob)
    {
        $item = $ecm_detmob;
        return view('ecmdetm.edit', compact('item'));
    }

    public function update(Request $request, EcmDetmob $ecm_detmob)
    {
        $data = $request->validate([
            'codigo' => ['nullable', 'string', 'max:100'],
            'descripcion' => ['nullable', 'string', 'max:200'],
            'material' => ['nullable', 'string', 'max:100'],
            'estado' => ['nullable', 'string', 'max:20'],
            'fecha_adquisicion' => ['nullable', 'date'],
            'ubicacion' => ['nullable', 'string', 'max:100'],
        ]);

        $ecm_detmob->update($data);
        return Redirect::route('ecm_detmob.index', ['id_ecm' => $ecm_detmob->id_ecm])->with('success', 'Mobiliario actualizado.');
    }

    public function destroy(EcmDetmob $ecm_detmob)
    {
        $id_ecm = $ecm_detmob->id_ecm;
        $ecm_detmob->delete();
        return Redirect::route('ecm_detmob.index', ['id_ecm' => $id_ecm])->with('success', 'Mobiliario eliminado.');
    }
}
