@extends('plantillas.login2')
@section('menu2')
    @include('menu2')
@endsection
@section('contenido2')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Equipo de cómputo (ECM: {{ $id_ecm ?? '-' }})</h2>
        <a href="{{ route('ecm_detequcom.create', ['id_ecm' => $id_ecm]) }}" class="btn btn-primary">Nuevo equipo</a>
    </div>

    @include('partials.search_form', [
        'action' => route('ecm_detequcom.index', ['id_ecm' => $id_ecm]),
        'name' => 'q',
        'placeholder' => 'Buscar por serial, modelo, marca o descripción',
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
                        $serialDir = request('sort') === 'serial' && request('dir') === 'asc' ? 'desc' : 'asc';
                    @endphp
                    <th>
                        <a class="btn btn-sm btn-outline-secondary" role="button" aria-label="Ordenar por Serial" href="{{ route('ecm_detequcom.index', array_merge(request()->query(), ['sort' => 'serial', 'dir' => $serialDir])) }}">Serial
                            @if(request('sort') === 'serial')
                                @if(request('dir') === 'asc') ▲ @else ▼ @endif
                            @endif
                        </a>
                    </th>
                    <th>Modelo</th>
                    <th>Espacio</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($items as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->serial }}</td>
                        <td>{{ $item->modelo }}</td>
                        <td>{{ $item->espacio?->nombre_espacio }}</td>
                        <td>{{ $item->estado }}</td>
                        <td>
                            <a href="{{ route('ecm_detequcom.show', $item) }}" class="btn btn-sm btn-outline-secondary" title="Ver" aria-label="Ver">👁️</a>
                            <a href="{{ route('ecm_detequcom.edit', $item) }}" class="btn btn-sm btn-outline-primary" title="Editar" aria-label="Editar">✏️</a>
                            <form action="{{ route('ecm_detequcom.destroy', $item) }}" method="POST" style="display:inline" onsubmit="return confirm('¿Eliminar este equipo?');">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger" title="Eliminar" aria-label="Eliminar">🗑️</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7">No hay registros.</td>
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