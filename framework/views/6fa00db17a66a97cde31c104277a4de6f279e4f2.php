<?php if(isset($setting_home['activity']['image']) && count($setting_home['activity']['image']) > 0): ?>
<section id="activity">
    <div class="container">
        <h2 class="section-title activity-title"><?php echo e($title ?? 'Hoạt động tại Lê ánh'); ?></h2>
        <div class="activity-list  col-gird-6">
            <?php $__currentLoopData = $setting_home['activity']['image']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="activity-item item" data-thumnail="">
                <?php echo $__env->make('Default::general.components.image', [
                    'src' => resizeWImage($image, 'w600'),
                    'width' => '570px',
                    'height' => '315px',
                    'lazy'   => true,
                    'title'  =>  getAlt($image ?? '')
                ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</section>
<?php endif; ?>
<?php /**PATH /var/home/themes/default/src/Providers/../../resources/views/web/layouts/list_image_home.blade.php ENDPATH**/ ?>