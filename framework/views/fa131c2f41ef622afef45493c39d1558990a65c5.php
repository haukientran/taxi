<?php
	$prefix = '';
	for ($i=0; $i < $value->level; $i++) { 
		$prefix .= '|— ';
	}
?>
<?php echo $__env->make('Table::components.link', ['text' => $prefix.$value->name, 'url' => route('admin.post_categories.edit', $value->id), 'width'=>'50px'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php /**PATH /var/home/packages/post/src/Providers/../../resources/views/post_categories/table.blade.php ENDPATH**/ ?>