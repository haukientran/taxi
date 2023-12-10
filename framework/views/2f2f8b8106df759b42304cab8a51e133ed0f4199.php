<?php if(isset($posts) && count($posts) > 0): ?>
	<?php $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="post-item">
            <div class="post-item__thumbnail">
                <a href="<?php echo e($post->getUrl()); ?>" aria-label="<?php echo $post->name ?? ''; ?>">
					<?php echo $__env->make('Default::general.components.image', [
						'src' => resizeWImage($post->image, 'w400'),
			            'width' => '380px',
			            'height' => '150px',
			            'lazy'   => true,
                        'title'  =>  getAlt($post->image ?? '')
			        ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
				</a>
            </div>
            <div class="post-item__content">
                <a href="<?php echo e($post->getUrl()); ?>" aria-label="">
                    <h3 class="post-item__title"> <?php echo $post->name ?? ''; ?></h3>
				</a>
                <div class="post-item__desc four-lines-ellipsis"><?php echo e(cutString(removeHTML($post->detail), 200) ?? ''); ?></div>
                
            </div>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php endif; ?>

<?php /**PATH /var/home/themes/default/src/Providers/../../resources/views/web/layouts/post_item.blade.php ENDPATH**/ ?>