@php
    $mobile_menu = json_decode(@$config_menu['mobile_menu'], 1) ?? [];
@endphp
<header class="header {{ Route::getCurrentRoute() != null && Route::getCurrentRoute()->uri() == '/' ? 'home header_home' : '' }}">
    <div class="header-content">
        <div class="flex-center-between w-100">
            <div class="header-logo text-center">
                <a href="{{ route('mobile.home') }}" aria-label="logo">
                    @include('Default::general.components.image', [
                        'src' =>  resizeWImage($config_general['logo_header_mobile'] ?? '','w200'),
                        'width' => '128px',
                        'height' => '28px',
                        'lazy'   => true,
                        'title'  => 'logo'
                    ])
                </a>
            </div>
            <div class="header-menu">
                <span class="menu-btn"><svg xmlns="https://www.w3.org/2000/svg" viewBox="0 0 448 512" width="30" height="30" fill="black"><path d="M0 96C0 78.3 14.3 64 32 64H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H32C14.3 128 0 113.7 0 96zM0 256c0-17.7 14.3-32 32-32H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H32c-17.7 0-32-14.3-32-32zM448 416c0 17.7-14.3 32-32 32H32c-17.7 0-32-14.3-32-32s14.3-32 32-32H416c17.7 0 32 14.3 32 32z"/></svg></span>
                <span class="menu-btn menu-btn--close">CLOSE</span>
            </div>
        </div>
    </div>
    <div class="menu-popup">
        @if(isset($mobile_menu) && count($mobile_menu) > 0)
            <ul class="menu-list">
                @foreach($mobile_menu as  $key => $menu_lv1)
                    <li class="menu-list__item">
                        <a  class="item-link {{isset($menu_lv1['children']) && count($menu_lv1['children']) ? 'has-child' :  '' }}" href="{{isset($menu_lv1['children']) && count($menu_lv1['children']) ? 'javascript:;' :  $menu_lv1['link'] }}" target="{{ $menu_lv1['target'] == '_blank' ? 'blank' : '_self' }}" aria-label="{!! $menu_lv1['name']??'' !!}" title="{!! $menu_lv1['name']??'' !!}">
                            <span class="fs-15 text-up color_white">  {!! $menu_lv1['name']??'' !!}</span>
                        </a>
                        @if(isset($menu_lv1['children']) && count($menu_lv1['children']) > 0)
                            <ul class="submenu">
                                @foreach($menu_lv1['children'] as $menu_lv2)
                                    <li class="submenu-category__item">
                                        <a  class="item-link  {{isset($menu_lv2['children']) && count($menu_lv2['children']) ? 'has-child' :  '' }} " href="{{isset($menu_lv2['children']) && count($menu_lv2['children']) ? 'javascript:;' :  $menu_lv2['link'] }}" target="{{ $menu_lv2['target'] == '_blank' ? 'blank' : '_self' }}" aria-label="{!! $menu_lv2['name']??'' !!}" title="{!! $menu_lv2['name']??'' !!}">
                                            <span class="fs-14 text-up color_white">  {!! $menu_lv2['name']??'' !!}</span>
                                        </a>
                                        @if(isset($menu_lv2['children']) && count($menu_lv2['children']) > 0)
                                        <ul class="submenu submenu-child lv2">
                                            @foreach($menu_lv2['children'] as $menu_lv3)
                                            <li>
                                                <a class="item-link" rel="{{ $menu_lv3['rel'] ?? 'javascript:;' }}" href="{{ $menu_lv3['link'] ?? 'javascript:;' }}" target="{{ $menu_lv3['target'] == '_blank' ? 'blank' : '_self' }}" aria-label="{!! $menu_lv3['name']??'' !!}" title="{!! $menu_lv3['name']??'' !!}">
                                                    <span class="fs-12 text-up color_white">  {!! $menu_lv3['name']??'' !!}</span>
                                                </a>
                                            </li>
                                            @endforeach
                                        </ul>
                                        @endif
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </li>
                @endforeach
            </ul>
        @endif
        </div>
</header>
