<nav
    class="navbar navbar-expand-sm navbar-dark bg-primary"
   >
    <a class="navbar-brand d-flex align-items-center gap-2" href="<?php echo e(url('/dashboard')); ?>">
        <img src="<?php echo e(asset('logo.png')); ?>" alt="Logo" style="height:56px;" />        
    </a>
    
    <div class="collapse navbar-collapse" id="collapsibleNavId">
        <ul class="navbar-nav me-auto mt-2 mt-lg-0">
            <li class="nav-item">
                <a class="nav-link active" href="<?php echo e(url('/categorias')); ?>" aria-current="page"
                    >Categorias <span class="visually-hidden">(current)</span></a
                >
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="<?php echo e(url('/personal')); ?>" aria-current="page"
                    >Personal <span class="visually-hidden">(current)</span></a
                >
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="<?php echo e(url('/periodos')); ?>" aria-current="page"
                    >Periodos <span class="visually-hidden">(current)</span></a
                >
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="<?php echo e(url('/carreras')); ?>" aria-current="page"
                    >Carreras <span class="visually-hidden">(current)</span></a
                >
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="<?php echo e(url('/materias')); ?>" aria-current="page"
                    >Materias <span class="visually-hidden">(current)</span></a
                >
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="<?php echo e(url('/grupos')); ?>" aria-current="page"
                    >Grupos <span class="visually-hidden">(current)</span></a
                >
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="<?php echo e(url('/espaciosdetrabajo')); ?>" aria-current="page"
                    >Espacios de Trabajo <span class="visually-hidden">(current)</span></a
                >
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="<?php echo e(url('/software')); ?>" aria-current="page"
                    >Software <span class="visually-hidden">(current)</span></a
                >
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="<?php echo e(url('/entradas')); ?>" aria-current="page"
                    >Entradas <span class="visually-hidden">(current)</span></a
                >
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="<?php echo e(route('salidas.index')); ?>" aria-current="page"
                    >Salidas <span class="visually-hidden">(current)</span></a
                >
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="<?php echo e(route('ecm_equcommob.index')); ?>" aria-current="page"
                    >ECM - Inventario <span class="visually-hidden">(current)</span></a
                >
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="consultasDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Consultas al inventario
                </a>
                <ul class="dropdown-menu" aria-labelledby="consultasDropdown">
                    <li><a class="dropdown-item" href="<?php echo e(route('consultas.categorias')); ?>">Por Categoría</a></li>
                    <li><a class="dropdown-item" href="<?php echo e(route('consultas.personal')); ?>">Por Personal</a></li>
                    <li><a class="dropdown-item" href="<?php echo e(route('consultas.espacios')); ?>">Por Espacios de Trabajo</a></li>
                    <li><a class="dropdown-item" href="<?php echo e(route('consultas.software_equipo')); ?>">Software por Equipo</a></li>
                </ul>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="logout" aria-current="page"
                    >Logout <span class="visually-hidden">(current)</span></a
                >
            </li>
            
        </ul>
        
    </div>
</nav><?php /**PATH C:\Users\Usuario\Herd\admonlab\resources\views/menu2.blade.php ENDPATH**/ ?>