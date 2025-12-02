@extends('plantillas.login2')
@section('menu2')
    @include('menu2')
@endsection
@section('contenido2')

<h2>Consulta por Personal</h2>

<div class="table-responsive">
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Personal</th>
                <th>Descripción del equipo de cómputo o mobiliario</th>
                <th>Total de Equipo de Cómputo</th>
                <th>Total de Mobiliario</th>
            </tr>
        </thead>
        <tbody>
            @forelse($personalResumen as $p)
                <tr>
                    <td>{{ $p->nombre }}</td>
                    <td>{{ $p->descripcion ?? '—' }}</td>
                    <td>{{ $p->total_equipo ?? 0 }}</td>
                    <td>{{ $p->total_mobiliario ?? 0 }}</td>
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
