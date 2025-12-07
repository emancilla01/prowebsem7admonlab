<?php $__env->startSection('menu2'); ?>
    <?php echo $__env->make('menu2', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('contenido2'); ?>

<h2>Editar Detalle #<?php echo e($detalle->id); ?></h2>

<?php if($errors->any()): ?>
    <div class="alert alert-danger">
        <ul>
            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li><?php echo e($error); ?></li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    </div>
<?php endif; ?>

<?php
    $ecmDetes = \App\Models\EcmDetequcom::pluck('serial','id');
    $ecmDetms = \App\Models\EcmDetmob::pluck('codigo','id');
?>

<form action="<?php echo e(route('entradas.detalle.update', [$entrada, $detalle])); ?>" method="POST">
    <?php echo csrf_field(); ?>
    <?php echo method_field('PUT'); ?>
    <?php
        $ecmDetes = \App\Models\EcmDetequcom::pluck('serial','id');
        $ecmDetms = \App\Models\EcmDetmob::pluck('codigo','id');
        $espacios = \App\Models\EspacioTrabajo::pluck('nombre_espacio','id_espacio');
    ?>

    <div class="mb-3">
        <label for="id_ecm_dete" class="form-label">ID equipo de cómputo</label>
        <select name="id_ecm_dete" id="id_ecm_dete" class="form-select">
            <option value="">-- Ninguno --</option>
            <?php $__currentLoopData = $ecmDetes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($id); ?>" <?php echo e(old('id_ecm_dete', $detalle->id_ecm_dete) == $id ? 'selected' : ''); ?>><?php echo e($label); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
    </div>

    <div class="mb-3">
        <label for="id_ecm_detm" class="form-label">ID mobiliario</label>
        <select name="id_ecm_detm" id="id_ecm_detm" class="form-select">
            <option value="">-- Ninguno --</option>
            <?php $__currentLoopData = $ecmDetms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($id); ?>" <?php echo e(old('id_ecm_detm', $detalle->id_ecm_detm) == $id ? 'selected' : ''); ?>><?php echo e($label); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
    </div>

    <div class="mb-3">
        <label for="no_serie" class="form-label">No. Serie</label>
        <input type="text" name="no_serie" id="no_serie" class="form-control" maxlength="100" value="<?php echo e(old('no_serie', $detalle->no_serie)); ?>" required>
    </div>

    <div class="mb-3">
        <label for="id_espaciotrabajo" class="form-label">Espacio de Trabajo</label>
        <select name="id_espaciotrabajo" id="id_espaciotrabajo" class="form-select" required>
            <?php $__currentLoopData = $espacios; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($id); ?>" <?php echo e(old('id_espaciotrabajo', $detalle->id_espaciotrabajo) == $id ? 'selected' : ''); ?>><?php echo e($label); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
    </div>

    <div class="d-flex gap-2">
        <button type="submit" class="btn btn-primary">Guardar</button>
        <a href="<?php echo e(route('entradas.detalle.index', $entrada)); ?>" class="btn btn-secondary">Cancelar</a>
    </div>

</form>

<div class="mt-3">
    <form action="<?php echo e(route('entradas.detalle.destroy', [$entrada, $detalle])); ?>" method="POST" onsubmit="return confirm('¿Eliminar este detalle?');">
        <?php echo csrf_field(); ?>
        <?php echo method_field('DELETE'); ?>
        <button class="btn btn-danger">Eliminar</button>
    </form>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('plantillas.login2', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Usuario\Herd\admonlab\resources\views/entradasdet/edit.blade.php ENDPATH**/ ?>