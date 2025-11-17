@extends('plantillas.login2')
@section('menu2')
    @include('menu2')
@endsection
@section('contenido2')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Materias</h2>
        <a href="{{ route('materias.create') }}" class="btn btn-primary">Nuevo registro</a>
    </div>

    @include('partials.search_form', [
        'action' => route('materias.index'),
        'name' => 'q',
        'placeholder' => 'Buscar materias por nombre o clave',
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
                    @php
                        $nombreDir = request('sort') === 'nombre' && request('dir') === 'asc' ? 'desc' : 'asc';
                    @endphp
                    <th>
                        <a class="btn btn-sm btn-outline-secondary" role="button" aria-label="Ordenar por Nombre" href="{{ route('materias.index', array_merge(request()->query(), ['sort' => 'nombre', 'dir' => $nombreDir])) }}">Nombre
                            @if(request('sort') === 'nombre')
                                @if(request('dir') === 'asc') ▲ @else ▼ @endif
                            @endif
                        </a>
                    </th>
                    <th>Clave</th>
                    <th>Carrera</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($materias as $materia)
                    <tr>
                        <td>{{ $materia->id }}</td>
                        <td>{{ $materia->nombre }}</td>
                        <td>{{ $materia->clave }}</td>
                        <td>{{ $materia->carrera?->nombre_carrera }}</td>
                        <td>
                            <a href="{{ route('materias.show', $materia) }}" class="btn btn-sm btn-outline-secondary" title="Ver" aria-label="Ver registro">👁️</a>
                            <a href="{{ route('materias.edit', $materia) }}" class="btn btn-sm btn-outline-primary" title="Editar" aria-label="Editar registro">✏️</a>
                            <form action="{{ route('materias.destroy', $materia) }}" method="POST" style="display:inline" onsubmit="return confirm('¿Eliminar este registro?');">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger" title="Eliminar" aria-label="Eliminar registro">🗑️</button>
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
            Showing {{ $materias->firstItem() ?? 0 }} to {{ $materias->lastItem() ?? 0 }} of {{ $materias->total() }} results
        </div>
        <div>
            {{ $materias->links('pagination::bootstrap-5') }}
        </div>
    </div>
</div>
@endsection