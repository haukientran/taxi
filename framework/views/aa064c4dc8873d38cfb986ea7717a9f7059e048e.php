
<?php if(isset($custom) && !empty($custom)): ?>
	<?php $__currentLoopData = json_decode(json_encode($custom)); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $custom): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
		<?php switch($custom->type):
		    case ('submit'): ?> 
				<button 
					type="submit" 
					name="redirect" 
					value="<?php echo e($custom->value ?? ''); ?>" 
					class="btn btn-sm btn-<?php echo e($custom->btn_type ?? ''); ?>"
					<?php if(isset($custom->formaction)): ?> formaction="<?php echo e($custom->formaction ?? ''); ?>" <?php endif; ?>
				>
	    			<i class="<?php echo e($custom->icon ?? ''); ?> mr-1"></i> 
	    			<?php echo app('translator')->get($custom->label ?? ''); ?>
	    		</button>
		    <?php break; ?>
		    <?php case ('link'): ?>
	    		<a href="<?php echo e($custom->link ?? ''); ?>" class="btn btn-sm btn-<?php echo e($custom->btn_type ?? ''); ?>">
					<i class="<?php echo e($custom->icon ?? ''); ?> mr-1"></i> 
					<?php echo app('translator')->get($custom->label ?? ''); ?>
				</a>
		    <?php break; ?>
		<?php endswitch; ?>
	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php endif; ?><?php /**PATH /var/home/packages/sudo-base/form/src/Providers/../../resources/views/base/action_item.blade.php ENDPATH**/ ?>