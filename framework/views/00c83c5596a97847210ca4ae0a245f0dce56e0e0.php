<?php
?>
<footer>
        <div class="footer-center w-100">
            <div class="container">
            <div class="footer-top-logo footer-item">
                <a href="<?php echo e(route('app.home')); ?>" aria-label="logo footer">
                    <?php echo $__env->make('Default::general.components.image', [
                        'src' =>  resizeWImage($config_general['logo_footer_desktop'] ?? '/assets/images/logo.png','w200'),
                        'width' => '200px',
                        'height' => '110px',
                        'lazy'   => true,
                        'title'  => 'logo'
                    ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </a>
            </div>
                <div class="footer-item">
                    <div class="footer-item__title f-w-b fs-18 lh-35"><?php echo e($config_general['company_name'] ?? 'Về chúng tôi'); ?></div>
                    <p class="footer-item__text flex-center-left">
                        <svg width="25" height="24" viewBox="0 0 25 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12.9458 2C9.08985 2 5.97119 5.13 5.97119 9C5.97119 14.25 12.9458 22 12.9458 22C12.9458 22 19.9205 14.25 19.9205 9C19.9205 5.13 16.8018 2 12.9458 2ZM12.9458 11.5C12.2852 11.5 11.6516 11.2366 11.1845 10.7678C10.7173 10.2989 10.4549 9.66304 10.4549 9C10.4549 8.33696 10.7173 7.70107 11.1845 7.23223C11.6516 6.76339 12.2852 6.5 12.9458 6.5C13.6065 6.5 14.24 6.76339 14.7072 7.23223C15.1743 7.70107 15.4368 8.33696 15.4368 9C15.4368 9.66304 15.1743 10.2989 14.7072 10.7678C14.24 11.2366 13.6065 11.5 12.9458 11.5Z" fill="#fff"/>
                        </svg>
                        <span class="color_white">
                            <?php echo $config_general['address'] ?? ''; ?>

                        </span>
                    </p>
                    <p class="footer-item__text color_white flex-center-left">
                        <svg width="31" height="31" viewBox="0 0 31 31" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M8.11571 7.33453L9.02942 6.67486C9.88736 6.05651 11.0684 6.2192 11.7921 7.05357L13.2305 8.71687C13.8568 9.44108 13.9806 10.4932 13.5341 11.318L12.293 13.6133C12.7342 14.6008 13.4033 15.4961 14.2984 16.2998C15.1544 17.0808 16.1579 17.6814 17.2494 18.066L19.1712 16.6402C19.9006 16.1006 20.8923 16.1252 21.6319 16.701L23.3576 18.0414C24.2187 18.7111 24.4981 19.9302 24.0109 20.8944L23.4886 21.928C22.9688 22.9566 21.9582 23.5984 20.836 23.6111C18.1862 23.6424 15.2506 22.1277 12.0283 19.0673C8.80133 16.0021 7.06432 13.0735 6.81948 10.2849C6.71618 9.11155 7.20865 7.98887 8.11571 7.33453Z" fill="#fff"/>
                        </svg>
                        <a class="color_white" href="tel:<?php echo e($config_general['hotline_support'] ?? ''); ?>" rel= "nofollow" title="<?php echo e($config_general['hotline_support'] ?? ''); ?>" aria-label="Hotline">
                             <?php echo $config_general['hotline_support'] ?? ''; ?>

                        </a>
                    </p>
                    <p class="footer-item__text flex-center-left">
                        <svg width="20" height="19" viewBox="0 0 20 19" fill="none" xmlns="http://www.w3.org/2000/svg" class="mt-6">
                            <g clip-path="url(#clip0_216_354)">
                            <path d="M19.2338 14.25V6.10711C19.2338 6.10711 11.0303 11.8523 10.2325 12.1505C9.44817 11.8659 1.2041 6.10711 1.2041 6.10711V14.25C1.2041 15.3809 1.44299 15.6071 2.55633 15.6071H17.8815C19.0215 15.6071 19.2338 15.4085 19.2338 14.25ZM19.2207 4.51066C19.2207 3.68687 18.9814 3.39282 17.8815 3.39282H2.55633C1.42497 3.39282 1.2041 3.74568 1.2041 4.56901L1.21762 4.69568C1.21762 4.69568 9.36208 10.3233 10.2325 10.6309C11.152 10.2735 19.2338 4.56901 19.2338 4.56901L19.2207 4.51066Z" fill="#fff"/>
                            </g>
                            <defs>
                            <clipPath id="clip0_216_354">
                            <rect width="18.9312" height="19" fill="white" transform="translate(0.978027)"/>
                            </clipPath>
                            </defs>
                        </svg>
                        <a class="color_white" href="mailto:<?php echo e($config_general['email'] ?? 'ewh-info@eurowindow-holding.com'); ?>" rel= "nofollow" title="<?php echo e($config_general['email'] ?? 'ewh-info@eurowindow-holding.com'); ?>" aria-label="email">
                            <?php echo $config_general['email'] ?? ''; ?>

                       </a>
                    </p>
                </div>

                <div class="footer-item">
                    <?php
                        $count_social_item_link = count($config_general['social']['social_item_link'] ?? []);
                    ?>
                    <div class="footer-item__group">
                        <div class="footer-item__title lh-35 fs-18 f-w-b text-up"><?php echo e(isset($config_general['about_title']) ? $config_general['about_title'] : 'Về chúng tôi'); ?></div>
                        <div class="footer-item__description">
                            <?php echo e(isset($config_general['about_description']) ? $config_general['about_description'] : ''); ?>

                        </div>
                        <div class="footer-item__icon">
                            <?php if(isset($config_general['social']['social_item_link']) && count($config_general['social']['social_item_link']) > 0): ?>
                                <?php $__currentLoopData = $config_general['social']['social_item_link']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $link): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="icon-item">
                                    <a target="_blank" class="block" href="<?php echo e($link ?? '#'); ?>" aria-label="<?php echo e($config_general['social']['social_item_title'][$k] ?? ''); ?>" rel="nofollow">
                                        <?php echo $__env->make('Default::general.components.image', [
                                            'src' =>  getImage($config_general['social']['social_item_image'][$k] ?? ''),
                                            'width' => '50px',
                                            'height' => '50px',
                                            "lazy"   => true,
                                            "title" =>''
                                        ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                    </a>
                                </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <div class="footer-bottom">
        <div class="container footer-bottom-container">
            <div class="footer-bottom-copyright text-center"><?php echo e($config_general['copy_right'] ?? ''); ?></div>
        </div>
    </div>
    <?php if(isset($config_general['contact']['contact_link']) && count($config_general['contact']['contact_link']) > 0): ?>)
    <div class="contact">
        <?php $__currentLoopData = $config_general['contact']['contact_link']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $link): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <a href="<?php echo e($link ?? ''); ?>" class="contact-item" type="button">
            <img class="contact-item__thumbnail" src="<?php echo e($config_general['contact']['contact_image'][$key] ?? ''); ?>">
        </a>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
    <?php endif; ?>
</footer>
<?php /**PATH /var/home/themes/default/src/Providers/../../resources/views/web/layouts/footer.blade.php ENDPATH**/ ?>