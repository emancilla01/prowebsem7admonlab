@extends('plantillas.login2')
@section('menu2')
    @include('menu2')
@endsection
@section('contenido2')

<h2>Detalle de Salida #{{ $salida->id }} — Item #{{ $detalle->id }}</h2>

<div class="card mb-3">
    <div class="card-body">
        <dl class="row">
            <dt class="col-sm-3">ID</dt>
            <dd class="col-sm-9">{{ $detalle->id }}</dd>

            <dt class="col-sm-3">Entrada (No. serie)</dt>
            <dd class="col-sm-9">{{ optional($detalle->entradaDetalle)->no_serie ?? '—' }}</dd>

            <dt class="col-sm-3">Motivo</dt>
            <dd class="col-sm-9">{{ $detalle->motivo_de_salida }}</dd>

            <dt class="col-sm-3">Creado</dt>
            <dd class="col-sm-9">{{ $detalle->created_at }}</dd>
        </dl>

        <div class="d-flex justify-content-between">
            <div>
                <a href="{{ route('salidas.detalle.index', $salida) }}" class="btn btn-secondary">Volver a detalles</a>
            </div>
            <div>
                <a href="{{ route('salidas.detalle.edit', [$salida, $detalle]) }}" class="btn btn-primary">Editar</a>
                <form action="{{ route('salidas.detalle.destroy', [$salida, $detalle]) }}" method="POST" style="display:inline" onsubmit="return confirm('¿Eliminar este detalle?');">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger">Eliminar</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
