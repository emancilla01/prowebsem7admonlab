@extends('plantillas.login2')
@section('menu2')
    @include('menu2')
@endsection
@section('contenido2')

<div class="container mt-4">
    <div class="card">
        <div class="card-header">Detalle de la Entrada</div>

        <div class="card-body">
            <dl class="row">
                <dt class="col-sm-3">ID</dt>
                <dd class="col-sm-9">{{ $entrada->id }}</dd>

                <dt class="col-sm-3">Fecha</dt>
                <dd class="col-sm-9">{{ optional($entrada->fecha)->format('Y-m-d') }}</dd>

                <dt class="col-sm-3">Hora</dt>
                <dd class="col-sm-9">{{ $entrada->hora }}</dd>

                <dt class="col-sm-3">Quien envió</dt>
                <dd class="col-sm-9">{{ $entrada->quien_envio }}</dd>

                <dt class="col-sm-3">Quien recibió</dt>
                <dd class="col-sm-9">{{ $entrada->quien_recibio }}</dd>

                <dt class="col-sm-3">Lugar</dt>
                <dd class="col-sm-9">{{ $entrada->lugar }}</dd>

                <dt class="col-sm-3">Creado</dt>
                <dd class="col-sm-9">{{ $entrada->created_at }}</dd>

                <dt class="col-sm-3">Actualizado</dt>
                <dd class="col-sm-9">{{ $entrada->updated_at }}</dd>
            </dl>

            <div class="d-flex justify-content-between">
                <div>
                    <a href="{{ route('entradas.index') }}" class="btn btn-secondary">Volver</a>
                    <a href="{{ route('entradas.detalle.index', $entrada) }}" class="btn btn-outline-info">Ver detalles</a>
                </div>
                <a href="{{ route('entradas.edit', $entrada) }}" class="btn btn-primary">Editar</a>
            </div>
        </div>
    </div>
</div>

@endsection