<?php $__env->startSection('menu2'); ?>
    <?php echo $__env->make('menu2', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('contenido2'); ?>
<div class="container mt-4">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header">Crear Carrera</div>

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

                    <form action="<?php echo e(route('carreras.store')); ?>" method="POST">
                        <?php echo csrf_field(); ?>

                        <div class="mb-3">
                            <label class="form-label">Nombre de la carrera</label>
                            <input type="text" name="nombre_carrera" class="form-control" value="<?php echo e(old('nombre_carrera')); ?>">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Clave</label>
                            <input type="text" name="clave_carrera" class="form-control" value="<?php echo e(old('clave_carrera')); ?>">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Coordinador</label>
                            <input type="text" name="coordinador" class="form-control" value="<?php echo e(old('coordinador')); ?>">
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="<?php echo e(route('carreras.index')); ?>" class="btn btn-secondary">Cancelar</a>
                            <button class="btn btn-primary">Guardar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('plantillas.login2', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Usuario\Herd\admonlab\resources\views/carreras/create.blade.php ENDPATH**/ ?>