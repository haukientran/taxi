<?php if(count($posts) > 0): ?>
	<?php echo $__env->make('Default::web.layouts.post_item',['posts'=>$posts], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php else: ?>
	<?php echo $__env->make('Default::web.layouts.list_empty', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php endif; ?>
<?php /**PATH /var/home/themes/default/src/Providers/../../resources/views/web/post/listdata.blade.php ENDPATH**/ ?>