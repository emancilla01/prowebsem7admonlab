@extends('plantillas.login2')
@section('menu2')
    @include('menu2')
@endsection
@section('contenido2')

<h2>Consulta por categoría</h2>

<div class="table-responsive">
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Categoría</th>
                <th>Descripción del Equipo de cómputo o Mobiliario</th>
                <th>Total de Equipo de Cómputo</th>
                <th>Total de Mobiliario</th>
            </tr>
        </thead>
        <tbody>
            @forelse($results as $row)
                <tr>
                    <td>{{ $row->nombre }}</td>
                    <td>{{ $row->descripcion ?? '—' }}</td>
                    <td>{{ $row->total_equipo ?? 0 }}</td>
                    <td>{{ $row->total_mobiliario ?? 0 }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4">No hay datos disponibles.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection
