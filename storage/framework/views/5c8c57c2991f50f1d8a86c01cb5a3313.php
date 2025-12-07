<?php $__env->startSection('menu2'); ?>
    <?php echo $__env->make('menu2', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('contenido2'); ?>
<h2>Editar Entrada</h2>

<?php if($errors->any()): ?>
    <div class="alert alert-danger">
        <ul>
            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li><?php echo e($error); ?></li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    </div>
<?php endif; ?>

<form action="<?php echo e(route('entradas.update', $entrada)); ?>" method="POST">
    <?php echo csrf_field(); ?>
    <?php echo method_field('PUT'); ?>

    <div class="mb-3">
        <label for="fecha" class="form-label">Fecha</label>
        <input type="date" class="form-control" id="fecha" name="fecha" value="<?php echo e(old('fecha', optional($entrada->fecha)->format('Y-m-d'))); ?>" required>
    </div>

    <div class="mb-3">
        <label for="hora" class="form-label">Hora</label>
        <input type="time" class="form-control" id="hora" name="hora" value="<?php echo e(old('hora', $entrada->hora)); ?>" required>
    </div>

    <div class="mb-3">
        <label for="quien_envio" class="form-label">Quien envió</label>
        <input type="text" class="form-control" id="quien_envio" name="quien_envio" maxlength="100" value="<?php echo e(old('quien_envio', $entrada->quien_envio)); ?>" required>
    </div>

    <div class="mb-3">
        <label for="quien_recibio" class="form-label">Quien recibió</label>
        <input type="text" class="form-control" id="quien_recibio" name="quien_recibio" maxlength="100" value="<?php echo e(old('quien_recibio', $entrada->quien_recibio)); ?>" required>
    </div>

    <div class="mb-3">
        <label for="lugar" class="form-label">Lugar</label>
        <input type="text" class="form-control" id="lugar" name="lugar" maxlength="150" value="<?php echo e(old('lugar', $entrada->lugar)); ?>" required>
    </div>

    <button type="submit" class="btn btn-primary">Actualizar</button>
    <a href="<?php echo e(route('entradas.index')); ?>" class="btn btn-secondary">Cancelar</a>
</form>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('plantillas.login2', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Usuario\Herd\admonlab\resources\views/entradas/edit.blade.php ENDPATH**/ ?>