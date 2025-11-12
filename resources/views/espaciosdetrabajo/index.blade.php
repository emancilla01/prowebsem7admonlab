@extends('plantillas.login2')
@section('menu2')
    @include('menu2')
@endsection
@section('contenido2')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Espacios de trabajo</h2>
    <a href="{{ route('espaciosdetrabajo.create') }}" class="btn btn-primary">Nuevo registro</a>
    </div>

    {{-- Search form (reusable partial) --}}
    @include('partials.search_form', [
        'action' => route('espaciosdetrabajo.index'),
        'name' => 'q',
        'placeholder' => 'Buscar espacios',
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
                        <a class="btn btn-sm btn-outline-secondary" role="button" aria-label="Ordenar por Nombre" href="{{ route('espaciosdetrabajo.index', array_merge(request()->query(), ['sort' => 'nombre', 'dir' => $nombreDir])) }}">Nombre
                            @if(request('sort') === 'nombre')
                                @if(request('dir') === 'asc') ▲ @else ▼ @endif
                            @endif
                        </a>
                    </th>
                    <th>Tipo</th>
                    <th>Ubicación</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($espacios as $espacio)
                    <tr>
                        <td>{{ $espacio->id_espacio }}</td>
                        <td>{{ $espacio->nombre_espacio }}</td>
                        <td>{{ $espacio->tipo_espacio }}</td>
                        <td>{{ $espacio->ubicacion }}</td>
                        <td>
                            <a href="{{ route('espaciosdetrabajo.show', $espacio) }}" class="btn btn-sm btn-outline-secondary" title="Ver" aria-label="Ver registro">👁️</a>
                            <a href="{{ route('espaciosdetrabajo.edit', $espacio) }}" class="btn btn-sm btn-outline-primary" title="Editar" aria-label="Editar registro">✏️</a>
                            <form action="{{ route('espaciosdetrabajo.destroy', $espacio) }}" method="POST" style="display:inline" onsubmit="return confirm('¿Eliminar este registro?');">
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
            Showing {{ $espacios->firstItem() ?? 0 }} to {{ $espacios->lastItem() ?? 0 }} of {{ $espacios->total() }} results
        </div>
        <div>
            {{ $espacios->links('pagination::bootstrap-5') }}
        </div>
    </div>
</div>

@endsection