<div
    <?php echo e($attributes
            ->merge([
                'id' => $getId(),
            ], escape: false)
            ->merge($getExtraAttributes(), escape: false)); ?>

>
    <?php echo e($getChildSchema()); ?>

</div>
<?php /**PATH /home/agnessdavid/workspace/LARAVEL/DECIDE AND BUILD/Projet1/vendor/filament/schemas/resources/views/components/grid.blade.php ENDPATH**/ ?>