@if(isset($videos->image) && count($videos->image) > 0)
<section id="feedback">
    <h2 class="section-title feedback-title text-center">{{ $title ?? 'Chia sẻ từ học viên lê ánh' }}</h2>
    <div class="container feedback-list">
        <div class="s-wrap" id="feedback-list">
            <div class="s-content">
                @foreach ($videos->image as $key => $image)
                    <a href="{{ $videos->link[$key] }}"  data-fancybox="" data-thumnail="" aria-label="Video_{{ $key }}">
                        <div class="feedback-item" >
                            @include('Default::general.components.image', [
                                    'src' => resizeWImage($image, 'w600'),
                                    'width' => '570px',
                                    'height' => '315px',
                                    'lazy'   => true,
                                    'title'  =>  getAlt($image ?? '')
                            ])
                            @if ($videos->link[$key] != null)
                                <div class="icon">
                                    @include('Default::general.components.image', [
                                        'src' =>  '/assets/images/img/icon_ytb.webp' ?? '',
                                        'width' => '50',
                                        'height' => '50',
                                        'lazy'   => true,
                                        'title'  => 'icon youtube'
                                    ])
                                </div>
                            @endif
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </div>
</section>
@endif
