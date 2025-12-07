@extends('plantillas.login2')

@section('menu2')
    @include('menu2')
@endsection

@section('contenido2')

<div class="container mt-3">
    <h3>Por Carreras que solicitaron el Software</h3>

    <div class="table-responsive">
        <table class="table table-sm table-striped">
            <thead>
                <tr>
                    <th>Periodo</th>
                    <th>Carrera</th>
                    <th>Materia</th>
                    <th>Maestro</th>
                    <th>Software</th>
                    <th>No serie del Eqi. Comp</th>
                </tr>
            </thead>
            <tbody>
                @forelse($registros as $item)
                    <tr>
                        <td>{{ $item->periodo ?? '—' }}</td>
                        <td>{{ $item->carrera ?? '—' }}</td>
                        <td>{{ $item->materia ?? '—' }}</td>
                        <td>{{ $item->maestro ?? '—' }}</td>
                        <td>{{ $item->software ?? '—' }}</td>
                        <td>{{ $item->no_serie ?? '—' }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6">No se encontraron registros.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="d-flex justify-content-center mt-2">
        {{ $registros->links() }}
    </div>

</div>

@endsection
