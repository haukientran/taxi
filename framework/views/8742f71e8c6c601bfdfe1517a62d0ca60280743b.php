
<?php
    $seo_prefix_url = config('app.seo_prefix_url')[$table_name] ?? [];
    $seo_html = $seo_prefix_url['html'] ?? false;
?>
<?php if($class_col != ''): ?>
    <div class="<?php echo e($class_col); ?>">
<?php endif; ?>
    <div class="mb-3 <?php if($has_row == true): ?> row <?php endif; ?>" style="position: relative;">
        <label for="<?php echo e($name??''); ?>" <?php if($has_row == true): ?> class="col-md-2 col-form-label" <?php endif; ?> style="margin-bottom: 0;"><?php if($required==1): ?> * <?php endif; ?> <?php echo app('translator')->get($label??''); ?></label>
        <?php if($has_row == true): ?> 
            <div class="col-md-10">
        <?php endif; ?>
        <input type="hidden" class="form-control" autocomplete="off" name="<?php echo e($name??''); ?>" id="<?php echo e($name??''); ?>" value="<?php echo e(old($name)??$value??''); ?>">
        <div class="slug">
            <div class="slug-content">
                <?php echo $seo_prefix_url['url'] ?? config('app.url') ?? ''; ?>/<span><?php echo e(old($name)??$value??''); ?></span>
            </div>
            <?php if($seo_html): ?><span>.html</span><?php endif; ?>
            <div class="action">
                <a href="javascript:;" title="" class="edit">Edit</a>
                <a href="javascript:;" title="" class="ok">Ok</a>
                <a href="javascript:;" title="" class="cancel">Cancel</a>
            </div>
        </div>
        <?php if($has_row == true): ?> 
            </div> 
        <?php endif; ?>
    </div>

<?php if($class_col != ''): ?>
    </div>
<?php endif; ?>
<?php if($has_row != true): ?>
<style>
    img.form-loading{
        top: 25px;
    }
</style>
<?php endif; ?>
<style>
    .slug {
        float: none;
        display: flex;
        align-items: center;
    }
</style>
<script>
    $(document).ready(function() {
        text_error = '<?php echo app('translator')->get($label??$placeholder??$name??''); ?> <?php echo app('translator')->get('Translate::form.valid.is_unique'); ?>';
        var get_slug = 1;
        $('body').on('click', '.slug .edit', function(){
            var slug = $('#<?php echo e($name??''); ?>').val();
            $('.slug-content span').html('<input type="text" class="edit-slug" value="'+slug+'">');
            $(this).hide();
            $('.slug .ok').show();
            $('.slug .cancel').show();
        });
        $('body').on('click', '.slug .ok', function(){
            var slug = $('body .slug-content .edit-slug').val();
            $('#<?php echo e($name??''); ?>').val(convertToSlug(slug));
            $('.slug-content span').html(convertToSlug(slug));
            $('.slug .edit').show();
            $('.slug .ok').hide();
            $('.slug .cancel').hide();
            get_slug = 0;
        });
        $('body').on('click', '.slug .cancel', function(){
            var slug = $('#<?php echo e($name??''); ?>').val();
            $('.slug-content span').html(convertToSlug(slug));
            $('.slug .edit').show();
            $('.slug .ok').hide();
            $('.slug .cancel').hide();
        });
        
        <?php if($required==1): ?>
            validateInput('#<?php echo e($name??''); ?>', '<?php echo app('translator')->get($label??$placeholder??$name??''); ?> <?php echo app('translator')->get('Translate::form.valid.no_empty'); ?>');
        <?php endif; ?>
        
        <?php if(isset($extends) && !empty($extends)): ?>
            $('body').on('keyup change', '#<?php echo e($extends??''); ?>', function() {
                if(get_slug == 1){
                    value = $(this).val();
                    $('#<?php echo e($name??''); ?>').val(convertToSlug(value));
                    $('.slug-content span').html(convertToSlug(value));
                    $('#<?php echo e($name??''); ?>').change();
                }
            });
        <?php endif; ?>
        
        
        <?php if(isset($unique) && $unique == 'true'): ?>
            $check = null;
            $is_unique = true; // true: không trùng | false: bị trùng
            // nếu input có thay đổi
            $('body').on('keyup change', '#<?php echo e($name??''); ?>', function() {
                // giá trị slug
                $value = $('#<?php echo e($name??''); ?>').val();
                // Tên bảng
                $table = '<?php echo e($table??$table_name??''); ?>';
                // xóa setTimeout $check
                clearTimeout($check);
                // Nếu xác định được giá trị và bảng
                if (!checkEmpty($value) && !checkEmpty($table)) {
                    // lấy sau keyup 1 giây
                    $check = setTimeout(function() {
                        // chuẩn hóa dữ liệu form
                        data = {
                            table: $table,
                            slug: $value,
                        };
                        // load ajax check tồn tại slug
                        loadAjaxPost('<?php echo e(route('admin.ajax.check_slug')); ?>', data, {
                            beforeSend: function(){
                                $('#<?php echo e($name??''); ?>').parent().find('.form-loading').remove();
                                $('#<?php echo e($name??''); ?>').parent().append(formLoading('loading'));
                            },
                            success:function(result){
                                if (result == 'false') {
                                    $('#<?php echo e($name??''); ?>').parent().find('.form-loading').remove();
                                    $('#<?php echo e($name??''); ?>').parent().append(formLoading('error'));
                                    $is_unique = false;
                                } else {
                                    $('#<?php echo e($name??''); ?>').parent().find('.form-loading').remove();
                                    $('#<?php echo e($name??''); ?>').parent().append(formLoading('success'));
                                    $is_unique = true;
                                }
                                validateSlug($is_unique, '#<?php echo e($name??''); ?>', text_error);
                            },
                            error: function (error) {
                                $('#<?php echo e($name??''); ?>').parent().find('.form-loading').remove();
                                $('#<?php echo e($name??''); ?>').parent().append(formLoading('error'));
                            }
                        }, 'custom');
                    }, 1000);
                }
            });
            $('body').on('click','button[type=submit]', function(e) {
                if ($is_unique == false) {
                    e.preventDefault();
                    $('#<?php echo e($name??''); ?>').parent().append(formHelper(text_error));
                    $('#<?php echo e($name??''); ?>').css('border', '1px solid #ff0000');
                }
            });
        <?php endif; ?>
    });
</script><?php /**PATH /var/home/packages/sudo-base/form/src/Providers/../../resources/views/base/slug.blade.php ENDPATH**/ ?>