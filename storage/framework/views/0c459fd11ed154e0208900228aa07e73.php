<?php $__env->startSection('menu2'); ?>
    <?php echo $__env->make('menu2', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('contenido2'); ?>
<div class="container mt-4">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header">Editar Personal</div>

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

                    <form action="<?php echo e(route('personal.update', $personal)); ?>" method="POST" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('PUT'); ?>

                        <div class="mb-3">
                            <label class="form-label">RFC</label>
                            <input type="text" name="rfc" class="form-control" value="<?php echo e(old('rfc', $personal->rfc)); ?>">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Nombre</label>
                            <input type="text" name="nombre" class="form-control" value="<?php echo e(old('nombre', $personal->nombre)); ?>">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Apellido Paterno</label>
                            <input type="text" name="apellido_pat" class="form-control" value="<?php echo e(old('apellido_pat', $personal->apellido_pat)); ?>">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Apellido Materno</label>
                            <input type="text" name="apellido_mat" class="form-control" value="<?php echo e(old('apellido_mat', $personal->apellido_mat)); ?>">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" value="<?php echo e(old('email', $personal->email)); ?>">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Sexo</label>
                            <select name="sexo" class="form-select">
                                <?php $__currentLoopData = \App\Models\Personal::SEXO_VALUES; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($s); ?>" <?php echo e(old('sexo', $personal->sexo) == $s ? 'selected' : ''); ?>><?php echo e(strtoupper($s)); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Departamento</label>
                            <input type="text" name="depto" class="form-control" value="<?php echo e(old('depto', $personal->depto)); ?>">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Foto actual</label>
                            <div class="mb-2">
                                <img src="<?php echo e($personal->photo ? asset('storage/'.$personal->photo) : asset('images/sin-foto.svg')); ?>" alt="Foto actual" class="img-thumb">
                            </div>
                            <label class="form-label">Cambiar foto (opcional)</label>
                            <input type="file" name="photo" class="form-control" accept="image/*">
                            <?php $__errorArgs = ['photo'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="text-danger"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="<?php echo e(route('personal.index')); ?>" class="btn btn-secondary">Cancelar</a>
                            <button class="btn btn-primary">Actualizar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('plantillas.login2', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Usuario\Herd\admonlab\resources\views/personal/edit.blade.php ENDPATH**/ ?>