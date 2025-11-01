@extends('plantillas.login2')
@section('menu2')
    @include('menu2')
@endsection
@section('contenido2')
<div class="container mt-4">
    <div class="card">
        <div class="card-header">Detalle del Personal</div>

        <div class="card-body">
            <dl class="row">
                <dt class="col-sm-3">ID</dt>
                <dd class="col-sm-9">{{ $personal->id }}</dd>

                <dt class="col-sm-3">RFC</dt>
                <dd class="col-sm-9">{{ $personal->rfc }}</dd>

                <dt class="col-sm-3">Nombre</dt>
                <dd class="col-sm-9">{{ $personal->nombre }}</dd>

                <dt class="col-sm-3">Apellido P.</dt>
                <dd class="col-sm-9">{{ $personal->apellido_pat }}</dd>

                <dt class="col-sm-3">Apellido M.</dt>
                <dd class="col-sm-9">{{ $personal->apellido_mat }}</dd>

                <dt class="col-sm-3">Email</dt>
                <dd class="col-sm-9">{{ $personal->email }}</dd>

                <dt class="col-sm-3">Sexo</dt>
                <dd class="col-sm-9">{{ $personal->sexo }}</dd>

                <dt class="col-sm-3">Departamento</dt>
                <dd class="col-sm-9">{{ $personal->depto }}</dd>
            </dl>

            <div class="d-flex justify-content-between">
                <a href="{{ route('personal.index') }}" class="btn btn-secondary">Volver</a>
                <a href="{{ route('personal.edit', $personal) }}" class="btn btn-primary">Editar</a>
            </div>
        </div>
    </div>
</div>

@endsection
