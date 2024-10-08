<!DOCTYPE html>
<html lang="ru" data-bs-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $__env->yieldContent('titles', 'Recipes-Book'); ?></title>
    
    <link href="<?php echo e(asset('css/bootstrap.min.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('css/bootstrap-icons.min.css')); ?>" rel="stylesheet">
    
    <!--Обводим значки при наведении -->
    <style>
        body {
            background-color: #fdf5e6;
            margin: 0px;
            width: 100%;
            height: 100%;
            overflow: scroll;
        }

        [class*="btn"],
        h2,
        p {

            /* border: 2px; */
            i:hover {
                -webkit-text-stroke: 2px;
            }
        }
    </style>
    <?php echo $__env->yieldContent('styles'); ?>

</head>

<body>

    <script src="<?php echo e(asset('css/bootstrap.min.js')); ?>"></script>
    <?php echo $__env->make('components.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->yieldContent('breadcrumb'); ?>

    <main>
        <?php if($errors->any()): ?>
            <div class="alert alert-danger">
                <ul>
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><?php echo e($error); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        <?php endif; ?>

        <?php if(session('success')): ?>
            <div class="alert alert-success">
                <?php echo e(session('success')); ?>

            </div>
        <?php endif; ?>

        <?php echo $__env->yieldContent('main_content'); ?>
    </main>

    <?php echo $__env->make('components.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

</body>

</html>
<?php /**PATH F:\Site\!Project\Repository\Recipes-Book\resources\views/shablons/shablon-main.blade.php ENDPATH**/ ?>