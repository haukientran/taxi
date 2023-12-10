@extends('Default::mobile.layouts.app')
@section('head')
    <style type="text/css">
        @php
            echo file_get_contents(asset("./assets/build/css/product_mb.min.css?v=".config('SudoAsset.vesion')));
            echo file_get_contents(asset("/admin_assets/libs/fancybox/jquery.fancybox.min.css"));
        @endphp
    </style>
    <link rel="preload" as="image" href="{{resizeWImage($study_abroad->banner_image ?? '', 'w450') }}">
@endsection
@section('content')
@php
    $videos = json_decode(base64_decode($study_abroad->video));
    $benefits = json_decode(base64_decode($study_abroad->benefit));
    $notes = json_decode(base64_decode($study_abroad->note));
    $differences = json_decode(base64_decode($study_abroad->difference));
    $tuitions = json_decode(base64_decode($study_abroad->tuitions));
@endphp
<main id="main">
    <div id="banner">
        @include('Default::general.components.image', [
            'src' => resizeWImage($study_abroad->banner_image, 'w450'),
            'width' => '414px',
            'height' => '400px',
            'lazy'   => true,
            'title'  =>  getAlt($study_abroad->banner_image ?? '')
        ])
    </div>
    @include('Default::mobile.layouts.should-choose',['differences'=> $differences])
    <div class="container">
        <h1 class="section-title title text-center">{{ $study_abroad->name ?? '' }}</h1>
        <div class="ck ck-reset ck-editor ck-rounded-corners" role="application" dir="ltr">
            <div class="content ck-content">
                {!! replaceCkeditor($study_abroad->detail) ?? '' !!}
            </div>
        </div>
        <div class="box-first">
            @if (!empty($study_abroad->purpose))
            <div class="box-first-item">
                <h3 class="box-title box-first-item__title">{{ $study_abroad->purpose_title ?? 'Mục đích khóa học' }}</h3>
                <div class="ck ck-reset ck-editor ck-rounded-corners" role="application" dir="ltr">
                    <div class="ck-content box-first-item__content">
                        {!! replaceCkeditor($study_abroad->purpose) ?? '' !!}
                    </div>
                </div>
            </div>
            @endif
            @if (!empty($study_abroad->participants))
            <div class="box-first-item">
                <h3 class="box-title box-first-item__title">{{ $study_abroad->participants_title ?? 'Đối tượng tham gia khóa học' }}</h3>
                <div class="ck ck-reset ck-editor ck-rounded-corners" role="application" dir="ltr">
                    <div class="ck-content box-first-item__content">
                        {!! replaceCkeditor($study_abroad->participants) ?? '' !!}
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
    @if(isset($benefits->name) && count($benefits->name) > 0)
    <div class="box-second">
        <h3 class="section-title box-second__title text-center">{{ $study_abroad->benefit_title ?? 'Lợi ích du học' }}</h3>
        <div class="box-second-list">
            @foreach ($benefits->name as $key => $name)
                <div class="box-second-item">
                    <h4 class="box-second-item__title" style="background:{!!  $benefits->color[$key] ?? "#e8c0c0" !!}">{{ $name ?? ''}}</h4>
                    <div class="box-second-item__content">
                        {!! $benefits->description[$key] !!}
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    @endif
    @if(isset($notes->name) && count($notes->name) > 0)
    <div class="container">
        <div class="box-third">
            <h3 class="section-title box-third__title text-center">{{ $study_abroad->note_title ?? '' }}</h3>
            <div class="box-third-list">
                @foreach ($notes->name as $key => $name)
                    <div class="box-third-item">
                        <h4 class="box-third-item__title" style="background:{!!  $notes->color[$key] ?? "#e8c0c0" !!}">{{ $key+1 }}. {{ $name ?? 'NHỮNG ĐIỀU CẦN LƯU Ý'}}</h4>
                        <div class="box-third-item__content" style="background:{!!  $notes->color_content[$key] ?? "#e8c0c0" !!}">
                            {!! $notes->description[$key] !!}
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    @endif
    @include('Default::mobile.layouts.team',['class'=>'section-title', 'title'=>$setting_introduce['team_title'] ?? 'Đội ngũ giảng viên','personnels'=>$related_teams])
    @include('Default::mobile.layouts.feedback', ['title' => 'Video học viên', 'videos' => $videos])
    @include('Default::mobile.layouts.list_image', ['title' => 'Phản hồi học viên', 'images' => $feedback_images , 'type'=>'feedback'])
    @include('Default::mobile.layouts.list_image', ['title' => 'Hình ảnh du học sinh', 'images' => $student_images, 'type'=>'student'])
    @if (!empty($study_abroad->schedule))
    <div class="container">
        <div class="box-schedule w-100">
            <h3 class="section-title schedule-title text-center">{{ $study_abroad->schedule_title ?? 'Lịch khai giảng' }}</h3>
            <div class="schedule-content ck ck-reset ck-editor ck-rounded-corners">
                <div class="ck-content">
                    {!! replaceCkeditor($study_abroad->schedule) ?? '' !!}
                </div>
            </div>
        </div>
    </div>
    @endif
    @include('Default::mobile.layouts.blog',['posts'=>$related_study_abroads, 'title'=>'Bài viết du học liên quan'])
    @include('Default::mobile.layouts.tuition',['tuitions'=> $tuitions])
    @include('Default::mobile.layouts.form_register',['title'=>'Đăng kí tư vấn miễn phí'])
    <div class="box-comment">
        <div class="container">
            <div class="comment-content w-100">
                @include('Comment::list', [
                    'type' => 'study_abroads',
                    'type_id' => $study_abroad->id ?? 0,
                    'regulation_link' => '#',
                    'no_comment_text' => 'Hãy để lại bình luận của bạn tại đây!',
                    'title' => 'Bình luận',
                    'title_button' => 'Viết bình luận',
                    'vote' => true,
                    'rank' => $study_abroad->average_comment  ?? 0,
                    'total_comment' => $study_abroad->total_comment_by_id  ?? 1,
                    'list_comment_star' => $study_abroad->list_average_comment  ?? [],
                    'data' => $study_abroad  ?? 0,
                    'mobile' => true,
                ])
            </div>
        </div>
    </div>
    @include('Default::mobile.layouts.popup_register')
</main>
@endsection
@section('foot')
    <script defer src="/admin_assets/libs/fancybox/jquery.fancybox.min.js"></script>
@endsection
