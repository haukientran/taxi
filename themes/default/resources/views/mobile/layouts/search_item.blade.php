@foreach($datas as $data)
<div class="item">
    <a href="{{ $data['url'] ?? '' }}" aria-label="{!! $data['name'] ?? '' !!}">
        <div class="thumbnail">
            @include('Default::general.components.image', [
                'src' => resizeWImage($data['image'], 'w150'),
                'width' => '70px',
                'height' => '70px',
                'lazy'   => true,
                'title'  =>  ''
            ])
            <h3>{{ $data['name'] ?? '' }}</h3>
        </div>
        <div class="detail">
            {{ cutString(removeHTML($data['detail']), 150) ?? '' }}
        </div>
    </a>
</div>
@endforeach
