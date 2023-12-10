
	<title><?php echo e($meta_seo['title'] ?? ''); ?></title>
	

<?php if(!empty($meta_seo['description'])): ?>
	<meta name="description" content="<?php echo e($meta_seo['description'] ?? ''); ?>"/>
<?php endif; ?>


<?php if(isset($config_seo['robots']) && $config_seo['robots'] == '0'): ?>
	<meta name="robots" content="noindex,nofollow"/>
<?php elseif(isset($meta_seo['robots']) && !empty($meta_seo['robots'])): ?>
	<meta name="robots" content="<?php echo e($meta_seo['robots'] ?? ''); ?>"/>
<?php endif; ?>


<?php if(!empty($meta_seo['url'])): ?>
	<link rel="canonical" href="<?php echo e($meta_seo['url']); ?>" />
<?php endif; ?>


<?php if(isset($switch_language) && !empty($switch_language)): ?>
	<?php $__currentLoopData = $switch_language; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lang_key => $lang_link): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
		<link rel="alternate" hreflang="<?php echo e($lang_key ?? ''); ?>" href="<?php echo e($lang_link ?? ''); ?>">
	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php endif; ?>


<?php if(!empty($meta_seo['locale'])): ?>
	<meta property="og:locale" content="<?php echo e($meta_seo['locale']); ?>" />
<?php endif; ?>
	<meta property="og:site_name" content="<?php echo e(config('app.name')); ?>" />
	<meta property="og:type" content="<?php echo e($meta_seo['type'] ?? 'website'); ?>" />
<?php if(!empty($meta_seo['title'])): ?>
	<meta property="og:title" content="<?php echo e($meta_seo['title'] ?? ''); ?>" />
<?php endif; ?>
<?php if(!empty($meta_seo['description'])): ?>
	<meta property="og:description" content="<?php echo e($meta_seo['description']); ?>" />
<?php endif; ?>
<?php if(!empty($meta_seo['url'])): ?>
	<meta property="og:url" content="<?php echo e($meta_seo['url']); ?>" />
<?php endif; ?>
<?php if(!empty($meta_seo['image'])): ?>
	<meta property="og:image" content="<?php echo e($meta_seo['image']); ?>" />
<?php endif; ?>


	<meta name="twitter:card" content="summary_large_image">
<?php if(!empty($meta_seo['title'])): ?>
	<meta name="twitter:title" content="<?php echo e($meta_seo['title']); ?>">
<?php endif; ?>
<?php if(!empty($meta_seo['description'])): ?>
	<meta name="twitter:description" content="<?php echo e($meta_seo['description']); ?>">
<?php endif; ?>
<?php if(!empty($meta_seo['image'])): ?>
	<meta name="twitter:image" content="<?php echo e($meta_seo['image']); ?>" />
<?php endif; ?><?php /**PATH /var/home/themes/default/src/Providers/../../resources/views/general/layouts/seo.blade.php ENDPATH**/ ?>