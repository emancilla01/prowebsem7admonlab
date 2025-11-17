@extends('plantillas.login2')
@section('menu2')
    @include('menu2')
@endsection
@section('contenido2')
<div class="container mt-4">
    <h2>Detalle de Materia</h2>

    <div class="mb-3">
        <strong>ID:</strong> {{ $materia->id }}
    </div>
    <div class="mb-3">
        <strong>Clave:</strong> {{ $materia->clave }}
    </div>
    <div class="mb-3">
        <strong>Nombre:</strong> {{ $materia->nombre }}
    </div>
    <div class="mb-3">
        <strong>Carrera:</strong> {{ $materia->carrera?->nombre_carrera }}
    </div>
    <div class="mb-3">
        <strong>Requiere laboratorio:</strong> {{ $materia->requiere_lab ? 'Sí' : 'No' }}
    </div>
    <div class="mb-3">
        <strong>Tipo de uso:</strong> {{ $materia->tipo_uso }}</div>
    <div class="mb-3">
        <strong>Estatus:</strong> {{ $materia->estatus }}</div>
    <div class="mb-3">
        <strong>Creado:</strong> {{ $materia->created_at?->format('Y-m-d') }}</div>

    <div class="d-flex gap-2">
        <a href="{{ route('materias.edit', $materia) }}" class="btn btn-primary">Editar</a>
        <a href="{{ route('materias.index') }}" class="btn btn-secondary">Volver</a>
    </div>
</div>
@endsection
