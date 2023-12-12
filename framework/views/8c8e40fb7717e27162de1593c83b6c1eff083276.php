<?php $__env->startSection('head'); ?>
    <style type="text/css">
        <?php
            /*echo file_get_contents(asset("./assets/build/css/home_mb.min.css?v=".config('SudoAsset.vesion')));*/
            /*echo file_get_contents(asset("/admin_assets/libs/fancybox/jquery.fancybox.min.css"));*/
        ?>
    </style>

    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('/assets/build/css/home_mb.min.css?v='.config('SudoAsset.vesion'))); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('/admin_assets/libs/fancybox/jquery.fancybox.min.css')); ?>">
    <?php if(isset($slides) && count($slides) > 0): ?>
        <?php $__currentLoopData = $slides; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $slide): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <link rel="preload" as="image" href="<?php echo e(resizeWImage($slide->image, 'w600')); ?>">
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php endif; ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<main id="main">
    <input type="hidden" name="current_url" value="/" class="current_url">
    <?php echo $__env->make('Default::mobile.layouts.banner', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <section id="reason">
        <div class="container">
           <div class="reason-box">
                <div class="reason-left">
                    <h1 class="section-title reason-title"><?php echo e(isset($setting_home['reason_title']) ? $setting_home['reason_title'] : ''); ?></h1>
                    <div class="reason-content"><?php echo e(isset($setting_home['reason_description']) ? $setting_home['reason_description'] : ''); ?></div>
                    <a href="<?php echo e(isset($setting_home['reason_link']) ? $setting_home['reason_link'] : ''); ?>" class="btn btn-primary reason-btn" aria-label="Xem chi tiết" title="Xem chi tiết">Xem chi tiết</a>
                </div>
            </div>
        </div>
    </section>
    <?php echo $__env->make('Default::mobile.layouts.should-choose_home', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('Default::mobile.layouts.register', ['title' => isset($setting_home['register_title']) ? $setting_home['register_title'] : 'ĐĂNG KÝ TƯ VẤN MIỄN PHÍ'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
     <section id="table_price" class="w-100 mt-20">
        <div class="container">
            <div class="table_price col-gird-12 w-100">
                <div class="table_price-left css-content">
                    <?php echo ($setting_home['table_price'] ?? ''); ?>

                    <a href="tel:<?php echo e($config_general['hotline_support'] ?? ''); ?>" class="btn btn-primary btn-book color_white mt-10 lh-40 text-up fs-16 f-w-b" aria-label="Đặt xe" title="Đặt xe">Đặt xe: <?php echo e($config_general['hotline_support'] ?? ''); ?></a>
                </div>
                <div class="table_price-right mt-20">
                    <?php echo $__env->make('Default::general.components.image', [
                        'src' => resizeWImage( $setting_home['table_price_banner']  ?? '', 'w600'),
                        'width' => '585',
                        'height' => '325',
                        'lazy'   => true,
                        'title'  =>  getAlt($setting_home['table_price_banner']  ?? '')
                    ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </div>
            </div>
        </div>
    </section>

    <section id="service_price" class="service_price">
        <div class="container">
            <div class="service_price__introduce css-content">
                <?php echo ($setting_home['introduce_service'] ?? ''); ?>

            </div>
            <?php if(isset($setting_home['service_price']['title']) && count($setting_home['service_price']['title']) > 0): ?>
            <div class="service_price__list col-gird-12 w-100">
                <?php $__currentLoopData = $setting_home['service_price']['title']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $title): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="item mt-20">
                    <div class="item-thumbnail">
                        <?php echo $__env->make('Default::general.components.image', [
                            'src' => resizeWImage(isset($setting_home['service_price']['image'][$k]) ? $setting_home['service_price']['image'][$k] : '' , 'w500'),
                            'width' => '500',
                            'height' => '300',
                            "lazy"   => true,
                        ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                    <div class="item-detail text-center">
                        <div class="item-content fs-20 f-w-b text-up mb-30"><?php echo e($title ?? ''); ?></div>
                        <div class="item-description mt-10 f-w-b fs-16"><?php echo e(isset($setting_home['service_price']['description_price1'][$k]) ? $setting_home['service_price']['description_price1'][$k] : ''); ?></div>
                        <div class="item-description mt-10 f-w-b fs-16 mb-20"><?php echo e(isset($setting_home['service_price']['description_price2'][$k]) ? $setting_home['service_price']['description_price2'][$k] : ''); ?></div>
                        <a href="tel:<?php echo e($config_general['hotline_support'] ?? ''); ?>" class="btn btn-primary contidion-btn mt-10 w-100 lh-50 text-up fs-16 f-w-b" aria-label="Xem chi tiết" title="Xem chi tiết">Đặt xe</a>
                    </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
            <?php endif; ?>
        </div>
    </section>

    <?php if(isset($arboards) && count($arboards) > 0): ?>
    <section id="nation">
        <div class="container">
            <h2 class="section-title nation-title"><?php echo e(isset($setting_home['country_home_title']) ? $setting_home['country_home_title'] : 'Quốc gia du học'); ?> </h2>
            <div class="nation-list flex">
                <?php echo $__env->make('Default::mobile.layouts.nation_list', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>
            <?php if(count($arboards) >= 6): ?>
                <div class="flex-center w-100">
                    <a href="javascript:;" class="see-more nation-see-more" aria-label="Xem tiếp" title="Xem tiếp">Xem tiếp</a>
                </div>
            <?php endif; ?>
        </div>
    </section>
    <?php endif; ?>
    <?php if(isset($setting_home['contidion']['title']) && count($setting_home['contidion']['title']) > 0): ?>
    <section id="contidion">
        <h2 class="section-title contidion-title"><?php echo e(isset($setting_home['contidion_title']) ? $setting_home['contidion_title'] : 'Điều kiện tham gia chương trình'); ?></h2>
        <div class="contidion-list s-wrap" id="contidion-list">
	        <div class="s-content">
	            <?php $__currentLoopData = $setting_home['contidion']['title']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $condition): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
	            <div class="contidion-item item" data-thumnail="">
	                <div class="contidion-item__thumbnail">
                        <?php echo $__env->make('Default::general.components.image', [
                            'src' => resizeWImage(isset($setting_home['contidion']['image'][$k]) ? $setting_home['contidion']['image'][$k] : '' , 'w300'),
                            'width' => '300',
                            'height' => '300',
                            "lazy"   => true,
                            'title'  =>  'khoa-hoc-ke-toan-tong-hop-1'
                        ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
	                </div>
	                <div class="contidion-item__content"><?php echo e($condition ?? ''); ?></div>
                    <a href="<?php echo e(isset($setting_home['contidion']['link'][$k]) ? $setting_home['contidion']['link'][$k] : ''); ?>" class="btn btn-primary contidion-btn" aria-label="Xem chi tiết" title="Xem chi tiết">Xem chi tiết</a>
	            </div>
	            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
	        </div>
        </div>
    </section>
    <?php endif; ?>
    <?php echo $__env->make('Default::mobile.layouts.service_grid3', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('Default::mobile.layouts.feedback_home', ['title' => isset($setting_home['feedback_title']) ? $setting_home['feedback_title'] : 'Chia sẻ từ học viên Lê Ánh'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('Default::mobile.layouts.list_image_home',['title'=> isset($setting_home['activity_title']) ? $setting_home['activity_title'] : 'Hoạt động tại Lê ánh' ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('Default::mobile.layouts.evaluate', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('Default::mobile.layouts.blog',['posts'=>$posts, 'title'=> isset($setting_home['news_title']) ? $setting_home['news_title'] : 'Tin tức nổi bật'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php if(isset($setting_home['partner']['image']) && count($setting_home['partner']['image']) > 0): ?>
    <section class="partner" id="partner">
        <div class="container">
            <h2 class="section-title partner-title">Truyền hình báo chí nói gì về chúng tôi</h2>
            <div class="partner-list">
                <?php $__currentLoopData = $setting_home['partner']['image']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $partner): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($setting_home['partner']['link'][$k] !== null): ?>
                        <a href="<?php echo e($setting_home['partner']['link'][$k] ?? ''); ?>" target="_blank" aria-label="đối tác_<?php echo $k ?? 0; ?>" rel="<?php echo e($setting_home['partner']['follow'][$k] ?? ''); ?>">
                            <?php echo $__env->make('Default::general.components.image', [
                                'src' => resizeWImage($partner ?? '', 'w200'),
                                'width' => '200px',
                                'height' => '110px',
                                'lazy'   => true,
                                'title'  =>  getAlt($partner ?? '')
                            ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        </a>
                    <?php else: ?>
                        <?php echo $__env->make('Default::general.components.image', [
                            'src' => resizeWImage($partner ?? '', 'w200'),
                            'width' => '200px',
                            'height' => '110px',
                            'lazy'   => true,
                            'title'  =>  getAlt($partner ?? '')
                        ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </section>
    <?php endif; ?>
    <?php echo $__env->make('Default::mobile.layouts.should-choose-grid2', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</main>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('foot'); ?>
    <script defer src="/admin_assets/libs/fancybox/jquery.fancybox.min.js"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('Default::mobile.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/home/themes/default/src/Providers/../../resources/views/mobile/home.blade.php ENDPATH**/ ?>