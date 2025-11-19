@extends('plantillas.login2')
@section('menu2')
    @include('menu2')
@endsection
@section('contenido2')
<div class="container mt-4">
    <h2>Detalle relación #{{ $item->id }}</h2>

    <div class="mb-3"><strong>Software:</strong> {{ $item->software?->nombre_software }} @if($item->software?->version) (v{{ $item->software->version }}) @endif</div>
    <div class="mb-3"><strong>Materia:</strong> {{ $item->materia?->nombre }} ({{ $item->materia?->clave }})</div>
    <div class="mb-3"><strong>Observaciones:</strong> {{ $item->observaciones }}</div>

    <div class="mt-3">
        <a href="{{ route('software.materias.index', ['software' => $item->id_software]) }}" class="btn btn-secondary">Volver a lista filtrada</a>
        <a href="{{ route('software.materias.edit', $item) }}" class="btn btn-primary">Editar</a>
    </div>
</div>

@endsection
