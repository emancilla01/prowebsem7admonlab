@extends('plantillas.login2')
@section('menu2')
    @include('menu2')
@endsection
@section('contenido2')

<h2>Detalles de Salida #{{ $salida->id }}</h2>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="d-flex justify-content-between mb-3">
    <form class="d-flex" method="GET" action="{{ route('salidas.detalle.index', $salida) }}">
        <input class="form-control me-2" type="search" name="q" value="{{ request('q') }}" placeholder="Buscar...">
        <input type="hidden" name="sort" value="{{ request('sort') }}">
        <input type="hidden" name="dir" value="{{ request('dir') }}">
        <button class="btn btn-outline-secondary" type="submit">Buscar</button>
    </form>

    <div>
        <a href="{{ route('salidas.index') }}" class="btn btn-outline-secondary">Volver</a>
        <a href="{{ route('salidas.detalle.create', $salida) }}" class="btn btn-primary">Nuevo detalle</a>
    </div>
</div>

<div class="table-responsive">
    <table class="table table-striped">
        <thead>
            <tr>
                @php
                    $currentSort = $sort ?? request('sort', 'id');
                    $currentDir = $dir ?? request('dir', 'desc');
                    $toggleDir = fn($col) => ($currentSort === $col && $currentDir === 'asc') ? 'desc' : 'asc';
                    $link = fn($col) => request()->fullUrlWithQuery(['sort' => $col, 'dir' => $toggleDir($col)]);
                    $caret = fn($col) => ($currentSort === $col) ? ($currentDir === 'asc' ? '▲' : '▼') : '';
                @endphp

                <th><a href="{{ $link('id') }}">ID {{ $caret('id') }}</a></th>
                <th><a href="{{ $link('no_serie') }}">No. Serie {{ $caret('no_serie') }}</a></th>
                <th><a href="{{ $link('motivo_de_salida') }}">Motivo {{ $caret('motivo_de_salida') }}</a></th>
                <th><a href="{{ $link('created_at') }}">Creado {{ $caret('created_at') }}</a></th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse($detalles as $detalle)
                <tr>
                    <td>{{ $detalle->id }}</td>
                    <td>{{ optional($detalle->entradaDetalle)->no_serie ?? '—' }}</td>
                    <td>{{ $detalle->motivo_de_salida }}</td>
                    <td>{{ $detalle->created_at }}</td>
                    <td>
                        <a href="{{ route('salidas.detalle.show', [$salida, $detalle]) }}" class="btn btn-sm btn-outline-secondary" title="Ver">👁️</a>
                        <a href="{{ route('salidas.detalle.edit', [$salida, $detalle]) }}" class="btn btn-sm btn-outline-primary" title="Editar">✏️</a>
                        <form action="{{ route('salidas.detalle.destroy', [$salida, $detalle]) }}" method="POST" style="display:inline" onsubmit="return confirm('¿Eliminar este detalle?');">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger" title="Eliminar">🗑️</button>
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
        Showing {{ $detalles->firstItem() ?? 0 }} to {{ $detalles->lastItem() ?? 0 }} of {{ $detalles->total() }} results
    </div>
    <div>
        {{ $detalles->links('pagination::bootstrap-5') }}
    </div>
</div>

@endsection