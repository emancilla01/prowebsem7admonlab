<?php $__env->startSection('menu2'); ?>
    <?php echo $__env->make('menu2', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('contenido2'); ?>

<div class="container mt-4">
    <div class="card">
        <div class="card-header">Detalle de la Entrada</div>

        <div class="card-body">
            <dl class="row">
                <dt class="col-sm-3">ID</dt>
                <dd class="col-sm-9"><?php echo e($entrada->id); ?></dd>

                <dt class="col-sm-3">Fecha</dt>
                <dd class="col-sm-9"><?php echo e(optional($entrada->fecha)->format('Y-m-d')); ?></dd>

                <dt class="col-sm-3">Hora</dt>
                <dd class="col-sm-9"><?php echo e($entrada->hora); ?></dd>

                <dt class="col-sm-3">Quien envió</dt>
                <dd class="col-sm-9"><?php echo e($entrada->quien_envio); ?></dd>

                <dt class="col-sm-3">Quien recibió</dt>
                <dd class="col-sm-9"><?php echo e($entrada->quien_recibio); ?></dd>

                <dt class="col-sm-3">Lugar</dt>
                <dd class="col-sm-9"><?php echo e($entrada->lugar); ?></dd>

                <dt class="col-sm-3">Creado</dt>
                <dd class="col-sm-9"><?php echo e($entrada->created_at); ?></dd>

                <dt class="col-sm-3">Actualizado</dt>
                <dd class="col-sm-9"><?php echo e($entrada->updated_at); ?></dd>
            </dl>

            <div class="d-flex justify-content-between">
                <a href="<?php echo e(route('entradas.index')); ?>" class="btn btn-secondary">Volver</a>
                <a href="<?php echo e(route('entradas.edit', $entrada)); ?>" class="btn btn-primary">Editar</a>
            </div>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>


<?php echo $__env->make('plantillas.login2', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Usuario\Herd\admonlab\resources\views/entradas/show.blade.php ENDPATH**/ ?>