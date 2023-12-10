<?php if(isset($datas) && !empty($datas)): ?>
<?php $__currentLoopData = $datas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<li 
	class="dd-item" 
	data-type="<?php echo $data->type ?? ''; ?>"
	data-name="<?php echo $data->name ?? ''; ?>"
	data-link="<?php echo $data->link ?? ''; ?>"
	data-target="<?php echo $data->target ?? ''; ?>"
    data-rel="<?php echo $data->rel ?? ''; ?>"
    <?php if(isset($data->type) && $data->type == 'table_link'): ?>
       data-table="<?php echo $data->table ?? ''; ?>"
	   data-id="<?php echo $data->id ?? ''; ?>" 
    <?php endif; ?>
>
    <div class="dd-handle">
    	<div class="dd-title"><?php echo $data->name ?? ''; ?></div>
    </div>
	<div class="dd-action">
		<button type="button" class="plus" data-nestable_edit><i class="fas fa-edit"></i></button>
		<button type="button" class="remove" data-nestable_remove><i class="fas fa-trash"></i></button>
	</div>
    <div class="dd-collape">
        
    	<div class="form-group mb-2">
    		<label><?php echo app('translator')->get('Translate::form.menu.display_name'); ?></label>
    		<input type="text" class="form-control menu-name" value="<?php echo $data->name ?? ''; ?>">
    	</div>
    	<?php switch($data->type):
    	    case ('custom_link'): ?>
    	        
    	        <div class="form-group mb-2">
		    		<label><?php echo app('translator')->get('Translate::form.menu.link'); ?></label>
		    		<input type="text" class="form-control menu-link" value="<?php echo $data->link ?? ''; ?>">
		    	</div>
    	    <?php break; ?>
    	    <?php case ('fix_link'): ?>
    	        
	        	<div class="form-group mb-2">
		    		<label><?php echo app('translator')->get('Translate::form.menu.link'); ?></label>
		    		<select class="form-control menu-link">
		    			<?php $__currentLoopData = $menu_link; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $link => $text): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
		    				<option value="<?php echo $link ?? ''; ?>" <?php if($link == $data->link): ?> selected <?php endif; ?>><?php echo app('translator')->get($text); ?></option>
		    			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		    		</select>
		    	</div>
            <?php break; ?>
            <?php case ('table_link'): ?>
                
                <?php if(!empty($table_link)): ?>
                    <div class="form-group mb-2">
                        <label><?php echo app('translator')->get('Translate::form.menu.link'); ?></label>
                        <select class="form-control menu-link">
                            <?php $__currentLoopData = $table_link[$data->table]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $link => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo $link ?? ''; ?>" <?php if($link == $data->link): ?> selected <?php endif; ?> data-id="<?php echo $value['id'] ?? ''; ?>"><?php echo $value['name'] ?? ''; ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                <?php endif; ?>
    	    <?php break; ?>
    	<?php endswitch; ?>
		
    	<div class="form-group mb-2">
    		<label><?php echo app('translator')->get('Target'); ?></label>
    		<?php
    			$target_array = [
    				'_self' => __('Translate::form.menu.open_direct'),
    				'_blank' => __('Translate::form.menu.open_blank'),
    			];
    		?>
    		<select class="form-control menu-target">
    			<?php $__currentLoopData = $target_array; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $target): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    				<option value="<?php echo $key ?? ''; ?>" <?php if($data->target == $key): ?> selected <?php endif; ?>><?php echo app('translator')->get($target); ?></option>
    			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    		</select>
    	</div>
        
    	<div class="form-group">
    		<label><?php echo app('translator')->get('Rel'); ?></label>
    		<?php
    			$rel_array = [ 'nofollow', 'noreferrer' ];
    		?>
    		<select class="form-control menu-rel">
				<option value="" <?php if($data->rel == ''): ?> selected <?php endif; ?>>-- <?php echo app('translator')->get('Translate::form.menu.no_rel'); ?> --</option>
    			<?php $__currentLoopData = $rel_array; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rel): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    				<option value="<?php echo $rel; ?>" <?php if($data->rel == $rel): ?> selected <?php endif; ?>><?php echo app('translator')->get($rel); ?></option>
    			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    		</select>
    	</div>
        
    	<div class="form-group mb-0 text-right">
    		<button type="button" class="btn btn-danger btn-sm" data-nestable_edit><?php echo app('translator')->get('Translate::form.menu.close'); ?></button>
    	</div>
    </div>
    <?php if(isset($data->children) && !empty($data->children)): ?>
        <ol class="dd-list">
            <?php echo $__env->make('Form::base.components.customMenuValue', [ 
                'datas' => $data->children,
                'menu_link' => $menu_link ?? [],
            ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </ol>
    <?php endif; ?>
</li>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php endif; ?><?php /**PATH /var/home/packages/sudo-base/form/src/Providers/../../resources/views/base/components/customMenuValue.blade.php ENDPATH**/ ?>