<form class="d-flex my-2 my-lg-0" method="GET" action="<?php echo e($action ?? url()->current()); ?>">
    <input
        class="form-control me-sm-2"
        type="search"
        name="<?php echo e($name ?? 'q'); ?>"
        value="<?php echo e(request($name ?? 'q')); ?>"
        placeholder="<?php echo e($placeholder ?? 'Search'); ?>"
        aria-label="search"
    />
    <?php if(isset($model)): ?>
        <input type="hidden" name="model" value="<?php echo e($model); ?>" />
    <?php endif; ?>
    <button class="btn btn-outline-success my-2 my-sm-0 ms-2" type="submit">
        <?php echo e($buttonText ?? 'Search'); ?>

    </button>
</form>
<?php /**PATH C:\Users\Usuario\Herd\admonlab\resources\views/partials/search_form.blade.php ENDPATH**/ ?>