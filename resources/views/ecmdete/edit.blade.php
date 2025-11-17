@extends('plantillas.login2')
@section('menu2')
    @include('menu2')
@endsection
@section('contenido2')
<div class="container mt-4">
    <h2>Editar equipo #{{ $item->id }}</h2>

    <form action="{{ route('ecm_detequcom.update', $item->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="serial" class="form-label">Serial</label>
            <input type="text" id="serial" name="serial" class="form-control" value="{{ old('serial', $item->serial) }}">
            @error('serial') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label for="id_espacio" class="form-label">Espacio</label>
            <select id="id_espacio" name="id_espacio" class="form-select">
                <option value="">-- Seleccionar --</option>
                @foreach($espacios as $id => $nombre)
                    <option value="{{ $id }}" {{ old('id_espacio', $item->id_espacio)==$id ? 'selected' : '' }}>{{ $nombre }}</option>
                @endforeach
            </select>
            @error('id_espacio') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label for="modelo" class="form-label">Modelo</label>
            <input type="text" id="modelo" name="modelo" class="form-control" value="{{ old('modelo', $item->modelo) }}">
            @error('modelo') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label for="marca" class="form-label">Marca</label>
            <input type="text" id="marca" name="marca" class="form-control" value="{{ old('marca', $item->marca) }}">
            @error('marca') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label for="descripcion" class="form-label">Descripción</label>
            <input type="text" id="descripcion" name="descripcion" class="form-control" value="{{ old('descripcion', $item->descripcion) }}">
            @error('descripcion') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label for="estado" class="form-label">Estado</label>
            <select id="estado" name="estado" class="form-select">
                <option value="activo" {{ old('estado', $item->estado)=='activo' ? 'selected' : '' }}>Activo</option>
                <option value="baja" {{ old('estado', $item->estado)=='baja' ? 'selected' : '' }}>Baja</option>
                <option value="mtto" {{ old('estado', $item->estado)=='mtto' ? 'selected' : '' }}>Mantenimiento</option>
            </select>
            @error('estado') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label for="fecha_adquisicion" class="form-label">Fecha de adquisición</label>
            <input type="date" id="fecha_adquisicion" name="fecha_adquisicion" class="form-control" value="{{ old('fecha_adquisicion', $item->fecha_adquisicion?->format('Y-m-d')) }}">
            @error('fecha_adquisicion') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label for="ubicacion" class="form-label">Ubicación</label>
            <input type="text" id="ubicacion" name="ubicacion" class="form-control" value="{{ old('ubicacion', $item->ubicacion) }}">
            @error('ubicacion') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <a href="{{ route('ecm_detequcom.index', ['id_ecm' => $item->id_ecm]) }}" class="btn btn-secondary">Cancelar</a>
        <button type="submit" class="btn btn-primary">Actualizar</button>
    </form>
</div>

@endsection