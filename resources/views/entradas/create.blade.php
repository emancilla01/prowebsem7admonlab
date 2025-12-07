@extends('plantillas.login2')
@section('menu2')
    @include('menu2')
@endsection
@section('contenido2')
<h2>Nuevo Registro de Entrada</h2>

@if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('entradas.store') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label for="fecha" class="form-label">Fecha</label>
        <input type="date" class="form-control" id="fecha" name="fecha" value="{{ old('fecha') }}" required>
    </div>

    <div class="mb-3">
        <label for="hora" class="form-label">Hora</label>
        <input type="time" class="form-control" id="hora" name="hora" value="{{ old('hora') }}" required>
    </div>

    <div class="mb-3">
        <label for="quien_envio" class="form-label">Quien envió</label>
        <input type="text" class="form-control" id="quien_envio" name="quien_envio" maxlength="100" value="{{ old('quien_envio') }}" required>
    </div>

    <div class="mb-3">
        <label for="quien_recibio" class="form-label">Quien recibió</label>
        <input type="text" class="form-control" id="quien_recibio" name="quien_recibio" maxlength="100" value="{{ old('quien_recibio') }}" required>
    </div>

    <div class="mb-3">
        <label for="lugar" class="form-label">Lugar</label>
        <input type="text" class="form-control" id="lugar" name="lugar" maxlength="150" value="{{ old('lugar') }}" required>
    </div>

    <button type="submit" class="btn btn-primary">Guardar</button>
    <a href="{{ route('entradas.index') }}" class="btn btn-secondary">Cancelar</a>
</form>
@endsection