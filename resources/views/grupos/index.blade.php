@extends('plantillas.login2')
@section('menu2')
    @include('menu2')
@endsection
@section('contenido2')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Grupos</h2>
        <a href="{{ route('grupos.create') }}" class="btn btn-primary">Nuevo registro</a>
    </div>

    @include('partials.search_form', [
        'action' => route('grupos.index'),
        'name' => 'q',
        'placeholder' => 'Buscar grupos por nombre o clave',
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
                    <th>Clave</th>
                    @php
                        $nombreDir = request('sort') === 'nombre_grupo' && request('dir') === 'asc' ? 'desc' : 'asc';
                    @endphp
                    <th>
                        <a class="btn btn-sm btn-outline-secondary" role="button" aria-label="Ordenar por Nombre" href="{{ route('grupos.index', array_merge(request()->query(), ['sort' => 'nombre_grupo', 'dir' => $nombreDir])) }}">Nombre
                            @if(request('sort') === 'nombre_grupo')
                                @if(request('dir') === 'asc') ▲ @else ▼ @endif
                            @endif
                        </a>
                    </th>
                    <th>Materia</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($grupos as $grupo)
                    <tr>
                        <td>{{ $grupo->id }}</td>
                        <td>{{ $grupo->clave_grupo }}</td>
                        <td>{{ $grupo->nombre_grupo }}</td>
                        <td>{{ $grupo->materia?->nombre }}</td>
                        <td>
                            <a href="{{ route('grupos.show', $grupo) }}" class="btn btn-sm btn-outline-secondary" title="Ver">👁️</a>
                            <a href="{{ route('grupos.alumnos.index', $grupo) }}" class="btn btn-sm btn-outline-secondary" title="Ver alumnos" aria-label="Ver alumnos">👥</a>
                            <a href="{{ route('grupos.labs.index', $grupo) }}" class="btn btn-sm btn-outline-secondary" title="Ver laboratorios" aria-label="Ver laboratorios">🔬</a>
                            <a href="{{ route('grupos.edit', $grupo) }}" class="btn btn-sm btn-outline-primary" title="Editar">✏️</a>
                            <form action="{{ route('grupos.destroy', $grupo) }}" method="POST" style="display:inline" onsubmit="return confirm('¿Eliminar este registro?');">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger">🗑️</button>
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
            Showing {{ $grupos->firstItem() ?? 0 }} to {{ $grupos->lastItem() ?? 0 }} of {{ $grupos->total() }} results
        </div>
        <div>
            {{ $grupos->links('pagination::bootstrap-5') }}
        </div>
    </div>
</div>
@endsection