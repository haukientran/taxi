@if(isset($images) && count($images) > 0)
    <section class="activity">
        <div class="container">
            <h2 class="section-title activity-title text-center">{{ $title ?? 'Hoạt động tại Lê ánh' }}</h2>
            <div class="activity-list s-wrap" id="activity-list-{{ $type }}">
                <div class="s-content">
                     @foreach($images as $key => $image)
                        <div class="activity-item"  data-thumnail="">
                            @include('Default::general.components.image', [
                                'src' => resizeWImage($image, 'w600'),
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
