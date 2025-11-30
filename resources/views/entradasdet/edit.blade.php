@extends('plantillas.login2')
@section('menu2')
    @include('menu2')
@endsection
@section('contenido2')

<h2>Editar Detalle #{{ $detalle->id }}</h2>

@if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@php
    $ecmDetes = \App\Models\EcmDetequcom::pluck('serial','id');
    $ecmDetms = \App\Models\EcmDetmob::pluck('codigo','id');
@endphp

<form action="{{ route('entradas.detalle.update', [$entrada, $detalle]) }}" method="POST">
    @csrf
    @method('PUT')
    @php
        $ecmDetes = \App\Models\EcmDetequcom::pluck('serial','id');
        $ecmDetms = \App\Models\EcmDetmob::pluck('codigo','id');
        $espacios = \App\Models\EspacioTrabajo::pluck('nombre_espacio','id_espacio');
    @endphp

    <div class="mb-3">
        <label for="id_ecm_dete" class="form-label">ID equipo de cómputo</label>
        <select name="id_ecm_dete" id="id_ecm_dete" class="form-select">
            <option value="">-- Ninguno --</option>
            @foreach($ecmDetes as $id => $label)
                <option value="{{ $id }}" {{ old('id_ecm_dete', $detalle->id_ecm_dete) == $id ? 'selected' : '' }}>{{ $label }}</option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label for="id_ecm_detm" class="form-label">ID mobiliario</label>
        <select name="id_ecm_detm" id="id_ecm_detm" class="form-select">
            <option value="">-- Ninguno --</option>
            @foreach($ecmDetms as $id => $label)
                <option value="{{ $id }}" {{ old('id_ecm_detm', $detalle->id_ecm_detm) == $id ? 'selected' : '' }}>{{ $label }}</option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label for="no_serie" class="form-label">No. Serie</label>
        <input type="text" name="no_serie" id="no_serie" class="form-control" maxlength="100" value="{{ old('no_serie', $detalle->no_serie) }}" required>
    </div>

    <div class="mb-3">
        <label for="id_espaciotrabajo" class="form-label">Espacio de Trabajo</label>
        <select name="id_espaciotrabajo" id="id_espaciotrabajo" class="form-select" required>
            @foreach($espacios as $id => $label)
                <option value="{{ $id }}" {{ old('id_espaciotrabajo', $detalle->id_espaciotrabajo) == $id ? 'selected' : '' }}>{{ $label }}</option>
            @endforeach
        </select>
    </div>

    <div class="d-flex gap-2">
        <button type="submit" class="btn btn-primary">Guardar</button>
        <a href="{{ route('entradas.detalle.index', $entrada) }}" class="btn btn-secondary">Cancelar</a>
    </div>

</form>

<div class="mt-3">
    <form action="{{ route('entradas.detalle.destroy', [$entrada, $detalle]) }}" method="POST" onsubmit="return confirm('¿Eliminar este detalle?');">
        @csrf
        @method('DELETE')
        <button class="btn btn-danger">Eliminar</button>
    </form>
</div>

@endsection