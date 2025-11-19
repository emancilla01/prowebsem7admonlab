<?php $__env->startSection('menu'); ?>
    <?php echo $__env->make('logmenu', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('contenido'); ?>
<div class="d-flex justify-content-center align-items-center" style="height: 100vh;">
    <h1>Bienvenido al sistema IO</h1>
</div>
<?php $__env->stopSection(); ?> 
<?php echo $__env->make('plantillas.login', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Usuario\Herd\admonlab\resources\views/inicio.blade.php ENDPATH**/ ?>