<?php $__env->startSection('menu2'); ?>
    <?php echo $__env->make('menu2', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('contenido2'); ?>
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Inventario ECM</h2>
        <a href="<?php echo e(route('ecm_equcommob.create')); ?>" class="btn btn-primary">Nuevo recurso</a>
    </div>

    <?php echo $__env->make('partials.search_form', [
        'action' => route('ecm_equcommob.index'),
        'name' => 'q',
        'placeholder' => 'Buscar por código o descripción',
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
                        $codeDir = request('sort') === 'codigo' && request('dir') === 'asc' ? 'desc' : 'asc';
                    ?>
                    <th>
                        <a class="btn btn-sm btn-outline-secondary" href="<?php echo e(route('ecm_equcommob.index', array_merge(request()->query(), ['sort' => 'codigo', 'dir' => $codeDir]))); ?>">Código
                            <?php if(request('sort') === 'codigo'): ?>
                                <?php if(request('dir') === 'asc'): ?> ▲ <?php else: ?> ▼ <?php endif; ?>
                            <?php endif; ?>
                        </a>
                    </th>
                    <th>Descripción</th>
                    <th>Categoría</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $ecms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ecm): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td><?php echo e($ecm->id); ?></td>
                        <td><?php echo e($ecm->codigo); ?></td>
                        <td><?php echo e($ecm->descripcion); ?></td>
                        <td><?php echo e($ecm->categoria?->nombre); ?></td>
                        <td>
                            <a href="<?php echo e(route('ecm_detequcom.index', ['id_ecm' => $ecm->id])); ?>" class="btn btn-sm btn-outline-info" title="Equipo">💻</a>
                            <a href="<?php echo e(route('ecm_detmob.index', ['id_ecm' => $ecm->id])); ?>" class="btn btn-sm btn-outline-warning" title="Mobiliario">🪑</a>

                            <a href="<?php echo e(route('ecm_equcommob.show', $ecm->id)); ?>" class="btn btn-sm btn-outline-secondary" title="Ver">👁️</a>
                            <a href="<?php echo e(route('ecm_equcommob.edit', $ecm->id)); ?>" class="btn btn-sm btn-outline-primary" title="Editar">✏️</a>
                            <form action="<?php echo e(route('ecm_equcommob.destroy', $ecm->id)); ?>" method="POST" style="display:inline" onsubmit="return confirm('¿Eliminar este recurso?');">
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
        <?php echo e($ecms->links('pagination::bootstrap-5')); ?>

    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('plantillas.login2', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Usuario\Herd\admonlab\resources\views/ecm/index.blade.php ENDPATH**/ ?>