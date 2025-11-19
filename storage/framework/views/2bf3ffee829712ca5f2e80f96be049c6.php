<?php $__env->startSection('menu2'); ?>
    <?php echo $__env->make('menu2', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('contenido2'); ?>
<div class="container mt-4">
    <div class="card">
        <div class="card-header">Detalle del Periodo</div>

        <div class="card-body">
            <dl class="row">
                <dt class="col-sm-3">ID</dt>
                <dd class="col-sm-9"><?php echo e($periodo->id); ?></dd>

                <dt class="col-sm-3">Nombre</dt>
                <dd class="col-sm-9"><?php echo e($periodo->nombre); ?></dd>

                <dt class="col-sm-3">Fecha inicio</dt>
                <dd class="col-sm-9"><?php echo e($periodo->fecha_inicio); ?></dd>

                <dt class="col-sm-3">Fecha fin</dt>
                <dd class="col-sm-9"><?php echo e($periodo->fecha_fin); ?></dd>
            </dl>

            <div class="d-flex justify-content-between">
                <a href="<?php echo e(route('periodos.index')); ?>" class="btn btn-secondary">Volver</a>
                <a href="<?php echo e(route('periodos.edit', $periodo)); ?>" class="btn btn-primary">Editar</a>
            </div>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('plantillas.login2', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Usuario\Herd\admonlab\resources\views/periodos/show.blade.php ENDPATH**/ ?>