@extends('Default::web.layouts.app')
@section('head')
    <style type="text/css">
        @php
            echo file_get_contents(asset("./assets/build/css/post.min.css?v=".config('SudoAsset.vesion')));
        @endphp
    </style>
@endsection
@section('content')
    <main id="post">
       <div class="container">
            <section class="post flex w-100">
                <div class="post-left">
                    <a class="fs-16 f-w-b color_main text-up" href="{{ $category->getUrl() ?? 'javascript' }}">{{  $category->name ?? '' }}</a>
                    <div class="post-left__title mt-15">
                        <h1 class="post-title fs-32 lh-36 f-w-b"> {{ $post->name ?? '' }}</h1>
                        @if($personnels !== null)
                            <a class="info-user" href="{{ $personnels->getUrl()}}" aria-label=""> Tác giả :
                                <span class="f-w-b lh-16 text color_primary mt-10">{{ $personnels->name ?? ''}}</span>
                            </a>
                        @endif
                        <br>
                        <div class="fb-like" data-href="https://developers.facebook.com/docs/plugins/" data-width="" data-layout="" data-action="" data-size="" data-share="true"></div>
                    </div>
                    <div class="post-left__content mt-20">
                        <div class="article-content">
                            <div class="ck ck-reset ck-editor ck-rounded-corners" role="application" dir="ltr">
                                <div class="ck-content ck_detail">
                                    {!! replaceCkeditor($post->detail ?? '')!!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="post-right">
                    <div class="sidebar">
                        <div class="sidebar__category">
                            <p class="text text-up fs-16 lh-18 text-center w-100 fw-500">Danh mục</p>
                            @if(isset($post->list_category))
                                <ul>
                                    @foreach ($list_category->name as $key => $item)
                                        @if (!empty($list_category->link[$key]))
                                            <li>
                                                <a href="{{ $list_category->link[$key] }}" aria-label="{{ $item }}">{{ $item }}</a>
                                            </li>
                                        @else
                                            <li>{{ $item }}</li>
                                        @endif
                                    @endforeach
                                </ul>
                            @else
                                <ul>
                                    @foreach ($list_category as $key => $item)
                                        <li>
                                            <a href="{{ $item->getUrl() }}" aria-label="{{ $item->name }}">{{ $item->name }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
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
        @include('Default::web.layouts.blog',['posts'=>$related_posts, 'title'=>'Bài viết liên quan'])
        <div class="container">
            <section class="sub_categories">
                <div class="sub_categories__title">
                    <h2 class="">Khám phá nhiều chủ đề khác</h2>
                </div>
                <div class="sub_categories__list">
                    @if(isset($config_post['topic']['name']) && count($config_post['topic']['name']) > 0)
                        @foreach($config_post['topic']['name'] as $key => $name)
                            <div class="sub_item">
                                <a href="{{ $config_post['topic']['link'][$key] }}" aria-label="{{ $name ?? '' }}">
                                    {{ $name ?? '' }}
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512" width="10" height="10"><path d="M278.6 233.4c12.5 12.5 12.5 32.8 0 45.3l-160 160c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3L210.7 256 73.4 118.6c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0l160 160z"></path></svg>
                                </a>
                            </div>
                        @endforeach
                    @endif
                </div>
            </section>
        </div>
        <div class="container">
            <div class="comment-content w-100">
                @include('Comment::list', [
                    'type' => 'posts',
                    'type_id' => $post->id ?? 0,
                    'regulation_link' => '#',
                    'no_comment_text' => 'Hãy để lại bình luận của bạn tại đây!',
                    'title' => 'Bình luận',
                    'title_button' => 'Viết bình luận',
                    'vote' => true,
                    'rank' => $post->average_comment  ?? 0,
                    'total_comment' => $post->total_comment_by_id  ?? 1,
                    'list_comment_star' => $post->list_average_comment  ?? [],
                    'data' => $post  ?? 0,
                ])
            </div>
        </div>
    </main>
    @include('Default::web.layouts.popup_register')
@endsection
