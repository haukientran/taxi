<?php

namespace Sudo\Ecommerce\Http\Controllers;
use Sudo\Base\Http\Controllers\AdminController;

use Illuminate\Http\Request;
use ListData;
use Form;
use ListCategory;
use DB;
use Auth;
use Carbon\Carbon;
use \Sudo\Ecommerce\Models\Order;
use \Sudo\Ecommerce\Models\OrderDetail;
use \Sudo\Ecommerce\Models\OrderHistory;
use \Sudo\Ecommerce\Models\Customer;
use PDF;
class OrderController extends AdminController
{
    function __construct() {
        $this->models = new \Sudo\Ecommerce\Models\Order;
        $this->table_name = $this->models->getTable();
        $this->module_name = 'Đơn hàng';
        $this->has_seo = false;
        $this->has_locale = false;
        parent::__construct();

        $this->order_status = [
            1 => 'Đơn hàng mới',
            11=> 'Đang liên hệ', // để 11 tức là 1.1 không nên sửa thành 2, vì sẽ ảnh hướng rất nhiều đến cái khác
            2 => 'Đã tiếp nhận',
            3 => 'Huỷ',
            4 => 'Thành công',
        ];

        $this->payment_method = config('SudoOrder.payment_method');
        $this->payment_status = config('SudoOrder.payment_status');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $requests) {
        $listdata = new ListData($requests, $this->models, 'Ecommerce::admin.orders.table.index', $this->has_locale);
        $order_status = $this->order_status;
        $payment_method = $this->payment_method;
        // Build Form tìm kiếm
        $listdata->search('code', 'Mã đơn hàng', 'string');
        $listdata->search('customer_phone', 'Điện thoại người đặt', 'string');
        $listdata->search('created_at', 'Ngày tạo', 'range');
        $listdata->search('status', 'Trạng thái', 'array', $order_status);
        // Build bảng
        $listdata->add('id', 'Mã đơn hàng', 0);
        $listdata->add('', 'Thông tin người đặt', 0);
        $listdata->add('total_price', 'Giá trị đơn', 0);
        $listdata->add('note', 'Ghi chú đơn', 0);
        $listdata->add('status', 'Trạng thái', 0);
        $listdata->add('payment_status', 'Tình trạng thanh toán', 0);
        $listdata->add('created_at', 'Thời gian', 0, 'time');
        $listdata->add('', 'Xem', 0, 'show');
        $listdata->add('', 'Xóa', 0, 'delete');
        $listdata->no_trash();
        // Trả về views
        $data = $listdata->data();
        $show_data = $data['show_data'] ?? [];
        $customer_array_id = $show_data->pluck('customer_id')->toArray();
        $customers = Customer::whereIn('id', $customer_array_id)->get();
        $payment_status = $this->payment_status;

        return $listdata->render(compact('data', 'customers', 'payment_status'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $payment_status = [0=>'Chưa thanh toán', 1=>'Đã thanh toán'];
        $form = new Form;
        // $form->title('Thông tin khách hàng');
        $form->card('col-lg-8', 'Thông tin đặt hàng');
            $form->select('payment_method', '', 0, 'Hình thức thanh toán', $this->payment_method, 0);
            $form->select('payment_status', '', 0, 'Tình trạng thanh toán', $payment_status, 0);
            $form->textarea('note', '', 0, 'Ghi chú');
        $form->endCard();
        $form->card('col-lg-4', 'Thông tin khách hàng');
            $form->custom('Ecommerce::admin.orders.form.search_or_create');
            $form->hidden('info_user_id', 0, 0, 'Tên người đặt');
            $form->text('email', '', 1, 'Email', '');
            $form->text('name', '', 1, 'Tên', '');
            $form->text('phone', '', 1, 'Điện thoại', '');
            $form->text('address', '', 0, 'Địa chỉ', '');
        $form->endCard();
        
        $form->card('col-lg-12', 'Thông tin sản phẩm');
            $form->custom('Ecommerce::admin.orders.form.product_in_orders', [
                'name' => 'products',
                'value' => [],
            ]);
        $form->endCard();
        $form->action('add');
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
        validateForm($requests, 'products', 'Sản phẩm không được để trống.');
        // Đưa mảng về các biến có tên là các key của mảng
        extract($requests->all(), EXTR_OVERWRITE);
        $order_code = $this->randomOrderCode();
        // Khách hàng
        if($info_user_id > 0){
            $data_user = DB::table('customers')->where('id', $info_user_id)->first();
            $customers = [
                'name'      => $data_user->name,
                'phone'     => $data_user->phone,
                'email'     => $data_user->email,
                'address'   => $data_user->address,
            ];
        }else{
            $customers = [
                'name'      => $name,
                'phone'     => $phone,
                'email'     => $email,
                'address'   => $address,
            ];
        }
        $customer_id = Customer::add($customers);
        $orders = [
            'customer_id'       => $customer_id,
            'code'              => $order_code,
            'payment_method'    => $payment_method,
            'payment_status'    => $payment_status,
            'note'              => $note,
            'total_price'       => $total_price,
        ];
        $order_id = Order::add($orders);
        OrderHistory::add($order_id, 'admin_create');
        if (isset($products) && !empty($products)) {
            foreach ($products as $value) {
                $variants = $this->getVariants($value['id'], $value['variant_id']);
                $order_detail = [
                    'order_id'      => $order_id,
                    'product_id'    => $value['id'] ?? 0,
                    'price'         => $value['price'] ?? 0,
                    'quantity'      => $value['quantity'] ?? 0,
                    'variant_id'    => $value['variant_id'] ?? 0,
                    'variant_text'  => $variants,
                ];
                OrderDetail::add($order_detail);
            }
        }
        // Điều hướng
        if ($redirect == 'edit') {
            $redirect = 'show';
        }
        return redirect(route('admin.'.$this->table_name.'.'.$redirect, $order_id))->with([
            'type' => 'success',
            'message' => __('Translate::admin.update_success')
        ]);
    }

    /**
     * Trả về thông tin biến thể dạng text để lưu vào đơn hàng
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getVariants($product_id, $variant_id){
        $variant = DB::table('variants')->where('id', $variant_id)->first();
        $product = DB::table('products')->where('id', $product_id)->first();
        $attributes = DB::table('attributes')->where('status', 1)->leftJoin('attribute_variant_maps', 'attribute_variant_maps.attribute_id', 'attributes.id')->where('attribute_variant_maps.product_id', $product_id)->pluck('name', 'id')->toArray();
        $attribute_details = DB::table('attribute_details')->leftJoin('attribute_variant_maps', 'attribute_variant_maps.attribute_detail_id', 'attribute_details.id')->where('attribute_variant_maps.product_id', $product_id)->pluck('name', 'id')->toArray();

        $attribute_variant_maps = DB::table('attribute_variant_maps')->where('product_id', $product_id)->where('variant_id', $variant_id)->get();

        $variants = [];
        foreach($attribute_variant_maps as $key => $value){
            $variants['attibute'][] = $attributes[$value->attribute_id].': '.$attribute_details[$value->attribute_detail_id];
        }
        $variants['name'] = $product->name??'';
        $variants['image'] = $variant->image??'';
        $variants['price'] = $variant->price??'';
        return json_encode($variants);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $payment_method = $this->payment_method;
        // Toàn bộ admin_user để hiển thị cho lịch xử
        $admin_user_query = \DB::table('admin_users')->get();
        $admin_users = [];
        foreach ($admin_user_query as $value) {
            $admin_users[$value->id] = $value->display_name ?? $value->name;
        }
        // Lấy bản ghi
        $order = $this->models->where('id', $id)->first();
        // Khách hàng
        $customers = Customer::where('id', $order->customer_id)->first();
        // Thông tin sản phẩm
        $order_details = OrderDetail::where('order_id', $order->id)->get();
        // Lịch sử hành động của đơn hàng
        $order_histories = OrderHistory::getOrderHistory($order->id);
        $payment_status = $this->payment_status;
        return view('Ecommerce::admin.orders.show', compact(
            'payment_method',
            'admin_users',
            'order',
            'customers',
            'order_details',
            'payment_status',
            'order_histories'
        ));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        // Lấy bản ghi
        $data_edit = $this->models->where('id', $id)->first();
        // Chỉ được sửa khi ở trạng thái đã tiếp nhận
        if ($data_edit->status != 2) {
            return redirect(route('admin.orders.show', $id))->with([
                'type' => 'success',
                'message' => __('Để sửa đơn hàng phải ở trạng thái Đã tiếp nhận')
            ]);
        }
        // Khách hàng
        $customers = Customer::where('id', $data_edit->customer_id)->first();
        // Thông tin sản phẩm
        $order_details = OrderDetail::where('order_id', $data_edit->id)->get();
        $product_details = [];
        foreach ($order_details as $value) {
            $product_details[] = [
                'product_id' => $value->product_id,
                'quantity' => $value->quantity,
                'price' => $value->price,
            ];
        }
        // Khởi tạo form
        $form = new Form;
        $form->title('Thông tin khách hàng');
        $form->text('name', $customers->name, 1, 'Tên người đặt');
        $form->text('phone', $customers->phone, 1, 'Điện thoại');
        $form->text('email', $customers->email, 0, 'Email');
        $form->text('address', $customers->address, 0, 'Địa chỉ');
        $form->select('payment_method', $data_edit->payment_method, 1, 'Hình thức thanh toán', $this->payment_method, 0);
        $form->textarea('note', $data_edit->note, 0, 'Ghi chú');
        $form->title('Thông tin Sản phẩm');
        $form->custom('Ecommerce::admin.orders.form.product_in_orders', [
            'name' => 'products',
            'value' => $product_details,
            'order_details' => $order_details,
        ]);
        $form->action('edit');
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
        validateForm($requests, 'name', 'Tên người đặt không được để trống.');
        validateForm($requests, 'phone', 'Điện thoại người đặt không được để trống.');
        validateForm($requests, 'payment_method', 'Hình thức thanh toán không được để trống.');
        validateForm($requests, 'products', 'Sản phẩm không được để trống.');
        // Lấy bản ghi
        $data_edit = $this->models->where('id', $id)->first();
        // Chỉ được sửa khi ở trạng thái đã tiếp nhận
        if ($data_edit->status != 2) {
            return redirect(route('admin.orders.show', $id))->with([
                'type' => 'success',
                'message' => __('Để sửa đơn hàng phải ở trạng thái Đã tiếp nhận')
            ]);
        }
        // Đưa mảng về các biến có tên là các key của mảng
        extract($requests->all(), EXTR_OVERWRITE);
        // Lịch sử thay đổi cập nhật trước khi update bất kỳ thông gì
        $data_history = [];
        $customer_history = Customer::where('phone', $phone)->first();
        $data_history['old'] = [
            'customers' => [
                'name'      => (string)$customer_history->name ?? '',
                'phone'     => (string)$customer_history->phone ?? '',
                'email'     => (string)$customer_history->email ?? '',
                'address'   => (string)$customer_history->address ?? '',
            ],
            'orders' => [
                'note' => (string)$data_edit->note,
                'payment_method' => (int)$data_edit->payment_method,
            ],
        ];
        $data_history['new'] = [
            'customers' => [
                'name'      => (string)$name,
                'phone'     => (string)$phone,
                'email'     => (string)$email,
                'address'   => (string)$address,
            ],
            'orders' => [
                'note' => (string)$note,
                'payment_method' => (int)$payment_method,
            ],
        ];
        $detail_history = OrderDetail::where('order_id', $id)->get();
        if (isset($detail_history) && !empty($detail_history)) {
            foreach ($detail_history as $value) {
                $order_detail = [
                    'order_id'      => (int)$id,
                    'product_id'    => (int)$value->product_id ?? 0,
                    'price'         => (int)$value->price ?? 0,
                    'quantity'      => (int)$value->quantity ?? 0,
                ];
                $data_history['old']['products'][] = $order_detail;
            }
        }
        if (isset($products) && !empty($products)) {
            foreach ($products as $value) {
                $variants = $this->getVariants($value['id'], $value['variant_id']);
                $order_detail = [
                    'order_id'      => (int)$id,
                    'product_id'    => (int)$value['id'] ?? 0,
                    'price'         => (int)$value['price'] ?? 0,
                    'quantity'      => (int)$value['quantity'] ?? 0,
                    'variant_id'    => (int)$value['variant_id'] ?? 0,
                    'variant_text'  => $variants,
                ];
                $data_history['new']['products'][] = $order_detail;
            }
        }
        // Khách hàng
        $customers = [
            'name'      => $name,
            'phone'     => $phone,
            'email'     => $email,
            'address'   => $address,
        ];
        $customer_id = Customer::add($customers);
        // Đơn hàng
        $orders = [
            'customer_id'       => $customer_id,
            'payment_method'    => $payment_method,
            'note'              => $note,
            'total_price'       => $total_price,
            'updated_at'        => date('Y-m-d H:i:s'),
        ];
        \DB::table('orders')->where('id', $id)->update($orders);
        if ($data_history['new'] != $data_history['old']) {
            OrderHistory::add($id, 'order_change', $data_history);
        }
        // Chi tiết đơn hàng
        if (isset($products) && !empty($products)) {
            OrderDetail::where('order_id', $id)->delete();
            foreach ($products as $value) {
                $variants = $this->getVariants($value['id'], $value['variant_id']);
                $order_detail = [
                    'order_id'      => $id,
                    'product_id'    => $value['id'] ?? 0,
                    'price'         => $value['price'] ?? 0,
                    'quantity'      => $value['quantity'] ?? 0,
                    'variant_id'    => $value['variant_id'] ?? 0,
                    'variant_text'  => $variants,
                ];
                OrderDetail::add($order_detail);
            }
        }
        // Điều hướng
        if ($redirect == 'edit') {
            $redirect = 'show';
        }
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
     * Xử lý đa danh mục
     * @param  requests         $requests: dữ liệu form
     * @param  int              $id: ID post_id
     */
    public function categoryHandle($requests, $id) {
        // Đưa mảng về các biến có tên là các key của mảng
        extract($requests->all(), EXTR_OVERWRITE);
        // Kiểm tra có tồn tại category_id không
        if (isset($category_id) && !empty($category_id)) {
            // Xóa post_id hiện tại
            \DB::table('post_category_maps')->where('post_id', $id)->delete();
            // Thêm mảng check mới
            $post_category_maps = [];
            foreach ($category_id as $post_category_id) {
                $post_category_maps[] = [
                    'post_id' => $id,
                    'post_category_id' => $post_category_id,
                ];
            }
            \DB::table('post_category_maps')->insert($post_category_maps);
        }
    }
    public function suggetCustomers(Request $requests){
        $key = $requests->key;
        $customers = DB::table('customers')->where('name', 'like', '%'.$key.'%')->orWhere('email', 'like', '%'.$key.'%')->orWhere('phone', 'like', '%'.$key.'%')->limit(10)->get();
        $result['status'] = 1;
        $result['html'] = view('Ecommerce::admin.orders.form.list_users', compact('customers'))->render();
        return $result;
        
    }
    public function randomOrderCode()
    {
        $max = \DB::table('orders')->max('id');
        if(empty($max)){
            $max = 0;
        }
        $max = $max+1;
        return strtoupper(env('APP_NAME') . '_' . date('y') . $max);
    }
    /**
     * Ghi chú dành cho Admin
     */
    public function adminNote(Request $requests) {
        // Không có quyền sửa thì trả về trang chủ
        if (!checkRole($this->table_name.'_edit')) {
            return redirect(route('admin.home'))->with([
                'type' => 'danger',
                'message' => 'Translate::admin.role.no_permission',
            ]);
        }
        // 
        $note = $requests->admin_note;
        $order_id = $requests->order_id;
        // Không có note sẽ không ghi
        if (!empty($note)) {
            OrderHistory::add($order_id, 'admin_note', $note);
        }
        return redirect(route('admin.orders.show', $order_id));
    }

    /**
     * Tiếp nhận đơn hàng
     */
    public function accepts(Request $requests) {
        // Không có quyền sửa thì trả về trang chủ
        if (!checkRole($this->table_name.'_edit')) {
            return redirect(route('admin.home'))->with([
                'type' => 'danger',
                'message' => 'Translate::admin.role.no_permission',
            ]);
        }
        // ID đơn hàng
        $order_id = $requests->order_id;
        // Lấy bản ghi
        $order = $this->models->where('id', $order_id)->first();
        // Nếu trạng thái đơn không phải đơn hàng mới thì sẽ không cho tiếp nhận
        if ($order->status == 1) {
            // Đổi trạng thái tiếp nhận
            $this->models->where('id', $order_id)->update(['status' => 2]);
            // Ghi lịch sử
            OrderHistory::add($order_id, 'received');
            return redirect(route('admin.orders.show', $order_id))->with([
                'type' => 'success',
                'message' => 'Cập nhật trạng thái thành công.',
            ]);
        } else {
            return redirect(route('admin.orders.show', $order_id))->with([
                'type' => 'danger',
                'message' => 'Chỉ chuyển được khi đơn là đơn hàng mới.',
            ]);
        }
    }

    /**
     * Thành công
     */
    public function success(Request $requests) {
        // Không có quyền sửa thì trả về trang chủ
        if (!checkRole($this->table_name.'_edit')) {
            return redirect(route('admin.home'))->with([
                'type' => 'danger',
                'message' => 'Translate::admin.role.no_permission',
            ]);
        }
        // ID đơn hàng
        $order_id = $requests->order_id;
        // Lấy bản ghi
        $order = $this->models->where('id', $order_id)->first();
        // Nếu trạng thái đơn không phải đơn hàng mới thì sẽ không cho tiếp nhận
        if ($order->status == 2) {
            // Đổi trạng thái tiếp nhận
            $this->models->where('id', $order_id)->update(['status' => 4]);
            // Ghi lịch sử
            OrderHistory::add($order_id, 'order_success');
            return redirect(route('admin.orders.show', $order_id))->with([
                'type' => 'success',
                'message' => 'Cập nhật trạng thái thành công.',
            ]);
        } else {
            return redirect(route('admin.orders.show', $order_id))->with([
                'type' => 'danger',
                'message' => 'Chỉ chuyển được khi đơn đang được tiếp nhận.',
            ]);
        }
    }

    /**
     * Từ chối
     */
    public function denined(Request $requests) {
        // Không có quyền sửa thì trả về trang chủ
        if (!checkRole($this->table_name.'_edit')) {
            return redirect(route('admin.home'))->with([
                'type' => 'danger',
                'message' => 'Translate::admin.role.no_permission',
            ]);
        }
        // ID đơn hàng
        $order_id = $requests->order_id;
        // Lấy bản ghi
        $order = $this->models->where('id', $order_id)->first();
        // Nếu trạng thái đơn không phải đơn hàng mới thì sẽ không cho tiếp nhận
        if ($order->status == 2) {
            // Đổi trạng thái tiếp nhận
            $this->models->where('id', $order_id)->update(['status' => 3]);
            // Ghi lịch sử
            OrderHistory::add($order_id, 'order_fail');
            return redirect(route('admin.orders.show', $order_id))->with([
                'type' => 'success',
                'message' => 'Cập nhật trạng thái thành công.',
            ]);
        } else {
            return redirect(route('admin.orders.show', $order_id))->with([
                'type' => 'danger',
                'message' => 'Chỉ chuyển được khi đơn đang được tiếp nhận.',
            ]);
        }
    }

    public function embedHistory(Request $requests) {
        // Không có quyền sửa thì trả về trang chủ
        if (!checkRole($this->table_name.'_index')) {
            exit(__('Translate::admin.role.no_permission'));
        }
        // Lịch sử
        $history_id = $requests->order_history_id;
        // Chi tiết lịch sử
        $order_history = OrderHistory::where('id', $history_id)->first();
        // Nếu có dữ liệu thì mới hiển thị ra view
        if (isset($order_history->data) && !empty($order_history->data)) {
            $data = json_decode(base64_decode($order_history->data), true);
            $payment_method = $this->payment_method;
            return view('Order::admin.orders.embed_history', compact('data', 'payment_method'));
        } else {
            exit(__('Lịch sử trống'));
        }
    }
    public function downloadInvoice($order_id){
        $order = Order::find($order_id);
        $customer = Customer::find($order->customer_id);
        $order_detail = OrderDetail::where('order_id', $order->id)->get();
        $pdf = PDF::loadView('Ecommerce::admin.orders.download_invoice',  compact('order', 'customer', 'order_detail'));
        return $pdf->download($order->code.'.pdf');
    }
    public function confirmPayment(Request $requests){
        // Không có quyền sửa thì trả về trang chủ
        if (!checkRole($this->table_name.'_edit')) {
            return redirect(route('admin.home'))->with([
                'type' => 'danger',
                'message' => 'Translate::admin.role.no_permission',
            ]);
        }
        // ID đơn hàng
        $order_id = $requests->order_id;
        // Lấy bản ghi
        $order = $this->models->where('id', $order_id)->first();
        // Nếu tình trạng thanh toán đang là chưa thanh toán thì cho phép chuyển trạng thái
        if ($order->payment_status == 0) {

            $this->models->where('id', $order_id)->update(['payment_status' => 1]);
            // Ghi lịch sử
            OrderHistory::add($order_id, 'comfirm_payment');
            return redirect(route('admin.orders.show', $order_id))->with([
                'type' => 'success',
                'message' => 'Xác nhận thanh toán thành công.',
            ]);
        } else {
            return redirect(route('admin.orders.show', $order_id))->with([
                'type' => 'danger',
                'message' => 'Xác nhận thanh toán không thành công',
            ]);
        }
    }
    public function refund(Request $requests){
        // Không có quyền sửa thì trả về trang chủ
        if (!checkRole($this->table_name.'_edit')) {
            return redirect(route('admin.home'))->with([
                'type' => 'danger',
                'message' => 'Translate::admin.role.no_permission',
            ]);
        }
        $refund_money = $requests->refund_money??'';
        $refund_reason = $requests->refund_reason??'';
        // ID đơn hàng
        $order_id = $requests->order_id;
        // Lấy bản ghi
        $order = $this->models->where('id', $order_id)->first();
        // Nếu tình trạng thanh toán đang là đã thanh toán thì cho phép chuyển trạng thái hoàn tiền
        if ($order->payment_status == 1) {

            $this->models->where('id', $order_id)->update(['payment_status' => -1, 'status' => 3, 'refund_money' => $refund_money, 'refund_reason' => $refund_reason]);
            // Ghi lịch sử
            OrderHistory::add($order_id, 'order_fail');
            OrderHistory::add($order_id, 'refund');
            return redirect(route('admin.orders.show', $order_id))->with([
                'type' => 'success',
                'message' => 'Yêu cầu hoàn tiền thành công',
            ]);
        } else {
            return redirect(route('admin.orders.show', $order_id))->with([
                'type' => 'danger',
                'message' => 'Yêu cầu hoàn tiền không thành công',
            ]);
        }
    }

    /**
     * Tìm kiếm và trả về dữ liệu tại bảng products
     * @param string     $request->table: tên bảng
     * @param string     $request->table_field: Tên cột lấy tên
     * @param string     $request->keyword: tên trường
     * @param string     $request->suggest_locale: có search theo đa ngôn ngữ hay không
     * @param array      $request->id_not_where: Không lấy id có tại mảng này
     */
    public function suggestProducts(Request $request) {
        $table = $request->table ??'';
        $table_field = $request->table_field ?? 'name';
        $keyword = $request->keyword ?? '';
        $suggest_locale = $request->suggest_locale ?? 'false';
        $id_not_where = $request->id_not_where ?? [];

        $lists = DB::table('products')->where('status',1);
        // Search theo đa ngôn ngữ
        if ($suggest_locale == 'true') {
            $lists = $lists->join('language_metas', 'language_metas.lang_table_id', $table.'.id')
                                ->where('language_metas.lang_table', $table)
                                ->where('language_metas.lang_locale', Request()->lang_locale ?? \App::getLocale())
                                ->select($table.'.*');     
        }
        // Tiếp tục tìm
        $products = $lists->whereNotIn('id',$id_not_where)->where($table_field,'like','%'.$keyword.'%')->orderBy('id','DESC')->limit(30)->get();
        $html = view('Ecommerce::admin.orders.form.product_in_orders_item', ['data' => $products])->render();
        if ($products->count()) {
            return response()->json(['status' => 1, 'message' => __('Translate::admin.has_found_data'), 'data' => $products, 'html' => $html]);
        } else {
            return response()->json(['status' => 0, 'message' => __('Translate::admin.not_found_data')]);
        }
    }
}
