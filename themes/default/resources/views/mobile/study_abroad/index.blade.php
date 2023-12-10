@extends('Default::mobile.layouts.app')
@section('head')
    <style type="text/css">
        @php
            echo file_get_contents(asset("./assets/build/css/post_mb.min.css?v=".config('SudoAsset.vesion')));
        @endphp
    </style>
@endsection
@section('content')
    <main id="category_post">
        <div class="container">
            <section class="post w-100">
                <div class="post-left">
                    <div class="post-left__title">
                        <h1 class="post-title fs-32 lh-36 f-w-b"> {!! $config_study_abroad['category_title'] ?? 'Du học' !!}</h1>
                    </div>
                    <div class="post-left__content mt-30">
                        <div class="post-list"  id="listdata">
                            @include('Default::mobile.post.listdata', ['posts' => $study_abroads])
                        </div>
                        <div class="mt-20">
                            <input type="hidden" name="current_url" value="{{ $url ?? '' }}" aria-label="current_url" class="current_url" id="current_url">
                            {!! $study_abroads->appends(Request()->all())->links('pagination::bootstrap-4') !!}
                        </div>
                    </div>
                </div>
                <div class="post-right">
                    <div class="sidebar">
                        <div class="sidebar__blog">
                            <p class="text text-up fs-24 lh-26 w-100 color_main fw-600">Bài viết mới nhất</p>
                            <div class="blog-list">
                                @include('Default::mobile.layouts.blog_item', ['posts'=> $study_abroad_news])
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </main>
@endsection
