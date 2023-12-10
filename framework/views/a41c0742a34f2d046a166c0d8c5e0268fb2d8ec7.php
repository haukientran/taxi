<?php if(isset($setting_home['video_youtube_feedback']['image']) && count($setting_home['video_youtube_feedback']['image']) > 0): ?>
<section id="feedback">
    <h2 class="section-title feedback-title"><?php echo e($title ?? 'Chia sẻ từ học viên lê ánh'); ?></h2>
    <div class="feedback-list">
        <div class="container feedback-list-container col-gird-6">
            <?php $__currentLoopData = $setting_home['video_youtube_feedback']['image']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if($key < 2): ?>
                    <div class="feedback-item">
                        <a href="<?php echo e($setting_home['video_youtube_feedback']['link'][$key]); ?>"  data-fancybox="" aria-label="Video_<?php echo e($key); ?>">
                            <?php echo $__env->make('Default::general.components.image', [
                                'src' => resizeWImage($image, 'w600'),
                                'width' => '570px',
                                'height' => '315px',
                                'lazy'   => true,
                                'title'  =>  getAlt($image ?? '')
                            ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            <?php if($setting_home['video_youtube_feedback']['link'][$key] != null): ?>
                                <div class="icon">
                                    <?php echo $__env->make('Default::general.components.image', [
                                        'src' =>  '/assets/images/img/icon_ytb.webp' ?? '',
                                        'width' => '50',
                                        'height' => '50',
                                        'lazy'   => true,
                                        'title'  => 'icon youtube'
                                    ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                </div>
                            <?php endif; ?>
                        </a>
                    </div>
                <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</section>
<?php endif; ?>

<?php /**PATH /var/home/themes/default/src/Providers/../../resources/views/web/layouts/feedback_home.blade.php ENDPATH**/ ?>