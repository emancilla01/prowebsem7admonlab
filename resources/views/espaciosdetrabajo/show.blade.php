@extends('plantillas.login2')
@section('menu2')
    @include('menu2')
@endsection
@section('contenido2')

<div class="container mt-4">
    <div class="card">
        <div class="card-header">Detalle del Espacio</div>

        <div class="card-body">
            <dl class="row">
                <dt class="col-sm-3">ID</dt>
                <dd class="col-sm-9">{{ $espacio->id_espacio }}</dd>

                <dt class="col-sm-3">Nombre</dt>
                <dd class="col-sm-9">{{ $espacio->nombre_espacio }}</dd>

                <dt class="col-sm-3">Tipo</dt>
                <dd class="col-sm-9">{{ $espacio->tipo_espacio }}</dd>

                <dt class="col-sm-3">Ubicación</dt>
                <dd class="col-sm-9">{{ $espacio->ubicacion }}</dd>

                <dt class="col-sm-3">Capacidad</dt>
                <dd class="col-sm-9">{{ $espacio->capacidad }}</dd>

                <dt class="col-sm-3">Responsable</dt>
                <dd class="col-sm-9">{{ $espacio->responsable }}</dd>
            </dl>

            <div class="d-flex justify-content-between">
                <a href="{{ route('espaciosdetrabajo.index') }}" class="btn btn-secondary">Volver</a>
                <a href="{{ route('espaciosdetrabajo.edit', $espacio) }}" class="btn btn-primary">Editar</a>
            </div>
        </div>
    </div>
</div>

@endsection
