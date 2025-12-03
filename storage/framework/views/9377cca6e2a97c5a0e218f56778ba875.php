<?php $__env->startSection('menu2'); ?>
    <?php echo $__env->make('menu2', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('contenido2'); ?>
<div class="container mt-4">
    <div class="card">
        <div class="card-header">Detalle del Personal</div>

        <div class="card-body">
            <dl class="row">
                <dt class="col-sm-3">ID</dt>
                <dd class="col-sm-9"><?php echo e($personal->id); ?></dd>

                <dt class="col-sm-3">RFC</dt>
                <dd class="col-sm-9"><?php echo e($personal->rfc); ?></dd>

                <dt class="col-sm-3">Nombre</dt>
                <dd class="col-sm-9"><?php echo e($personal->nombre); ?></dd>

                <dt class="col-sm-3">Apellido P.</dt>
                <dd class="col-sm-9"><?php echo e($personal->apellido_pat); ?></dd>

                <dt class="col-sm-3">Apellido M.</dt>
                <dd class="col-sm-9"><?php echo e($personal->apellido_mat); ?></dd>

                <dt class="col-sm-3">Email</dt>
                <dd class="col-sm-9"><?php echo e($personal->email); ?></dd>

                <dt class="col-sm-3">Sexo</dt>
                <dd class="col-sm-9"><?php echo e($personal->sexo); ?></dd>

                <dt class="col-sm-3">Departamento</dt>
                <dd class="col-sm-9"><?php echo e($personal->depto); ?></dd>
            </dl>

            <div class="d-flex justify-content-between">
                <a href="<?php echo e(route('personal.index')); ?>" class="btn btn-secondary">Volver</a>
                <a href="<?php echo e(route('personal.edit', $personal)); ?>" class="btn btn-primary">Editar</a>
            </div>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('plantillas.login2', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Usuario\Herd\admonlab\resources\views/personal/show.blade.php ENDPATH**/ ?>