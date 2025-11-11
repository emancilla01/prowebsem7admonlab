@extends('plantillas.login2')
@section('menu2')
    @include('menu2')
@endsection
@section('contenido2')

<div class="container mt-4">
    <div class="card">
        <div class="card-header">Detalle del Software</div>

        <div class="card-body">
            <dl class="row">
                <dt class="col-sm-3">ID</dt>
                <dd class="col-sm-9">{{ $software->id_software }}</dd>

                <dt class="col-sm-3">Nombre</dt>
                <dd class="col-sm-9">{{ $software->nombre_software }}</dd>

                <dt class="col-sm-3">Versión</dt>
                <dd class="col-sm-9">{{ $software->version }}</dd>

                <dt class="col-sm-3">Licencia</dt>
                <dd class="col-sm-9">{{ $software->licencia }}</dd>

                <dt class="col-sm-3">Proveedor</dt>
                <dd class="col-sm-9">{{ $software->proveedor }}</dd>

                <dt class="col-sm-3">Fecha instalación</dt>
                <dd class="col-sm-9">{{ $software->fecha_instalacion }}</dd>

                <dt class="col-sm-3">Espacio</dt>
                <dd class="col-sm-9">{{ optional($software->espacioTrabajo)->nombre_espacio ?? 'N/A' }}</dd>
            </dl>

            <div class="d-flex justify-content-between">
                <a href="{{ route('software.index') }}" class="btn btn-secondary">Volver</a>
                <a href="{{ route('software.edit', $software) }}" class="btn btn-primary">Editar</a>
            </div>
        </div>
    </div>
</div>
@endsection
