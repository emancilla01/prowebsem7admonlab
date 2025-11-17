@extends('plantillas.login2')
@section('menu2')
    @include('menu2')
@endsection
@section('contenido2')

<div class="container mt-4">
    <h2>Detalle del alumno</h2>

    <div class="mb-3">
        <strong>ID:</strong> {{ $alumno->id }}
    </div>
    <div class="mb-3">
        <strong>Grupo:</strong> {{ $grupo->nombre_grupo ?? $alumno->grupo?->nombre_grupo }}
    </div>
    <div class="mb-3">
        <strong>Nombre:</strong> {{ $alumno->nombre_alumno }}
    </div>
    <div class="mb-3">
        <strong>Matrícula:</strong> {{ $alumno->matricula }}
    </div>

    <a href="{{ route('grupos.alumnos.index', $grupo ?? ($alumno->grupo ?? 0)) }}" class="btn btn-secondary">Volver</a>
    <a href="{{ route('alumnos.edit', $alumno) }}" class="btn btn-primary">Editar</a>
</div>

@endsection
