@if(isset($study_abroads) && count($study_abroads) > 0)
    @foreach($study_abroads as $study_abroad)
        <div class="post-item">
            <div class="post-item__thumbnail">
                <a href="{{ $study_abroad->getUrl('mobile') ?? '' }}" aria-label="{!! $study_abroad->name ?? '' !!}">
                    @include('Default::general.components.image', [
                        'src' => resizeWImage($study_abroad->image, 'w400'),
                        'width' => '380px',
                        'height' => '150px',
                        'lazy'   => true,
                        'title'  =>  getAlt($study_abroad->image ?? '')
                    ])
                </a>
            </div>
            <div class="post-item__content">
                <a href="{{ $study_abroad->getUrl('mobile') ?? '' }}" aria-label="">
                    <h3 class="post-item__title"> {!! $study_abroad->name ?? '' !!}</h3>
                </a>
                <div class="post-item__desc four-lines-ellipsis">{{ cutString(removeHTML( $study_abroad->detail), 200) ?? ''}}</div>
                <a href="{{ $study_abroad->getUrl('mobile') ?? '' }}" class="btn btn-primary w-100 post-item__see" aria-label="Xem chi tiết khóa học" title="Xem chi tiết khóa học">XEM CHI TIẾT</a>
            </div>
        </div>
    @endforeach
@endif



