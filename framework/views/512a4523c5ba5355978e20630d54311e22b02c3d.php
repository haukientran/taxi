<?php
	// Nếu như có đa ngôn ngữ
	if (isset($has_locale) && $has_locale == true && !empty(config('app.language') ?? [])) {
		// Lấy ra mảng lang_code
		$lang_code_array = [];
		foreach ($data['show_data'] as $show_data) {
			$lang_code_array[] = $show_data->lang_code ?? 0;
		}
		// Lấy ra toàn bộ bản ghi đa ngôn ngữ của dữ liệu có trong bảng
		$lang_metas = collect(DB::table('language_metas')->where('lang_table', $table_name)->whereIn('lang_code', $lang_code_array)->get());
	}
?>
<?php $__currentLoopData = $data['show_data']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
	<tr data-table="<?php echo e($table_name??''); ?>" data-id="<?php echo $value->id; ?>">
		<td class="text-center"><?php echo e($key+1); ?></td>
		<?php if(isset($data['action']) && !empty($data['action'])): ?>
			<td class="table-checkbox center">
				<input type="checkbox" class="form-check-input btn-checkbox checkone">
			</td>
		<?php endif; ?>

		<?php echo $__env->make($data['view'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

		<?php $__currentLoopData = $data['table_generate']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $generate): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			<?php switch($generate['type']):
                case ('pin'): ?>
                	<?php
                		$pin_field = $generate['field'];
                		$pin_name = 'pin_'.$generate['field'];
                	?>
                    <?php echo $__env->make('Table::components.pin', [
                    	'name' => $generate['field'] ?? '',
                    	'value' => (isset($value->$pin_name) && $value->$pin_name != 2147483647) ? $value->$pin_name : '',
                    	'placeholder' => 'Vị trí, vd: 1'
                    ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <?php break; ?>
				<?php case ('time'): ?>
		        	<?php echo $__env->make('Table::components.time', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
		        <?php break; ?>
				<?php case ('status'): ?>
					<td class="form-switch form-switch-lg text-center" style="width: 120px;">
				        <input type="checkbox" class="form-check-input" name="status" value="<?php echo $value->status; ?>" <?php if($value->status == 1): ?> checked <?php endif; ?> style="padding: 0;margin: 0;left: 0;">
				    </td>
				<?php break; ?>
			    <?php case ('show'): ?>
		        	<?php echo $__env->make('Table::components.action',['type' => 'show'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
		        <?php break; ?>
		        <?php case ('lang'): ?>
		        	<?php if(isset($has_locale) && $has_locale == true && !empty(config('app.language') ?? [])): ?>
		        		<td class="lang">
		        			<?php $__currentLoopData = config('app.language'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
		        				<?php
		        					$lang_data = $lang_metas->where('lang_locale', $key)->where('lang_code', $value->lang_code)->first()
		        				?>
		        				<?php if(isset($lang_data)): ?>
		        					<span><a href="<?php echo e(route('admin.'.$table_name.'.edit', $lang_data->lang_table_id)); ?>"><i class="fas fa-check text-pink"></i></a></span>
		        				<?php else: ?>
		        					<span><a href="<?php echo e(route('admin.'.$table_name.'.create', [
		        						'lang_referer' 	=> $value->id,
		        						'lang_locale' 	=> $key,
		        					])); ?>"><i class="fas fa-plus-square text-pink"></i></a></span>
		        				<?php endif; ?>
		        			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		        		</td>
		        	<?php endif; ?>
		        <?php break; ?>
		        <?php case ('order'): ?>
			        <?php echo $__env->make('Table::components.edit_text', [ 'width' => '100px', 'name' => 'order' ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
		        <?php break; ?>
		        <?php case ('edit'): ?>
			        <?php echo $__env->make('Table::components.action',['type' => 'edit'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
		        <?php break; ?>
		        <?php case ('delete'): ?>
			        <?php echo $__env->make('Table::components.action',['type' => 'delete'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
		        <?php break; ?>
		        <?php case ('action'): ?>
			        <?php echo $__env->make('Table::components.action',['type' => 'action'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
		        <?php break; ?>
		        <?php case ('delete_custom'): ?>
			        <?php echo $__env->make('Table::components.action',['type' => 'delete_custom'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
		        <?php break; ?>
		        <?php case ('restore'): ?>
			        <?php echo $__env->make('Table::components.action',['type' => 'restore'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
		        <?php break; ?>
			<?php endswitch; ?>
		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
	</tr>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

<?php if(count($data['show_data']) == 0): ?>
	<tr>
		<td colspan="<?php echo e(count($data['table_generate'])+2); ?>" class="text-center"><?php echo app('translator')->get('Translate::table.no_record'); ?></td>
	</tr>
<?php endif; ?>
<?php /**PATH /var/home/packages/sudo-base/table/src/Providers/../../resources/views/item.blade.php ENDPATH**/ ?>