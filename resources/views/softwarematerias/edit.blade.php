@extends('plantillas.login2')
@section('menu2')
    @include('menu2')
@endsection
@section('contenido2')
<div class="container mt-4">
    <h2>Editar relación #{{ $item->id }}</h2>

    <form action="{{ route('software.materias.update', $item->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="id_software" class="form-label">Software</label>
            <select id="id_software" name="id_software" class="form-select">
                <option value="">-- Seleccionar --</option>
                @foreach($softwares as $id => $nombre)
                    <option value="{{ $id }}" {{ (old('id_software', $item->id_software) == $id) ? 'selected' : '' }}>{{ $nombre }}</option>
                @endforeach
            </select>
            @error('id_software') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label for="id_materia" class="form-label">Materia</label>
            <select id="id_materia" name="id_materia" class="form-select">
                <option value="">-- Seleccionar --</option>
                @foreach($materias as $id => $nombre)
                    <option value="{{ $id }}" {{ (old('id_materia', $item->id_materia) == $id) ? 'selected' : '' }}>{{ $nombre }}</option>
                @endforeach
            </select>
            @error('id_materia') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label for="observaciones" class="form-label">Observaciones</label>
            <textarea id="observaciones" name="observaciones" class="form-control">{{ old('observaciones', $item->observaciones) }}</textarea>
            @error('observaciones') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <a href="{{ route('software.materias.index', ['software' => $item->id_software]) }}" class="btn btn-secondary">Cancelar</a>
        <button type="submit" class="btn btn-primary">Actualizar</button>
    </form>
</div>

@endsection