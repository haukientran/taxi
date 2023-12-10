@if(isset($differences->name) && count($differences->name) > 0)
<section id="should-choose">
    <div class="container">
        <h2 class="section-title should-choose-title">{{ isset($setting_home['should_choose_title']) ? $setting_home['should_choose_title'] : 'Vì sao nên chọn du học lê ánh' }}</h2>
        <div class="should-choose-list col-gird-4">
            @foreach($differences->name as $key =>$name)
                <div class="should-choose-item">
                    <div class="should-choose-item__thumbnail">
                        @include('Default::general.components.image', [
                            'src' => resizeWImage($differences->image[$key], 'w600'),
                            'width' => '570px',
                            'height' => '315px',
                            'lazy'   => true,
                            'title'  =>  ''
                        ])
                    </div>
                    <div class="should-choose-item__content">
                        <h3 class="should-choose-item__title"><span>{{ $name ?? '' }}</span></h3>
                        <div class="should-choose-item__desc four-lines-ellipsis">{!! $differences->description[$key] ?? '' !!}</div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endif
