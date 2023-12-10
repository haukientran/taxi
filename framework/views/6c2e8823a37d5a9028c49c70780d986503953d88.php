<?php if(Auth::guard('admin')->check()): ?>
    <div class="adminbar">
    	<style type="text/css">.adminbar {width: 100%;float: left;clear: both;background: #252627;color: #fff;font-family: 'arial', 'Sans-serif';}.adminbar-wrap {padding: 0 10px;}.adminbar-wrap ul {list-style: none;}.adminbar-wrap ul li {font-size: 13px;line-height: 32px;float: left;margin-right: 20px;font-weight: bold;}.adminbar-wrap ul li a {display: block;color: #ffffff;text-decoration: none;}</style>
    	<div class="container wrap adminbar-wrap">
	    	<ul>
	    		<li><a href="<?php echo route('admin.home'); ?>"><?php echo app('translator')->get('Trang quản trị'); ?></a></li>
	    		
	    		<?php if(isset($admin_bar) && $admin_bar != ''): ?>
	    			<li><a href="<?php echo $admin_bar; ?>">&#9998; <?php echo app('translator')->get('Sửa nội dung này'); ?></a></li>
	            <?php endif; ?>
	    	</ul>
    	</div>
    </div>
    <div style="clear: both;"></div>
<?php endif; ?><?php /**PATH /var/home/themes/default/src/Providers/../../resources/views/general/layouts/adminbar.blade.php ENDPATH**/ ?>