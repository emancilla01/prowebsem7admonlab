<?php $__env->startSection('menu2'); ?>
    <?php echo $__env->make('menu2', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('contenido2'); ?>

<div class="container mt-4">
    <div class="card">
        <div class="card-header">Detalle del Espacio</div>

        <div class="card-body">
            <dl class="row">
                <dt class="col-sm-3">ID</dt>
                <dd class="col-sm-9"><?php echo e($espacio->id_espacio); ?></dd>

                <dt class="col-sm-3">Nombre</dt>
                <dd class="col-sm-9"><?php echo e($espacio->nombre_espacio); ?></dd>

                <dt class="col-sm-3">Tipo</dt>
                <dd class="col-sm-9"><?php echo e($espacio->tipo_espacio); ?></dd>

                <dt class="col-sm-3">Ubicación</dt>
                <dd class="col-sm-9"><?php echo e($espacio->ubicacion); ?></dd>

                <dt class="col-sm-3">Capacidad</dt>
                <dd class="col-sm-9"><?php echo e($espacio->capacidad); ?></dd>

                <dt class="col-sm-3">Responsable</dt>
                <dd class="col-sm-9"><?php echo e($espacio->responsable); ?></dd>
            </dl>

            <div class="d-flex justify-content-between">
                <a href="<?php echo e(route('espaciosdetrabajo.index')); ?>" class="btn btn-secondary">Volver</a>
                <a href="<?php echo e(route('espaciosdetrabajo.edit', $espacio)); ?>" class="btn btn-primary">Editar</a>
            </div>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('plantillas.login2', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Usuario\Herd\admonlab\resources\views/espaciosdetrabajo/show.blade.php ENDPATH**/ ?>