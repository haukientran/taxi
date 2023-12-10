@extends('Default::mobile.layouts.app')
@section('head')
	<style type="text/css">
		@php
			echo file_get_contents(asset("./assets/build/css/personnel_mb.min.css?v=".config('SudoAsset.vesion')));
		@endphp
	</style>
@endsection
@section('content')
<main class="personnel">
    {{-- <section class="info">
        <div class="info-background">
            <img loading="lazy" src="{{ getImage($personnel->banner_mb ?? '') }}" alt="bg-thanh-tuu-1" width="600px" height="800px">
        </div>
        <div class="container">
            <div class="info-content">
                <div class="info-content__des">
                    <h2 class="info-title lh-36 text-up f-w-b fs-36 color_white">{{  $personnel->name ?? '' }}</h2>
                    <span class="info-position mb-30 fs-14 lh-18 color_white mb-30">{{  $personnel->text_position ?? '' }}</span>
                    <p class="fs-24 fw-600 lh-36 color_white info-des">{!!  $personnel->title_position ?? '' !!}</p>
                </div>
			</div>
		</div>
	</section> --}}
    <section class="detail-box">
        <div class="container">
           <div class="flex w-100 mb-30">
                <div class="detail-box__left  text-center">
                    @include('Default::general.components.image', [
                        'src' => resizeWImage($personnel->image, 'w500'),
                        'width' => '450px',
                        'height' => '600px',
                        'lazy'   => true,
                        'title'  =>  getAlt($personnel->image ?? '')
                    ])
                </div>
                <div class="detail-box__right">
                    <div class="ck ck-reset ck-editor ck-rounded-corners" role="application" dir="ltr">
                        <div class="content bot-content ck-content">
                            {!! replaceCkeditor($personnel->description) ?? '' !!}
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex w-100 mb-30">
                <div class="detail-box__left text-center">
                    @include('Default::general.components.image', [
                        'src' => resizeWImage($personnel->image_more, 'w500'),
                        'width' => '450px',
                        'height' => '600px',
                        'lazy'   => true,
                        'title'  =>  getAlt($personnel->image_more ?? '')
                    ])
                </div>
                <div class="detail-box__right">
                    <div class="ck ck-reset ck-editor ck-rounded-corners" role="application" dir="ltr">
                        <div class="content-right ck-content mt-30">
                            {!! replaceCkeditor($personnel->description_more) ?? '' !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @if(count($slides) > 0)
    <div class="container">
    <section class="thumbnail w-100">
        <div class="thumbnail-list s-wrap" id="image_personnel">
            <div class="s-content">
                @foreach ($slides as $key => $slide)
                    @if( $key < 4)
                        <div  data-thumnail="" class="thumbnail-list__item">
                            @include('Default::general.components.image', [
                                'src' => resizeWImage($slide, 'w600'),
                                'width' => '580px',
                                'height' => '370px',
                                'lazy'   => true,
                                'title'  =>  getAlt($slide ?? '')
                            ])
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </section>
    </div>
    @endif
    @include('Default::mobile.layouts.blog',['posts'=>$post_news, 'title'=>'Bài viết nổi bật'])
</main>
@endsection
@section('foot')
    <script defer src="{{ '/assets/build/js/page.min.js?v='.config('SudoAsset.vesion') }}"></script>
@endsection

