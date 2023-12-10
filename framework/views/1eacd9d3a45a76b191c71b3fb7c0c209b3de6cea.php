<header id="page-topbar">
    <div class="navbar-header">
        <div class="d-flex">
            <!-- LOGO -->
            <div class="navbar-brand-box">

                <a href="/" class="logo logo-light" target="_blank">
                    <h1 style="color: #fff;font-size: 22px;padding-top: 25px;"><?php echo env('APP_NAME'); ?></h1>
                </a>
            </div>
            <button type="button" class="btn btn-sm px-3 font-size-16 header-item waves-effect" id="vertical-menu-btn">
                <i class="fa fa-fw fa-bars"></i>
            </button>
        </div>
        <div class="d-flex">
            <div class="dropdown d-inline-block d-lg-none ms-2">
                <button type="button" class="btn header-item noti-icon waves-effect" id="page-header-search-dropdown"
                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="mdi mdi-magnify"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
                    aria-labelledby="page-header-search-dropdown">

                    <form class="p-3">
                        <div class="form-group m-0">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Search ..." aria-label="Recipient's username">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="submit"><i class="mdi mdi-magnify"></i></button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="dropdown d-none d-lg-inline-block ms-1">
                <button type="button" class="btn header-item noti-icon waves-effect" data-cache_clear="" title="Xóa Cache">
                    <i class="bx bx-bug"></i>
                </button>
            </div>
            <div class="dropdown d-inline-block">
                <?php if(count(config('app.language') ?? []) > 0): ?>
                    <?php $__currentLoopData = config('app.language'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if(App::getLocale() == $key): ?>
                        <button type="button" class="btn header-item waves-effect"
                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img id="header-lang-img" src="<?php echo e($lang['flag']??''); ?>" alt="Header Language" height="16">
                        </button>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
                <div class="dropdown-menu dropdown-menu-end">
                    <!-- item-->
                    <?php if(count(config('app.language') ?? []) > 0): ?>
                    <?php $__currentLoopData = config('app.language'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <a href="javascript:;" data-language="<?php echo $key; ?>" class="dropdown-item notify-item language" data-lang="en">
                        <img src="<?php echo e($lang['flag']?? ''); ?>" alt="user-image" class="me-1" height="12"> <span class="align-middle"><?php echo $lang['name'] ?? ''; ?></span>
                    </a>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>
                </div>
            </div>
            <div class="dropdown d-none d-lg-inline-block ms-1">
                <button type="button" class="btn header-item noti-icon waves-effect" data-toggle="fullscreen">
                    <i class="bx bx-fullscreen"></i>
                </button>
            </div>

            <div class="dropdown d-inline-block">
                <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img class="rounded-circle header-profile-user" src="<?php echo e(Auth::guard('admin')->user()->avatar != '' ? Auth::guard('admin')->user()->avatar : asset('admin_assets/images/users/no-avatar.png')); ?>"
                        alt="Header Avatar">
                    <span class="d-none d-xl-inline-block ms-1" key="t-henry"><?php echo Auth::guard('admin')->user()->display_name; ?></span>
                    <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-end">
                    <!-- item-->
                    <a class="dropdown-item" href="<?php echo e(route('admin.admin_users.change_info', Auth::guard('admin')->user()->id)); ?>"><i class="bx bx-user font-size-16 align-middle me-1"></i> <span key="t-profile"><?php echo app('translator')->get('Translate::admin.account_info'); ?></span></a>
                    <a class="dropdown-item d-block" href="<?php echo e(route('admin.admin_users.change_password', Auth::guard('admin')->user()->id)); ?>"><i class="bx bx-wrench font-size-16 align-middle me-1"></i> <span key="t-settings"><?php echo app('translator')->get('Translate::admin.change_password'); ?></span></a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item text-danger" href="<?php echo e(route('admin.logout')); ?>"><i class="bx bx-power-off font-size-16 align-middle me-1 text-danger"></i> <span key="t-logout"><?php echo app('translator')->get('Translate::admin.logout'); ?></span></a>
                </div>
            </div>
        </div>
    </div>
</header><?php /**PATH /var/home/packages/sudo-base/base/src/Providers/../../resources/views/layouts/base/header.blade.php ENDPATH**/ ?>