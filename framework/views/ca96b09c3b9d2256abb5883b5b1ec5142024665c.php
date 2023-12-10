<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">
                <?php if(View::hasSection('title')): ?>
                    <?php echo $__env->yieldContent('title'); ?>
                <?php else: ?>
                    <?php echo e(__($module_name??'')); ?>

                <?php endif; ?>
            </h4>
            <?php if(isset($breadcrumbs) && count($breadcrumbs) > 0): ?>
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="<?php echo e(route('admin.home')); ?>"><?php echo app('translator')->get('Core::admin.homepage'); ?></a></li>
                    <?php $__currentLoopData = $breadcrumbs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $breadcrumb): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if(isset($breadcrumb['url']) && !empty($breadcrumb['url'])): ?>
                            <li class="breadcrumb-item"><a href="<?php echo e($breadcrumb['url']??''); ?>"><?php echo e(__($breadcrumb['name']??'')); ?></a></li>
                        <?php else: ?>
                            <li class="breadcrumb-item"><?php echo app('translator')->get($breadcrumb['name']??''); ?></li>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ol>
            </div>
            <?php endif; ?>
        </div>
    </div>
</div>
<!-- end page title --><?php /**PATH /var/home/packages/sudo-base/base/src/Providers/../../resources/views/layouts/base/content_header.blade.php ENDPATH**/ ?>