@extends('plantillas.login2')
@section('menu2')
    @include('menu2')
@endsection
@section('contenido2')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Inventario ECM</h2>
        <a href="{{ route('ecm_equcommob.create') }}" class="btn btn-primary">Nuevo recurso</a>
    </div>

    @include('partials.search_form', [
        'action' => route('ecm_equcommob.index'),
        'name' => 'q',
        'placeholder' => 'Buscar por código o descripción',
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
                        $codeDir = request('sort') === 'codigo' && request('dir') === 'asc' ? 'desc' : 'asc';
                    @endphp
                    <th>
                        <a class="btn btn-sm btn-outline-secondary" href="{{ route('ecm_equcommob.index', array_merge(request()->query(), ['sort' => 'codigo', 'dir' => $codeDir])) }}">Código
                            @if(request('sort') === 'codigo')
                                @if(request('dir') === 'asc') ▲ @else ▼ @endif
                            @endif
                        </a>
                    </th>
                    <th>Descripción</th>
                    <th>Categoría</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($ecms as $ecm)
                    <tr>
                        <td>{{ $ecm->id }}</td>
                        <td>{{ $ecm->codigo }}</td>
                        <td>{{ $ecm->descripcion }}</td>
                        <td>{{ $ecm->categoria?->nombre }}</td>
                        <td>
                            <a href="{{ route('ecm_detequcom.index', ['id_ecm' => $ecm->id]) }}" class="btn btn-sm btn-outline-info" title="Equipo">💻</a>
                            <a href="{{ route('ecm_detmob.index', ['id_ecm' => $ecm->id]) }}" class="btn btn-sm btn-outline-warning" title="Mobiliario">🪑</a>

                            <a href="{{ route('ecm_equcommob.show', $ecm->id) }}" class="btn btn-sm btn-outline-secondary" title="Ver">👁️</a>
                            <a href="{{ route('ecm_equcommob.edit', $ecm->id) }}" class="btn btn-sm btn-outline-primary" title="Editar">✏️</a>
                            <form action="{{ route('ecm_equcommob.destroy', $ecm->id) }}" method="POST" style="display:inline" onsubmit="return confirm('¿Eliminar este recurso?');">
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

    <div class="d-flex justify-content-end mt-3">
        {{ $ecms->links('pagination::bootstrap-5') }}
    </div>
</div>
@endsection