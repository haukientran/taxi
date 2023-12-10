@if(isset($images) && count($images) > 0)
    <section id="activity">
        <div class="container">
            <h2 class="section-title activity-title">{{ $title ?? 'Hoạt động tại Lê ánh' }}</h2>
            @if($type == 'feedback')
                <a class="text-center fs-16 mb-20" href="{{ $study_abroad->feedback_image_link ?? 'javascrpit:;' }}">{{ $study_abroad->feedback_image_title ?? '' }}</a>
            @endif
            <div class="activity-list s-wrap" id="activity-list{{ $type }}">
                <div class="s-content">
                    @foreach($images as $image)
                        <div class="activity-item" data-thumnail="">
                            @include('Default::general.components.image', [
                                'src' => getImage($image, 'large'),
                                'width' => '570px',
                                'height' => '315px',
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
