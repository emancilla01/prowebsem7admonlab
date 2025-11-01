@extends('plantillas.login2')
@section('menu2')
    @include('menu2')
@endsection
@section('contenido2')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Personal</h2>
        <a href="{{ route('personal.create') }}" class="btn btn-primary">Nuevo registro</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>RFC</th>
                    <th>Nombre</th>
                    <th>Apellido P.</th>
                    <th>Apellido M.</th>
                    <th>Email</th>
                    <th>Sexo</th>
                    <th>Depto</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($personals as $personal)
                    <tr>
                        <td>{{ $personal->id }}</td>
                        <td>{{ $personal->rfc }}</td>
                        <td>{{ $personal->nombre }}</td>
                        <td>{{ $personal->apellido_pat }}</td>
                        <td>{{ $personal->apellido_mat }}</td>
                        <td>{{ $personal->email }}</td>
                        <td>{{ $personal->sexo }}</td>
                        <td>{{ $personal->depto }}</td>
                        <td>
                            <a href="{{ route('personal.show', $personal) }}" class="btn btn-sm btn-outline-secondary">Ver</a>
                            <a href="{{ route('personal.edit', $personal) }}" class="btn btn-sm btn-outline-primary">Editar</a>
                            <form action="{{ route('personal.destroy', $personal) }}" method="POST" style="display:inline" onsubmit="return confirm('¿Eliminar este registro?');">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="9">No hay registros.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="d-flex justify-content-center">
        {{ $personals->links() }}
    </div>
</div>

@endsection