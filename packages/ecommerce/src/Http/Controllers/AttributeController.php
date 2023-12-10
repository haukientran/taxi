<?php

namespace Sudo\Ecommerce\Http\Controllers;
use Sudo\Base\Http\Controllers\AdminController;

use Illuminate\Http\Request;
use ListData;
use Form;
use ListCategory;
use DB;
use Auth;
use Sudo\Ecommerce\Models\AttributeDetail;
class AttributeController extends AdminController
{
    function __construct() {
        $this->models = new \Sudo\Ecommerce\Models\Attribute;
        $this->table_name = $this->models->getTable();
        $this->module_name = 'Thuộc tính';
        $this->has_seo = false;
        $this->has_locale = true;
        $this->status = [
            0 => 'Chưa kích hoạt tài khoản',
            1 => 'Hoạt động',
            2 => 'Không hoạt động',
        ];
        parent::__construct();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $requests) {
        $listdata = new ListData($requests, $this->models, 'Ecommerce::attributes.table', $this->has_locale, 30, [ 'order' => 'asc', 'id' => 'desc' ]);

        // Build Form tìm kiếm
        $listdata->search('name', 'Tên', 'string');
        $listdata->search('created_at', 'Ngày tạo', 'range');
        $listdata->search('status', 'Trạng thái', 'array', config('app.status'));
        // Build các hành động
        $listdata->action('status');
        
        // Build bảng
        $listdata->add('name', 'Tên', 1);
        $listdata->add('slug', 'Đường dẫn', 0);
        $listdata->add('is_searchable', 'Thêm vào bộ lọc', 0);
        $listdata->add('order', 'Sắp xếp', 1, 'order');
        $listdata->add('', 'Thời gian', 0, 'time');
        $listdata->add('status', 'Trạng thái', 0, 'status');
        $listdata->add('', 'Language', 0, 'lang');
        $listdata->add('', 'Hành động', 0, 'action');
        return $listdata->render();
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
        $display_layout = [
            'text'  => 'Tiêu đề',
            'code'  => 'Mã màu',
            'image' => 'Hình ảnh',
        ];
        $form->card('col-lg-8');
            $form->lang($this->table_name, true);
            $form->text('name', '', 1, 'Tên nhóm thuộc tính','');
            $form->slug('slug', '', 1, 'Đường dẫn', 'name', 'true', 'attributes');
        $form->endCard();
        $form->card('col-lg-4');
            $form->checkbox('status', 1, 1, 'Trạng thái', 'col-lg-4');
            $form->checkbox('is_searchable', 1, 1, 'Thêm vào bộ lọc', 'col-lg-4');
            $form->select('display_layout', '', 0, 'Kiểu hiển thị', $display_layout);
        $form->endCard();
        $form->card('col-lg-12', 'Chi tiết thuộc tính');
            $form->custom('Ecommerce::admin.products.form.attribute_detail');
        $form->endCard();
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
    public function store(Request $requests)
    {
        // Xử lý validate
        validateForm($requests, 'name', 'Tiêu đề không được để trống.');
        // Các giá trị mặc định
        $status = 0;
        $is_searchable = 0;
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
        $compact = compact('name','slug', 'display_layout','is_searchable','status','created_at','updated_at');
        $id = $this->models->createRecord($requests, $compact, $this->has_seo, $this->has_locale);

        $this->attributeDetailHandle($requests, $id);
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

        $attribute_detail = AttributeDetail::where('attribute_id', $data_edit->id)->get();

        $display_layout = [
            'text'  => 'Tiêu đề',
            'code'  => 'Mã màu',
            'image' => 'Hình ảnh',
        ];
        // Khởi tạo form
        $form = new Form;

        $form->card('col-lg-8');
            $form->lang($this->table_name, true);
            $form->text('name', $data_edit->name, 1, 'Tên nhóm thuộc tính','');
            $form->slug('slug', $data_edit->slug, 1, 'Đường dẫn', '', 'false', '');
        $form->endCard();
        $form->card('col-lg-4');
            $form->checkbox('status', $data_edit->status, 1, 'Trạng thái', 'col-lg-3');
            $form->checkbox('is_searchable', $data_edit->is_searchable, 1, 'Thêm vào bộ lọc', 'col-lg-6');
            $form->select('display_layout', $data_edit->display_layout, 0, 'Kiểu hiển thị', $display_layout);
        $form->endCard();
        $form->card('col-lg-12', 'Chi tiết thuộc tính');
            $form->custom('Ecommerce::admin.products.form.attribute_detail');
        $form->endCard();
        $form->action('edit');

        // Hiển thị form tại view
        return $form->render('edit_multi_col', compact('id', 'attribute_detail'));
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
        validateForm($requests, 'name', 'Tiêu đề không được để trống.');
        // Lấy bản ghi
        $data_edit = $this->models->where('id', $id)->first();
        // Các giá trị mặc định
        $status = 0;
        $is_searchable = 0;
        // Đưa mảng về các biến có tên là các key của mảng
        extract($requests->all(), EXTR_OVERWRITE);
        // Chuẩn hóa lại dữ liệu
        $updated_at = $updated_at ?? date('Y-m-d H:i:s');
        // Các giá trị thay đổi
        $compact = compact('name', 'slug', 'display_layout', 'is_searchable', 'status', 'updated_at');
        // Cập nhật tại database
        $this->models->updateRecord($requests, $id, $compact, $this->has_seo);

        $this->attributeDetailHandle($requests, $id);
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

    public function attributeDetailHandle($requests, $id) {
        // Đưa mảng về các biến có tên là các key của mảng
        $created_at = $updated_at = date('Y-m-d H:i:s');
        extract($requests->all(), EXTR_OVERWRITE);
        $not_remove = [];
        if (isset($attribute) && !empty($attribute)) {
            foreach($attribute as $key => $value){
                $not_remove[] = $key;
            }
            DB::table("attribute_details")->where('attribute_id', $id)->whereNotIn('id', $not_remove)->delete();
        }
        if (isset($attribute) && !empty($attribute)) {
            foreach($attribute as $key => $value){
                $not_remove[] = $key;
                foreach($value['name'] as $k => $v){
                    if($key == 0){
                        $db_insert = [
                            'attribute_id'     => $id,
                            'name'          => $value['name'][$k] ?? '',
                            'slug'          => $value['slug'][$k] ?? '',
                            'color_code'    => $value['color_code'][$k] ?? '',
                            'image'         => $value['image'][$k] ?? '',
                            'created_at'    => $created_at,
                            'updated_at'    => $updated_at,
                        ];
                        \DB::table('attribute_details')->insert($db_insert);
                    }else{
                        $db_update = [
                            'name'          => $value['name'][$k] ?? '',
                            'slug'          => $value['slug'][$k] ?? '',
                            'color_code'    => $value['color_code'][$k] ?? '',
                            'image'         => $value['image'][$k] ?? '',
                            'updated_at'    => $updated_at,
                        ];
                        \DB::table('attribute_details')->where('id', $key)->update($db_update);
                    }
                }
            }
        }
    }
}
