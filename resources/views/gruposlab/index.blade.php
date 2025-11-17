@extends('plantillas.login2')
@section('menu2')
    @include('menu2')
@endsection
@section('contenido2')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Laboratorios del grupo: {{ $grupo->nombre_grupo ?? '' }}</h2>
        <a href="{{ route('grupos.labs.create', $grupo ?? 0) }}" class="btn btn-primary">Nuevo laboratorio</a>
    </div>

    @include('partials.search_form', [
        'action' => route('grupos.labs.index', $grupo ?? 0),
        'name' => 'q',
        'placeholder' => 'Buscar por horario o espacio',
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
                    <th>Grupo</th>
                    @php
                        $espDir = request('sort') === 'id_espacio' && request('dir') === 'asc' ? 'desc' : 'asc';
                    @endphp
                    <th>
                        <a class="btn btn-sm btn-outline-secondary" role="button" aria-label="Ordenar por Espacio" href="{{ route('grupos.labs.index', array_merge(request()->query(), ['sort' => 'id_espacio', 'dir' => $espDir, 'grupo' => $grupo->id ?? null])) }}">Espacio
                            @if(request('sort') === 'id_espacio')
                                @if(request('dir') === 'asc') ▲ @else ▼ @endif
                            @endif
                        </a>
                    </th>
                    <th>Horario</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($labs as $lab)
                    <tr>
                        <td>{{ $lab->id }}</td>
                        <td>{{ $grupo->nombre_grupo ?? $lab->grupo?->nombre_grupo }}</td>
                        <td>{{ $lab->espacio?->nombre_espacio }}</td>
                        <td>{{ $lab->horario }}</td>
                        <td>
                            <a href="{{ route('labs.show', $lab) }}" class="btn btn-sm btn-outline-secondary" title="Ver">👁️</a>
                            <a href="{{ route('labs.edit', $lab) }}" class="btn btn-sm btn-outline-primary" title="Editar">✏️</a>
                            <form action="{{ route('labs.destroy', $lab) }}" method="POST" style="display:inline" onsubmit="return confirm('¿Eliminar este registro?');">
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
        {{ $labs->links('pagination::bootstrap-5') }}
    </div>
</div>
@endsection