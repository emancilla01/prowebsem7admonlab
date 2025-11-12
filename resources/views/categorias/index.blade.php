@extends('plantillas.login2')
@section('menu2')
    @include('menu2')
@endsection
@section('contenido2')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Categorías</h2>
        <a href="{{ route('categorias.create') }}" class="btn btn-primary">Nuevo registro</a>
    </div>

    {{-- Search form (reusable partial) --}}
    @include('partials.search_form', [
        'action' => route('categorias.index'),
        'name' => 'q',
        'placeholder' => 'Buscar categorías',
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
                        <a class="btn btn-sm btn-outline-secondary" role="button" aria-label="Ordenar por Nombre" href="{{ route('categorias.index', array_merge(request()->query(), ['sort' => 'nombre', 'dir' => $nombreDir])) }}">Nombre
                            @if(request('sort') === 'nombre')
                                @if(request('dir') === 'asc') ▲ @else ▼ @endif
                            @endif
                        </a>
                    </th>
                    <th>Descripción</th>
                    <th>Creado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($categorias as $categoria)
                    <tr>
                        <td>{{ $categoria->id }}</td>
                        <td>{{ $categoria->nombre }}</td>
                        <td>{{ \Illuminate\Support\Str::limit($categoria->descripcion, 80) }}</td>
                        <td>{{ $categoria->created_at?->format('Y-m-d') }}</td>
                        <td>
                            <a href="{{ route('categorias.show', $categoria) }}" class="btn btn-sm btn-outline-secondary">Ver</a>
                            <a href="{{ route('categorias.edit', $categoria) }}" class="btn btn-sm btn-outline-primary">Editar</a>
                            <form action="{{ route('categorias.destroy', $categoria) }}" method="POST" style="display:inline" onsubmit="return confirm('¿Eliminar este registro?');">
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
            Showing {{ $categorias->firstItem() ?? 0 }} to {{ $categorias->lastItem() ?? 0 }} of {{ $categorias->total() }} results
        </div>
        <div>
            {{ $categorias->links('pagination::bootstrap-5') }}
        </div>
    </div>
</div>
@endsection