<?php $__env->startSection('menu2'); ?>
    <?php echo $__env->make('menu2', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('contenido2'); ?>

<h2>Detalle de Salida #<?php echo e($salida->id); ?> — Item #<?php echo e($detalle->id); ?></h2>

<div class="card mb-3">
    <div class="card-body">
        <dl class="row">
            <dt class="col-sm-3">ID</dt>
            <dd class="col-sm-9"><?php echo e($detalle->id); ?></dd>

            <dt class="col-sm-3">Entrada (No. serie)</dt>
            <dd class="col-sm-9"><?php echo e(optional($detalle->entradaDetalle)->no_serie ?? '—'); ?></dd>

            <dt class="col-sm-3">Motivo</dt>
            <dd class="col-sm-9"><?php echo e($detalle->motivo_de_salida); ?></dd>

            <dt class="col-sm-3">Creado</dt>
            <dd class="col-sm-9"><?php echo e($detalle->created_at); ?></dd>
        </dl>

        <div class="d-flex justify-content-between">
            <div>
                <a href="<?php echo e(route('salidas.detalle.index', $salida)); ?>" class="btn btn-secondary">Volver a detalles</a>
            </div>
            <div>
                <a href="<?php echo e(route('salidas.detalle.edit', [$salida, $detalle])); ?>" class="btn btn-primary">Editar</a>
                <form action="<?php echo e(route('salidas.detalle.destroy', [$salida, $detalle])); ?>" method="POST" style="display:inline" onsubmit="return confirm('¿Eliminar este detalle?');">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('DELETE'); ?>
                    <button class="btn btn-danger">Eliminar</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('plantillas.login2', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Usuario\Herd\admonlab\resources\views/salidasdet/show.blade.php ENDPATH**/ ?>