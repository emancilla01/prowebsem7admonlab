<?php $__env->startSection('menu2'); ?>
    <?php echo $__env->make('menu2', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('contenido2'); ?>
<div class="container mt-4">
    <h2>Editar Grupo</h2>

    <?php if($errors->any()): ?>
        <div class="alert alert-danger">
            <ul class="mb-0">
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($error); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
    <?php endif; ?>

    <form action="<?php echo e(route('grupos.update', $grupo)); ?>" method="POST">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>

        <div class="mb-3">
            <label for="clave_grupo" class="form-label">Clave</label>
            <input type="text" name="clave_grupo" id="clave_grupo" class="form-control" value="<?php echo e(old('clave_grupo', $grupo->clave_grupo)); ?>" maxlength="50" required>
        </div>

        <div class="mb-3">
            <label for="nombre_grupo" class="form-label">Nombre</label>
            <input type="text" name="nombre_grupo" id="nombre_grupo" class="form-control" value="<?php echo e(old('nombre_grupo', $grupo->nombre_grupo)); ?>" maxlength="100" required>
        </div>

        <div class="mb-3">
            <label for="id_materia" class="form-label">Materia</label>
            <select name="id_materia" id="id_materia" class="form-select" required>
                <option value="">-- Seleccione --</option>
                <?php $__currentLoopData = $materias; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $nombre): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($id); ?>" <?php echo e(old('id_materia', $grupo->id_materia) == $id ? 'selected' : ''); ?>><?php echo e($nombre); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="id_periodo" class="form-label">Periodo</label>
            <select name="id_periodo" id="id_periodo" class="form-select" required>
                <option value="">-- Seleccione --</option>
                <?php $__currentLoopData = $periodos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $nombre): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($id); ?>" <?php echo e(old('id_periodo', $grupo->id_periodo) == $id ? 'selected' : ''); ?>><?php echo e($nombre); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="id_personal" class="form-label">Maestro</label>
            <select name="id_personal" id="id_personal" class="form-select" required>
                <option value="">-- Seleccione --</option>
                <?php $__currentLoopData = $personals; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $nombre): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($id); ?>" <?php echo e(old('id_personal', $grupo->id_personal) == $id ? 'selected' : ''); ?>><?php echo e($nombre); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="id_carrera" class="form-label">Carrera</label>
            <select name="id_carrera" id="id_carrera" class="form-select" required>
                <option value="">-- Seleccione --</option>
                <?php $__currentLoopData = $carreras; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $nombre): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($id); ?>" <?php echo e(old('id_carrera', $grupo->id_carrera) == $id ? 'selected' : ''); ?>><?php echo e($nombre); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="turno" class="form-label">Turno</label>
            <input type="text" name="turno" id="turno" class="form-control" value="<?php echo e(old('turno', $grupo->turno)); ?>" maxlength="20">
        </div>

        <div class="mb-3">
            <label for="estatus" class="form-label">Estatus</label>
            <select name="estatus" id="estatus" class="form-select" required>
                <option value="activo" <?php echo e(old('estatus', $grupo->estatus) === 'activo' ? 'selected' : ''); ?>>Activo</option>
                <option value="cerrado" <?php echo e(old('estatus', $grupo->estatus) === 'cerrado' ? 'selected' : ''); ?>>Cerrado</option>
            </select>
        </div>

        <div class="d-flex gap-2">
            <button class="btn btn-primary">Actualizar</button>
            <a href="<?php echo e(route('grupos.index')); ?>" class="btn btn-secondary">Cancelar</a>
        </div>
    </form>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('plantillas.login2', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Usuario\Herd\admonlab\resources\views/grupos/edit.blade.php ENDPATH**/ ?>