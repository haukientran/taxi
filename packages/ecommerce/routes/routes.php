<?php
App::booted(function() {
	$namespace = 'Sudo\Ecommerce\Http\Controllers';
	
	Route::namespace($namespace)->name('admin.')->prefix(config('app.admin_dir'))->middleware(['web', 'auth-admin', '2fa'])->group(function() {
		// Sản phẩm
		Route::resource('products', 'ProductController');
		Route::post('products/get-attribute-details', 'ProductController@getAttributeDetail');
		Route::post('products/add-more-attributes', 'ProductController@addMoreAttributes');
		Route::post('products/edit-attributes', 'ProductController@editAttributes');
		Route::post('products/add-variant', 'ProductController@addVariant');
		Route::post('products/remove-variant', 'ProductController@removeVariant');
		Route::post('products/show-popup-edit-variant', 'ProductController@showPopupEditVariant');
		Route::post('products/show-popup-add-variant', 'ProductController@showPopupAddVariant');
		// Danh mục sản phẩm
		Route::resource('product_categories', 'ProductCategoryController');
		// Thuộc tính sản phẩm
		Route::resource('attributes', 'AttributeController');
		// Thương hiệu
		Route::resource('brands', 'BrandController');
		// Đơn hàng
		Route::resource('orders', 'OrderController');
		// Khách hàng
		Route::resource('customers', 'CustomerController');
		// Vận chuyển
		Route::resource('shippings', 'ShippingController');
		Route::post('shippings/region/create', 'ShippingController@createRegion')->name('shipping.region_create');
		Route::post('shippings/region/remove', 'ShippingController@removeRegion')->name('shipping.region_remove');
		Route::post('shippings/shipping-rule/create', 'ShippingController@createShippingRule');
		Route::post('shippings/shipping-rule/update', 'ShippingController@updateShippingRule');
		Route::post('shippings/shipping-rule/remove', 'ShippingController@removeShippingRule');
		// Thuế
		Route::resource('taxes', 'TaxeController');

		Route::post('orders/ajax/sugget-customers', 'OrderController@suggetCustomers');

		Route::get('orders/{order_id}/comfirm-payment', 'OrderController@confirmPayment')->name('orders.confirmPayment');
		Route::get('orders/{order_id}/refund', 'OrderController@refund')->name('orders.refund');

		Route::post('orders/{order_id}/admin_note', 'OrderController@adminNote')->name('orders.admin_note');
		Route::get('orders/{order_id}/accepts', 'OrderController@accepts')->name('orders.accepts');
		Route::get('orders/{order_id}/success', 'OrderController@success')->name('orders.success');
		Route::get('orders/{order_id}/denined', 'OrderController@denined')->name('orders.denined');
		Route::get('orders/embed_history/{order_history_id}', 'OrderController@embedHistory')->name('orders.embed_history');
		Route::get('orders/download-invoice/{order_id}', 'OrderController@downloadInvoice')->name('orders.download_invoice');
		// Tìm kiếm tại bảng
		Route::post('orders/suggest_products', 'OrderController@suggestProducts')->name('ajax.suggest_products');
		// Bộ lọc
		if (config('SudoProduct.filters') == true) {
			Route::resource('filters', 'FilterController');
			Route::post('/ajax/get_product_filters', 'ProductController@getFilter')->name('products.filters');
		}
	});
});