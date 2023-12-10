@php
    $mobile_menu = json_decode(@$config_menu['mobile_menu'], 1) ?? [];
@endphp
<header class="header {{ Route::getCurrentRoute() != null && Route::getCurrentRoute()->uri() == '/' ? 'home header_home' : '' }}">
    <div class="header-content">
        <div class="flex-center-between w-100">
            <div class="header-logo">
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
            <div class="header-search">
                <form action="{{ route('mobile.search') }}">
                    <input for="keyword" type="text" name="key" id="keyword" autocomplete="off" value="{{ $key_seach ?? '' }}" placeholder="Tìm thông tin">
                    <a href="javascript:;" class="search-btn search-category">
                        <svg width="18" height="18" viewBox="0 0 1024 1024" class="icon"  version="1.1" xmlns="http://www.w3.org/2000/svg"><path d="M903.232 256l56.768 50.432L512 768 64 306.432 120.768 256 512 659.072z" /></svg>
                    </a>
                    <div class="keyword-category">
                        <div class="item">
                            <div class="checkbox">
                                <input type="checkbox" value="post" aria-label="Trong bài viết" name="customset[]" id="post">
                            </div>
                            <label for="post">Trong bài viết</label>
                        </div>
                        <div class="item">
                            <div class="checkbox">
                                <input type="checkbox" value="school" aria-label="Trong trường học" name="customset[]" id="school">
                            </div>
                            <label for="school">Trong trường học</label>
                        </div>
                        <div class="item">
                            <div class="checkbox">
                                <input type="checkbox" value="arboads" aria-label="Trong du học" name="customset[]" id="arboads">
                            </div>
                            <label for="arboads">Trong du học</label>
                        </div>
                    </div>
                    <div class="header-search__result">
                    </div>
                    <button class="search-btn" name="search" aria-label="btn-search">
                        <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="22" height="22" viewBox="0 0 512 512" enable-background="new 0 0 512 512" xml:space="preserve">
                            <path d="M460.355,421.59L353.844,315.078c20.041-27.553,31.885-61.437,31.885-98.037
                                C385.729,124.934,310.793,50,218.686,50C126.58,50,51.645,124.934,51.645,217.041c0,92.106,74.936,167.041,167.041,167.041
                                c34.912,0,67.352-10.773,94.184-29.158L419.945,462L460.355,421.59z M100.631,217.041c0-65.096,52.959-118.056,118.055-118.056
                                c65.098,0,118.057,52.959,118.057,118.056c0,65.096-52.959,118.056-118.057,118.056C153.59,335.097,100.631,282.137,100.631,217.041
                                z"></path>
                        </svg>
                    </button>
                </form>
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
