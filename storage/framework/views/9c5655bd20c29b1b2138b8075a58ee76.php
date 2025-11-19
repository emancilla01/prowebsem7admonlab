<?php $__env->startSection('menu2'); ?>
    <?php echo $__env->make('menu2', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('contenido2'); ?>

<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Detalle - Laboratorio #<?php echo e($lab->id); ?></h2>
        <div>
            <a href="<?php echo e(route('labs.edit', $lab)); ?>" class="btn btn-sm btn-outline-primary">✏️ Editar</a>
            <form action="<?php echo e(route('labs.destroy', $lab)); ?>" method="POST" style="display:inline" onsubmit="return confirm('¿Eliminar este registro?');">
                <?php echo csrf_field(); ?>
                <?php echo method_field('DELETE'); ?>
                <button class="btn btn-sm btn-danger">🗑️</button>
            </form>
            <a href="<?php echo e(route('grupos.labs.index', $grupo ?? ($lab->grupo ?? null))); ?>" class="btn btn-sm btn-secondary">Volver</a>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <p><strong>ID:</strong> <?php echo e($lab->id); ?></p>
            <p><strong>Grupo:</strong> <?php echo e($grupo->nombre_grupo ?? $lab->grupo?->nombre_grupo); ?></p>
            <p><strong>Espacio:</strong> <?php echo e($lab->espacio?->nombre_espacio); ?></p>
            <p><strong>Horario:</strong> <?php echo e($lab->horario ?? '-'); ?></p>
            <p><strong>Creado:</strong> <?php echo e($lab->created_at?->format('Y-m-d H:i')); ?></p>
            <p><strong>Actualizado:</strong> <?php echo e($lab->updated_at?->format('Y-m-d H:i')); ?></p>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('plantillas.login2', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Usuario\Herd\admonlab\resources\views/gruposlab/show.blade.php ENDPATH**/ ?>