@extends('Default::web.layouts.app')
@section('head')
    <style type="text/css">
        @php
            /*echo file_get_contents(asset("./assets/build/css/home.min.css?v=".config('SudoAsset.vesion')));*/
            /*echo file_get_contents(asset("/admin_assets/libs/fancybox/jquery.fancybox.min.css"));*/

        @endphp
    </style>
    <link rel="stylesheet" type="text/css" href="{{ asset("/assets/build/css/home.min.css?v=".config('SudoAsset.vesion')) }}">
    <link rel="stylesheet" type="text/css" href="{{ asset("/admin_assets/libs/fancybox/jquery.fancybox.min.css") }}">

    @if(isset($slides) && count($slides) > 0)
        @foreach ($slides as $slide)
            <link rel="preload" as="image" href="{{ resizeWImage($slide->image,'')  }}">
        @endforeach
    @endif
    @if(isset($setting_home['reason_youtube_link']))
    <script type="text/javascript" defer>
        document.addEventListener("DOMContentLoaded", function(event) {
            $(document).ready(function() {
                setTimeout(function() {
                    let link_video = '{!! $setting_home['reason_youtube_link'] !!}';
                    let video_yt = '<iframe loading="lazy" width="585" height="353" src="'+link_video.replace("https://www.youtube.com/watch?v=", "https://www.youtube.com/embed/")+'" frameborder="0" allowfullscreen></iframe>'
                    $('.reason-right').append(video_yt);
                }, 5000)
            });
        });
    </script>
    @endif
