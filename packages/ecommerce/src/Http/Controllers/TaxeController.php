<?php

namespace Sudo\Ecommerce\Http\Controllers;
use Sudo\Base\Http\Controllers\AdminController;

use Illuminate\Http\Request;
use ListData;
use Form;
use ListCategory;
use DB;
use Auth;

class TaxeController extends AdminController
{
    function __construct() {
        $this->models = new \Sudo\Ecommerce\Models\Taxe;
        $this->table_name = $this->models->getTable();
        $this->module_name = 'Thuế';
        $this->has_seo = false;
        $this->has_locale = true;
        parent::__construct();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $requests) {
        $listdata = new ListData($requests, $this->models, 'Ecommerce::taxes.table', $this->has_locale);

        // Build Form tìm kiếm
        $listdata->search('title', 'Tên', 'string');
        $listdata->search('status', 'Trạng thái', 'array', config('app.status'));
        // Build các hành động
        $listdata->action('status');
        
        // Build bảng
        $listdata->add('title', 'Tiêu đề', 0);
        $listdata->add('percentage', 'Phần trăm %', 0);
        $listdata->add('priority', 'Độ ưu tiên', 0);
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
        // Danh mục
        $categories = new ListCategory('post_categories', $this->has_locale, Request()->lang_locale ?? \App::getLocale());
        $admin_users = DB::table('admin_users')->where('status', 1)->where('id', '>', 1)->pluck('name', 'id')->toArray();
        // Khởi tạo form
        $form = new Form;

        $form->lang($this->table_name, true);
        $form->text('title', '', 1, 'Tiêu đề', '', true);
        $form->number('percentage', '', 1, 'Phần trăm %', '', true);
        $form->number('priority', '', 1, 'Độ ưu tiên', '', true);
        
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
        validateForm($requests, 'title', 'Tiêu đề không được để trống.');
        validateForm($requests, 'percentage', 'Phần trăm không được để trống.');
        validateForm($requests, 'priority', 'Độ ưu tiên không được để trống.');
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
        $compact = compact('title','percentage','priority','status','created_at','updated_at');
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
        // Khởi tạo form
        $form = new Form;

        $form->lang($this->table_name);
        $form->text('title', $data_edit->title, 1, 'Tiêu đề', '', true);
        $form->number('percentage', $data_edit->percentage, 1, 'Phần trăm %', '', true);
        $form->number('priority', $data_edit->priority, 1, 'Độ ưu tiên', '', true);
        
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
        validateForm($requests, 'title', 'Tiêu đề không được để trống.');
        validateForm($requests, 'percentage', 'Phần trăm không được để trống.');
        validateForm($requests, 'priority', 'Độ ưu tiên không được để trống.');
        // Lấy bản ghi
        $data_edit = $this->models->where('id', $id)->first();
        // Các giá trị mặc định
        $status = 0;
        // Đưa mảng về các biến có tên là các key của mảng
        extract($requests->all(), EXTR_OVERWRITE);
        // Chuẩn hóa lại dữ liệu
        $updated_at = $updated_at ?? date('Y-m-d H:i:s');
        // Các giá trị thay đổi
        $compact = compact('title','percentage', 'priority', 'status', 'updated_at');
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
