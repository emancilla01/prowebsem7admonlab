<?php $__env->startSection('menu2'); ?>
    <?php echo $__env->make('menu2', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('contenido2'); ?>
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Agregar laboratorio a: <?php echo e($grupo->nombre_grupo ?? ''); ?></h2>
        <a href="<?php echo e(route('grupos.labs.index', $grupo ?? 0)); ?>" class="btn btn-secondary">Volver</a>
    </div>

    <?php if($errors->any()): ?>
        <div class="alert alert-danger">
            <ul>
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($error); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
    <?php endif; ?>

    <form action="<?php echo e(route('grupos.labs.store', $grupo)); ?>" method="POST">
        <?php echo csrf_field(); ?>
        <div class="mb-3">
            <label for="id_espacio" class="form-label">Espacio</label>
            <select name="id_espacio" id="id_espacio" class="form-select" required>
                <option value="">-- Seleccionar --</option>
                <?php if(isset($espacios) && is_array($espacios) || $espacios instanceof \Illuminate\Support\Collection): ?>
                    <?php $__currentLoopData = $espacios; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $nombre): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($id); ?>" <?php echo e(old('id_espacio') == $id ? 'selected' : ''); ?>><?php echo e($nombre); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="horario" class="form-label">Horario</label>
            <input type="text" name="horario" id="horario" class="form-control" value="<?php echo e(old('horario')); ?>" placeholder="Lun-Mie 8:00-9:30">
        </div>

        <button class="btn btn-primary">Guardar</button>
    </form>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('plantillas.login2', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Usuario\Herd\admonlab\resources\views/gruposlab/create.blade.php ENDPATH**/ ?>