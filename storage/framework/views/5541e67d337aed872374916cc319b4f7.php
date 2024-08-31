<?php $__env->startSection('titles', 'Главная страница'); ?>


<?php $__env->startSection('main_content'); ?>
    
    <h1> Категории</h1>
    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <a href=<?php echo e(route('cat', $cat->slug)); ?>>
            <div>
                <img src="<?php echo e(asset($cat->images)); ?>" alt="<?php echo e($cat->name_cat); ?>">
                <?php echo e($cat->name_cat); ?>

                

                
            </div>
        </a>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('shablons.shablon-main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\Site\!Project\Repository\Recipes-Book\resources\views/home.blade.php ENDPATH**/ ?>