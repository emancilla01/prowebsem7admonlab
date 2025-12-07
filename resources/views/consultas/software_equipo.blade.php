@extends('plantillas.login2')

@include('menu2')

@section('contenido2')

<div class="container mt-3">
    <h3>Software instalado por Equipo de cómputo</h3>

    <form method="GET" action="{{ route('consultas.software_equipo') }}" class="mb-3">
        <div class="input-group">
            <input type="search" name="filtro_equipo" value="{{ request('filtro_equipo') }}" class="form-control" placeholder="Buscar por equipo o serial" aria-label="Buscar por equipo o serial">
            <button class="btn btn-primary" type="submit">Buscar</button>
        </div>
    </form>

    <div class="table-responsive">
        <table class="table table-sm table-striped">
            <thead>
                <tr>
                    <th>Equipo de Cómputo</th>
                    <th>No. Serie</th>
                    <th>Procesador</th>
                    <th>Memoria RAM</th>
                    <th>Almacenamiento (HD)</th>
                    <th>Resolución de pantalla</th>
                    <th>Pantalla táctil</th>
                    <th>Software instalado</th>
                </tr>
            </thead>
            <tbody>
                @forelse($registros as $r)
                    <tr>
                        <td>{{ $r->equipo ?? '—' }}</td>
                        <td>{{ $r->no_serie ?? '—' }}</td>
                        <td>{{ $r->procesador ?? '—' }}</td>
                        <td>{{ $r->memoria_ram ?? '—' }}</td>
                        <td>{{ $r->almacenamiento_hd ?? '—' }}</td>
                        <td>{{ $r->resolucion_pantalla ?? '—' }}</td>
                        <td>{{ $r->pantalla_tactil ?? '—' }}</td>
                        <td>{{ $r->software_instalado ?? '—' }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8">No se encontraron registros.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>

    <div class="d-flex justify-content-center mt-2">
        {{ $registros->links() }}
    </div>

@endsection
