@if(isset($setting_home['video_youtube_feedback']['image']) && count($setting_home['video_youtube_feedback']['image']) > 0)
<section id="feedback">
    <div class="container">
        <h2 class="section-title feedback-title">{{ $title ?? 'Chia sẻ từ học viên lê ánh' }}</h2>
        <div class="feedback-list s-wrap" id="feedback-list">
            <div class="s-content">
                @foreach ($setting_home['video_youtube_feedback']['image'] as $key => $image)
                    <div class="feedback-item item" data-thumnail="">
                        @include('Default::general.components.image', [
                            'src' => resizeWImage($image, 'w600'),
                            'width' => '570px',
                            'height' => '315px',
                            'lazy'   => true,
                            'title'  =>  getAlt($image ?? '')
                        ])
                        @if ($setting_home['video_youtube_feedback']['link'][$key] != null)
                            <a href="{{ $setting_home['video_youtube_feedback']['link'][$key] }}" data-fancybox="" aria-label="Video_{{ $key }}">
                                <div class="icon">
                                    @include('Default::general.components.image', [
                                        'src' =>  '/assets/images/img/icon_ytb.webp' ?? '',
                                        'width' => '50',
                                        'height' => '50',
                                        'lazy'   => true,
                                        'title'  => 'icon youtube'
                                    ])
                                </div>
                            </a>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
@endif
