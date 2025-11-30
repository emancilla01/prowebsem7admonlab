<?php $__env->startSection('menu2'); ?>
    <?php echo $__env->make('menu2', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('contenido2'); ?>
<h2>Salida #<?php echo e($salida->id); ?></h2>

<div class="card">
    <div class="card-body">
        <dl class="row">
            <dt class="col-sm-3">ID</dt>
            <dd class="col-sm-9"><?php echo e($salida->id); ?></dd>

            <dt class="col-sm-3">Fecha</dt>
            <dd class="col-sm-9"><?php echo e(optional($salida->fecha)->format('Y-m-d')); ?></dd>

            <dt class="col-sm-3">Hora</dt>
            <dd class="col-sm-9"><?php echo e($salida->hora); ?></dd>

            <dt class="col-sm-3">Quien autorizó</dt>
            <dd class="col-sm-9"><?php echo e($salida->quien_autorizo); ?></dd>

            <dt class="col-sm-3">Quien registró</dt>
            <dd class="col-sm-9"><?php echo e($salida->quien_registro); ?></dd>
        </dl>

        <div class="d-flex justify-content-between">
            <div>
                <a href="<?php echo e(route('salidas.index')); ?>" class="btn btn-secondary">Volver</a>
                <a href="<?php echo e(route('salidas.detalle.index', $salida)); ?>" class="btn btn-info">Ver detalles</a>
            </div>
            <a href="<?php echo e(route('salidas.edit', $salida)); ?>" class="btn btn-primary">Editar</a>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('plantillas.login2', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Usuario\Herd\admonlab\resources\views/salidas/show.blade.php ENDPATH**/ ?>