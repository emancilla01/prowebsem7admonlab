@extends('plantillas.login2')
@section('menu2')
    @include('menu2')
@endsection
@section('contenido2')
<div class="container mt-4">
    <h2>Editar recurso ECM: {{ $ecm->codigo ?? '' }}</h2>

    <form action="{{ route('ecm_equcommob.update', $ecm->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="codigo" class="form-label">Código</label>
            <input type="text" id="codigo" name="codigo" class="form-control" value="{{ old('codigo', $ecm->codigo) }}" maxlength="50">
            @error('codigo') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label for="descripcion" class="form-label">Descripción</label>
            <input type="text" id="descripcion" name="descripcion" class="form-control" value="{{ old('descripcion', $ecm->descripcion) }}" maxlength="200">
            @error('descripcion') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label for="id_categoria" class="form-label">Categoría</label>
            <select id="id_categoria" name="id_categoria" class="form-select">
                @foreach($categorias as $id => $nombre)
                    <option value="{{ $id }}" {{ (old('id_categoria', $ecm->id_categoria) == $id) ? 'selected' : '' }}>{{ $nombre }}</option>
                @endforeach
            </select>
            @error('id_categoria') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label for="tipo" class="form-label">Tipo</label>
            <select id="tipo" name="tipo" class="form-select">
                <option value="equipo" {{ old('tipo', $ecm->tipo)=='equipo' ? 'selected' : '' }}>Equipo</option>
                <option value="mobiliario" {{ old('tipo', $ecm->tipo)=='mobiliario' ? 'selected' : '' }}>Mobiliario</option>
            </select>
            @error('tipo') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label for="estado" class="form-label">Estado</label>
            <select id="estado" name="estado" class="form-select">
                <option value="activo" {{ old('estado', $ecm->estado)=='activo' ? 'selected' : '' }}>Activo</option>
                <option value="baja" {{ old('estado', $ecm->estado)=='baja' ? 'selected' : '' }}>Baja</option>
                <option value="mtto" {{ old('estado', $ecm->estado)=='mtto' ? 'selected' : '' }}>Mantenimiento</option>
            </select>
            @error('estado') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label for="fecha_alta" class="form-label">Fecha de alta</label>
            <input type="date" id="fecha_alta" name="fecha_alta" class="form-control" value="{{ old('fecha_alta', $ecm->fecha_alta?->format('Y-m-d')) }}">
            @error('fecha_alta') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <a href="{{ route('ecm_equcommob.index') }}" class="btn btn-secondary">Cancelar</a>
        <button type="submit" class="btn btn-primary">Actualizar</button>
    </form>
</div>
@endsection