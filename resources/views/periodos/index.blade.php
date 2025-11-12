@extends('plantillas.login2')
@section('menu2')
    @include('menu2')
@endsection
@section('contenido2')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Periodos</h2>
        <a href="{{ route('periodos.create') }}" class="btn btn-primary">Nuevo registro</a>
    </div>

    {{-- Search form (reusable partial) --}}
    @include('partials.search_form', [
        'action' => route('periodos.index'),
        'name' => 'q',
        'placeholder' => 'Buscar periodos',
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
                        <a class="btn btn-sm btn-outline-secondary" role="button" aria-label="Ordenar por Nombre" href="{{ route('periodos.index', array_merge(request()->query(), ['sort' => 'nombre', 'dir' => $nombreDir])) }}">Nombre
                            @if(request('sort') === 'nombre')
                                @if(request('dir') === 'asc') ▲ @else ▼ @endif
                            @endif
                        </a>
                    </th>
                    <th>Inicio</th>
                    <th>Fin</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($periodos as $periodo)
                    <tr>
                        <td>{{ $periodo->id }}</td>
                        <td>{{ $periodo->nombre }}</td>
                        <td>{{ $periodo->fecha_inicio }}</td>
                        <td>{{ $periodo->fecha_fin }}</td>
                        <td>
                            <a href="{{ route('periodos.show', $periodo) }}" class="btn btn-sm btn-outline-secondary" title="Ver" aria-label="Ver registro">👁️</a>
                            <a href="{{ route('periodos.edit', $periodo) }}" class="btn btn-sm btn-outline-primary" title="Editar" aria-label="Editar registro">✏️</a>
                            <form action="{{ route('periodos.destroy', $periodo) }}" method="POST" style="display:inline" onsubmit="return confirm('¿Eliminar este registro?');">
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
            Showing {{ $periodos->firstItem() ?? 0 }} to {{ $periodos->lastItem() ?? 0 }} of {{ $periodos->total() }} results
        </div>
        <div>
            {{ $periodos->links('pagination::bootstrap-5') }}
        </div>
    </div>
</div>
@endsection