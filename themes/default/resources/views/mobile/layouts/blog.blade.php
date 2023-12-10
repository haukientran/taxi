@if(isset($posts) && count($posts) > 0)
<section id="blog">
    <div class="container">
        <h2 class="section-title blog-title w-100 text-center">{{ $title ?? 'Tin tức sự kiện' }}</h2>
        <div class="blog-list w-100">
            @include('Default::mobile.layouts.blog_item')
        </div>
    </div>
</section>
@endif
