<?php $__env->startSection('menu2'); ?>
    <?php echo $__env->make('menu2', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('contenido2'); ?>
<div class="container mt-4">
    <h2>Detalle ECM: <?php echo e($ecm->codigo ?? ''); ?></h2>

    <div class="mb-3"><strong>Código:</strong> <?php echo e($ecm->codigo); ?></div>
    <div class="mb-3"><strong>Descripción:</strong> <?php echo e($ecm->descripcion); ?></div>
    <div class="mb-3"><strong>Categoría:</strong> <?php echo e($ecm->categoria?->nombre); ?></div>
    <div class="mb-3"><strong>Tipo:</strong> <?php echo e($ecm->tipo); ?></div>
    <div class="mb-3"><strong>Estado:</strong> <?php echo e($ecm->estado); ?></div>
    <div class="mb-3"><strong>Fecha de alta:</strong> <?php echo e($ecm->fecha_alta); ?></div>

    <div class="mt-3">
        <?php if(\Illuminate\Support\Facades\Route::has('ecm_detequcom.index')): ?>
            <a href="<?php echo e(route('ecm_detequcom.index', ['id_ecm' => $ecm->id])); ?>" class="btn btn-outline-primary">Ver equipo de cómputo</a>
        <?php endif; ?>
        <?php if(\Illuminate\Support\Facades\Route::has('ecm_detmob.index')): ?>
            <a href="<?php echo e(route('ecm_detmob.index', ['id_ecm' => $ecm->id])); ?>" class="btn btn-outline-secondary">Ver mobiliario</a>
        <?php endif; ?>
    </div>

    <div class="mt-3">
        <a href="<?php echo e(route('ecm_equcommob.index')); ?>" class="btn btn-secondary">Volver</a>
        <a href="<?php echo e(route('ecm_equcommob.edit', $ecm->id)); ?>" class="btn btn-primary">Editar</a>
    </div>
</div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('plantillas.login2', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Usuario\Herd\admonlab\resources\views/ecm/show.blade.php ENDPATH**/ ?>