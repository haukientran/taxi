<?php

namespace Sudo\Theme\Http\Controllers\Mobile;

use Illuminate\Http\Request;
use Sudo\Post\Models\Post;
use Sudo\School\Models\School;
use Sudo\StudyAbroad\Models\StudyAbroad;
use DB;
class HomeController extends Controller
{
	public function index(Request $request) {
		// Seo
		$setting_home = getOption('home');
		$meta_seo = metaSeo('', '', [
			'title' => $setting_home['meta_title'] ?? 'Trang chủ',
			'description' => $setting_home['meta_description'] ?? 'Mô tả trang chủ',
			'image' => $setting_home['meta_image'] ?? getImage(),
		]);
		$slides = DB::table('slides')->where('status', 1)->orderBy('orders', 'asc')->get();
		$admin_bar = route('admin.settings.home');

		$posts = Post::with(['postCategoryMap.category'])
		    ->select('posts.*')
		    ->leftJoin('pins', function ($join) {
		        $join->on('pins.type_id','=','posts.id');
		        $join->on('pins.type',DB::raw("'posts'"));
		        $join->on('pins.place',DB::raw("'home'"));
		    })
		    ->addSelect(DB::raw('(case when pins.value is null then 2147483647 else pins.value end) as pin_home'))
		    ->where('status', 1)
		    ->where('pins.place', 'home')
		    ->orderBy('pin_home', 'ASC')
		    ->limit(8)
		    ->get();
		if(!isset($posts) || count($posts) == 0) {
			$posts = Post::with(['postCategoryMap.category'])
			    ->select('posts.*')
			    ->orderBy('id', 'desc')
			    ->limit(6)
			    ->get();
		}

        $arboards = StudyAbroad::where('status', 1)
		    ->select('study_abroads.*')
        	->leftJoin('pins', function ($join) {
		        $join->on('pins.type_id','=','study_abroads.id');
		        $join->on('pins.type',DB::raw("'study_abroads'"));
		        $join->on('pins.place',DB::raw("'category_study_abroad'"));
		    })
		    ->addSelect(DB::raw('(case when pins.value is null then 2147483647 else pins.value end) as pin_home'))
		    ->where('status', 1)
		    ->where('pins.place', 'category_study_abroad')
		    ->orderBy('pin_home', 'ASC')
			->paginate(6);

		if(!isset($arboards) || count($arboards) == 0) {
			$arboards = StudyAbroad::select('study_abroads.*')
			    ->orderBy('id', 'desc')
			    ->paginate(6);
		}
		if($request->ajax()) {
            $page = $request->page ?? 0;
            $html =view('Default::mobile.layouts.nation_list',['arboards' => $arboards])->render();
            return [
                'status' => 1,
                'is_hide_more'=> $arboards->currentPage() >= $arboards->lastPage(),
                'html' => $html,
            ];
        }

		return view('Default::mobile.home', compact(
			'meta_seo', 'admin_bar','slides', 'setting_home', 'posts', 'arboards'
		));
	}

	public function search(Request $request)
	{
	// dd($request->all());
		$url = \Request::fullUrl();
        $key_format = formatKeyword(str_replace(["'", '"'], [''], $request->key ?? ''));

        $key = $key_format['key'];
        $keyword_search = $key_format['keyword'];
		$paginate = 12;

		$breadcrumb = [
			[
				'name'=> 'Tìm kiếm ',
				'link'=> ''
			]
		];
		$meta_seo = metaSeo('search', 0, [
			'title' => 'Kết quả tìm kiếm ' . $keyword_search,
			'description' => '',
			'url' =>  '',
			'image' =>  ''
		]);
		$count = 0;
		$study_abroad =  StudyAbroad::where('status', 1)->searchByName($keyword_search)->get();
		if($study_abroad) {
			$count = count($study_abroad);
		}
        $study_abroads = StudyAbroad::where('status', 1)->searchByName($keyword_search)->paginate($paginate);

		return view('Default::mobile.pages.search', compact(
			'breadcrumb',
			'study_abroads',
			'count',
			'meta_seo',
			'keyword_search',
		));
	}
}
