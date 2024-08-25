
<?php $__env->startSection('titles'); ?>
    Главная страница
<?php $__env->stopSection(); ?>
<?php $__env->startSection('main_content'); ?>
    <?php $__currentLoopData = $categorii; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div>
            <img src="<?php echo e(asset('' . $cat->images)); ?>" >
            <?php echo e($cat->name_cat); ?>

        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('shablons.shablon-main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\Site\Recipes-Book\resources\views/home.blade.php ENDPATH**/ ?>