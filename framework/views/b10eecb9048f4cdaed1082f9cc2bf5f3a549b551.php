<?php
    $mobile_menu = json_decode(@$config_menu['mobile_menu'], 1) ?? [];
?>
<header class="header <?php echo e(Route::getCurrentRoute() != null && Route::getCurrentRoute()->uri() == '/' ? 'home header_home' : ''); ?>">
    <div class="header-content">
        <div class="flex-center-between w-100">
            <div class="header-logo text-center">
                <a href="<?php echo e(route('mobile.home')); ?>" aria-label="logo">
                    <?php echo $__env->make('Default::general.components.image', [
                        'src' =>  resizeWImage($config_general['logo_header_mobile'] ?? '','w200'),
                        'width' => '128px',
                        'height' => '28px',
                        'lazy'   => true,
                        'title'  => 'logo'
                    ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </a>
            </div>
            <div class="header-menu">
                <span class="menu-btn"><svg xmlns="https://www.w3.org/2000/svg" viewBox="0 0 448 512" width="30" height="30" fill="black"><path d="M0 96C0 78.3 14.3 64 32 64H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H32C14.3 128 0 113.7 0 96zM0 256c0-17.7 14.3-32 32-32H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H32c-17.7 0-32-14.3-32-32zM448 416c0 17.7-14.3 32-32 32H32c-17.7 0-32-14.3-32-32s14.3-32 32-32H416c17.7 0 32 14.3 32 32z"/></svg></span>
                <span class="menu-btn menu-btn--close">CLOSE</span>
            </div>
        </div>
    </div>
    <div class="menu-popup">
        <?php if(isset($mobile_menu) && count($mobile_menu) > 0): ?>
            <ul class="menu-list">
                <?php $__currentLoopData = $mobile_menu; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $menu_lv1): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li class="menu-list__item">
                        <a  class="item-link <?php echo e(isset($menu_lv1['children']) && count($menu_lv1['children']) ? 'has-child' :  ''); ?>" href="<?php echo e(isset($menu_lv1['children']) && count($menu_lv1['children']) ? 'javascript:;' :  $menu_lv1['link']); ?>" target="<?php echo e($menu_lv1['target'] == '_blank' ? 'blank' : '_self'); ?>" aria-label="<?php echo $menu_lv1['name']??''; ?>" title="<?php echo $menu_lv1['name']??''; ?>">
                            <span class="fs-15 text-up color_white">  <?php echo $menu_lv1['name']??''; ?></span>
                        </a>
                        <?php if(isset($menu_lv1['children']) && count($menu_lv1['children']) > 0): ?>
                            <ul class="submenu">
                                <?php $__currentLoopData = $menu_lv1['children']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menu_lv2): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li class="submenu-category__item">
                                        <a  class="item-link  <?php echo e(isset($menu_lv2['children']) && count($menu_lv2['children']) ? 'has-child' :  ''); ?> " href="<?php echo e(isset($menu_lv2['children']) && count($menu_lv2['children']) ? 'javascript:;' :  $menu_lv2['link']); ?>" target="<?php echo e($menu_lv2['target'] == '_blank' ? 'blank' : '_self'); ?>" aria-label="<?php echo $menu_lv2['name']??''; ?>" title="<?php echo $menu_lv2['name']??''; ?>">
                                            <span class="fs-14 text-up color_white">  <?php echo $menu_lv2['name']??''; ?></span>
                                        </a>
                                        <?php if(isset($menu_lv2['children']) && count($menu_lv2['children']) > 0): ?>
                                        <ul class="submenu submenu-child lv2">
                                            <?php $__currentLoopData = $menu_lv2['children']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menu_lv3): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <li>
                                                <a class="item-link" rel="<?php echo e($menu_lv3['rel'] ?? 'javascript:;'); ?>" href="<?php echo e($menu_lv3['link'] ?? 'javascript:;'); ?>" target="<?php echo e($menu_lv3['target'] == '_blank' ? 'blank' : '_self'); ?>" aria-label="<?php echo $menu_lv3['name']??''; ?>" title="<?php echo $menu_lv3['name']??''; ?>">
                                                    <span class="fs-12 text-up color_white">  <?php echo $menu_lv3['name']??''; ?></span>
                                                </a>
                                            </li>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </ul>
                                        <?php endif; ?>
                                    </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        <?php endif; ?>
                    </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        <?php endif; ?>
        </div>
</header>
<?php /**PATH /var/home/themes/default/src/Providers/../../resources/views/mobile/layouts/header.blade.php ENDPATH**/ ?>