@extends('plantillas.login2')
@section('menu2')
    @include('menu2')
@endsection
@section('contenido2')
<div class="container mt-4">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header">Crear Carrera</div>

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

                    <form action="{{ route('carreras.store') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label">Nombre de la carrera</label>
                            <input type="text" name="nombre_carrera" class="form-control" value="{{ old('nombre_carrera') }}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Clave</label>
                            <input type="text" name="clave_carrera" class="form-control" value="{{ old('clave_carrera') }}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Coordinador</label>
                            <input type="text" name="coordinador" class="form-control" value="{{ old('coordinador') }}">
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('carreras.index') }}" class="btn btn-secondary">Cancelar</a>
                            <button class="btn btn-primary">Guardar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection