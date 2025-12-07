<?php echo $__env->make('menu2', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<?php $__env->startSection('contenido2'); ?>
    <div class="container">
        <h3>Consultas: Por Espacios de Trabajo</h3>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Espacio</th>
                    <th>descripción del Equipo de cómputo o Mobiliario</th>
                    <th class="text-right">Total Equipo</th>
                    <th class="text-right">Total Mobiliario</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $espaciosResumen; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $esp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($esp->nombre); ?></td>
                        <td><?php echo e($esp->descripcion); ?></td>
                        <td class="text-right"><?php echo e($esp->total_equipo); ?></td>
                        <td class="text-right"><?php echo e($esp->total_mobiliario); ?></td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>

    </div>
    <div>
        <?php echo e($espaciosResumen->links('pagination::bootstrap-5')); ?>

    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('plantillas.login2', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Usuario\Herd\admonlab\resources\views/consultas/espacios.blade.php ENDPATH**/ ?>