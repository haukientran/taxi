<?php

namespace Sudo\Theme\Http\Controllers\Admin;
use Sudo\Base\Http\Controllers\AdminController;

use Illuminate\Http\Request;
use DB;
use Form;

class SettingController extends AdminController
{
    function __construct() {
        parent::__construct();
        $this->models = new \Sudo\Theme\Models\Setting;
        $this->table_name = $this->models->getTable();
    }

    // Cấu hình chung
    public function general(Request $requests) {
        $setting_name = 'general';
        $module_name = "Cấu hình giao diện";
        $note = "Translate::form.require_text";
        // Thêm hoặc cập nhật dữ liệu
        if (isset($requests->redirect)) {
            $this->models->postData($requests, $setting_name);
        }
        // Lấy dữ liệu ra
        $data = $this->models->getData($setting_name);
        // Khởi tạo form
        $form = new Form;
        $form->card('col-lg-12');
            $form->image('logo_header_desktop', $data['logo_header_desktop']??'', 0, 'Logo hiển thị header desktop', 'Chọn ảnh','', true);
            $form->image('logo_header_mobile', $data['logo_header_mobile']??'', 0, 'Logo hiển thị header mobile', 'Chọn ảnh', '', true);
        $form->endCard();
        $form->action('editconfig');
        // Hiển thị form tại view
        return $form->render('custom', compact(
            'note','module_name'
        ), 'Default::admin.settings.form');
    }
    public function menu(Request $requests){
        $setting_name = 'menu';
        $module_name = "Cấu hình menu";
        $note = "Translate::form.require_text";

        // Thêm hoặc cập nhật dữ liệu
        if (isset($requests->redirect)) {
            $this->models->postData($requests, $setting_name);
        }
        // Lấy dữ liệu ra
        $data = $this->models->getData($setting_name);
        // Khởi tạo form
        $form = new Form;
        $form->card('col-lg-12');
            $form->customMenu('primary_menu', $data['primary_menu'] ?? '', 'Menu header');
            $form->customMenu('footer_menu', $data['footer_menu'] ?? '', 'Menu Footer');
        $form->endCard();
        $form->action('editconfig');
        // Hiển thị form tại view
        return $form->render('custom', compact(
            'module_name', 'note'
        ), 'Default::admin.settings.form');
    }

    // Cấu hình trang chủ
    public function home(Request $requests) {
        $setting_name = 'home';
        $module_name = "Cấu hình trang chủ";
        $note = "Translate::form.require_text";
        // Thêm hoặc cập nhật dữ liệu
        if (isset($requests->redirect)) {
            $this->models->postData($requests, $setting_name);
        }
        // Lấy dữ liệu ra
        $data = $this->models->getData($setting_name);
        // Khởi tạo form
        $form = new Form;
        $form->card('col-lg-12');
            $form->text('meta_title', $data['meta_title'] ?? '', 0, 'Meta Title','', true);
            $form->textarea('meta_description', $data['meta_description'] ?? '', 0, 'Meta Description', '', 5,true);
            $form->image('meta_image', $data['meta_image'] ?? '', 0, 'Meta Image', 'Chọn ảnh','', true);
        $form->endCard();
        $form->title('Cấu hình section CATEGORIES');
            $form->custom('Form::custom.form_custom', [
                'has_full' => false,
                'name' => 'categories',
                'value' => $data['categories'] ?? [],
                'label' => 'Add item',
                'generate' => [
                    [ 'type' => 'image', 'name' => 'image_item', 'size' => 'Chọn ảnh có kích thước '.'XXXxXXX', ],
                    [ 'type' => 'custom', 'generate' => [
                            [ 'type' => 'text', 'name' => 'title1_item', 'placeholder' => 'Tiêu đề 1', ],
                            [ 'type' => 'text', 'name' => 'title2_item', 'placeholder' => 'Tiêu đề 2', ],
                            [ 'type' => 'text', 'name' => 'link_item', 'placeholder' => 'Đường dẫn', ],
                            [ 'type' => 'textarea', 'name' => 'animate_item', 'placeholder' => 'Hướng dẫn chọn animate: fadeInLeft = trượt từ bên trái sang, fadeInDown = trượt từ trên xuống, fadeInRight = Trượt từ phải sang, fadeInUp = trượt từ dưới lên', ],
                        ]
                    ],
                ],
            ]);
        $form->action('editconfig', route('app.home'));
        // Hiển thị form tại view
        return $form->render('custom', compact(
            'module_name', 'note'
        ), 'Default::admin.settings.form');
    }

