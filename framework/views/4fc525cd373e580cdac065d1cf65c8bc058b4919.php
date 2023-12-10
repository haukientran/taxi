<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>TuboCMS Media Package</title>
	<meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
	<!-- Style -->
	<link rel="stylesheet" href="<?php echo e(asset('platforms/media/libs/font-awesome/css/font-awesome.min.css')); ?>">
	<link rel="stylesheet" href="<?php echo e(asset('platforms/media/libs/modal/bootstrap.min.css')); ?>">
	<link rel="stylesheet" href="<?php echo e(asset('platforms/media/css/custom.min.css')); ?>">
	<!-- Script -->
	<script type="text/javascript" src="<?php echo e(asset('platforms/media/libs/js/jquery.min.js')); ?>"></script>
	<script type="text/javascript" src="<?php echo e(asset('platforms/media/libs/modal/bootstrap.min.js')); ?>"></script>
	<script type="text/javascript" src="<?php echo e(asset('platforms/media/js/functions.min.js')); ?>"></script>
</head>
<body data-theme="light">
	<script>setTheme();</script>

	<input type="file" multiple="true" name="file[]" id="file" accept="image/*,.pdf,.xlsx,.xls">
	<div class="media">
		<div class="media-header">
			<div class="media-header__top">
				<div class="media-header__top-action">
					<label for="file" class="btn btn-media btn-active">
						<i class="fa fa-cloud-upload"></i> <?php echo trans('Translate::media.upload_file'); ?>

					</label>
					<button type="button" class="btn btn-media" data-reload>
						<i class="fa fa-repeat"></i> <?php echo trans('Translate::media.refresh'); ?>

					</button>
				</div>
				<div class="media-header__top-search">
					<input type="text" name="keyword" placeholder="<?php echo trans('Translate::media.search'); ?>">
					<button type="button" data-search_btn><i class="fa fa-search"></i></button>
				</div>
			</div>
			<div class="media-header__breadcrumbs">
				<div class="media-header__breadcrumbs-title">
					<p><i class="fa fa-user-secret"></i> <?php echo trans('Translate::media.all_file'); ?></p>
				</div>
				<div class="media-header__breadcrumbs-filter">
					<?php if(!Request()->only): ?>
					<div class="dropdown" data-dropdown_box>
						<button type="button" class="btn btn-media" data-dropdown_btn><?php echo trans('Translate::media.file_type'); ?></button>
						<ul class="dropdown-list" data-dropdown_item>
							<li><a href="javascript:;" data-type="type" data-value="default" 
								<?php if(isset(Request()->type) && Request()->type == 'default'): ?> class="active"  <?php endif; ?>
							><?php echo trans('Translate::media.all'); ?></a></li>
							<li><a href="javascript:;" data-type="type" data-value="image" 
								<?php if(isset(Request()->type) && Request()->type == 'image'): ?> class="active"  <?php endif; ?>
							><?php echo trans('Translate::media.image'); ?></a></li>
							<li><a href="javascript:;" data-type="type" data-value="file" 
								<?php if(isset(Request()->type) && Request()->type == 'file'): ?> class="active"  <?php endif; ?>
							><?php echo trans('Translate::media.file'); ?></a></li>
						</ul>
					</div>
					<?php endif; ?>
					<div class="dropdown" data-dropdown_box>
						<button type="button" class="btn btn-media" data-dropdown_btn><?php echo trans('Translate::media.sort_by'); ?></button>
						<ul class="dropdown-list" data-dropdown_item>
							<li><a href="javascript:;" data-type="filter" data-value="default" 
								<?php if(isset(Request()->filter) && Request()->filter == 'default'): ?> class="active"  <?php endif; ?>
							><?php echo trans('Translate::media.default'); ?></a></li>
							<li><a href="javascript:;" data-type="filter" data-value="name-asc" 
								<?php if(isset(Request()->filter) && Request()->filter == 'name-asc'): ?> class="active"  <?php endif; ?>
							><?php echo trans('Translate::media.file_name'); ?> - ASC</a></li>
							<li><a href="javascript:;" data-type="filter" data-value="name-desc" 
								<?php if(isset(Request()->filter) && Request()->filter == 'name-desc'): ?> class="active"  <?php endif; ?>
							><?php echo trans('Translate::media.file_name'); ?> - DESC</a></li>
							<li><a href="javascript:;" data-type="filter" data-value="created_at-asc" 
								<?php if(isset(Request()->filter) && Request()->filter == 'created_at-asc'): ?> class="active"  <?php endif; ?>
							><?php echo trans('Translate::media.created_at'); ?> - ASC</a></li>
							<li><a href="javascript:;" data-type="filter" data-value="created_at-desc" 
								<?php if(isset(Request()->filter) && Request()->filter == 'created_at-desc'): ?> class="active"  <?php endif; ?>
							><?php echo trans('Translate::media.created_at'); ?> - DESC</a></li>
							<li><a href="javascript:;" data-type="filter" data-value="size-asc" 
								<?php if(isset(Request()->filter) && Request()->filter == 'size-asc'): ?> class="active"  <?php endif; ?>
							><?php echo trans('Translate::media.text_size'); ?> - ASC</a></li>
							<li><a href="javascript:;" data-type="filter" data-value="size-desc" 
								<?php if(isset(Request()->filter) && Request()->filter == 'size-desc'): ?> class="active"  <?php endif; ?>
							><?php echo trans('Translate::media.text_size'); ?> - DESC</a></li>
						</ul>
					</div>
					<div class="dropdown">
						<button type="button" class="btn btn-media" data-toggle_theme><i class="fa fa-sun-o"></i></button>
					</div>
					<div class="media-header__breadcrumbs-filter__view">
						<button type="button" data-view_type="burger"><i class="fa fa-th-large"></i></button>
						<button type="button" data-view_type="list"><i class="fa fa-th-list"></i></button>
					</div>
				</div>
			</div>
		</div>
		<div class="media-content">
			<div class="media-content__main">
				<div class="media-content__main-list burger">
					<script>setViewImage();</script>
					<?php echo $__env->make('media::media-item',['data' => $medias], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
				</div>
				<div class="media-content__main-pagination pagination-sm">
					<?php if(isset($medias) && !empty($medias)): ?>
						<?php echo $medias->appends(Request()->all())->links(); ?>

					<?php endif; ?>
				</div>
				<div class="media-content__main-detail">
					<div class="media-content__main-detail__thumb">
						<i class="fa fa-image"></i>
					</div>
					<div class="media-content__main-detail__desc">
						<p><?php echo trans('Translate::media.no_choose_image'); ?></p>
					</div>
				</div>
			</div>
		</div>
		<?php if(isset(Request()->field_id) && Request()->field_id != ''): ?>
			<div class="media-footer">
				<button type="button" class="btn-insert" data-insert><?php echo trans('Translate::media.insert'); ?></button>
			</div>
		<?php endif; ?>
	</div>

	<section id="loading-box"><div id="loading-box__image"></div></section>
	
	<div class="modal fade" id="modal-comfirm">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title"></h4>
				</div>
				<div class="modal-body"></div>
				<div class="modal-footer"></div>
			</div>
		</div>
	</div>
	<script>
		no_choose_image 			= "<?php echo trans('Translate::media.no_choose_image'); ?>";
		text_updated 				= "<?php echo trans('Translate::media.text_updated'); ?>";
		text_created 				= "<?php echo trans('Translate::media.text_created'); ?>";
		text_size 					= "<?php echo trans('Translate::media.text_size'); ?>";
		text_title 					= "<?php echo trans('Translate::media.text_title'); ?>";
		text_desc 					= "<?php echo trans('Translate::media.text_desc'); ?>";
		text_delete 				= "<?php echo trans('Translate::media.text_delete'); ?>";
		text_no 					= "<?php echo trans('Translate::media.text_no'); ?>";
		max_size_file 				= <?php echo e((int)config('SudoMedia.allowed_size')); ?>; // 2MB
		upload 						= '<?php echo trans('Translate::media.upload'); ?>'; // Text Model Title
		upload_close 				= '<?php echo trans('Translate::media.upload_close'); ?>'; // Text Model Button Close
		upload_size_fail 			= '<?php echo trans('Translate::media.upload_size_fail'); ?>'; // Text Model Title
		upload_ext_fail 			= '<?php echo trans('Translate::media.upload_ext_fail'); ?>'; // Text Model Title
		uploading 					= "<?php echo trans('Translate::media.uploading'); ?>";
		delete_title 				= "<?php echo trans('Translate::media.delete_title'); ?>";
		delete_comfirm				= "<?php echo trans('Translate::media.delete_comfirm'); ?>";
		update_title				= "<?php echo trans('Translate::media.update_title'); ?>";
		update_success				= "<?php echo trans('Translate::media.update_success'); ?>";
		no_image 					= "<?php echo trans('Translate::media.no_image'); ?>";
		text_save 					= "<?php echo trans('Translate::media.text_save'); ?>";
		allowed_extension_image 	= "<?php echo e(implode(',', config('SudoMedia.allowed_extension_image') )); ?>";
		allowed_extension_file 		= "<?php echo e(implode(',', config('SudoMedia.allowed_extension_file') )); ?>";
	</script>
	<script type="text/javascript" src="<?php echo e(asset('platforms/media/js/main.min.js')); ?>"></script>
	<script type="text/javascript" src="<?php echo e(asset('platforms/media/js/actions.min.js')); ?>"></script>
</body>
</html><?php /**PATH /var/home/packages/sudo-base/media/src/Providers/../../resources/views/index.blade.php ENDPATH**/ ?>