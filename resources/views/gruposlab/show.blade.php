@extends('plantillas.login2')
@section('menu2')
    @include('menu2')
@endsection
@section('contenido2')

<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Detalle - Laboratorio #{{ $lab->id }}</h2>
        <div>
            <a href="{{ route('labs.edit', $lab) }}" class="btn btn-sm btn-outline-primary">✏️ Editar</a>
            <form action="{{ route('labs.destroy', $lab) }}" method="POST" style="display:inline" onsubmit="return confirm('¿Eliminar este registro?');">
                @csrf
                @method('DELETE')
                <button class="btn btn-sm btn-danger">🗑️</button>
            </form>
            <a href="{{ route('grupos.labs.index', $grupo ?? ($lab->grupo ?? null)) }}" class="btn btn-sm btn-secondary">Volver</a>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <p><strong>ID:</strong> {{ $lab->id }}</p>
            <p><strong>Grupo:</strong> {{ $grupo->nombre_grupo ?? $lab->grupo?->nombre_grupo }}</p>
            <p><strong>Espacio:</strong> {{ $lab->espacio?->nombre_espacio }}</p>
            <p><strong>Horario:</strong> {{ $lab->horario ?? '-' }}</p>
            <p><strong>Creado:</strong> {{ $lab->created_at?->format('Y-m-d H:i') }}</p>
            <p><strong>Actualizado:</strong> {{ $lab->updated_at?->format('Y-m-d H:i') }}</p>
        </div>
    </div>

@endsection
