<?php

namespace Sudo\Theme\Http\Controllers\Web;

use Illuminate\Http\Request;
use DB;

class HomeController extends Controller
{
	public function index() {

		getimagesize('https://sudospaces.com/karofi-com/2020/04/quat-dieu-hoa-karofi-kac-18r.png');
		// Seo
		$setting_home = getOption('home');
		$meta_seo = metaSeo('', '', [
			'title' => $setting_home['meta_title'] ?? 'Trang chủ',
			'description' => $setting_home['meta_description'] ?? 'Mô tả trang chủ',
			'image' => $setting_home['meta_image'] ?? getImage(),
		]);
		$slides = DB::table('slides')->where('status', 1)->orderBy('orders', 'asc')->get();
		$admin_bar = route('admin.settings.home');
		return view('Default::web.home', compact(
			'meta_seo', 'admin_bar','slides'
		));
	}
}
