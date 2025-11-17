@extends('plantillas.login2')
@section('menu2')
    @include('menu2')
@endsection
@section('contenido2')
<div class="container mt-4">
    <h2>Crear Materia</h2>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('materias.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="clave" class="form-label">Clave</label>
            <input type="text" name="clave" id="clave" class="form-control" value="{{ old('clave') }}" maxlength="50" required>
        </div>

        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" name="nombre" id="nombre" class="form-control" value="{{ old('nombre') }}" maxlength="150" required>
        </div>

        <div class="mb-3">
            <label for="id_carrera" class="form-label">Carrera</label>
            <select name="id_carrera" id="id_carrera" class="form-select" required>
                <option value="">-- Seleccione --</option>
                @foreach($carreras as $id => $nombre)
                    <option value="{{ $id }}" {{ old('id_carrera') == $id ? 'selected' : '' }}>{{ $nombre }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-check mb-3">
            <input type="checkbox" name="requiere_lab" id="requiere_lab" class="form-check-input" value="1" {{ old('requiere_lab') ? 'checked' : '' }}>
            <label for="requiere_lab" class="form-check-label">Requiere laboratorio</label>
        </div>

        <div class="mb-3">
            <label for="tipo_uso" class="form-label">Tipo de uso</label>
            <input type="text" name="tipo_uso" id="tipo_uso" class="form-control" value="{{ old('tipo_uso') }}" maxlength="50">
        </div>

        <div class="mb-3">
            <label for="estatus" class="form-label">Estatus</label>
            <select name="estatus" id="estatus" class="form-select">
                <option value="activo" {{ old('estatus', 'activo') === 'activo' ? 'selected' : '' }}>Activo</option>
                <option value="inactivo" {{ old('estatus') === 'inactivo' ? 'selected' : '' }}>Inactivo</option>
            </select>
        </div>

        <div class="d-flex gap-2">
            <button class="btn btn-primary">Guardar</button>
            <a href="{{ route('materias.index') }}" class="btn btn-secondary">Cancelar</a>
        </div>
    </form>
</div>
@endsection