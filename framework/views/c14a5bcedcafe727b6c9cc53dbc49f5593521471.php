

<?php if($class_col != ''): ?>
    <div class="<?php echo e($class_col); ?>">
<?php endif; ?>
    <div class="mb-3 <?php if($has_row == true): ?> row <?php endif; ?>" style="position: relative;">
        <label for="<?php echo e($name??''); ?>" <?php if($has_row == true): ?> class="col-md-2 col-form-label" <?php endif; ?>><?php if($required==1): ?> * <?php endif; ?> <?php echo app('translator')->get($label??''); ?></label>
        <?php if($has_row == true): ?> 
            <div class="col-md-10">
        <?php endif; ?>
        <input type="text" class="form-control" autocomplete="off" name="<?php echo e($name??''); ?>" id="<?php echo e($name??''); ?>" placeholder="<?php echo app('translator')->get($placeholder??$label??$name??''); ?>" value="<?php echo e(old($name)??$value??''); ?>" <?php if($disable == true): ?> disabled <?php endif; ?>>
        
        <?php if($name == 'old'): ?> <span class="sync-links-old"><?php echo env('APP_URL'); ?></span> <?php endif; ?>
        
        <?php if($has_row == true): ?> 
            </div> 
        <?php endif; ?>
    </div>

<?php if($class_col != ''): ?>
    </div>
<?php endif; ?>
<script>
    $(document).ready(function() {
        <?php if($required==1): ?>
            validateInput('#<?php echo e($name??''); ?>', '<?php echo app('translator')->get($label??$placeholder??$name??''); ?> <?php echo app('translator')->get('Translate::form.valid.no_empty'); ?>');
        <?php endif; ?>

        // Nếu là module link đồng bộ thì thêm domain trước liên kết nguồn
        <?php if($name == 'old'): ?>
            var width_domain = $('.sync-links-old').width()+30+10;
            $('.sync-links-old').parents('.mb-3').find('input').css('padding-left', width_domain+'px');
        <?php endif; ?>
    });
</script><?php /**PATH /var/home/packages/sudo-base/form/src/Providers/../../resources/views/base/text.blade.php ENDPATH**/ ?>