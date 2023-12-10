========== Left Sidebar Start ========== -->
            <div class="vertical-menu">

                <div data-simplebar class="h-100">

                    <!--- Sidemenu -->
                    <div id="sidebar-menu">
                        <!-- Left Menu Start -->

                        <?php
                            $menu = json_decode(json_encode( config('SudoMenu.menu') ));
                        ?>
                        <ul class="metismenu list-unstyled" id="side-menu">
                            <?php if(isset($menu) && !empty($menu)): ?>
                            <?php $__currentLoopData = $menu; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php switch($item->type):
                                    case ('group'): ?>
                                        <?php
                                            // Kiểm tra quyền
                                            $show = false;
                                            foreach ($item->role ?? [] as $role) {
                                                if (checkRole($role) == true) { $show = true; }
                                            }
                                        ?>
                                        <?php if($show == true): ?>
                                            <li class="menu-title" key="t-menu"><?php echo app('translator')->get($item->name ?? ''); ?></li>
                                        <?php endif; ?>
                                    <?php break; ?>
                                    <?php case ('single'): ?>
                                        <?php
                                            // Kiểm tra active menu
                                            $active = activeMenu($item->route ?? '', $item->active ?? []);
                                            // echo $active;
                                        ?>
                                        <?php if(checkRole($item->role)): ?>
                                            <li>
                                                <a href="<?php echo e(route($item->route)); ?>" class="waves-effect <?php echo $active; ?>">
                                                    <i class="<?php echo $item->icon ?? ''; ?>"></i>
                                                    <span key="t-dashboards"><?php echo app('translator')->get($item->name ?? ''); ?></span>
                                                </a>
                                            </li>
                                        <?php endif; ?>
                                    <?php break; ?>
                                    <?php case ('multiple'): ?>
                                        <?php
                                            // Kiểm tra quyền
                                            $show = false;
                                            $array_active = [];
                                            foreach ($item->childs ?? [] as $childs) {
                                                // Kiểm tra quyền
                                                if (checkRole($childs->role) == true) { $show = true; }
                                                // Kiểm tra active menu
                                                if (isset($childs->route) && !empty($childs->route)) {
                                                    $array_active[] = $childs->route;
                                                }
                                                if (isset($childs->active) && !empty($childs->active)) {
                                                    foreach ($childs->active as $v) {
                                                        $array_active[] = $v;
                                                    }
                                                }
                                            }
                                            $active_parent = '';
                                            // Nếu menu con được active thì mở menu cha
                                            if (in_array(\Route::currentRouteName(), $array_active)) {
                                                $active_parent = 'menu-open';
                                            }
                                        ?>
                                        <?php if($show == true): ?>
                                        <li>
                                            <a href="javascript: void(0);" class="has-arrow waves-effect">
                                                <i class="<?php echo $item->icon ?? ''; ?>"></i>
                                                <span key="t-ecommerce"><?php echo app('translator')->get($item->name ?? ''); ?></span>
                                            </a>
                                            <ul class="sub-menu" aria-expanded="false">
                                                <?php $__currentLoopData = $item->childs ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $childs): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php if(checkRole($childs->role)): ?>
                                                    <?php
                                                        // Kiểm tra active menu
                                                        $active = activeMenu($childs->route ?? '', $childs->active ?? []);
                                                    ?>
                                                    <li class="<?php echo $active; ?>"><a href="<?php echo e(route($childs->route)); ?>" key="t-products"><?php echo app('translator')->get($childs->name ?? ''); ?></a></li>
                                                <?php endif; ?>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </ul>
                                        </li>
                                        <?php endif; ?>
                                    <?php break; ?>
                                <?php endswitch; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                        </ul>
                    </div>
                    <!-- Sidebar -->

                    
                </div>
            </div>
            <!-- Left Sidebar End<?php /**PATH /var/home/packages/sudo-base/base/src/Providers/../../resources/views/layouts/base/menu.blade.php ENDPATH**/ ?>