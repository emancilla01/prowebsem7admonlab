<?php $__env->startSection('menu2'); ?>
    <?php echo $__env->make('menu2', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('contenido2'); ?>
<h2>Editar detalle de Salida #<?php echo e($salida->id); ?> — Detalle #<?php echo e($detalle->id); ?></h2>

<?php if($errors->any()): ?>
    <div class="alert alert-danger">
        <ul class="mb-0">
            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li><?php echo e($error); ?></li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    </div>
<?php endif; ?>

<form method="POST" action="<?php echo e(route('salidas.detalle.update', [$salida, $detalle])); ?>">
    <?php echo csrf_field(); ?>
    <?php echo method_field('PUT'); ?>

    <div class="mb-3">
        <label for="motivo_de_salida" class="form-label">Motivo de salida</label>
        <input id="motivo_de_salida" name="motivo_de_salida" type="text" class="form-control" value="<?php echo e(old('motivo_de_salida', $detalle->motivo_de_salida)); ?>" required maxlength="255">
    </div>

    <div class="d-flex gap-2">
        <a href="<?php echo e(route('salidas.detalle.index', $salida)); ?>" class="btn btn-outline-secondary">Cancelar</a>
        <button class="btn btn-primary" type="submit">Guardar</button>
    </div>
</form>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('plantillas.login2', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Usuario\Herd\admonlab\resources\views/salidasdet/edit.blade.php ENDPATH**/ ?>