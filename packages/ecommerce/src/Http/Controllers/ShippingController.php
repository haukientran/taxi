<?php

namespace Sudo\Ecommerce\Http\Controllers;
use Sudo\Base\Http\Controllers\AdminController;

use Illuminate\Http\Request;
use ListData;
use Form;
use ListCategory;
use DB;
use Auth;
class ShippingController extends AdminController
{
    function __construct() {
        $this->models = new \Sudo\Ecommerce\Models\Shipping;
        $this->table_name = $this->models->getTable();
        $this->module_name = 'Vận chuyển';
        $this->has_seo = false;
        $this->has_locale = false;
        parent::__construct();
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $shippings = DB::table('shippings')->where('status', 1)->orderBy('id', 'asc')->get();
        $disable_province = [];
        foreach($shippings as $value){
            $disable_province[] = $value->province_id;
        }
        $provinces = DB::table('shipping_provinces')->pluck('name', 'id')->toArray();
        $provinces[0] = 'Tất cả';
        ksort($provinces);
        // Khởi tạo form
        $form = new Form;

        $form->custom('Ecommerce::admin.shippings.form.shipping');

        return $form->render('create', compact('provinces', 'shippings', 'disable_province'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $requests)
    {
        $region = $requests->region;
        $province = DB::table('shipping_provinces')->where('id', $region)->first();
        $created_at = $updated_at = date('Y-m-d H:i:s');
        $db_insert = [
            'title'         => $province->name??'Tất cả',
            'province_id'   => $region,
            'status'        => 1,
            'created_at'    => $created_at,
            'updated_at'    => $updated_at,
        ];
        $id_shipping = DB::table('shippings')->insertGetId($db_insert);

        $db_shipping_rule = [
            'name'          => 'Delivery',
            'shipping_id'   => $id_shipping,
            'type'          => 'price',
            'from'          => 0,
            'to'            =>0,
            'price'         =>0,
            'created_at'    => $created_at,
            'updated_at'    => $updated_at,
        ];
        DB::table('shipping_rules')->insert($db_shipping_rule);
        return back();
    }
    public function removeRegion(Request $requests){
        $shipping_id = $requests->shipping_id;
        DB::table('shippings')->where('id', $shipping_id)->update(['status'=>4]);
        return 1;
    }
    public function createShippingRule(Request $requests){
        $shipping_id    = $requests->shipping_id;
        $name           = $requests->name;
        $type           = $requests->type;
        $from           = $requests->from;
        $to             = $requests->to;
        $price          = $requests->price;
        $order          = $requests->order;
        $created_at = $updated_at = date('Y-m-d H:i:s');
        $db_shipping_rule = [
            'name'          => $name,
            'shipping_id'   => $shipping_id,
            'type'          => $type,
            'from'          => intval(str_replace(',', '', $from)),
            'to'            => intval(str_replace(',', '', $to)),
            'price'         => intval(str_replace(',', '', $price)),
            'order'         => intval(str_replace(',', '', $order)),
            'created_at'    => $created_at,
            'updated_at'    => $updated_at,
        ];
        DB::table('shipping_rules')->insert($db_shipping_rule);
        return 1;
    }
    public function updateShippingRule(Request $requests){
        $shipping_rule_id    = $requests->shipping_rule_id;
        $name                = $requests->name;
        $type                = $requests->type;
        $from                = $requests->from;
        $to                  = $requests->to;
        $price               = $requests->price;
        $order               = $requests->order;
        $created_at          = $updated_at = date('Y-m-d H:i:s');

        $db_shipping_rule = [
            'name'          => $name,
            'type'          => $type,
            'from'          => intval(str_replace(',', '', $from)),
            'to'            => intval(str_replace(',', '', $to)),
            'price'         => intval(str_replace(',', '', $price)),
            'order'         => intval(str_replace(',', '', $order)),
            'updated_at'    => $updated_at,
        ];
        DB::table('shipping_rules')->where('id', $shipping_rule_id)->update($db_shipping_rule);
        return 1;
    }
    public function removeShippingRule(Request $requests){
        $shipping_rule_id = $requests->shipping_rule_id;
        DB::table('shipping_rules')->where('id', $shipping_rule_id)->update(['status'=>4]);
        return 1;
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
        $form->action('edit', $link);

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
        validateForm($requests, 'name', 'Tiêu đề không được để trống.');
        validateForm($requests, 'category_id', 'Danh mục không được để trống.');
        validateForm($requests, 'slug', 'Đường dẫn không được để trống.');
        validateForm($requests, 'slug', 'Đường dẫn đã bị trùng.', 'unique', 'unique:posts,slug,'.$id);
        // Lấy bản ghi
        $data_edit = $this->models->where('id', $id)->first();
        // Các giá trị mặc định
        $status = 0;
        // Đưa mảng về các biến có tên là các key của mảng
        extract($requests->all(), EXTR_OVERWRITE);
        // Chuẩn hóa lại dữ liệu
        $updated_at = $updated_at ?? date('Y-m-d H:i:s');
        // Các giá trị thay đổi
        $compact = compact('admin_user_id','name', 'slug', 'image', 'detail', 'status', 'updated_at');
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
