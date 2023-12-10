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
    <style>
    	.table-rep-plugin .fixed-solution .sticky-table-header {
            top: 0px!important;
            background-color: #556ee6;
        }
        body{
        	background: #fff;
        }
    </style>
</head>
<body data-sidebar="dark">
    <div class="sudo-wrap">
        <div id="layout-wrapper">
            <div class="main-content" style="margin-left: 0;">
                <div class="page-content" style="padding: 0;">
                    <div class="container-fluid">
                        
                        <?php echo $__env->make('Core::layouts.base.alert', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <div class="row" style="background: #fff;">
							<div class="col-lg-12" style="padding: 0;">
								<div class="card listdata" id="listdata">
									<div class="card-header" style="background: #fff;">
										<?php if(isset($data['search']) && !empty($data['search'])): ?>
											<div class="float-left search-container" style="width: 100%;">
													<?php if(isset($data['action']) && is_array($data['action'])): ?>
														<div class="box-action">
															<select class="btn btn-default btn-sm" data-action data-field="<?php echo $data['action']['field_name']; ?>" style="float: left;height: 30px;margin-right: 5px;">
																<?php $__currentLoopData = $data['action']['value']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
																	<option value="<?php echo $value; ?>"><?php echo __($data['action']['label'][$key]); ?></option>
																<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
															</select>
															<button style="float: left;padding: 5px 10px;margin-top: 1px;margin-right: 5px;"
																type="button"
																class="btn btn-sm btn-primary"
																data-table="<?php echo e($table_name??''); ?>"
																data-action_all
															> <?php echo __('Translate::table.apply'); ?></button>
														</div>
													<?php endif; ?>
												<form action="<?php echo e(route('admin.'.$table_name.'.index')); ?>" class="form-inline" method="GET" accept-charset="utf-8">
													<input type="hidden" name="search" value="1">
													<?php $__currentLoopData = $data['search']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $search): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
														<?php switch($search['field_type']??''):
														    case ('string'): ?>
														    	<?php
														    		$fields = $search['fields']??'';
														    		$label = $search['label']??'';
														    	?>
														        <div class="form-group">
																	<input type="text" class="form-control input-sm" name="<?php echo e($fields); ?>" placeholder="<?php echo app('translator')->get($label); ?>" value="<?php echo e(Request()->$fields); ?>">
																</div>
													        <?php break; ?>

													        <?php case ('array'): ?>
																<?php
														    		$fields = $search['fields']??'';
														    		$label = $search['label']??'';
														    		$options = $search['option']??'';
														    	?>
														    	<div class="form-group">
														    		<select name="<?php echo e($fields); ?>" class="form-control input-sm">
														    			<option value="" <?php if(empty(Request()->$fields)): ?> selected <?php endif; ?> ><?php echo app('translator')->get('Translate::table.all'); ?> <?php echo app('translator')->get($label); ?></option>
														    			<?php $__currentLoopData = $options; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
														    				<option value="<?php echo e($key??''); ?>" 
														    					<?php if(Request()->$fields != null && Request()->$fields == $key): ?>
															    					selected
															    				<?php endif; ?>
														    				><?php echo app('translator')->get($option??''); ?></option>
														    			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
														    		</select>
														    	</div>
													        <?php break; ?>

													        <?php case ('hidden'): ?>
																<?php
														    		$fields = $search['fields']??'';
														    		$label = $search['label']??'';
														    	?>
																<input type="hidden" class="form-control input-sm" name="<?php echo e($fields); ?>" value="<?php echo e(Request()->$fields); ?>">
													        <?php break; ?>

													        <?php case ('range'): ?>
																<?php
														    		$fields = $search['fields']??'';
														    		$field_start = $search['fields'].'_start'??'';
														    		$field_end = $search['fields'].'_end'??'';
														    		$label = $search['label']??'';
														    	?>
																<div class="form-group">
																	<div id="<?php echo $fields; ?>" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 100%" class="form-control input-sm">
								                                        <i class="fa fa-calendar mr-1"></i>
								                                        <span></span>
								                                        <i class="fa fa-caret-down ml-1"></i>
								                                    </div>
								                                    <input id="<?php echo $fields; ?>_start" type="hidden" name="<?php echo $fields; ?>_start" value="">
								                                    <input id="<?php echo $fields; ?>_end" type="hidden" name="<?php echo $fields; ?>_end" value="">
																</div>
																<script>
																	$(function() {
								                                        var start = moment('<?php echo e(Request()->$field_start??'01/01/1970'); ?>');
								                                        var end = moment('<?php echo e(Request()->$field_end??''); ?>');
								                                        function cb(start, end) {
								                                            if(start.format('DD/MM/YYYY') == '01/01/1970') {
								                                                $('#<?php echo $fields; ?> span').html('<?php echo app('translator')->get('Translate::table.all'); ?> <?php echo app('translator')->get($label); ?>');
								                                                $('#<?php echo $fields; ?>_start').val('');
								                                                $('#<?php echo $fields; ?>_end').val('');
								                                            }else {
								                                                $('#<?php echo $fields; ?> span').html(start.format('DD/MM/YYYY') + ' - ' + end.format('DD/MM/YYYY'));
								                                                $('#<?php echo $fields; ?>_start').val(start.format('YYYY-MM-DD HH:mm:ss'));
								                                                $('#<?php echo $fields; ?>_end').val(end.format('YYYY-MM-DD HH:mm:ss'));
								                                            }
								                                        }
								                                        $('#<?php echo $fields; ?>').daterangepicker({
								                                            startDate: start,
								                                            endDate: end,
								                                            timePicker: true,
								                                            timePicker24Hour: true,
								                                            timePickerSeconds: true,
								                                            ranges: {
								                                               '<?php echo app('translator')->get('Tất cả'); ?>': [moment('1970-01-01'), moment().endOf('day')],
								                                               '<?php echo app('translator')->get('Hôm nay'); ?>': [moment().startOf('day'), moment().endOf('day')],
								                                               '<?php echo app('translator')->get('Hôm qua'); ?>': [moment().startOf('day').subtract(1, 'days'), moment().endOf('day').subtract(1, 'days')],
								                                               '<?php echo app('translator')->get('7 ngày qua'); ?>': [moment().startOf('day').subtract(6, 'days'), moment()],
								                                               '<?php echo app('translator')->get('30 ngày qua'); ?>': [moment().startOf('day').subtract(29, 'days'), moment()],
								                                               '<?php echo app('translator')->get('Tháng này'); ?>': [moment().startOf('month'), moment().endOf('month')],
								                                               '<?php echo app('translator')->get('Tháng trước'); ?>': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
								                                            },
								                                            locale: {
								                                                applyLabel: "<?php echo app('translator')->get('Chọn'); ?>",
								                                                cancelLabel: "<?php echo app('translator')->get('Xóa'); ?>",
								                                                fromLabel: "<?php echo app('translator')->get('Từ'); ?>",
								                                                toLabel: "<?php echo app('translator')->get('Đến'); ?>",
								                                                customRangeLabel: "<?php echo app('translator')->get('Tùy chọn'); ?>",
								                                                daysOfWeek: ["CN", "T2", "T3", "T4", "T5", "T6", "T7"],
								                                                monthNames: ["<?php echo app('translator')->get('Tháng'); ?> 1", "<?php echo app('translator')->get('Tháng'); ?> 2", "<?php echo app('translator')->get('Tháng'); ?> 3", "<?php echo app('translator')->get('Tháng'); ?> 4", "<?php echo app('translator')->get('Tháng'); ?> 5", "<?php echo app('translator')->get('Tháng'); ?> 6", "<?php echo app('translator')->get('Tháng'); ?> 7", "<?php echo app('translator')->get('Tháng'); ?> 8", "<?php echo app('translator')->get('Tháng'); ?> 9", "<?php echo app('translator')->get('Tháng'); ?> 10", "<?php echo app('translator')->get('Tháng'); ?> 11", "<?php echo app('translator')->get('Tháng'); ?> 12"],
								                                                firstDay: 1
								                                            }
								                                        }, cb);
								                                        cb(start, end);
								                                    });
																</script>
													        <?php break; ?>
														<?php endswitch; ?>
														
													<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

													<div class="form-group">
								                    	<div class="btn-group">
								                    		<?php echo csrf_field(); ?>
								                    		<button type="submit" class="btn btn-flat btn-success btn-sm search-btn"><i class="fas fa-search mr-1"></i><?php echo app('translator')->get('Translate::table.search'); ?></button>
								                    		<?php if(isset($data['search_btn']) && !empty($data['search_btn'])): ?>
								                    			<?php $__currentLoopData = $data['search_btn']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $search_btn): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								                    				<button type="submit" formaction="<?php echo $search_btn['url']??''; ?>" formmethod="POST" class="btn btn-<?php echo $search_btn['btn_type']??''; ?> btn-sm"><?php echo (isset($search_btn['btn_icon']) && !empty($search_btn['btn_icon']))?'<i class="'.$search_btn['btn_icon'].' mr-1"></i>' : ''; ?><?php echo app('translator')->get($search_btn['label']??''); ?></button>
								                    			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
								                    		<?php endif; ?>
								                    	</div>
								                    </div>

												</form>
											</div>
										<?php endif; ?>
										<div class="float-right action-container">
						                    <?php if(Request()->trash == true): ?> 
												<a href="<?php echo e(route('admin.'.$table_name.'.index')); ?>" class="btn btn-sm btn-default"><i class="fas fa-bars mr-1"></i><?php echo app('translator')->get('Translate::table.list_url'); ?></a>
						                    <?php endif; ?>
										</div>
									</div>
									<!-- /.card-header -->
									<div class="table-rep-plugin">
										<div class="table-wrapper">
											<div class="table-responsive mb-0 fixed-solution" data-pattern="priority-columns" style="margin-bottom: 0;">
												<table class="table table-striped" style="width: 100%;float: left;min-width: unset;">
													<thead>
														<tr>
															<th class="text-center pl-3" style="width: 50px;">STT</th>
															<?php if(isset($data['action']) && !empty($data['action'])): ?>
																<th class="table-checkbox center">
																	<input type="checkbox" class="btn-checkbox checkall">
																</th>
															<?php endif; ?>
															<?php $__currentLoopData = $data['table_generate']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $generate): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
																
																<?php if($generate['type'] == 'lang'): ?>
																	<?php if(isset($has_locale) && $has_locale == true && !empty(config('app.language') ?? [])): ?>
																		<th class="lang" style="width: calc(26px * <?php echo e(count(config('app.language') ?? [])); ?> + 5px)">
																			<?php $__currentLoopData = config('app.language'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
																				<span><img src="<?php echo e(getImage($lang['flag'] ?? '')); ?>"></span>
																			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
																		</th>
																	<?php endif; ?>
																<?php else: ?>
																	<th 
																		class="text-center"
																		<?php if(isset($generate['has_order']) && $generate['has_order'] == 1): ?>
																			style="cursor: pointer;" 
																			data-order_fields="<?php echo e($generate['field']??''); ?>"
																			data-order_by="asc"
																		<?php endif; ?>
																	>
																		<?php echo app('translator')->get($generate['label']??''); ?>
																		<?php if(isset($generate['has_order']) && $generate['has_order'] == 1): ?>
																			<div class="float-right"><i class="fas fa-sort"></i></div>
																		<?php endif; ?>
																	</th>
																<?php endif; ?>
															<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
														</tr>
													</thead>
													<tbody>
														<?php echo $__env->make('Category::item', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
													</tbody>
												</table>
											</div>
										</div>
									</div>
									<!-- /.card-body -->

									<div class="card-footer clearfix">
										<div class="float-left footer-action">
											<?php if(isset($data['action']) && is_array($data['action'])): ?>
												<div class="box-action">
													<select class="btn btn-default btn-sm" data-action data-field="<?php echo $data['action']['field_name']; ?>" style="float: left;height: 30px;margin-right: 5px;">
														<?php $__currentLoopData = $data['action']['value']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
															<option value="<?php echo $value; ?>"><?php echo __($data['action']['label'][$key]); ?></option>
														<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
													</select>
													<button style="float: left;padding: 5px 10px;margin-top: 1px;margin-right: 5px;"
														type="button"
														class="btn btn-sm btn-primary"
														data-table="<?php echo e($table_name??''); ?>"
														data-action_all
													> <?php echo __('Translate::table.apply'); ?></button>
												</div>
											<?php endif; ?>
											<?php if(isset($has_locale) && $has_locale == true && !empty(config('app.language') ?? [])): ?>
												<select class="btn btn-default btn-sm" data-language_table>
													<?php
														$cookie_locale = (isset($_COOKIE['table_locale']))? $_COOKIE['table_locale'] : \App::getLocale();
													?>
													<?php $__currentLoopData = config('app.language'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
														<option value="<?php echo $key; ?>" <?php if($key == $cookie_locale): ?> selected <?php endif; ?> ><?php echo $lang['name'] ?? ''; ?></option>
													<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
												</select>
											<?php endif; ?>
											<?php if(isset($data['no_trash']) && $data['no_trash'] == true): ?>
						                    	<a href="<?php echo e(route('admin.'.$table_name.'.index', ['trash' => 'true'])); ?>" class="btn btn-sm btn-default" style="color: #fff;background: #f1b44c;border: none;padding: 5px 20px;"><?php echo app('translator')->get('Translate::table.trash_url'); ?></a>
						                    <?php endif; ?>
										</div>
										<?php if(isset($data['paginate']) && $data['paginate'] == true): ?>
											<div class="float-right pagination-sm m-0">
												<?php echo e($data['show_data']->appends(Request()->all())->links()); ?>

											</div>
											<div class="float-right mr-2">
							                    <button type="button" class="btn btn-sm btn-default"><?php echo app('translator')->get('Translate::table.total'); ?>: <span class="total"><?php echo e($data['show_data']->total()); ?></span></button>
											</div>
										<?php else: ?>
											<div class="float-right">
									            <button type="button" class="btn btn-sm btn-default"><?php echo app('translator')->get('Translate::table.total'); ?>: <span class="total"><?php echo e(count($data['show_data'])); ?></span></button>
											</div>
										<?php endif; ?>
									</div>
								</div>
							</div>
						</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    
    <!-- Code nhúng cuối trang -->
    <script>
    	$(document).ready(function(){
            $('table td a').on('click', function(e){
                e.preventDefault();
                var link = $(this).attr('href');
                if(link != 'undefined'){
                	window.parent.window.location.href = link;
                }
            });
    	});
    </script>
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
    <script src="<?php echo e(asset('core/js/core.js')); ?>"></script>
    <script src="<?php echo e(asset('core/js/functions.js')); ?>"></script>
    <script src="<?php echo e(asset('core/libs/nestable/nestable.js')); ?>"></script>
    <?php echo $__env->yieldContent('foot'); ?>
</body>
</html><?php /**PATH /var/home/packages/sudo-base/categories/src/Providers/../../resources/views/listdata_simple.blade.php ENDPATH**/ ?>