<?php if(isset($data['table_simple']) && $data['table_simple'] == true): ?>
	<?php echo $__env->make('Category::listdata_simple', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php elseif(isset(Request()->trash) && Request()->trash == true): ?>
	<?php echo $__env->make('Table::listdata', ['module_name' => __('Thùng rác: ').__($module_name)], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php else: ?>
	<?php echo $__env->make('Table::listdata', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php endif; ?><?php /**PATH /var/home/packages/sudo-base/table/src/Providers/../../resources/views/index.blade.php ENDPATH**/ ?>