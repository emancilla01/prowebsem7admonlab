@extends('plantillas.login2')
@section('menu2')
    @include('menu2')
@endsection
@section('contenido2')

<div class="container mt-4">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header">Crear Software</div>

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

                    <form action="{{ route('software.store') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label">Nombre del software</label>
                            <input type="text" name="nombre_software" class="form-control" value="{{ old('nombre_software') }}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Versión</label>
                            <input type="text" name="version" class="form-control" value="{{ old('version') }}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Licencia</label>
                            <input type="text" name="licencia" class="form-control" value="{{ old('licencia') }}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Proveedor</label>
                            <input type="text" name="proveedor" class="form-control" value="{{ old('proveedor') }}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Fecha de instalación</label>
                            <input type="date" name="fecha_instalacion" class="form-control" value="{{ old('fecha_instalacion') }}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Espacio</label>
                            <select name="id_espacio" class="form-control">
                                <option value="">-- Ninguno --</option>
                                @foreach(\App\Models\EspacioTrabajo::all() as $esp)
                                    <option value="{{ $esp->id_espacio }}" {{ old('id_espacio') == $esp->id_espacio ? 'selected' : '' }}>{{ $esp->nombre_espacio }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('software.index') }}" class="btn btn-secondary">Cancelar</a>
                            <button class="btn btn-primary">Guardar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection