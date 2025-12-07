<?php $__env->startSection('menu2'); ?>
    <?php echo $__env->make('menu2', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('contenido2'); ?>
<div class="container mt-4">
    <div class="card">
        <div class="card-header">Detalle de Entrada</div>

        <div class="card-body">
            <dl class="row">
                <dt class="col-sm-3">ID</dt>
                <dd class="col-sm-9"><?php echo e($detalle->id); ?></dd>

                <dt class="col-sm-3">Entrada ID</dt>
                <dd class="col-sm-9"><?php echo e($detalle->id_entrada); ?></dd>

                <dt class="col-sm-3">No. Serie</dt>
                <dd class="col-sm-9"><?php echo e($detalle->no_serie ?? '—'); ?></dd>

                <dt class="col-sm-3">Espacio de Trabajo</dt>
                <dd class="col-sm-9"><?php echo e(optional($detalle->espacioTrabajo)->nombre_espacio ?? '—'); ?></dd>

                <dt class="col-sm-3">ID equipo de cómputo</dt>
                <dd class="col-sm-9"><?php echo e(optional($detalle->ecmDetequcom)->serial); ?></dd>

                <dt class="col-sm-3">ID mobiliario</dt>
                <dd class="col-sm-9"><?php echo e(optional($detalle->ecmDetmob)->codigo); ?></dd>

                <dt class="col-sm-3">Creado</dt>
                <dd class="col-sm-9"><?php echo e($detalle->created_at); ?></dd>

                <dt class="col-sm-3">Actualizado</dt>
                <dd class="col-sm-9"><?php echo e($detalle->updated_at); ?></dd>
            </dl>

            <div class="d-flex justify-content-between">
                <a href="<?php echo e(route('entradas.detalle.index', $entrada)); ?>" class="btn btn-secondary">Volver</a>
                <a href="<?php echo e(route('entradas.detalle.edit', [$entrada, $detalle])); ?>" class="btn btn-primary">Editar</a>
            </div>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('plantillas.login2', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Usuario\Herd\admonlab\resources\views/entradasdet/show.blade.php ENDPATH**/ ?>