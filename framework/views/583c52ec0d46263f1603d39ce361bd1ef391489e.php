<?php if(isset($setting_home['should_choose']['title']) && count($setting_home['should_choose']['title']) > 0): ?>
<section id="should-choose">
    <div class="container">
        <h2 class="section-title should-choose-title"><?php echo e(isset($setting_home['should_choose_title']) ? $setting_home['should_choose_title'] : 'Vì sao nên chọn du học lê ánh'); ?></h2>
        <div class="should-choose-list w-100">
            <?php $__currentLoopData = $setting_home['should_choose']['title']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $title): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php echo $__env->make('Default::mobile.layouts.should-choose_item_home', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</section>
<?php endif; ?>
<?php /**PATH /var/home/themes/default/src/Providers/../../resources/views/mobile/layouts/should-choose_home.blade.php ENDPATH**/ ?>