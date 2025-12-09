<?php $__env->startSection('menu2'); ?>
    <?php echo $__env->make('menu2', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('contenido2'); ?>
<div class="container mt-4">
    <h2>Detalle de Materia</h2>

    <div class="mb-3">
        <strong>ID:</strong> <?php echo e($materia->id); ?>

    </div>
    <div class="mb-3">
        <strong>Clave:</strong> <?php echo e($materia->clave); ?>

    </div>
    <div class="mb-3">
        <strong>Nombre:</strong> <?php echo e($materia->nombre); ?>

    </div>
    <div class="mb-3">
        <strong>Carrera:</strong> <?php echo e($materia->carrera?->nombre_carrera); ?>

    </div>
    <div class="mb-3">
        <strong>Requiere laboratorio:</strong> <?php echo e($materia->requiere_lab ? 'Sí' : 'No'); ?>

    </div>
    <div class="mb-3">
        <strong>Tipo de uso:</strong> <?php echo e($materia->tipo_uso); ?></div>
    <div class="mb-3">
        <strong>Estatus:</strong> <?php echo e($materia->estatus); ?></div>
    <div class="mb-3">
        <strong>Creado:</strong> <?php echo e($materia->created_at?->format('Y-m-d')); ?></div>

    <div class="d-flex gap-2">
        <a href="<?php echo e(route('materias.edit', $materia)); ?>" class="btn btn-primary">Editar</a>
        <a href="<?php echo e(route('materias.index')); ?>" class="btn btn-secondary">Volver</a>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('plantillas.login2', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Usuario\Herd\admonlab\resources\views/materias/show.blade.php ENDPATH**/ ?>