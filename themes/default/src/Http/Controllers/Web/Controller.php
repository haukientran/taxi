<?php

namespace Sudo\Theme\Http\Controllers\Web;
use App\Http\Controllers\Controller as BaseController;
use Illuminate\Http\Request;

class Controller extends BaseController
{

	function __construct() {

        \Asset::addScript(['jquery','general']);
		$this->middleware(function ($request, $next) {
			setLanguage(\Session::get('locale'));
			// Cache cấu hình general
	        $config_general = getOption('general');
	        \View::share('config_general',$config_general);

            // Cache cấu hình du hoc
		    $config_study_abroad = getOption('study_abroad_category');
	        \View::share('config_study_abroad',$config_study_abroad);
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
