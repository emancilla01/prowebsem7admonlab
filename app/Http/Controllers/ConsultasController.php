<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categoria;
use App\Models\EntradaDetalle;
use App\Models\Personal;
use App\Models\EspacioTrabajo;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;

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

        // Paginate the results using simple pagination (Prev/Next)
        $perPage = 6;
        $page = Paginator::resolveCurrentPage() ?: 1;
        $slice = $results->slice(($page - 1) * $perPage, $perPage)->values();

        $paginated = new LengthAwarePaginator($slice, $results->count(), $perPage, $page, [
            'path' => Paginator::resolveCurrentPath(),
            'query' => $request->query(),
        ]);

        return view('consultas.categorias', ['results' => $paginated]);
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

        // Paginate the personal resumen collection using simple pagination (Prev/Next)
        $perPage = 6;
        $page = Paginator::resolveCurrentPage() ?: 1;
        $slice = $personalResumen->slice(($page - 1) * $perPage, $perPage)->values();

        $paginatedPersonal = new LengthAwarePaginator($slice, $personalResumen->count(), $perPage, $page, [
            'path' => Paginator::resolveCurrentPath(),
            'query' => $request->query(),
        ]);

        return view('consultas.personal', ['personalResumen' => $paginatedPersonal]);
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

        // Paginate espacios resumen using simple pagination (Prev/Next)
        $perPage = 6;
        $page = Paginator::resolveCurrentPage() ?: 1;
        $slice = $espaciosResumen->slice(($page - 1) * $perPage, $perPage)->values();

        $paginatedEspacios = new LengthAwarePaginator($slice, $espaciosResumen->count(), $perPage, $page, [
            'path' => Paginator::resolveCurrentPath(),
            'query' => $request->query(),
        ]);

        return view('consultas.espacios', ['espaciosResumen' => $paginatedEspacios]);
    }

    /**
     * Show software installed per Equipo de Computo.
     *
     * Rules:
     * - Accept optional GET `filtro_equipo` to filter by equipment description or serial.
     * - Do not change DB schema. Hardware fields set to "N/A" since not available.
     * - Return view with `$registros` (each record has keys matching view columns).
     */
    public function softwarePorEquipo(Request $request)
    {
        $filtro = $request->input('filtro_equipo');

        $query = DB::table('entradasdetalle')
            ->join('ecm_detequcom', 'entradasdetalle.id_ecm_dete', '=', 'ecm_detequcom.id')
            ->leftJoin('software', 'software.id_espacio', '=', 'entradasdetalle.id_espaciotrabajo')
            ->whereNotNull('entradasdetalle.id_ecm_dete')
            ->select(
                'ecm_detequcom.descripcion as equipo',
                'entradasdetalle.no_serie as no_serie',
                DB::raw("'N/A' as procesador"),
                DB::raw("'N/A' as memoria_ram"),
                DB::raw("'N/A' as almacenamiento_hd"),
                DB::raw("'N/A' as resolucion_pantalla"),
                DB::raw("'N/A' as pantalla_tactil"),
                DB::raw("GROUP_CONCAT(DISTINCT software.nombre_software SEPARATOR ', ') as software_instalado")
            )
            ->when($filtro, function ($q, $filtro) {
                $q->where('ecm_detequcom.descripcion', 'like', "%{$filtro}%")
                  ->orWhere('entradasdetalle.no_serie', 'like', "%{$filtro}%");
            })
            ->groupBy('entradasdetalle.id', 'ecm_detequcom.descripcion', 'entradasdetalle.no_serie')
            ->orderBy('ecm_detequcom.descripcion')
            // use simplePaginate to avoid a heavy COUNT(*) with GROUP BY; adjust per-page as needed
            ->simplePaginate(6)
            ->withQueryString();

        // Pass only $registros as requested
        return view('consultas.software_equipo', ['registros' => $query]);
    }

    /**
     * List each installed software and the computer where it is found.
     *
     * Produces a collection `$registros` with the exact columns:
     * - software: nombre_software (from `software`)
     * - equipo: descripcion (from `ecm_detequcom`)
     * - no_serie: no_serie (from `entradasdetalle`)
     * - lugar: nombre_espacio (from `espacios_trabajo`)
     *
     * Note: Uses only existing tables and relations (no migrations added).
     */
    public function porSoftwareInstalado(Request $request)
    {
        $filtro = $request->input('filtro_software');

        $registros = DB::table('software')
            ->join('espacios_trabajo', 'software.id_espacio', '=', 'espacios_trabajo.id_espacio')
            ->join('entradasdetalle', 'entradasdetalle.id_espaciotrabajo', '=', 'espacios_trabajo.id_espacio')
            ->join('ecm_detequcom', 'entradasdetalle.id_ecm_dete', '=', 'ecm_detequcom.id')
            ->whereNotNull('entradasdetalle.id_ecm_dete')
            ->select(
                'software.nombre_software as software',
                'ecm_detequcom.descripcion as equipo',
                'entradasdetalle.no_serie as no_serie',
                'espacios_trabajo.nombre_espacio as lugar'
            )
            ->when($filtro, function ($q, $filtro) {
                $q->where('software.nombre_software', 'like', "%{$filtro}%")
                  ->orWhere('ecm_detequcom.descripcion', 'like', "%{$filtro}%")
                  ->orWhere('entradasdetalle.no_serie', 'like', "%{$filtro}%")
                  ->orWhere('espacios_trabajo.nombre_espacio', 'like', "%{$filtro}%");
            })
            ->distinct()
            ->orderBy('software.nombre_software')
            // paginate results to match other consultas (simple pagination)
            ->simplePaginate(6)
            ->withQueryString();

        return view('consultas.software_instalado', ['registros' => $registros]);
    }

    /**
     * Por Grupos que solicitaron el Software.
     *
     * Returns a collection (paginated) with columns:
     * - periodo
     * - materia
     * - maestro
     * - software
     * - no_serie
     *
     * Uses existing tables only: grupos, periodos, materias, personals, software_materias, software,
     * grupos_labs and entradasdetalle to obtain the equipment serial number.
     */
    public function porGrupos(Request $request)
    {
        $filtro = $request->input('filtro_grupos');

        $query = DB::table('grupos')
            ->join('periodos', 'grupos.id_periodo', '=', 'periodos.id')
            ->join('materias', 'grupos.id_materia', '=', 'materias.id')
            ->join('personals', 'grupos.id_personal', '=', 'personals.id')
            ->join('software_materias', 'software_materias.id_materia', '=', 'materias.id')
            ->join('software', 'software.id_software', '=', 'software_materias.id_software')
            ->leftJoin('grupos_labs', 'grupos_labs.id_grupo', '=', 'grupos.id')
            ->leftJoin('entradasdetalle', 'entradasdetalle.id_espaciotrabajo', '=', 'grupos_labs.id_espacio')
            ->whereNotNull('software.id_software')
            ->select(
                'periodos.nombre as periodo',
                'materias.nombre as materia',
                DB::raw("CONCAT(personals.nombre, ' ', personals.apellido_pat, ' ', personals.apellido_mat) as maestro"),
                'software.nombre_software as software',
                'entradasdetalle.no_serie as no_serie'
            )
            ->when($filtro, function ($q, $filtro) {
                $q->where('periodos.nombre', 'like', "%{$filtro}%")
                  ->orWhere('materias.nombre', 'like', "%{$filtro}%")
                  ->orWhere('personals.nombre', 'like', "%{$filtro}%")
                  ->orWhere('software.nombre_software', 'like', "%{$filtro}%")
                  ->orWhere('entradasdetalle.no_serie', 'like', "%{$filtro}%");
            })
            ->distinct()
            ->orderBy('periodos.nombre')
            ->simplePaginate(6)
            ->withQueryString();

        return view('consultas.grupos_software', ['registros' => $query]);
    }

    /**
     * Por Carreras que solicitaron el Software.
     *
     * Returns a collection (paginated) with columns:
     * - periodo
     * - carrera
     * - materia
     * - maestro
     * - software
     * - no_serie
     *
     * Uses existing tables only: grupos, periodos, materias, personals, carreras,
     * software_materias, software, grupos_labs and entradasdetalle to obtain the equipment serial number.
     */
    public function porCarreras(Request $request)
    {
        $filtro = $request->input('filtro_carreras');

        $query = DB::table('grupos')
            ->join('periodos', 'grupos.id_periodo', '=', 'periodos.id')
            ->join('materias', 'grupos.id_materia', '=', 'materias.id')
            ->join('personals', 'grupos.id_personal', '=', 'personals.id')
            ->join('carreras', 'grupos.id_carrera', '=', 'carreras.id_carrera')
            ->join('software_materias', 'software_materias.id_materia', '=', 'materias.id')
            ->join('software', 'software.id_software', '=', 'software_materias.id_software')
            ->leftJoin('grupos_labs', 'grupos_labs.id_grupo', '=', 'grupos.id')
            ->leftJoin('entradasdetalle', 'entradasdetalle.id_espaciotrabajo', '=', 'grupos_labs.id_espacio')
            ->whereNotNull('software.id_software')
            ->select(
                'periodos.nombre as periodo',
                'carreras.nombre_carrera as carrera',
                'materias.nombre as materia',
                DB::raw("CONCAT(personals.nombre, ' ', personals.apellido_pat, ' ', personals.apellido_mat) as maestro"),
                'software.nombre_software as software',
                'entradasdetalle.no_serie as no_serie'
            )
            ->when($filtro, function ($q, $filtro) {
                $q->where('periodos.nombre', 'like', "%{$filtro}%")
                  ->orWhere('carreras.nombre_carrera', 'like', "%{$filtro}%")
                  ->orWhere('materias.nombre', 'like', "%{$filtro}%")
                  ->orWhere('personals.nombre', 'like', "%{$filtro}%")
                  ->orWhere('software.nombre_software', 'like', "%{$filtro}%")
                  ->orWhere('entradasdetalle.no_serie', 'like', "%{$filtro}%");
            })
            ->distinct()
            ->orderBy('periodos.nombre')
            ->simplePaginate(6)
            ->withQueryString();

        return view('consultas.carreras_software', ['registros' => $query]);
    }
}
