<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html lang="vi" xmlns="http://www.w3.org/1999/xhtml" xmlns:og="http://ogp.me/ns#" xmlns:fb="http://www.facebook.com/2008/fbml">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <?php if(stripos($_SERVER['HTTP_USER_AGENT'],"iPhone")): ?>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1"/>
    <?php else: ?>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=2"/>
    <?php endif; ?>
    <link href="<?php echo e($config_general['favicon'] ?? asset('favicon.ico')); ?>" type="image/x-icon" rel="shortcut icon"/>
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <meta name="agent" content="<?php echo e(checkAgent()); ?>">
    
    <?php echo $__env->make('Default::general.layouts.seo', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    
    <?php echo Asset::renderHeader(); ?>

    <style type="text/css">
        <?php
           /*echo file_get_contents(asset('./assets/font/Averta/averta.min.css?v='.config('SudoAsset.vesion')));*/
           /*echo file_get_contents(asset('/assets/build/css/general_mb.min.css?v='.config('SudoAsset.vesion')));*/
       ?>
   </style>
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('/assets/build/css/general_mb.min.css?v='.config('SudoAsset.vesion'))); ?>">
    
    <?php echo $__env->yieldContent('head'); ?>
    <link rel="preconnect" href="https://resize.sudospaces.com">
    <link rel="dns-prefectch" href="https://resize.sudospaces.com">
</head>
<body>
    <?php echo $__env->make('Default::mobile.layouts.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->yieldContent('content'); ?>
    <section id="loading_box"><div id="loading_image"></div></section>
    <div id="toast-container" class="toast-top-right">
        <div class="toast" aria-live="assertive" style="">
            <div class="toast-message">
                <p></p>
            </div>
        </div>
    </div>
    <?php echo $__env->make('Default::mobile.layouts.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo Asset::renderFooter(); ?>

    <?php echo $__env->yieldContent('foot'); ?>
    <?php
        $third_party_script_head = str_replace(['<script','</script'],['\x3Cscript','\x3C/script'],$config_code['html_head'] ?? '');
        $third_party_script_body = str_replace(['<script','</script'],['\x3Cscript','\x3C/script'],$config_code['html_body'] ?? '');
    ?>
    <script type="text/javascript" defer>
        document.addEventListener("DOMContentLoaded", function(event) {
            $(document).ready(function() {
                setTimeout(function() {
                    let script_head = `<?php echo $third_party_script_head; ?>`;
                    $('head').append(script_head);

                    let script_body = `<?php echo $third_party_script_body; ?>`;
                    $('body').append(script_body);
                }, 10000);
            });

        });
    </script>
</body>
</html>
<?php /**PATH /var/home/themes/default/src/Providers/../../resources/views/mobile/layouts/app.blade.php ENDPATH**/ ?>