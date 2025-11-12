<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <p>EZEQUIEL MANCILLA</p>
    {{-- <p>carrera actual: <strong>{{ $carrera ?? 'No indicada' }}</strong></p> --}}

<ul>
    @foreach ($personales as $p)
        <li>{{ $p->id }}</li> {{ $p->nombre }}</li>
        @endforeach
    </ul>


    <form action="" method="get">
        <input type="text" name="nombre" value="{{ $personal->nombre }}">
        <button type="submit">Ver</button>

    {{-- <form action="{{ route('explicacion',['carrera' => 'Ingenieria en sistemas computacionales']) }}" method="get">
        <input type="text" name="carrera" placeholder="Escribe una carrera">
        <button type="submit">Ver</button>
    </form> --}}

    <p><a href="{{ route('home') }}">Regresar al inicio</a></p>

</body>
</html>