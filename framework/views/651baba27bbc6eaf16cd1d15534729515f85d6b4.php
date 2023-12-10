<?php $__env->startSection('head'); ?>
	<style type="text/css">
		<?php
		?>
            /*echo file_get_contents(asset("./assets/build/css/page_mb.min.css?v=".config('SudoAsset.vesion')));*/
	</style>
    
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('./assets/build/css/page_mb.min.css?v='.config('SudoAsset.vesion'))); ?>">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<main class="contact">
    <div class="container">
        <h1 class="color_title text-center">Liên hệ</h1>
        <div class="contact-content__map">
            <?php echo $config_contact['link_map'] ?? ''; ?>

        </div>
        <div class="contact-content">
            <div class="contact-content__form">
                <?php if(isset($text_success) && $text_success == true): ?>
                    <h4 class="fs-18 f-w-b lh-20 mb-20">Gửi yêu cầu liên hệ thành công. Xin cảm ơn!</h4>
                <?php else: ?>
                    <form class="pl-lg-2" action="javascript:;" method="post" id="contact">
                        <?php echo csrf_field(); ?>
                        <input type="hidden" name="type" value="0">
                        <div class="form-box">
                            <div class="form-item">
                                <label for="name" class="fs-16">Họ và tên <span class="text_emb">*</span></label> <br>
                                <input type="text" class="form-control field" name="name" id="name" placeholder="Họ và Tên" data-validate="text" aria-label="Họ và Tên">
                                <p class="err_show null">Họ và Tên là bắt buộc!</p>
                            </div>
                            <div class="form-item">
                                <label for="email" class="fs-16">Email <span class="text_emb">*</span></label><br>
                                <input type="text" class="form-control field" name="email" id="email" placeholder="A@gmail.com" data-validate="text" aria-label="email">
                                <p class="err_show null">Email là bắt buộc!</p>
                                <p class="err_show email">Email không đúng định dạng!</p>
                            </div>
                            <div class="form-item">
                                <label for="phone" class="fs-16">Nhập số điện thoại <span class="text_emb">*</span></label><br>
                                <input type="text" class="form-control field" name="phone" id="phone" placeholder="Số điện thoại" data-validate="text" aria-label="Số điện thoại">
                                <p class="err_show null">Số điện thoại là bắt buộc!</p>
                                <p class="err_show phone">Số điện thoại không đúng định dạng!</p>
                            </div>
                            <div class="form-item">
                                <label for="address" class="fs-16">Địa chỉ liên hệ</label>
                                <input type="text" class="field" name="address" id="address" placeholder="Địa chỉ liên hệ" data-validate="text" aria-label="Địa chỉ liên hệ">
                            </div>
                            <div class="form-item w-100 form-item__note">
                                <label for="note" class="fs-16">Nội dung<span class="text_emb">*</span></label><br>
                                <textarea class="form-control" name="note" id="note" cols="30" rows="10" placeholder="Nội dung yêu cầu tư vấn"  aria-label="Nội dung yêu cầu tư vấn"></textarea>
                                <p class="err_show null">Nội dung là bắt buộc!</p>
                            </div>
                            <div class="form-item form-item__action">
                                <button class="button button__primary text-up color_white" onclick="loadSend('contact')">
                                    Gửi liên hệ
                                </button>
                            </div>
                        </div>
                    </form>
                <?php endif; ?>
            </div>
            <div class="contact-content__info">
                <div class="info_address info_item">
                    <span class="fw-600">Địa chỉ</span>
                    <p>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512" width="16" height="16"><path d="M215.7 499.2C267 435 384 279.4 384 192C384 86 298 0 192 0S0 86 0 192c0 87.4 117 243 168.3 307.2c12.3 15.3 35.1 15.3 47.4 0zM192 128a64 64 0 1 1 0 128 64 64 0 1 1 0-128z"/></svg>
                        <?php echo e($config_contact['address'] ?? ''); ?>

                    </p>
                </div>
                <div class="info_phone info_item">
                    <span class="fw-600">Điện thoại</span>
                    <p class="phone_item">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512" width="16" height="16"><path d="M16 64C16 28.7 44.7 0 80 0H304c35.3 0 64 28.7 64 64V448c0 35.3-28.7 64-64 64H80c-35.3 0-64-28.7-64-64V64zM224 448a32 32 0 1 0 -64 0 32 32 0 1 0 64 0zM304 64H80V384H304V64z"/></svg>
                        Phone: <?php echo e($config_contact['phone'] ?? ''); ?>

                    </p>
                    <?php if(isset($config_contact['tel']) && $config_contact['tel'] != '' ): ?>
                     <p class="phone_item">
                       <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" width="16" height="16"><path d="M164.9 24.6c-7.7-18.6-28-28.5-47.4-23.2l-88 24C12.1 30.2 0 46 0 64C0 311.4 200.6 512 448 512c18 0 33.8-12.1 38.6-29.5l24-88c5.3-19.4-4.6-39.7-23.2-47.4l-96-40c-16.3-6.8-35.2-2.1-46.3 11.6L304.7 368C234.3 334.7 177.3 277.7 144 207.3L193.3 167c13.7-11.2 18.4-30 11.6-46.3l-40-96z"/></svg>
                        Tel: <?php echo e($config_contact['tel'] ?? ''); ?>

                    </p>
                    <?php endif; ?>
                     <p class="phone_item">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" width="16" height="16"><path d="M64 112c-8.8 0-16 7.2-16 16v22.1L220.5 291.7c20.7 17 50.4 17 71.1 0L464 150.1V128c0-8.8-7.2-16-16-16H64zM48 212.2V384c0 8.8 7.2 16 16 16H448c8.8 0 16-7.2 16-16V212.2L322 328.8c-38.4 31.5-93.7 31.5-132 0L48 212.2zM0 128C0 92.7 28.7 64 64 64H448c35.3 0 64 28.7 64 64V384c0 35.3-28.7 64-64 64H64c-35.3 0-64-28.7-64-64V128z"/></svg>
                        Email: <?php echo e($config_contact['email'] ?? ''); ?>

                    </p>

                </div>
            </div>
        </div>
    </div>
</main>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('foot'); ?>
    <script defer src="<?php echo e('/assets/build/js/page.min.js?v='.config('SudoAsset.vesion')); ?>"></script>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('Default::mobile.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/home/themes/default/src/Providers/../../resources/views/mobile/pages/contact.blade.php ENDPATH**/ ?>