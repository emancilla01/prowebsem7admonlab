<?php $__env->startSection('menu2'); ?>
    <?php echo $__env->make('menu2', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('contenido2'); ?>
<div class="container mt-4">
    <div class="card">
        <div class="card-header">Detalle de la Carrera</div>

        <div class="card-body">
            <dl class="row">
                <dt class="col-sm-3">ID</dt>
                <dd class="col-sm-9"><?php echo e($carrera->id_carrera); ?></dd>

                <dt class="col-sm-3">Nombre</dt>
                <dd class="col-sm-9"><?php echo e($carrera->nombre_carrera); ?></dd>

                <dt class="col-sm-3">Clave</dt>
                <dd class="col-sm-9"><?php echo e($carrera->clave_carrera); ?></dd>

                <dt class="col-sm-3">Coordinador</dt>
                <dd class="col-sm-9"><?php echo e($carrera->coordinador); ?></dd>
            </dl>

            <div class="d-flex justify-content-between">
                <a href="<?php echo e(route('carreras.index')); ?>" class="btn btn-secondary">Volver</a>
                <a href="<?php echo e(route('carreras.edit', $carrera)); ?>" class="btn btn-primary">Editar</a>
            </div>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('plantillas.login2', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Usuario\Herd\admonlab\resources\views/carreras/show.blade.php ENDPATH**/ ?>