<?php $__env->startSection('head'); ?>
    <style type="text/css">
        <?php
            /*echo file_get_contents(asset("./assets/build/css/post.min.css?v=".config('SudoAsset.vesion')));*/
        ?>
    </style>
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('./assets/build/css/post.min.css?v='.config('SudoAsset.vesion'))); ?>">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <main id="category_post">
        <div class="container">
            <section class="post flex w-100">
                <div class="post-left">
                    <div class="post-left__title">
                        <h1 class="post-title fs-32 lh-36 f-w-b"> <?php echo $category->name  ?? $config_post['category_title'] ?? ''; ?></h1>
                    </div>
                    <div class="post-left__content mt-30">
                        <div class="post-list col-gird-6"  id="listdata">
                            <?php echo $__env->make('Default::web.post.listdata', ['posts' => $posts], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        </div>
                        <div class="mt-20">
                            <input type="hidden" name="current_url" value="<?php echo e($url ?? ''); ?>" aria-label="current_url" class="current_url" id="current_url">
                            <?php echo $posts->appends(Request()->all())->links('pagination::bootstrap-4'); ?>

                        </div>
                    </div>
                </div>
                <div class="post-right">
                    <div class="sidebar">
                        <div class="sidebar__category">
                            <p class="text text-up fs-16 lh-18 text-center w-100 fw-500">Danh mục</p>
                            <ul>
                                <?php if(isset($category->post_seo)): ?>
                                    <?php
                                        $post_seo = json_decode(base64_decode($category->post_seo));
                                    ?>
                                    <?php $__currentLoopData = $post_seo->name; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if(!empty($post_seo->link[$key])): ?>
                                            <li>
                                                <a href="<?php echo e($post_seo->link[$key]); ?>" aria-label="<?php echo e($item); ?>"><?php echo e($item); ?></a>
                                            </li>
                                        <?php else: ?>
                                            <li><?php echo e($item); ?></li>
                                        <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php else: ?>
                                    <?php if(isset($config_post['list_category']['name']) && count($config_post['list_category']['name']) > 0): ?>
                                        <?php $__currentLoopData = $config_post['list_category']['name']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <li>
                                                <a href="<?php echo e($config_post['list_category']['link'][$key]); ?>" aria-label="<?php echo e($name); ?>"><?php echo e($name); ?></a>
                                            </li>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>
                                <?php endif; ?>
                            </ul>
                        </div>
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
    </main>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('Default::web.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/home/themes/default/src/Providers/../../resources/views/web/post/index.blade.php ENDPATH**/ ?>