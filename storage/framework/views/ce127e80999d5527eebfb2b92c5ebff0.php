<?php $__env->startSection('menu2'); ?>
    <?php echo $__env->make('menu2', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('contenido2'); ?>
<div class="container mt-4">
    <h2>Crear relación Software - Materia</h2>

    <?php if(isset($softwareId)): ?>
        <form action="<?php echo e(route('software.materias.store', ['software' => $softwareId])); ?>" method="POST">
            <?php echo csrf_field(); ?>

            <div class="mb-3">
                <label for="id_software" class="form-label">Software</label>
                <select id="id_software" name="id_software" class="form-select" disabled>
                    <?php $__currentLoopData = $softwares; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $nombre): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($id); ?>" <?php echo e(($softwareId == $id) ? 'selected' : ''); ?>><?php echo e($nombre); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
                <input type="hidden" name="id_software" value="<?php echo e($softwareId); ?>">
            </div>

            <div class="mb-3">
                <label for="id_materia" class="form-label">Materia</label>
                <select id="id_materia" name="id_materia" class="form-select">
                    <option value="">-- Seleccionar --</option>
                    <?php $__currentLoopData = $materias; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $nombre): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($id); ?>" <?php echo e(old('id_materia') == $id ? 'selected' : ''); ?>><?php echo e($nombre); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
                <?php $__errorArgs = ['id_materia'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="text-danger"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <div class="mb-3">
                <label for="observaciones" class="form-label">Observaciones</label>
                <textarea id="observaciones" name="observaciones" class="form-control"><?php echo e(old('observaciones')); ?></textarea>
                <?php $__errorArgs = ['observaciones'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="text-danger"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <a href="<?php echo e(route('software.materias.index', ['software' => $softwareId])); ?>" class="btn btn-secondary">Cancelar</a>
            <button type="submit" class="btn btn-primary">Crear</button>
        </form>
    <?php else: ?>
        <div class="alert alert-warning">Debe seleccionar un software antes de crear una relación. <a href="<?php echo e(route('software.index')); ?>">Ir a Software</a></div>
    <?php endif; ?>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('plantillas.login2', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Usuario\Herd\admonlab\resources\views/softwarematerias/create.blade.php ENDPATH**/ ?>