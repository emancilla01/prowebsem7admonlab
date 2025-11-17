@extends('plantillas.login2')
@section('menu2')
    @include('menu2')
@endsection
@section('contenido2')
<div class="container mt-4">
    <h2>Detalle ECM: {{ $ecm->codigo ?? '' }}</h2>

    <div class="mb-3"><strong>Código:</strong> {{ $ecm->codigo }}</div>
    <div class="mb-3"><strong>Descripción:</strong> {{ $ecm->descripcion }}</div>
    <div class="mb-3"><strong>Categoría:</strong> {{ $ecm->categoria?->nombre }}</div>
    <div class="mb-3"><strong>Tipo:</strong> {{ $ecm->tipo }}</div>
    <div class="mb-3"><strong>Estado:</strong> {{ $ecm->estado }}</div>
    <div class="mb-3"><strong>Fecha de alta:</strong> {{ $ecm->fecha_alta }}</div>

    <div class="mt-3">
        @if(\Illuminate\Support\Facades\Route::has('ecm_detequcom.index'))
            <a href="{{ route('ecm_detequcom.index', ['id_ecm' => $ecm->id]) }}" class="btn btn-outline-primary">Ver equipo de cómputo</a>
        @endif
        @if(\Illuminate\Support\Facades\Route::has('ecm_detmob.index'))
            <a href="{{ route('ecm_detmob.index', ['id_ecm' => $ecm->id]) }}" class="btn btn-outline-secondary">Ver mobiliario</a>
        @endif
    </div>

    <div class="mt-3">
        <a href="{{ route('ecm_equcommob.index') }}" class="btn btn-secondary">Volver</a>
        <a href="{{ route('ecm_equcommob.edit', $ecm->id) }}" class="btn btn-primary">Editar</a>
    </div>
</div>
</div>

@endsection
