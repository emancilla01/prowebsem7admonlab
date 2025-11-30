<?php $__env->startSection('menu2'); ?>
    <?php echo $__env->make('menu2', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('contenido2'); ?>
<h2>Detalles de Entrada #<?php echo e($entrada->id); ?></h2>

<?php if(session('success')): ?>
    <div class="alert alert-success"><?php echo e(session('success')); ?></div>
<?php endif; ?>

    <div class="d-flex justify-content-between mb-3">
    <form class="d-flex" method="GET" action="<?php echo e(route('entradas.detalle.index', $entrada)); ?>">
        <input class="form-control me-2" type="search" name="q" value="<?php echo e(request('q')); ?>" placeholder="Buscar...">
        <input type="hidden" name="sort" value="<?php echo e(request('sort')); ?>">
        <input type="hidden" name="dir" value="<?php echo e(request('dir')); ?>">
        <button class="btn btn-outline-secondary" type="submit">Buscar</button>
    </form>

    <a href="<?php echo e(route('entradas.detalle.create', $entrada)); ?>" class="btn btn-primary">Nuevo detalle</a>
</div>

<div class="table-responsive">
    <table class="table table-striped">
        <thead>
            <tr>
                <?php
                    $currentSort = $sort ?? request('sort', 'id');
                    $currentDir = $dir ?? request('dir', 'desc');
                    $toggleDir = fn($col) => ($currentSort === $col && $currentDir === 'asc') ? 'desc' : 'asc';
                    $link = fn($col) => request()->fullUrlWithQuery(['sort' => $col, 'dir' => $toggleDir($col)]);
                    $caret = fn($col) => ($currentSort === $col) ? ($currentDir === 'asc' ? '▲' : '▼') : '';
                ?>

                <th><a href="<?php echo e($link('id')); ?>">ID <?php echo e($caret('id')); ?></a></th>
                <th><a href="<?php echo e($link('no_serie')); ?>">No. Serie <?php echo e($caret('no_serie')); ?></a></th>
                <th><a href="<?php echo e($link('espacio')); ?>">Espacio <?php echo e($caret('espacio')); ?></a></th>
                <th><a href="<?php echo e($link('created_at')); ?>">Creado <?php echo e($caret('created_at')); ?></a></th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php $__empty_1 = true; $__currentLoopData = $detalles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $detalle): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                    <td><?php echo e($detalle->id); ?></td>
                    <td><?php echo e($detalle->no_serie ?? '—'); ?></td>
                    <td><?php echo e(optional($detalle->espacioTrabajo)->nombre_espacio ?? '—'); ?></td>
                    <td><?php echo e($detalle->created_at); ?></td>
                    <td>
                        <a href="<?php echo e(route('entradas.detalle.show', [$entrada, $detalle])); ?>" class="btn btn-sm btn-outline-secondary" title="Ver">👁️</a>
                        <a href="<?php echo e(route('entradas.detalle.edit', [$entrada, $detalle])); ?>" class="btn btn-sm btn-outline-primary" title="Editar">✏️</a>
                        <form action="<?php echo e(route('entradas.detalle.destroy', [$entrada, $detalle])); ?>" method="POST" style="display:inline" onsubmit="return confirm('¿Eliminar este detalle?');">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>
                            <button class="btn btn-sm btn-danger" title="Eliminar">🗑️</button>
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
        Showing <?php echo e($detalles->firstItem() ?? 0); ?> to <?php echo e($detalles->lastItem() ?? 0); ?> of <?php echo e($detalles->total()); ?> results
    </div>
    <div>
        <?php echo e($detalles->links('pagination::bootstrap-5')); ?>

    </div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('plantillas.login2', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Usuario\Herd\admonlab\resources\views/entradasdet/index.blade.php ENDPATH**/ ?>