@endsection
@section('content')
<main id="main">
    <input type="hidden" name="current_url" value="/" class="current_url">
    @include('Default::web.layouts.banner')
    <section id="reason">
        <div class="container">
                    <h1 class="section-title reason-title">{{ isset($setting_home['reason_title']) ? $setting_home['reason_title'] : '' }}</h1>
           <div class="col-gird-6 reason-box">
                <div class="reason-left">
                    <div class="reason-content">{{ isset($setting_home['reason_description']) ? $setting_home['reason_description'] : '' }}</div>
                    <a href="{{ isset($setting_home['reason_link']) ? $setting_home['reason_link'] : '' }}" class="btn btn-primary reason-btn" aria-label="Xem chi tiết" title="Xem chi tiết">Xem chi tiết</a>
                </div>
                @if (isset($setting_home['reason_image']) && $setting_home['reason_image'] !== "")
                    <div class="reason-right__image">
                        @include('Default::general.components.image', [
                            'src' => resizeWImage( $setting_home['reason_image']  ?? '', 'w600'),
                            'width' => '585',
                            'height' => '325',
                            'lazy'   => true,
                            'title'  =>  getAlt($setting_home['reason_image']  ?? '')
                        ])
                    </div>
                @else
                    <div class="reason-right"> </div>
                @endif
            </div>
        </div>
    </section>
    @include('Default::web.layouts.should-choose_home')
    @include('Default::web.layouts.register', ['title' => isset($setting_home['register_title']) ? $setting_home['register_title'] : 'ĐĂNG KÝ DỊCH VỤ'])



    <section id="table_price" class="w-100 mt-20">
        <div class="container">
            <div class="table_price col-gird-6 w-100">
                <div class="table_price-left css-content">
                    {!! ($setting_home['table_price'] ?? '')!!}
                    <a href="tel:{{ $config_general['hotline_support'] ?? '' }}" class="btn btn-primary btn-book color_white mt-10 lh-40 text-up fs-16 f-w-b" aria-label="Đặt xe" title="Đặt xe">Đặt xe: {{ $config_general['hotline_support'] ?? '' }}</a>
                </div>
                <div class="table_price-right">
                    @include('Default::general.components.image', [
                        'src' => resizeWImage( $setting_home['table_price_banner']  ?? '', 'w600'),
                        'width' => '585',
                        'height' => '325',
                        'lazy'   => true,
                        'title'  =>  getAlt($setting_home['table_price_banner']  ?? '')
                    ])
                </div>
            </div>
        </div>
    </section>

    <section id="service_price" class="service_price">
        <div class="container">
            <div class="service_price__introduce css-content">
                {!! ($setting_home['introduce_service'] ?? '')!!}
            </div>
            @if(isset($setting_home['service_price']['title']) && count($setting_home['service_price']['title']) > 0)
            <div class="service_price__list col-gird-6 w-100">
                @foreach($setting_home['service_price']['title'] as $k => $title)
                <div class="item">
                    <div class="item-thumbnail">
                        @include('Default::general.components.image', [
                            'src' => resizeWImage(isset($setting_home['service_price']['image'][$k]) ? $setting_home['service_price']['image'][$k] : '' , 'w500'),
                            'width' => '500',
                            'height' => '300',
                            "lazy"   => true,
                        ])
                    </div>
                    <div class="item-detail text-center">
                        <div class="item-content fs-20 f-w-b text-up mb-30">{{ $title ?? '' }}</div>
                        <div class="item-description mt-10 f-w-b fs-16">{{isset($setting_home['service_price']['description_price1'][$k]) ? $setting_home['service_price']['description_price1'][$k] : '' }}</div>
                        <div class="item-description mt-10 f-w-b fs-16 mb-20">{{isset($setting_home['service_price']['description_price2'][$k]) ? $setting_home['service_price']['description_price2'][$k] : '' }}</div>
                        <a href="tel:{{ $config_general['hotline_support'] ?? '' }}" class="btn btn-primary contidion-btn mt-10 w-100 lh-50 text-up fs-16 f-w-b" aria-label="Xem chi tiết" title="Xem chi tiết">Đặt xe</a>
                    </div>
                </div>
                @endforeach
            </div>
            @endif
        </div>
    </section>

    @if(isset($arboards) && count($arboards) > 0)
    <section id="nation">
        <div class="container">
            <h2 class="section-title nation-title">{{ isset($setting_home['country_home_title']) ? $setting_home['country_home_title'] : 'Quốc gia du học' }} </h2>
            <div class="nation-list col-gird-4">
                @include('Default::web.layouts.nation_list')
            </div>
            @if(count($arboards) >= 6)
                <div class="flex-center w-100">
                    <a href="javascript:;" class="see-more nation-see-more" aria-label="Xem tiếp" title="Xem tiếp">Xem tiếp</a>
                </div>
            @endif
        </div>
    </section>
    @endif
    @if(isset($setting_home['contidion']['title']) && count($setting_home['contidion']['title']) > 0)
    <section id="contidion">
        <div class="container">
            <h2 class="section-title contidion-title">{{ isset($setting_home['contidion_title']) ? $setting_home['contidion_title'] : 'Điều kiện tham gia chương trình' }}</h2>
            <div class="contidion-list w-100">
                @foreach($setting_home['contidion']['title'] as $k => $condition)
                <div class="contidion-item">
                    <div class="contidion-item__thumbnail">
                        @include('Default::general.components.image', [
                            'src' => resizeWImage(isset($setting_home['contidion']['image'][$k]) ? $setting_home['contidion']['image'][$k] : '' , 'w300'),
                            'width' => '300',
                            'height' => '300',
                            "lazy"   => true,
                            'title'  =>  'khoa-hoc-ke-toan-tong-hop-1'
                        ])
                    </div>
                    <div class="contidion-item__content">{{ $condition ?? '' }}</div>
                    <a href="{{ isset($setting_home['contidion']['link'][$k]) ? $setting_home['contidion']['link'][$k] : '' }}" class="btn btn-primary contidion-btn" aria-label="Xem chi tiết" title="Xem chi tiết">Đăng ký</a>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif
    @include('Default::web.layouts.service_grid3')
    @include('Default::web.layouts.evaluate')
    @include('Default::web.layouts.feedback_home', ['title' => isset($setting_home['feedback_title']) ? $setting_home['feedback_title'] : 'Chia sẻ từ học viên Lê Ánh'])
    @include('Default::web.layouts.list_image_home',['title'=> isset($setting_home['activity_title']) ? $setting_home['activity_title'] : 'Hoạt động tại Lê ánh' ])
    @include('Default::web.layouts.blog',['posts'=>$posts, 'title'=> isset($setting_home['news_title']) ? $setting_home['news_title'] : 'Tin tức sự kiện'])
    
    @if(isset($setting_home['partner']['image']) && count($setting_home['partner']['image']) > 0)
    <section id="partner">
        <div class="container">
            <h2 class="section-title partner-title">{{ isset($setting_home['partner_title']) ? $setting_home['partner_title'] : 'Truyền thông báo chí nói gì về chúng tôi' }}</h2>
            <div class="partner-list">
                @foreach($setting_home['partner']['image'] as $k => $partner)
                    @if($setting_home['partner']['link'][$k] !== null)
                        <a href="{{ $setting_home['partner']['link'][$k] ?? '' }}" target="_blank" aria-label="đối tác_{!! $k ?? 0 !!}" rel="{{ $setting_home['partner']['follow'][$k] ?? ''  }}">
                            @include('Default::general.components.image', [
                                'src' => resizeWImage($partner ?? '', 'w200'),
                                'width' => '200px',
                                'height' => '110px',
                                'lazy'   => true,
                                'title'  =>  getAlt($partner ?? '')
                            ])
                        </a>
                    @else
                        @include('Default::general.components.image', [
                            'src' => resizeWImage($partner ?? '', 'w200'),
                            'width' => '200px',
                            'height' => '110px',
                            'lazy'   => true,
                            'title'  =>  getAlt($partner ?? '')
                        ])
                    @endif
                @endforeach
            </div>
        </div>
    </section>
    @endif

    @include('Default::web.layouts.should-choose-grid2')
</main>
@endsection
@section('foot')
    <script defer src="/admin_assets/libs/fancybox/jquery.fancybox.min.js"></script>
@endsection
