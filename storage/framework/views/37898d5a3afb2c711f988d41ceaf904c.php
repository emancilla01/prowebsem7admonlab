<?php $__env->startSection('menu2'); ?>
    <?php echo $__env->make('menu2', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('contenido2'); ?>
<div class="container mt-4">
    <h2>Agregar alumno al grupo: <?php echo e($grupo->nombre_grupo ?? ''); ?></h2>

    <form action="<?php echo e(route('grupos.alumnos.store', $grupo ?? 0)); ?>" method="POST">
        <?php echo csrf_field(); ?>
        <input type="hidden" name="id_grupo" value="<?php echo e($grupo->id ?? ''); ?>">

        <div class="mb-3">
            <label for="matricula" class="form-label">Matrícula</label>
            <input type="text" class="form-control" id="matricula" name="matricula" value="<?php echo e(old('matricula')); ?>" maxlength="30">
            <?php $__errorArgs = ['matricula'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="text-danger"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <div class="mb-3">
            <label for="nombre_alumno" class="form-label">Nombre del alumno</label>
            <input type="text" class="form-control" id="nombre_alumno" name="nombre_alumno" value="<?php echo e(old('nombre_alumno')); ?>" maxlength="150">
            <?php $__errorArgs = ['nombre_alumno'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="text-danger"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <a href="<?php echo e(route('grupos.alumnos.index', $grupo ?? 0)); ?>" class="btn btn-secondary">Cancelar</a>
        <button type="submit" class="btn btn-primary">Guardar</button>
    </form>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('plantillas.login2', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Usuario\Herd\admonlab\resources\views/gruposalumnos/create.blade.php ENDPATH**/ ?>