@extends('plantillas.login2')
@include('menu2')

@section('contenido2')
    <div class="container">
        <h3>Consultas: Por Espacios de Trabajo</h3>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Espacio</th>
                    <th>descripción del Equipo de cómputo o Mobiliario</th>
                    <th class="text-right">Total Equipo</th>
                    <th class="text-right">Total Mobiliario</th>
                </tr>
            </thead>
            <tbody>
                @foreach($espaciosResumen as $esp)
                    <tr>
                        <td>{{ $esp->nombre }}</td>
                        <td>{{ $esp->descripcion }}</td>
                        <td class="text-right">{{ $esp->total_equipo }}</td>
                        <td class="text-right">{{ $esp->total_mobiliario }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>
    <div>
        {{ $espaciosResumen->links('pagination::bootstrap-5') }}
    </div>

@endsection
