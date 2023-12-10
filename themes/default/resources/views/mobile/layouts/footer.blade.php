@php
    $study_menus = json_decode(@$config_menu['study_menu'], 1);
    $about_menus = json_decode(@$config_menu['about_menu'], 1);
    $legal_information_menus = json_decode(@$config_menu['legal_information_menu'], 1);
@endphp
<footer>
    <div class="footer-top">
        <div class="container">
            <ul class="footer-box w-100">
                <li class="footer-item active">
                    <a aria-label="Khóa học" title="Khóa học" class="footer-title text-up fs-20" href="#study_menu">Các khóa học tại Lê Ánh</a>
                    @if(isset($study_menus) && count($study_menus) > 0)
                    <div class="footer-child">
                        @foreach($study_menus as $menu_lv1)
                            <div class="footer-child__item">
                                <div class="footer-child__title flex-center-left">
                                    @if($menu_lv1['thumbnail'] != '')
                                        <a class="footer-icon" rel="{{ $menu_lv1['rel'] ?? 'javascript:;' }}" href="{{ $menu_lv1['link'] ?? '' }}" target="{{ $menu_lv1['target'] == '_blank' ? '_blank' : '_self' }}">
                                            @include('Default::general.components.image', [
                                                'src' => resizeWImage($menu_lv1['thumbnail'] ?? '', 'w50'),
                                                'width' => '35px',
                                                'height' => '35px',
                                                'lazy'   => true,
                                                'title'  => 'logo',
                                                'class'  => 'footer-center-item__icon'
                                            ])
                                        </a>
                                        <span class="fs-20"> {{$menu_lv1['name'] ?? ''}}</span>
                                    @else
                                        <a class="submenu-link fs-16" rel="{{ $menu_lv1['rel'] ?? '' }}" href="{{ $menu_lv1['link'] ?? '' }}" target="{{ $menu_lv1['target'] == '_blank' ? '_blank' : '_self' }}">
                                            {!! $menu_lv1['name']??'' !!}
                                        </a>
                                    @endif
                                </div>
                                @if(isset($menu_lv1['children']) && count($menu_lv1['children']) > 0)
                                <ul class="footer-child__list">
                                    @foreach($menu_lv1['children'] as $menu_lv2)
                                    <li><a class="color_white fs-16" rel="{{ $menu_lv2['rel'] ?? '' }}" href="{{$menu_lv2['link'] ?? '#'}}" target="{{ $menu_lv2['target'] == '_blank' ? 'blank' : '_self' }}" aria-label="{{$menu_lv2['name'] ?? ''}}">{{$menu_lv2['name'] ?? ''}}</a>
                                    </li>
                                    @endforeach
                                </ul>
                                @endif
                            </div>
                        @endforeach
                    </div>
                    @endif
                </li>
                <li class="footer-item">
                    <a aria-label="Thông tin về Lê Ánh" title="Thông tin về Lê Ánh" class="footer-title text-up fs-20" href="#about_menu">Thông tin về Du học Lê Ánh</a>
                    <div class="footer-child">
                        @if(isset($about_menus) && count($about_menus) > 0)
                            <div class="footer-child__item">
                                <ul class="footer-child__list">
                                    @foreach($about_menus as $menu_lv1)
                                    <li>
                                        <a class="color_white fs-16" rel="{{ $menu_lv1['rel'] ?? '' }}" href="{{$menu_lv1['link'] ?? '#'}}" target="{{ $menu_lv1['target'] == '_blank' ? 'blank' : '_self' }}" aria-label="{{$menu_lv1['name'] ?? ''}}">{{$menu_lv1['name'] ?? ''}}</a>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </div>
                </li>
                <li class="footer-item">
                    <a aria-label="Thông tin pháp lý" title="Thông tin pháp lý" class="footer-title text-up fs-20" href="#legal_information_menu">Thông tin pháp lý</a>
                    <div class="footer-child">
                        @if(isset($legal_information_menus) && count($legal_information_menus) > 0)
                            <div class="footer-child__item">
                                <ul class="footer-child__list">
                                    @foreach($legal_information_menus as $menu_lv1)
                                    <li>
                                        <a class="color_white fs-16" rel="{{ $menu_lv1['rel'] ?? '' }}" href="{{$menu_lv1['link'] ?? '#'}}" target="{{ $menu_lv1['target'] == '_blank' ? 'blank' : '_self' }}" aria-label="{{$menu_lv1['name'] ?? ''}}">{{$menu_lv1['name'] ?? ''}}</a>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </div>
                </li>
            </ul>
        </div>
    </div>
    <div class="footer-center">
        <div class="container">
            <div class="footer-center__title color_white w-100 text-up">Theo dõi du học tại Lê ánh</div>
            <div class="footer-center__list flex w-100 mt-20 mb-20">
                @if(isset($config_general['social']['social_item_link']) && count($config_general['social']['social_item_link']) > 0)
                    @foreach($config_general['social']['social_item_link'] as $k => $link)
                    <div class="icon">
                        <a target="_blank" class="block" href="{{ $link ?? '#' }}" aria-label="{{ $config_general['social']['social_item_title'][$k] ?? '' }}" rel="nofollow">
                            @include('Default::general.components.image', [
                                'src' =>  resizeWImage($config_general['social']['social_item_image'][$k] ?? '','w50'),
                                'width' => '50px',
                                'height' => '50px',
                                "lazy"   => true,
                                "title" =>''
                            ])
                        </a>
                    </div>
                    @endforeach
                @endif
            </div>
            <div class="icon-notification">
                <a class="bct_link" target="_blank" href="{{ $config_general['link_bct'] ?? '#' }}" aria-label="link social" rel="nofollow">
                    @include('Default::general.components.image', [
                        'src' => '/assets/images/img/logo-bct.png',
                        'width' => '140px',
                        'height' => '50px',
                        'lazy'   => true,
                        "title" =>'Đã thông báo với Bộ Công Thương'
                    ])
                </a>
            </div>
        </div>
    </div>
    <div class="footer-bottom">
        <div class="container footer-bottom-container">
            <div class="footer-bottom-logo">
                <a href="{{ route('mobile.home') }}" aria-label="logo footer">
                    @include('Default::general.components.image', [
                        'src' =>  resizeWImage($config_general['logo_footer_desktop'] ?? '/assets/images/logo.png'),
                        'width' => '200px',
                        'height' => '110px',
                        'lazy'   => true,
                        'title'  => 'logo'
                    ])
                </a>
            </div>
            <div class="footer-bottom-copyright">{{ $config_general['copy_right'] ?? 'Copyright © 2023 Du học Lê Ánh. All rights reserved'}}</div>
        </div>
    </div>
    <div class="footer-taskbar">
        <ul class="footer-taskbar__list flex-center-between menu">
            <li class="item">
                <a aria-label="hotline" href="#call" class="flex flex-center">
                    <div class="item-thumbnail flex-center">
                        @include('Default::general.components.image', [
                            'src' =>  resizeWImage('/assets/images/img/call.webp' ?? ''),
                            'width' => '30px',
                            'height' => '25px',
                            'lazy'   => true,
                            'title'  => 'hotline'
                        ])
                    </div>
                    <span class="item-text fs-10 lh-10 fw-600 w-100 text-center mt-5">Tư vấn nhanh</span>
                </a>
            </li>
            <li class="item">
                <a aria-label="study" href="#study" class="flex flex-center">
                    <div class="item-thumbnail flex-center">
                        @include('Default::general.components.image', [
                            'src' =>  resizeWImage('/assets/images/img/hat.webp' ?? ''),
                            'width' => '30px',
                            'height' => '25px',
                            'lazy'   => true,
                            'title'  => 'study'
                        ])
                    </div>
                    <span class="item-text fs-10 lh-10 fw-600 w-100 text-center mt-5">Tìm khóa học</span>
                </a>
            </li>
            <li class="item">
                <a aria-label="register" href="#task_register" class="flex flex-center">
                    <div class="item-thumbnail flex-center">
                        @include('Default::general.components.image', [
                            'src' =>  resizeWImage('/assets/images/img/plus.webp' ?? ''),
                            'width' => '30px',
                            'height' => '25px',
                            'lazy'   => true,
                            'title'  => 'register'
                        ])
                    </div>
                    <span class="item-text fs-10 lh-10 fw-600 w-100 text-center mt-5">Đăng ký</span>
                </a>
            </li>
            <li class="item">
                <a aria-label="messenger" target="_blank" href="{{ isset($config_general['taskbar_link_messenger']) ? $config_general['taskbar_link_messenger']: 'javascript:;' }}" class="flex flex-center">
                    <div class="item-thumbnail flex-center">
                        @include('Default::general.components.image', [
                            'src' =>  resizeWImage('/assets/images/img/messenger.webp' ?? ''),
                            'width' => '30px',
                            'height' => '25px',
                            'lazy'   => true,
                            'title'  => 'Messenger'
                        ])
                    </div>
                    <span class="item-text fs-10 lh-10 fw-600 w-100 text-center mt-5">Messenger</span>
                </a>
            </li>
        </ul>
        <div class="footer-taskbar__content" id="call">
            <div class="title fs-14 fw-600 lh 16 text-up text-center color_white">Hotline tư vấn</div>
            <div class="detail">
                @if(isset($config_general['taskbar_hotline']) && count($config_general['taskbar_hotline']) > 0)
                <ul class="holite">
                    @foreach($config_general['taskbar_hotline']['hotline'] as $key => $hotline)
                        <li><a aria-label="hotline_{{ $key }}" href="tel:{{ $hotline ?? '' }}">{{ $hotline ?? '' }} - {{ $config_general['taskbar_hotline']['address'][$key] ?? '' }}</a></li>
                    @endforeach
                </ul>
                @endif
            </div>
        </div>
        <div class="footer-taskbar__content" id="study">
            <div class="title fs-14 fw-600 lh 16 text-up text-center color_white">Tìm khóa học</div>
            <div class="detail">
                @if(isset($study_menus) && count($study_menus) > 0)
                <div class="footer-child">
                    @foreach($study_menus as $menu_lv1)
                        <div class="footer-child__item">
                            <div class="footer-child__title flex-center-left">
                                @if($menu_lv1['thumbnail'] != '')
                                    <a class="footer-icon" rel="{{ $menu_lv1['rel'] ?? '' }}" href="{{ $menu_lv1['link'] ?? '' }}" target="{{ $menu_lv1['target'] == '_blank' ? '_blank' : '_self' }}">
                                        @include('Default::general.components.image', [
                                            'src' => resizeWImage($menu_lv1['thumbnail'] ?? '', 'w50'),
                                            'width' => '35px',
                                            'height' => '35px',
                                            'lazy'   => true,
                                            'title'  => 'logo',
                                            'class'  => 'footer-center-item__icon'
                                        ])
                                    </a>
                                    <span class="fs-20"> {{$menu_lv1['name'] ?? ''}}</span>
                                @else
                                    <a class="submenu-link fs-16" rel="{{ $menu_lv1['rel'] ?? '' }}" href="{{ $menu_lv1['link'] ?? '' }}" target="{{ $menu_lv1['target'] == '_blank' ? '_blank' : '_self' }}">
                                        {!! $menu_lv1['name']??'' !!}
                                    </a>
                                @endif
                            </div>
                            @if(isset($menu_lv1['children']) && count($menu_lv1['children']) > 0)
                            <ul class="footer-child__list">
                                @foreach($menu_lv1['children'] as $menu_lv2)
                                <li><a class="color_white fs-16" rel="{{ $menu_lv2['rel'] ?? '' }}" href="{{$menu_lv2['link'] ?? '#'}}" target="{{ $menu_lv2['target'] == '_blank' ? 'blank' : '_self' }}" aria-label="{{$menu_lv2['name'] ?? ''}}">{{$menu_lv2['name'] ?? ''}}</a>
                                </li>
                                @endforeach
                            </ul>
                            @endif
                        </div>
                    @endforeach
                </div>
                @endif
            </div>
        </div>
        <div class="footer-taskbar__content" id="task_register">
            <div class="title fs-14 fw-600 lh 16 text-up text-center color_white">Đăng ký</div>
            <div class="detail">
                @include('Default::mobile.layouts.register')
            </div>
        </div>
    </div>
</footer>
