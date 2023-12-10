

<?php if($class_col != ''): ?>
    <div class="<?php echo e($class_col); ?>">
<?php endif; ?>
    <div class="mb-3 <?php if($has_row == true): ?> row <?php endif; ?>">
        <label for="<?php echo e($name??''); ?>" <?php if($has_row == true): ?> class="col-md-2 col-form-label" <?php endif; ?>><?php if($required==1): ?> * <?php endif; ?> <?php echo app('translator')->get($label??''); ?></label>
        <?php if($has_row == true): ?> 
            <div class="col-md-10">
        <?php endif; ?>
        <input type="text" class="form-control" autocomplete="off" name="<?php echo e($name??''); ?>" id="<?php echo e($name??''); ?>" placeholder="<?php echo app('translator')->get($placeholder??$label??$name??''); ?>" value="<?php echo e(old($name)??$value??''); ?>">
        <?php if($has_row == true): ?> 
            </div> 
        <?php endif; ?>
    </div>

<?php if($class_col != ''): ?>
    </div>
<?php endif; ?>
<script>
    $(document).ready(function() {
        $.datetimepicker.setLocale('<?php echo e(App::getLocale()??'vi'); ?>');
        $('#<?php echo e($name??''); ?>').datetimepicker({
            format:'Y-m-d H:i:s',
            defaultTime:'00:00:00',
            formatTime:'H:i:s',
            scrollMonth : false,
            scrollInput : false,
        });
        <?php if($required==1): ?>
            validateInput('#<?php echo e($name); ?>', '<?php echo app('translator')->get($label??$placeholder??$name??''); ?> <?php echo app('translator')->get('Translate::form.valid.no_empty'); ?>');
        <?php endif; ?>
    });
</script><?php /**PATH /var/home/packages/sudo-base/form/src/Providers/../../resources/views/base/datetimepicker.blade.php ENDPATH**/ ?>