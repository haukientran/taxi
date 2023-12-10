<?php

namespace Sudo\Ecommerce\Http\Controllers;
use Sudo\Base\Http\Controllers\AdminController;

use Illuminate\Http\Request;
use ListData;
use Form;
use ListCategory;
use DB;
use Auth;

class ProductController extends AdminController
{
    function __construct() {
        $this->models = new \Sudo\Ecommerce\Models\Product;
        $this->table_name = $this->models->getTable();
        $this->module_name = 'Sản phẩm';
        $this->has_seo = true;
        $this->has_locale = true;
        parent::__construct();

        $product_categories = new ListCategory('product_categories');
        $this->product_categories = $product_categories->data();
        \View::share('product_categories', $this->product_categories);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $requests) {
        $listdata = new ListData($requests, $this->models, 'Ecommerce::products.table', $this->has_locale);

        // Build Form tìm kiếm
        $listdata->search('name', 'Tên', 'string');
        $listdata->search('category_id', 'Danh mục', 'array', $this->product_categories);
        $listdata->search('created_at', 'Ngày tạo', 'range');
        $listdata->search('status', 'Trạng thái', 'array', config('app.status'));
        // Build các hành động
        $listdata->action('status');
        
        // Build bảng
        $listdata->add('image', 'Ảnh', 0);
        $listdata->add('name', 'Tên', 0);
        $listdata->add('category_id', 'Danh mục', 0);
        $listdata->add('', 'Thời gian', 0, 'time');
        $listdata->add('status', 'Trạng thái', 0, 'status');
        $listdata->add('', 'Language', 0, 'lang');
        $listdata->add('', 'Hành động', 0, 'action');
        // Lấy dữ liệu data
        $data = $listdata->data();
        $show_data = $data['show_data'];
        $show_data_array_id = $show_data->pluck('id')->toArray();
        // Từ dữ liệu data ở trên lấy ra toàn bộ danh mục thuộc các bài viết
        $product_category_maps = \Sudo\Ecommerce\Models\ProductCategoryMap::whereIn('product_id', $show_data_array_id)->get();
        // Trả về views
        return $listdata->render(compact('data', 'product_category_maps'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        // Danh mục
        $categories = new ListCategory('product_categories', $this->has_locale, Request()->lang_locale ?? \App::getLocale());
        // Thương hiệu
        $array_brand = DB::table('brands')->where('status', 1)->pluck('name', 'id')->toArray();
        $array_brand[0] = '---Chọn thương hiệu---';

        ksort($array_brand);
        // Khởi tạo form
        $form = new Form;

        $form->card('col-lg-8');
            $form->lang($this->table_name, true);
            $form->text('name', '', 1, 'Tiêu đề', '');
            $form->slug('slug', '', 1, 'Đường dẫn', 'name', 'true', 'products', true);
            $form->row();
                $form->text('sku', '', 0, 'Mã sản phẩm', '', false, 'col-lg-4');
                $form->number('price', 0, 0, 'Giá bán', '', false, 'col-lg-4', false, true);
                $form->number('price_old', 0, 0, 'Giá thị trường', '', false, 'col-lg-4', false, true);
            $form->endRow();
            $form->tab('Nội dung', ['Nội dung', 'Xuất bản'], ['content', 'xuatban'], true);
                $form->contentTab('content');
                    $form->editor('detail', '', 0, 'Nội dung');
                $form->endContentTab();
                $form->contentTab('xuatban');
                    $form->datetimepicker('created_at', '', 0, 'Thời gian xuất bản', '', false, 'col-lg-4');
                    $form->datetimepicker('updated_at', '', 0, 'Thời gian cập nhật', '', false, 'col-lg-4');
                $form->endContentTab();
            $form->endTab(true);
            $form->multiSuggest('related_products', '', 0, 'Sản phẩm liên quan', 'Tìm theo tên sản phẩm...', 'products','id', 'name', false);
            $form->title('Kho hàng');
            $form->custom('Ecommerce::admin.products.form.warehouse');
            $form->title('Vận chuyển');
            $form->row();
                $form->number('weight', 0, 0, 'Trọng lượng (gram)', '', false, 'col-lg-6', false, true);
                $form->number('length', 0, 0, 'Chiều dài (cm)', '', false, 'col-lg-6', false, true);
            $form->endRow();
            $form->row();
                $form->number('wide', 0, 0, 'Chiều rộng (cm)', '', false, 'col-lg-6', false, true);
                $form->number('height', 0, 0, 'Chiều cao (cm)', '', false, 'col-lg-6', false, true);
            $form->endRow();
            $form->title('Thuộc tính');
            $form->custom('Ecommerce::admin.products.form.attributes');
            $form->action('add');
        $form->endCard();
        $form->card('col-lg-4');
            $form->checkbox('status', 1, 1, 'Trạng thái', 'col-lg-4');
            $form->select('category_filter_id', '', 1, 'Danh mục hiển thị bộ lọc', $categories->data_select(), 1);
            $form->multiCheckbox('category_id', [], 0, 'Danh mục', $categories->data());
            $form->select('brand_id', '', 0, 'Thương hiệu', $array_brand);
            $form->image('image', '', 0, 'Ảnh đại diện', 'Chọn ảnh','Chọn ảnh có kích thước XXXxXXX để hiển thị đẹp nhất');
            $form->multiImage('slide', '', 0, 'Ảnh Slide');
        $form->endCard();

        // Bộ lọc
        if (config('SudoProduct.filters') == true) {
            $form->custom('Ecommerce::admin.products.form.product_filters', [
                'product_id' => 0,
                'category_filter_id' => 0,
            ]);
        }
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
        validateForm($requests, 'slug', 'Đường dẫn không được để trống.');
        validateForm($requests, 'slug', 'Đường dẫn đã bị trùng.', 'unique', 'unique:products');
        // Các giá trị mặc định
        $status = 0;
        $quantity = 0;
        // Đưa mảng về các biến có tên là các key của mảng
        extract($requests->all(), EXTR_OVERWRITE);
        // Chuẩn hóa lại dữ liệu
        if (isset($slide) && !empty($slide)) { $slide = implode(',', $slide); } else { $slide = null; }
        if (isset($related_products) && !empty($related_products)) { $related_products = implode(',', $related_products); } else { $related_products = null; }
        $created_at = $created_at ?? date('Y-m-d H:i:s');
        $updated_at = $updated_at ?? date('Y-m-d H:i:s');
        
        // Nếu click lưu nháp
        if($redirect == 'save'){
            $status = 0;
            $redirect = 'edit';
        }
        // Thêm vào DB
        $compact = compact('category_filter_id', 'brand_id','sku','name','slug','image', 'slide', 'price', 'price_old','detail', 'related_products', 'quantity','length','wide','height','weight','status','created_at','updated_at');
        $id = $this->models->createRecord($requests, $compact, $this->has_seo, $this->has_locale);
        // Cập nhật danh mục
        $this->categoryHandle($requests, $id);
        // Cập nhật biến thể
        $this->variantHandle($requests, $id);
        // Lưu bộ lọc của sản phẩm
        if (isset($filters) && !empty($filters)) {
            $this->setFilter($filters, $id);
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
    public function edit($id) {
        // Dẽ liệu bản ghi hiện tại
        $data_edit = $this->models->where('id', $id)->first();
        // Danh mục
        $product_category_maps = \DB::table('product_category_maps')->where('product_id', $data_edit->id)->get()->pluck('product_category_id')->toArray();
        // Ngôn ngữ bản ghi hiện tại
        $language_meta = \DB::table('language_metas')->where('lang_table', $this->table_name)->where('lang_table_id', $data_edit->id)->first();
        // danh mục ứng với ngôn ngữ
        $categories = new ListCategory('product_categories', $this->has_locale, $language_meta->lang_locale ?? null);

        $array_brand = DB::table('brands')->where('status', 1)->pluck('name', 'id')->toArray();
        $array_brand[0] = '---Chọn thương hiệu---';
        ksort($array_brand);

        // Khởi tạo form
        $form = new Form;

        $form->card('col-lg-8');
            $form->lang($this->table_name);
            $form->text('name', $data_edit->name, 1, 'Tiêu đề', '');
            $form->slug('slug', $data_edit->slug, 1, 'Đường dẫn', 'name', 'true', 'products', true);
            $form->row();
                $form->text('sku', $data_edit->sku, 0, 'Mã sản phẩm', '', false, 'col-lg-4');
                $form->number('price', number_format($data_edit->price), 0, 'Giá bán', '', false, 'col-lg-4', false, true);
                $form->number('price_old', number_format($data_edit->price_old), 0, 'Giá thị trường', '', false, 'col-lg-4', false, true);
            $form->endRow();
            $form->tab('Nội dung', ['Nội dung', 'Xuất bản'], ['content', 'xuatban'], true);
                $form->contentTab('content');
                    $form->editor('detail', $data_edit->detail, 0, 'Nội dung');
                $form->endContentTab();
                $form->contentTab('xuatban');
                    $form->datetimepicker('created_at', $data_edit->created_at, 0, 'Thời gian xuất bản', '', false, 'col-lg-4');
                    $form->datetimepicker('updated_at', $data_edit->updated_at, 0, 'Thời gian cập nhật', '', false, 'col-lg-4');
                $form->endContentTab();
            $form->endTab(true);
            $form->multiSuggest('related_products', $data_edit->related_products, 0, 'Sản phẩm liên quan', 'Tìm theo tên sản phẩm...', 'products','id', 'name', false);
            $form->title('Kho hàng');
            // $form->custom('Ecommerce::admin.products.form.warehouse', ['data'=>$data_edit]);
            $form->title('Vận chuyển');
            $form->row();
                $form->number('weight', number_format($data_edit->weight), 0, 'Trọng lượng (gram)', '', false, 'col-lg-6', false, true);
                $form->number('length', number_format($data_edit->length), 0, 'Chiều dài (cm)', '', false, 'col-lg-6', false, true);
            $form->endRow();
            $form->row();
                $form->number('wide', number_format($data_edit->wide), 0, 'Chiều rộng (cm)', '', false, 'col-lg-6', false, true);
                $form->number('height', number_format($data_edit->height), 0, 'Chiều cao (cm)', '', false, 'col-lg-6', false, true);
            $form->endRow();
            $form->title('Thuộc tính');
            $form->custom('Ecommerce::admin.products.form.attributes');
        $form->endCard();
        $form->card('col-lg-4');
            $form->checkbox('status', $data_edit->status, 1, 'Trạng thái', 'col-lg-4');
            $form->select('category_filter_id', $data_edit->category_filter_id, 1, 'Danh mục hiển thị bộ lọc', $categories->data_select(), 1);
            $form->multiCheckbox('category_id', $product_category_maps, 0, 'Danh mục', $categories->data());
            $form->select('brand_id', $data_edit->brand_id, 0, 'Thương hiệu', $array_brand);
            $form->image('image', $data_edit->image, 0, 'Ảnh đại diện', 'Chọn ảnh','Chọn ảnh có kích thước XXXxXXX để hiển thị đẹp nhất');
            $form->multiImage('slide', array_filter(explode(',', $data_edit->slide)), 0, 'Ảnh Slide');
        $form->endCard();
        // Bộ lọc
        if (config('SudoProduct.filters') == true) {
            $form->custom('Ecommerce::admin.products.form.product_filters', [
                'product_id' => $data_edit->id,
                'category_id' => $data_edit->category_filter_id,
            ]);
        }
        $link = (config('app.products_models')) ? config('app.products_models')::where('id', $id)->first()->getUrl() : '';
        $form->action('edit', $link);

        // Hiển thị form tại view
        return $form->render('edit_multi_col', compact('id'));
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
        validateForm($requests, 'name', 'Tên sản phẩm không được để trống.');
        validateForm($requests, 'slug', 'Đường dẫn không được để trống.');
        validateForm($requests, 'slug', 'Đường dẫn đã bị trùng.', 'unique', 'unique:products,slug,'.$id);
        // Lấy bản ghi
        $data_edit = $this->models->where('id', $id)->first();
        // Các giá trị mặc định
        $status = 0;
        $quantity = 0;
        // Đưa mảng về các biến có tên là các key của mảng
        extract($requests->all(), EXTR_OVERWRITE);
        // Chuẩn hóa lại dữ liệu
        if (isset($slide) && !empty($slide)) { $slide = implode(',', $slide); } else { $slide = null; }
        if (isset($related_products) && !empty($related_products)) { $related_products = implode(',', $related_products); } else { $related_products = null; }

        $created_at = $created_at ?? date('Y-m-d H:i:s');
        $updated_at = date('Y-m-d H:i:s');
        // Các giá trị thay đổi

        $compact = compact('category_filter_id', 'brand_id','sku','name','slug','image', 'slide', 'price', 'price_old','detail', 'related_products', 'quantity','length','wide','height','weight','status','updated_at');
        // Cập nhật tại database
        $this->models->updateRecord($requests, $id, $compact, $this->has_seo);
        // Cập nhật danh mục
        $this->categoryHandle($requests, $id);
        // Cập nhật biến thể
        $this->variantHandle($requests, $id);
        // Lưu bộ lọc của sản phẩm
        if (isset($filters) && !empty($filters)) {
            $this->setFilter($filters, $id);
        } else{
            \Sudo\Ecommerce\Models\ProductFilter::where('product_id', $id)->delete();
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
        //
    }

    /**
     * Xử lý biến thể sản phẩm
     * @param  requests         $requests: dữ liệu form
     * @param  int              $id: ID product_id
     */
    public function variantHandle($requests, $id){
        // Đưa mảng về các biến có tên là các key của mảng
        extract($requests->all(), EXTR_OVERWRITE);
        $db_insert_variant = [
            'product_id' => $id
        ];
        if(isset($attributes) && !empty($attributes)){
            $id_variant_insert = DB::table('variants')->insertGetId($db_insert_variant);
            foreach($attributes as $key => $value){
                $db_insert_maps = [
                    'product_id'            => $id,
                    'attribute_id'          => $value,
                    'attribute_detail_id'   => $attribute_details[$key],
                    'variant_id'            => $id_variant_insert,
                ];
                DB::table('attribute_variant_maps')->insert($db_insert_maps);
            }
        }
    }
    /**
     * Xử lý đa danh mục
     * @param  requests         $requests: dữ liệu form
     * @param  int              $id: ID product_id
     */
    public function categoryHandle($requests, $id) {
        // Đưa mảng về các biến có tên là các key của mảng
        extract($requests->all(), EXTR_OVERWRITE);
        // Kiểm tra có tồn tại category_id không
        if (isset($category_id) && !empty($category_id)) {
            // Xóa product_id hiện tại
            \DB::table('product_category_maps')->where('product_id', $id)->delete();
            // Thêm mảng check mới
            $post_category_maps = [];
            foreach ($category_id as $product_category_id) {
                $post_category_maps[] = [
                    'product_id' => $id,
                    'product_category_id' => $product_category_id,
                ];
            }
            \DB::table('product_category_maps')->insert($post_category_maps);
        } else {
            \DB::table('product_category_maps')->where('product_id', $id)->delete();
        }
    }
    public function getAttributeDetail(Request $requests){
        $attribute_id = $requests->attribute_id;
        $attribute_detail = DB::table('attribute_details')->where('attribute_id', $attribute_id)->get();
        $result['html'] = '';
        if(count($attribute_detail) > 0){
            foreach ($attribute_detail as $value) {
                $result['html'] .= '<option value="'.$value->id.'">'.$value->name.'</option>';
            }
        }else{
            $result['html'] = '<option value="0">---Giá trị thuộc tính---</option>';
        }
        return $result;
    }
    public function addMoreAttributes(Request $requests){
        $data_id = $requests->data_id;
        $result['html'] = '';
        $result['data_id'] = $data_id + 1;
        $attributes = \DB::table('attributes')->where('status', 1)->get();
        $result['html'] = view('Ecommerce::admin.products.form.attributes_item', compact('data_id', 'attributes'))->render();
        return $result;
    }
    public function editAttributes(Request $requests){
        $attribute_checked  = $requests->attribute_checked;
        $product_id         = $requests->product_id;
        if(empty($attribute_checked)){ // Nếu không chọn thuộc tính nào thì xóa hết
            DB::table('attribute_variant_maps')->where('product_id', $product_id)->delete();
        }else{
            DB::table('attribute_variant_maps')->where('product_id', $product_id)->whereNotIn('attribute_id', $attribute_checked)->delete(); // Xóa đi những thuộc tính không được chọn
            $variants = DB::table('variants')->where('product_id', $product_id)->get(); // danh sách biến thể của sản phẩm
            foreach($attribute_checked as $value){
                // Nếu chưa tồn tại thuộc tính thì thêm vào DB
                if(DB::table('attribute_variant_maps')->where('product_id', $product_id)->where('attribute_id', $value)->doesntExist()){
                    foreach($variants as $val){
                        DB::table('attribute_variant_maps')->insert(['product_id' => $product_id, 'attribute_id' => $value, 'attribute_detail_id' => 0, 'variant_id' => $val->id]);
                    }
                }
            }
        }
        // render lại view
        $variants = DB::table('variants')->where('product_id', $product_id)->get();
        $result['html'] = view('Ecommerce::admin.products.form.variant_item', ['variants'=>$variants, 'product_id'=>$product_id])->render();
        return $result;

    }
    public function addVariant(Request $requests){
        $attribute_detail   = $requests->attribute_detail;
        $variant_id         = $requests->variant_id;
        $product_id         = $requests->product_id;
        $variant_sku        = $requests->variant_sku;
        $variant_price      = $requests->variant_price;
        $variant_price_old  = $requests->variant_price_old;
        $variant_weight     = $requests->variant_weight;
        $variant_length     = $requests->variant_length;
        $variant_wide       = $requests->variant_wide;
        $variant_height     = $requests->variant_height;
        $variant_image      = $requests->variant_image;
        $created_at         = $updated_at = date('Y-m-d H:i:s');
        $db_insert_variant = [
            'product_id'    => $product_id,
            'sku'           => $variant_sku,
            'price'         => intval(str_replace(',', '', $variant_price)),
            'price_old'     => intval(str_replace(',', '', $variant_price_old)),
            'image'         => $variant_image,
            'length'        => intval(str_replace(',', '', $variant_length)),
            'wide'          => intval(str_replace(',', '', $variant_wide)),
            'height'        => intval(str_replace(',', '', $variant_height)),
            'weight'        => intval(str_replace(',', '', $variant_weight)),
            'created_at'    => $created_at,
            'updated_at'    => $updated_at,
        ];
        if($variant_id == 0){ // Thêm biến thể
            $id_variant_insert = DB::table('variants')->insertGetId($db_insert_variant);
        }else{
            $id_variant_insert = $variant_id;
            unset($db_insert_variant['created_at']);
            unset($db_insert_variant['product_id']);
            DB::table('variants')->where('id', $variant_id)->update($db_insert_variant);
        }

        $product_attribute_maps = DB::table("attribute_variant_maps")->where('product_id', $product_id)->pluck('attribute_id')->toArray();
        $product_attribute_maps = array_unique($product_attribute_maps);
        $k = 0;
        foreach($product_attribute_maps as $value){
            $db_insert_maps = [
                'product_id'            => $product_id,
                'attribute_id'          => $value,
                'attribute_detail_id'   => $attribute_detail[$k],
                'variant_id'            => $id_variant_insert,
            ];
            if($variant_id == 0){
                DB::table('attribute_variant_maps')->insert($db_insert_maps);
            }else{
                $db_update_maps = [
                    'attribute_detail_id'   => $attribute_detail[$k],
                ];
                DB::table('attribute_variant_maps')->where('product_id', $product_id)->where('variant_id', $variant_id)->where('attribute_id', $value)->update($db_update_maps);
            }
            $k++;
        }

        // render lại view
        $variants = DB::table('variants')->where('product_id', $product_id)->get();
        $result['html'] = view('Ecommerce::admin.products.form.variant_item', ['variants'=>$variants, 'product_id'=>$product_id])->render();
        return $result;
    }
    public function removeVariant(Request $requests){
        $variant_id   = $requests->variant_id;
        $product_id   = $requests->product_id;
        DB::table('variants')->where('id', $variant_id)->delete();
        DB::table('attribute_variant_maps')->where('variant_id', $variant_id)->delete();

        // render lại view
        $variants = DB::table('variants')->where('product_id', $product_id)->get();
        $result['html'] = view('Ecommerce::admin.products.form.variant_item', ['variants'=>$variants, 'product_id'=>$product_id])->render();
        return $result;
    }

    /**
     * Hiển thị popup sửa biến thể
     * @param  requests         $requests: dữ liệu form
     */
    public function showPopupEditVariant(Request $requests){
        $variant_id   = $requests->variant_id;
        $product_id   = $requests->product_id;
        $variant = DB::table('variants')->where('id', $variant_id)->first();

        $product_attribute_maps = DB::table("attribute_variant_maps")->where('product_id', $product_id)->pluck('attribute_id')->toArray();
        $product_attribute_maps = array_unique($product_attribute_maps);
        $result['html'] = view('Ecommerce::admin.products.form.popup_edit_variant', ['variant'=>$variant, 'product_id'=>$product_id, 'product_attribute_maps'=>$product_attribute_maps])->render();
        return $result;
    }
    /**
     * Hiển thị popup thêm biến thể
     * @param  requests         $requests: dữ liệu form
     */
    public function showPopupAddVariant(Request $requests){
        $product_id   = $requests->product_id;

        $product_attribute_maps = DB::table("attribute_variant_maps")->where('product_id', $product_id)->pluck('attribute_id')->toArray();
        $product_attribute_maps = array_unique($product_attribute_maps);
        $result['html'] = view('Ecommerce::admin.products.form.popup_add_variant', ['product_id'=>$product_id, 'product_attribute_maps'=>$product_attribute_maps])->render();
        return $result;
    }
    /**
     * Load thông số bộ lọc
     */
    public function getFilter(Request $requests) {
        $category_id = $requests->category_id ?? 0;
        $product_id = $requests->product_id ?? 0;
        $render_html = view('Ecommerce::admin.products.form.product_filter_item', compact('category_id', 'product_id'))->render();
        return [
            'status' => 1,
            'html' => $render_html
        ];
    }

    /**
     * Lưu thông tin bộ lọc của sản phẩm
     */
    public function setFilter($data, $id) {
        $store_data = [];
        \Sudo\Ecommerce\Models\ProductFilter::where('product_id', $id)->delete();
        foreach ($data as $value) {
            $store_data[] = [
                'product_id' => $id,
                'filter_detail_id' => $value
            ];
        }
        \Sudo\Ecommerce\Models\ProductFilter::insert($store_data);
    }
}
