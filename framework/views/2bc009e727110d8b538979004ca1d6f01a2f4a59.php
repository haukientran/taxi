<?php if(isset($table_name) && !empty($table_name)): ?>
	<?php if(isset($has_locale) && $has_locale == true): ?>
		<?php
			$lang_table = $table_name;
			$lang_referer = Request()->lang_referer;
			$lang_locale = Request()->lang_locale;
		?>
		<?php if(isset($lang_referer) && !empty($lang_referer)): ?>
			
			<?php $record = DB::table($lang_table)->where('id', $lang_referer)->first(); ?>
			
			<?php echo $__env->make('Form::base.disable', [
		        'value'             => $record->name ?? '',
		        'label'             => __('Translate::admin.recore_origin'),
		    ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
			
			<?php echo $__env->make('Form::base.hidden', [
		    	'name' => 'lang_locale',
				'value' => $lang_locale,
		    ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
			
		    <?php echo $__env->make('Form::base.hidden', [
		    	'name' => 'lang_referer',
				'value' => $lang_referer,
		    ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
		<?php endif; ?>
	<?php endif; ?>
<?php endif; ?><?php /**PATH /var/home/packages/sudo-base/form/src/Providers/../../resources/views/base/lang.blade.php ENDPATH**/ ?>