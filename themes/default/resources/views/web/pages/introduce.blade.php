@extends('Default::web.layouts.app')
@section('head')
	<style type="text/css">
		@php
			echo file_get_contents(asset("./assets/build/css/page.min.css?v=".config('SudoAsset.vesion')));
		@endphp
	</style>
@endsection
@section('content')
<main class="introduce">
    <div class="container">
        <section class="introduce-banner w-100">
            <div class="introduce-banner__info">
                <h1 class="fs-60 lh-60 f-w-b">
                    {!! $setting_introduce['introduce_title'] ?? 'Hành trình<span style="color:#ff2b80"> 10 năm</span><br>theo đuổi sự <span style="color:#ff2b80">BỀN VỮNG</span>' !!}
                </h1>
                <p class="fs-16 fw-600 lh-20 color_desc des mb-30">{!! $setting_introduce['introduce_des'] ?? 'Xác định đích đến trong mỗi dự án là hiệu quả cuối cùng cho khách hàng về cả doanh thu và thương hiệu, SEONGON đã khẳng định được vị thế dẫn đầu về Google Marketing trong suốt 10 năm với hàng nghìn dự án thành công!' !!} </p>
                {{-- <a href="{{  $setting_introduce['introduce_link'] ?? ''  }}" class="button button__video fs-16 lh-20 f-w-b color_white">
                    <svg style="margin-bottom: -2px;" xmlns="http://www.w3.org/2000/svg" fill="#fff" height="15" viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M0 256a256 256 0 1 1 512 0A256 256 0 1 1 0 256zM188.3 147.1c-7.6 4.2-12.3 12.3-12.3 20.9V344c0 8.7 4.7 16.7 12.3 20.9s16.8 4.1 24.3-.5l144-88c7.1-4.4 11.5-12.1 11.5-20.5s-4.4-16.1-11.5-20.5l-144-88c-7.4-4.5-16.7-4.7-24.3-.5z"/></svg>
                    Xem video
                </a> --}}
            </div>
            <div class="introduce-banner__thumb">
                @include('Default::general.components.image', [
                    'src' => resizeWImage($setting_introduce['introduce_banner'] ?? '', 'w600'),
                    'width' => '576px',
                    'height' => '645px',
                    'lazy'   => true,
                    'title'  => 'ảnh banner'
                ])
            </div>
        </section>
    </div>
    <section class="story" id="story">
        <div class="introduce-background">
            <img loading="lazy" src="{{ getImage($setting_introduce['story_banner'] ?? '/assets/images/Cau-chuyen-thuong-hieu.png') }}" alt="bg-thanh-tuu-1" width="1920px" height="290px">
        </div>
        <div class="container">
            <div class="story-content flex w-100">
				<div class="story-content__left">
                    <h2 class="story-title fs-16 lh-24 text-up f-w-b color_white mb-20">Câu chuyện thương hiệu</h2>
                    <h3 class="introduce-text fs-48 f-w-b lh-50 color_white">{!! $setting_introduce['story_title'] ?? 'Tiên phong khai phá lối đi riêng với niềm tin <span>3 WIN</span>' !!}  </h3>
                    <p class="fs-16 fw-600 lh-20 color_white introduce-des">{!! $setting_introduce['story_des'] ?? 'Vào những năm 2010 – 2012, thị trường Google Ads và SEO đồng thau lẫn lộn với nhiều doanh nghiệp dùng thủ thuật (tip, trick) để tư lợi cá nhân. Đứng trên quan điểm nhất quán là tìm kiếm sự phát triển bền vững, SEONGON nhận định làm các thủ thuật Mũ đen là ăn xổi. Google sẽ phát triển mỗi ngày để người dùng của họ có được trải nghiệm tìm kiếm đúng hơn, nhanh hơn, dễ dàng hơn.' !!} </p>
					<div class="story_detail color_white mt-20">
                        {!! $setting_introduce['story_detail'] ?? '' !!}
                    </div>
				</div>
				<div class="story-content__right">
					@include('Default::general.components.image', [
						'src' =>  resizeWImage($setting_introduce['story_image'] ??  '/assets/images/image-thuong-hieu.png' ,'w400'),
						'width' => '397px',
						'height' => '562px',
						"lazy"   => true,
						"title" =>''
					])
				</div>
			</div>
		</div>
	</section>
    <section class="achievement" id="achievement">
        <div class="introduce-background">
            @include('Default::general.components.image', [
                'src' =>  resizeWImage($setting_introduce['achievement_banner'] ??  '/assets/images/bg-thanh-tuu-1.png' , 'w400'),
                'width' => '100%',
                'height' => '100%',
                "lazy"   => true,
                "title" =>''
            ])
        </div>
        <div class="container">
            <div class="achievement-content w-100">
                <h2 class="introduce-title fs-50 lh-50 f-w-b color_white mb-30 w-100">{{ $setting_introduce['achievement_title'] ?? 'Thành tựu của chúng tôi' }}</h2>
                <div class="achievement-content__list">
                    @if(isset($setting_introduce['achievement']['title']) && count($setting_introduce['achievement']['title']) > 0)
                        @foreach($setting_introduce['achievement']['title'] as $key => $title)
                            <div class="item">
                                <strong class="f-w-b fs-30 lh-35 text-center color_white">{{ $setting_introduce['achievement']['name'][$key] ?? '' }}</strong>
                                <p class="item-content mt-10 fw-599 text-center color_white lh-20">{{ $title ?? '' }}</p>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </section>
    <section class="core_value">
        <div class="introduce-background">
            @include('Default::general.components.image', [
                'src' =>  resizeWImage($setting_introduce['core_value_banner'] ??  '/assets/images/gia-tri-mang-lai-cho-doi-ngu.png' ),
                'width' => '100%',
                'height' => '100%',
                "lazy"   => true,
                "title" =>''
            ])
        </div>
        <div class="container">
            <div class="core_value-content w-100">
                <h2 class="introduce-title fs-50 lh-50 f-w-b color_white">Sứ mệnh, <br> giá trị cốt lõi</h2>
                <div class="core_value-content__list flex mt-30">
                    @if(isset($setting_introduce['core_value']['name']) && count($setting_introduce['core_value']['name']) > 0)
                        @foreach($setting_introduce['core_value']['name'] as $key => $name)
                            <div class="item">
                                <h3 class="f-w-b fs-24 lh-24 color_white"><span>{{ $key+1 }}</span>. {{ $name }}</h3>
                                <p class="item-content fs-16 mt-10 fw-400 color_white lh-24 mt-20">
                                   {{ $setting_introduce['core_value']['title'][$key] ?? '' }}
                                </p>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </section>
    @include('Default::web.layouts.team',['title'=>$setting_introduce['team_title'] ?? '<span> Được dẫn dắt</span> <br> bới chuyên gia','personnels'=>$personnels])
    <section class="story" id="story">
        <div class="introduce-background">
            <img loading="lazy" src="{{ getImage($setting_introduce['value_banner'] ?? '/assets/images/Cau-chuyen-thuong-hieu.png') }}" alt="bg-thanh-tuu-1" width="1920px" height="290px">
        </div>
        <div class="container">
            <div class="story-content flex w-100">
				<div class="story-content__left">
                    <h2 class="introduce-text fs-48 f-w-b lh-50 color_white">Không ngừng mang lại giá trị cho <span>đội ngũ</span></h2>
                    <p class="fs-16 fw-600 lh-20 color_white introduce-des">{!! $setting_introduce['value_title'] ?? ''!!} <br><span class="fs-14 fw-400 color_white lh-18">{!! $setting_introduce['value_des'] ?? '' !!}</span> </p>
					<div class="story_detail color_white mt-20">
                        {!! $setting_introduce['value_detail'] ?? '' !!}
                    </div>
				</div>
				<div class="story-content__right">
					@include('Default::general.components.image', [
						'src' =>  resizeWImage($setting_introduce['value_image'] ??  '/assets/images/image-thuong-hieu.png','w400' ),
						'width' => '397px',
						'height' => '562px',
						"lazy"   => true,
						"title" =>''
					])
				</div>
			</div>
		</div>
	</section>
    @if(isset($config_general['customer_reviews']['image']) && count($config_general['customer_reviews']['image']) > 0)
    <section id="evaluate" style="background :{{ isset($config_general['color_backgroud']) ? $config_general['color_backgroud'] : '#363636' }}">
        <div class="evaluate-container">
            <h2 class="introduce-title fs-38 lh-40 f-w-b color_white">Không ngừng <br> mang lại giá trị cho KHÁCH HÀNG</h2>
            <div class="evaluate-list s-wrap" id="evaluate-slide">
                <div class="evaluate-box">
                    <div class="s-content">
                        @foreach($config_general['customer_reviews']['image'] as $key => $image)
                            <div class="evaluate-item"  data-thumnail="">
                                <div class="evaluate-item__icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512">
                                        <path d="M464 32H336c-26.5 0-48 21.5-48 48v128c0 26.5 21.5 48 48 48h80v64c0 35.3-28.7 64-64 64h-8c-13.3 0-24 10.7-24 24v48c0 13.3 10.7 24 24 24h8c88.4 0 160-71.6 160-160V80c0-26.5-21.5-48-48-48zm-288 0H48C21.5 32 0 53.5 0 80v128c0 26.5 21.5 48 48 48h80v64c0 35.3-28.7 64-64 64h-8c-13.3 0-24 10.7-24 24v48c0 13.3 10.7 24 24 24h8c88.4 0 160-71.6 160-160V80c0-26.5-21.5-48-48-48z"/>
                                    </svg>
                                </div>
                                <div class="evaluate-item__content">
                                    {!! $config_general['customer_reviews']['des'][$key] ?? ''!!}
                                </div>
                                <div class="evaluate-item__rate">
                                    <svg class="rate-item" height="1em" viewBox="0 0 576 512">
                                        <path d="M259.3 17.8L194 150.2 47.9 171.5c-26.2 3.8-36.7 36.1-17.7 54.6l105.7 103-25 145.5c-4.5 26.3 23.2 46 46.4 33.7L288 439.6l130.7 68.7c23.2 12.2 50.9-7.4 46.4-33.7l-25-145.5 105.7-103c19-18.5 8.5-50.8-17.7-54.6L382 150.2 316.7 17.8c-11.7-23.6-45.6-23.9-57.4 0z"/>
                                    </svg>
                                    <svg class="rate-item" height="1em" viewBox="0 0 576 512">
                                        <path d="M259.3 17.8L194 150.2 47.9 171.5c-26.2 3.8-36.7 36.1-17.7 54.6l105.7 103-25 145.5c-4.5 26.3 23.2 46 46.4 33.7L288 439.6l130.7 68.7c23.2 12.2 50.9-7.4 46.4-33.7l-25-145.5 105.7-103c19-18.5 8.5-50.8-17.7-54.6L382 150.2 316.7 17.8c-11.7-23.6-45.6-23.9-57.4 0z"/>
                                    </svg>
                                    <svg class="rate-item" height="1em" viewBox="0 0 576 512">
                                        <path d="M259.3 17.8L194 150.2 47.9 171.5c-26.2 3.8-36.7 36.1-17.7 54.6l105.7 103-25 145.5c-4.5 26.3 23.2 46 46.4 33.7L288 439.6l130.7 68.7c23.2 12.2 50.9-7.4 46.4-33.7l-25-145.5 105.7-103c19-18.5 8.5-50.8-17.7-54.6L382 150.2 316.7 17.8c-11.7-23.6-45.6-23.9-57.4 0z"/>
                                    </svg>
                                    <svg class="rate-item" height="1em" viewBox="0 0 576 512">
                                        <path d="M259.3 17.8L194 150.2 47.9 171.5c-26.2 3.8-36.7 36.1-17.7 54.6l105.7 103-25 145.5c-4.5 26.3 23.2 46 46.4 33.7L288 439.6l130.7 68.7c23.2 12.2 50.9-7.4 46.4-33.7l-25-145.5 105.7-103c19-18.5 8.5-50.8-17.7-54.6L382 150.2 316.7 17.8c-11.7-23.6-45.6-23.9-57.4 0z"/>
                                    </svg>
                                    <svg class="rate-item" height="1em" viewBox="0 0 576 512">
                                        <path d="M259.3 17.8L194 150.2 47.9 171.5c-26.2 3.8-36.7 36.1-17.7 54.6l105.7 103-25 145.5c-4.5 26.3 23.2 46 46.4 33.7L288 439.6l130.7 68.7c23.2 12.2 50.9-7.4 46.4-33.7l-25-145.5 105.7-103c19-18.5 8.5-50.8-17.7-54.6L382 150.2 316.7 17.8c-11.7-23.6-45.6-23.9-57.4 0z"/>
                                    </svg>
                                </div>
                                <div class="evaluate-item__info">
                                    <div class="evaluate-item__info-avata rounded-circler">
                                        @include('Default::general.components.image', [
                                            'src' => resizeWImage($image,'w100'),
                                            'width' => '82px',
                                            'height' => '82px',
                                            'lazy'   => true,
                                            'title'  =>  getAlt($image ?? '')
                                        ])
                                    </div>
                                    <div class="evaluate-item__info-details">
                                        <div class="evaluate-item__info-name">
                                            {{ $config_general['customer_reviews']['customer_name'][$key] ?? '' }}
                                        </div>
                                        <div class="evaluate-item__info-position">{{ $config_general['customer_reviews']['position'][$key] ?? '' }}</div>
                                        <div class="evaluate-item__info-company">{{ $config_general['customer_reviews']['address'][$key] ?? '' }}</div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif
    <div class="container">
        <section class="activities">
            <div class="activities-content">
                <h3 class="introduce-text fs-24 f-w-b lh-50 text-center text-up">Hoạt động công ty</h3>
                <div class="activities-content__list flex mt-20">
                    @if(isset($setting_introduce['activities']['image_item']) && count($setting_introduce['activities']['image_item']) > 0)
                        @foreach($setting_introduce['activities']['image_item'] as $key => $image_item)
                            <div class="item">
                                @include('Default::general.components.image', [
                                    'src' => resizeWImage($image_item,'w400'),
                                    'width' => '380px',
                                    'height' => '295px',
                                    'lazy'   => true,
                                    'title'  =>  getAlt($image ?? '')
                                ])
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </section>
    </div>
</main>
@endsection
@section('foot')
    <script defer src="{{ '/assets/build/js/page.min.js?v='.config('SudoAsset.vesion') }}"></script>
@endsection

