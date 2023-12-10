

<div class="mb-3 row">
    <label for="<?php echo e($name??''); ?>" class="<?php if($class_col == 'col-lg-12'): ?> col-md-2 <?php else: ?> col-md-4 <?php endif; ?> col-form-label"><?php echo app('translator')->get($label??''); ?></label>
    <div class="<?php if($class_col == 'col-lg-12'): ?> col-md-10 <?php else: ?> col-md-8 <?php endif; ?> form-switch form-switch-lg">
        <input type="checkbox" class="form-check-input" name="<?php echo e($name??''); ?>" value="<?php echo e($checked??0); ?>" <?php if($checked == $value): ?> checked <?php endif; ?> style="margin-top: 6px;left: 0;">
    </div> 
</div><?php /**PATH /var/home/packages/sudo-base/form/src/Providers/../../resources/views/base/checkbox.blade.php ENDPATH**/ ?>