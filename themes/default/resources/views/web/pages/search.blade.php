@extends('Default::web.layouts.app')
@section('head')
	<style type="text/css">
		@php
			echo file_get_contents(asset("./assets/build/css/page.min.css?v=".config('SudoAsset.vesion')));
		@endphp
	</style>
@endsection
@section('content')

<main class="pages">
	<div class="container">
		<div class="page w-100 mb-30 mt-30">
            <div class="page-left__title w-100">
            	<h1 class="fs-20 lh-20 mb-8">Kết quả tìm kiếm cho "<span class="a_default"> {{ $keyword_search ?? '' }}</span>"</h1>
				<p class="fs-14"> Đã tìm thấy <span class="text_emb">{{ $count ?? 0 }}</span> kết quả</p>
            </div>
            <div class="page-left__detail">
                @if( isset($study_abroads) && count($study_abroads) > 0)
					<div class="post-list col-gird-3 mt-30" id="listdata">
						@include('Default::web.layouts.item_search', ['study_abroads' => $study_abroads])
					</div>
					@if(count($study_abroads) >= 12)
						<div class="paginate mt-20 text-center">
							{!! $study_abroads->appends(Request()->all())->links('pagination::bootstrap-4') !!}
						</div>
					@endif
				@else
					<div class="search-product__default w-100">
						<p class="fs-16" style="font-style: italic; color: red;">Không tìm thấy bài viết phù hợp với từ khóa !</p>
						<a href="{{ route('app.home') }}" class="fw-600" style="color: rgba(1, 119, 237, 1);text-decoration: underline;margin-top: 10px;display: block;text-transform: uppercase;"> Về trang chủ</a>
					</div>
				@endif
            </div>
		</div>
	</div>
</main>

@endsection
