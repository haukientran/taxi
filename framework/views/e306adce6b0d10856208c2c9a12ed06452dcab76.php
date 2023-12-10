<?php $__env->startSection('title'); ?> <?php echo app('translator')->get($module_name??''); ?> <?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>

<form action="" class="form-horizontal" enctype="multipart/form-data" method="post">
	<div class="row">
		<?php echo $__env->make('Form::generate', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
	</div>
</form>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('Core::layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/home/themes/default/src/Providers/../../resources/views/admin/settings/form.blade.php ENDPATH**/ ?>