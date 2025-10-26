<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    @vite(['resources/js/app.ts'])
</head>
<body>
    <div class="row">
            <div class="col">
                @yield('menu')
            </div>
        </div>
    <div class="container">
                
        <div class="row">
            <div class="col">
                @yield('contenido')
            </div>
        </div>

        <nav class="navbar fixed-bottom navbar-dark bg-primary">
        <div class="container-fluid justify-content-center">
            <span class="navbar-text text-center w-100">
                <a href="https://laravel.com" target="_blank">LARAVEL</a>
                <a href="https://getbootstrap.com" target="_blank"> - BOOTSTRAP</a>
                <a href="https://www.php.net" target="_blank"> - PHP</a>
                <a href="https://www.mysql.com" target="_blank"> - MYSQL</a>
                <a href="https://vitejs.dev" target="_blank"> - VITE</a>
            </span>
        </div>
    </nav>
    </div>
</body>
</html>