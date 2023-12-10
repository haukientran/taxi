

<?php
$storage_size_link = env('STORAGE_SIZE_LINK');
$storage_size = env('STORAGE_SIZE');
// Lấy dung lượng lưu trữ hiện tại tính theo byte
if($storage_size_link != '' && $storage_size != ''){
    $content = file_get_contents($storage_size_link);
    $content = json_decode($content, 1);
    $current_size = $content['bytes'];
    $current_size = round($current_size / 1073741824, 1);
}
?>

<?php if($class_col != ''): ?>
    <div class="<?php echo e($class_col); ?>">
<?php endif; ?>
    <div class="mb-3 <?php if($has_row == true): ?> row <?php endif; ?>">
        <label for="<?php echo e($name??''); ?>" <?php if($has_row == true): ?> class="col-md-2 col-form-label" <?php endif; ?>><?php if($required==1): ?> * <?php endif; ?> <?php echo app('translator')->get($label??''); ?></label>
        <?php if($has_row == true): ?> 
            <div class="col-md-10">
        <?php endif; ?>
            <?php if(isset($current_size) && $current_size > $storage_size * 0.9): ?> 
                <div class="message-full-storage-<?php echo e($name??''); ?>" style="font-size: 13px;color: red;padding-bottom: 5px;">Dung lượng lưu trữ ảnh hiện tại của quý khách sắp đầy ( <?php echo $current_size; ?> GB / <?php echo $storage_size; ?> GB). Vui lòng xóa bớt dữ liệu hoặc <a target="_blank" style="color: #428bca;" href="https://sudo.vn">nâng cấp</a> ngay</div>
            <?php endif; ?>
            <div class="image-box" id="image-box-<?php echo e($name??''); ?>" <?php if($value == ''): ?> style="display: none;" <?php endif; ?>>
                <button type="button" class="btn btn-primary btn-sm image-box__btn" 
                    data-image="<?php echo e(route('media.index', [
                        'uploads' => 'single',
                        'field_id' => $name??'',
                        'only' => 'image'
                    ])); ?>"
                ><?php echo __('Translate::form.image.change'); ?></button>
                <p class="image-box__remove" data-delete_noremove><?php echo __('Translate::form.image.remove'); ?></p>
                <div class="image-box__content" id="<?php echo e($name??''); ?>_box">
                    <?php
                        $value = old($name)??$value;
                    ?>
                    <div class="item" data-delete_box
                        data-image="<?php echo e(route('media.index', [
                            'uploads' => 'single',
                            'field_id' => $name??'',
                            'only' => 'image'
                        ])); ?>"
                    >
                        <img src="<?php echo e(getImage($value??'')); ?>" alt="">
                        <input type="hidden" value="<?php echo e($value??''); ?>" name="<?php echo e($name??''); ?>">
                    </div>
                </div>
            </div>
            <div class="dropzone dz-clickable" id="<?php echo e(str_replace(['_'], '', $name??'')); ?>UploadForm" data-image="<?php echo e(route('media.index', [
                        'uploads' => 'single',
                        'field_id' => $name??'',
                        'only' => 'image'
                    ])); ?>" style="min-height: auto;<?php if($value != ''): ?> display: none; <?php endif; ?>">
                <div class="dz-message needsclick" style="margin: 0;">
                    <div class="mb-3">
                        <i class="display-4 text-muted bx bxs-cloud-upload"></i>
                    </div>
                    <h4><?php echo __('Translate::form.image.drag_and_drop'); ?></h4>
                </div>
            </div>
            <p class="help-text" style="padding-top: 5px;font-size: 12px;"><?php echo $helper_text??''; ?></p>
        <?php if($has_row == true): ?> 
            </div> 
        <?php endif; ?>
    </div>

<?php if($class_col != ''): ?>
    </div>
