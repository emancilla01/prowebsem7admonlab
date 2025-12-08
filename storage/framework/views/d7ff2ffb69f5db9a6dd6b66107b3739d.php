<?php $__env->startSection('menu2'); ?>
    <?php echo $__env->make('menu2', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('contenido2'); ?>
<div class="container mt-4">
    <div class="card">
        <div class="card-header">Detalle de la Categoría</div>

        <div class="card-body">
            <dl class="row">
                <dt class="col-sm-3">ID</dt>
                <dd class="col-sm-9"><?php echo e($categoria->id); ?></dd>

                <dt class="col-sm-3">Nombre</dt>
                <dd class="col-sm-9"><?php echo e($categoria->nombre); ?></dd>

                <dt class="col-sm-3">Descripción</dt>
                <dd class="col-sm-9"><?php echo e($categoria->descripcion); ?></dd>

                <dt class="col-sm-3">Creado</dt>
                <dd class="col-sm-9"><?php echo e($categoria->created_at?->format('Y-m-d')); ?></dd>
            </dl>

            <div class="d-flex justify-content-between">
                <a href="<?php echo e(route('categorias.index')); ?>" class="btn btn-secondary">Volver</a>
                <a href="<?php echo e(route('categorias.edit', $categoria)); ?>" class="btn btn-primary">Editar</a>
            </div>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('plantillas.login2', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Usuario\Herd\admonlab\resources\views/categorias/show.blade.php ENDPATH**/ ?>