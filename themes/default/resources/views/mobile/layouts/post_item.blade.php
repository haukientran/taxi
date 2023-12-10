@if(isset($posts) && count($posts) > 0)
	@foreach($posts as $post)
        <div class="post-item">
            <div class="post-item__thumbnail">
                <a href="{{ $post->getUrl('mobile') }}" aria-label="{!! $post->name ?? '' !!}">
					@include('Default::general.components.image', [
						'src' => resizeWImage($post->image, 'w400'),
			            'width' => '380px',
			            'height' => '150px',
			            'lazy'   => true,
                        'title'  =>  getAlt($post->image ?? '')
			        ])
				</a>
            </div>
            <div class="post-item__content">
                <a href="{{ $post->getUrl('mobile') }}" aria-label="">
                    <h3 class="post-item__title"> {!! $post->name ?? '' !!}</h3>
				</a>
                <div class="post-item__desc four-lines-ellipsis">{{ cutString(removeHTML($post->detail), 200) ?? ''}}</div>
                {{-- <a href="{{ $post->getUrl('mobile') }}" class="btn btn-primary w-100 post-item__see" aria-label="Xem chi tiết khóa học" title="Xem chi tiết khóa học">XEM CHI TIẾT</a> --}}
            </div>
        </div>
    @endforeach
@endif

