@extends('plantillas.login2')
@section('menu2')
    @include('menu2')
@endsection
@section('contenido2')
<h2>Salida #{{ $salida->id }}</h2>

<div class="card">
    <div class="card-body">
        <dl class="row">
            <dt class="col-sm-3">ID</dt>
            <dd class="col-sm-9">{{ $salida->id }}</dd>

            <dt class="col-sm-3">Fecha</dt>
            <dd class="col-sm-9">{{ optional($salida->fecha)->format('Y-m-d') }}</dd>

            <dt class="col-sm-3">Hora</dt>
            <dd class="col-sm-9">{{ $salida->hora }}</dd>

            <dt class="col-sm-3">Quien autorizó</dt>
            <dd class="col-sm-9">{{ $salida->quien_autorizo }}</dd>

            <dt class="col-sm-3">Quien registró</dt>
            <dd class="col-sm-9">{{ $salida->quien_registro }}</dd>
        </dl>

        <div class="d-flex justify-content-between">
            <a href="{{ route('salidas.index') }}" class="btn btn-secondary">Volver</a>
            <a href="{{ route('salidas.edit', $salida) }}" class="btn btn-primary">Editar</a>
        </div>
    </div>
</div>

@endsection
