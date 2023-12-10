@if(isset($videos->image) && count($videos->image) > 0)
<section id="feedback">
    <h2 class="section-title feedback-title">{{ $title ?? 'Chia sẻ từ học viên lê ánh' }}</h2>
    <div class="feedback-list">
        <div class="container feedback-list-container col-gird-6">
            @foreach ($videos->image as $key => $image)
                <a href="{{ $videos->link[$key] }}"  data-fancybox="" aria-label="Video_{{ $key }}">
                    <div class="feedback-item">
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
</section>
@endif
