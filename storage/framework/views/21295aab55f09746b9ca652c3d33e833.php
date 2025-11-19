<?php $__env->startSection('menu2'); ?>
    <?php echo $__env->make('menu2', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('contenido2'); ?>
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Categorías</h2>
        <a href="<?php echo e(route('categorias.create')); ?>" class="btn btn-primary">Nuevo registro</a>
    </div>

    
    <?php echo $__env->make('partials.search_form', [
        'action' => route('categorias.index'),
        'name' => 'q',
        'placeholder' => 'Buscar categorías',
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
                        $nombreDir = request('sort') === 'nombre' && request('dir') === 'asc' ? 'desc' : 'asc';
                    ?>
                    <th>
                        <a class="btn btn-sm btn-outline-secondary" role="button" aria-label="Ordenar por Nombre" href="<?php echo e(route('categorias.index', array_merge(request()->query(), ['sort' => 'nombre', 'dir' => $nombreDir]))); ?>">Nombre
                            <?php if(request('sort') === 'nombre'): ?>
                                <?php if(request('dir') === 'asc'): ?> ▲ <?php else: ?> ▼ <?php endif; ?>
                            <?php endif; ?>
                        </a>
                    </th>
                    <th>Descripción</th>
                    <th>Creado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $categorias; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $categoria): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td><?php echo e($categoria->id); ?></td>
                        <td><?php echo e($categoria->nombre); ?></td>
                        <td><?php echo e(\Illuminate\Support\Str::limit($categoria->descripcion, 80)); ?></td>
                        <td><?php echo e($categoria->created_at?->format('Y-m-d')); ?></td>
                        <td>
                            <a href="<?php echo e(route('categorias.show', $categoria)); ?>" class="btn btn-sm btn-outline-secondary" title="Ver" aria-label="Ver registro">👁️</a>
                            <a href="<?php echo e(route('categorias.edit', $categoria)); ?>" class="btn btn-sm btn-outline-primary" title="Editar" aria-label="Editar registro">✏️</a>
                            <form action="<?php echo e(route('categorias.destroy', $categoria)); ?>" method="POST" style="display:inline" onsubmit="return confirm('¿Eliminar este registro?');">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button class="btn btn-sm btn-danger" title="Eliminar" aria-label="Eliminar registro">🗑️</button>
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
            Showing <?php echo e($categorias->firstItem() ?? 0); ?> to <?php echo e($categorias->lastItem() ?? 0); ?> of <?php echo e($categorias->total()); ?> results
        </div>
        <div>
            <?php echo e($categorias->links('pagination::bootstrap-5')); ?>

        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('plantillas.login2', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Usuario\Herd\admonlab\resources\views/categorias/index.blade.php ENDPATH**/ ?>