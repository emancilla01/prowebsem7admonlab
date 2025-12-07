<?php $__env->startSection('menu2'); ?>
    <?php echo $__env->make('menu2', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('contenido2'); ?>

<h2>Agregar detalle a Salida #<?php echo e($salida->id); ?></h2>

<?php if($errors->any()): ?>
    <div class="alert alert-danger">
        <ul class="mb-0">
            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li><?php echo e($error); ?></li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    </div>
<?php endif; ?>

<form method="POST" action="<?php echo e(route('salidas.detalle.store', $salida)); ?>">
    <?php echo csrf_field(); ?>

    <div class="mb-3">
        <label for="id_entradadetalle" class="form-label">Entrada (No. Serie)</label>
        <select name="id_entradadetalle" id="id_entradadetalle" class="form-select" required>
            <option value="">-- Seleccionar --</option>
            <?php $__currentLoopData = $entradas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $entrada): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($entrada->id); ?>" <?php echo e(old('id_entradadetalle') == $entrada->id ? 'selected' : ''); ?>>
                    <?php echo e($entrada->no_serie ?? "#{$entrada->id}"); ?>

                </option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
    </div>

    <div class="mb-3">
        <label for="motivo_de_salida" class="form-label">Motivo de salida</label>
        <input id="motivo_de_salida" name="motivo_de_salida" type="text" class="form-control" value="<?php echo e(old('motivo_de_salida')); ?>" required maxlength="255">
    </div>

    <div class="d-flex gap-2">
        <a href="<?php echo e(route('salidas.detalle.index', $salida)); ?>" class="btn btn-outline-secondary">Cancelar</a>
        <button class="btn btn-primary" type="submit">Guardar</button>
    </div>
</form>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('plantillas.login2', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Usuario\Herd\admonlab\resources\views/salidasdet/create.blade.php ENDPATH**/ ?>