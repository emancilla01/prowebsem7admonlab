@extends('plantillas.login2')
@section('menu2')
    @include('menu2')
@endsection
@section('contenido2')
<div class="container mt-4">
    <h2>Nuevo mobiliario (ECM: {{ $id_ecm ?? '-' }})</h2>

    <form action="{{ route('ecm_detmob.store') }}" method="POST">
        @csrf
        <input type="hidden" name="id_ecm" value="{{ $id_ecm }}">

        <div class="mb-3">
            <label for="codigo" class="form-label">Código</label>
            <input type="text" id="codigo" name="codigo" class="form-control" value="{{ old('codigo') }}">
            @error('codigo') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label for="descripcion" class="form-label">Descripción</label>
            <input type="text" id="descripcion" name="descripcion" class="form-control" value="{{ old('descripcion') }}">
            @error('descripcion') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label for="material" class="form-label">Material</label>
            <input type="text" id="material" name="material" class="form-control" value="{{ old('material') }}">
            @error('material') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label for="estado" class="form-label">Estado</label>
            <select id="estado" name="estado" class="form-select">
                <option value="activo" {{ old('estado')=='activo' ? 'selected' : '' }}>Activo</option>
                <option value="baja" {{ old('estado')=='baja' ? 'selected' : '' }}>Baja</option>
                <option value="mtto" {{ old('estado')=='mtto' ? 'selected' : '' }}>Mantenimiento</option>
            </select>
            @error('estado') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label for="fecha_adquisicion" class="form-label">Fecha de adquisición</label>
            <input type="date" id="fecha_adquisicion" name="fecha_adquisicion" class="form-control" value="{{ old('fecha_adquisicion') }}">
            @error('fecha_adquisicion') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label for="ubicacion" class="form-label">Ubicación</label>
            <input type="text" id="ubicacion" name="ubicacion" class="form-control" value="{{ old('ubicacion') }}">
            @error('ubicacion') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label for="id_espacio" class="form-label">Espacio</label>
            <select id="id_espacio" name="id_espacio" class="form-select">
                @foreach($espacios as $id => $nombre)
                    <option value="{{ $id }}" {{ old('id_espacio') == $id ? 'selected' : '' }}>{{ $nombre }}</option>
                @endforeach
            </select>
            @error('id_espacio') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <a href="{{ route('ecm_detmob.index', ['id_ecm' => $id_ecm]) }}" class="btn btn-secondary">Cancelar</a>
        <button type="submit" class="btn btn-primary">Crear</button>
    </form>
</div>

@endsection