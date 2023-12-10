<?php

namespace Sudo\Theme\Http\Controllers\Mobile;

use Illuminate\Http\Request;
use App;
use DB;
use Session;
use Auth;
use Mail;
use Sudo\Contact\Models\Contact;
use Illuminate\Support\Facades\Validator;
use Sudo\Library\Models\Library;
use Sudo\Post\Models\Post;
use Sudo\School\Models\School;
use Sudo\StudyAbroad\Models\StudyAbroad;

class AjaxController extends Controller
{
    public function sendForm(Request $request) {
    // dd($request->all());
        $created_at = $updated_at = date('Y-m-d H:i:s');
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'phone' => 'required|string',
            'email' => 'required|string|email',
        ], [
            'name.required' => 'Vui lòng nhập họ tên của bạn',
            'name.string' => 'Họ tên phải là chuỗi ký tự',
            'phone.required' => 'Vui lòng nhập số điện thoại của bạn',
            'phone.string' => 'Số điện thoại phải là chuỗi ký tự',
            'phone.max' => 'Số điện thoại không được vượt quá :max ký tự',
            'email.required' => 'Vui lòng nhập địa chỉ email của bạn',
            'email.string' => 'Địa chỉ email phải là chuỗi ký tự',
            'email.email' => 'Địa chỉ email không hợp lệ',
        ]);
        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'message' => $validator->errors()->first()]);
        }
        $data = $request->all();

        $contact = Contact::create($data);
        if ($contact) {
            $responseData = [
                'status' => 'success',
                'message' => 'Đăng ký thành công.',
            ];
            return response()->json($responseData);
        } else {
            return response()->json(['status' => 'error', 'message' => 'Đăng ký không thành công!']);
        }
    }
    public function searchCategory(Request $request) {
        $type = $request->type ?? [];
        $html = '';
        $datas = [];
        if(count($type) == 0) {
            return $html;
        }
        if(in_array('post', $type)) {
            $posts = Post::where('status', 1)->limit(10)->get();
            foreach($posts as $value) {
                $datas[] = [
                    'name' => $value->name,
                    'url' => $value->getUrl('mobile'),
                    'image' => $value->image,
                    'detail' => $value->detail
                ];
            }
        }
        if(in_array('school', $type)) {
            $schools = School::where('status', 1)->limit(10)->get();
            foreach($schools as $value) {
                $datas[] = [
                    'name' => $value->name,
                    'url' => '',
                    'image' => $value->image,
                    'detail' => $value->detail
                ];
            }
        }
        if(in_array('arboads', $type)) {
            $arboads = StudyAbroad::where('status', 1)->limit(10)->get();
            foreach($arboads as $value) {
                $datas[] = [
                    'name' => $value->name,
                    'url' => $value->getUrl('mobile'),
                    'image' => $value->image,
                    'detail' => $value->detail
                ];
            }
        }

        if(!$datas) {
            return 'Không có dữ liệu!';
        }
        $html = view('Default::mobile.layouts.search_item')->with(['datas' => $datas])->render();
        return $html;
    }
    public function searchKeyword(Request $request) {
        // dd($request->all());
        $key_format = formatKeyword(str_replace(["'", '"'], [''], $request->keyword ?? ''));
        $key = $key_format['key'];
        $keyword_search = $key_format['keyword'];

        $html = '';
        $datas = [];

        $posts = Post::where('status', 1)->searchByName($keyword_search)->limit(10)->get();
        if($posts) {
            foreach($posts as $value) {
                $datas[] = [
                    'name' => $value->name,
                    'url' => $value->getUrl('mobile'),
                    'image' => $value->image,
                    'detail' => $value->detail
                ];
            }
        }

        $schools = School::where('status', 1)->searchByName($keyword_search)->limit(10)->get();
            if($schools) {
            foreach($schools as $value) {
                $datas[] = [
                    'name' => $value->name,
                    'url' => '',
                    'image' => $value->image,
                    'detail' => $value->detail
                ];
            }
        }
        $arboads = StudyAbroad::where('status', 1)->searchByName($keyword_search)->limit(10)->get();
            if($arboads) {
            foreach($arboads as $value) {
                $datas[] = [
                    'name' => $value->name,
                    'url' => $value->getUrl('mobile'),
                    'image' => $value->image,
                    'detail' => $value->detail
                ];
            }
        }

        if(!$datas) {
            return 'Không có dữ liệu!';
        }
        $html = view('Default::mobile.layouts.search_item')->with(['datas' => $datas])->render();
        return $html;
    }
}
