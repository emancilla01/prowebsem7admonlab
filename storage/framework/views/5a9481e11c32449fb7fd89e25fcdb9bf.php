<?php $__env->startSection('menu2'); ?>
    <?php echo $__env->make('menu2', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('contenido2'); ?>

<h2>Editar Salida #<?php echo e($salida->id); ?></h2>

<?php if($errors->any()): ?>
    <div class="alert alert-danger">
        <ul>
            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li><?php echo e($error); ?></li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    </div>
<?php endif; ?>

<form action="<?php echo e(route('salidas.update', $salida)); ?>" method="POST">
    <?php echo csrf_field(); ?>
    <?php echo method_field('PUT'); ?>

    <div class="mb-3">
        <label for="fecha" class="form-label">Fecha</label>
        <input type="date" name="fecha" id="fecha" class="form-control" value="<?php echo e(old('fecha', $salida->fecha?->format('Y-m-d'))); ?>" required>
    </div>

    <div class="mb-3">
        <label for="hora" class="form-label">Hora</label>
        <input type="time" name="hora" id="hora" class="form-control" value="<?php echo e(old('hora', $salida->hora)); ?>" required>
    </div>

    <div class="mb-3">
        <label for="quien_autorizo" class="form-label">Quien autorizó</label>
        <input type="text" name="quien_autorizo" id="quien_autorizo" class="form-control" maxlength="100" value="<?php echo e(old('quien_autorizo', $salida->quien_autorizo)); ?>" required>
    </div>

    <div class="mb-3">
        <label for="quien_registro" class="form-label">Quien registró</label>
        <input type="text" name="quien_registro" id="quien_registro" class="form-control" maxlength="100" value="<?php echo e(old('quien_registro', $salida->quien_registro)); ?>" required>
    </div>

    <button type="submit" class="btn btn-primary">Guardar</button>
    <a href="<?php echo e(route('salidas.index')); ?>" class="btn btn-secondary">Cancelar</a>
</form>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('plantillas.login2', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Usuario\Herd\admonlab\resources\views/salidas/edit.blade.php ENDPATH**/ ?>