<?php $__env->startSection('menu2'); ?>
    <?php echo $__env->make('menu2', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('contenido2'); ?>
<div class="container mt-4">
    <h2>Editar Materia</h2>

    <?php if($errors->any()): ?>
        <div class="alert alert-danger">
            <ul class="mb-0">
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($error); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
    <?php endif; ?>

    <form action="<?php echo e(route('materias.update', $materia)); ?>" method="POST">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>

        <div class="mb-3">
            <label for="clave" class="form-label">Clave</label>
            <input type="text" name="clave" id="clave" class="form-control" value="<?php echo e(old('clave', $materia->clave)); ?>" maxlength="50" required>
        </div>

        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" name="nombre" id="nombre" class="form-control" value="<?php echo e(old('nombre', $materia->nombre)); ?>" maxlength="150" required>
        </div>

        <div class="mb-3">
            <label for="id_carrera" class="form-label">Carrera</label>
            <select name="id_carrera" id="id_carrera" class="form-select" required>
                <option value="">-- Seleccione --</option>
                <?php $__currentLoopData = $carreras; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $nombre): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($id); ?>" <?php echo e(old('id_carrera', $materia->id_carrera) == $id ? 'selected' : ''); ?>><?php echo e($nombre); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>

        <div class="form-check mb-3">
            <input type="checkbox" name="requiere_lab" id="requiere_lab" class="form-check-input" value="1" <?php echo e(old('requiere_lab', $materia->requiere_lab) ? 'checked' : ''); ?>>
            <label for="requiere_lab" class="form-check-label">Requiere laboratorio</label>
        </div>

        <div class="mb-3">
            <label for="tipo_uso" class="form-label">Tipo de uso</label>
            <input type="text" name="tipo_uso" id="tipo_uso" class="form-control" value="<?php echo e(old('tipo_uso', $materia->tipo_uso)); ?>" maxlength="50">
        </div>

        <div class="mb-3">
            <label for="estatus" class="form-label">Estatus</label>
            <select name="estatus" id="estatus" class="form-select">
                <option value="activo" <?php echo e(old('estatus', $materia->estatus) === 'activo' ? 'selected' : ''); ?>>Activo</option>
                <option value="inactivo" <?php echo e(old('estatus', $materia->estatus) === 'inactivo' ? 'selected' : ''); ?>>Inactivo</option>
            </select>
        </div>

        <div class="d-flex gap-2">
            <button class="btn btn-primary">Actualizar</button>
            <a href="<?php echo e(route('materias.index')); ?>" class="btn btn-secondary">Cancelar</a>
        </div>
    </form>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('plantillas.login2', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Usuario\Herd\admonlab\resources\views/materias/edit.blade.php ENDPATH**/ ?>