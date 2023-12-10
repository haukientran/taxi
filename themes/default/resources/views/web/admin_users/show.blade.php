@extends('Default::web.layouts.app')
@section('head')
    <style type="text/css">
        @php
            echo file_get_contents(asset("./assets/build/css/page.min.css?v=".config('SudoAsset.vesion')));
        @endphp
    </style>
@endsection
@section('content')
    <main>
        <section class="author">
            <div class="container">
                <div class="author-content flex">
                    @if($admin_users)
                        <div class="content-left__auth">
                            <div class="infomation flex flex-center-left">
                                <div class="infomation-name flex flex-center-left">
                                    <div class="avatar mr-20">
                                        @include('Default::general.components.image', [
                                            'src' => resizeWImage($admin_users->getAvatar() ?? '', 'w150'),
                                            'width' => '120px',
                                            'height' => '120px',
                                            'lazy'   => true,
                                            'title'  =>  ''
                                        ])
                                    </div>
                                    <div class="right">
                                        <div class="right-display fs-24 lh-28 f-w-b">{{ $admin_users->getName() ?? ''}}</div>
                                        <div class="right-role lh-16 color_desc">{{ $admin_users->position ?? ''}}</div>
                                    </div>
                                </div>
                                @php
                                    $social = json_decode($admin_users->social, true);
                                @endphp
                                <div class="infomation-social__list">
                                    <a href="{{ isset($social['facebook']) ? $social['facebook'] : 'javascript:;'}}" rel="nofollow" target="_blank" aria-label="facebook">
                                        @include('Default::general.components.image', [
                                            'src' =>  '/assets/images/icon/facebook.png.webp',
                                            'width' => '44px',
                                            'height' => '44px',
                                            "lazy"   => true,
                                            "title" =>''
                                        ])
                                    </a>
                                    <a href="{{ isset($social['youtube']) ? $social['youtube'] : 'javascript:;'}}" rel="nofollow" target="_blank" aria-label="youtube">
                                        @include('Default::general.components.image', [
                                            'src' =>  '/assets/images/icon/youtube.png.webp',
                                            'width' => '44px',
                                            'height' => '44px',
                                            "lazy"   => true,
                                            "title" =>''
                                        ])
                                    </a>
                                    <a href="{{ isset($social['pinterest']) ? $social['pinterest'] : 'javascript:;'}}" rel="nofollow" target="_blank" aria-label="pinterest">
                                        @include('Default::general.components.image', [
                                            'src' =>  '/assets/images/icon/pinterest.png.webp',
                                            'width' => '44px',
                                            'height' => '44px',
                                            "lazy"   => true,
                                            "title" =>''
                                        ])
                                    </a>
                                    <a href="{{ isset($social['twitter']) ? $social['twitter'] : 'javascript:;'}}" rel="nofollow" target="_blank" aria-label="twitter">
                                        @include('Default::general.components.image', [
                                            'src' =>  '/assets/images/icon/twitter.png.webp',
                                            'width' => '44px',
                                            'height' => '44px',
                                            "lazy"   => true,
                                            "title" =>''
                                        ])
                                    </a>
                                </div>

                            </div>
                            <div class="description">
                                <div class="description-title">
                                    <h2 class="fs-18 lh-22 f-w-b color_primary flex-center-left">
                                        <svg width="56" height="1" viewBox="0 0 56 1" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M1.22266 0.5H55.1516" stroke="#3877F6" stroke-linecap="round"/>
                                        </svg>
                                        Đôi nét về tác giả
                                    </h2>
                                </div>
                                <p class="fs-24 lh-30 f-w-b">{{ $admin_users->position ?? ''}}</p>
                                @if(isset($admin_users->infomation))
                                <div class="description-content">
                                    <p class="description-content__text f-italic">{{ cutString(removeHTML($admin_users->infomation), 280) ?? ''}}</p>
                                </div>
                                @endif
                            </div>
                            <div class="article-content">
                                <div class="css-content post-body mb-7">
                                    {!! replaceCkeditor($admin_users->detail ?? '')!!}
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </section>
    </main>
@endsection
