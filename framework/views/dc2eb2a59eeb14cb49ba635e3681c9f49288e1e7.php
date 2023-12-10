
<?php
	$slug = str_slug($name);
?>
<div class="mb-3 <?php if(isset($has_full) && $has_full == false): ?> row <?php endif; ?>" style="position: relative;">
	<label <?php if($has_full == false): ?> class="col-md-2 col-form-label" <?php endif; ?>><?php echo app('translator')->get($label??''); ?></label>
	<?php if($has_full == false): ?> 
        <div class="col-md-10">
    <?php endif; ?>
		<div class="table-form">
			<table class="table-form__table" border="1">
				<tbody>
					<?php if(isset($generate) && !empty($generate)): ?>
						<?php
							$first_field_name = '';
							if ($generate[0]['type'] == 'custom') {
								$first_field_name = $generate[0]['generate'][0]['name'] ?? '';
							} else {
								$first_field_name = $generate[0]['name'] ?? '';
							}
						?>
						<?php if(isset($value[$first_field_name]) && !empty($value[$first_field_name])): ?>
							<?php for($j = 0; $j < count($value[$first_field_name]); $j++): ?>
								<tr>
									<?php for($i = 0; $i < count($generate); $i++): ?>
										<?php switch($generate[$i]['type'] ?? ''):
											
											case ('image'): ?>
												<?php
													$image_name = $slug.'_'.$generate[$i]['name'].'_'.$j;
												?>
										        <td class="table-form__table-image">
													<div class="custom-image">
														<input type="hidden" name="<?php echo e($name ?? ''); ?>[<?php echo e($generate[$i]['name'] ?? ''); ?>][]" id="input-<?php echo e($image_name ?? ''); ?>" value="<?php echo e($value[$generate[$i]['name'] ?? ''][$j] ?? ''); ?>">
														<img data-image="<?php echo e(route('media.index', ['uploads' => 'direct','field_id' => $image_name ?? '','only' => 'image'
											            ])); ?>" src="<?php echo e(getImage($value[$generate[$i]['name'] ?? ''][$j] ?? '')); ?>" alt="" id="<?php echo e($image_name ?? ''); ?>">
														<button type="button" data-image="<?php echo e(route('media.index', [
											                'uploads' => 'direct',
											                'field_id' => $image_name ?? '',
											                'only' => 'image'
											            ])); ?>" class="add-image" title="<?php echo app('translator')->get($generate[$i]['size'] ?? ''); ?>"><i class="fas fa-image"></i></button>
														<button type="button" class="remove-image"><i class="fas fa-times"></i></button>
													</div>
													<p class="help-text"><?php echo app('translator')->get($generate[$i]['size'] ?? ''); ?></p>
												</td>
									        <?php break; ?>

											<?php case ('text'): ?>
												<td class="table-form__table-text">
													<input class="table-form__control" type="text" name="<?php echo e($name ?? ''); ?>[<?php echo e($generate[$i]['name'] ?? ''); ?>][]" placeholder="<?php echo app('translator')->get($generate[$i]['placeholder'] ?? ''); ?>" value="<?php echo e($value[$generate[$i]['name'] ?? ''][$j] ?? ''); ?>">
												</td>
											<?php break; ?>

											<?php case ('textarea'): ?>
												<td class="table-form__table-textarea">
													<textarea class="table-form__control" name="<?php echo e($name ?? ''); ?>[<?php echo e($generate[$i]['name'] ?? ''); ?>][]" placeholder="<?php echo app('translator')->get($generate[$i]['placeholder'] ?? ''); ?>"><?php echo e($value[$generate[$i]['name'] ?? ''][$j] ?? ''); ?></textarea>
												</td>
									        <?php break; ?>

									        <?php case ('custom'): ?>
												<td class="table-form__table-custom">
													<?php if(isset($generate[$i]['generate']) && !empty($generate[$i]['generate'])): ?>
														<?php for($c = 0; $c < count($generate[$i]['generate']); $c++): ?>
															<?php
																$child_item = $generate[$i]['generate'][$c];
															?>
															<?php switch($child_item['type'] ?? ''):
																case ('image'): ?>
																	<?php
																		$image_name = $slug.'_'.$child_item['name'].'_'.$j;
																	?>
																	<div class="custom-image">
																		<input type="hidden" name="<?php echo e($name ?? ''); ?>[<?php echo e($child_item['name'] ?? ''); ?>][]" id="input-<?php echo e($image_name ?? ''); ?>" value="<?php echo e($value[$child_item['name'] ?? ''][$j] ?? ''); ?>">
																		<img data-image="<?php echo e(route('media.index', ['uploads' => 'direct','field_id' => $image_name ?? '','only' => 'image'])); ?>" src="<?php echo e(getImage($value[$child_item['name'] ?? ''][$j] ?? '')); ?>" alt="" id="<?php echo e($image_name ?? ''); ?>">
																		<button type="button" data-image="<?php echo e(route('media.index', [
															                'uploads' => 'direct',
															                'field_id' => $image_name ?? '',
															                'only' => 'image'
															            ])); ?>" class="add-image" title="<?php echo e($child_item['size'] ?? ''); ?>"><i class="fas fa-image"></i></button>
																		<button type="button" class="remove-image"><i class="fas fa-times"></i></button>
																	</div>
														        <?php break; ?>

																<?php case ('text'): ?>
																	<input class="table-form__control" type="text" name="<?php echo e($name ?? ''); ?>[<?php echo e($child_item['name'] ?? ''); ?>][]" placeholder="<?php echo app('translator')->get($child_item['placeholder'] ?? ''); ?>" value="<?php echo e($value[$child_item['name'] ?? ''][$j] ?? ''); ?>">
																<?php break; ?>

																<?php case ('textarea'): ?>
																	<textarea class="table-form__control" name="<?php echo e($name ?? ''); ?>[<?php echo e($child_item['name'] ?? ''); ?>][]" placeholder="<?php echo app('translator')->get($child_item['placeholder'] ?? ''); ?>"><?php echo e($value[$child_item['name'] ?? ''][$j] ?? ''); ?></textarea>
														        <?php break; ?>

															<?php endswitch; ?>
														<?php endfor; ?>
													<?php endif; ?>
												</td>
									        <?php break; ?>

										<?php endswitch; ?>
									<?php endfor; ?>
									<td class="table-form__table-action">
										<button type="button" class="bg-danger delete"><i class="fas fa-trash"></i></button>
										<span type="button" class="bg-default"><i class="fas fa-sort"></i></span>
									</td>
								</tr>
							<?php endfor; ?>
						<?php endif; ?>
					<?php endif; ?>
					<tr class="thead">
						<?php if(isset($has_full) && $has_full == false): ?>
							<td colspan="<?php echo e(count($generate ?? []) + 1); ?>"><button type="button" class="add add_<?php echo e($slug ?? ''); ?>"><i class="fas fa-plus"></i></button></td>
						<?php else: ?>
							
							<td colspan="<?php echo e(count($generate ?? [])+1); ?>"><button type="button" class="add add_<?php echo e($slug ?? ''); ?>"><i class="fas fa-plus"></i></button></td>
						<?php endif; ?>
					</tr>
				</tbody>
			</table>
		</div>
	<?php if($has_full == false): ?> 
        </div> 
    <?php endif; ?>
