<div class="should-choose-item">
    <div class="should-choose-item__thumbnail">
        @include('Default::general.components.image', [
            'src' => resizeWImage($setting_home['should_choose']['image'][$key] ?? '', 'w100'),
            'width' => '80',
            'height' => '80',
            "lazy"   => true,
            'title'  =>  'icon_leanh'
        ])
    </div>
    <div class="should-choose-item__content">
        <h3 class="should-choose-item__title">{{ $title ?? '' }}</h3>
        <div class="should-choose-item__desc four-lines-ellipsis">{{ isset($setting_home['should_choose']['description'][$key]) ? $setting_home['should_choose']['description'][$key] : '' }}</div>
    </div>
</div>
