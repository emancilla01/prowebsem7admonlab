@extends('plantillas.login2')
@section('menu2')
    @include('menu2')
@endsection
@section('contenido2')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Alumnos del grupo: {{ $grupo->nombre_grupo ?? '' }}</h2>
        <a href="{{ route('grupos.alumnos.create', $grupo ?? 0) }}" class="btn btn-primary">Nuevo alumno</a>
    </div>

    @include('partials.search_form', [
        'action' => route('grupos.alumnos.index', $grupo ?? 0),
        'name' => 'q',
        'placeholder' => 'Buscar por matrícula o nombre',
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
                        $nameDir = request('sort') === 'nombre_alumno' && request('dir') === 'asc' ? 'desc' : 'asc';
                    @endphp
                    <th>
                        <a class="btn btn-sm btn-outline-secondary" role="button" href="{{ route('grupos.alumnos.index', array_merge(request()->query(), ['sort' => 'nombre_alumno', 'dir' => $nameDir, 'grupo' => $grupo->id ?? null])) }}">Nombre
                            @if(request('sort') === 'nombre_alumno')
                                @if(request('dir') === 'asc') ▲ @else ▼ @endif
                            @endif
                        </a>
                    </th>
                    <th>Matrícula</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($alumnos as $alumno)
                    <tr>
                        <td>{{ $alumno->id }}</td>
                        <td>{{ $grupo->nombre_grupo ?? $alumno->grupo?->nombre_grupo }}</td>
                        <td>{{ $alumno->nombre_alumno }}</td>
                        <td>{{ $alumno->matricula }}</td>
                        <td>
                            <a href="{{ route('alumnos.show', $alumno) }}" class="btn btn-sm btn-outline-secondary" title="Ver">👁️</a>
                            <a href="{{ route('alumnos.edit', $alumno) }}" class="btn btn-sm btn-outline-primary" title="Editar">✏️</a>
                            <form action="{{ route('alumnos.destroy', $alumno) }}" method="POST" style="display:inline" onsubmit="return confirm('¿Eliminar este registro?');">
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
        {{ $alumnos->links('pagination::bootstrap-5') }}
    </div>
</div>
@endsection