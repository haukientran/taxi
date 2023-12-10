@php
    $primary_menu = json_decode(@$config_menu['primary_menu'], 1) ?? [];
@endphp
<header class="header {{ Route::getCurrentRoute() != null && Route::getCurrentRoute()->uri() == '/' ? 'home header_home' : '' }}">
    <div class="header-top flex-center-between">
        <marquee width="100%" direction="right" height="100%">
        <div class="header-top__left flex-center">
            <a href="tel:{{ $config_general['hotline_support'] ?? '' }}" rel="nofollow" aria-label="Hotline: {{ $config_general['hotline_support'] ?? '' }}" class="flex-center">
                <svg width="15" height="15" viewBox="0 0 15 15" xmlns="http://www.w3.org/2000/svg">
                    <path   fill="#fff" d="M0 3.77279C0 8.3865 6.11739 14.4978 10.7251 14.4978C11.7335 14.4978 12.6756 14.1174 13.3701 13.4229L13.974 12.7285C14.6745 12.0279 14.6745 10.8443 13.9438 10.1136C13.9257 10.0955 12.4703 8.97831 12.4703 8.97831C11.7456 8.28988 10.6043 8.28988 9.88565 8.97831L9.00397 9.68486C7.07153 8.86357 5.7007 7.4867 4.81903 5.48783L5.51954 4.60616C6.21401 3.88753 6.21401 2.74014 5.51954 2.02152C5.51954 2.02152 4.40234 0.566145 4.38423 0.548029C3.65352 -0.182676 2.4699 -0.182676 1.7392 0.548029L1.10512 1.09757C0.38045 1.81619 1.15205e-06 2.75826 1.15205e-06 3.76675L0 3.77279Z" fill="#3877F6"/>
                </svg>
                <span class="ml-5 lh-20 f-w-b color_white"> Hotline: {{ $config_general['hotline_support'] ?? ''}}</span>
            </a>
            <p class="address">
                <svg xmlns="http://www.w3.org/2000/svg"  fill="#fff" height="1em" viewBox="0 0 384 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M215.7 499.2C267 435 384 279.4 384 192C384 86 298 0 192 0S0 86 0 192c0 87.4 117 243 168.3 307.2c12.3 15.3 35.1 15.3 47.4 0zM192 128a64 64 0 1 1 0 128 64 64 0 1 1 0-128z"/></svg>
                <span class="ml-5 lh-20 f-w-b color_white">{{ $config_general['address'] ?? ''}}</span>
            </p>
        </div>
        <div class="header-top__right">
            <a href="{!!$config_general['link_intro'] ?? ''!!}" class=" f-w-b color_white" rel="nofollow" aria-label="{!!$config_general['intro'] ?? ''!!}">{!!$config_general['intro'] ?? ''!!}</a>
        </div>
    </marquee>
    </div>
    <div class="header-content">
        <div class="container"> 
           <div class="flex-center-between w-100">
                <div class="header-logo">
                    <a href="{{ route('app.home') }}" aria-label="logo">
                        @include('Default::general.components.image', [
                            'src' =>  resizeWImage($config_general['logo_header_desktop'] ?? '','w200'),
                            'width' => '128px',
                            'height' => '28px',
                            'lazy'   => true,
                            'title'  => 'logo'
                        ])
                    </a>
                </div>
                <nav class="header-menu flex">
                    {{-- <div class="choose">
                        <a href="{{ route('app.search_school') }}" class="button button__primary color_white text-up fs-16 f-w-b"> Chọn Trường</a>
                    </div> --}}
                    @if(count($primary_menu))
                    <ul class="header-menu__list flex-center">
                        @foreach($primary_menu as $menu_lv1)
                        <li class="menu-item {{ isset($menu_lv1['children']) && count($menu_lv1['children']) > 0 ? 'has-child' : '' }}">
                            <a class="menu-item__link fs-15 f-w-b lh-18" rel="{{ $menu_lv1['rel'] ?? '' }}" href="{{ $menu_lv1['link']??'' }}" target="{{ $menu_lv1['target'] == '_blank' ? 'blank' : '_self' }}">
                                {!! $menu_lv1['name']??'' !!}
                            </a>
                            @if(isset($menu_lv1['children']) && count($menu_lv1['children']) > 0)
                            <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512" fill="#69727d"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M201.4 342.6c12.5 12.5 32.8 12.5 45.3 0l160-160c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L224 274.7 86.6 137.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l160 160z"/></svg>
                                <ul class="submenu has_child">
                                    @foreach($menu_lv1['children'] as $menu_lv2)
                                    <li class="submenu-item">
                                        <a class="submenu-item__link fs-14 f-w-b" rel="{{ $menu_lv2['rel'] ?? '' }}" href="{{ $menu_lv2['link'] ?? '#' }}" target="{{ $menu_lv2['target'] == '_blank' ? '_blank' : '_self' }}">
                                            {!! $menu_lv2['name']??'' !!}
                                        </a>
                                    </li>
                                    @endforeach
                                </ul>
                            @endif
                        </li>
                        @endforeach
                    </ul>
                    @endif
                </nav>
                <div class="header-search">
                    <a href="tel:{{ $config_general['hotline_support'] ?? '' }}" class="btn btn-primary reason-btn btn-hotline" aria-label="Dặt xe ngay" title="Đặt xe ngay">Đặt xe ngay</a>
                </div>
           </div>
        </div>
    </div>
</header>
