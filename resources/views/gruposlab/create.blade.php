@extends('plantillas.login2')
@section('menu2')
    @include('menu2')
@endsection
@section('contenido2')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Agregar laboratorio a: {{ $grupo->nombre_grupo ?? '' }}</h2>
        <a href="{{ route('grupos.labs.index', $grupo ?? 0) }}" class="btn btn-secondary">Volver</a>
    </div>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('grupos.labs.store', $grupo) }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="id_espacio" class="form-label">Espacio</label>
            <select name="id_espacio" id="id_espacio" class="form-select" required>
                <option value="">-- Seleccionar --</option>
                @if(isset($espacios) && is_array($espacios) || $espacios instanceof \Illuminate\Support\Collection)
                    @foreach($espacios as $id => $nombre)
                        <option value="{{ $id }}" {{ old('id_espacio') == $id ? 'selected' : '' }}>{{ $nombre }}</option>
                    @endforeach
                @endif
            </select>
        </div>

        <div class="mb-3">
            <label for="horario" class="form-label">Horario</label>
            <input type="text" name="horario" id="horario" class="form-control" value="{{ old('horario') }}" placeholder="Lun-Mie 8:00-9:30">
        </div>

        <button class="btn btn-primary">Guardar</button>
    </form>
</div>
@endsection