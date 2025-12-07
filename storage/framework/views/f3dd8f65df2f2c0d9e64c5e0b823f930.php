

<?php $__env->startSection('menu2'); ?>
    <?php echo $__env->make('menu2', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('contenido2'); ?>

<div class="container mt-3">
    <h3>Por Carreras que solicitaron el Software</h3>

    <div class="table-responsive">
        <table class="table table-sm table-striped">
            <thead>
                <tr>
                    <th>Periodo</th>
                    <th>Carrera</th>
                    <th>Materia</th>
                    <th>Maestro</th>
                    <th>Software</th>
                    <th>No serie del Eqi. Comp</th>
                </tr>
            </thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $registros; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td><?php echo e($item->periodo ?? '—'); ?></td>
                        <td><?php echo e($item->carrera ?? '—'); ?></td>
                        <td><?php echo e($item->materia ?? '—'); ?></td>
                        <td><?php echo e($item->maestro ?? '—'); ?></td>
                        <td><?php echo e($item->software ?? '—'); ?></td>
                        <td><?php echo e($item->no_serie ?? '—'); ?></td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="6">No se encontraron registros.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <div class="d-flex justify-content-center mt-2">
        <?php echo e($registros->links()); ?>

    </div>

</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('plantillas.login2', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Usuario\Herd\admonlab\resources\views/consultas/carreras_software.blade.php ENDPATH**/ ?>