@extends('Default::web.layouts.app')
@section('head')
    <style type="text/css">
        @php
            /*echo file_get_contents(asset("./assets/build/css/post.min.css?v=".config('SudoAsset.vesion')));*/
        @endphp
    </style>
    <link rel="stylesheet" type="text/css" href="{{ asset('./assets/build/css/post.min.css?v='.config('SudoAsset.vesion')) }}">
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
                        @if(isset($post->list_category) && count($post->list_category) > 0)
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
                        @endif
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
    </main>
    @include('Default::web.layouts.popup_register')
@endsection
