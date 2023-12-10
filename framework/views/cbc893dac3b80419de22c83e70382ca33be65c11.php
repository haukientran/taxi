<div class="row tab">
    <?php if($has_full == false): ?>
	<label for="tab" class="col-md-2 col-form-label"><?php echo $label; ?></label>
	<div class="col-lg-10">
    <?php endif; ?>
        <?php if(isset($list_tab) && is_array($list_tab)): ?>
		<ul class="tab-list">
            <?php $__currentLoopData = $list_tab; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			    <li class="tab-list__item <?php if($key == 0): ?> active <?php endif; ?>" data-active="<?php echo e($list_class[$key]??''); ?>"><?php echo $value??''; ?></li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		</ul>
        <?php endif; ?>
<script>
    $(document).ready(function(){
        var class_active = $('.tab-list__item.active').data('active');
        $('.tab .tab-content').removeClass('active');
        $('.tab .tab-content__'+class_active).addClass('active');
        
        $('.tab-list__item').on('click', function(){
            var class_active = $(this).data('active');
            $('.tab-list__item').removeClass('active');
            $(this).addClass('active');
            $('.tab .tab-content').removeClass('active');
            $('.tab .tab-content__'+class_active).addClass('active');
        });
    });
</script>
<?php /**PATH /var/home/packages/sudo-base/form/src/Providers/../../resources/views/base/tab.blade.php ENDPATH**/ ?>