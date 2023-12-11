<?php if(isset($data) && count($data) > 0): ?>
	<?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
	<div 
		class="item"
		data-id="<?php echo e($item->id); ?>"
		data-url="<?php echo e($item->getUrl()); ?>"
		data-image="<?php echo e($item->getImage('')); ?>"
		data-name="<?php echo e($item->name); ?>"
		data-size="<?php echo e($item->getSize()); ?>"
		data-created="<?php echo e($item->getCreatedAt()); ?>"
		data-updated="<?php echo e($item->getUpdatedAt()); ?>"
		data-title="<?php echo e($item->getTitle()); ?>"
		data-caption="<?php echo e($item->getCaption()); ?>"
	>
		<div class="item-image">
			<img src="<?php echo e($item->getImage()); ?>" alt="">
		</div>
		<div class="item-info">
			<p class="item-info__name"><?php echo e($item->name); ?></p>
			<p class="item-info__size"><?php echo trans('Translate::media.text_size'); ?>: <?php echo e($item->getSize()); ?></p>
			<p class="item-info__created"><?php echo trans('Translate::media.text_created'); ?>: <?php echo e($item->getCreatedAt()); ?></p>
			<p class="item-info__updated"><?php echo trans('Translate::media.text_updated'); ?>: <?php echo e($item->getUpdatedAt()); ?></p>
			<?php if($item->getTitle() != ''): ?>
			<p class="item-info__title"><?php echo trans('Translate::media.text_title'); ?>: <?php echo e($item->getTitle()); ?></p>
			<?php endif; ?>
			<?php if($item->getCaption() != ''): ?>
			<p class="item-info__caption"><?php echo trans('Translate::media.text_desc'); ?>: <?php echo e($item->getCaption()); ?></p>
			<?php endif; ?>
		</div>
	</div>
	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php else: ?>
	<div class="media-content__main-list__upload">
		<i class="fa fa-cloud-upload icon"></i>
		<label for="file" class="inputfile" files selected">
			<?php echo trans('Translate::media.no_image'); ?>

		</label>
	</div>
<?php endif; ?><?php /**PATH /var/home/packages/sudo-base/media/src/Providers/../../resources/views/media-item.blade.php ENDPATH**/ ?>