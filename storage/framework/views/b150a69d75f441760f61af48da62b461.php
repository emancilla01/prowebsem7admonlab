<?php $__env->startSection('menu2'); ?>
    <?php echo $__env->make('menu2', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('contenido2'); ?>
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Materias que requieren el software (Software: <?php echo e($softwareId ?? '-'); ?>)</h2>
        <?php if($softwareId): ?>
            <a href="<?php echo e(route('software.materias.create', ['software' => $softwareId])); ?>" class="btn btn-primary">Crear relación</a>
        <?php else: ?>
            <a href="<?php echo e(route('software.index')); ?>" class="btn btn-primary">Crear relación</a>
        <?php endif; ?>
    </div>

    <?php echo $__env->make('partials.search_form', [
        'action' => route('software.materias.index', ['software' => $softwareId]),
        'name' => 'q',
        'placeholder' => 'Buscar por nombre de materia o software',
        'buttonText' => 'Buscar'
    ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <?php if(session('success')): ?>
        <div class="alert alert-success"><?php echo e(session('success')); ?></div>
    <?php endif; ?>

    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <?php
                        $materiaDir = request('sort') === 'materia' && request('dir') === 'asc' ? 'desc' : 'asc';
                    ?>
                    <th>
                        <a class="btn btn-sm btn-outline-secondary" role="button" aria-label="Ordenar por Materia" href="<?php echo e(route('software.materias.index', array_merge(request()->query(), ['software' => $softwareId, 'sort' => 'materia', 'dir' => $materiaDir]))); ?>">Materia
                            <?php if(request('sort') === 'materia'): ?>
                                <?php if(request('dir') === 'asc'): ?> ▲ <?php else: ?> ▼ <?php endif; ?>
                            <?php endif; ?>
                        </a>
                    </th>
                    <th>Software</th>
                    <th>Observaciones</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td><?php echo e($item->id); ?></td>
                        <td><?php echo e($item->materia?->nombre); ?></td>
                        <td><?php echo e($item->software?->nombre_software); ?></td>
                        <td><?php echo e($item->observaciones); ?></td>
                        <td>
                            <a href="<?php echo e(route('software.materias.show', $item)); ?>" class="btn btn-sm btn-outline-secondary" title="Ver" aria-label="Ver">👁️</a>
                            <a href="<?php echo e(route('software.materias.edit', $item)); ?>" class="btn btn-sm btn-outline-primary" title="Editar" aria-label="Editar">✏️</a>
                            <form action="<?php echo e(route('software.materias.destroy', $item)); ?>" method="POST" style="display:inline" onsubmit="return confirm('¿Eliminar esta relación?');">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button class="btn btn-sm btn-danger" title="Eliminar" aria-label="Eliminar">🗑️</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="6">No hay registros.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <div class="d-flex justify-content-end mt-3">
        <?php echo e($items->links('pagination::bootstrap-5')); ?>

    </div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('plantillas.login2', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Usuario\Herd\admonlab\resources\views/softwarematerias/index.blade.php ENDPATH**/ ?>