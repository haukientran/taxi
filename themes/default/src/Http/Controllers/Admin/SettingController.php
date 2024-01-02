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
            $form->color('color_main', $data['color_main'] ?? '', 0, 'Màu chính','', true);
            $form->image('logo_header_desktop', $data['logo_header_desktop']??'', 0, 'Logo hiển thị header desktop', 'Chọn ảnh','', true);
            $form->image('logo_header_mobile', $data['logo_header_mobile']??'', 0, 'Logo hiển thị header mobile', 'Chọn ảnh', '', true);
            $form->image('logo_footer_desktop', $data['logo_footer_desktop']??'', 0, 'Logo hiển thị footer desktop', 'Chọn ảnh', '', true);
            $form->image('favicon', $data['favicon']??'', 0, 'Favicon', 'Chọn ảnh', '', true);
        $form->title('Cấu hình nội dung thông tin');
            $form->text('company_name', $data['company_name'] ?? '', 0, 'Tên công ty','', true);
            $form->text('hotline_support', $data['hotline_support'] ?? '', 0, 'Hotline tư vấn','', true);
            $form->text('address', $data['address'] ?? '', 0, 'Địa chỉ','', true);
            $form->text('email', $data['email'] ?? '', 0, 'Email','', true);

        $form->card('col-lg-12');
            $form->title('Cấu hình ảnh background form đăng ký');
            $form->image('background_form', $data['background_form']??'', 0, 'Backgroud form đăng ký', 'Chọn ảnh','', true);

        $form->endCard();

        $form->card('col-lg-12');
            $form->title('Cấu hình dịch vụ chuyến xe');
            $form->text('service_contact_title', $data['service_contact_title'] ?? '', 0, 'Tiêu đề hiển thị','', true);
            $form->custom('Form::custom.form_custom', [
                'has_full' => false,
                'name' => 'service_contact',
                'value' => $data['service_contact'] ?? [],
                'label' => 'Thêm dịch vụ',
                'generate' => [
                    [ 'type' => 'custom', 'generate' => [
                            [ 'type' => 'text', 'name' => 'name', 'placeholder' => 'Thêm dịch vụ', ],
                        ]
                    ],
                ],
            ]);
        $form->endCard();


        $form->card('col-lg-12');
            $form->title('Cấu hình loại xe');
            $form->text('type_contact_title', $data['type_contact_title'] ?? '', 0, 'Tiêu đề hiển thị','', true);
            $form->custom('Form::custom.form_custom', [
                'has_full' => false,
                'name' => 'type_contact',
                'value' => $data['type_contact'] ?? [],
                'label' => 'Thêm loại xe',
                'generate' => [
                    [ 'type' => 'custom', 'generate' => [
                            [ 'type' => 'text', 'name' => 'name', 'placeholder' => 'Thêm loại xe', ],
                        ]
                    ],
                ],
            ]);
        $form->endCard();

            $form->title('Cấu hình cảm nhận khách hàng');
            $form->text('reviews_title', $data['reviews_title'] ?? '', 0, 'Tiêu đề','Thêm <span> để highlight text ', true);
            $form->custom('Form::custom.form_custom', [
                'has_full' => false,
                'name' => 'customer_reviews',
                'value' => $data['customer_reviews'] ?? [],
                'label' => 'Thêm danh sách khách hàng',
                'generate' => [
                    [ 'type' => 'image', 'name' => 'image', 'placeholder' => 'Thêm hình ảnh'],
                    [ 'type' => 'text', 'name' => 'customer_name', 'placeholder' => 'Thêm tên khách hàng'],
                    [ 'type' => 'text', 'name' => 'position', 'placeholder' => 'Thêm chức vụ'],
                    [ 'type' => 'text', 'name' => 'address', 'placeholder' => 'Địa chỉ làm việc'],
                    [ 'type' => 'text', 'name' => 'des', 'placeholder' => 'Thêm mô tả'],
                ],

            ]);
        $form->endCard();
        
        $form->card('col-lg-12');
            $form->title('Cấu hình Footer');
            $form->custom('Form::custom.form_custom', [
                'has_full' => false,
                'name' => 'social',
                'value' => $data['social'] ?? [],
                'label' => 'Thêm danh sách link mạng xã hội (kích thước ảnh 50x50)',
                'generate' => [
                    [ 'type' => 'image', 'name' => 'social_item_image', 'placeholder' => 'Thêm hình ảnh'],
                    [ 'type' => 'text', 'name' => 'social_item_title', 'placeholder' => 'Thêm tiêu để'],
                    [ 'type' => 'text', 'name' => 'social_item_link', 'placeholder' => 'Thêm link liên kết'],
                ],
            ]);
            $form->textarea('link_bct', $data['link_bct'] ?? '', 0, 'Link bộ công thương', '', 5,true);
            $form->textarea('copy_right', $data['copy_right'] ?? '', 0, 'Copy right', '', 5,true);
            $form->text('about_title', $data['about_title'] ?? '', 0, 'Tiêu đề về chúng tôi', $data['about_title'] ?? '', true);
            $form->textarea('about_description', $data['about_description'] ?? '', 0, 'Mô tả về chúng tôi', '', 5,true);
        $form->endCard();

        $form->card('col-lg-12');
            $form->title('Cấu hình các nút liên hệ');
            $form->custom('Form::custom.form_custom', [
                'has_full' => false,
                'name' => 'contact',
                'value' => $data['contact'] ?? [],
                'label' => 'Thêm danh sách nút liên hệ (kích thước ảnh 80x80)',
                'generate' => [
                    [ 'type' => 'image', 'name' => 'contact_image', 'placeholder' => 'Thêm hình ảnh'],
                    [ 'type' => 'text', 'name' => 'contact_link', 'placeholder' => 'Thêm link liên kết'],
                ],
            ]);
        $form->endCard();
        $form->card('col-lg-12');
            $form->title('Cấu hình Footer taskbar mobile');
            $form->custom('Form::custom.form_custom', [
                'has_full' => false,
                'name' => 'taskbar_hotline',
                'value' => $data['taskbar_hotline'] ?? [],
                'label' => 'Thêm danh sách hotline ở thanh taskbar',
                'generate' => [
                    [ 'type' => 'text', 'name' => 'hotline', 'placeholder' => 'Thêm hotline'],
                    [ 'type' => 'text', 'name' => 'address', 'placeholder' => 'Thêm địa chỉ'],
                ],
            ]);
            $form->textarea('taskbar_link_messenger', $data['taskbar_link_messenger'] ?? '', 0, 'Cấu hình link messenger facebook', '', 5,true);

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
            $form->customMenu('mobile_menu', $data['mobile_menu'] ?? '', 'Menu header mobile');
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
        $form->card('col-lg-12');
            $form->title('Cấu hình giới thiệu');
            $form->text('reason_title', $data['reason_title'] ?? '', 0, 'Tiêu đề','', true);
            $form->textarea('reason_description', $data['reason_description'] ?? '', 0, 'Mô tả', '', 5,true);
            $form->text('reason_link', $data['reason_link'] ?? '', 0, 'Link xem thêm','Link xem thêm', true);
            $form->image('reason_image', $data['reason_image'] ?? '', 0, 'Ảnh giới thiệu', 'Chọn ảnh','', true);
            $form->text('reason_youtube_link', $data['reason_youtube_link'] ?? '', 0, 'Thêm link video','Thêm link video', true);
        $form->endCard();

        $form->card('col-lg-12');
            $form->title('Cấu hình vì sao nên chọn chúng tôi');
            $form->text('should_choose_title', $data['should_choose_title'] ?? '', 0, 'Tiêu đề hiển thị','', true);
            $form->custom('Form::custom.form_custom', [
                'has_full' => false,
                'name' => 'should_choose',
                'value' => $data['should_choose'] ?? [],
                'label' => 'Danh sách cấu hình',
                'generate' => [
                    [ 'type' => 'image', 'name' => 'image', 'size' => 'Chọn ảnh có kích thước '.'50x50', ],
                    [ 'type' => 'custom', 'generate' => [
                            [ 'type' => 'text', 'name' => 'title', 'placeholder' => 'Tiêu đề', ],
                            [ 'type' => 'text', 'name' => 'description', 'placeholder' => 'Mô tả', ],
                        ]
                    ],
                ],
            ]);
        $form->endCard();

        $form->card('col-lg-12');
            $form->title('Cấu hình Hiển thị form đăng ký');
            $form->checkbox('enabled_form', $data['enabled_form'] ?? '', 1, 'Hiển thị form đăng ký');
        $form->endCard();

        $form->card('col-lg-12');
            $form->title('Cấu hình vì sao nên chọn chúng tôi(2 cột/1 dòng)');
            $form->text('should_choose_grid2_title', $data['should_choose_grid2_title'] ?? '', 0, 'Tiêu đề hiển thị','', true);
            $form->custom('Form::custom.form_custom', [
                'has_full' => false,
                'name' => 'should_choose_grid2',
                'value' => $data['should_choose_grid2'] ?? [],
                'label' => 'Danh sách cấu hình',
                'generate' => [
                    [ 'type' => 'image', 'name' => 'image', 'size' => 'Chọn ảnh có kích thước '.'50x50', ],
                    [ 'type' => 'custom', 'generate' => [
                            [ 'type' => 'text', 'name' => 'title', 'placeholder' => 'Tiêu đề', ],
                            [ 'type' => 'text', 'name' => 'description', 'placeholder' => 'Mô tả', ],
                        ]
                    ],
                ],
            ]);
        $form->endCard();
        $form->card('col-lg-12');
            $form->title('Cấu hình dịch vụ chuyến xe');
            $form->text('service_contact', $data['service_contact'] ?? '', 0, 'Tiêu đề hiển thị','', true);
        $form->endCard();
        $form->card('col-lg-12');
            $form->title('Cấu hình Tin tức sự kiện');
            $form->text('news_title', $data['news_title'] ?? '', 0, 'Tiêu đề hiển thị','', true);
        $form->endCard();


        $form->card('col-lg-12');
            $form->title('Cấu hình bảng giá');
            $form->editor('table_price', $data['table_price']??'', 0, 'Thêm nội dung phần bảng giá', true);
            $form->image('table_price_banner', $data['table_price_banner'] ?? '', 0, 'Ảnh bảng giá', 'Chọn ảnh','', true);
        $form->endCard();

        $form->card('col-lg-12');
            $form->title('Cấu hình giới thiệu xe');
            $form->editor('introduce_service', $data['introduce_service']??'', 0, 'Thêm nội dung phần bảng giá', true);
            $form->custom('Form::custom.form_custom', [
                'has_full' => false,
                'name' => 'service_price',
                'value' => $data['service_price'] ?? [],
                'label' => 'Danh sách cấu hình',
                'generate' => [
                    [ 'type' => 'image', 'name' => 'image', 'size' => 'Chọn ảnh có kích thước '.'500x300', ],
                    [ 'type' => 'custom', 'generate' => [
                            [ 'type' => 'text', 'name' => 'title', 'placeholder' => 'Tiêu đề', ],
                            [ 'type' => 'text', 'name' => 'description_price1', 'placeholder' => 'Mô tả', ],
                            [ 'type' => 'text', 'name' => 'description_price2', 'placeholder' => 'Nhập mô tả'],
                        ]
                    ],
                ],
            ]);
        $form->endCard();

        $form->card('col-lg-12');
            $form->title('Cấu hình dịch vụ');
            $form->text('contidion_title', $data['contidion_title'] ?? '', 0, 'Tiêu đề hiển thị','', true);
            $form->custom('Form::custom.form_custom', [
                'has_full' => false,
                'name' => 'contidion',
                'value' => $data['contidion'] ?? [],
                'label' => 'Danh sách cấu hình',
                'generate' => [
                    [ 'type' => 'image', 'name' => 'image', 'size' => 'Chọn ảnh có kích thước '.'300x300', ],
                    [ 'type' => 'text', 'name' => 'link', 'placeholder' => 'Thêm link ', ],
                    [ 'type' => 'custom', 'generate' => [
                            [ 'type' => 'text', 'name' => 'title', 'placeholder' => 'Tiêu đề', ],
                        ]
                    ],
                ],
            ]);
        $form->endCard();
        $form->card('col-lg-12');
            $form->title('Cấu hình dịch vụ(grid3)');
            $form->text('service_grid3_title', $data['service_grid3_title'] ?? '', 0, 'Tiêu đề hiển thị','', true);
            $form->custom('Form::custom.form_custom', [
                'has_full' => false,
                'name' => 'service_grid3',
                'value' => $data['service_grid3'] ?? [],
                'label' => 'Danh sách cấu hình',
                'generate' => [
                    [ 'type' => 'image', 'name' => 'image', 'size' => 'Chọn ảnh có kích thước '.'300x300', ],
                    [ 'type' => 'text', 'name' => 'link', 'placeholder' => 'Thêm link ', ],
                    [ 'type' => 'custom', 'generate' => [
                            [ 'type' => 'text', 'name' => 'title', 'placeholder' => 'Tiêu đề', ],
                            [ 'type' => 'text', 'name' => 'description', 'placeholder' => 'Nhập mô tả'],
                        ]
                    ],
                ],
            ]);
        $form->endCard();
        $form->card('col-lg-12');
            $form->title('Cấu hình chia sẻ từ học viên');
            $form->text('feedback_title', $data['feedback_title'] ?? '', 0, 'Tiêu đề chia sẻ từ học viên','', true);
            // $form->text('video_youtube_feedback', $data['video_youtube_feedback'] ?? '', 0, 'Thêm link video phản hồi','Thêm link video phản hồi', true);
            // $form->text('video_youtube_learn', $data['video_youtube_learn'] ?? '', 0, 'Thêm link video học thử','Thêm link video học thử', true);
            $form->custom('Form::custom.form_custom', [
                'has_full' => false,
                'name' => 'video_youtube_feedback',
                'value' => $data['video_youtube_feedback'] ?? [],
                'label' => 'Danh sách cấu hình',
                'generate' => [
                    [ 'type' => 'image', 'name' => 'image', 'size' => 'Chọn ảnh có kích thước '.'570x400', ],
                    [ 'type' => 'custom', 'generate' => [
                            [ 'type' => 'text', 'name' => 'link', 'placeholder' => 'Thêm link video phản hồi', ],
                        ]
                    ],
                ],
            ]);
        $form->endCard();
        $form->card('col-lg-12');
            $form->title('Cấu hình hoạt động');
            $form->text('activity_title', $data['activity_title'] ?? '', 0, 'Tiêu đề hiển thị','', true);
            $form->custom('Form::custom.form_custom', [
                'has_full' => false,
                'name' => 'activity',
                'value' => $data['activity'] ?? [],
                'label' => 'Danh sách cấu hình',
                'generate' => [
                    [ 'type' => 'image', 'name' => 'image', 'size' => 'Chọn ảnh có kích thước '.'570x400', ],
                ],
            ]);
        $form->endCard();
        $form->card('col-lg-12');
            $form->title('Cấu Đối tác và truyền thông');
            $form->text('partner_title', $data['partner_title'] ?? '', 0, 'Tiêu đề hiển thị','', true);
            $form->custom('Form::custom.form_custom', [
                'has_full' => false,
                'name' => 'partner',
                'value' => $data['partner'] ?? [],
                'label' => 'Danh sách cấu hình',
                'generate' => [
                    [ 'type' => 'image', 'name' => 'image', 'size' => 'Chọn ảnh có kích thước '.'200x110', ],
                    [ 'type' => 'custom', 'generate' => [
                            [ 'type' => 'text', 'name' => 'link', 'placeholder' => 'Thêm link dẫn', ],
                            [ 'type' => 'text', 'name' => 'follow', 'placeholder' => 'kiểu liên kết nofollow hoặc dofollow', ],
                        ]
                    ],
                ],
            ]);
        $form->card('col-lg-12');
            $form->title('Cấu hình đăng kí tư vấn');
            $form->text('register_title', $data['register_title'] ?? '', 0, 'Tiêu đề hiển thị','', true);
        $form->endCard();
        $form->endCard();
        $form->action('editconfig', route('app.home'));
        // Hiển thị form tại view
        return $form->render('custom', compact(
            'module_name', 'note'
        ), 'Default::admin.settings.form');
    }
    //Cấu hình trang Giới thiệu
    public function introduce(Request $requests){
        $setting_name = 'introduce';
        $module_name = "Cấu hình trang giới thiệu";
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
        $form->title('Cấu hình banner giới thiệu');
            $form->image('introduce_banner', $data['introduce_banner'] ?? '', 0, 'Backgroup banner giới thiệu', 'Chọn ảnh','Nên thêm ảnh có kích thước 1920x800', true);
            $form->text('introduce_title', $data['introduce_title'] ?? '', 0, 'Tiêu đề','Thêm <br> để xuống dòng', true);
            $form->text('introduce_des', $data['introduce_des'] ?? '', 0, 'Mô tả','Thêm <br> để xuống dòng', true);
            $form->text('introduce_link', $data['introduce_link'] ?? '', 0, 'Thêm link','Thêm link video', true);
        $form->title('Cấu hình câu chuyện thương hiệu');
            $form->image('story_banner', $data['story_banner'] ?? '', 0, 'Backgroup banner câu chuyện thương hiệu', 'Chọn ảnh','Nên thêm ảnh có kích thước 1920x800', true);
            $form->text('story_title', $data['story_title'] ?? '', 0, 'Tiêu đề','Thêm <br> để xuống dòng', true);
            $form->text('story_des', $data['story_des'] ?? '', 0, 'Mô tả','Thêm <br> để xuống dòng', true);
            $form->editor('story_detail', $data['story_detail']??'', 0, 'Thêm nội dung phần box đội ngũ', true);
            $form->image('story_image', $data['story_image'] ?? '', 0, 'Hình ảnh hiển thị bên phải', 'Chọn ảnh','Nên thêm footerảnh có kích thước 600x800', true);
        $form->title('Cấu hình thành tựu');
            $form->image('achievement_banner', $data['achievement_banner'] ?? '', 0, 'Backgroup banner câu thành tựu', 'Chọn ảnh','Nên thêm ảnh có kích thước 1920x800', true);
            $form->text('achievement_title', $data['achievement_title'] ?? '', 0, 'Tiêu đề','Thêm <br> để xuống dòng', true);
            $form->custom('Form::custom.form_custom', [
                'has_full' => false,
                'name' => 'achievement',
                'value' => $data['achievement'] ?? [],
                'label' => 'Thêm danh các thành tựu',
                'generate' => [
                    [ 'type' => 'text', 'name' => 'name', 'placeholder' => 'Nhập text số lượng'],
                    [ 'type' => 'text', 'name' => 'title', 'placeholder' => 'Nhập text mô tả'],
                ],
            ]);
        $form->title('Cấu hình sứ mệnh, giá trị cốt lõi');
            $form->image('core_value_banner', $data['core_value_banner'] ?? '', 0, 'Backgroup sứ mệnh, giá trị cốt lõi', 'Chọn ảnh','Nên thêm ảnh có kích thước 1920x800', true);
            $form->custom('Form::custom.form_custom', [
                'has_full' => false,
                'name' => 'core_value',
                'value' => $data['core_value'] ?? [],
                'label' => 'Thêm danh sứ mệnh, giá trị cốt lõi',
                'generate' => [
                    [ 'type' => 'text', 'name' => 'name', 'placeholder' => 'Nhập tiêu đề'],
                    [ 'type' => 'text', 'name' => 'title', 'placeholder' => 'Nhập mô tả'],
                ],
            ]);
        $form->title('Cấu hình nội dung Đội ngũ');
            $form->text('team_title', $data['team_title'] ?? '', 0, 'Tiêu đề','Thêm <br> để xuống dòng', true);
            $form->multiSuggest('team', $data['team'] ?? '', 0, 'Đội ngũ', 'Tìm theo tên...', 'personnels','id', 'name', false,true);
        $form->title('Cấu hình box không ngừng mang lại giá trị');
            $form->image('value_banner', $data['value_banner'] ?? '', 0, 'Backgroup banner câu chuyện thương hiệu', 'Chọn ảnh','Nên thêm ảnh có kích thước 1920x800', true);
            $form->text('value_title', $data['value_title'] ?? '', 0, 'Tiêu đề','Thêm <br> để xuống dòng', true);
            $form->text('value_des', $data['value_des'] ?? '', 0, 'Mô tả','Thêm <br> để xuống dòng', true);
            $form->editor('value_detail', $data['value_detail']??'', 0, 'Thêm nội dung phần box đội ngũ', true);
            $form->image('value_image', $data['value_image'] ?? '', 0, 'Hình ảnh hiển thị bên phải', 'Chọn ảnh','Nên thêm ảnh có kích thước 600x800', true);
        $form->title('Cấu hình hình ảnh hoạt động');
            $form->custom('Form::custom.form_custom', [
                'has_full' => false,
                'name' => 'activities',
                'value' => $data['activities'] ?? [],
                'label' => 'Thêm danh hình ảnh hoạt động của cty',
                'generate' => [
                    [ 'type' => 'image', 'name' => 'image_item', 'size' => 'Chọn ảnh có kích thước '.'400x300', ],
                ],
            ]);
        $form->endCard();
        $device = checkAgent() == 'mobile' ? 'mobile' :'app';
        $form->action('editconfig', route($device.'.pages.introduce'));
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
            $form->textarea('link_map', $data['link_map'] ?? '', 0, 'Link google map', '', 5,true);
            $form->text('address', $data['address'] ?? '', 0, 'Địa chỉ','', true);
            $form->text('phone', $data['phone'] ?? '', 0, 'Phone','', true);
            $form->text('tel', $data['tel'] ?? '', 0, 'Tel','', true);
            $form->text('email', $data['email'] ?? '', 0, 'Email','', true);
        $form->endCard();
        $device = checkAgent() == 'mobile' ? 'mobile' :'app';
        $form->action('editconfig', route($device.'.contact'));
        // Hiển thị form tại view
        return $form->render('custom', compact(
            'module_name', 'note'
        ), 'Default::admin.settings.form');
    }
    //Cấu hình trang du học
    public function study_abroad_category(Request $requests){
        $setting_name = 'study_abroad_category';
        $module_name = "Cấu hình trang du học";
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
            $form->text('category_title', $data['category_title'] ?? '', 0, 'Tiêu đề danh mục','', true);
            $form->title('Cấu hình form đăng kí du học');
            $form->text('province_title', $data['province_title'] ?? '', 0, 'Tiêu đề hiển thị Khu vực','', true);
            $form->custom('Form::custom.form_custom', [
                'has_full' => false,
                'name' => 'province',
                'value' => $data['province'] ?? [],
                'label' => 'Thêm tỉnh thành phố',
                'generate' => [
                    [ 'type' => 'text', 'name' => 'name', 'placeholder' => 'Thêm tỉnh thành phố', ],
                ],
            ]);
            $form->text('course_title', $data['course_title'] ?? '', 0, 'Tiêu đề hiển thị khóa học','', true);
            $form->custom('Form::custom.form_custom', [
                'has_full' => false,
                'name' => 'course',
                'value' => $data['course'] ?? [],
                'label' => 'Thêm khóa học',
                'generate' => [
                    [ 'type' => 'custom', 'generate' => [
                            [ 'type' => 'text', 'name' => 'name', 'placeholder' => 'Tiêu đề khóa học', ],
                        ]
                    ],
                ],
            ]);
        $form->endCard();
        // Hiển thị form tại view
        $device = checkAgent() == 'mobile' ? 'mobile' :'app';
        $form->action('editconfig', route($device.'.study_abroad_categories.index'));
        return $form->render('custom', compact(
            'module_name', 'note'
        ), 'Default::admin.settings.form');
    }
    //Cấu hình trang nhân sự
    public function personnel(Request $requests){
        $setting_name = 'personnel';
        $module_name = "Cấu hình trang du học";
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
            $form->image('background', $data['background'] ?? '', 0, 'Hình ảnh hiển thị banner', 'Chọn ảnh','Nên thêm ảnh có kích thước 1900x200', true);
            $form->text('description', $data['description'] ?? '', 0, 'Tiêu đề mô tả banner','', true);
            $form->text('title_1', $data['title_1'] ?? '', 0, 'Tiêu đề mô tả ban lãnh đạo','', true);
            $form->text('title_2', $data['title_2'] ?? '', 0, 'Tiêu đề mô tả nhân viên','', true);
        $form->endCard();
        // Hiển thị form tại view
        $device = checkAgent() == 'mobile' ? 'mobile' :'app';
        $form->action('editconfig', route($device.'.personnels'));
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
    // Cấu hình trang danh mục tin và bài viết chi tiết
    public function post_category(Request $requests) {
        $setting_name = 'post_category';
        $module_name = "Cấu hình trang danh mục và chi tiết tin tức";
        $note = "Translate::form.require_text";
        // Thêm hoặc cập nhật dữ liệu
        if (isset($requests->redirect)) {
            $this->models->postData($requests, $setting_name);
        }
        // Lấy dữ liệu ra
        $data = $this->models->getData($setting_name);
        // Khởi tạo form
        $form = new Form;
        $form->title('Cấu hình Seo trang danh mục tin tức');
            $form->text('meta_title', $data['meta_title'] ?? '', 0, 'Meta Title','', true);
            $form->textarea('meta_description', $data['meta_description'] ?? '', 0, 'Meta Description', '', 5,true);
            $form->image('meta_image', $data['meta_image'] ?? '', 0, 'Meta Image', 'Chọn ảnh','', true);
        $form->title('Cấu hình nội dung trang dung mục tin tức');
            $form->text('category_title', $data['category_title'] ?? '', 0, 'Tiêu đề danh mục','', true);
            $form->custom('Form::custom.form_custom', [
                'has_full' => false,
                'name' => 'list_category',
                'value' => $data['list_category'] ?? [],
                'label' => 'Cấu hình danh sách bài viết du hoc',
                'generate' => [
                    [ 'type' => 'text', 'name' => 'name', 'placeholder' => 'Thêm tên bài viết'],
                    [ 'type' => 'text', 'name' => 'link', 'placeholder' => 'Thêm link bài viết'],
                ],
            ]);
            $form->textarea('iframe_pages', $data['iframe_pages'] ?? '', 0, 'Iframe pages facebook', '', 5,true);
        $form->title('Cấu hình nội dung trang chi tiết tin tức');
            $form->custom('Form::custom.form_custom', [
                'has_full' => false,
                'name' => 'topic',
                'value' => $data['topic'] ?? [],
                'label' => 'Thêm danh sách khám phá nhiều chủ đề',
                'generate' => [
                    [ 'type' => 'text', 'name' => 'name', 'placeholder' => 'Tên tiêu để'],
                    [ 'type' => 'text', 'name' => 'link', 'placeholder' => 'Link liên kết'],
                ],
            ]);
        $form->action('editconfig');
        // Hiển thị form tại view
        return $form->render('custom', compact(
            'module_name', 'note'
        ), 'Default::admin.settings.form');
    }
    //Cấu hình trang tìm kiếm
    public function search_school(Request $requests){
        $setting_name = 'search_school';
        $module_name = "Cấu hình trang tìm kiếm";
        $note = "Translate::form.require_text";
        // Thêm hoặc cập nhật dữ liệu
        if (isset($requests->redirect)) {
            $this->models->postData($requests, $setting_name);
        }
        // Lấy dữ liệu ra
        $data = $this->models->getData($setting_name);
        // Khởi tạo form
        $form = new Form;
        $form->title('Cấu hình banner giới thiệu');
        $form->card('col-lg-12');
            $form->text('meta_title', $data['meta_title'] ?? '', 0, 'Meta Title','', true);
            $form->textarea('meta_description', $data['meta_description'] ?? '', 0, 'Meta Description', '', 5,true);
            $form->image('meta_image', $data['meta_image'] ?? '', 0, 'Meta Image', 'Chọn ảnh','', true);
            $form->image('search_school_banner', $data['search_school_banner'] ?? '', 0, 'Backgroup banner trang tìm kiếm', 'Chọn ảnh','Nên thêm ảnh có kích thước 1920x521', true);
            $form->text('search_school_title', $data['search_school_title'] ?? '', 0, 'Tiêu đề','Thêm <br> để xuống dòng', true);

        $form->endCard();

        $form->action('editconfig', route('app.search_school'));
        // Hiển thị form tại view
        return $form->render('custom', compact(
            'module_name', 'note'
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
