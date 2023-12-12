    @if(isset($setting_home['service_grid3']['title']) && count($setting_home['service_grid3']['title']) > 0)
    <section id="contidion" class="service_grid3">
        <h2 class="section-title contidion-title">{{ isset($setting_home['service_grid3_title']) ? $setting_home['service_grid3_title'] : 'Điều kiện tham gia chương trình' }}</h2>
        <div class="contidion-list s-wrap" id="service_grid3-list">
            <div class="s-content">
                @foreach($setting_home['service_grid3']['title'] as $k => $service_grid3)
                <div class="contidion-item item" data-thumnail="">
                    <div class="contidion-item__thumbnail">
                        @include('Default::general.components.image', [
                            'src' => resizeWImage(isset($setting_home['service_grid3']['image'][$k]) ? $setting_home['service_grid3']['image'][$k] : '' , 'w300'),
                            'width' => '300',
                            'height' => '300',
                            "lazy"   => true,
                            'title'  =>  'khoa-hoc-ke-toan-tong-hop-1'
                        ])
                    </div>
                    <div class="contidion-item__content f-w-b fs-16">{{ $service_grid3 ?? '' }}</div>
                    <div class="contidion-item__description mt-10">{{ $setting_home['service_grid3']['description'][$k] ?? '' }}</div>
                </div>
                @endforeach
            </div>
        </div>
    </section>


    @endif