</div>
<script>
$(document).ready(function() {
	$('.table-form__table tbody').sortable();
	
	$('body').on('click', '.table-form__table .delete', function(e) {
		e.preventDefault();
        $(this).closest('tr').remove();
	});

	$('body').on('click', '.remove-image', function(e) {
		e.preventDefault();
		parent = $(this).closest('.custom-image');
		parent.find('input[type=hidden]').val('');
		parent.find('img').attr('src', '<?php echo e(getImage()); ?>');
	});

	$('body').on('click','.add_<?php echo e($slug ?? ''); ?>',function(e) {
		e.preventDefault();
		image_number = $(this).closest('.table-form__table').find('tbody').find('.table-form__table-image').length;
		html = `
			<tr>
				<?php if(isset($generate) && !empty($generate)): ?>
					<?php for($i = 0; $i < count($generate); $i++): ?>
						<?php switch($generate[$i]['type'] ?? ''):
							case ('image'): ?>
						        <td class="table-form__table-image">
									<div class="custom-image">
										<input type="hidden" name="<?php echo e($name ?? ''); ?>[<?php echo e($generate[$i]['name'] ?? ''); ?>][]" id="input-<?php echo e($slug.'_'.$generate[$i]['name']); ?>_${image_number}" value="">
										<img data-image="<?php echo e(route('media.index', [
											'uploads' => 'direct',
											'only' => 'image'
										])); ?>&field_id=<?php echo e($slug.'_'.$generate[$i]['name']); ?>_${image_number}" src="<?php echo e(getImage()); ?>" alt="" id="<?php echo e($slug.'_'.$generate[$i]['name']); ?>_${image_number}">
										<button type="button" data-image="<?php echo e(route('media.index', [
											'uploads' => 'direct',
											'only' => 'image'
										])); ?>&field_id=<?php echo e($slug.'_'.$generate[$i]['name']); ?>_${image_number}" class="add-image" title="<?php echo app('translator')->get($generate[$i]['size'] ?? ''); ?>"><i class="fas fa-image"></i></button>
										<button type="button" class="remove-image"><i class="fas fa-times"></i></button>
									</div>
									<p class="help-text"><?php echo app('translator')->get($generate[$i]['size'] ?? ''); ?></p>
								</td>
					        <?php break; ?>

							<?php case ('text'): ?>
								<td class="table-form__table-text">
									<input class="table-form__control" type="text" name="<?php echo e($name ?? ''); ?>[<?php echo e($generate[$i]['name'] ?? ''); ?>][]" placeholder="<?php echo app('translator')->get($generate[$i]['placeholder'] ?? ''); ?>" value="">
								</td>
							<?php break; ?>

							<?php case ('textarea'): ?>
								<td class="table-form__table-textarea">
									<textarea class="table-form__control" name="<?php echo e($name ?? ''); ?>[<?php echo e($generate[$i]['name'] ?? ''); ?>][]" placeholder="<?php echo app('translator')->get($generate[$i]['placeholder'] ?? ''); ?>"></textarea>
								</td>
					        <?php break; ?>

					        <?php case ('custom'): ?>
								<td class="table-form__table-custom">
									<?php if(isset($generate[$i]['generate']) && !empty($generate[$i]['generate'])): ?>
										<?php for($c = 0; $c < count($generate[$i]['generate']); $c++): ?>
											<?php
												$child_item = $generate[$i]['generate'][$c];
											?>
											<?php switch($child_item['type'] ?? ''):
												case ('image'): ?>
													<div class="custom-image">
														<input type="hidden" name="<?php echo e($name ?? ''); ?>[<?php echo e($child_item['name'] ?? ''); ?>][]" id="input-<?php echo e($slug.'_'.$child_item['name']); ?>_${image_number}" value="">
														<img src="<?php echo e(getImage()); ?>" alt="" id="<?php echo e($slug.'_'.$child_item['name']); ?>_${image_number}">
														<button type="button" data-image="<?php echo e(route('media.index', [
											                'uploads' => 'direct',
											                'only' => 'image'
											            ])); ?>&field_id=<?php echo e($slug.'_'.$child_item['name']); ?>_${image_number}" class="add-image" title="<?php echo e($child_item['size'] ?? ''); ?>"><i class="fas fa-image"></i></button>
														<button type="button" class="remove-image"><i class="fas fa-times"></i></button>
													</div>
										        <?php break; ?>

												<?php case ('text'): ?>
													<input class="table-form__control" type="text" name="<?php echo e($name ?? ''); ?>[<?php echo e($child_item['name'] ?? ''); ?>][]" placeholder="<?php echo app('translator')->get($child_item['placeholder'] ?? ''); ?>" value="">
												<?php break; ?>

												<?php case ('textarea'): ?>
													<textarea class="table-form__control" name="<?php echo e($name ?? ''); ?>[<?php echo e($child_item['name'] ?? ''); ?>][]" placeholder="<?php echo app('translator')->get($child_item['placeholder'] ?? ''); ?>"></textarea>
										        <?php break; ?>

											<?php endswitch; ?>
										<?php endfor; ?>
									<?php endif; ?>
								</td>
					        <?php break; ?>

						<?php endswitch; ?>
					<?php endfor; ?>
				<?php endif; ?>
				<td class="table-form__table-action">
					<button type="button" class="bg-danger delete"><i class="fas fa-trash"></i></button>
					<span type="button" class="bg-default"><i class="fas fa-sort"></i></span>
				</td>
			</tr>
		`;
		$(this).closest('table').find('tbody .thead').before(html);
		$('.table-form__table tbody').sortable();
	});
});
</script><?php /**PATH /var/home/packages/sudo-base/form/src/Providers/../../resources/views/custom/form_custom.blade.php ENDPATH**/ ?>