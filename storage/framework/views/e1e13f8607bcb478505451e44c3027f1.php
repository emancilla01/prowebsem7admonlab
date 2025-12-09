<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Práctica - Login</title>
    <?php echo app('Illuminate\Foundation\Vite')(['resources/js/app2.ts']); ?>
    <style>
        /* layout: center container and column widths to match mockup */
        .layout-center { max-width: 1200px; margin: 0 auto; }
        .menu-card { background: #fff; border-radius: 0.5rem; box-shadow: 0 6px 18px rgba(18,38,63,0.06); padding: .75rem; }
        .menu-card h6{ margin:0 0 .5rem 0; font-size:1rem; }
        .menu-card .small-list { font-size:.95rem; line-height:1.4; }
        .menu-card a { color: #0b5ed7; }

        /* center panel styles */
        .welcome-card { min-height: 78vh; display:flex; align-items:center; justify-content:center; }
        .welcome-card h1 { font-weight:400; font-size:3.25rem; color:#222; margin:0; }

        /* right sidebar compact gradient box */
        .right-sidebar { background: linear-gradient(180deg,#2563eb 0%,#1e40af 100%); color: #fff; padding: 1rem; border-radius: 0.5rem; }
        .right-sidebar h6{ color: #fff; margin:0 0 .75rem 0; }
        .right-sidebar .menu-list a{ color: rgba(255,255,255,0.85); text-decoration:underline; display:block; margin:.4rem 0; }

        /* Menu3 slim card under center column */
        .menu3-card { padding:.6rem; border-radius:.4rem; background:#fff; box-shadow: 0 4px 10px rgba(0,0,0,0.04); }

        /* responsive tweaks */
        @media (max-width: 767px){
            .welcome-card { min-height: 50vh; }
            .welcome-card h1 { font-size:2rem; }
        }
    </style>
</head>
<body class="bg-light">
    <div class="container-fluid p-3">
        <div class="layout-center">
            <div class="row">
                <!-- Left column: compact Menu 1 -->
                <aside class="col-12 col-md-2">
                    <div class="menu-card">
                        <h6>Menú 1</h6>
                        <?php if(auth()->guard()->guest()): ?>
                            <div class="small-list">
                                <div>Acerca de...</div>
                                <div style="margin-left:.6rem; font-size:.95rem; color:#555;">Nombre completo<br/>Carrera<br/>Semestre<br/>No. de control</div>
                                <div style="margin-top:.6rem;"><a href="<?php echo e(route('login')); ?>">Login</a></div>
                                <div><a href="<?php echo e(route('register')); ?>">Register</a></div>
                            </div>
                        <?php endif; ?>
                        <?php if(auth()->guard()->check()): ?>
                            <div class="small-list">
                                <div><?php echo e(auth()->user()->name); ?></div>
                                <div style="color:#555; font-size:.9rem;"><?php echo e(auth()->user()->email); ?></div>
                                <div style="margin-top:.6rem;"><a href="<?php echo e(url('/logout')); ?>">Logout</a></div>
                            </div>
                        <?php endif; ?>
                    </div>
                </aside>

                <!-- Main column -->
                <main class="col-12 col-md-8">
                    <div class="card mb-3 welcome-card">
                        <div class="card-body">
                            <h1>Bienvenido al sistema IO</h1>
                        </div>
                    </div>

                    <!-- Menu3 (slim) -->
                    <div class="menu3-card mt-3">
                        <h6 style="margin-top:0; margin-bottom:.5rem;">Menú 3</h6>
                        <?php if(auth()->guard()->check()): ?>
                            <div><a href="<?php echo e(route('espaciosdetrabajo.index')); ?>">Espacios de Trabajo</a> &nbsp;|&nbsp; <a href="<?php echo e(route('grupos.index')); ?>">Alumnos</a></div>
                        <?php else: ?>
                            <div>Menú 3 (visible después de iniciar sesión)</div>
                        <?php endif; ?>
                    </div>
                </main>

                <!-- Right sidebar: compact Menu2 -->
                <aside class="col-12 col-md-2">
                    <div class="right-sidebar">
                        <h6>Menú 2</h6>
                        <?php if(auth()->guard()->check()): ?>
                            <div class="menu-list">
                                <a href="<?php echo e(route('personal.index')); ?>">Maestros</a>
                                <a href="<?php echo e(route('periodos.index')); ?>">Periodos</a>
                                <a href="<?php echo e(route('carreras.index')); ?>">Carreras</a>
                            </div>
                        <?php else: ?>
                            <div style="padding:.75rem .5rem; background: rgba(255,255,255,0.06); border-radius:.25rem;">Inicia sesión para ver el Menú 2</div>
                        <?php endif; ?>
                    </div>
                </aside>
            </div>

            <footer class="mt-4">
                <nav class="navbar bg-white border-top">
                    <div class="container-fluid justify-content-center py-2">
                        <span class="text-muted">LARAVEL - BOOTSTRAP - PHP - MYSQL - VITE</span>
                    </div>
                </nav>
            </footer>
        </div>
    </div>
</body>
</html><?php /**PATH C:\Users\Usuario\Herd\admonlab\resources\views/plantillas/login.blade.php ENDPATH**/ ?>