<?php endif; ?>
<div class="modal" id="modal-message-full-storage">
    <div class="modal-content" style="width: 500px;">
        <div class="modal-close"></div>
        <div class="">
            <div class="message" style="text-align: center;padding: 20px;"></div>
        </div>
    </div>
</div>
<script>
    Dropzone.options.<?php echo e(str_replace(['_', '-'], '', $name??'')); ?>UploadForm = {
        //http://www.dropzonejs.com/#configuration-options
        url:'/admin/media',
        paramName: "files",
        clickable: false,
        maxFilesize: 2, // MB
        uploadMultiple: false,
        parallelUploads: 100, //số file xử lý song song trên 1 request
        maxFiles: 5, //Tối đa 5 file 1 lần
        acceptedFiles: '.jpeg,.jpg,.png,.gif,.svg',
        //autoProcessQueue: false,
        accept: function(file, done) {
            done();
        },
        error: function(file, response) {
            console.log('Up-Error: '+response);
        },
        processing: function (file) {
            var imgLoading = Dropzone.createElement('<img class="img-loading" style="position:absolute;top:-20px;left:calc(50% - 8px);z-index:10;" src="/admin_assets/images/loading.gif" />');
            file.previewElement.append(imgLoading);
            $('#image-box-<?php echo e($name??''); ?>').parents('.mb-3').find('.dropzone .dz-message').hide();
            $('.message-full-storage-<?php echo e($name??''); ?>').hide();
        },
        success: function(file,response) {
            if(response.status == -1){
                $('.img-loading').remove();
                $('#image-box-<?php echo e($name??''); ?>').hide();
                $('#image-box-<?php echo e($name??''); ?>').find('input').val('');
                $('#image-box-<?php echo e($name??''); ?>').parents('.mb-3').find('.dropzone').show();
                $('#image-box-<?php echo e($name??''); ?>').parents('.mb-3').find('.dropzone .dz-preview').remove();
                $('#image-box-<?php echo e($name??''); ?>').parents('.mb-3').find('.dropzone .dz-message').show();
                $('.message-full-storage-<?php echo e($name??''); ?>').html(response.message);
                $('.message-full-storage-<?php echo e($name??''); ?>').show();
                return false;
            }
            $('.img-loading').remove();
            console.log('Up-Success:');
            console.log(response);
            $('#image-box-<?php echo e($name??''); ?>').find('img').attr('src', response.link);
            $('#image-box-<?php echo e($name??''); ?>').find('input').val(response.link);
            $('#image-box-<?php echo e($name??''); ?>').show();
            $('#image-box-<?php echo e($name??''); ?>').parents('.mb-3').find('.dropzone').hide();
            $('#image-box-<?php echo e($name??''); ?>').parents('.mb-3').find('.dropzone .dz-message').show();
            $('#image-box-<?php echo e($name??''); ?>').parents('.mb-3').find('.dropzone .dz-preview').remove();
        }
    };
</script>
<script>
    $(document).ready(function() {
        
        $('body').on('click', '*[data-delete_noremove]', function() {
            $(this).parents('#image-box-<?php echo e($name??''); ?>').hide();
            $(this).parents('#image-box-<?php echo e($name??''); ?>').find('input').val('');
            $(this).parents('.mb-3').find('.dropzone').show();
        });
        
        <?php if($required==1): ?>
            $('body').on('click','button[type=submit]', function(e) {
                if($('input[name=<?php echo e($name??''); ?>]').length == 0) {
                    e.preventDefault();
                    $('#<?php echo e($name??''); ?>_box').find('.error').remove();
                    $('#<?php echo e($name??''); ?>_box').append(formHelper('<?php echo app('translator')->get($label??$placeholder??$name??''); ?> <?php echo app('translator')->get('Translate::form.valid.no_empty'); ?>'));
                }
            });
        <?php endif; ?>
    });
</script><?php /**PATH /var/home/packages/sudo-base/form/src/Providers/../../resources/views/base/image.blade.php ENDPATH**/ ?>