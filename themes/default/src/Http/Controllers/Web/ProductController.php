<?php

namespace Sudo\Theme\Http\Controllers\Web;

use Illuminate\Http\Request;

class ProductController extends Controller
{
	public function index($slug)
    {

	}

	public function show($slug)
    {
		$setting_home = getOption('home');
		$meta_seo = metaSeo('', '', [
			'title' => $setting_home['meta_title'] ?? 'Trang chủ',
			'description' => $setting_home['meta_description'] ?? 'Mô tả trang chủ',
			'image' => $setting_home['meta_image'] ?? getImage(),
		]);
		$admin_bar = route('admin.settings.home');
		return view('Default::web.products.show', compact(
			'meta_seo',
            'admin_bar'
		));
	}
}