<?php if(isset($type) && !empty($type)): ?>
	<div class="container-fluid p-0 mb-3" data-toggle_wrap>
		<div class="card card-light m-0">
			<div class="card-header" data-toggle_btn style="cursor: pointer;">
				<h4 class="card-title"><?php echo app('translator')->get($label ?? ''); ?></h4>
			</div>
			<div class="collapse" data-toggle_box>
				<div class="card-body">
					<div class="form-group mb-2">
			    		<label><?php echo app('translator')->get('Translate::form.menu.display_name'); ?></label>
			    		<input type="text" class="form-control menu-name">
			    	</div>

			    	<?php switch($type):
			    	    case ('custom_link'): ?>
			    	    	
			    	        <div class="form-group mb-2">
					    		<label><?php echo app('translator')->get('Translate::form.menu.link'); ?></label>
					    		<input type="text" class="form-control menu-link">
					    	</div>
		    	        <?php break; ?>
			    	    <?php case ('fix_link'): ?>
			    	    	
		    	        	<div class="form-group mb-2">
					    		<label><?php echo app('translator')->get('Translate::form.menu.link'); ?></label>
					    		<select class="form-control menu-link">
					    			<?php $__currentLoopData = $option; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $link => $text): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					    				<option value="<?php echo $link ?? ''; ?>"><?php echo app('translator')->get($text); ?></option>
					    			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					    		</select>
					    	</div>
		    	        <?php break; ?>
		    	        <?php case ('table_link'): ?>
							
		    	        	<div class="form-group mb-2">
					    		<label><?php echo app('translator')->get('Translate::form.menu.link'); ?></label>
					    		<input type="hidden" class="menu-table" value="<?php echo $table ?? ''; ?>">
					    		<select class="form-control menu-link">
					    			<?php $__currentLoopData = $option; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $link => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					    				<option value="<?php echo $link ?? ''; ?>" data-id="<?php echo $value['id'] ?? ''; ?>"><?php echo $value['name'] ?? ''; ?></option>
					    			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					    		</select>
					    	</div>
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
			    				<option value="<?php echo $key ?? ''; ?>"><?php echo app('translator')->get($target); ?></option>
			    			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			    		</select>
			    	</div>
			    	
			    	<div class="form-group">
			    		<label><?php echo app('translator')->get('Rel'); ?></label>
			    		<?php
			    			$rel_array = [ 'nofollow', 'noreferrer' ];
			    		?>
			    		<select class="form-control menu-rel">
		    				<option value="">-- <?php echo app('translator')->get('Translate::form.menu.no_rel'); ?> --</option>
			    			<?php $__currentLoopData = $rel_array; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rel): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			    				<option value="<?php echo $rel; ?>"><?php echo app('translator')->get($rel); ?></option>
			    			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			    		</select>
			    	</div>
			    	
			    	<div class="form-group mb-0 text-right">
			    		<button type="button" class="btn btn-primary menu-submit" data-type="<?php echo $type ?? ''; ?>" data-name="<?php echo $name ?? ''; ?>"><i class="fa fa-plus mr-2"></i><?php echo app('translator')->get('Translate::form.menu.add_menu'); ?></button>
			    	</div>
				</div>
			</div>
		</div>
	</div>
<?php endif; ?><?php /**PATH /var/home/packages/sudo-base/form/src/Providers/../../resources/views/base/components/customMenuSitebar.blade.php ENDPATH**/ ?>