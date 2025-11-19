@extends('plantillas.login2')
@section('menu2')
    @include('menu2')
@endsection
@section('contenido2')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Materias que requieren el software (Software: {{ $softwareId ?? '-' }})</h2>
        @if($softwareId)
            <a href="{{ route('software.materias.create', ['software' => $softwareId]) }}" class="btn btn-primary">Crear relación</a>
        @else
            <a href="{{ route('software.index') }}" class="btn btn-primary">Crear relación</a>
        @endif
    </div>

    @include('partials.search_form', [
        'action' => route('software.materias.index', ['software' => $softwareId]),
        'name' => 'q',
        'placeholder' => 'Buscar por nombre de materia o software',
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
                        $materiaDir = request('sort') === 'materia' && request('dir') === 'asc' ? 'desc' : 'asc';
                    @endphp
                    <th>
                        <a class="btn btn-sm btn-outline-secondary" role="button" aria-label="Ordenar por Materia" href="{{ route('software.materias.index', array_merge(request()->query(), ['software' => $softwareId, 'sort' => 'materia', 'dir' => $materiaDir])) }}">Materia
                            @if(request('sort') === 'materia')
                                @if(request('dir') === 'asc') ▲ @else ▼ @endif
                            @endif
                        </a>
                    </th>
                    <th>Software</th>
                    <th>Observaciones</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($items as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->materia?->nombre }}</td>
                        <td>{{ $item->software?->nombre_software }}</td>
                        <td>{{ $item->observaciones }}</td>
                        <td>
                            <a href="{{ route('software.materias.show', $item) }}" class="btn btn-sm btn-outline-secondary" title="Ver" aria-label="Ver">👁️</a>
                            <a href="{{ route('software.materias.edit', $item) }}" class="btn btn-sm btn-outline-primary" title="Editar" aria-label="Editar">✏️</a>
                            <form action="{{ route('software.materias.destroy', $item) }}" method="POST" style="display:inline" onsubmit="return confirm('¿Eliminar esta relación?');">
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