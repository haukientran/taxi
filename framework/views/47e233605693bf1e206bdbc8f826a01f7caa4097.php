<?php if(isset($config_general['customer_reviews']['image']) && count($config_general['customer_reviews']['image']) > 0): ?>
<section id="evaluate" style="background :<?php echo e(isset($config_general['color_backgroud']) ? $config_general['color_backgroud'] : '#363636'); ?>">
    <div class="evaluate-container">

        <h2 class="section-title evaluate-title"><?php echo $title ?? ($config_general['reviews_title'] ?? ''); ?></h2>
        <div class="evaluate-list s-wrap" id="evaluate-slide">
            <div class="evaluate-box">
                <div class="s-content">
                    <?php $__currentLoopData = $config_general['customer_reviews']['image']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="evaluate-item"  data-thumnail="">
                            <div class="evaluate-item__icon">
                                <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512">
                                    <path d="M464 32H336c-26.5 0-48 21.5-48 48v128c0 26.5 21.5 48 48 48h80v64c0 35.3-28.7 64-64 64h-8c-13.3 0-24 10.7-24 24v48c0 13.3 10.7 24 24 24h8c88.4 0 160-71.6 160-160V80c0-26.5-21.5-48-48-48zm-288 0H48C21.5 32 0 53.5 0 80v128c0 26.5 21.5 48 48 48h80v64c0 35.3-28.7 64-64 64h-8c-13.3 0-24 10.7-24 24v48c0 13.3 10.7 24 24 24h8c88.4 0 160-71.6 160-160V80c0-26.5-21.5-48-48-48z"/>
                                </svg>
                            </div>
                            <div class="evaluate-item__content">
                                <?php echo $config_general['customer_reviews']['des'][$key] ?? ''; ?>

                            </div>
                            <div class="evaluate-item__rate">
                                <svg class="rate-item" height="1em" viewBox="0 0 576 512">
                                    <path d="M259.3 17.8L194 150.2 47.9 171.5c-26.2 3.8-36.7 36.1-17.7 54.6l105.7 103-25 145.5c-4.5 26.3 23.2 46 46.4 33.7L288 439.6l130.7 68.7c23.2 12.2 50.9-7.4 46.4-33.7l-25-145.5 105.7-103c19-18.5 8.5-50.8-17.7-54.6L382 150.2 316.7 17.8c-11.7-23.6-45.6-23.9-57.4 0z"/>
                                </svg>
                                <svg class="rate-item" height="1em" viewBox="0 0 576 512">
                                    <path d="M259.3 17.8L194 150.2 47.9 171.5c-26.2 3.8-36.7 36.1-17.7 54.6l105.7 103-25 145.5c-4.5 26.3 23.2 46 46.4 33.7L288 439.6l130.7 68.7c23.2 12.2 50.9-7.4 46.4-33.7l-25-145.5 105.7-103c19-18.5 8.5-50.8-17.7-54.6L382 150.2 316.7 17.8c-11.7-23.6-45.6-23.9-57.4 0z"/>
                                </svg>
                                <svg class="rate-item" height="1em" viewBox="0 0 576 512">
                                    <path d="M259.3 17.8L194 150.2 47.9 171.5c-26.2 3.8-36.7 36.1-17.7 54.6l105.7 103-25 145.5c-4.5 26.3 23.2 46 46.4 33.7L288 439.6l130.7 68.7c23.2 12.2 50.9-7.4 46.4-33.7l-25-145.5 105.7-103c19-18.5 8.5-50.8-17.7-54.6L382 150.2 316.7 17.8c-11.7-23.6-45.6-23.9-57.4 0z"/>
                                </svg>
                                <svg class="rate-item" height="1em" viewBox="0 0 576 512">
                                    <path d="M259.3 17.8L194 150.2 47.9 171.5c-26.2 3.8-36.7 36.1-17.7 54.6l105.7 103-25 145.5c-4.5 26.3 23.2 46 46.4 33.7L288 439.6l130.7 68.7c23.2 12.2 50.9-7.4 46.4-33.7l-25-145.5 105.7-103c19-18.5 8.5-50.8-17.7-54.6L382 150.2 316.7 17.8c-11.7-23.6-45.6-23.9-57.4 0z"/>
                                </svg>
                                <svg class="rate-item" height="1em" viewBox="0 0 576 512">
                                    <path d="M259.3 17.8L194 150.2 47.9 171.5c-26.2 3.8-36.7 36.1-17.7 54.6l105.7 103-25 145.5c-4.5 26.3 23.2 46 46.4 33.7L288 439.6l130.7 68.7c23.2 12.2 50.9-7.4 46.4-33.7l-25-145.5 105.7-103c19-18.5 8.5-50.8-17.7-54.6L382 150.2 316.7 17.8c-11.7-23.6-45.6-23.9-57.4 0z"/>
                                </svg>
                            </div>
                            <div class="evaluate-item__info">
                                <div class="evaluate-item__info-avata rounded-circler">
                                    <?php echo $__env->make('Default::general.components.image', [
                                        'src' => resizeWImage($image,'w100'),
                                        'width' => '82px',
                                        'height' => '82px',
                                        'lazy'   => true,
                                        'title'  =>  ''
                                    ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                </div>
                                <div class="evaluate-item__info-details">
                                    <div class="evaluate-item__info-name">
                                        <?php echo e($config_general['customer_reviews']['customer_name'][$key] ?? ''); ?>

                                    </div>
                                    <div class="evaluate-item__info-position"><?php echo e($config_general['customer_reviews']['position'][$key] ?? ''); ?></div>
                                    <div class="evaluate-item__info-company"><?php echo e($config_general['customer_reviews']['address'][$key] ?? ''); ?></div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>
<?php /**PATH /var/home/themes/default/src/Providers/../../resources/views/web/layouts/evaluate.blade.php ENDPATH**/ ?>