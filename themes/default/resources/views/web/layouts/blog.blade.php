@if(isset($posts) && count($posts) > 0)
<section id="blog">
    <h2 class="section-title blog-title w-100 text-center">{{ $title ?? 'Tin tức sự kiện' }}</h2>
    <div class="blog-box">
        <div class="container">
            <div class="blog-list col-gird-6 w-100">
                @include('Default::web.layouts.blog_item')
            </div>
        </div>
    </div>
</section>
@endif
