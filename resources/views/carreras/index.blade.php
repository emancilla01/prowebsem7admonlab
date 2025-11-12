@extends('plantillas.login2')
@section('menu2')
    @include('menu2')
@endsection
@section('contenido2')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Carreras</h2>
        <a href="{{ route('carreras.create') }}" class="btn btn-primary">Nuevo registro</a>
    </div>

    {{-- Search form (reusable partial) --}}
    @include('partials.search_form', [
        'action' => route('carreras.index'),
        'name' => 'q',
        'placeholder' => 'Buscar carreras',
        'buttonText' => 'Buscar'
    ])

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nombre</th>
                    <th>Clave</th>
                    <th>Coordinador</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($carreras as $carrera)
                    <tr>
                        <td>{{ $carrera->id_carrera }}</td>
                        <td>{{ $carrera->nombre_carrera }}</td>
                        <td>{{ $carrera->clave_carrera }}</td>
                        <td>{{ $carrera->coordinador }}</td>
                        <td>
                            <a href="{{ route('carreras.show', $carrera) }}" class="btn btn-sm btn-outline-secondary">Ver</a>
                            <a href="{{ route('carreras.edit', $carrera) }}" class="btn btn-sm btn-outline-primary">Editar</a>
                            <form action="{{ route('carreras.destroy', $carrera) }}" method="POST" style="display:inline" onsubmit="return confirm('¿Eliminar este registro?');">
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
            Showing {{ $carreras->firstItem() ?? 0 }} to {{ $carreras->lastItem() ?? 0 }} of {{ $carreras->total() }} results
        </div>
        <div>
            {{ $carreras->links('pagination::bootstrap-5') }}
        </div>
    </div>
</div>
@endsection