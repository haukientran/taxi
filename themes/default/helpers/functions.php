<?php 
/**
 * Lấy nhanh ngôn ngữ hiện tại dùng cho cả controller và blade
 */
function getLocale() {
    return \App::getLocale();
}

/**
 * Lấy ra thẻ meta_seos
 */
function metaSeo($table = '', $table_id = '', $options = []) {
    $meta_seo = [];
    // Lấy dữ liệu seo từ options trước
    if(!empty($options)) {
        foreach ($options as $key => $value) {
            $meta_seo[$key] = $value;
        }
    }
    // Nếu tồn tại bảng và id thì sẽ query lấy dữ liệu từ DB
    if (!empty($table) && !empty($table_id)) {
        // Query lấy meta_seo
        $data_seo = DB::table('seos')->where('type', $table)->where('type_id', $table_id)->first();
        if (!empty($data_seo)) {
            // Meta Title
            if (!empty($data_seo->title)) {
                $meta_seo['title'] = $data_seo->title ?? '';
            }
            // Meta Description
            if (!empty($data_seo->description)) {
                $meta_seo['description'] = $data_seo->description ?? '';
                
            }
            // Meta Robot
            if (!empty($data_seo->robots)) {
                $meta_seo['robots'] = $data_seo->robots ?? '';
            }
        }
    }
    // Các thẻ meta mặc định khác
    $meta_seo['url'] = $options['url'] ?? getUrlLink('current') ?? '';
    $meta_seo['image'] = $options['image'] ?? getImage() ?? '';
    $meta_seo['locale'] = $options['locale'] ?? config('app.language')[getLocale()]['locale'] ?? '';

    return $meta_seo;
}

/**
 * kiểm tra loại trình duyệt
 */
function checkAgent() {
    if ( empty($_SERVER['HTTP_USER_AGENT']) ) {
        $is_mobile = false;
    } elseif ( strpos($_SERVER['HTTP_USER_AGENT'], 'Mobile') !== false // many mobile devices (all iPhone, iPad, etc.)
        || strpos($_SERVER['HTTP_USER_AGENT'], 'Android') !== false
        || strpos($_SERVER['HTTP_USER_AGENT'], 'Silk/') !== false
        || strpos($_SERVER['HTTP_USER_AGENT'], 'Kindle') !== false
        || strpos($_SERVER['HTTP_USER_AGENT'], 'BlackBerry') !== false
        || strpos($_SERVER['HTTP_USER_AGENT'], 'Opera Mini') !== false
        || strpos($_SERVER['HTTP_USER_AGENT'], 'Opera Mobi') !== false ) {
        $is_mobile = true;
    } else {
        $is_mobile = false;
    }

    if ($is_mobile == true) {
        return 'mobile';
    } else {
        return 'web';
    }
}

/**
 * Lấy option từ cache
 * @param string        $setting_name: key của setting
 * @param string        $locale: ngôn ngữ muốn lấy (Mặc định sẽ lấy ngôn ngữ hiện tại)
 * @param string        $has_locale: setting có sử dụng đa ngôn ngữ hay không, một vài cấu hình không cần đa ngôn ngữ VD: mail_config
 * @return array        $array
 */
function getOption($setting_name, $locale = null, $has_locale = true) {
    // Ngôn ngữ hiện tại
    $locale = $locale ?? \App::getLocale();
    // Cấu hình
    $option = \Cache::rememberForever('setting_'.$setting_name.'_'.$locale, function() use($setting_name, $locale, $has_locale) {
        $setting = \DB::table('settings')->select('value')->where('key', $setting_name);
        if ($has_locale == true) {
            $setting = $setting->where('locale', $locale);
        }
        $setting = $setting->first();
        return $setting;
    });

    if(empty($option)){
        return null;
    }else{
        return json_decode(base64_decode($option->value), true);
    }
}

/**
 * Lấy toàn bộ ngôn ngữ thuộc module
 * @param string        $model: Models của module và phải chứa hàm getUrl
 * @param number        $id: id của bản ghi muốn lấy
 * @return array        $language
 */
function getLanguageLink($model, $id) {
    $model = new $model;
    $table_name = $model->getTable();
    // Ngôn ngữ bản ghi hiện tại
    $language_origin = DB::table('language_metas')
                            ->where('lang_table', $table_name)
                            ->where('lang_table_id', $id)
                            ->first();
    // Ngôn ngữ toàn bộ bản ghi theo bản ghi hiện tại
    $language_all = DB::table('language_metas')
                            ->where('lang_code', $language_origin->lang_code)
                            ->get();
    // Chuyển toàn bộ ngôn ngữ theo dạng [ 'lang_key' => $id ]
    $language_array = collectToArray($language_all, 'lang_locale', 'lang_table_id');
    // Lấy toàn bộ bản ghi
    $data = $model->whereIn('id', $language_all->pluck('lang_table_id')->toArray())->get();
    // Lấy mảng toàn bộ ngôn ngữ
    $language = [];
    foreach (config('app.language') as $key => $value) {
        $record = $data->where('id', $language_array[$key] ?? '')->first();
        if (!empty($record)) {
            $language[$key] = $record->getUrl();
        } else {
            $language[$key] = route('app.home');
        }
    }
    // SET ngôn ngữ toàn trang
    setLanguage($language_origin->lang_locale);
    // Trả về
    return [
        'current'       => $language_origin->lang_locale,
        'language'      => $language
    ];
}

function getAlt($link='') {
    if ($link=='') {
        return 'no-image';
    } else {
        $link_explore = explode('/', $link);
        $img = array_pop($link_explore);
        $alt = explode('.', $img)[0];
        $alt = str_replace(['-tiny','-small','-medium','-large'], '', $alt);
        return $alt;
    }
}