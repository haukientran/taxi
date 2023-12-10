<?php if(isset($posts) && count($posts) > 0): ?>
	<?php $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="blog-item flex">
            <div class="blog-item__thumbnail">
                <a href="<?php echo e($post->getUrl() ?? ''); ?>" aria-label="<?php echo $post->name ?? ''; ?>">
                    <?php echo $__env->make('Default::general.components.image', [
						'src' => resizeWImage($post->image, 'w250'),
			            'width' => '200px',
			            'height' => '288px',
			            'lazy'   => true,
			            'title'  =>  getAlt($post->image ?? '')
			        ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </a>
            </div>
            <div class="blog-item__content">
                
                <a href="<?php echo e($post->getUrl()); ?>" aria-label="<?php echo $post->name ?? ''; ?>">
                    <div class="blog-item__title four-lines-ellipsis"><?php echo $post->name ?? ''; ?></div>
                    <div class="blog-item__des mt-10 three-lines-ellipsis fs-14">
                       <?php echo e(cutString(removeHTML($post->detail),120) ?? ''); ?>

                    </div>
                </a>
            </div>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php endif; ?>

<?php /**PATH /var/home/themes/default/src/Providers/../../resources/views/web/layouts/blog_item.blade.php ENDPATH**/ ?>