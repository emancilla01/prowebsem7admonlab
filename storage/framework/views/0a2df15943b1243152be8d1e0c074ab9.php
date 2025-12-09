<?php $__env->startSection('menu2'); ?>
    <?php echo $__env->make('menu2', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('contenido2'); ?>

<div class="container mt-4">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header">Editar Software</div>

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

                    <form action="<?php echo e(route('software.update', $software)); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('PUT'); ?>

                        <div class="mb-3">
                            <label class="form-label">Nombre del software</label>
                            <input type="text" name="nombre_software" class="form-control" value="<?php echo e(old('nombre_software', $software->nombre_software)); ?>">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Versión</label>
                            <input type="text" name="version" class="form-control" value="<?php echo e(old('version', $software->version)); ?>">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Licencia</label>
                            <input type="text" name="licencia" class="form-control" value="<?php echo e(old('licencia', $software->licencia)); ?>">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Proveedor</label>
                            <input type="text" name="proveedor" class="form-control" value="<?php echo e(old('proveedor', $software->proveedor)); ?>">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Fecha de instalación</label>
                            <input type="date" name="fecha_instalacion" class="form-control" value="<?php echo e(old('fecha_instalacion', $software->fecha_instalacion)); ?>">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Espacio</label>
                            <select name="id_espacio" class="form-control">
                                <option value="">-- Ninguno --</option>
                                <?php $__currentLoopData = \App\Models\EspacioTrabajo::all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $esp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($esp->id_espacio); ?>" <?php echo e((old('id_espacio', $software->id_espacio) == $esp->id_espacio) ? 'selected' : ''); ?>><?php echo e($esp->nombre_espacio); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="<?php echo e(route('software.index')); ?>" class="btn btn-secondary">Cancelar</a>
                            <button class="btn btn-primary">Actualizar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('plantillas.login2', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Usuario\Herd\admonlab\resources\views/software/edit.blade.php ENDPATH**/ ?>