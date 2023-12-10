<?php if(isset($slides) && count($slides) > 0): ?>
<div class="banner" id="banner">
    <div class="slide">
        <div class="slide-list s-wrap" id="slideList">
            <div class="s-content">
                <?php $__currentLoopData = $slides; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $slide): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="item" data-thumnail="">
                        <?php echo $__env->make('Default::general.components.image', [
                            'src' => getImage($slide->image ?? '/assets/images/banner_home.png', 'large'),
                            'width' => '416px',
                            'height' => '600px',
                            "lazy"   => $key != 0 ? true : '',
                            'title'  =>  'banner'
                        ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>
<?php /**PATH /var/home/themes/default/src/Providers/../../resources/views/mobile/layouts/banner.blade.php ENDPATH**/ ?>