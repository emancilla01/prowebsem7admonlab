@extends('plantillas.login2')
@section('menu2')
    @include('menu2')
@endsection
@section('contenido2')
<div class="container mt-4">
    <h2>Editar Grupo</h2>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('grupos.update', $grupo) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="clave_grupo" class="form-label">Clave</label>
            <input type="text" name="clave_grupo" id="clave_grupo" class="form-control" value="{{ old('clave_grupo', $grupo->clave_grupo) }}" maxlength="50" required>
        </div>

        <div class="mb-3">
            <label for="nombre_grupo" class="form-label">Nombre</label>
            <input type="text" name="nombre_grupo" id="nombre_grupo" class="form-control" value="{{ old('nombre_grupo', $grupo->nombre_grupo) }}" maxlength="100" required>
        </div>

        <div class="mb-3">
            <label for="id_materia" class="form-label">Materia</label>
            <select name="id_materia" id="id_materia" class="form-select" required>
                <option value="">-- Seleccione --</option>
                @foreach($materias as $id => $nombre)
                    <option value="{{ $id }}" {{ old('id_materia', $grupo->id_materia) == $id ? 'selected' : '' }}>{{ $nombre }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="id_periodo" class="form-label">Periodo</label>
            <select name="id_periodo" id="id_periodo" class="form-select" required>
                <option value="">-- Seleccione --</option>
                @foreach($periodos as $id => $nombre)
                    <option value="{{ $id }}" {{ old('id_periodo', $grupo->id_periodo) == $id ? 'selected' : '' }}>{{ $nombre }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="id_personal" class="form-label">Maestro</label>
            <select name="id_personal" id="id_personal" class="form-select" required>
                <option value="">-- Seleccione --</option>
                @foreach($personals as $id => $nombre)
                    <option value="{{ $id }}" {{ old('id_personal', $grupo->id_personal) == $id ? 'selected' : '' }}>{{ $nombre }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="id_carrera" class="form-label">Carrera</label>
            <select name="id_carrera" id="id_carrera" class="form-select" required>
                <option value="">-- Seleccione --</option>
                @foreach($carreras as $id => $nombre)
                    <option value="{{ $id }}" {{ old('id_carrera', $grupo->id_carrera) == $id ? 'selected' : '' }}>{{ $nombre }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="turno" class="form-label">Turno</label>
            <input type="text" name="turno" id="turno" class="form-control" value="{{ old('turno', $grupo->turno) }}" maxlength="20">
        </div>

        <div class="mb-3">
            <label for="estatus" class="form-label">Estatus</label>
            <select name="estatus" id="estatus" class="form-select" required>
                <option value="activo" {{ old('estatus', $grupo->estatus) === 'activo' ? 'selected' : '' }}>Activo</option>
                <option value="cerrado" {{ old('estatus', $grupo->estatus) === 'cerrado' ? 'selected' : '' }}>Cerrado</option>
            </select>
        </div>

        <div class="d-flex gap-2">
            <button class="btn btn-primary">Actualizar</button>
            <a href="{{ route('grupos.index') }}" class="btn btn-secondary">Cancelar</a>
        </div>
    </form>
</div>
@endsection