    //Cấu hình trang liên hệ
    public function contact(Request $requests){
        $setting_name = 'contact';
        $module_name = "Cấu hình trang liên hệ";
        $note = "Translate::form.require_text";
        // Thêm hoặc cập nhật dữ liệu
        if (isset($requests->redirect)) {
            $this->models->postData($requests, $setting_name);
        }
        // Lấy dữ liệu ra
        $data = $this->models->getData($setting_name);
        // Khởi tạo form
        $form = new Form;
        $form->card('col-lg-12');
            $form->text('meta_title', $data['meta_title'] ?? '', 0, 'Meta Title','', true);
            $form->textarea('meta_description', $data['meta_description'] ?? '', 0, 'Meta Description', '', 5,true);
            $form->image('meta_image', $data['meta_image'] ?? '', 0, 'Meta Image', 'Chọn ảnh','', true);
        $form->endCard();
        $form->action('editconfig', route('app.home'));
        // Hiển thị form tại view
        return $form->render('custom', compact(
            'module_name', 'note'
        ), 'Default::admin.settings.form');
    }
    // Cấu hình tổng quan
    public function overview(Request $requests){
        $setting_name   = 'overview';
        $module_name    = "Cài đặt";
        $note           = "Translate::form.require_text";

        $nation = [0=>'Lựa chọn...', 1 => 'Việt Nam'];
        // Thêm hoặc cập nhật dữ liệu
        if (isset($requests->redirect)) {
            $this->models->postData($requests, $setting_name);
        }
        // Lấy dữ liệu ra
        $data = $this->models->getData($setting_name);
        // Khởi tạo form
        $form = new Form;
        $form->card('col-lg-3');
            $form->custom('Default::admin.custom.sidebar');
        $form->endCard();
        $form->card('col-lg-9', 'Tổng quan');
            $form->row();
                $form->text('name_company', $data['name_company']??'', 0, 'Tên công ty', '', false, 'col-lg-6');
                $form->text('domain', $data['domain']??'', 0, 'Tên miền', 'Không bao gồm https:// hay www. VD: sudo.vn', false, 'col-lg-6');
            $form->endRow();
            $form->row();
                $form->text('address', $data['address']??'', 0, 'Địa chỉ', '', false, 'col-lg-4');
                $form->select('nation', $data['nation']??'', 0, 'Quốc gia', $nation,0, [], false, 'col-lg-4');
                $form->text('zip_code', $data['zip_code']??'', 0, 'Mã bưu điện', '', false, 'col-lg-4');
            $form->endRow();
            $form->row();
                $form->email('email', $data['email']??'', 0, 'Email (nhận thông báo từ website)', '', false, 'col-lg-4');
                $form->text('phone', $data['phone']??'', 0, 'Điện thoại', '', false, 'col-lg-4');
                $form->text('hotline', $data['hotline']??'', 0, 'Di động (Hotline)', '', false, 'col-lg-4');
            $form->endRow();
            $form->actionInline('editconfig');
        $form->endCard();
        // Hiển thị form tại view
        return $form->render('custom', compact(
            'note', 'module_name', 'setting_name'
        ), 'Default::admin.settings.form');
    }

