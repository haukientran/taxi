

<?php if($class_col != ''): ?>
    <div class="<?php echo e($class_col); ?>">
<?php endif; ?>
    <div class="mb-3 <?php if($has_row == true): ?> row <?php endif; ?>">
        <label for="<?php echo e($name??''); ?>" <?php if($has_row == true): ?> class="col-md-2 col-form-label" <?php endif; ?>><?php if($required==1): ?> * <?php endif; ?> <?php echo app('translator')->get($label??''); ?></label>
        <?php if($has_row == true): ?> 
            <div class="col-md-10">
        <?php endif; ?>
        <textarea class="form-control" name="<?php echo e($name??''); ?>" id="<?php echo e($name??''); ?>"><?php echo removeScript(old($name) ?? $value ?? ''); ?></textarea>
        <?php if($has_row == true): ?> 
            </div> 
        <?php endif; ?>
    </div>

<?php if($class_col != ''): ?>
    </div>
<?php endif; ?>
<script>
    $(document).ready(function() {
        addTinyMCE('#<?php echo e($name??''); ?>');
        <?php if($required==1): ?>
            $('body').on('click', 'button[type=submit]', function(e) {
                content = tinyMCE.get('<?php echo e($name??''); ?>').getContent();
                if (checkEmpty(content)) {
                    $('#<?php echo e($name??''); ?>_box').find('.error').remove();
                    $('#<?php echo e($name??''); ?>_box').append(formHelper('<?php echo app('translator')->get($label??$placeholder??$name??''); ?> <?php echo app('translator')->get('Translate::form.valid.no_empty'); ?>'));
                }
            });
        <?php endif; ?>
    });
</script><?php /**PATH /var/home/packages/sudo-base/form/src/Providers/../../resources/views/base/editor.blade.php ENDPATH**/ ?>