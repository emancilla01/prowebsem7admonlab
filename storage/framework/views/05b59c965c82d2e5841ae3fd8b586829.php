<?php $__env->startSection('menu2'); ?>
    <?php echo $__env->make('menu2', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('contenido2'); ?>
<div class="container mt-4">
    <h2>Detalle relación #<?php echo e($item->id); ?></h2>

    <div class="mb-3"><strong>Software:</strong> <?php echo e($item->software?->nombre_software); ?> <?php if($item->software?->version): ?> (v<?php echo e($item->software->version); ?>) <?php endif; ?></div>
    <div class="mb-3"><strong>Materia:</strong> <?php echo e($item->materia?->nombre); ?> (<?php echo e($item->materia?->clave); ?>)</div>
    <div class="mb-3"><strong>Observaciones:</strong> <?php echo e($item->observaciones); ?></div>

    <div class="mt-3">
        <a href="<?php echo e(route('software.materias.index', ['software' => $item->id_software])); ?>" class="btn btn-secondary">Volver a lista filtrada</a>
        <a href="<?php echo e(route('software.materias.edit', $item)); ?>" class="btn btn-primary">Editar</a>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('plantillas.login2', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Usuario\Herd\admonlab\resources\views/softwarematerias/show.blade.php ENDPATH**/ ?>