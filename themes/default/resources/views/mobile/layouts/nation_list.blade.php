@foreach($arboards as $arboard)
    <div class="nation-item">
        <div class="nation-item__thumbnail">
            <a href="{{ $arboard->getUrl('mobile') ?? '' }}" aria-label="{{ $arboard->name ?? '' }}">
            @include('Default::general.components.image', [
                    'src' => resizeWImage($arboard->banner_image ?? '', 'w380'),
                    'width' => '380px',
                    'height' => '150px',
                    'lazy'   => true,
                    'title'  =>  getAlt($arboard->banner_image ?? '')
                ])
            </a>
        </div>
        <div class="nation-item__content">
            <a href="{{ $arboard->getUrl('mobile') ?? '' }}" aria-label="{{ $arboard->name ?? '' }}">
                <h3 class="nation-item__title">{{ $arboard->name ?? '' }}</h3>
            </a>
            <div class="nation-item__desc four-lines-ellipsis">{{ cutString(removeHTML($arboard->detail), 150) ?? '' }}</div>
            <a href="{{ $arboard->getUrl('mobile') ?? '' }}" class="btn btn-primary w-100 nation-item__see color_white" aria-label="Xem chi tiết" title="Xem chi tiết">Xem chi tiết</a>
        </div>
    </div>
@endforeach
