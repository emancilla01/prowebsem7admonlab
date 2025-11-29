<?php $__env->startSection('menu2'); ?>
    <?php echo $__env->make('menu2', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('contenido2'); ?>
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Grupos</h2>
        <a href="<?php echo e(route('grupos.create')); ?>" class="btn btn-primary">Nuevo registro</a>
    </div>

    <?php echo $__env->make('partials.search_form', [
        'action' => route('grupos.index'),
        'name' => 'q',
        'placeholder' => 'Buscar grupos por nombre o clave',
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
                    <th>Clave</th>
                    <?php
                        $nombreDir = request('sort') === 'nombre_grupo' && request('dir') === 'asc' ? 'desc' : 'asc';
                    ?>
                    <th>
                        <a class="btn btn-sm btn-outline-secondary" role="button" aria-label="Ordenar por Nombre" href="<?php echo e(route('grupos.index', array_merge(request()->query(), ['sort' => 'nombre_grupo', 'dir' => $nombreDir]))); ?>">Nombre
                            <?php if(request('sort') === 'nombre_grupo'): ?>
                                <?php if(request('dir') === 'asc'): ?> ▲ <?php else: ?> ▼ <?php endif; ?>
                            <?php endif; ?>
                        </a>
                    </th>
                    <th>Materia</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $grupos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $grupo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td><?php echo e($grupo->id); ?></td>
                        <td><?php echo e($grupo->clave_grupo); ?></td>
                        <td><?php echo e($grupo->nombre_grupo); ?></td>
                        <td><?php echo e($grupo->materia?->nombre); ?></td>
                        <td>
                            <a href="<?php echo e(route('grupos.show', $grupo)); ?>" class="btn btn-sm btn-outline-secondary" title="Ver">👁️</a>
                            <a href="<?php echo e(route('grupos.alumnos.index', $grupo)); ?>" class="btn btn-sm btn-outline-secondary" title="Ver alumnos" aria-label="Ver alumnos">👥</a>
                            <a href="<?php echo e(route('grupos.labs.index', $grupo)); ?>" class="btn btn-sm btn-outline-secondary" title="Ver laboratorios" aria-label="Ver laboratorios">🔬</a>
                            <a href="<?php echo e(route('grupos.edit', $grupo)); ?>" class="btn btn-sm btn-outline-primary" title="Editar">✏️</a>
                            <form action="<?php echo e(route('grupos.destroy', $grupo)); ?>" method="POST" style="display:inline" onsubmit="return confirm('¿Eliminar este registro?');">
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

    <div class="d-flex justify-content-between align-items-center my-3">
        <div class="text-muted">
            Showing <?php echo e($grupos->firstItem() ?? 0); ?> to <?php echo e($grupos->lastItem() ?? 0); ?> of <?php echo e($grupos->total()); ?> results
        </div>
        <div>
            <?php echo e($grupos->links('pagination::bootstrap-5')); ?>

        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('plantillas.login2', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Usuario\Herd\admonlab\resources\views/grupos/index.blade.php ENDPATH**/ ?>