<?php if(isset($slides) && count($slides) > 0): ?>
<div class="banner" id="banner">
    <div class="slide">
        <div class="slide-list s-wrap" id="slideList">
            <div class="s-content">
                <?php $__currentLoopData = $slides; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $slide): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="item" data-thumnail="">
                        <?php echo $__env->make('Default::general.components.image', [
                            'src' => resizeWImage($slide->image ?? '/assets/images/banner_home.png', ''),
                            'width' => '1900px',
                            'height' => '700px',
                            "lazy"   => $key != 0 ? true : '',
                            'title'  =>  getAlt($slide->image ?? '')
                        ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>
<?php /**PATH /var/home/themes/default/src/Providers/../../resources/views/web/layouts/banner.blade.php ENDPATH**/ ?>