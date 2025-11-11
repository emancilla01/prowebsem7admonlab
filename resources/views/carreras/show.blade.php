@extends('plantillas.login2')
@section('menu2')
    @include('menu2')
@endsection
@section('contenido2')
<div class="container mt-4">
    <div class="card">
        <div class="card-header">Detalle de la Carrera</div>

        <div class="card-body">
            <dl class="row">
                <dt class="col-sm-3">ID</dt>
                <dd class="col-sm-9">{{ $carrera->id_carrera }}</dd>

                <dt class="col-sm-3">Nombre</dt>
                <dd class="col-sm-9">{{ $carrera->nombre_carrera }}</dd>

                <dt class="col-sm-3">Clave</dt>
                <dd class="col-sm-9">{{ $carrera->clave_carrera }}</dd>

                <dt class="col-sm-3">Coordinador</dt>
                <dd class="col-sm-9">{{ $carrera->coordinador }}</dd>
            </dl>

            <div class="d-flex justify-content-between">
                <a href="{{ route('carreras.index') }}" class="btn btn-secondary">Volver</a>
                <a href="{{ route('carreras.edit', $carrera) }}" class="btn btn-primary">Editar</a>
            </div>
        </div>
    </div>
</div>

@endsection
