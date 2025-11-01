@extends('plantillas.login2')
@section('menu2')
    @include('menu2')
@endsection
@section('contenido2')
<div class="container mt-4">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header">Editar Personal</div>

                <div class="card-body">
                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('personal.update', $personal) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label class="form-label">RFC</label>
                            <input type="text" name="rfc" class="form-control" value="{{ old('rfc', $personal->rfc) }}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Nombre</label>
                            <input type="text" name="nombre" class="form-control" value="{{ old('nombre', $personal->nombre) }}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Apellido Paterno</label>
                            <input type="text" name="apellido_pat" class="form-control" value="{{ old('apellido_pat', $personal->apellido_pat) }}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Apellido Materno</label>
                            <input type="text" name="apellido_mat" class="form-control" value="{{ old('apellido_mat', $personal->apellido_mat) }}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" value="{{ old('email', $personal->email) }}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Sexo</label>
                            <select name="sexo" class="form-select">
                                @foreach(\App\Models\Personal::SEXO_VALUES as $s)
                                    <option value="{{ $s }}" {{ old('sexo', $personal->sexo) == $s ? 'selected' : '' }}>{{ strtoupper($s) }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Departamento</label>
                            <input type="text" name="depto" class="form-control" value="{{ old('depto', $personal->depto) }}">
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('personal.index') }}" class="btn btn-secondary">Cancelar</a>
                            <button class="btn btn-primary">Actualizar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection