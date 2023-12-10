<?php

namespace Sudo\Theme\Http\Controllers\Web;

use Illuminate\Http\Request;
use Sudo\Theme\Models\Page;
use Sudo\Personnel\Models\Personnel;
use Illuminate\Support\Facades\Validator;
use Sudo\AdminUser\Models\AdminUser;
use Sudo\Post\Models\Post;

use DB;
class PageController extends Controller
{

	public function show($slug) {
		$page = Page::where('slug', $slug)->where('slug', $slug)->firstOrFail();
		$meta_seo = metaSeo('pages', $page->id, [
			'title' => $page->name ?? '',
			'description' => cutString(removeHTML($page->detail ?? ''), 120),
			'url' => $page->getUrl(),
		]);
		$admin_bar = route('admin.pages.edit', $page->id);
		$breadcrumb = [
            [
                'name' => $page->name ?? '',
            ]
        ];
		$pages = Page::select('name')->where('status', 1)->get();
		return view('Default::web.pages.show',compact('page', 'admin_bar', 'meta_seo'));

	}
    public function introduce() {
		// cấu hình giới thiệu
		$setting_introduce = getOption('introduce');
		$setting_home = getOption('home');
		$paginate = 8;
		$meta_seo = metaSeo('', '', [
			'title' => $setting_home['meta_title'] ?? 'Trang giới thiệu',
			'description' => $setting_home['meta_description'] ?? 'Mô tả Trang giới thiệu',
			'image' => $setting_home['meta_image'] ?? getImage(),
		]);
        $personnels = Personnel::select('personnels.*')
            ->whereIn('id', $setting_introduce['team'] ?? '')
            ->where('status',1)
            ->get();
		$admin_bar = route('admin.settings.introduce');
		return view('Default::web.pages.introduce',compact('setting_introduce', 'admin_bar', 'meta_seo', 'setting_home', 'personnels'));
	}
    public function contact(Request $request){
        $config_contact = getOption('contact');
        if($request->isMethod('POST')) {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string',
                'phone' => 'required|string',
                'email' => 'required|string|email',
                'note' => 'required',
            ], [
                'name.required' => 'Vui lòng nhập họ tên của bạn',
                'name.string' => 'Họ tên phải là chuỗi ký tự',
                'phone.required' => 'Vui lòng nhập số điện thoại của bạn',
                'phone.string' => 'Số điện thoại phải là chuỗi ký tự',
                'phone.max' => 'Số điện thoại không được vượt quá :max ký tự',
                'email.required' => 'Vui lòng nhập địa chỉ email của bạn',
                'email.string' => 'Địa chỉ email phải là chuỗi ký tự',
                'email.email' => 'Địa chỉ email không hợp lệ',
                'note.required' => 'Vui lòng nhập nội dung',
            ]);
            if ($validator->fails()) {
                return response()->json(['status' => 'error', 'message' => $validator->errors()->first()]);
            }
			extract($request->all(), EXTR_OVERWRITE);
			$created_at = $updated_at = date('Y-m-d H:i:s');
			DB::table('contacts')->insert([
				'name'=> $name ?? '',
				'email'=> $email,
				'note'=> $note,
				'phone'=> $phone,
                'type' =>(int)$type,
                'address' =>$address,
				'created_at' => $created_at,
				'updated_at' => $updated_at
			]);
            $responseData = [
                'status' => 'success',
                'message' => 'Đăng ký thành công.',
            ];
            return response()->json($responseData);
		}
        $meta_seo = metaSeo('', '', [
			'title' => $config_contact['meta_title'] ?? 'Trang liên hệ',
			'description' => $config_contact['meta_description'] ?? 'Mô tả Trang liên hệ',
			'image' => $config_contact['meta_image'] ?? getImage(),
		]);
		$breadcrumb = [
			[
				'name' =>'Liên hệ',
				'link' =>route('app.contact'),
			]
		];
        $admin_bar = route('admin.settings.contact');
        return view('Default::web.pages.contact', compact('meta_seo', 'config_contact', 'admin_bar', 'breadcrumb'));
    }
    public function admin_users($slug, Request $request) {
		// $admin_users = AdminUser::get();
		$admin_users = AdminUser::where('status', 1)->where('slug', $slug)->firstOrFail();
		// meta seo
        $meta_seo = metaSeo('admin_users', $admin_users->id, [
			'title' => $admin_users->getName() ?? __('Tác giả'),
			'description' => cutString(removeHTML($admin_users->infomation ?? ''), 160) ?? __('Mô tả tác giả'),
			'image' => $admin_users->getAvatar() ?? ''
		]);
        $admin_bar = route('admin.admin_users.edit', $admin_users->id);
		return view('Default::web.admin_users.show', compact(
			'meta_seo', 'admin_bar', 'admin_users',
		));
	}
}
