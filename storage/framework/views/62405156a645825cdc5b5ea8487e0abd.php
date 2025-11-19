<?php $__env->startSection('menu2'); ?>
    <?php echo $__env->make('menu2', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('contenido2'); ?>

<div class="container mt-4">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header">Editar Espacio de trabajo</div>

                <div class="card-body">
                    <?php if($errors->any()): ?>
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li><?php echo e($error); ?></li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        </div>
                    <?php endif; ?>

                    <form action="<?php echo e(route('espaciosdetrabajo.update', $espacio)); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('PUT'); ?>

                        <div class="mb-3">
                            <label class="form-label">Nombre del espacio</label>
                            <input type="text" name="nombre_espacio" class="form-control" value="<?php echo e(old('nombre_espacio', $espacio->nombre_espacio)); ?>">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Tipo de espacio</label>
                            <input type="text" name="tipo_espacio" class="form-control" value="<?php echo e(old('tipo_espacio', $espacio->tipo_espacio)); ?>">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Ubicación</label>
                            <input type="text" name="ubicacion" class="form-control" value="<?php echo e(old('ubicacion', $espacio->ubicacion)); ?>">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Capacidad</label>
                            <input type="number" name="capacidad" class="form-control" value="<?php echo e(old('capacidad', $espacio->capacidad)); ?>">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Responsable</label>
                            <input type="text" name="responsable" class="form-control" value="<?php echo e(old('responsable', $espacio->responsable)); ?>">
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="<?php echo e(route('espaciosdetrabajo.index')); ?>" class="btn btn-secondary">Cancelar</a>
                            <button class="btn btn-primary">Actualizar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('plantillas.login2', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Usuario\Herd\admonlab\resources\views/espaciosdetrabajo/edit.blade.php ENDPATH**/ ?>