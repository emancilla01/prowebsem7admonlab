@extends('plantillas.login2')
@section('menu2')
    @include('menu2')
@endsection
@section('contenido2')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Personal</h2>
        <a href="{{ route('personal.create') }}" class="btn btn-primary">Nuevo registro</a>
    </div>

    {{-- Search form (reusable partial) --}}
    @include('partials.search_form', [
        'action' => route('personal.index'),
        'name' => 'q',
        'placeholder' => 'Buscar personal',
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
                    <th>RFC</th>
                    @php
                        $nombreDir = request('sort') === 'nombre' && request('dir') === 'asc' ? 'desc' : 'asc';
                    @endphp
                    <th>
                        <a class="btn btn-sm btn-outline-secondary" role="button" aria-label="Ordenar por Nombre" href="{{ route('personal.index', array_merge(request()->query(), ['sort' => 'nombre', 'dir' => $nombreDir])) }}">Nombre
                            @if(request('sort') === 'nombre')
                                @if(request('dir') === 'asc') ▲ @else ▼ @endif
                            @endif
                        </a>
                    </th>
                    <th>Apellido P.</th>
                    <th>Apellido M.</th>
                    <th>Email</th>
                    <th>Sexo</th>
                    <th>Depto</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($personals as $personal)
                    <tr>
                        <td>{{ $personal->id }}</td>
                        <td>{{ $personal->rfc }}</td>
                        <td>{{ $personal->nombre }}</td>
                        <td>{{ $personal->apellido_pat }}</td>
                        <td>{{ $personal->apellido_mat }}</td>
                        <td>{{ $personal->email }}</td>
                        <td>{{ $personal->sexo }}</td>
                        <td>{{ $personal->depto }}</td>
                        <td>
                            <a href="{{ route('personal.show', $personal) }}" class="btn btn-sm btn-outline-secondary" title="Ver" aria-label="Ver registro">👁️</a>
                            <a href="{{ route('personal.edit', $personal) }}" class="btn btn-sm btn-outline-primary" title="Editar" aria-label="Editar registro">✏️</a>
                            <form action="{{ route('personal.destroy', $personal) }}" method="POST" style="display:inline" onsubmit="return confirm('¿Eliminar este registro?');">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger" title="Eliminar" aria-label="Eliminar registro">🗑️</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="9">No hay registros.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="d-flex justify-content-between align-items-center my-3">
        <div class="text-muted">
            Showing {{ $personals->firstItem() ?? 0 }} to {{ $personals->lastItem() ?? 0 }} of {{ $personals->total() }} results
        </div>
        <div>
            {{ $personals->links('pagination::bootstrap-5') }}
        </div>
    </div>
</div>

@endsection