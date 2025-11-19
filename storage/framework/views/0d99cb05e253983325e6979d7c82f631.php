<?php $__env->startSection('menu2'); ?>
    <?php echo $__env->make('menu2', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('contenido2'); ?>

<div class="container mt-4">
    <h2>Detalle del alumno</h2>

    <div class="mb-3">
        <strong>ID:</strong> <?php echo e($alumno->id); ?>

    </div>
    <div class="mb-3">
        <strong>Grupo:</strong> <?php echo e($grupo->nombre_grupo ?? $alumno->grupo?->nombre_grupo); ?>

    </div>
    <div class="mb-3">
        <strong>Nombre:</strong> <?php echo e($alumno->nombre_alumno); ?>

    </div>
    <div class="mb-3">
        <strong>Matrícula:</strong> <?php echo e($alumno->matricula); ?>

    </div>

    <a href="<?php echo e(route('grupos.alumnos.index', $grupo ?? ($alumno->grupo ?? 0))); ?>" class="btn btn-secondary">Volver</a>
    <a href="<?php echo e(route('alumnos.edit', $alumno)); ?>" class="btn btn-primary">Editar</a>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('plantillas.login2', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Usuario\Herd\admonlab\resources\views/gruposalumnos/show.blade.php ENDPATH**/ ?>