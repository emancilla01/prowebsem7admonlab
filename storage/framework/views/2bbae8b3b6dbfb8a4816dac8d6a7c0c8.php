<?php $__env->startSection('menu2'); ?>
    <?php echo $__env->make('menu2', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('contenido2'); ?>
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Personal</h2>
        <a href="<?php echo e(route('personal.create')); ?>" class="btn btn-primary">Nuevo registro</a>
    </div>

    
    <?php echo $__env->make('partials.search_form', [
        'action' => route('personal.index'),
        'name' => 'q',
        'placeholder' => 'Buscar personal',
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
                    <th>RFC</th>
                    <?php
                        $nombreDir = request('sort') === 'nombre' && request('dir') === 'asc' ? 'desc' : 'asc';
                    ?>
                    <th>
                        <a class="btn btn-sm btn-outline-secondary" role="button" aria-label="Ordenar por Nombre" href="<?php echo e(route('personal.index', array_merge(request()->query(), ['sort' => 'nombre', 'dir' => $nombreDir]))); ?>">Nombre
                            <?php if(request('sort') === 'nombre'): ?>
                                <?php if(request('dir') === 'asc'): ?> ▲ <?php else: ?> ▼ <?php endif; ?>
                            <?php endif; ?>
                        </a>
                    </th>
                    <th>Apellido P.</th>
                    <th>Apellido M.</th>
                    <th>Email</th>
                    <th>Sexo</th>
                    <th>Depto</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $personals; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $personal): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td><?php echo e($personal->id); ?></td>
                        <td><?php echo e($personal->rfc); ?></td>
                        <td><?php echo e($personal->nombre); ?></td>
                        <td><?php echo e($personal->apellido_pat); ?></td>
                        <td><?php echo e($personal->apellido_mat); ?></td>
                        <td><?php echo e($personal->email); ?></td>
                        <td><?php echo e($personal->sexo); ?></td>
                        <td><?php echo e($personal->depto); ?></td>
                        <td>
                            <a href="<?php echo e(route('personal.show', $personal)); ?>" class="btn btn-sm btn-outline-secondary" title="Ver" aria-label="Ver registro">👁️</a>
                            <a href="<?php echo e(route('personal.edit', $personal)); ?>" class="btn btn-sm btn-outline-primary" title="Editar" aria-label="Editar registro">✏️</a>
                            <form action="<?php echo e(route('personal.destroy', $personal)); ?>" method="POST" style="display:inline" onsubmit="return confirm('¿Eliminar este registro?');">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button class="btn btn-sm btn-danger" title="Eliminar" aria-label="Eliminar registro">🗑️</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="9">No hay registros.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <div class="d-flex justify-content-between align-items-center my-3">
        <div class="text-muted">
            Showing <?php echo e($personals->firstItem() ?? 0); ?> to <?php echo e($personals->lastItem() ?? 0); ?> of <?php echo e($personals->total()); ?> results
        </div>
        <div>
            <?php echo e($personals->links('pagination::bootstrap-5')); ?>

        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('plantillas.login2', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Usuario\Herd\admonlab\resources\views/personal/index.blade.php ENDPATH**/ ?>