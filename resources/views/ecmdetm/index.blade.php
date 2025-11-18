@extends('plantillas.login2')
@section('menu2')
    @include('menu2')
@endsection
@section('contenido2')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Mobiliario (ECM: {{ $id_ecm ?? '-' }})</h2>
        <a href="{{ route('ecm_detmob.create', ['id_ecm' => $id_ecm]) }}" class="btn btn-primary">Nuevo mobiliario</a>
    </div>

    @include('partials.search_form', [
        'action' => route('ecm_detmob.index', ['id_ecm' => $id_ecm]),
        'name' => 'q',
        'placeholder' => 'Buscar por código, descripción o material',
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
                        $codigoDir = request('sort') === 'codigo' && request('dir') === 'asc' ? 'desc' : 'asc';
                    @endphp
                    <th>
                        <a class="btn btn-sm btn-outline-secondary" role="button" aria-label="Ordenar por Código" href="{{ route('ecm_detmob.index', array_merge(request()->query(), ['sort' => 'codigo', 'dir' => $codigoDir])) }}">Código
                            @if(request('sort') === 'codigo')
                                @if(request('dir') === 'asc') ▲ @else ▼ @endif
                            @endif
                        </a>
                    </th>
                    <th>Descripción</th>
                    <th>Espacio</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($items as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->codigo }}</td>
                        <td>{{ $item->descripcion }}</td>
                        <td>{{ $item->espacio?->nombre_espacio }}</td>
                        <td>{{ $item->estado }}</td>
                        <td>
                            <a href="{{ route('ecm_detmob.show', $item) }}" class="btn btn-sm btn-outline-secondary" title="Ver" aria-label="Ver">👁️</a>
                            <a href="{{ route('ecm_detmob.edit', $item) }}" class="btn btn-sm btn-outline-primary" title="Editar" aria-label="Editar">✏️</a>
                            <form action="{{ route('ecm_detmob.destroy', $item) }}" method="POST" style="display:inline" onsubmit="return confirm('¿Eliminar este mobiliario?');">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger" title="Eliminar" aria-label="Eliminar">🗑️</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6">No hay registros.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="d-flex justify-content-end mt-3">
        {{ $items->links('pagination::bootstrap-5') }}
    </div>
</div>

@endsection