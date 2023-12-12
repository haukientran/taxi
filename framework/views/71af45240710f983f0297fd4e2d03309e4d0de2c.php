    <?php if(isset($setting_home['service_grid3']['title']) && count($setting_home['service_grid3']['title']) > 0): ?>
    <section id="contidion" class="service_grid3">
        <div class="container">
            <h2 class="section-title contidion-title"><?php echo e(isset($setting_home['service_grid3_title']) ? $setting_home['service_grid3_title'] : 'Dịch vụ của chúng tôi'); ?></h2>
            <div class="contidion-list w-100">
                <?php $__currentLoopData = $setting_home['service_grid3']['title']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $service_grid3): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="contidion-item">
                    <div class="contidion-item__thumbnail">
                        <?php echo $__env->make('Default::general.components.image', [
                            'src' => resizeWImage(isset($setting_home['service_grid3']['image'][$k]) ? $setting_home['service_grid3']['image'][$k] : '' , 'w300'),
                            'width' => '300',
                            'height' => '300',
                            "lazy"   => true,
                            'title'  =>  'khoa-hoc-ke-toan-tong-hop-1'
                        ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                    <div class="contidion-item__content f-w-b fs-16"><?php echo e($service_grid3 ?? ''); ?></div>
                    <div class="contidion-item__description mt-10"><?php echo e($setting_home['service_grid3']['description'][$k] ?? ''); ?></div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </section>
    <?php endif; ?><?php /**PATH /var/home/themes/default/src/Providers/../../resources/views/web/layouts/service_grid3.blade.php ENDPATH**/ ?>