<?php $__env->startSection('menu2'); ?>
    <?php echo $__env->make('menu2', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('contenido2'); ?>

<h2>Entradas</h2>

<?php if(session('success')): ?>
    <div class="alert alert-success"><?php echo e(session('success')); ?></div>
<?php endif; ?>

<div class="d-flex justify-content-between mb-3">
    <form class="d-flex" method="GET" action="<?php echo e(route('entradas.index')); ?>">
        <input class="form-control me-2" type="search" name="q" value="<?php echo e(request('q')); ?>" placeholder="Buscar...">
        <button class="btn btn-outline-secondary" type="submit">Buscar</button>
    </form>

    <a href="<?php echo e(route('entradas.create')); ?>" class="btn btn-primary">Nuevo registro</a>
</div>

<div class="table-responsive">
    <table class="table table-striped">
        <thead>
            <tr>
                <th>
                    <a href="<?php echo e(request()->fullUrlWithQuery(['sort' => 'fecha', 'direction' => (request('sort')=='fecha' && request('direction')=='asc') ? 'desc' : 'asc'])); ?>">
                        Fecha
                    </a>
                </th>
                <th>
                    <a href="<?php echo e(request()->fullUrlWithQuery(['sort' => 'hora', 'direction' => (request('sort')=='hora' && request('direction')=='asc') ? 'desc' : 'asc'])); ?>">
                        Hora
                    </a>
                </th>
                <th>
                    <a href="<?php echo e(request()->fullUrlWithQuery(['sort' => 'quien_envio', 'direction' => (request('sort')=='quien_envio' && request('direction')=='asc') ? 'desc' : 'asc'])); ?>">
                        Quien envió
                    </a>
                </th>
                <th>
                    <a href="<?php echo e(request()->fullUrlWithQuery(['sort' => 'quien_recibio', 'direction' => (request('sort')=='quien_recibio' && request('direction')=='asc') ? 'desc' : 'asc'])); ?>">
                        Quien recibió
                    </a>
                </th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php $__empty_1 = true; $__currentLoopData = $entradas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $entrada): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                    <td><?php echo e(optional($entrada->fecha)->format('Y-m-d')); ?></td>
                    <td><?php echo e($entrada->hora); ?></td>
                    <td><?php echo e($entrada->quien_envio); ?></td>
                    <td><?php echo e($entrada->quien_recibio); ?></td>
                    <td>
                        <a href="<?php echo e(route('entradas.show', $entrada)); ?>" class="btn btn-sm btn-outline-secondary" title="Ver" aria-label="Ver registro">👁️</a>
                        <a href="<?php echo e(route('entradas.edit', $entrada)); ?>" class="btn btn-sm btn-outline-primary" title="Editar" aria-label="Editar registro">✏️</a>
                        <form action="<?php echo e(route('entradas.destroy', $entrada)); ?>" method="POST" style="display:inline" onsubmit="return confirm('¿Eliminar este registro?');">
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
        Showing <?php echo e($entradas->firstItem() ?? 0); ?> to <?php echo e($entradas->lastItem() ?? 0); ?> of <?php echo e($entradas->total()); ?> results
    </div>
    <div>
        <?php echo e($entradas->links('pagination::bootstrap-5')); ?>

    </div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('plantillas.login2', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Usuario\Herd\admonlab\resources\views/entradas/index.blade.php ENDPATH**/ ?>