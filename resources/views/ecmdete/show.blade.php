@extends('plantillas.login2')
@section('menu2')
    @include('menu2')
@endsection
@section('contenido2')
<div class="container mt-4">
    <h2>Detalle equipo</h2>

    <div class="mb-3"><strong>ID:</strong> {{ $item->id }}</div>
    <div class="mb-3"><strong>Serial:</strong> {{ $item->serial }}</div>
    <div class="mb-3"><strong>Modelo:</strong> {{ $item->modelo }}</div>
    <div class="mb-3"><strong>Marca:</strong> {{ $item->marca }}</div>
    <div class="mb-3"><strong>Descripción:</strong> {{ $item->descripcion }}</div>
    <div class="mb-3"><strong>Estado:</strong> {{ $item->estado }}</div>
    <div class="mb-3"><strong>Fecha adquisición:</strong> {{ $item->fecha_adquisicion }}</div>
    <div class="mb-3"><strong>Ubicación:</strong> {{ $item->ubicacion }}</div>

    <div class="mb-3"><strong>Espacio:</strong> {{ $item->espacio?->nombre_espacio }}</div>

    <div class="mt-3">
        <a href="{{ route('ecm_detequcom.index', ['id_ecm' => $item->id_ecm]) }}" class="btn btn-secondary">Volver</a>
        <a href="{{ route('ecm_detequcom.edit', $item->id) }}" class="btn btn-primary">Editar</a>
    </div>
</div>

@endsection
