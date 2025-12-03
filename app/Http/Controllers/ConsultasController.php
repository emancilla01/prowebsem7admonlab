<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categoria;
use App\Models\EntradaDetalle;
use App\Models\Personal;
use App\Models\EspacioTrabajo;
use Illuminate\Support\Facades\DB;

class ConsultasController extends Controller
{
    /**
     * Show counts of equipment and furniture grouped by category.
     */
    public function porCategorias(Request $request)
    {
        // Build category name map
        $categoriaMap = Categoria::pluck('nombre', 'id')->toArray();

        // Equipment rows: join entradasdetalle -> ecm_detequcom -> ecm_equcommob to get category + item description
        $equipRows = DB::table('entradasdetalle')
            ->join('ecm_detequcom', 'entradasdetalle.id_ecm_dete', '=', 'ecm_detequcom.id')
            ->join('ecm_equcommob', 'ecm_detequcom.id_ecm', '=', 'ecm_equcommob.id')
            ->whereNotNull('entradasdetalle.id_ecm_dete')
            ->select(
                'ecm_equcommob.id_categoria as categoria_id',
                'ecm_detequcom.descripcion as descripcion',
                DB::raw('COUNT(*) as total_equipo'),
                DB::raw('0 as total_mobiliario')
            )
            ->groupBy('ecm_equcommob.id_categoria', 'ecm_detequcom.descripcion')
            ->get();

        // Mobiliario rows: join entradasdetalle -> ecm_detmob -> ecm_equcommob to get category + item description
        $mobiRows = DB::table('entradasdetalle')
            ->join('ecm_detmob', 'entradasdetalle.id_ecm_detm', '=', 'ecm_detmob.id')
            ->join('ecm_equcommob', 'ecm_detmob.id_ecm', '=', 'ecm_equcommob.id')
            ->whereNotNull('entradasdetalle.id_ecm_detm')
            ->select(
                'ecm_equcommob.id_categoria as categoria_id',
                'ecm_detmob.descripcion as descripcion',
                DB::raw('0 as total_equipo'),
                DB::raw('COUNT(*) as total_mobiliario')
            )
            ->groupBy('ecm_equcommob.id_categoria', 'ecm_detmob.descripcion')
            ->get();

        // Combine and aggregate by (categoria_id + descripcion)
        $combined = $equipRows->concat($mobiRows);

        $grouped = $combined->groupBy(function ($item) {
            return ($item->categoria_id ?? '0') . '||' . ($item->descripcion ?? '');
        });

        $results = $grouped->map(function ($items) use ($categoriaMap) {
            $first = $items->first();
            $catId = $first->categoria_id;

            return (object) [
                'id' => $catId,
                'nombre' => $categoriaMap[$catId] ?? '—',
                'descripcion' => $first->descripcion,
                'total_equipo' => $items->sum('total_equipo'),
                'total_mobiliario' => $items->sum('total_mobiliario'),
            ];
        })->values();

        return view('consultas.categorias', ['results' => $results]);
    }

