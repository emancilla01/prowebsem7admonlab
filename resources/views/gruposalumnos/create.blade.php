@extends('plantillas.login2')
@section('menu2')
    @include('menu2')
@endsection
@section('contenido2')
<div class="container mt-4">
    <h2>Agregar alumno al grupo: {{ $grupo->nombre_grupo ?? '' }}</h2>

    <form action="{{ route('grupos.alumnos.store', $grupo ?? 0) }}" method="POST">
        @csrf
        <input type="hidden" name="id_grupo" value="{{ $grupo->id ?? '' }}">

        <div class="mb-3">
            <label for="matricula" class="form-label">Matrícula</label>
            <input type="text" class="form-control" id="matricula" name="matricula" value="{{ old('matricula') }}" maxlength="30">
            @error('matricula') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label for="nombre_alumno" class="form-label">Nombre del alumno</label>
            <input type="text" class="form-control" id="nombre_alumno" name="nombre_alumno" value="{{ old('nombre_alumno') }}" maxlength="150">
            @error('nombre_alumno') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <a href="{{ route('grupos.alumnos.index', $grupo ?? 0) }}" class="btn btn-secondary">Cancelar</a>
        <button type="submit" class="btn btn-primary">Guardar</button>
    </form>
</div>
@endsection