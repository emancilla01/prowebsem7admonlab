@extends('plantillas.login2')
@section('menu2')
    @include('menu2')
@endsection
@section('contenido2')

<h2>Entradas</h2>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="d-flex justify-content-between mb-3">
    <form class="d-flex" method="GET" action="{{ route('entradas.index') }}">
        <input class="form-control me-2" type="search" name="q" value="{{ request('q') }}" placeholder="Buscar...">
        <button class="btn btn-outline-secondary" type="submit">Buscar</button>
    </form>

    <a href="{{ route('entradas.create') }}" class="btn btn-primary">Nuevo registro</a>
</div>

<div class="table-responsive">
    <table class="table table-striped">
        <thead>
            <tr>
                <th>
                    <a href="{{ request()->fullUrlWithQuery(['sort' => 'fecha', 'direction' => (request('sort')=='fecha' && request('direction')=='asc') ? 'desc' : 'asc']) }}">
                        Fecha
                    </a>
                </th>
                <th>
                    <a href="{{ request()->fullUrlWithQuery(['sort' => 'hora', 'direction' => (request('sort')=='hora' && request('direction')=='asc') ? 'desc' : 'asc']) }}">
                        Hora
                    </a>
                </th>
                <th>
                    <a href="{{ request()->fullUrlWithQuery(['sort' => 'quien_envio', 'direction' => (request('sort')=='quien_envio' && request('direction')=='asc') ? 'desc' : 'asc']) }}">
                        Quien envió
                    </a>
                </th>
                <th>
                    <a href="{{ request()->fullUrlWithQuery(['sort' => 'quien_recibio', 'direction' => (request('sort')=='quien_recibio' && request('direction')=='asc') ? 'desc' : 'asc']) }}">
                        Quien recibió
                    </a>
                </th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse($entradas as $entrada)
                <tr>
                    <td>{{ optional($entrada->fecha)->format('Y-m-d') }}</td>
                    <td>{{ $entrada->hora }}</td>
                    <td>{{ $entrada->quien_envio }}</td>
                    <td>{{ $entrada->quien_recibio }}</td>
                    <td>
                        <a href="{{ route('entradas.show', $entrada) }}" class="btn btn-sm btn-outline-secondary" title="Ver" aria-label="Ver registro">👁️</a>
                        <a href="{{ route('entradas.detalle.index', $entrada) }}" class="btn btn-sm btn-outline-info" title="Detalles" aria-label="Ver detalles">📋</a>
                        <a href="{{ route('entradas.edit', $entrada) }}" class="btn btn-sm btn-outline-primary" title="Editar" aria-label="Editar registro">✏️</a>
                        <form action="{{ route('entradas.destroy', $entrada) }}" method="POST" style="display:inline" onsubmit="return confirm('¿Eliminar este registro?');">
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
        Showing {{ $entradas->firstItem() ?? 0 }} to {{ $entradas->lastItem() ?? 0 }} of {{ $entradas->total() }} results
    </div>
    <div>
        {{ $entradas->links('pagination::bootstrap-5') }}
    </div>
</div>

@endsection
