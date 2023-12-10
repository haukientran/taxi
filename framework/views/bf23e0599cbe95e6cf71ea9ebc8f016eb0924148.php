<?php $__env->startSection('title'); ?> <?php echo app('translator')->get('Translate::form.create'); ?> <?php echo app('translator')->get($module_name); ?> <?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>

<form action="<?php echo route('admin.'.$table_name.'.store'); ?>" class="form-horizontal" enctype="multipart/form-data" method="post">
<div class="row">
	<div class="col-lg-12">
		<div class="card">
			<div class="card-body">
				<p class="card-title-desc"><?php echo app('translator')->get('Những trường đánh dấu * là bắt buộc'); ?></p>
				<?php echo $__env->make('Form::generate', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
			</div>
		</div>
	</div>
	<?php if(isset($has_seo) && $has_seo == true): ?>
		<?php echo $__env->make('Form::metaseo', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
	<?php endif; ?>
</div>
</form>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('Core::layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/home/packages/sudo-base/form/src/Providers/../../resources/views/create.blade.php ENDPATH**/ ?>