    // Cấu hình email
    public function email(Request $requests){
        $setting_name   = 'email';
        $module_name    = "Cài đặt";
        $note           = "Translate::form.require_text";
        $protocol = [
            'smtp'      => 'SMTP', 
        ];
        $smtp_encryption = [
            'tls'=>'TLS',
        ];
        // Thêm hoặc cập nhật dữ liệu
        if (isset($requests->redirect)) {
            $this->models->postData($requests, $setting_name);
        }
        // Lấy dữ liệu ra
        $data = $this->models->getData($setting_name);
        // Khởi tạo form
        $form = new Form;
        $form->card('col-lg-3');
            $form->custom('Default::admin.custom.sidebar');
        $form->endCard();
        $form->card('col-lg-9', 'Email');
            $form->tab('', ['Cài đặt SMTP', 'Nội dung gửi Email'], ['setting_email', 'content_email'], true);
                $form->contentTab('setting_email');
                    $form->select('protocol', $data['protocol']??'', 0, 'Giao thức', $protocol, 0);
                    $form->row();
                        $form->text('smtp_host', $data['smtp_host']??'', 0, 'Máy chủ gửi SMTP', '', false, 'col-lg-4');
                        $form->text('smtp_port', $data['smtp_port']??'', 0, 'Cổng (Port)', '', false, 'col-lg-4');
                        $form->select('smtp_encryption', $data['smtp_encryption']??'', 0, 'Kiểu mã hóa', $smtp_encryption,0, [], false, 'col-lg-4');
                    $form->endRow();
                    $form->row();
                        $form->text('smtp_username', $data['smtp_username']??'', 0, 'Tên đăng nhập', '', false, 'col-lg-4');
                        $form->password('smtp_password', $data['smtp_password']??'', 0, 'Mật khẩu', '', '', false, 'col-lg-4');
                        $form->text('smtp_charset', $data['smtp_charset']??'utf-8', 0, 'Email Charset (Mặc định utf-8)', '', false, 'col-lg-4');
                    $form->endRow();
                    $form->row();
                        $form->text('from_address', $data['from_address']??'', 0, 'Email gửi thư', 'Thường dùng với email đăng nhập', false, 'col-lg-4');
                        $form->text('from_name', $data['from_name']??'', 0, 'Tên người gửi', 'VD: Sudo', false, 'col-lg-4');
                        $form->text('smtp_email_reply_to', $data['smtp_email_reply_to']??'', 0, 'Email nhận thư khi người dùng trả lời', 'VD: info@sudo.vn', false, 'col-lg-4');
                    $form->endRow();
                    $form->custom('Default::admin.custom.note');
                    $form->title('Kiểm tra cấu hình email');
                    $form->email('test_mail', '', 0, 'Email nhận thư', '', false, 'col-lg-3');
                    $form->custom('Default::admin.custom.btn_check_email');
                $form->endContentTab();

                $form->contentTab('content_email');
                    $form->title('Email thông báo liên hệ');
                    $form->text('content_subject', $data['content_subject']??'', 0, 'Tiêu đề thư', '');
                    $form->text('content_name', $data['content_name']??'', 0, 'Tên người gửi', '');
                    $form->title('Các biến có thể sử dụng trong "Nội dung thư"');
                    $form->custom('Default::admin.custom.param_email', ['param' => ['name'=>'Tên người gửi', 'address'=>'Địa chỉ', 'phone'=>'Điện thoại', 'content'=>'Nội dung liên hệ']]);
                    $form->editor('content_detail', $data['content_detail']??'', 0, 'Nội dung thư', '');
                $form->endContentTab();
            $form->endTab(true);
        $form->endCard();
        $form->action('editconfig');
        // Hiển thị form tại view
        return $form->render('custom', compact(
            'note', 'module_name', 'setting_name'
        ), 'Default::admin.settings.form');
    }

    // Cấu hình mã chuyển đổi
    public function code(Request $requests){
        $setting_name   = 'code';
        $module_name    = "Cài đặt";
        $note           = "Translate::form.require_text";

        // Thêm hoặc cập nhật dữ liệu
        if (isset($requests->redirect)) {
            $this->models->postData($requests, $setting_name);
        }
        // Lấy dữ liệu ra
        $data = $this->models->getData($setting_name);
        // Khởi tạo form
        $form = new Form;
        $form->card('col-lg-3');
            $form->custom('Default::admin.custom.sidebar');
        $form->endCard();
        $form->card('col-lg-9', 'Mã chuyển đổi');
            $form->textarea('html_head', $data['html_head']??'', 0, 'Mã html chèn vào thẻ head');
            $form->textarea('html_body', $data['html_body']??'', 0, 'Mã html chèn vào sau thẻ mở body');
        $form->endCard();
        $form->action('editconfig');
        // Hiển thị form tại view
        return $form->render('custom', compact(
            'note', 'module_name', 'setting_name'
        ), 'Default::admin.settings.form');
    }

    // Cấu hình mã chuyển đổi
    public function googleAuthenticate(Request $requests){
        $setting_name   = 'googleAuthenticate';
        $module_name    = "Bảo mật 2 lớp Google Authenticate";
        $note           = "Translate::form.require_text";

        // Thêm hoặc cập nhật dữ liệu
        if (isset($requests->redirect)) {
            $this->models->postData($requests, $setting_name);
        }
        // Lấy dữ liệu ra
        $data = $this->models->getData($setting_name);
        // Khởi tạo form
        $form = new Form;
        $form->card('col-lg-12');
            $form->checkbox('enabled', $data['enabled']??'', 1, 'Bật tính năng');
        $form->endCard();
        $form->action('editconfig');
        // Hiển thị form tại view
        return $form->render('custom', compact(
            'note', 'module_name', 'setting_name'
        ), 'Default::admin.settings.form');
    }
}