<?php $__env->startSection('head'); ?>
    <link rel="stylesheet" href="/static/css/forms.css">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('main'); ?>
    <?php echo $__env->make("global.partials.registerForm", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>




<?php echo $__env->make("root", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/rating_system/app/views/register.blade.php ENDPATH**/ ?>