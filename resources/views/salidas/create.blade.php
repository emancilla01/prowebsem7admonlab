@extends('plantillas.login2')
@section('menu2')
    @include('menu2')
@endsection
@section('contenido2')

<h2>Nueva Salida</h2>

@if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('salidas.store') }}" method="POST">
    @csrf

    <div class="mb-3">
        <label for="fecha" class="form-label">Fecha</label>
        <input type="date" name="fecha" id="fecha" class="form-control" value="{{ old('fecha') }}" required>
    </div>

    <div class="mb-3">
        <label for="hora" class="form-label">Hora</label>
        <input type="time" name="hora" id="hora" class="form-control" value="{{ old('hora') }}" required>
    </div>

    <div class="mb-3">
        <label for="quien_autorizo" class="form-label">Quien autorizó</label>
        <input type="text" name="quien_autorizo" id="quien_autorizo" class="form-control" maxlength="100" value="{{ old('quien_autorizo') }}" required>
    </div>

    <div class="mb-3">
        <label for="quien_registro" class="form-label">Quien registró</label>
        <input type="text" name="quien_registro" id="quien_registro" class="form-control" maxlength="100" value="{{ old('quien_registro') }}" required>
    </div>

    <button type="submit" class="btn btn-primary">Guardar</button>
    <a href="{{ route('salidas.index') }}" class="btn btn-secondary">Cancelar</a>
</form>

@endsection