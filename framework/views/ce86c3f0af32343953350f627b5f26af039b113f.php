<?php $__env->startSection('head'); ?>
    <style type="text/css">
        <?php
            /*echo file_get_contents(asset("./assets/build/css/post_mb.min.css?v=".config('SudoAsset.vesion')));*/
        ?>
    </style>

    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('./assets/build/css/post_mb.min.css?v='.config('SudoAsset.vesion'))); ?>">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <main id="post">
       <div class="container">
            <section class="post w-100">
                <div class="post-left">
                    <a class="fs-16 f-w-b color_main text-up" href="<?php echo e($category->getUrl('mobile') ?? 'javascript'); ?>"><?php echo e($category->name ?? ''); ?></a>
                    <div class="post-left__title mt-15">
                        <h1 class="post-title fs-28 lh-30 f-w-b"> <?php echo e($post->name ?? ''); ?></h1>
                        <?php if($personnels !== null): ?>
                            <a class="info-user" href="<?php echo e($personnels->getUrl('mobile')); ?>" aria-label=""> Tác giả :
                                <span class="f-w-b lh-16 text color_primary mt-10"><?php echo e($personnels->name ?? ''); ?></span>
                            </a>
                        <?php endif; ?>
                    </div>
                    <div class="post-left__content mt-30">
                        <div class="article-content">
                            <div class="ck ck-reset ck-editor ck-rounded-corners" role="application" dir="ltr">
                                <div class="ck-content ck_detail">
                                    <?php echo replaceCkeditor($post->detail ?? ''); ?>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
            </section>
        </div>
        <?php echo $__env->make('Default::mobile.layouts.blog',['posts'=>$related_posts, 'title'=>'Bài viết liên quan'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </main>
    <?php echo $__env->make('Default::mobile.layouts.popup_register', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('Default::mobile.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/home/themes/default/src/Providers/../../resources/views/mobile/post/show.blade.php ENDPATH**/ ?>