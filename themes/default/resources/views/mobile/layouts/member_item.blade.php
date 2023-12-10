<div class="member-item" data-thumnail="">
   <div class="member-item__top">
    <a href="{{ $personnel->getUrl('mobile') ?? '' }}" area-label="Xem chi tiết">
        <div class="item-thumb">
            @include('Default::general.components.image', [
           	'src' => resizeWImage($personnel->image, 'w250'),
            'width' => '232px',
            'height' => '82px',
            'lazy'   => true,
            'title'  =>  getAlt($personnel->image ?? '')
            ])
            <span class="address">{{ $personnel->address ?? '' }}</span>
        </div>
    </a>
   </div>
    <div class="member-item__info">
        <h3 class="name text-up f-w-b mb-15 fs-14 text-center">
            {{ $personnel->name ?? '' }}
        </h3>
        <div class="detail mb-8">
            {!! cutString(removeHTML($personnel->description ), 200) ?? '' !!}
        </div>
        <a class="text-center" href="{{ $personnel->getUrl('mobile') ?? '' }}" area-label="Xem chi tiết">
            Xem chi tiết
        </a>
    </div>
</div>
