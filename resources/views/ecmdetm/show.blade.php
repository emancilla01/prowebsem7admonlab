@extends('plantillas.login2')
@section('menu2')
    @include('menu2')
@endsection
@section('contenido2')
<div class="container mt-4">
    <h2>Detalle mobiliario</h2>

    <div class="mb-3"><strong>ID:</strong> {{ $item->id }}</div>
    <div class="mb-3"><strong>Código:</strong> {{ $item->codigo }}</div>
    <div class="mb-3"><strong>Descripción:</strong> {{ $item->descripcion }}</div>
    <div class="mb-3"><strong>Material:</strong> {{ $item->material }}</div>
    <div class="mb-3"><strong>Estado:</strong> {{ $item->estado }}</div>
    <div class="mb-3"><strong>Fecha adquisición:</strong> {{ $item->fecha_adquisicion }}</div>
    <div class="mb-3"><strong>Ubicación:</strong> {{ $item->ubicacion }}</div>

    <div class="mt-3">
        <a href="{{ route('ecm_detmob.index', ['id_ecm' => $item->id_ecm]) }}" class="btn btn-secondary">Volver</a>
        <a href="{{ route('ecm_detmob.edit', $item->id) }}" class="btn btn-primary">Editar</a>
    </div>
</div>

@endsection
