<?php

namespace Sudo\Ecommerce\Http\Controllers;
use Sudo\Base\Http\Controllers\AdminController;

use Illuminate\Http\Request;
use ListData;
use Form;
use DB;

class FilterController extends AdminController
{
	function __construct() {
        $this->models = new \Sudo\Ecommerce\Models\Filter;
        $this->table_name = $this->models->getTable();
        $this->module_name = 'Nhóm bộ lọc';
        $this->has_seo = false;
        $this->has_locale = false;
        parent::__construct();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $requests) {
    	$listdata = new ListData($requests, $this->models, 'Ecommerce::filters.table', $this->has_locale, 30, [ 'order' => 'asc', 'id' => 'desc' ]);
        // Build Form tìm kiếm
        $listdata->search('name', 'Tên', 'string');
        $listdata->search('created_at', 'Ngày tạo', 'range');
        $listdata->search('status', 'Trạng thái', 'array', config('app.status'));
        // Build các hành động
        $listdata->action('status');
        // Build bảng
        $listdata->add('name', 'Tên', 1);
        $listdata->add('order', 'Sắp xếp', 1, 'order');
        $listdata->add('', 'Thời gian', 0, 'time');
        $listdata->add('status', 'Trạng thái', 1, 'status');
        $listdata->add('', 'Language', 0, 'lang');
       $listdata->add('', 'Hành động', 0, 'action');
        // Trả về views
        return $listdata->render();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        // Khởi tạo form
        $form = new Form;

        $form->card('col-lg-3', 'Thông tin nhóm bộ lọc');
            $form->lang($this->table_name);
            $form->text('name', '', 1, 'Tiêu đề');
            $form->checkbox('status', 1, 1, 'Trạng thái');
            $form->custom('Form::custom.form_custom', [
                'has_full' => true,
                'name' => 'filter_details',
                'value' => [],
                'label' => 'Thêm bộ lọc',
                'generate' => [
                    [ 'type' => 'textarea', 'name' => 'name', 'placeholder' => 'Nhập tên bộ lọc', ],
                ],
            ]);
        $form->endCard();

        $form->custom('Ecommerce::filters.filter_details', [
            'filter_id' => 0,
        ]);

        $form->action('add');
        // Hiển thị form tại view
        return $form->render('create_multi_col');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $requests) {
        // Xử lý validate
        validateForm($requests, 'name', 'Tiêu đề không được để trống.');
        // Các giá trị mặc định
        $status = 0;
        // Đưa mảng về các biến có tên là các key của mảng
        extract($requests->all(), EXTR_OVERWRITE);
        // Chuẩn hóa lại dữ liệu
        // Thêm vào DB
        $created_at = $updated_at = date('Y-m-d H:i:s');
        // Nếu click lưu nháp
        if($redirect == 'save'){
            $status = 0;
            $redirect = 'edit';
        }
        $compact = compact('name','status','created_at','updated_at');
        $id = $this->models->createRecord($requests, $compact, $this->has_seo, $this->has_locale);
        // Thêm chi tiết bộ lọc
        if (isset($filter_details['name']) && !empty($filter_details['name'])) {
            $this->storeFilterDetail($filter_details['name'] ?? [], $id);
        }
        // Điều hướng
        return redirect(route('admin.'.$this->table_name.'.'.$redirect, $id))->with([
            'type' => 'success',
            'message' => __('Translate::admin.create_success').' '.__('Hãy chọn bộ lọc tại <strong>Danh mục</strong>')
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
    	return redirect()->back();
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
        $form->card('col-lg-3', 'Thông tin nhóm bộ lọc');
            $form->text('filter_name', $data_edit->name, 1, 'Tiêu đề');
            $form->checkbox('filter_status', $data_edit->status, 1, 'Trạng thái');
            $form->custom('Form::custom.form_custom', [
                'has_full' => true,
                'name' => 'filter_details',
                'value' => [],
                'label' => 'Thêm bộ lọc',
                'generate' => [
                    [ 'type' => 'textarea', 'name' => 'name', 'placeholder' => 'Nhập tên bộ lọc', ],
                ],
            ]);
        $form->endCard();

        $form->custom('Ecommerce::filters.filter_details', [
            'filter_id' => $id,
        ]);

        $form->action('edit');
        // Hiển thị form tại view
        return $form->render('edit_multi_col', compact('id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $requests, $id) {
    	// Xử lý validate
        validateForm($requests, 'filter_name', 'Tiêu đề không được để trống.');
        // Lấy bản ghi
        $data_edit = $this->models->where('id', $id)->first();
        // Các giá trị mặc định
        $status = 0;
        $filter_status = 0;
        // Đưa mảng về các biến có tên là các key của mảng
        extract($requests->all(), EXTR_OVERWRITE);
        // Chuẩn hóa lại dữ liệu
        $name = $filter_name ?? null;
        $status = $filter_status;
        // Các giá trị thay đổi
        $created_at = $updated_at = date('Y-m-d H:i:s');
        $compact = compact('name','status','updated_at');
        // Cập nhật tại database
        $this->models->updateRecord($requests, $id, $compact, $this->has_seo);
        // Thêm chi tiết thuộc tính
        if (isset($filter_details['name']) && !empty($filter_details['name'])) {
            $this->storeFilterDetail($filter_details['name'] ?? [], $data_edit->id);
        }
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
    public function destroy($id) {
        
    }

    /**
     * Thêm chi tiết bộ lọc theo mảng truyền vào (Auto thêm)
     */
    public function storeFilterDetail($data = [], $filter_id) {
        $store_data = [];
        $ft_dt_slugs = DB::table('filter_details')->pluck('slug', 'slug')->toArray();
        foreach ($data as $value) {
            if(!array_key_exists(str_slug($value), $ft_dt_slugs)){
                $slug = str_slug($value);
            }else {
                $slug = str_slug($value).'-'.rand(2, 8);
            }
            $store_data[] = [
                'filter_id' => $filter_id,
                'name' => $value,
                'slug' => $slug,
                'status' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ];
        }
        \Sudo\Ecommerce\Models\FilterDetail::insert($store_data);
    }
}