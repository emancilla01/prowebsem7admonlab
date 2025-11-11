@extends('plantillas.login2')
@section('menu2')
    @include('menu2')
@endsection
@section('contenido2')
<div class="container mt-4">
    <div class="card">
        <div class="card-header">Detalle del Periodo</div>

        <div class="card-body">
            <dl class="row">
                <dt class="col-sm-3">ID</dt>
                <dd class="col-sm-9">{{ $periodo->id }}</dd>

                <dt class="col-sm-3">Nombre</dt>
                <dd class="col-sm-9">{{ $periodo->nombre }}</dd>

                <dt class="col-sm-3">Fecha inicio</dt>
                <dd class="col-sm-9">{{ $periodo->fecha_inicio }}</dd>

                <dt class="col-sm-3">Fecha fin</dt>
                <dd class="col-sm-9">{{ $periodo->fecha_fin }}</dd>
            </dl>

            <div class="d-flex justify-content-between">
                <a href="{{ route('periodos.index') }}" class="btn btn-secondary">Volver</a>
                <a href="{{ route('periodos.edit', $periodo) }}" class="btn btn-primary">Editar</a>
            </div>
        </div>
    </div>
</div>

@endsection
