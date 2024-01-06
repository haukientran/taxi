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
        @if(isset($setting_home['should_choose_grid2_star']['rank'][$key]))
            @for($i = 0; $i < $setting_home['should_choose_grid2_star']['rank'][$key]; $i++)
            <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M3.825 19.5L5.45 12.475L0 7.75L7.2 7.125L10 0.5L12.8 7.125L20 7.75L14.55 12.475L16.175 19.5L10 15.775L3.825 19.5Z" fill="#FFC107"></path>
            </svg>
            @endfor
        @endif
            <h3 class="should-choose-item__title f-w-b">{{ $title ?? '' }}</h3>
        <div class="should-choose-item__desc four-lines-ellipsis">{{ isset($setting_home['should_choose_grid2']['description'][$key]) ? $setting_home['should_choose_grid2']['description'][$key] : '' }}</div>
    </div>
</div>
