<?php $__env->startSection('titles', 'Главная страница'); ?>
<?php $__env->startSection('breadcrumb'); ?>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item active" aria-current="page">Главная</li>
    </ol>
  </nav>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('main_content'); ?>
    <div class="container">
        <h1><i> Категории</i></h1>
    </div>
    <div class="container">

        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <a href=<?php echo e(route('cat', $cat->slug)); ?>>
                <div>
                    <img src="<?php echo e(asset($cat->images)); ?>" alt="<?php echo e($cat->name_cat); ?>" widht="250" height="250">
                    <i><b><?php echo e($cat->name_cat); ?></b></i>
                </div>
            </a>
            <br>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('shablons.shablon-main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\Site\!Project\Repository\Recipes-Book\resources\views/home.blade.php ENDPATH**/ ?>