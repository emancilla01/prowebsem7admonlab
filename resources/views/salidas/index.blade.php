@extends('plantillas.login2')
@section('menu2')
    @include('menu2')
@endsection
@section('contenido2')
<h2>Salidas</h2>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="d-flex justify-content-between mb-3">
    <form class="d-flex" method="GET" action="{{ route('salidas.index') }}">
        <input class="form-control me-2" type="search" name="q" value="{{ request('q') }}" placeholder="Buscar...">
        <input type="hidden" name="sort" value="{{ request('sort', $sort ?? '') }}">
        <input type="hidden" name="dir" value="{{ request('dir', $dir ?? '') }}">
        <button class="btn btn-outline-secondary" type="submit">Buscar</button>
    </form>

    <a href="{{ route('salidas.create') }}" class="btn btn-primary">Nueva salida</a>
</div>

<div class="table-responsive">
    <table class="table table-striped">
        <thead>
            <tr>
                @php
                    $currentSort = $sort ?? request('sort', 'fecha');
                    $currentDir = $dir ?? request('dir', 'desc');
                    $toggleDir = fn($col) => ($currentSort === $col && $currentDir === 'asc') ? 'desc' : 'asc';
                    $link = fn($col) => request()->fullUrlWithQuery(['sort' => $col, 'dir' => $toggleDir($col)]);
                    $caret = fn($col) => ($currentSort === $col) ? ($currentDir === 'asc' ? '▲' : '▼') : '';
                @endphp

                <th><a href="{{ $link('fecha') }}">Fecha {{ $caret('fecha') }}</a></th>
                <th><a href="{{ $link('hora') }}">Hora {{ $caret('hora') }}</a></th>
                <th><a href="{{ $link('quien_autorizo') }}">Quien autorizó {{ $caret('quien_autorizo') }}</a></th>
                <th><a href="{{ $link('quien_registro') }}">Quien registró {{ $caret('quien_registro') }}</a></th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse($salidas as $salida)
                <tr>
                    <td>{{ optional($salida->fecha)->format('Y-m-d') }}</td>
                    <td>{{ $salida->hora }}</td>
                    <td>{{ $salida->quien_autorizo }}</td>
                    <td>{{ $salida->quien_registro }}</td>
                    <td>
                        <a href="{{ route('salidas.show', $salida) }}" class="btn btn-sm btn-outline-secondary" title="Ver">👁️</a>
                        <a href="{{ route('salidas.edit', $salida) }}" class="btn btn-sm btn-outline-primary" title="Editar">✏️</a>
                        <form action="{{ route('salidas.destroy', $salida) }}" method="POST" style="display:inline" onsubmit="return confirm('¿Eliminar esta salida?');">
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
        Mostrando {{ $salidas->firstItem() ?? 0 }} a {{ $salidas->lastItem() ?? 0 }} de {{ $salidas->total() }} resultados
    </div>
    <div>
        {{ $salidas->links('pagination::bootstrap-5') }}
    </div>
</div>

@endsection