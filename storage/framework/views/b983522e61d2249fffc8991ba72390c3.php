<?php $__env->startSection('menu2'); ?>
    <?php echo $__env->make('menu2', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('contenido2'); ?>
<div class="container mt-4">
    <h2>Detalle de Grupo</h2>

    <div class="mb-3"><strong>ID:</strong> <?php echo e($grupo->id); ?></div>
    <div class="mb-3"><strong>Clave:</strong> <?php echo e($grupo->clave_grupo); ?></div>
    <div class="mb-3"><strong>Nombre:</strong> <?php echo e($grupo->nombre_grupo); ?></div>
    <div class="mb-3"><strong>Materia:</strong> <?php echo e($grupo->materia?->nombre); ?></div>
    <div class="mb-3"><strong>Periodo:</strong> <?php echo e($grupo->periodo?->nombre); ?></div>
    <div class="mb-3"><strong>Maestro:</strong> <?php echo e($grupo->personal?->nombre); ?></div>
    <div class="mb-3"><strong>Carrera:</strong> <?php echo e($grupo->carrera?->nombre_carrera); ?></div>
    <div class="mb-3"><strong>Turno:</strong> <?php echo e($grupo->turno); ?></div>
    <div class="mb-3"><strong>Estatus:</strong> <?php echo e($grupo->estatus); ?></div>

    <div class="d-flex gap-2">
        <a href="<?php echo e(route('grupos.edit', $grupo)); ?>" class="btn btn-primary">Editar</a>
        <a href="<?php echo e(route('grupos.index')); ?>" class="btn btn-secondary">Volver</a>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('plantillas.login2', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Usuario\Herd\admonlab\resources\views/grupos/show.blade.php ENDPATH**/ ?>