<?php

namespace Sudo\Theme\Http\Controllers\Mobile;

use Illuminate\Http\Request;
use Sudo\Personnel\Models\Personnel;
use Sudo\Post\Models\Post;

class PersonnelController extends Controller
{

	public function index() {
		$config_personnel = getOption('personnel');
		$meta_seo = metaSeo('', '', [
			'title' => $config_personnel['meta_title'] ?? 'Nhân sự',
			'description' => $config_personnel['meta_description'] ?? 'Mô tả nhân sự',
			'image' => $config_personnel['meta_image'] ?? getImage(),
		]);
        $personnels = Personnel::select('personnels.*')
            ->where('status',1)
            ->get();
		return view('Default::mobile.personnel.index',compact('personnels', 'config_personnel'));
	}
    public function show($slug) {
		// cấu hình giới thiệu
		$personnel = Personnel::where('status',1)->where('slug', $slug)->first();

		$config_personnel = getOption('personnel');
		$paginate = 8;
		$meta_seo = metaSeo('', '', [
			'title' => $config_personnel['meta_title'] ?? 'Trang giới thiệu',
			'description' => $config_personnel['meta_description'] ?? 'Mô tả Trang giới thiệu',
			'image' => $config_personnel['meta_image'] ?? getImage(),
		]);
        $slides = explode(',', $personnel->slide);
        //bài viết nổi bật
        $post_news = Post::where('status', 1)->orderBy('id','desc')->limit(6)->get();
        $admin_bar = route('admin.personnels.edit', $personnel->id);
		return view('Default::mobile.personnel.show',compact('personnel', 'slides', 'admin_bar', 'post_news', 'config_personnel'));
	}
}
