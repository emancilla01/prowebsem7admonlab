<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ExplicacionController extends Controller
{
    /**
     * Show the explicacion view for a given carrera.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $carrera
     * @return \Illuminate\Contracts\View\View
     */
    public function ver(Request $request, $carrera = null)
    {
        // Basic normalization: if carrera is passed via query instead of the route segment, prefer route.
        $carreraFromQuery = $request->query('carrera');
        $selected = $carrera ?? $carreraFromQuery ?? null;

        // Return the explicacion blade view and pass the carrera value
        return view('explicacion', ['carrera' => $selected]);
    }

    public function ver(String $id)
    {
        $personal = Personal::find($id);
        $personales = Personal::all();
        $personal2 = Personal::find($id);
        return view('explicacion/explicacion', compact('id'));
    }
}
