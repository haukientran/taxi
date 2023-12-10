@if(isset($slides) && count($slides) > 0)
<div class="banner" id="banner">
    <div class="slide">
        <div class="slide-list s-wrap" id="slideList">
            <div class="s-content">
                @foreach($slides as $key => $slide)
                    <div class="item" data-thumnail="">
                        @include('Default::general.components.image', [
                            'src' => resizeWImage($slide->image ?? '/assets/images/banner_home.png', ''),
                            'width' => '1900px',
                            'height' => '700px',
                            "lazy"   => $key != 0 ? true : '',
                            'title'  =>  getAlt($slide->image ?? '')
                        ])
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endif
