<?php echo $__env->make('menu2', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<?php $__env->startSection('contenido2'); ?>

<div class="container mt-3">
    <h3>Software instalado por Equipo de cómputo</h3>

    <form method="GET" action="<?php echo e(route('consultas.software_equipo')); ?>" class="mb-3">
        <div class="input-group">
            <input type="search" name="filtro_equipo" value="<?php echo e(request('filtro_equipo')); ?>" class="form-control" placeholder="Buscar por equipo o serial" aria-label="Buscar por equipo o serial">
            <button class="btn btn-primary" type="submit">Buscar</button>
        </div>
    </form>

    <div class="table-responsive">
        <table class="table table-sm table-striped">
            <thead>
                <tr>
                    <th>Equipo de Cómputo</th>
                    <th>No. Serie</th>
                    <th>Procesador</th>
                    <th>Memoria RAM</th>
                    <th>Almacenamiento (HD)</th>
                    <th>Resolución de pantalla</th>
                    <th>Pantalla táctil</th>
                    <th>Software instalado</th>
                </tr>
            </thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $registros; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $r): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td><?php echo e($r->equipo ?? '—'); ?></td>
                        <td><?php echo e($r->no_serie ?? '—'); ?></td>
                        <td><?php echo e($r->procesador ?? '—'); ?></td>
                        <td><?php echo e($r->memoria_ram ?? '—'); ?></td>
                        <td><?php echo e($r->almacenamiento_hd ?? '—'); ?></td>
                        <td><?php echo e($r->resolucion_pantalla ?? '—'); ?></td>
                        <td><?php echo e($r->pantalla_tactil ?? '—'); ?></td>
                        <td><?php echo e($r->software_instalado ?? '—'); ?></td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="8">No se encontraron registros.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

</div>

    <div class="d-flex justify-content-center mt-2">
        <?php echo e($registros->links()); ?>

    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('plantillas.login2', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Usuario\Herd\admonlab\resources\views/consultas/software_equipo.blade.php ENDPATH**/ ?>