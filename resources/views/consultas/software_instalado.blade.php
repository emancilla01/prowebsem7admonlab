@extends('plantillas.login2')

@include('menu2')

@section('contenido2')

<div class="container mt-3">
    <h3>Listado de Software instalado</h3>

    <form method="GET" action="{{ route('consultas.software_instalado') }}" class="mb-3">
        <div class="input-group">
            <input type="search" name="filtro_software" value="{{ request('filtro_software') }}" class="form-control" placeholder="Buscar por software, equipo, o serial" aria-label="Buscar">
            <button class="btn btn-primary" type="submit">Buscar</button>
        </div>
    </form>

    <div class="table-responsive">
        <table class="table table-sm table-striped">
            <thead>
                <tr>
                    <th>Software</th>
                    <th>Equipo de Cómputo</th>
                    <th>No. Serie</th>
                    <th>Lugar</th>
                </tr>
            </thead>
            <tbody>
                @forelse($registros as $r)
                    <tr>
                        <td>{{ $r->software ?? '—' }}</td>
                        <td>{{ $r->equipo ?? '—' }}</td>
                        <td>{{ $r->no_serie ?? '—' }}</td>
                        <td>{{ $r->lugar ?? '—' }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4">No se encontraron registros.</td>
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
