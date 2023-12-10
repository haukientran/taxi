@extends('Default::web.layouts.app')
@section('head')
	<meta name="robots" content="noindex,follow"/>
	<link rel="stylesheet" href="/assets/build/css/page.min.css">
@endsection
@section('content')
	<main class="error">
        <div class="container">
        	<div class="error-404 w-100 text-center">
				<div class="error-404__box">
					<h1 class="fs-36 f-w-b"> {{ $config_general['404_title'] ?? 'Tại sao tôi lại ở đây ?' }} </h1>
					<p>
						{!! $config_general['404_des'] ?? 'Chúng tôi rất Xin lỗi vì sự cố này bạn hãy vui lòng quay lại trang chủ để <br>tiếp tục trình duyệt của mình. Xin cảm ơn'  !!}
					</p>
					<a href="{{ route('app.home') }}" aria-label="Trang chủ" class="button button__primary color_white text-up fs-16 f-w-b">{{ __('Về trang chủ') }} </a>
				</div>
    			<img src="{{ $config_general['404_image'] ?? '/assets/images/image-404.png' }}" alt="Image 404">
        	</div>
        </div>
    </main>
@endsection
