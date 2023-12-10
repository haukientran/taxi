@if(isset($setting_home['activity']['image']) && count($setting_home['activity']['image']) > 0)
<section id="activity">
    <div class="container">
        <h2 class="section-title activity-title">{{ $title ?? 'Hoạt động tại Lê ánh' }}</h2>
        <div class="activity-list s-wrap" id="activity-list">
            <div class="s-content">
                @foreach ($setting_home['activity']['image'] as $key => $image)
                <div class="activity-item item" data-thumnail="">
                    @include('Default::general.components.image', [
                        'src' => resizeWImage($image, 'w400'),
                        'width' => '390px',
                        'height' => '270px',
                        'lazy'   => true,
                        'title'  =>  getAlt($image ?? '')
                    ])
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
@endif
