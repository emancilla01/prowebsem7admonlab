<?php $__env->startSection('menu2'); ?>
    <?php echo $__env->make('menu2', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('contenido2'); ?>

<div class="container mt-4">
    <div class="card">
        <div class="card-header">Detalle del Software</div>

        <div class="card-body">
            <dl class="row">
                <dt class="col-sm-3">ID</dt>
                <dd class="col-sm-9"><?php echo e($software->id_software); ?></dd>

                <dt class="col-sm-3">Nombre</dt>
                <dd class="col-sm-9"><?php echo e($software->nombre_software); ?></dd>

                <dt class="col-sm-3">Versión</dt>
                <dd class="col-sm-9"><?php echo e($software->version); ?></dd>

                <dt class="col-sm-3">Licencia</dt>
                <dd class="col-sm-9"><?php echo e($software->licencia); ?></dd>

                <dt class="col-sm-3">Proveedor</dt>
                <dd class="col-sm-9"><?php echo e($software->proveedor); ?></dd>

                <dt class="col-sm-3">Fecha instalación</dt>
                <dd class="col-sm-9"><?php echo e($software->fecha_instalacion); ?></dd>

                <dt class="col-sm-3">Espacio</dt>
                <dd class="col-sm-9"><?php echo e(optional($software->espacioTrabajo)->nombre_espacio ?? 'N/A'); ?></dd>
            </dl>

            <div class="d-flex justify-content-between">
                <a href="<?php echo e(route('software.index')); ?>" class="btn btn-secondary">Volver</a>
                <div>
                    <a href="<?php echo e(route('software.materias.index', $software->id_software)); ?>" class="btn btn-info">Ver materias que requieren este software</a>
                    <a href="<?php echo e(route('software.edit', $software)); ?>" class="btn btn-primary">Editar</a>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('plantillas.login2', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Usuario\Herd\admonlab\resources\views/software/show.blade.php ENDPATH**/ ?>