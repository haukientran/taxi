<div class="should-choose-item flex-center-between">
    <div class="should-choose-item__thumbnail">
        @include('Default::general.components.image', [
            'src' => resizeWImage($setting_home['should_choose_grid2']['image'][$key] ?? '', 'w100'),
            'width' => '80',
            'height' => '80',
            "lazy"   => true,
            'title'  =>  'icon_leanh'
        ])
    </div>
    <div class="should-choose-item__content">
            <h3 class="should-choose-item__title f-w-b">{{ $title ?? '' }}</h3>
        <div class="should-choose-item__desc four-lines-ellipsis">{{ isset($setting_home['should_choose_grid2']['description'][$key]) ? $setting_home['should_choose_grid2']['description'][$key] : '' }}</div>
    </div>
</div>
