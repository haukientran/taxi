
<div class="form-actions">
	<div class="form-actions__group">
		<?php switch($type):
		    case ('add'): ?>
	    		<button type="submit" name="redirect" value="edit" class="btn btn-sm btn-primary">
	    			<i class="fas fa-save mr-1"></i> 
	    			<?php echo app('translator')->get('Translate::form.action.create'); ?>
	    		</button>
				<button type="submit" name="redirect" value="save" class="btn btn-sm btn-warning">
					<i class="fas fa-share-square mr-1"></i> 
					<?php echo app('translator')->get('Translate::form.action.save_draft'); ?>
				</button>
				<?php if(isset($preview) && $preview != ''): ?>
				<a href="<?php echo e($preview); ?>" target="_blank" class="btn btn-sm btn-primary">
					<i class="fa fa-eye mr-1"></i> 
					<?php echo app('translator')->get('Translate::form.action.show'); ?>
				</a>
				<?php endif; ?>
				<?php echo $__env->make('Form::base.action_item', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
				<a href="<?php echo e((!empty($exit_url)) ? $exit_url : route('admin.'.$table_name.'.index')); ?>" class="btn btn-sm btn-danger">
					<i class="fa fa-sign-out-alt mr-1"></i>
					<?php echo app('translator')->get('Translate::form.action.exit'); ?>
				</a>
		    <?php break; ?>

		    <?php case ('edit'): ?>
	    		<button type="submit" name="redirect" value="edit" class="btn btn-sm btn-primary">
	    			<i class="fas fa-save mr-1"></i> 
	    			<?php echo app('translator')->get('Translate::form.action.save'); ?>
	    		</button>
				<button type="submit" name="redirect" value="index" class="btn btn-sm btn-info">
					<i class="fas fa-share-square mr-1"></i> 
					<?php echo app('translator')->get('Translate::form.action.save_and_exit'); ?>
				</button>
				<?php if(isset($preview) && $preview != ''): ?>
				<a href="<?php echo e($preview); ?>" target="_blank" class="btn btn-sm btn-primary">
					<i class="fa fa-eye mr-1"></i> 
					<?php echo app('translator')->get('Translate::form.action.show'); ?>
				</a>
				<?php endif; ?>
				<?php echo $__env->make('Form::base.action_item', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
				<a href="<?php echo e((!empty($exit_url)) ? $exit_url : route('admin.'.$table_name.'.index')); ?>" class="btn btn-sm btn-danger">
					<i class="fa fa-sign-out-alt mr-1"></i> 
					<?php echo app('translator')->get('Translate::form.action.exit'); ?>
				</a>
		    <?php break; ?>

		    <?php case ('editconfig'): ?>
	    		<button type="submit" name="redirect" value="edit" class="btn btn-sm btn-primary">
	    			<i class="fas fa-save mr-1"></i> 
	    			<?php echo app('translator')->get('Translate::form.action.save_setting'); ?>
	    		</button>
				<?php if(isset($preview) && $preview != ''): ?>
				<a href="<?php echo e($preview); ?>" target="_blank" class="btn btn-sm btn-secondary">
					<i class="fa fa-eye mr-1"></i> 
					<?php echo app('translator')->get('Translate::form.action.show'); ?>
				</a>
				<?php endif; ?>
				<?php echo $__env->make('Form::base.action_item', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
		    <?php break; ?>

		    <?php default: ?>
				<?php echo $__env->make('Form::base.action_item', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
		    <?php break; ?>
		<?php endswitch; ?>
	</div>
</div>
<?php /**PATH /var/home/packages/sudo-base/form/src/Providers/../../resources/views/base/action.blade.php ENDPATH**/ ?>