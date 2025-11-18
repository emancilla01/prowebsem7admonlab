<?php $__env->startSection('menu2'); ?>
    <?php echo $__env->make('menu2', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('contenido2'); ?>
<div class="container mt-4">
    <h2>Detalle mobiliario</h2>

    <div class="mb-3"><strong>ID:</strong> <?php echo e($item->id); ?></div>
    <div class="mb-3"><strong>Código:</strong> <?php echo e($item->codigo); ?></div>
    <div class="mb-3"><strong>Descripción:</strong> <?php echo e($item->descripcion); ?></div>
    <div class="mb-3"><strong>Material:</strong> <?php echo e($item->material); ?></div>
    <div class="mb-3"><strong>Estado:</strong> <?php echo e($item->estado); ?></div>
    <div class="mb-3"><strong>Fecha adquisición:</strong> <?php echo e($item->fecha_adquisicion); ?></div>
    <div class="mb-3"><strong>Ubicación:</strong> <?php echo e($item->ubicacion); ?></div>
    <div class="mb-3"><strong>Espacio:</strong> <?php echo e($item->espacio?->nombre_espacio); ?></div>

    <div class="mt-3">
        <a href="<?php echo e(route('ecm_detmob.index', ['id_ecm' => $item->id_ecm])); ?>" class="btn btn-secondary">Volver</a>
        <a href="<?php echo e(route('ecm_detmob.edit', $item->id)); ?>" class="btn btn-primary">Editar</a>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('plantillas.login2', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Usuario\Herd\admonlab\resources\views/ecmdetm/show.blade.php ENDPATH**/ ?>