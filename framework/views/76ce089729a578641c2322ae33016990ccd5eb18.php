<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Admin | <?php echo e(env('APP_NAME')); ?></title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <meta name="admin_dir" content="<?php echo e(config('app.admin_dir')); ?>">
    <meta name="language" content="<?php echo e(\App::getLocale()); ?>">
    
    
    
    <!-- Bootstrap Css -->
    <link href="<?php echo e(asset('admin_assets/css/bootstrap.min.css')); ?>" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <link href="<?php echo e(asset('admin_assets/libs/dropzone/min/dropzone.min.css')); ?>" rel="stylesheet" type="text/css">
    <link href="<?php echo e(asset('admin_assets/libs/admin-resources/rwd-table/rwd-table.min.css')); ?>" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="<?php echo e(asset('admin_assets/plugins/toastr/toastr.min.css')); ?>">
    <!-- Icons Css -->
    <link href="<?php echo e(asset('admin_assets/css/icons.min.css')); ?>" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="<?php echo e(asset('admin_assets/css/app.min.css')); ?>" id="app-style" rel="stylesheet" type="text/css" />
    <link href="<?php echo e(asset('admin_assets/plugins/select2/css/select2.min.css')); ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo e(asset('admin_assets/plugins/datetimepicker/jquery.datetimepicker.min.css')); ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo e(asset('admin_assets/plugins/daterangepicker/daterangepicker.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('core/libs/nestable/nestable.css')); ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo e(asset('admin_assets/css/style.css')); ?>" id="app-style" rel="stylesheet" type="text/css" />
    <?php echo $__env->yieldContent('head'); ?>
    <script src="<?php echo e(asset('admin_assets/libs/jquery/jquery.min.js')); ?>"></script>
    <script src="<?php echo e(asset('admin_assets/libs/dropzone/min/dropzone.min.js')); ?>"></script>
    <script src="<?php echo e(asset('admin_assets/plugins/moment/moment.min.js')); ?>"></script>
    <script src="<?php echo e(asset('admin_assets/plugins/daterangepicker/daterangepicker.js')); ?>"></script>
</head>
<body data-sidebar="dark">
    <div class="sudo-wrap">
        <!-- <body data-layout="horizontal" data-topbar="dark"> -->
        <!-- Begin page -->
        <div id="layout-wrapper">

            
            <?php echo $__env->make('Core::layouts.base.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            
            
            <?php echo $__env->make('Core::layouts.base.menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="main-content">
                <div class="page-content">
                    <div class="container-fluid">

                        
                        <?php echo $__env->make('Core::layouts.base.content_header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <?php echo $__env->make('Core::layouts.base.alert', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <?php echo $__env->yieldContent('content'); ?>
                    </div>
                    <!-- container-fluid -->
                </div>
                <!-- End Page-content -->
                
                
                <?php echo $__env->make('Core::layouts.base.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>
            <!-- end main content-->
        </div>
        <!-- END layout-wrapper -->
        <!-- Right Sidebar -->

        <!-- /Right-bar -->
        <!-- Right bar overlay-->
        <div class="rightbar-overlay"></div>
        <?php echo $__env->make('Core::layouts.base.media', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </div>
    
    
    <!-- Code nhúng cuối trang -->

    <!-- JAVASCRIPT -->
    <script src="<?php echo e(asset('admin_assets/libs/bootstrap/js/bootstrap.bundle.min.js')); ?>"></script>
    <script src="<?php echo e(asset('admin_assets/libs/metismenu/metisMenu.min.js')); ?>"></script>
    <script src="<?php echo e(asset('admin_assets/libs/simplebar/simplebar.min.js')); ?>"></script>
    <script src="<?php echo e(asset('admin_assets/libs/node-waves/waves.min.js')); ?>"></script>
    <script src="<?php echo e(asset('admin_assets/libs/admin-resources/rwd-table/rwd-table.min.js')); ?>"></script>
    <script src="<?php echo e(asset('admin_assets/js/pages/table-responsive.init.js')); ?>"></script>
    <!-- Toastr -->
    <script src="<?php echo e(asset('admin_assets/plugins/toastr/toastr.min.js')); ?>"></script>
    <!-- apexcharts -->
    <script src="<?php echo e(asset('admin_assets/libs/apexcharts/apexcharts.min.js')); ?>"></script>
    <!-- dashboard init -->
    <script src="<?php echo e(asset('admin_assets/plugins/tinymce/tinymce.min.js')); ?>"></script>
    <script src="<?php echo e(asset('admin_assets/plugins/select2/js/select2.full.min.js')); ?>"></script>
    <script src="<?php echo e(asset('admin_assets/plugins/datetimepicker/jquery.datetimepicker.full.min.js')); ?>"></script>
    <script src="<?php echo e(asset('admin_assets/plugins/jquery-ui/jquery-ui.min.js')); ?>"></script>
    <script src="<?php echo e(asset('core/libs/nestable/jquery.nestable.js')); ?>"></script>
    
    <script src="<?php echo e(asset('admin_assets/libs/inputmask/min/jquery.inputmask.bundle.min.js')); ?>"></script>
    <script src="<?php echo e(asset('admin_assets/js/pages/form-mask.init.js')); ?>"></script>
    <!-- App js -->
    <script src="<?php echo e(asset('admin_assets/js/app.js')); ?>"></script>
    <script src="<?php echo e(asset('core/js/core.js')); ?>?v=<?php echo e(config('SudoAssets.vesion')); ?>"></script>
    <script src="<?php echo e(asset('core/js/functions.js')); ?>?v=<?php echo e(config('SudoAssets.vesion')); ?>"></script>
    <script src="<?php echo e(asset('core/libs/nestable/nestable.js')); ?>"></script>
    <script src="<?php echo e(asset('platforms/comments/admin/js/comments.js')); ?>"></script>
    <?php echo $__env->yieldContent('foot'); ?>
    <script>
        checkAuth();
        function checkAuth() {
            let isChrome = /Chrome/.test(navigator.userAgent) && /Google Inc/.test(navigator.vendor);;
            if(isChrome) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>'
                    }
                });
                $.ajax({
                    method: 'POST',
                    url: '/admin/checkAuth',
                    dataType:'json',
                    token: '<?php echo e(csrf_token()); ?>',
                    beforeSend: function(){},
                    success: function(data){
                        if(data.status == 0) {
                            window.location.href = data.link;
                        }
                    },
                    error: function(error) {},
                });
            }
        }
    </script>
</body>
</html>
<?php /**PATH /var/home/packages/sudo-base/base/src/Providers/../../resources/views/layouts/app.blade.php ENDPATH**/ ?>