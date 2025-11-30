<?php $__env->startSection('menu2'); ?>
    <?php echo $__env->make('menu2', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('contenido2'); ?>
<h2>Salidas</h2>

<?php if(session('success')): ?>
    <div class="alert alert-success"><?php echo e(session('success')); ?></div>
<?php endif; ?>

<div class="d-flex justify-content-between mb-3">
    <form class="d-flex" method="GET" action="<?php echo e(route('salidas.index')); ?>">
        <input class="form-control me-2" type="search" name="q" value="<?php echo e(request('q')); ?>" placeholder="Buscar...">
        <input type="hidden" name="sort" value="<?php echo e(request('sort', $sort ?? '')); ?>">
        <input type="hidden" name="dir" value="<?php echo e(request('dir', $dir ?? '')); ?>">
        <button class="btn btn-outline-secondary" type="submit">Buscar</button>
    </form>

    <a href="<?php echo e(route('salidas.create')); ?>" class="btn btn-primary">Nueva salida</a>
</div>

<div class="table-responsive">
    <table class="table table-striped">
        <thead>
            <tr>
                <?php
                    $currentSort = $sort ?? request('sort', 'fecha');
                    $currentDir = $dir ?? request('dir', 'desc');
                    $toggleDir = fn($col) => ($currentSort === $col && $currentDir === 'asc') ? 'desc' : 'asc';
                    $link = fn($col) => request()->fullUrlWithQuery(['sort' => $col, 'dir' => $toggleDir($col)]);
                    $caret = fn($col) => ($currentSort === $col) ? ($currentDir === 'asc' ? '▲' : '▼') : '';
                ?>

                <th><a href="<?php echo e($link('fecha')); ?>">Fecha <?php echo e($caret('fecha')); ?></a></th>
                <th><a href="<?php echo e($link('hora')); ?>">Hora <?php echo e($caret('hora')); ?></a></th>
                <th><a href="<?php echo e($link('quien_autorizo')); ?>">Quien autorizó <?php echo e($caret('quien_autorizo')); ?></a></th>
                <th><a href="<?php echo e($link('quien_registro')); ?>">Quien registró <?php echo e($caret('quien_registro')); ?></a></th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php $__empty_1 = true; $__currentLoopData = $salidas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $salida): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                    <td><?php echo e(optional($salida->fecha)->format('Y-m-d')); ?></td>
                    <td><?php echo e($salida->hora); ?></td>
                    <td><?php echo e($salida->quien_autorizo); ?></td>
                    <td><?php echo e($salida->quien_registro); ?></td>
                    <td>
                        <a href="<?php echo e(route('salidas.show', $salida)); ?>" class="btn btn-sm btn-outline-secondary" title="Ver">👁️</a>
                        <a href="<?php echo e(route('salidas.edit', $salida)); ?>" class="btn btn-sm btn-outline-primary" title="Editar">✏️</a>
                        <form action="<?php echo e(route('salidas.destroy', $salida)); ?>" method="POST" style="display:inline" onsubmit="return confirm('¿Eliminar esta salida?');">
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
        Mostrando <?php echo e($salidas->firstItem() ?? 0); ?> a <?php echo e($salidas->lastItem() ?? 0); ?> de <?php echo e($salidas->total()); ?> resultados
    </div>
    <div>
        <?php echo e($salidas->links('pagination::bootstrap-5')); ?>

    </div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('plantillas.login2', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Usuario\Herd\admonlab\resources\views/salidas/index.blade.php ENDPATH**/ ?>