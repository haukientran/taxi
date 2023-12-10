<?php $__env->startSection('content'); ?>
<div class="top_html">
    <?php if(isset($include_view_top) && !empty($include_view_top)): ?>
    	<?php $__currentLoopData = $include_view_top; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $include_view => $include_data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    		<?php echo $__env->make($include_view, $include_data, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php endif; ?>
</div>
<div class="row">
	<div class="col-lg-12">
		<div class="card listdata" id="listdata">
			<div class="card-header">
				<?php if(isset($data['search']) && !empty($data['search'])): ?>
					<div class="float-left search-container">
						<?php if(Request()->trash == true): ?>
							<div class="box-action">
								<select class="btn btn-default btn-sm" data-action data-field="<?php echo $data['action']['field_name']; ?>" style="float: left;height: 30px;margin-right: 5px;">
										<option value="0"><?php echo __('Hành động'); ?></option>
										<option value="1"><?php echo __('Lấy lại'); ?></option>
								</select>
								<button style="float: left;padding: 5px 10px;margin-top: 1px;margin-right: 5px;"
									type="button"
									class="btn btn-sm btn-primary"
									data-table="<?php echo e($table_name??''); ?>"
									data-action_all
								> <?php echo __('Translate::table.apply'); ?></button>
							</div>
	                    <?php else: ?>
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
	                    <?php endif; ?>
						<form action="<?php echo e(route('admin.'.$table_name.'.index')); ?>" class="form-inline" method="GET" accept-charset="utf-8">
							<input type="hidden" name="search" value="1">
                            <input type="hidden" class="newUpdateUrl">
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
								    		<select name="<?php echo e($fields); ?>" class="form-control input-sm form-select">
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
		                                        <span><?php echo e($label??''); ?></span>
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
	                        				<button type="submit" formaction="<?php echo $search_btn['url']??''; ?>" formmethod="POST" class="btn btn-<?php echo $search_btn['btn_type']??''; ?> btn-flat btn-sm"><?php echo (isset($search_btn['btn_icon']) && !empty($search_btn['btn_icon']))?'<i class="'.$search_btn['btn_icon'].' mr-1"></i>' : ''; ?><?php echo app('translator')->get($search_btn['label']??''); ?></button>
	                        			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
	                        		<?php endif; ?>
	                        	</div>
	                        </div>

						</form>
					</div>
				<?php endif; ?>
				<div class="float-right action-container">
					<?php if(isset($data['no_add']) && $data['no_add'] == true): ?>
						<a href="<?php echo e(route('admin.'.$table_name.'.create')); ?>" class="btn btn-sm btn-success"><i class="fa fa-plus mr-2"></i><?php echo app('translator')->get('Translate::table.add'); ?></a>
					<?php endif; ?>
                    <?php if(Request()->trash == true): ?>
						<a href="<?php echo e(route('admin.'.$table_name.'.index')); ?>" class="btn btn-sm btn-default"><i class="fas fa-bars mr-1"></i><?php echo app('translator')->get('Translate::table.list_url'); ?></a>
                    <?php endif; ?>
				</div>
			</div>
			<!-- /.card-header -->

			<div class="table-rep-plugin">
				<div class="table-wrapper">
					<div class="table-responsive mb-0 fixed-solution" data-pattern="priority-columns">
						<table class="table table-striped">
							<thead>
								<tr>
									<th class="text-center pl-3" style="width: 50px;"><?php echo app('translator')->get('STT'); ?></th>
									<?php if(isset($data['action']) && !empty($data['action'])): ?>
										<th class="table-checkbox center" style="width: 50px;">
											<input type="checkbox" class="form-check-input btn-checkbox checkall">
										</th>
									<?php endif; ?>
									<?php $__currentLoopData = $data['table_generate']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $generate): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
										
										<?php if($generate['type'] == 'lang'): ?>
											<?php if(isset($has_locale) && $has_locale == true && !empty(config('app.language') ?? [])): ?>
												<th class="lang center" style="width: calc(26px * <?php echo e(count(config('app.language') ?? [])); ?> + 50px)">
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
													data-order_fields="<?php echo e($generate['type'] == 'pin' ? 'pin_' : ''); ?><?php echo e($generate['field']??''); ?>"
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
								<?php echo $__env->make('Table::item', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<!-- /.card-body -->

			<div class="card-footer clearfix">
				<div class="float-left footer-action">
					<?php if(!empty( config('app.page_size') ?? [] )): ?>
						<select class="btn btn-default btn-sm" data-pagesize>
							<?php
								$cookie_locale = (isset($_COOKIE['sudo_page_size']))? $_COOKIE['sudo_page_size'] : $data['page_size'];
							?>
							<?php $__currentLoopData = config('app.page_size'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page_size): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<option value="<?php echo $page_size; ?>" <?php if($page_size == $cookie_locale): ?> selected <?php endif; ?> ><?php echo $page_size; ?></option>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						</select>
					<?php endif; ?>
					<?php if(Request()->trash == true): ?>
						<div class="box-action">
							<select class="btn btn-default btn-sm" data-action data-field="<?php echo $data['action']['field_name']; ?>" style="float: left;height: 30px;margin-right: 5px;">
									<option value="0"><?php echo __('Hành động'); ?></option>
									<option value="1"><?php echo __('Lấy lại'); ?></option>
							</select>
							<button style="float: left;padding: 5px 10px;margin-top: 1px;margin-right: 5px;"
								type="button"
								class="btn btn-sm btn-primary"
								data-table="<?php echo e($table_name??''); ?>"
								data-action_all
							> <?php echo __('Translate::table.apply'); ?></button>
						</div>
                    <?php else: ?>
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
				<div class="float-right pagination-sm m-0">
					<?php echo e($data['show_data']->appends(Request()->all())->links()); ?>

				</div>
				<div class="float-right mr-2">
                    <button type="button" class="btn btn-sm btn-default"><?php echo app('translator')->get('Translate::table.total'); ?>: <span class="total"><?php echo e($data['show_data']->total()); ?></span></button>
				</div>
			</div>

		</div>
	</div>
</div>
<?php if(isset($include_view_bottom) && !empty($include_view_bottom)): ?>
	<?php $__currentLoopData = $include_view_bottom; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $include_view => $include_data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
		<?php echo $__env->make($include_view, $include_data, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php endif; ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('Core::layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/home/packages/sudo-base/table/src/Providers/../../resources/views/listdata.blade.php ENDPATH**/ ?>