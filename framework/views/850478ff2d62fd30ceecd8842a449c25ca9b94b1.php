

<?php if($class_col != ''): ?>
    <div class="<?php echo e($class_col); ?>">
<?php endif; ?>
<div class="mb-3 <?php if($has_row == true): ?> row <?php endif; ?>">
    <label for="<?php echo e($name??''); ?>" <?php if($has_row == true): ?> class="col-md-2 col-form-label" <?php endif; ?>><?php echo app('translator')->get($label??''); ?></label>
    <?php if($has_row == true): ?> 
        <div class="col-md-10">
    <?php endif; ?>
    <div class="form-check-info" style="max-height: 200px;overflow-y: scroll;">
        <input type="text" class="form-control" id="<?php echo e($name??''); ?>_search" placeholder="<?php echo app('translator')->get('Translate::form.search'); ?> <?php echo app('translator')->get($label??''); ?>">
        <button type="button" class="btn btn-info" id="<?php echo e($name??''); ?>_checkall" title="<?php echo app('translator')->get('Translate::form.check_all'); ?>"><i class="fa fa-check-double"></i></button>
        <div class="form-group-checkbox" id="<?php echo e($name??''); ?>" style="background: #f2f2f5;">
            <?php $__currentLoopData = $options; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="form-checkbox" style="clear: both;">
                    <input type="checkbox" class="form-check-input" name="<?php echo e($name??''); ?>[]" id="<?php echo e($name??''); ?>_<?php echo e($key??''); ?>" value="<?php echo e($key??''); ?>"
                        <?php if(isset($value) && !empty($value)): ?>
                            <?php $__currentLoopData = $value; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($v == $key): ?> checked <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                    style="margin-left: 0;margin-right: 10px;font-size: 20px;">
                    <label for="<?php echo e($name??''); ?>_<?php echo e($key??''); ?>" style="padding-top: 5px;"><?php echo app('translator')->get($option??''); ?></label>  
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div> 
    <?php if($has_row == true): ?> 
        </div> 
    <?php endif; ?>
</div>
<?php if($class_col != ''): ?>
    </div>
<?php endif; ?>
<style>
    #<?php echo e($name??''); ?>_search {
        width: calc(100% - 40px);
        float: left;
    }
    #<?php echo e($name??''); ?>_checkall {
        width: 40px;
        float: left;
    }
    </style>
<script>
    $(document).ready(function() {
        // Input tìm kiếm
        $('body').on('change keyup', '#<?php echo e($name??''); ?>_search', function(e) {
            e.preventDefault();
            search_value = $(this).val().toLowerCase();
            $('#<?php echo e($name??''); ?>').find('.form-checkbox').each(function() {
                text = $(this).find('label').text().toLowerCase();
                if(text.indexOf(search_value) != -1){
                    $(this).css('display', 'block');
                } else {
                    $(this).css('display', 'none');
                }
            });
        })
        // Chọn tất cả
        check_all = 0;
        $.each( $('#<?php echo e($name??''); ?> input[name^=<?php echo e($name??''); ?>]'), function() {
            if ($(this).prop('checked') == true) {
                check_all = 1;
            }
        });
        $('body').on('click', '#<?php echo e($name??''); ?>_checkall', function(e) {
            e.preventDefault();
            if (check_all == 0) {
                $('#<?php echo e($name??''); ?> input[name^=<?php echo e($name??''); ?>]').prop('checked', true);
                check_all = 1;
            } else {
                $('#<?php echo e($name??''); ?> input[name^=<?php echo e($name??''); ?>]').prop('checked', false);
                check_all = 0;
            }
        });
        // Nếu bắt buộc
        <?php if($required==1): ?>
            $('body').on('change', 'input[name^=<?php echo e($name??''); ?>]', function() {
                $('#<?php echo e($name??''); ?>').parent().find('.error').remove();
                $('#<?php echo e($name??''); ?>').css('border', '1px solid #f2f2f5');
            });
            $('body').on('click','button[type=submit]', function(e) {
                <?php echo e($name??''); ?>_array = [];
                $('input[name^=<?php echo e($name??''); ?>]:checked').each(function(index, item) {
                    value = $(this).val();
                    <?php echo e($name??''); ?>_array.push(value);
                });
                $('#<?php echo e($name??''); ?>').parent().find('.error').remove();
                $('#<?php echo e($name??''); ?>').css('border', '1px solid #f2f2f5');
                if (checkEmpty(<?php echo e($name??''); ?>_array)) {
                    e.preventDefault();
                    $('#<?php echo e($name??''); ?>').parent().append(formHelper('<?php echo app('translator')->get($label??$placeholder??$name??''); ?> <?php echo app('translator')->get('Translate::form.valid.is_select'); ?>'));
                    $('#<?php echo e($name??''); ?>').css('border', '1px solid #ff0000');
                }
            });
        <?php endif; ?>
    });
</script><?php /**PATH /var/home/packages/sudo-base/form/src/Providers/../../resources/views/base/multiCheckbox.blade.php ENDPATH**/ ?>