<?php
App::booted(function() {
	$namespace = 'Sudo\Rss\Http\Controllers';

	Route::namespace($namespace)->name('web.')->group(function() {
        Route::get('rss','RssController@index');
	});
});
