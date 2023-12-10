<?php

namespace Sudo\Theme\Http\Controllers\Web;
use App\Http\Controllers\Controller as BaseController;
use Illuminate\Http\Request;

class Controller extends BaseController
{

	function __construct() {

		$this->middleware(function ($request, $next) {
			setLanguage(\Session::get('locale'));
			// Cache cấu hình general
	        $config_general = getOption('general');
	        \View::share('config_general',$config_general);

	        // cache menu 
	        $config_menu = getOption('menu');
	        \View::share('config_menu',$config_menu);

	        // cache mã chuyển đổi
	        $config_code = getOption('code');
	        \View::share('config_code',$config_code);

	        return $next($request);
		});
	}
}