<?php
return [
    'domain' => env('APP_URL', 'http://localhost'),
    'page_size' => 200,//số lượng link mỗi trang
    'sitemap' => [
        [
            'table' => 'post_categories',//tên bảng
            'model' => 'Sudo\Post\Models\PostCategory',//tên kèm namespace model
            'changefreq' => 'daily',//tần xuất thay đổi nội dung: always,hourly,daily,weekly,monthly,yearly,never
            'priority' => '0.5',//độ ưu tiên 0.0 đến 1.0
        ],
        [
            'table' => 'posts',
            'model' => 'Sudo\Post\Models\Post',
            'changefreq' => 'weekly',
            'priority' => '0.8',
        ],
        [
            'table' => 'study_abroad_categories',
            'model' => 'Sudo\StudyAbroad\Models\StudyAbroadCategory',
            'changefreq' => 'daily',
            'priority' => '0.5',
        ],
        [
            'table' => 'study_abroads',
            'model' => 'Sudo\StudyAbroad\Models\StudyAbroad',
            'changefreq' => 'weekly',
            'priority' => '0.8',
        ],
        [
            'table' => 'personnels',
            'model' => 'Sudo\Personnel\Models\Personnel',
            'changefreq' => 'weekly',
            'priority' => '0.8',
        ],
        [
            'table' => 'pages',
            'model' => 'Sudo\Page\Models\Page',
            'changefreq' => 'weekly',
            'priority' => '0.8',
        ],
    ],
];
