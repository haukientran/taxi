<?php
App::booted(function() {

	$namespace = 'Sudo\Theme\Http\Controllers\Mobile';
	Route::namespace($namespace)->name('mobile.')->middleware(['web'])->group(function() {
		// Tìm kiếm
		Route::match(['GET', 'POST'], '/tim-kiem', 'HomeController@search')->name('search');
		// Trang chủ
		Route::match(['GET', 'POST'], '/', 'HomeController@index')->name('home');
        // Trang đơn
		Route::get('/trang/{slug}.html', 'PageController@show')->name('pages.show');
        // Trang giới thiệu
		Route::get('/gioi-thieu', 'PageController@introduce')->name('pages.introduce');
        // Trang nhân sự
		Route::get('/nhan-su', 'PersonnelController@index')->name('personnels');
        // Trang nhân sự chi tiet
		Route::get('/nhan-su/{id}', 'PersonnelController@show')->name('personnels.show');
		// Trang đơn
		Route::get('/page/{slug}.html', 'PageController@show')->name('pages.show');
        // Trang tìm kiếm trường học
        Route::match(['GET', 'POST'], '/tim-truong', 'SchoolController@search_school')->name('search_school');
		// Tin tức
		Route::get('/tin-tuc/{slug}.html', 'PostController@show')->name('posts.show');
		// Danh mục tin tức
		Route::match(['GET', 'POST'], '/tin-tuc/{slug?}','PostController@index')->name('post_categories.index');
		// chi tiết Du học
		Route::get('/du-hoc/{slug}.html', 'StudyAbroadController@show')->name('study_abroads.show');
        // Danh mục du học
		Route::match(['GET', 'POST'], '/du-hoc/{slug?}', 'StudyAbroadController@index')->name('study_abroad_categories.index');
		//lien-he
		Route::match(['GET', 'POST'], '/lien-he','PageController@contact')->name('contact');
        // tac gia
        Route::match(['GET', 'POST'], '/tac-gia/{slug?}','PageController@admin_users')->name('admin_users.show');

		// danh mục sản phẩm
		Route::get('/{slug1?}/{slug2?}/{slug3?}','PostController@index')->name('product_categories.index');
		//ajax
		Route::name('ajax.')->prefix('ajax')->group(function() {
	        Route::post('send_form', 'AjaxController@sendForm')->name('sendForm');
	        Route::post('search-category', 'AjaxController@searchCategory')->name('searchCategory');
	        Route::post('search-keyword', 'AjaxController@searchKeyword')->name('searchKeyword');
	    });
	});


});
