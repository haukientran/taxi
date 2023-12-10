<?php if(count($errors) > 0): ?>
	<div class="alert alert-danger alert-dismissible" close-alert>
		<a href="#" class="close">×</a>
		<?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			<p class="mb-0"><?php echo app('translator')->get($error??''); ?></p>
		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
	</div>
<?php endif; ?>
<?php if(Session::has('type')): ?>
	<div class="alert alert-<?php echo Session::get('type'); ?> alert-dismissible" close-alert>
		<a href="#" class="close">×</a>
		<p class="mb-0"><?php echo app('translator')->get(Session::get('message')); ?></p>
	</div>
<?php endif; ?><?php /**PATH /var/home/packages/sudo-base/base/src/Providers/../../resources/views/layouts/base/alert.blade.php ENDPATH**/ ?>