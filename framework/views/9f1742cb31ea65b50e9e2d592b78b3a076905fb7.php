<?php
	$table_link = [];
	if (!empty(config('app.menu_form.table_link'))) {
		foreach (config('app.menu_form.table_link') as $table => $option) {
			$models = new $option['models'];
			$data_option = $models->getCustomMenu($option['has_locale'] ?? false);
			$table_link[$table] = $data_option;
		}
	}
?>
<div class="row config-menu">
	<div class="col-lg-12 p-0">	
		<div class="card card-info" id="<?php echo e($name ?? ''); ?>_wrap">
			<div class="card-header" data-bs-toggle="collapse" data-parent="#<?php echo e($name ?? ''); ?>_wrap" href="#<?php echo e($name ?? ''); ?>_box" class="collapsed" aria-expanded="false" style="cursor: pointer;">
				<h4 class="card-title"><?php echo app('translator')->get($label ?? ''); ?></h4>
			</div>
			<div class="panel-collapse collapse show" id="<?php echo e($name ?? ''); ?>_box">
				<div class="card-body row">

					<div class="col-xl-4 col-lg-4 col-md-12 p-0">
						<?php echo $__env->make('Form::base.components.customMenuSitebar', [ 
							'type' => 'custom_link',
							'label' => __('Translate::form.menu.custom_link'),
						], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
						
						<?php if(isset(config('app.menu_form.menu_link')[\App::getLocale()]) && !empty(config('app.menu_form.menu_link')[\App::getLocale()])): ?>
						<?php echo $__env->make('Form::base.components.customMenuSitebar', [ 
							'type' => 'fix_link',
							'label' => __('Translate::form.menu.fix_link'),
							'option' => config('app.menu_form.menu_link')[\App::getLocale()] ?? [],
						], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
						<?php endif; ?>

						<?php if(!empty(config('app.menu_form.table_link'))): ?>
							<?php $__currentLoopData = config('app.menu_form.table_link'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $table => $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<?php echo $__env->make('Form::base.components.customMenuSitebar', [ 
									'type' => 'table_link',
									'label' => __($option['name'] ?? ''),
									'table' => $table,
									'option' => $table_link[$table] ?? [],
								], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						<?php endif; ?>
					</div>

					<div class="col-xl-6 col-lg-6 col-md-12">
						<div class="nestable">
							<input type="hidden" name="<?php echo e($name ?? ''); ?>" value="">
							<div class="nestable-action">
								<p class="nestable-action__text"><?php echo app('translator')->get('Translate::form.menu.structure'); ?></p>
								<div class="nestable-action__group">
						        	<button type="button" class="nestable-action__btn plus" data-nestable_action="expandAll" href="#<?php echo e($name ?? ''); ?>"><i class="fas fa-plus"></i></button>
						        	<button type="button" class="nestable-action__btn minus" data-nestable_action="collapseAll" href="#<?php echo e($name ?? ''); ?>"><i class="fas fa-minus"></i></button>
								</div>
							</div>
							
							<div class="dd" id="<?php echo e($name ?? ''); ?>">
							    <ol class="dd-list">
							    	<?php if(isset($value) && !empty($value)): ?>
							    		<?php
								    		$value = json_decode($value);
								    		$data = [ 
									    		'datas' => $value ?? [],
									    		'menu_link' => config('app.menu_form.menu_link')[\App::getLocale()] ?? [],
									    		'table_link' => $table_link ?? []
									    	];
								    	?>
								    	<?php echo $__env->make('Form::base.components.customMenuValue', $data, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
							    	<?php endif; ?>
							    </ol>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>	
	</div>
</div>

<script>
	jQuery(document).ready(function() {
		// Sinh nestable vaf update lại input mỗi khi thay đổi
		$('#<?php echo e($name ?? ''); ?>').nestable({
	        group: 1
	    }).on('change', function() {
	    	<?php echo e($name?? ''); ?>_value = window.JSON.stringify($('#<?php echo e($name ?? ''); ?>').nestable('serialize'));
	    	$('input[name=<?php echo e($name ?? ''); ?>]').val(<?php echo e($name?? ''); ?>_value);
	    });
    	$('input[name=<?php echo e($name ?? ''); ?>]').val(window.JSON.stringify($('#<?php echo e($name ?? ''); ?>').nestable('serialize')));

	    changeMenu('#<?php echo e($name ?? ''); ?>');
	});
</script><?php /**PATH /var/home/packages/sudo-base/form/src/Providers/../../resources/views/base/customMenu.blade.php ENDPATH**/ ?>