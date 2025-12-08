<?php $__env->startSection('menu2'); ?>
    <?php echo $__env->make('menu2', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('contenido2'); ?>
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Alumnos del grupo: <?php echo e($grupo->nombre_grupo ?? ''); ?></h2>
        <a href="<?php echo e(route('grupos.alumnos.create', $grupo ?? 0)); ?>" class="btn btn-primary">Nuevo alumno</a>
    </div>

    <?php echo $__env->make('partials.search_form', [
        'action' => route('grupos.alumnos.index', $grupo ?? 0),
        'name' => 'q',
        'placeholder' => 'Buscar por matrícula o nombre',
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
                        $nameDir = request('sort') === 'nombre_alumno' && request('dir') === 'asc' ? 'desc' : 'asc';
                    ?>
                    <th>
                        <a class="btn btn-sm btn-outline-secondary" role="button" href="<?php echo e(route('grupos.alumnos.index', array_merge(request()->query(), ['sort' => 'nombre_alumno', 'dir' => $nameDir, 'grupo' => $grupo->id ?? null]))); ?>">Nombre
                            <?php if(request('sort') === 'nombre_alumno'): ?>
                                <?php if(request('dir') === 'asc'): ?> ▲ <?php else: ?> ▼ <?php endif; ?>
                            <?php endif; ?>
                        </a>
                    </th>
                    <th>Matrícula</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $alumnos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $alumno): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td><?php echo e($alumno->id); ?></td>
                        <td><?php echo e($grupo->nombre_grupo ?? $alumno->grupo?->nombre_grupo); ?></td>
                        <td><?php echo e($alumno->nombre_alumno); ?></td>
                        <td><?php echo e($alumno->matricula); ?></td>
                        <td>
                            <a href="<?php echo e(route('alumnos.show', $alumno)); ?>" class="btn btn-sm btn-outline-secondary" title="Ver">👁️</a>
                            <a href="<?php echo e(route('alumnos.edit', $alumno)); ?>" class="btn btn-sm btn-outline-primary" title="Editar">✏️</a>
                            <form action="<?php echo e(route('alumnos.destroy', $alumno)); ?>" method="POST" style="display:inline" onsubmit="return confirm('¿Eliminar este registro?');">
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
        <?php echo e($alumnos->links('pagination::bootstrap-5')); ?>

    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('plantillas.login2', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Usuario\Herd\admonlab\resources\views/gruposalumnos/index.blade.php ENDPATH**/ ?>