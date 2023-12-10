<td style="width: 230px;">
	<?php if(isset($value->created_at) && !empty($value->created_at)): ?>
    	<p class="m-0"><strong><?php echo app('translator')->get('Translate::table.created_at'); ?>:</strong> <?php echo date('H:i:s d/m/Y', strtotime($value->created_at)); ?></p>
	<?php endif; ?>
	<?php if(isset($value->updated_at) && !empty($value->updated_at)): ?>
    	<p class="m-0"><strong><?php echo app('translator')->get('Translate::table.updated_at'); ?>:</strong> <?php echo date('H:i:s d/m/Y', strtotime($value->updated_at)); ?></p>
    <?php endif; ?>
	<?php if(isset($value->time) && !empty($value->time)): ?>
    	<p class="m-0"><strong><?php echo app('translator')->get('Translate::table.time'); ?>:</strong> <?php echo date('H:i:s d/m/Y', strtotime($value->time)); ?></p>
    <?php endif; ?>
</td><?php /**PATH /var/home/packages/sudo-base/table/src/Providers/../../resources/views/components/time.blade.php ENDPATH**/ ?>