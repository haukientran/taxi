<?php

namespace Sudo\Ecommerce\Http\Controllers;
use Sudo\Base\Http\Controllers\AdminController;

use Illuminate\Http\Request;
use ListData;
use Form;
use ListCategory;
use DB;
class ProductCategoryController extends AdminController
{
    function __construct() {
        $this->models = new \Sudo\Ecommerce\Models\ProductCategory;
        $this->table_name = $this->models->getTable();
        $this->module_name = 'Danh mục sản phẩm';
        $this->has_seo = true;
        $this->has_locale = true;
        parent::__construct();
        $filters = \Sudo\Ecommerce\Models\Filter::query()
                ->where('status',1)->get();
        $this->filters = $filters;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $requests) {
        $listdata = new \Sudo\Category\MyClass\ListDataCategory($requests, $this->models, 'Ecommerce::product_categories.table', $this->has_locale);
        // Build Form tìm kiếm
        $listdata->search('name', 'Tên', 'string');
        // Build các hành động
        $listdata->action('status');
        $listdata->no_trash();
        $listdata->no_paginate();
        // Build bảng
        $listdata->add('name', 'Tên', 1);
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
    public function create(Request $requests)
    {
        // danh mục
        $categories = new ListCategory('product_categories', $this->has_locale, Request()->lang_locale ?? \App::getLocale());
        $array_attribute = DB::table('attributes')->where('status', 1)->where('is_searchable', 1)->pluck('name', 'id')->toArray();
        // Khởi tạo form
        $form = new Form;
        $form->card('col-lg-8');
            $form->lang($this->table_name);
            $form->text('name', '', 1, 'Tên danh mục', '');
            $form->slug('slug', '', 1, 'Đường dẫn', 'name', true, 'product_categories');
            $form->select('parent_id', '', 0, 'Danh mục cha', $categories->data_select(), 0, []);
            $form->editor('detail', '', 0, 'Mô tả danh mục');
        $form->endCard();
        $form->card('col-lg-4');
            $form->checkbox('status', 1, 1, 'Trạng thái', 'col-lg-3');
            // Bộ lọc
            if (config('SudoProduct.filters') == true) {
                $filters  = $this->filters;
                $form->multiCheckbox('filters', [], 0, 'Bộ lọc', $filters->pluck('name', 'id'));
            }
            $form->image('image', '', 0, 'Ảnh đại diện', 'Chọn ảnh', '');
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
        validateForm($requests, 'name', 'Tên danh mục không được để trống.');
        validateForm($requests, 'slug', 'Đường dẫn không được để trống.');
        validateForm($requests, 'slug', 'Đường dẫn đã bị trùng.', 'unique', 'unique:product_categories');
        // Các giá trị mặc định
        $status = 0;
        // Đưa mảng về các biến có tên là các key của mảng
        extract($requests->all(), EXTR_OVERWRITE);
        // Chuẩn hóa lại dữ liệu
        if (isset($parent_id) && !empty($parent_id)) {
            $parent_id = $parent_id;
        } else {
            $parent_id = 0;
        }

        // Nếu click lưu nháp
        if($redirect == 'save'){
            $status = 0;
            $redirect = 'edit';
        }
        // Thêm vào DB
        $created_at = $updated_at = date('Y-m-d H:i:s');
        $compact = compact('parent_id','name','slug','image','detail','status','created_at','updated_at');
        $id = $this->models->createRecord($requests, $compact, $this->has_seo, true);

        $this->attributeHandle($requests, $id);
        // Bộ lọc
        if (isset($filters) && !empty($filters)) {
            $this->setFilterMap($filters, $id);
        }
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
    public function edit($id)
    {
        // Dẽ liệu bản ghi hiện tại
        $data_edit = $this->models->where('id', $id)->first();

        // Ngôn ngữ bản ghi hiện tại
        $language_meta = \DB::table('language_metas')->where('lang_table', $this->table_name)->where('lang_table_id', $data_edit->id)->first();
        // danh mục ứng với ngôn ngữ
        $categories = new ListCategory('product_categories', $this->has_locale, $language_meta->lang_locale ?? null);
        $array_attribute = DB::table('attributes')->where('status', 1)->where('is_searchable', 1)->pluck('name', 'id')->toArray();

        $product_category_attribute_maps = DB::table('product_category_attribute_maps')->where('product_category_id', $id)->pluck('attribute_id')->toArray();
        // Khởi tạo form
        $form = new Form;

        $form->card('col-lg-8');
            $form->lang($this->table_name);
            $form->text('name', $data_edit->name, 1, 'Tên danh mục', '');
            $form->slug('slug', $data_edit->slug, 1, 'Đường dẫn', '', false, '');
            $form->select('parent_id', $data_edit->parent_id, 0, 'Danh mục cha', $categories->data_select(), 0, $data_edit->getChildIds());
            $form->editor('detail', $data_edit->detail, 0, 'Mô tả danh mục');
        $form->endCard();
        $form->card('col-lg-4');
            $form->checkbox('status', $data_edit->status, 1, 'Trạng thái', 'col-lg-4');
            // Bộ lọc
            if (config('SudoProduct.filters') == true) {
                $filters = $this->filters;
                $filter_array = $filters->pluck('name', 'id')->toArray();
                $maps = \Sudo\Ecommerce\Models\FilterProductCategoryMap::where('category_id', $id)->get();
                $map_array_id = $maps->pluck('filter_id')->toArray();
                $form->multiCheckbox('filters', $map_array_id, 0, 'Bộ lọc', $filter_array);
            }
            $form->image('image', $data_edit->image, 0, 'Ảnh đại diện', 'Chọn ảnh','');
        $form->endCard();
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
        validateForm($requests, 'name', 'Tên danh mục không được để trống.');
        validateForm($requests, 'slug', 'Đường dẫn không được để trống.');
        validateForm($requests, 'slug', 'Đường dẫn đã bị trùng.', 'unique', 'unique:product_categories,slug,'.$id);
        // Lấy bản ghi
        $data_edit = $this->models->where('id', $id)->first();
        // Các giá trị mặc định
        $status = 0;
        // Đưa mảng về các biến có tên là các key của mảng
        extract($requests->all(), EXTR_OVERWRITE);
        // Chuẩn hóa lại dữ liệu
        if (isset($parent_id) && !empty($parent_id)) {
            $parent_id = $parent_id;
        } else {
            $parent_id = 0;
        }
        // Các giá trị thay đổi
        $created_at = $updated_at = date('Y-m-d H:i:s');
        $compact = compact('parent_id','name','slug','image','detail','status','updated_at');
        // Cập nhật tại database
        $this->models->updateRecord($requests, $id, $compact, $this->has_seo);
        $this->attributeHandle($requests, $id);
        // Bộ lọc
        if (config('SudoProduct.filters') == true && isset($filters) && !empty($filters)) {
            $this->setFilterMap($filters, $id);
        } else{
            \Sudo\Ecommerce\Models\FilterProductCategoryMap::where('category_id', $id)->delete();
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
    public function destroy($id)
    {
        // Bản ghi cần xóa hiện tại
        $record = $this->models->find($id);
        // Toàn bộ bản ghi con của nó
        $child_record = $this->models->where('parent_id', $record->id)->get();
        // Mảng id của bản ghi con
        $child_record_array_id = $child_record->pluck('id');
        // Cập nhật parent_id của bản ghi con bằng bản ghi cha của bản ghi hiện tại
        $this->models->whereIn('id', $child_record_array_id)->update([
            'parent_id' => $record->parent_id ?? null,
        ]);
        // Ghi logs
        systemLogs('quick_delete', ['status' => -1], $this->table_name, $id);
        // Cập nhật bản ghi hiện tại  không thuộc cha và có trạng thái xóa [-1]
        $this->models->where('id', $id)->update([
            'parent_id' => 0,
            'status'    => -1,
        ]);
        // Trả về
        return [
            'status' => 1,
            'message' => __('Translate::admin.delete_success')
        ];
    }

    /**
     * Xử lý bộ lọc
     * @param  requests         $requests: dữ liệu form
     * @param  int              $id: ID product_id
     */
    public function attributeHandle(Request $requests, $id){
        // Đưa mảng về các biến có tên là các key của mảng
        extract($requests->all(), EXTR_OVERWRITE);

        // Xóa product_category_id hiện tại
        DB::table('product_category_attribute_maps')->where('product_category_id', $id)->delete();
        // Kiểm tra có tồn tại category_id không
        if (isset($filters) && !empty($filters)) {
            // Thêm mảng check mới
            $product_category_attribute_maps = [];
            foreach ($filters as $value) {
                $product_category_attribute_maps[] = [
                    'product_category_id' => $id,
                    'attribute_id' => $value,
                ];
            }
            \DB::table('product_category_attribute_maps')->insert($product_category_attribute_maps);
        }
    }
    /**
     * Cập nhật bảng maps danh mục với bộ lọc
     */
    public function setFilterMap($data, $id) {
        \Sudo\Ecommerce\Models\FilterProductCategoryMap::where('category_id', $id)->delete();
        $maps = [];
        foreach ($data as $value) {
            $maps[] = [
                'category_id' => $id,
                'filter_id' => $value,
            ];
        }
        if(count($maps) > 0){
            \Sudo\Ecommerce\Models\FilterProductCategoryMap::insert($maps);
        }
    }
}
