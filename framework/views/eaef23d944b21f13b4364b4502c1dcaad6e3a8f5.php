

<?php if($class_col != ''): ?>
    <div class="<?php echo e($class_col); ?>">
<?php endif; ?>
    <div class="mb-3 <?php if($has_row == true): ?> row <?php endif; ?>">
        <label for="<?php echo e($name??''); ?>" <?php if($has_row == true): ?> class="col-md-2 col-form-label" <?php endif; ?>><?php if($required==1): ?> * <?php endif; ?> <?php echo app('translator')->get($label??''); ?></label>
        <?php if($has_row == true): ?> 
            <div class="col-md-10">
        <?php endif; ?>
        <select class="form-control form-select" name="<?php echo e($name??''); ?>" id="<?php echo e($name??''); ?>">
            <?php $__currentLoopData = $options; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($key??''); ?>"
                    
                    <?php if(isset($value) && !empty($value)): ?>
                        <?php if($key == $value): ?> selected <?php endif; ?>
                    <?php endif; ?>
                    
                    <?php if(isset($disabled) && !empty($disabled)): ?>
                        <?php $__currentLoopData = $disabled; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dis): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if($dis == $key): ?> disabled="disabled"  <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>
                ><?php echo app('translator')->get($option??''); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
        <?php if($has_row == true): ?>
            </div> 
        <?php endif; ?>
    </div>

<?php if($class_col != ''): ?>
    </div>
<?php endif; ?>
<script>
    $(document).ready(function() {
        
        <?php if(isset($select2) && $select2 == 1): ?>
            $('#<?php echo e($name??''); ?>').select2();
        <?php endif; ?>
        
        <?php if($required==1): ?>
            validateSelect('#<?php echo e($name??''); ?>', '<?php echo app('translator')->get($label??$placeholder??$name??''); ?> <?php echo app('translator')->get('Translate::form.valid.is_select'); ?>')
        <?php endif; ?>
    });
</script><?php /**PATH /var/home/packages/sudo-base/form/src/Providers/../../resources/views/base/select.blade.php ENDPATH**/ ?>