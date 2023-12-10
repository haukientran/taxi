

<?php if($class_col != ''): ?>
    <div class="<?php echo e($class_col); ?>">
<?php endif; ?>
<div class="form-group-tags mb-3 <?php if($has_row == true): ?> row <?php endif; ?>" style="position: relative;">
    <label for="<?php echo e($name??''); ?>" <?php if($has_row == true): ?> class="col-md-2 col-form-label" <?php endif; ?>><?php if($required==1): ?> * <?php endif; ?> <?php echo app('translator')->get($label??''); ?></label>
    <?php if($has_row == true): ?> 
        <div class="col-md-10">
    <?php endif; ?>
    <input type="text" class="form-control" autocomplete="off" id="<?php echo e($name??''); ?>_input" placeholder="<?php echo app('translator')->get($placeholder??$label??$name??''); ?>">
    <?php if($has_row == true): ?> 
        </div> 
    <?php endif; ?>
    <div class="col-lg-3 col-md-2" style="position: absolute;padding-left: 0;right: 0;<?php if($has_row == true): ?> top: 0; <?php else: ?> top: 27px; <?php endif; ?>">
        <button type="button" class="btn btn-primary" data-tags_<?php echo e($name??''); ?> style="width: 100%;"><?php echo app('translator')->get('Translate::form.add_tags'); ?></button>
    </div>
    <div class="row">
        <?php if($has_row == true): ?>
        <label class="col-md-2"></label>
        <?php endif; ?>
        <div class="<?php if($has_row == true): ?> col-md-10 <?php else: ?> col-md-12 <?php endif; ?>">
            <div class="tags">
                <?php if(isset($value) && !empty($value)): ?>
                    <?php $__currentLoopData = $value; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="tags-item">
                            <input type="hidden" name="<?php echo e($name??''); ?>[]" value="<?php echo e($tag??''); ?>">
                            <div class="tags-item__text"><?php echo e($tag??''); ?></div>
                            <div class="tags-item__remove" data-delete_tags><i class="fa fa-trash"></i></div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<?php if($class_col != ''): ?>
    </div>
<?php endif; ?>
<script>
    $(document).ready(function() {
        
        $('body').on('click', '*[data-delete_tags]', function() {
            $(this).closest('.tags-item').remove();
        });
        
        <?php if(isset($auto_click) && $auto_click == 1): ?>
            auto_click = null;
            $('body').on('change keyup', '#<?php echo e($name??''); ?>_input', function() {
                e = $(this);
                value = $(this).val();
                clearTimeout(auto_click);
                if (!checkEmpty(value)) {
                    auto_click = setTimeout(function() {
                        e.closest('.form-group-tags').find('*[data-tags_<?php echo e($name??''); ?>]').click();
                    }, 2000);
                }
            });
        <?php endif; ?>
        
        $('body').on('click', '*[data-tags_<?php echo e($name??''); ?>]', function() {
            tag_value = $('#<?php echo e($name??''); ?>_input').val();
            if (!checkEmpty(tag_value)) {
                $(this).closest('.form-group-tags').find('.tags').append(`
                    <div class="tags-item">
                        <input type="hidden" name="<?php echo e($name??''); ?>[]" value="${tag_value}">
                        <div class="tags-item__text">${tag_value}</div>
                        <div class="tags-item__remove" data-delete_tags><i class="fa fa-trash"></i></div>
                    </div>
                `);
                $('#<?php echo e($name??''); ?>_input').css('border', '1px solid #ced4da').val('');
                $('#<?php echo e($name??''); ?>_input').parent().find('.error').remove();
                $('#<?php echo e($name??''); ?>_input').focus();
            }
        });
        
        <?php if($required==1): ?>
            $('body').on('click','button[type=submit]', function(e) {
                <?php echo e($name??''); ?>_array = [];
                $('input[name^=<?php echo e($name??''); ?>]').each(function(index, item) {
                    value = $(this).val();
                    <?php echo e($name??''); ?>_array.push(value);
                });
                $('#<?php echo e($name??''); ?>_input').css('border', '1px solid #ced4da');
                $('#<?php echo e($name??''); ?>_input').parent().find('.error').remove();
                if (checkEmpty(<?php echo e($name??''); ?>_array)) {
                    e.preventDefault();
                    $('#<?php echo e($name??''); ?>_input').parent().append(formHelper('<?php echo app('translator')->get($label??$placeholder??$name??''); ?> <?php echo app('translator')->get('Translate::form.valid.is_tags'); ?>'));
                    $('#<?php echo e($name??''); ?>_input').css('border', '1px solid #ff0000');
                }
            });
        <?php endif; ?>
    });
</script><?php /**PATH /var/home/packages/sudo-base/form/src/Providers/../../resources/views/base/tags.blade.php ENDPATH**/ ?>