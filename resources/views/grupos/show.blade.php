@extends('plantillas.login2')
@section('menu2')
    @include('menu2')
@endsection
@section('contenido2')
<div class="container mt-4">
    <h2>Detalle de Grupo</h2>

    <div class="mb-3"><strong>ID:</strong> {{ $grupo->id }}</div>
    <div class="mb-3"><strong>Clave:</strong> {{ $grupo->clave_grupo }}</div>
    <div class="mb-3"><strong>Nombre:</strong> {{ $grupo->nombre_grupo }}</div>
    <div class="mb-3"><strong>Materia:</strong> {{ $grupo->materia?->nombre }}</div>
    <div class="mb-3"><strong>Periodo:</strong> {{ $grupo->periodo?->nombre }}</div>
    <div class="mb-3"><strong>Maestro:</strong> {{ $grupo->personal?->nombre }}</div>
    <div class="mb-3"><strong>Carrera:</strong> {{ $grupo->carrera?->nombre_carrera }}</div>
    <div class="mb-3"><strong>Turno:</strong> {{ $grupo->turno }}</div>
    <div class="mb-3"><strong>Estatus:</strong> {{ $grupo->estatus }}</div>

    <div class="d-flex gap-2">
        <a href="{{ route('grupos.edit', $grupo) }}" class="btn btn-primary">Editar</a>
        <a href="{{ route('grupos.index') }}" class="btn btn-secondary">Volver</a>
    </div>
</div>
@endsection
