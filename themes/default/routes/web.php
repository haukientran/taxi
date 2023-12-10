<?php
App::booted(function() {

	$namespace = 'Sudo\Theme\Http\Controllers\Web';
	Route::namespace($namespace)->name('app.')->middleware(['web'])->group(function() {
		Route::get('/test', 'TestController@index')->name('test');
		// Trang chủ
		Route::get('/', 'HomeController@index')->name('home');
		// Trang đơn
		Route::get('/page/{slug}.html', 'PageController@show')->name('pages.show');
		// Tin tức
		Route::get('/blog/{slug}.html', 'PostController@show')->name('posts.show');
		// Danh mục tin tức
		Route::get('/blog/{slug?}', 'PostController@index')->name('post_categories.index');
		// chi tiết sản phẩm
		Route::get('{slug}.html', 'ProductController@show')->name('products.show');
		// danh mục sản phẩm
		Route::get('/{slug1?}/{slug2?}/{slug3?}','PostController@index')->name('product_categories.index');
	});
});