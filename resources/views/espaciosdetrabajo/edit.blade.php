@extends('plantillas.login2')
@section('menu2')
    @include('menu2')
@endsection
@section('contenido2')

<div class="container mt-4">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header">Editar Espacio de trabajo</div>

                <div class="card-body">
                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('espaciosdetrabajo.update', $espacio) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label class="form-label">Nombre del espacio</label>
                            <input type="text" name="nombre_espacio" class="form-control" value="{{ old('nombre_espacio', $espacio->nombre_espacio) }}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Tipo de espacio</label>
                            <input type="text" name="tipo_espacio" class="form-control" value="{{ old('tipo_espacio', $espacio->tipo_espacio) }}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Ubicación</label>
                            <input type="text" name="ubicacion" class="form-control" value="{{ old('ubicacion', $espacio->ubicacion) }}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Capacidad</label>
                            <input type="number" name="capacidad" class="form-control" value="{{ old('capacidad', $espacio->capacidad) }}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Responsable</label>
                            <input type="text" name="responsable" class="form-control" value="{{ old('responsable', $espacio->responsable) }}">
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('espaciosdetrabajo.index') }}" class="btn btn-secondary">Cancelar</a>
                            <button class="btn btn-primary">Actualizar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection