@extends('plantillas.login2')
@section('menu2')
    @include('menu2')
@endsection
@section('contenido2')

<h2>Agregar detalle a Salida #{{ $salida->id }}</h2>

@if($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form method="POST" action="{{ route('salidas.detalle.store', $salida) }}">
    @csrf

    <div class="mb-3">
        <label for="id_entradadetalle" class="form-label">Entrada (No. Serie)</label>
        <select name="id_entradadetalle" id="id_entradadetalle" class="form-select" required>
            <option value="">-- Seleccionar --</option>
            @foreach($entradas as $entrada)
                <option value="{{ $entrada->id }}" {{ old('id_entradadetalle') == $entrada->id ? 'selected' : '' }}>
                    {{ $entrada->no_serie ?? "#{$entrada->id}" }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label for="motivo_de_salida" class="form-label">Motivo de salida</label>
        <input id="motivo_de_salida" name="motivo_de_salida" type="text" class="form-control" value="{{ old('motivo_de_salida') }}" required maxlength="255">
    </div>

    <div class="d-flex gap-2">
        <a href="{{ route('salidas.detalle.index', $salida) }}" class="btn btn-outline-secondary">Cancelar</a>
        <button class="btn btn-primary" type="submit">Guardar</button>
    </div>
</form>

@endsection