    /**
     * Show counts of equipment and furniture grouped by personal.
     */
    public function porPersonal(Request $request)
    {
        $personales = Personal::orderBy('nombre')->get();

        // Build a map of person id -> full name
        $personMap = $personales->mapWithKeys(function ($p) {
            return [$p->id => trim($p->nombre . ' ' . $p->apellido_pat . ' ' . $p->apellido_mat)];
        })->toArray();

        $allRows = collect();

        foreach ($personales as $p) {
            $fullName = trim($p->nombre . ' ' . $p->apellido_pat . ' ' . $p->apellido_mat);
            $shortName = trim($p->nombre . ' ' . $p->apellido_pat);

            // Equipment grouped by item description for this person
            $equip = DB::table('entradasdetalle')
                ->join('ecm_detequcom', 'entradasdetalle.id_ecm_dete', '=', 'ecm_detequcom.id')
                ->join('entradas', 'entradasdetalle.id_entrada', '=', 'entradas.id')
                ->leftJoin('espacios_trabajo', 'entradasdetalle.id_espaciotrabajo', '=', 'espacios_trabajo.id_espacio')
                ->whereNotNull('entradasdetalle.id_ecm_dete')
                ->where(function ($q) use ($fullName, $shortName) {
                    $q->where('entradas.quien_recibio', 'like', "%{$fullName}%")
                      ->orWhere('entradas.quien_recibio', 'like', "%{$shortName}%")
                      ->orWhere('espacios_trabajo.responsable', 'like', "%{$fullName}%")
                      ->orWhere('espacios_trabajo.responsable', 'like', "%{$shortName}%");
                })
                ->select(DB::raw($p->id . ' as person_id'), 'ecm_detequcom.descripcion as descripcion', DB::raw('COUNT(*) as total_equipo'), DB::raw('0 as total_mobiliario'))
                ->groupBy('ecm_detequcom.descripcion')
                ->get();

            // Mobiliario grouped by item description for this person
            $mobi = DB::table('entradasdetalle')
                ->join('ecm_detmob', 'entradasdetalle.id_ecm_detm', '=', 'ecm_detmob.id')
                ->join('entradas', 'entradasdetalle.id_entrada', '=', 'entradas.id')
                ->leftJoin('espacios_trabajo', 'entradasdetalle.id_espaciotrabajo', '=', 'espacios_trabajo.id_espacio')
                ->whereNotNull('entradasdetalle.id_ecm_detm')
                ->where(function ($q) use ($fullName, $shortName) {
                    $q->where('entradas.quien_recibio', 'like', "%{$fullName}%")
                      ->orWhere('entradas.quien_recibio', 'like', "%{$shortName}%")
                      ->orWhere('espacios_trabajo.responsable', 'like', "%{$fullName}%")
                      ->orWhere('espacios_trabajo.responsable', 'like', "%{$shortName}%");
                })
                ->select(DB::raw($p->id . ' as person_id'), 'ecm_detmob.descripcion as descripcion', DB::raw('0 as total_equipo'), DB::raw('COUNT(*) as total_mobiliario'))
                ->groupBy('ecm_detmob.descripcion')
                ->get();

            $allRows = $allRows->concat($equip)->concat($mobi);
        }

        // Aggregate rows by (person_id + descripcion)
        $grouped = $allRows->groupBy(function ($item) {
            return ($item->person_id ?? '0') . '||' . ($item->descripcion ?? '');
        });

        $personalResumen = $grouped->map(function ($items) use ($personMap) {
            $first = $items->first();
            $pid = $first->person_id;

            return (object) [
                'id' => $pid,
                'nombre' => $personMap[$pid] ?? '—',
                'descripcion' => $first->descripcion,
                'total_equipo' => $items->sum('total_equipo'),
                'total_mobiliario' => $items->sum('total_mobiliario'),
            ];
        })->values();

        return view('consultas.personal', ['personalResumen' => $personalResumen]);
    }

    /**
     * Show counts of equipment and furniture grouped by Espacios de Trabajo.
     */
    public function porEspacios(Request $request)
    {
        // Map of workspace id -> nombre_espacio to label rows
        $espaciosMap = EspacioTrabajo::pluck('nombre_espacio', 'id_espacio')->toArray();

        // Equipment rows: join entradasdetalle -> ecm_detequcom and group by workspace + equipment description
        $equipRows = EntradaDetalle::join('ecm_detequcom', 'entradasdetalle.id_ecm_dete', '=', 'ecm_detequcom.id')
            ->whereNotNull('entradasdetalle.id_ecm_dete')
            ->select(
                'entradasdetalle.id_espaciotrabajo as espacio_id',
                'ecm_detequcom.descripcion as descripcion',
                DB::raw('COUNT(*) as total_equipo'),
                DB::raw('0 as total_mobiliario')
            )
            ->groupBy('entradasdetalle.id_espaciotrabajo', 'ecm_detequcom.descripcion')
            ->get();

        // Mobiliario rows: join entradasdetalle -> ecm_detmob and group by workspace + mobiliario description
        $mobiRows = EntradaDetalle::join('ecm_detmob', 'entradasdetalle.id_ecm_detm', '=', 'ecm_detmob.id')
            ->whereNotNull('entradasdetalle.id_ecm_detm')
            ->select(
                'entradasdetalle.id_espaciotrabajo as espacio_id',
                'ecm_detmob.descripcion as descripcion',
                DB::raw('0 as total_equipo'),
                DB::raw('COUNT(*) as total_mobiliario')
            )
            ->groupBy('entradasdetalle.id_espaciotrabajo', 'ecm_detmob.descripcion')
            ->get();

        // Combine equipment and mobiliario rows, then aggregate by (espacio_id + descripcion)
        $combined = $equipRows->concat($mobiRows);

        $grouped = $combined->groupBy(function ($item) {
            return ($item->espacio_id ?? '0') . '||' . ($item->descripcion ?? '');
        });

        $espaciosResumen = $grouped->map(function ($items) use ($espaciosMap) {
            $first = $items->first();
            $espId = $first->espacio_id;
            $descripcion = $first->descripcion;

            return (object) [
                'id' => $espId,
                'nombre' => $espaciosMap[$espId] ?? '—',
                'descripcion' => $descripcion,
                'total_equipo' => $items->sum('total_equipo'),
                'total_mobiliario' => $items->sum('total_mobiliario'),
            ];
        })->values();

        return view('consultas.espacios', ['espaciosResumen' => $espaciosResumen]);
    }
}
