<?php if(isset($posts) && count($posts) > 0): ?>
<section id="blog">
    <h2 class="section-title blog-title w-100 text-center"><?php echo e($title ?? 'Tin tức sự kiện'); ?></h2>
    <div class="blog-box">
        <div class="container">
            <div class="blog-list col-gird-6 w-100">
                <?php echo $__env->make('Default::web.layouts.blog_item', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>
<?php /**PATH /var/home/themes/default/src/Providers/../../resources/views/web/layouts/blog.blade.php ENDPATH**/ ?>