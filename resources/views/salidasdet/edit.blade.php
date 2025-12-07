@extends('plantillas.login2')
@section('menu2')
    @include('menu2')
@endsection
@section('contenido2')
<h2>Editar detalle de Salida #{{ $salida->id }} — Detalle #{{ $detalle->id }}</h2>

@if($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form method="POST" action="{{ route('salidas.detalle.update', [$salida, $detalle]) }}">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label for="motivo_de_salida" class="form-label">Motivo de salida</label>
        <input id="motivo_de_salida" name="motivo_de_salida" type="text" class="form-control" value="{{ old('motivo_de_salida', $detalle->motivo_de_salida) }}" required maxlength="255">
    </div>

    <div class="d-flex gap-2">
        <a href="{{ route('salidas.detalle.index', $salida) }}" class="btn btn-outline-secondary">Cancelar</a>
        <button class="btn btn-primary" type="submit">Guardar</button>
    </div>
</form>
@endsection