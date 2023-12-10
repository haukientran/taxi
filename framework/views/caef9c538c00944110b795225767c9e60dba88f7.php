<?php
	$seo_title = '';
    $seo_description = '';
    $seo_robots = 'Index,Follow';
    $social_title = '';
    $social_description = '';
    $social_image = '';
	if (isset($type) && isset($type_id)) {
		$seo = \DB::table('seos')->where('type', $type)->where('type_id', $type_id)->first();
		$seo_title = $seo->title??'';
	    $seo_description = $seo->description??'';
	    $seo_robots = $seo->robots??'Index,Follow';
	    $social_title = $seo->social_title??'';
	    $social_description = $seo->social_description??'';
	    $social_image = $seo->social_image??'';
	}
?>
<div class="row">
	<div class="col-lg-6">
		<div class="card">
			<div class="card-body">
				<h4 class="card-title"><?php echo app('translator')->get('Translate::form.metaseo.title_card'); ?></h4>
		        <div class="row tab-seo">
					<div class="col-lg-12">
						<ul class="tab-list">
							<li class="tabseo-list__item active" data-active="google">SEO Google</li>
							<li class="tabseo-list__item" data-active="social"><?php echo app('translator')->get('Translate::form.metaseo.social'); ?></li>
						</ul>
						<div class="tab-content tab-content__google">
							<div class="mb-3">
						        <label style="margin: 0">Meta title</label>
						        <span class="helper"><span class="count_word">0</span> <?php echo app('translator')->get('Translate::form.metaseo.meta_title_desc'); ?></span>
				                <input type="text" class="form-control" data-check_length data-review="meta_title" name="meta_title" id="meta_title" placeholder="" value="<?php echo $seo_title; ?>">
				            </div>
				            <div class="mb-3">
						        <label style="margin: 0">Meta Description</label>
						        <span class="helper"><span class="count_word">0</span> <?php echo app('translator')->get('Translate::form.metaseo.meta_description_desc'); ?></span>
					            <textarea class="form-control" data-check_length data-review="meta_description" name="meta_description" id="meta_description" placeholder="" rows="3"><?php echo $seo_description; ?></textarea>
					        </div>
					        <div class="mb-3 ">
						        <label>Meta Robots</label>
						        <?php
									$option_seo_robots = [
										'Index,Follow' 		=> 'Index,Follow',
										'Noindex,Nofollow' 	=> 'Noindex,Nofollow',
										'Index,Nofollow' 	=> 'Index,Nofollow',
										'Noindex,Follow' 	=> 'Noindex,Follow',
									];
								?>
								<select id="meta_robots" name="meta_robots" class="form-control form-select">
									<?php $__currentLoopData = $option_seo_robots; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $robots): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					                	<option value="<?php echo $key; ?>"
											<?php if($key == $seo_robots): ?> selected <?php endif; ?>
					                	><?php echo $robots; ?></option>
									<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					            </select>
					        </div>
						</div>
						<div class="tab-content tab-content__social">
							<?php echo $__env->make('Form::base.image', [
					        	'name'				=> 'social_image',
								'value' 			=> $social_image,
								'required' 			=> 0,
								'label' 			=> 'Social Image',
								'title_btn' 		=> 'Chọn ảnh',
								'has_row' 			=> false,
								'class_col' 		=> 'col-lg-12',
					        ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
							<div class="mb-3">
						        <label style="margin: 0">Social Title</label>
						        <span class="helper"><?php echo app('translator')->get('Translate::form.metaseo.social_title_desc'); ?></span>
				                <input type="text" class="form-control" name="social_title" id="social_title" placeholder="" value="<?php echo $social_title; ?>">
				            </div>
				            <div class="mb-3">
						        <label style="margin: 0">Social Description</label>
						        <span class="helper"><?php echo app('translator')->get('Translate::form.metaseo.social_description_desc'); ?></span>
					            <textarea class="form-control" name="social_description" id="social_description" placeholder="" rows="3"><?php echo $social_description; ?></textarea>
					        </div>
						</div>
				    </div>
				</div>
			</div>
		</div>

	</div>
	<?php if(!isset($hide_review)): ?>
		<?php
			$seo_prefix_url = config('app.seo_prefix_url')[$table_name] ?? [];
			$seo_html = $seo_prefix_url['html'] ?? false;
		?>
	<div class="col-lg-6">
		<div class="card">
			<div class="card-body">
				<h4 class="card-title"><?php echo app('translator')->get('Translate::form.metaseo.preview'); ?></h4>
				<p class="card-title-desc" style="margin-bottom: 15px;"><?php echo app('translator')->get('Translate::form.metaseo.content_preview'); ?></p>
				<div class="preview_snippet_main row">
		            <h3 class="preview_snippet_title"></h3>
		            <p class="preview_snippet_link"><?php echo $seo_prefix_url['url'] ?? config('app.url'); ?>/<span></span>
		            	<?php if($seo_html): ?>.html &nbsp;&nbsp;&nbsp; <?php endif; ?>
			            <a class="btn btn-xs btn-warning" href="#slug"><?php echo app('translator')->get('Translate::form.metaseo.edit_slug'); ?></a>
			        </p>
		            <p class="preview_snippet_des"></p>
		        </div>
			</div>
		</div>
	</div>
	<?php endif; ?>
</div>
<script>
	$(document).ready(function(){
        var class_active = $('.tabseo-list__item.active').data('active');
        $('.tab-seo .tab-content').removeClass('active');
        $('.tab-seo .tab-content__'+class_active).addClass('active');
        
        $('.tabseo-list__item').on('click', function(){
            var class_active = $(this).data('active');
            $('.tabseo-list__item').removeClass('active');
            $(this).addClass('active');
            $('.tab-seo .tab-content').removeClass('active');
            $('.tab-seo .tab-content__'+class_active).addClass('active');
        });
    });
	$(document).ready(function() {
		$('body').on('keyup change', '*[data-check_length]', function(){
			value = $(this).val();
			length = value.length;
			$(this).closest('.mb-3').find('.count_word').html(length);

			var data_review = $(this).data('review');
			if(data_review == 'meta_title'){
				$('.preview_snippet_title').html(value);
			}else{
				$('.preview_snippet_des').html(value);
			}
		});
		if($('.preview_snippet_link').length && $('#slug').length) {
	        setInterval(function(){ 
	            $slug = $('#slug').val();
	            $('.preview_snippet_link span').html($slug);
	        }, 2000);
	    }
		$('*[data-check_length]').keyup();
	});
</script><?php /**PATH /var/home/packages/sudo-base/form/src/Providers/../../resources/views/metaseo.blade.php ENDPATH**/ ?>