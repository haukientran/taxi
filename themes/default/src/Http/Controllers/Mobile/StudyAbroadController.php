<?php

namespace Sudo\Theme\Http\Controllers\Mobile;

use Illuminate\Http\Request;
use Sudo\StudyAbroad\Models\StudyAbroad;
use Sudo\StudyAbroad\Models\StudyAbroadCategory;
use Sudo\Personnel\Models\Personnel;
use DB;
class StudyAbroadController extends Controller
{
    public static function index(Request $request, $slug=null) {
        $url = \Request::url();
		$config_study_abroad = getOption('study_abroad_category');
		$paginate = 10;
        $study_abroad_news = StudyAbroad::select('study_abroads.*')
            ->join('pins', 'study_abroads.id', 'pins.type_id')
            ->where('pins.place', 'category_study_abroad')
            ->where('pins.type', 'study_abroads')
            ->where('pins.value', '<>', '')
            ->orderBy('pins.value', 'ASC')
            ->where('status',1)
            ->limit(8)
            ->get();
		if($slug != null) {
			$category = StudyAbroadCategory::where('slug', $slug)->where('status',1)->firstOrFail();
			$meta_seo = metaSeo('study_abroad_categories', $category->id, [
				'title' => $category->name ?? 'Tin tức',
				'description' => cutString(removeHTML($category->detail ?? ''), 160),
				'image' => $category->getImage(),
				'url' => $category->getUrl('mobile'),
				'robots' => 'Index,Follow',
			]);
            $study_abroads_cate = StudyAbroad::with(['studyAbroadCategoryMap.category'])
				->join('study_abroad_category_maps', 'study_abroad_category_maps.study_abroad_id', 'study_abroads.id')
				->whereIn('study_abroad_category_maps.study_abroad_category_id', $category->childId($category->id))
				->where('study_abroads.status', 1)
				->select('study_abroads.*')
				->distinct('study_abroads.id')
				->orderBy('id', 'desc');
			$count_study_abroad = $study_abroads_cate->count();
			$study_abroads = $study_abroads_cate->paginate($paginate);
            if($request->ajax()) {
                $posts = $study_abroads;
                $html = view('Default::mobile.post.listdata', compact('posts'))->render();
                $pagination = $study_abroads->appends(Request()->all())->links('Default::general.layouts.paginate')->toHtml();
                return [
                    'html' => $html,
                    'pagination' => $pagination,
                    'status' => 1
                ];
            }
			$breadcrumb = [
				[
					'link' => route('mobile.study_abroad_categories.index'),
					'name' => 'Du học'
				],
				[
					'link' => $category->getUrl('mobile'),
					'name' => $category->name ?? ''
				],
			];
			return view('Default::mobile.study_abroad.index',compact('meta_seo','config_study_abroad', 'breadcrumb','study_abroad_news', 'study_abroads', 'url'));
		}else {
			$meta_seo = metaSeo('', '', [
				'title' => $config_study_abroad['meta_title'] ?? 'Du học',
				'description' => $config_study_abroad['meta_description'] ?? 'Danh mục Du học',
				'image' => getImage($config_study_abroad['meta_image'] ?? ''),
				'url' => route('mobile.study_abroad_categories.index'),
				'robots' => 'Index,Follow',
			]);
            $study_abroads_cate = StudyAbroad::with(['studyAbroadCategoryMap.category'])
				->where('study_abroads.status', 1)
				->orderBy('id', 'desc');
			$count_study_abroad = $study_abroads_cate->count();
			$study_abroads = $study_abroads_cate->paginate($paginate);
            if($request->ajax()) {
                $posts = $study_abroads;
                $html = view('Default::mobile.post.listdata', compact('posts'))->render();
                $pagination = $study_abroads->appends(Request()->all())->links('Default::general.layouts.paginate')->toHtml();
                return [
                    'html' => $html,
                    'pagination' => $pagination,
                    'status' => 1
                ];
            }
			$breadcrumb = [
				[
					'link' => route('mobile.study_abroad_categories.index'),
					'name' => 'Du học'
				],
			];
			return view('Default::mobile.study_abroad.index',compact('meta_seo','config_study_abroad', 'breadcrumb','study_abroad_news', 'study_abroads', 'url'));
		}
	}

	public function show($slug) {
        $study_abroad = StudyAbroad::where('status', 1)->where('slug', $slug)->firstOrFail();
        $meta_seo = metaSeo('study_abroads', $study_abroad->id, [
			'title' => $study_abroad->name ?? __('Tin tức'),
			'description' => cutString(removeHTML($study_abroad->detail ?? ''), 160) ?? __('Mô tả tin tức'),
			'image' => $study_abroad->getImage() ?? ''
		]);
        $breadcrumb = [
            [
                'link' => route('mobile.study_abroad_categories.index'),
                'name' => 'Bài viết'
            ],
            [
                'link' => $study_abroad->getUrl('mobile'),
                'name' => $study_abroad->name
            ],
        ];

		$admin_bar = route('admin.study_abroads.edit', $study_abroad->id);
        $feedback_images = $study_abroad->feedback_image !== null ? explode(',', $study_abroad->feedback_image) : [];
        $student_images = $study_abroad->student_image !== null ? explode(',', $study_abroad->student_image) : [];

        $related_study_abroads = StudyAbroad::where('status',1)->whereIn('id',explode(',', $study_abroad->related_study_abroads ?? ''))->limit(6)->get();
		// Đội ngũ nhân viên
        $related_teams = Personnel::where('status',1)->whereIn('id',explode(',', $study_abroad->related_teams ?? ''))->get();
        return view('Default::mobile.study_abroad.show', compact('meta_seo', 'breadcrumb', 'admin_bar', 'student_images', 'feedback_images','study_abroad', 'related_study_abroads', 'related_teams'));
	}
}
