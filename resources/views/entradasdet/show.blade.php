@extends('plantillas.login2')
@section('menu2')
    @include('menu2')
@endsection
@section('contenido2')
<div class="container mt-4">
    <div class="card">
        <div class="card-header">Detalle de Entrada</div>

        <div class="card-body">
            <dl class="row">
                <dt class="col-sm-3">ID</dt>
                <dd class="col-sm-9">{{ $detalle->id }}</dd>

                <dt class="col-sm-3">Entrada ID</dt>
                <dd class="col-sm-9">{{ $detalle->id_entrada }}</dd>

                <dt class="col-sm-3">No. Serie</dt>
                <dd class="col-sm-9">{{ $detalle->no_serie ?? '—' }}</dd>

                <dt class="col-sm-3">Espacio de Trabajo</dt>
                <dd class="col-sm-9">{{ optional($detalle->espacioTrabajo)->nombre_espacio ?? '—' }}</dd>

                <dt class="col-sm-3">ID equipo de cómputo</dt>
                <dd class="col-sm-9">{{ optional($detalle->ecmDetequcom)->serial }}</dd>

                <dt class="col-sm-3">ID mobiliario</dt>
                <dd class="col-sm-9">{{ optional($detalle->ecmDetmob)->codigo }}</dd>

                <dt class="col-sm-3">Creado</dt>
                <dd class="col-sm-9">{{ $detalle->created_at }}</dd>

                <dt class="col-sm-3">Actualizado</dt>
                <dd class="col-sm-9">{{ $detalle->updated_at }}</dd>
            </dl>

            <div class="d-flex justify-content-between">
                <a href="{{ route('entradas.detalle.index', $entrada) }}" class="btn btn-secondary">Volver</a>
                <a href="{{ route('entradas.detalle.edit', [$entrada, $detalle]) }}" class="btn btn-primary">Editar</a>
            </div>
        </div>
    </div>
</div>

@endsection
