<?php $__env->startSection('menu2'); ?>
    <?php echo $__env->make('menu2', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('contenido2'); ?>
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Equipo de cómputo (ECM: <?php echo e($id_ecm ?? '-'); ?>)</h2>
        <a href="<?php echo e(route('ecm_detequcom.create', ['id_ecm' => $id_ecm])); ?>" class="btn btn-primary">Nuevo equipo</a>
    </div>

    <?php echo $__env->make('partials.search_form', [
        'action' => route('ecm_detequcom.index', ['id_ecm' => $id_ecm]),
        'name' => 'q',
        'placeholder' => 'Buscar por serial, modelo, marca o descripción',
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
                        $serialDir = request('sort') === 'serial' && request('dir') === 'asc' ? 'desc' : 'asc';
                    ?>
                    <th>
                        <a class="btn btn-sm btn-outline-secondary" role="button" aria-label="Ordenar por Serial" href="<?php echo e(route('ecm_detequcom.index', array_merge(request()->query(), ['sort' => 'serial', 'dir' => $serialDir]))); ?>">Serial
                            <?php if(request('sort') === 'serial'): ?>
                                <?php if(request('dir') === 'asc'): ?> ▲ <?php else: ?> ▼ <?php endif; ?>
                            <?php endif; ?>
                        </a>
                    </th>
                    <th>Modelo</th>
                    <th>Espacio</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td><?php echo e($item->id); ?></td>
                        <td><?php echo e($item->serial); ?></td>
                        <td><?php echo e($item->modelo); ?></td>
                        <td><?php echo e($item->espacio?->nombre_espacio); ?></td>
                        <td><?php echo e($item->estado); ?></td>
                        <td>
                            <a href="<?php echo e(route('ecm_detequcom.show', $item)); ?>" class="btn btn-sm btn-outline-secondary" title="Ver" aria-label="Ver">👁️</a>
                            <a href="<?php echo e(route('ecm_detequcom.edit', $item)); ?>" class="btn btn-sm btn-outline-primary" title="Editar" aria-label="Editar">✏️</a>
                            <form action="<?php echo e(route('ecm_detequcom.destroy', $item)); ?>" method="POST" style="display:inline" onsubmit="return confirm('¿Eliminar este equipo?');">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button class="btn btn-sm btn-danger" title="Eliminar" aria-label="Eliminar">🗑️</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="7">No hay registros.</td>
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
<?php echo $__env->make('plantillas.login2', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Usuario\Herd\admonlab\resources\views/ecmdete/index.blade.php ENDPATH**/ ?>