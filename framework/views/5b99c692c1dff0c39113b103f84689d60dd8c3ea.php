
<img
    <?php if(isset($lazy) && $lazy == true): ?>
        loading="lazy"
    <?php endif; ?>
    src="<?php echo e(($src ?? '')); ?>"
    alt="<?php echo e($alt ?? getAlt($src??'')); ?>"
    <?php if(isset($title) && !empty($title)): ?>
        title="<?php echo e($title ?? ''); ?>"
    <?php endif; ?>
    <?php if(isset($width) && !empty($width)): ?>
        width="<?php echo e($width ?? ''); ?>"
    <?php endif; ?>
    <?php if(isset($height) && !empty($height)): ?>
        height="<?php echo e($height ?? ''); ?>"
    <?php endif; ?>
    <?php if(isset($class) && !empty($class)): ?>
        class="<?php echo e($class ?? ''); ?>"
    <?php endif; ?>
    
>
<?php /**PATH /var/home/themes/default/src/Providers/../../resources/views/general/components/image.blade.php ENDPATH**/ ?>