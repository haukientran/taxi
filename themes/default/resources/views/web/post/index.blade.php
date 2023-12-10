@extends('Default::web.layouts.app')
@section('head')
    <style type="text/css">
        @php
            echo file_get_contents(asset("./assets/build/css/post.min.css?v=".config('SudoAsset.vesion')));
        @endphp
    </style>
@endsection
@section('content')
    <main id="category_post">
        <div class="container">
            <section class="post flex w-100">
                <div class="post-left">
                    <div class="post-left__title">
                        <h1 class="post-title fs-32 lh-36 f-w-b"> {!! $category->name  ?? $config_post['category_title'] !!}</h1>
                    </div>
                    <div class="post-left__content mt-30">
                        <div class="post-list col-gird-6"  id="listdata">
                            @include('Default::web.post.listdata', ['posts' => $posts])
                        </div>
                        <div class="mt-20">
                            <input type="hidden" name="current_url" value="{{ $url ?? '' }}" aria-label="current_url" class="current_url" id="current_url">
                            {!! $posts->appends(Request()->all())->links('pagination::bootstrap-4') !!}
                        </div>
                    </div>
                </div>
                <div class="post-right">
                    <div class="sidebar">
                        <div class="sidebar__category">
                            <p class="text text-up fs-16 lh-18 text-center w-100 fw-500">Danh mục</p>
                            <ul>
                                @if(isset($category->post_seo))
                                    @php
                                        $post_seo = json_decode(base64_decode($category->post_seo));
                                    @endphp
                                    @foreach ($post_seo->name as $key => $item)
                                        @if (!empty($post_seo->link[$key]))
                                            <li>
                                                <a href="{{ $post_seo->link[$key] }}" aria-label="{{ $item }}">{{ $item }}</a>
                                            </li>
                                        @else
                                            <li>{{ $item }}</li>
                                        @endif
                                    @endforeach
                                @else
                                    @if(isset($config_post['list_category']['name']) && count($config_post['list_category']['name']) > 0)
                                        @foreach($config_post['list_category']['name'] as $key => $name)
                                            <li>
                                                <a href="{{ $config_post['list_category']['link'][$key] }}" aria-label="{{ $name }}">{{ $name }}</a>
                                            </li>
                                        @endforeach
                                    @endif
                                @endif
                            </ul>
                        </div>
                        <div class="sidebar__fanpage mt-20">
                            <div class="facebook-embed">
                                <!-- Dán mã nhúng từ Facebook vào đây -->
                                {!! $config_post['iframe_pages'] !!}
                            </div>
                        </div>
                        <div class="sidebar__blog">
                            <p class="text text-up fs-24 lh-26 w-100 color_main fw-600">Bài viết mới nhất</p>
                            <div class="blog-list">
                                @include('Default::web.layouts.blog_item', ['posts'=> $post_news])
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </main>
@endsection
