<?php

namespace Sudo\Theme\Http\Controllers\Mobile;

use Illuminate\Http\Request;
use Sudo\School\Models\School;
use Sudo\School\Models\Filter;
use Sudo\School\Models\SchoolFilter;
use Sudo\School\Models\FilterDetail;
use DB;
class SchoolController extends Controller
{

    public function search_school(Request $request) {
		// cấu hình giới thiệu
		$url = \Request::url();
		$setting_school = getOption('search_school');
		$filterSlugs = $filterIDS = $filterSchools = [];
        foreach ($request->all() as $key => $value) {
            if (strpos($key, 'filter_') === 0 && $value !== null) {
                $filterSlugs[] = $value;
            }
        }
		$paginate = 12;
		$meta_seo = metaSeo('', '', [
			'title' => $setting_school['meta_title'] ?? 'Trang Tìm trường',
			'description' => $setting_school['meta_description'] ?? 'Mô tả Trang tìm trường',
			'image' => $setting_school['meta_image'] ?? getImage(),
		]);
        $schools = School::with('filters.filterDetail')->select('schools.*')
            ->where('status', 1);
        $filters = Filter::with(['filterDetail'=> function($query){
                $query->where('filter_details.status',1);
            }])
            ->where('status',1)
            ->orderBy('order','asc')->get();
        if(count($filterSlugs) > 0 && $filterSlugs !== null) {
            $filterIDS = FilterDetail::whereIn('slug', $filterSlugs)->pluck('id')->toArray();
            $schoolsIds = SchoolFilter::whereIn('filter_detail_id',$filterIDS)
                ->select('school_id', DB::raw('count(*) as total'))
                ->groupBy('school_id')->get();
            foreach ($schoolsIds as $key => $value) {
                if($value->total == count($filterIDS)){
                    array_push($filterSchools, $value->school_id);
                }
            }
            $schools = $schools->whereIn('schools.id', $filterSchools);
        }
        $schools = $schools->paginate($paginate);
		$page = ($request->page ?? 1) - 1;
		$total = $page * $paginate + count($schools);

		if($request->ajax()) {
            $html = view('Default::mobile.layouts.list_school', compact('schools'))->render();
            return [
                'html' => $html,
                'is_hide_more'=> $schools->currentPage() >= $schools->lastPage(),
                'total' => $total,
                'status' => 1
            ];
        }
        $breadcrumb = [
            [
                'link' => route('mobile.search_school'),
                'name' => 'Tìm trường'
            ]
        ];
		$admin_bar = route('admin.settings.search_school');
		return view('Default::mobile.schools.search_school',compact('admin_bar', 'breadcrumb', 'meta_seo', 'setting_school', 'filters', 'schools', 'url'));
	}
}
