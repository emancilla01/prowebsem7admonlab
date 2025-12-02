<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categoria;
use App\Models\EntradaDetalle;
use App\Models\Personal;

class ConsultasController extends Controller
{
    /**
     * Show counts of equipment and furniture grouped by category.
     */
    public function porCategorias(Request $request)
    {
        $categories = Categoria::orderBy('nombre')->get();

        $results = $categories->map(function ($cat) {
            // Count entrada detalle rows linked to equipment whose ECM category is this one
            $totalEquipo = EntradaDetalle::whereNotNull('id_ecm_dete')
                ->whereHas('ecmDetequcom.ecm', function ($q) use ($cat) {
                    $q->where('id_categoria', $cat->id);
                })->count();

            // Count entrada detalle rows linked to mobiliario whose ECM category is this one
            $totalMobiliario = EntradaDetalle::whereNotNull('id_ecm_detm')
                ->whereHas('ecmDetmob.ecm', function ($q) use ($cat) {
                    $q->where('id_categoria', $cat->id);
                })->count();

            return (object) [
                'id' => $cat->id,
                'nombre' => $cat->nombre,
                'descripcion' => $cat->descripcion,
                'total_equipo' => $totalEquipo,
                'total_mobiliario' => $totalMobiliario,
            ];
        });

        return view('consultas.categorias', ['results' => $results]);
    }

    /**
     * Show counts of equipment and furniture grouped by personal.
     */
    public function porPersonal(Request $request)
    {
        $personales = Personal::orderBy('nombre')->get();

        $personalResumen = $personales->map(function ($p) {
            // build possible full name variations to match against text fields
            $fullName = trim($p->nombre . ' ' . $p->apellido_pat . ' ' . $p->apellido_mat);
            $shortName = trim($p->nombre . ' ' . $p->apellido_pat);

            // Count equipment (entrada detalle linked to equipo)
            $totalEquipo = EntradaDetalle::whereNotNull('id_ecm_dete')
                ->where(function ($q) use ($fullName, $shortName) {
                    $q->whereHas('entrada', function ($qe) use ($fullName, $shortName) {
                        $qe->where('quien_recibio', 'like', "%{$fullName}%")
                           ->orWhere('quien_recibio', 'like', "%{$shortName}%");
                    })->orWhereHas('espacioTrabajo', function ($qe) use ($fullName, $shortName) {
                        $qe->where('responsable', 'like', "%{$fullName}%")
                           ->orWhere('responsable', 'like', "%{$shortName}%");
                    });
                })->count();

            // Count mobiliario
            $totalMobiliario = EntradaDetalle::whereNotNull('id_ecm_detm')
                ->where(function ($q) use ($fullName, $shortName) {
                    $q->whereHas('entrada', function ($qe) use ($fullName, $shortName) {
                        $qe->where('quien_recibio', 'like', "%{$fullName}%")
                           ->orWhere('quien_recibio', 'like', "%{$shortName}%");
                    })->orWhereHas('espacioTrabajo', function ($qe) use ($fullName, $shortName) {
                        $qe->where('responsable', 'like', "%{$fullName}%")
                           ->orWhere('responsable', 'like', "%{$shortName}%");
                    });
                })->count();

            return (object) [
                'id' => $p->id,
                'nombre' => $p->nombre . ' ' . $p->apellido_pat . ' ' . $p->apellido_mat,
                'descripcion' => $p->depto ?? '',
                'total_equipo' => $totalEquipo,
                'total_mobiliario' => $totalMobiliario,
            ];
        });

        return view('consultas.personal', ['personalResumen' => $personalResumen]);
    }
}
