 <section id="register" class="register">
    <div class="container register-container">
        <h2 class="section-title register-title"><?php echo e($title ?? 'ĐĂNG KÝ TƯ VẤN'); ?></h2>
        <div class="register-form">
            <div class="form-item">
                <input type="text" class="register-form-item form-control" name="name" placeholder="Họ và tên học viên *" aria-label="Họ và tên học viên" title="Họ và tên học viên">
                <p class="err_show null">Họ và Tên là bắt buộc!</p>
            </div>
            <div class="form-item">
                <input type="text" class="register-form-item form-control" name="phone" placeholder="Số điện thoại liên hệ *" aria-label="Số điện thoại liên hệ" title="Số điện thoại liên hệ">
                <p class="err_show null">Số điện thoại là bắt buộc!</p>
                <p class="err_show phone">Số điện thoại không đúng định dạng!</p>
            </div>
            <div class="form-item">
                <select name="service_contact" class="register-form-item form-control" aria-label="<?php echo e($config_general['service_contact_title'] ?? 'Dịch vụ'); ?>">
                    <?php if(isset($config_general['service_contact']['name']) && count($config_general['service_contact']['name']) > 0): ?>
                        <?php $__currentLoopData = $config_general['service_contact']['name']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $service_contact): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e((int)$key); ?>"><?php echo e($service_contact ?? ''); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>
                </select>
                <p class="err_show null"><?php echo e(isset($config_general['service_contact_title']) ? $config_general['service_contact_title'] : 'Dịch vụ'); ?> là bắt buộc!</p>
            </div>
            <div class="form-item">
                <select name="type_contact" class="register-form-item form-control" aria-label="<?php echo e($config_general['type_contact_title'] ?? 'Loại xe'); ?>">
                    <?php if(isset($config_general['type_contact']['name']) && count($config_general['type_contact']['name']) > 0): ?>
                        <?php $__currentLoopData = $config_general['type_contact']['name']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $type_contact): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($key); ?>"><?php echo e($type_contact ?? ''); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>
                </select>
                <p class="err_show null"><?php echo e(isset($config_general['type_contact_title']) ? $config_general['type_contact_title'] : 'Loại xe '); ?> là bắt buộc!</p>
            </div>
            <div class="form-item">
                <input type="text" class="register-form-item form-control" name="departure" placeholder="Điểm đi *" aria-label="Điểm đi" title="Điểm đi">
                <p class="err_show null">Điểm đi!</p>
                <p class="err_show departure">Điểm đi không đúng định dạng!</p>
            </div>
            <div class="form-item">
                <input type="text" class="register-form-item form-control" name="destination" placeholder="Điểm đến *" aria-label="Điểm đến" title="Điểm đến">
                <p class="err_show null">Điểm đến!</p>
                <p class="err_show destination">Điểm đến không đúng định dạng!</p>
            </div>
        </div>
        <div class="flex-center">
            <button type="button" class="btn btn-primary register-action fs-18" name="register-action" onclick="loadSendForm('register')" data-type="1" aria-label="Gửi" title="Gửi">Gửi</button>
        </div>
    </div>
</section>
<?php /**PATH /var/home/themes/default/src/Providers/../../resources/views/mobile/layouts/register.blade.php ENDPATH**/ ?>