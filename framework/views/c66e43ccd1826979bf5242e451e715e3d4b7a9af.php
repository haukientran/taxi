<?php $__env->startSection('head'); ?>
    <style type="text/css">
        <?php
            /*echo file_get_contents(asset("./assets/build/css/post.min.css?v=".config('SudoAsset.vesion')));*/
        ?>
    </style>
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('./assets/build/css/post.min.css?v='.config('SudoAsset.vesion'))); ?>">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <main id="post">
       <div class="container">
            <section class="post flex w-100">
                <div class="post-left">
                    <a class="fs-16 f-w-b color_main text-up" href="<?php echo e($category->getUrl() ?? 'javascript'); ?>"><?php echo e($category->name ?? ''); ?></a>
                    <div class="post-left__title mt-15">
                        <h1 class="post-title fs-32 lh-36 f-w-b"> <?php echo e($post->name ?? ''); ?></h1>
                        <?php if($personnels !== null): ?>
                            <a class="info-user" href="<?php echo e($personnels->getUrl()); ?>" aria-label=""> Tác giả :
                                <span class="f-w-b lh-16 text color_primary mt-10"><?php echo e($personnels->name ?? ''); ?></span>
                            </a>
                        <?php endif; ?>
                        <br>
                        <div class="fb-like" data-href="https://developers.facebook.com/docs/plugins/" data-width="" data-layout="" data-action="" data-size="" data-share="true"></div>
                    </div>
                    <div class="post-left__content mt-20">
                        <div class="article-content">
                            <div class="ck ck-reset ck-editor ck-rounded-corners" role="application" dir="ltr">
                                <div class="ck-content ck_detail">
                                    <?php echo replaceCkeditor($post->detail ?? ''); ?>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="post-right">
                    <div class="sidebar">
                        <?php if(isset($post->list_category) && count($post->list_category) > 0): ?>
                        <div class="sidebar__category">
                            <p class="text text-up fs-16 lh-18 text-center w-100 fw-500">Danh mục</p>
                            <?php if(isset($post->list_category)): ?>
                                <ul>
                                    <?php $__currentLoopData = $list_category->name; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if(!empty($list_category->link[$key])): ?>
                                            <li>
                                                <a href="<?php echo e($list_category->link[$key]); ?>" aria-label="<?php echo e($item); ?>"><?php echo e($item); ?></a>
                                            </li>
                                        <?php else: ?>
                                            <li><?php echo e($item); ?></li>
                                        <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                            <?php else: ?>
                                <ul>
                                    <?php $__currentLoopData = $list_category; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li>
                                            <a href="<?php echo e($item->getUrl()); ?>" aria-label="<?php echo e($item->name); ?>"><?php echo e($item->name); ?></a>
                                        </li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                            <?php endif; ?>
                        </div>
                        <?php endif; ?>
                        <div class="sidebar__blog">
                            <p class="text text-up fs-24 lh-26 w-100 color_main fw-600">Bài viết mới nhất</p>
                            <div class="blog-list">
                                <?php echo $__env->make('Default::web.layouts.blog_item', ['posts'=> $post_news], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <?php echo $__env->make('Default::web.layouts.blog',['posts'=>$related_posts, 'title'=>'Bài viết liên quan'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </main>
    <?php echo $__env->make('Default::web.layouts.popup_register', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('Default::web.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/home/themes/default/src/Providers/../../resources/views/web/post/show.blade.php ENDPATH**/ ?>