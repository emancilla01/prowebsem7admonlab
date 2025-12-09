<?php $__env->startSection('menu2'); ?>
    <?php echo $__env->make('menu2', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('contenido2'); ?>
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Laboratorios del grupo: <?php echo e($grupo->nombre_grupo ?? ''); ?></h2>
        <a href="<?php echo e(route('grupos.labs.create', $grupo ?? 0)); ?>" class="btn btn-primary">Nuevo laboratorio</a>
    </div>

    <?php echo $__env->make('partials.search_form', [
        'action' => route('grupos.labs.index', $grupo ?? 0),
        'name' => 'q',
        'placeholder' => 'Buscar por horario o espacio',
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
                    <th>Grupo</th>
                    <?php
                        $espDir = request('sort') === 'id_espacio' && request('dir') === 'asc' ? 'desc' : 'asc';
                    ?>
                    <th>
                        <a class="btn btn-sm btn-outline-secondary" role="button" aria-label="Ordenar por Espacio" href="<?php echo e(route('grupos.labs.index', array_merge(request()->query(), ['sort' => 'id_espacio', 'dir' => $espDir, 'grupo' => $grupo->id ?? null]))); ?>">Espacio
                            <?php if(request('sort') === 'id_espacio'): ?>
                                <?php if(request('dir') === 'asc'): ?> ▲ <?php else: ?> ▼ <?php endif; ?>
                            <?php endif; ?>
                        </a>
                    </th>
                    <th>Horario</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $labs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lab): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td><?php echo e($lab->id); ?></td>
                        <td><?php echo e($grupo->nombre_grupo ?? $lab->grupo?->nombre_grupo); ?></td>
                        <td><?php echo e($lab->espacio?->nombre_espacio); ?></td>
                        <td><?php echo e($lab->horario); ?></td>
                        <td>
                            <a href="<?php echo e(route('labs.show', $lab)); ?>" class="btn btn-sm btn-outline-secondary" title="Ver">👁️</a>
                            <a href="<?php echo e(route('labs.edit', $lab)); ?>" class="btn btn-sm btn-outline-primary" title="Editar">✏️</a>
                            <form action="<?php echo e(route('labs.destroy', $lab)); ?>" method="POST" style="display:inline" onsubmit="return confirm('¿Eliminar este registro?');">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button class="btn btn-sm btn-danger">🗑️</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="5">No hay registros.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <div class="d-flex justify-content-end mt-3">
        <?php echo e($labs->links('pagination::bootstrap-5')); ?>

    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('plantillas.login2', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Usuario\Herd\admonlab\resources\views/gruposlab/index.blade.php ENDPATH**/ ?>