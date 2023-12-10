const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

build = [
   {
      'file_path': 'public/assets/build/js/general.min.js',
      'files': [
         'public/assets/js/components/general.js',
         'public/assets/js/components/slide.js',
      ],
   },
   {
    'file_path': 'public/assets/build/js/general_mb.min.js',
    'files': [
        'public/assets/js/components/general_mb.js',
        'public/assets/js/components/slide.js',
        ],
    },
    {
        'file_path': 'public/admin_assets/plugins/ckeditor5/custom.min.js',
        'files': [
           'public/admin_assets/plugins/ckeditor5/custom.js',
        ],
    },
    {
        'file_path': 'public/assets/build/js/page.min.js',
        'files': [
            'public/assets/js/components/page.js',
        ],
    },
    {
        'file_path': 'public/platforms/comments/web/js/comments.min.js',
        'files': [
           'public/platforms/comments/web/js/comments.js',
        ],
    },
    {
        'file_path': 'public/assets/build/js/search_school.min.js',
        'files': [
            'public/assets/js/components/search_school.js',
        ],
    },
];
buildSass = [
   {
      'file_path': 'public/assets/build/css/general.min.css',
      'files': [
         'public/assets/sass/desktop/general.scss',
      ],
   },
   {
    'file_path': 'public/assets/build/css/general_mb.min.css',
    'files': [
        'public/assets/sass/mobile/general.scss',
        ],
    },
    {
        'file_path': 'public/assets/build/css/home.min.css',
        'files': [
            'public/assets/sass/desktop/home.scss',
            ],
    },
    {
        'file_path': 'public/assets/build/css/page.min.css',
        'files': [
        'public/assets/sass/desktop/page.scss',
        ],
    },
    {
        'file_path': 'public/assets/build/css/page_mb.min.css',
        'files': [
        'public/assets/sass/mobile/page.scss',
        ],
    },
    {
        'file_path': 'public/assets/build/css/post.min.css',
        'files': [
        'public/assets/sass/desktop/post.scss',
        ],
    },
    {
        'file_path': 'public/assets/build/css/post_mb.min.css',
        'files': [
        'public/assets/sass/mobile/post.scss',
        ],
    },
    {
        'file_path': 'public/assets/build/css/product.min.css',
        'files': [
        'public/assets/sass/desktop/product.scss',
        ],
    },
    {
        'file_path': 'public/assets/build/css/product_mb.min.css',
        'files': [
        'public/assets/sass/mobile/product.scss',
        ],
    },
    {
        'file_path': 'public/assets/build/css/personnel.min.css',
        'files': [
        'public/assets/sass/desktop/personnel.scss',
        ],
    },
    {
        'file_path': 'public/assets/build/css/personnel_mb.min.css',
        'files': [
        'public/assets/sass/mobile/personnel.scss',
        ],
    },
    {
        'file_path': 'public/assets/build/css/search_school.min.css',
        'files': [
        'public/assets/sass/desktop/search_school.scss',
        ],
    },
    {
        'file_path': 'public/assets/build/css/search_school_mb.min.css',
        'files': [
        'public/assets/sass/mobile/search_school.scss',
        ],
    },
    {
    'file_path': 'public/assets/build/css/home_mb.min.css',
    'files': [
        'public/assets/sass/mobile/home.scss',
        ],
    },
];

build.map(function(item, index) {
   mix.scripts(item.files, item.file_path);
});
buildSass.forEach(function (value) {
    value.files.map((src, index) => {
        mix.sass(src, value.file_path);
    })
});
