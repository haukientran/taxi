<?php

namespace Sudo\Ecommerce\Http\Controllers;
use Sudo\Base\Http\Controllers\AdminController;

use Illuminate\Http\Request;
use ListData;
use Form;
use ListCategory;
use DB;
use Auth;

class BrandController extends AdminController
{
    function __construct() {
        $this->models = new \Sudo\Ecommerce\Models\Brand;
        $this->table_name = $this->models->getTable();
        $this->module_name = 'Thương hiệu';
        $this->has_seo = true;
        $this->has_locale = true;
        parent::__construct();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $requests) {
        $listdata = new ListData($requests, $this->models, 'Ecommerce::brands.table', $this->has_locale);

        // Build Form tìm kiếm
        $listdata->search('name', 'Tên', 'string');
        $listdata->search('status', 'Trạng thái', 'array', config('app.status'));
        // Build các hành động
        $listdata->action('status');
        
        // Build bảng
        $listdata->add('image', 'Ảnh', 0);
        $listdata->add('name', 'Tên', 0);
        $listdata->add('', 'Thời gian', 0, 'time');
        $listdata->add('status', 'Trạng thái', 0, 'status');
        $listdata->add('', 'Language', 0, 'lang');
        $listdata->add('', 'Hành động', 0, 'action');
        // Lấy dữ liệu data
        $data = $listdata->data();
        // Trả về views
        return $listdata->render(compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        // Khởi tạo form
        $form = new Form;

        $form->lang($this->table_name, true);
        $form->text('name', '', 1, 'Tên thương hiệu', '', true);
        $form->slug('slug', '', 1, 'Đường dẫn', 'name', 'true', 'brands', true);
        $form->image('image', '', 0, 'Ảnh đại diện', 'Chọn ảnh','Chọn ảnh có kích thước XXXxXXX để hiển thị đẹp nhất', true);
        $form->editor('detail', '', 0, 'Nội dung', true);
        $form->checkbox('status', 1, 1, 'Trạng thái');
        $form->action('add');
        // Hiển thị form tại view

        return $form->render('create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $requests)
    {
        // Xử lý validate
        validateForm($requests, 'name', 'Tên thương hiệu không được để trống.');
        validateForm($requests, 'slug', 'Đường dẫn không được để trống.');
        validateForm($requests, 'slug', 'Đường dẫn đã bị trùng.', 'unique', 'unique:brands');
        // Các giá trị mặc định
        $status = 0;
        // Đưa mảng về các biến có tên là các key của mảng
        extract($requests->all(), EXTR_OVERWRITE);
        // Chuẩn hóa lại dữ liệu
        $created_at = $created_at ?? date('Y-m-d H:i:s');
        $updated_at = $updated_at ?? date('Y-m-d H:i:s');
        
        // Nếu click lưu nháp
        if($redirect == 'save'){
            $status = 0;
            $redirect = 'edit';
        }
        // Thêm vào DB
        $compact = compact('name','slug','image','detail','status','created_at','updated_at');
        $id = $this->models->createRecord($requests, $compact, $this->has_seo, $this->has_locale);
        // Điều hướng
        return redirect(route('admin.'.$this->table_name.'.'.$redirect, $id))->with([
            'type' => 'success',
            'message' => __('Translate::admin.create_success')
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        // Dẽ liệu bản ghi hiện tại
        $data_edit = $this->models->where('id', $id)->first();
        // Ngôn ngữ bản ghi hiện tại
        $language_meta = \DB::table('language_metas')->where('lang_table', $this->table_name)->where('lang_table_id', $data_edit->id)->first();
        // Khởi tạo form
        $form = new Form;
        $form->lang($this->table_name);
        $form->text('name', $data_edit->name, 1, 'Tên thương hiệu', '', true);
        $form->slug('slug', $data_edit->slug, 1, 'Đường dẫn', '', 'false', '', true);
        $form->image('image', $data_edit->image, 0, 'Ảnh đại diện', 'Chọn ảnh','', true);
        $form->editor('detail', $data_edit->detail, 0, 'Nội dung', true);
        $form->checkbox('status', $data_edit->status, 1, 'Trạng thái');
        $form->action('edit');

        // Hiển thị form tại view
        return $form->render('edit', compact('id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $requests
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $requests, $id) {
        // Xử lý validate
        validateForm($requests, 'name', 'Tên thương hiệu không được để trống.');
        validateForm($requests, 'slug', 'Đường dẫn không được để trống.');
        validateForm($requests, 'slug', 'Đường dẫn đã bị trùng.', 'unique', 'unique:brands,slug,'.$id);
        // Lấy bản ghi
        $data_edit = $this->models->where('id', $id)->first();
        // Các giá trị mặc định
        $status = 0;
        // Đưa mảng về các biến có tên là các key của mảng
        extract($requests->all(), EXTR_OVERWRITE);
        // Chuẩn hóa lại dữ liệu
        $updated_at = $updated_at ?? date('Y-m-d H:i:s');
        // Các giá trị thay đổi
        $compact = compact('name', 'slug', 'image', 'detail', 'status', 'updated_at');
        // Cập nhật tại database
        $this->models->updateRecord($requests, $id, $compact, $this->has_seo);
        // Điều hướng
        return redirect(route('admin.'.$this->table_name.'.'.$redirect, $id))->with([
            'type' => 'success',
            'message' => __('Translate::admin.update_success')
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
