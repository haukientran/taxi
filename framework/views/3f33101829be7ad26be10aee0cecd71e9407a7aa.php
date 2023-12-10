<div class="should-choose-item">
    <div class="should-choose-item__thumbnail">
        <?php echo $__env->make('Default::general.components.image', [
            'src' => resizeWImage($setting_home['should_choose']['image'][$key] ?? '', 'w100'),
            'width' => '80',
            'height' => '80',
            "lazy"   => true,
            'title'  =>  'icon_leanh'
        ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </div>
    <div class="should-choose-item__content">
            <h3 class="should-choose-item__title"><?php echo e($title ?? ''); ?></h3>
        <div class="should-choose-item__desc four-lines-ellipsis"><?php echo e(isset($setting_home['should_choose']['description'][$key]) ? $setting_home['should_choose']['description'][$key] : ''); ?></div>
    </div>
</div>
<?php /**PATH /var/home/themes/default/src/Providers/../../resources/views/web/layouts/should-choose_item_home.blade.php ENDPATH**/ ?>