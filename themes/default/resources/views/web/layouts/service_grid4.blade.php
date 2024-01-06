    @if(isset($setting_home['service_grid4']['title']) && count($setting_home['service_grid4']['title']) > 0)
    <section id="contidion" class="service_grid4">
        <div class="container">
            <h2 class="section-title contidion-title">{{ isset($setting_home['service_grid4_title']) ? $setting_home['service_grid4_title'] : 'Dịch vụ của chúng tôi' }}</h2>
            <div class="contidion-list w-100">
                @foreach($setting_home['service_grid4']['title'] as $k => $service_grid4)
                <div class="contidion-item">
                    <div class="contidion-item__thumbnail">
                        @include('Default::general.components.image', [
                            'src' => resizeWImage(isset($setting_home['service_grid4']['image'][$k]) ? $setting_home['service_grid4']['image'][$k] : '' , 'w300'),
                            'width' => '300',
                            'height' => '300',
                            "lazy"   => true,
                            'title'  =>  'khoa-hoc-ke-toan-tong-hop-1'
                        ])
                    </div>
                    <div class="contidion-item__content f-w-b fs-16">{{ $service_grid4 ?? '' }}</div>
                    <div class="contidion-item__description mt-10">{{ $setting_home['service_grid4']['description'][$k] ?? '' }}</div>
                    @if(isset($setting_home['service_grid4']['link'][$k]))
                    <a href="{{ $setting_home['service_grid4']['link'][$k] ?? '' }}" class="btn btn-primary w-100 post-item__see contidion-item__see" aria-label="Gọi ngay" title="Gọi ngay">Gọi ngay</a>
                    @endif
                </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif