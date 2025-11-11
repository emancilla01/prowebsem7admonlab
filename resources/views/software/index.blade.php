@extends('plantillas.login2')
@section('menu2')
    @include('menu2')
@endsection
@section('contenido2')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Software</h2>
        <a href="{{ route('software.create') }}" class="btn btn-primary">Nuevo registro</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nombre</th>
                    <th>Versión</th>
                    <th>Proveedor</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($softwares as $software)
                    <tr>
                        <td>{{ $software->id_software }}</td>
                        <td>{{ $software->nombre_software }}</td>
                        <td>{{ $software->version }}</td>
                        <td>{{ $software->proveedor }}</td>
                        <td>
                            <a href="{{ route('software.show', $software) }}" class="btn btn-sm btn-outline-secondary">Ver</a>
                            <a href="{{ route('software.edit', $software) }}" class="btn btn-sm btn-outline-primary">Editar</a>
                            <form action="{{ route('software.destroy', $software) }}" method="POST" style="display:inline" onsubmit="return confirm('¿Eliminar este registro?');">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5">No hay registros.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="d-flex justify-content-between align-items-center my-3">
        <div class="text-muted">
            Showing {{ $softwares->firstItem() ?? 0 }} to {{ $softwares->lastItem() ?? 0 }} of {{ $softwares->total() }} results
        </div>
        <div>
            {{ $softwares->links('pagination::bootstrap-5') }}
        </div>
    </div>
</div>

@endsection