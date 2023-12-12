<?php if(isset($setting_home['should_choose_grid2']['title']) && count($setting_home['should_choose_grid2']['title']) > 0): ?>
<section id="should-choose" class="should_choose_grid2">
    <div class="container">
        <h2 class="section-title should-choose-title"><?php echo e(isset($setting_home['should_choose_grid2_title']) ? $setting_home['should_choose_grid2_title'] : 'Vì sao nên chọn du học lê ánh'); ?></h2>
        <div class="should-choose-list col-gird-6 w-100">
            <?php $__currentLoopData = $setting_home['should_choose_grid2']['title']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $title): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php echo $__env->make('Default::web.layouts.should-choose_item_grid2', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</section>
<?php endif; ?>
<?php /**PATH /var/home/themes/default/src/Providers/../../resources/views/mobile/layouts/should-choose-grid2.blade.php ENDPATH**/ ?>