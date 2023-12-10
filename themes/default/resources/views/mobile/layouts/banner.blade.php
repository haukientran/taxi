@if(isset($slides) && count($slides) > 0)
<div class="banner" id="banner">
    <div class="slide">
        <div class="slide-list s-wrap" id="slideList">
            <div class="s-content">
                @foreach($slides as $key => $slide)
                    <div class="item" data-thumnail="">
                        @include('Default::general.components.image', [
                            'src' => getImage($slide->image ?? '/assets/images/banner_home.png', 'large'),
                            'width' => '416px',
                            'height' => '600px',
                            "lazy"   => $key != 0 ? true : '',
                            'title'  =>  'banner'
                        ])
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endif
