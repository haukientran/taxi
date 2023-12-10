<?php echo csrf_field(); ?>
<?php $__currentLoopData = $data_form; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
	<?php switch($item['form_type']):

		case ('title'): ?> 
			<?php echo $__env->make('Form::base.title', [
	        	'label'				=> $item['label'],
	        ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
		<?php break; ?>

		<?php case ('note'): ?>
			<?php echo $__env->make('Form::base.note', [
	        	'label'				=> $item['label'],
	        ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
		<?php break; ?>

		<?php case ('disable'): ?> 
			<?php echo $__env->make('Form::base.disable', [
	        	'value'				=> $item['value'],
	        	'label'				=> $item['label'],
	        	'has_row' 			=> $item['has_row'],
				'class_col' 		=> $item['class_col'],
	        ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
		<?php break; ?>
		
		<?php case ('card'): ?> 
			<div class="<?php echo e($item['col'] ?? ''); ?>">
				<div class="card">
					<div class="card-body">
						<?php if($item['title'] != ''): ?><h4 class="card-title"><?php echo app('translator')->get($item['title'] ?? ''); ?></h4><?php endif; ?>
						<?php if($item['desc'] != ''): ?><p class="card-title-desc"><?php echo app('translator')->get($item['desc'] ?? ''); ?></p><?php endif; ?>
		<?php break; ?>

		<?php case ('endCard'): ?>
					
					</div>
				
				</div>
			
			</div>
		<?php break; ?>

		<?php case ('col'): ?> 
			<div class="<?php echo e($item['class'] ?? ''); ?>">
		<?php break; ?>

		<?php case ('endCol'): ?> 
			</div>
		<?php break; ?>

		<?php case ('row'): ?> 
			<div class="row">
		<?php break; ?>

		<?php case ('endRow'): ?>
			</div>
		<?php break; ?>

		<?php case ('tab'): ?>
			<?php echo $__env->make('Form::base.tab', [
	        	'label'					=> $item['label'],
				'list_tab' 				=> $item['list_tab'],
				'list_class' 			=> $item['list_class'],
				'has_full' 				=> $item['has_full'],
	        ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
		<?php break; ?>

		<?php case ('endTab'): ?>
			<?php if($item['has_full'] == false): ?>
				</div>
			<?php endif; ?>
			</div>
		<?php break; ?>

		<?php case ('contentTab'): ?>
			<div class="tab-content tab-content__<?php echo e($item['class']); ?>">
		<?php break; ?>

		<?php case ('endContentTab'): ?>
			</div>
		<?php break; ?>

		<?php case ('lang'): ?> 
			<?php echo $__env->make('Form::base.lang', [
	        	'table_name'		=> $item['table_name'],
	        	'has_row'			=> $item['has_row'],
	        	'class_col'			=> $item['class_col'],
	        ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
		<?php break; ?>

		<?php case ('startGroup'): ?>
	        <?php echo $__env->make('Form::base.startGroup', [
	        	'id'				=> $item['id'],
				'label' 			=> $item['label'],
	        ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php break; ?>

        <?php case ('endGroup'): ?>
	        <?php echo $__env->make('Form::base.endGroup', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php break; ?>

	    <?php case ('text'): ?>
	        <?php echo $__env->make('Form::base.text', [
	        	'name'				=> $item['name'],
				'value' 			=> $item['value'],
				'required' 			=> $item['required'],
				'label' 			=> $item['label'],
				'placeholder' 		=> $item['placeholder'],
				'has_row' 			=> $item['has_row'],
				'class_col' 		=> $item['class_col'],
				'disable' 			=> $item['disable'],
	        ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php break; ?>

        <?php case ('number'): ?>
	        <?php echo $__env->make('Form::base.number', [
	        	'name'				=> $item['name'],
				'value' 			=> $item['value'],
				'required' 			=> $item['required'],
				'label' 			=> $item['label'],
				'placeholder' 		=> $item['placeholder'],
				'has_row' 			=> $item['has_row'],
				'class_col' 		=> $item['class_col'],
				'disable' 			=> $item['disable'],
				'convert_number' 	=> $item['convert_number'],
	        ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php break; ?>

        <?php case ('email'): ?>
	        <?php echo $__env->make('Form::base.email', [
	        	'name'				=> $item['name'],
				'value' 			=> $item['value'],
				'required' 			=> $item['required'],
				'label' 			=> $item['label'],
				'placeholder' 		=> $item['placeholder'],
				'has_row' 			=> $item['has_row'],
				'class_col' 		=> $item['class_col'],
				'disable' 			=> $item['disable'],
	        ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php break; ?>

		<?php case ('hidden'): ?> 
			<?php echo $__env->make('Form::base.hidden', [
	        	'name'				=> $item['name'],
				'value' 			=> $item['value'],
	        ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
		<?php break; ?>

		<?php case ('password'): ?> 
			<?php echo $__env->make('Form::base.password', [
	        	'name'				=> $item['name'],
				'value' 			=> $item['value'],
				'required' 			=> $item['required'],
				'label' 			=> $item['label'],
				'placeholder' 		=> $item['placeholder'],
				'confirm' 			=> $item['confirm'],
				'has_row' 			=> $item['has_row'],
				'class_col' 		=> $item['class_col'],
	        ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
		<?php break; ?>

		<?php case ('passwordGenerate'): ?> 
			<?php echo $__env->make('Form::base.passwordGenerate', [
	        	'name'				=> $item['name'],
				'value' 			=> $item['value'],
				'required' 			=> $item['required'],
				'label' 			=> $item['label'],
				'placeholder' 		=> $item['placeholder'],
				'confirm' 			=> $item['confirm'],
				'has_row' 			=> $item['has_row'],
				'class_col' 		=> $item['class_col'],
	        ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
		<?php break; ?>

		<?php case ('slug'): ?> 
			<?php echo $__env->make('Form::base.slug', [
	        	'name'				=> $item['name'],
				'value' 			=> $item['value'],
				'required' 			=> $item['required'],
				'label' 			=> $item['label'],
				'extends' 			=> $item['extends'],
				'unique' 			=> $item['unique'],
				'table' 			=> $item['table'],
				'has_row' 			=> $item['has_row'],
				'class_col' 		=> $item['class_col'],
	        ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
		<?php break; ?>

		<?php case ('textarea'): ?> 
			<?php echo $__env->make('Form::base.textarea', [
	        	'name'				=> $item['name'],
				'value' 			=> $item['value'],
				'required' 			=> $item['required'],
				'label' 			=> $item['label'],
				'placeholder' 		=> $item['placeholder'],
				'row' 				=> $item['row'],
				'has_row' 			=> $item['has_row'],
				'class_col' 		=> $item['class_col'],
				'disable' 			=> $item['disable'],
	        ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
		<?php break; ?>
			
		<?php case ('editor'): ?> 
			<?php echo $__env->make('Form::base.editor', [
	        	'name'				=> $item['name'],
				'value' 			=> $item['value'],
				'required' 			=> $item['required'],
				'label' 			=> $item['label'],
				'has_row' 			=> $item['has_row'],
				'class_col' 		=> $item['class_col'],
	        ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
		<?php break; ?>

		<?php case ('select'): ?> 
			<?php echo $__env->make('Form::base.select', [
	        	'name'				=> $item['name'],
				'value' 			=> $item['value'],
				'required' 			=> $item['required'],
				'label' 			=> $item['label'],
				'options' 			=> $item['options'],
				'select2' 			=> $item['select2'],
				'disabled' 			=> $item['disabled'],
				'has_row' 			=> $item['has_row'],
				'class_col' 		=> $item['class_col']
	        ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
		<?php break; ?>

		<?php case ('multiSelect'): ?> 
			<?php echo $__env->make('Form::base.multiSelect', [
	        	'name'				=> $item['name'],
				'value' 			=> $item['value'],
				'required' 			=> $item['required'],
				'label' 			=> $item['label'],
				'options' 			=> $item['options'],
				'placeholder' 		=> $item['placeholder'],
				'select2' 			=> $item['select2'],
				'disabled' 			=> $item['disabled'],
				'has_row' 			=> $item['has_row'],
				'class_col' 		=> $item['class_col'],
	        ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
		<?php break; ?>

		<?php case ('checkbox'): ?>
			<?php echo $__env->make('Form::base.checkbox', [
	        	'name'				=> $item['name'],
				'value' 			=> $item['value'],
				'checked' 			=> $item['checked'],
				'label' 			=> $item['label'],
				'class_col' 		=> $item['class_col']
	        ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
		<?php break; ?>

		<?php case ('multiCheckbox'): ?>
			<?php echo $__env->make('Form::base.multiCheckbox', [
	        	'name'				=> $item['name'],
				'value' 			=> $item['value'],
				'required' 			=> $item['required'],
				'label' 			=> $item['label'],
				'options' 			=> $item['options'],
				'has_row' 			=> $item['has_row'],
				'class_col' 		=> $item['class_col']
	        ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
		<?php break; ?>

		<?php case ('radio'): ?>
			<?php echo $__env->make('Form::base.radio', [
	        	'name'				=> $item['name'],
				'value' 			=> $item['value'],
				'label' 			=> $item['label'],
				'options' 			=> $item['options'],
				'class_col' 		=> $item['class_col']
	        ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
		<?php break; ?>

		<?php case ('tags'): ?> 
			<?php echo $__env->make('Form::base.tags', [
	        	'name'				=> $item['name'],
				'value' 			=> $item['value'],
				'required' 			=> $item['required'],
				'label' 			=> $item['label'],
				'placeholder' 		=> $item['placeholder'],
				'auto_click' 		=> $item['auto_click'],
				'has_row' 			=> $item['has_row'],
				'class_col' 		=> $item['class_col'],
	        ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
		<?php break; ?>

		<?php case ('image'): ?> 
			<?php echo $__env->make('Form::base.image', [
	        	'name'				=> $item['name'],
				'value' 			=> $item['value'],
				'required' 			=> $item['required'],
				'label' 			=> $item['label'],
				'title_btn' 		=> $item['title_btn'],
				'helper_text' 		=> $item['helper_text'],
				'has_row' 			=> $item['has_row'],
				'class_col' 		=> $item['class_col'],
	        ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
		<?php break; ?>

		<?php case ('multiImage'): ?> 
			<?php echo $__env->make('Form::base.multiImage', [
	        	'name'				=> $item['name'],
				'value' 			=> $item['value'],
				'required' 			=> $item['required'],
				'label' 			=> $item['label'],
				'title_btn' 		=> $item['title_btn'],
				'has_row' 			=> $item['has_row'],
				'class_col' 		=> $item['class_col'],
	        ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
		<?php break; ?>

		<?php case ('datepicker'): ?> 
			<?php echo $__env->make('Form::base.datepicker', [
	        	'name'				=> $item['name'],
				'value' 			=> $item['value'],
				'required' 			=> $item['required'],
				'label' 			=> $item['label'],
				'has_row' 			=> $item['has_row'],
				'class_col' 		=> $item['class_col'],
	        ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
		<?php break; ?>

		<?php case ('datetimepicker'): ?> 
			<?php echo $__env->make('Form::base.datetimepicker', [
	        	'name'				=> $item['name'],
				'value' 			=> $item['value'],
				'required' 			=> $item['required'],
				'label' 			=> $item['label'],
				'has_row' 			=> $item['has_row'],
				'class_col' 		=> $item['class_col'],
	        ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
		<?php break; ?>

		<?php case ('suggest'): ?> 
			<?php echo $__env->make('Form::base.suggest', [
	        	'name'				=> $item['name'],
				'value' 			=> $item['value'],
				'required' 			=> $item['required'],
				'label' 			=> $item['label'],
				'placeholder' 		=> $item['placeholder'],
	        	'suggest_table' 	=> $item['suggest_table'], 
	        	'suggest_id' 		=> $item['suggest_id'], 
	        	'suggest_name' 		=> $item['suggest_name'],
	        	'suggest_locale' 	=> $item['suggest_locale'],
	        	'has_row' 			=> $item['has_row'],
				'class_col' 		=> $item['class_col'],
	        ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
		<?php break; ?>

		<?php case ('multiSuggest'): ?> 
			<?php echo $__env->make('Form::base.multiSuggest', [
	        	'name'				=> $item['name'],
				'value' 			=> $item['value'],
				'required' 			=> $item['required'],
				'label' 			=> $item['label'],
				'placeholder' 		=> $item['placeholder'],
	        	'suggest_table' 	=> $item['suggest_table'], 
	        	'suggest_id' 		=> $item['suggest_id'], 
	        	'suggest_name' 		=> $item['suggest_name'],
	        	'suggest_locale' 	=> $item['suggest_locale'],
	        	'has_row' 			=> $item['has_row'],
				'class_col' 		=> $item['class_col'],
				'lang_locale' 		=> $item['lang_locale'],
	        ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
		<?php break; ?>

		<?php case ('custom'): ?>
			<?php echo $__env->make($item['template'], $item['param'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
		<?php break; ?>

		<?php case ('customMenu'): ?> 
			<?php echo $__env->make($item['template'], [
				'name'				=> $item['name'],
				'value' 			=> $item['value'],
				'label' 			=> $item['label'],
			], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
		<?php break; ?>
		
		<?php case ('action'): ?>
			<?php echo $__env->make('Form::base.action', [
	        	'type'				=> $item['type'],
	        	'preview'			=> $item['preview'],
	        	'exit_url'			=> $item['exit_url'],
	        	'custom'			=> $item['custom'],
	        ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
		<?php break; ?>

		<?php case ('actionInline'): ?>
			<?php echo $__env->make('Form::base.actionInline', [
	        	'type'				=> $item['type'],
	        ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
		<?php break; ?>

	<?php endswitch; ?>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php /**PATH /var/home/packages/sudo-base/form/src/Providers/../../resources/views/generate.blade.php ENDPATH**/ ?>