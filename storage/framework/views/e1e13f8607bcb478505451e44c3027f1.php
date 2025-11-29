<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php echo app('Illuminate\Foundation\Vite')(['resources/js/app2.ts']); ?>
</head>
<body>
    <div class="row">
            <div class="col">
                <?php echo $__env->yieldContent('menu'); ?>
            </div>
        </div>
    <div class="container">
                
        <div class="row">
            <div class="col">
                <?php echo $__env->yieldContent('contenido'); ?>
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
            <div>Derechos Reservados</div>
        </div>
    </nav>
    </div>
</body>
</html><?php /**PATH C:\Users\Usuario\Herd\admonlab\resources\views/plantillas/login.blade.php ENDPATH**/ ?>