@extends('Default::mobile.layouts.app')
@section('head')
	<style type="text/css">
		@php
			echo file_get_contents(asset("./assets/build/css/page_mb.min.css?v=".config('SudoAsset.vesion')));
		@endphp
	</style>
@endsection
@section('content')
<main class="contact">
    <div class="container">
        <h1 class="color_title text-center">Liên hệ</h1>
        <div class="contact-content__map">
            {!! $config_contact['link_map'] ?? '' !!}
        </div>
        <div class="contact-content">
            <div class="contact-content__form">
                @if(isset($text_success) && $text_success == true)
                    <h4 class="fs-18 f-w-b lh-20 mb-20">Gửi yêu cầu liên hệ thành công. Xin cảm ơn!</h4>
                @else
                    <form class="pl-lg-2" action="javascript:;" method="post" id="contact">
                        @csrf
                        <input type="hidden" name="type" value="0">
                        <div class="form-box">
                            <div class="form-item">
                                <label for="name" class="fs-16">Họ và tên <span class="text_emb">*</span></label> <br>
                                <input type="text" class="form-control field" name="name" id="name" placeholder="Họ và Tên" data-validate="text" aria-label="Họ và Tên">
                                <p class="err_show null">Họ và Tên là bắt buộc!</p>
                            </div>
                            <div class="form-item">
                                <label for="email" class="fs-16">Email <span class="text_emb">*</span></label><br>
                                <input type="text" class="form-control field" name="email" id="email" placeholder="A@gmail.com" data-validate="text" aria-label="email">
                                <p class="err_show null">Email là bắt buộc!</p>
                                <p class="err_show email">Email không đúng định dạng!</p>
                            </div>
                            <div class="form-item">
                                <label for="phone" class="fs-16">Nhập số điện thoại <span class="text_emb">*</span></label><br>
                                <input type="text" class="form-control field" name="phone" id="phone" placeholder="Số điện thoại" data-validate="text" aria-label="Số điện thoại">
                                <p class="err_show null">Số điện thoại là bắt buộc!</p>
                                <p class="err_show phone">Số điện thoại không đúng định dạng!</p>
                            </div>
                            <div class="form-item">
                                <label for="address" class="fs-16">Địa chỉ liên hệ</label>
                                <input type="text" class="field" name="address" id="address" placeholder="Địa chỉ liên hệ" data-validate="text" aria-label="Địa chỉ liên hệ">
                            </div>
                            <div class="form-item w-100 form-item__note">
                                <label for="note" class="fs-16">Nội dung<span class="text_emb">*</span></label><br>
                                <textarea class="form-control" name="note" id="note" cols="30" rows="10" placeholder="Nội dung yêu cầu tư vấn"  aria-label="Nội dung yêu cầu tư vấn"></textarea>
                                <p class="err_show null">Nội dung là bắt buộc!</p>
                            </div>
                            <div class="form-item form-item__action">
                                <button class="button button__primary text-up color_white" onclick="loadSend('contact')">
                                    Gửi liên hệ
                                </button>
                            </div>
                        </div>
                    </form>
                @endif
            </div>
            <div class="contact-content__info">
                <div class="info_social">
                    <h2 class="info_social__title">Kêt nối với chúng tôi</h2>
                    <ul class="info_social__list flex">
                        <li class="social_item facebook flex">
                            <a href="{{ $config_general['facebook'] ?? '/' }}" aria-label="facebook" rel="nofollow" class="flex" target="_blank">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512" width="42" height="42"><path d="M279.14 288l14.22-92.66h-88.91v-60.13c0-25.35 12.42-50.06 52.24-50.06h40.42V6.26S260.43 0 225.36 0c-73.22 0-121.08 44.38-121.08 124.72v70.62H22.89V288h81.39v224h100.17V288z" fill="#1f82ec"/></svg>
                                <div class="text">
                                    <p>Facebook</p>
                                    <span>Yêu thích</span>
                                </div>
                            </a>
                        </li>
                        <li class="social_item twitter flex">
                            <a href="{{ $config_general['twitter'] ?? '/' }}" aria-label="twitter" rel="nofollow" class="flex" target="_blank">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" width="42" height="42" ><path d="M459.37 151.716c.325 4.548.325 9.097.325 13.645 0 138.72-105.583 298.558-298.558 298.558-59.452 0-114.68-17.219-161.137-47.106 8.447.974 16.568 1.299 25.34 1.299 49.055 0 94.213-16.568 130.274-44.832-46.132-.975-84.792-31.188-98.112-72.772 6.498.974 12.995 1.624 19.818 1.624 9.421 0 18.843-1.3 27.614-3.573-48.081-9.747-84.143-51.98-84.143-102.985v-1.299c13.969 7.797 30.214 12.67 47.431 13.319-28.264-18.843-46.781-51.005-46.781-87.391 0-19.492 5.197-37.36 14.294-52.954 51.655 63.675 129.3 105.258 216.365 109.807-1.624-7.797-2.599-15.918-2.599-24.04 0-57.828 46.782-104.934 104.934-104.934 30.213 0 57.502 12.67 76.67 33.137 23.715-4.548 46.456-13.32 66.599-25.34-7.798 24.366-24.366 44.833-46.132 57.827 21.117-2.273 41.584-8.122 60.426-16.243-14.292 20.791-32.161 39.308-52.628 54.253z" fill="#13b9ee"/></svg>
                                <div class="text">
                                    <p>Twitter</p>
                                    <span>Theo dõi</span>
                                </div>
                            </a>
                        </li>
                        <li class="social_item pinterest flex">
                             <a href="{{ $config_general['pinterest'] ?? '/' }}" aria-label="pinterest" rel="nofollow" class="flex" target="_blank">
                               <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512" width="42" height="42"><path d="M204 6.5C101.4 6.5 0 74.9 0 185.6 0 256 39.6 296 63.6 296c9.9 0 15.6-27.6 15.6-35.4 0-9.3-23.7-29.1-23.7-67.8 0-80.4 61.2-137.4 140.4-137.4 68.1 0 118.5 38.7 118.5 109.8 0 53.1-21.3 152.7-90.3 152.7-24.9 0-46.2-18-46.2-43.8 0-37.8 26.4-74.4 26.4-113.4 0-66.2-93.9-54.2-93.9 25.8 0 16.8 2.1 35.4 9.6 50.7-13.8 59.4-42 147.9-42 209.1 0 18.9 2.7 37.5 4.5 56.4 3.4 3.8 1.7 3.4 6.9 1.5 50.4-69 48.6-82.5 71.4-172.8 12.3 23.4 44.1 36 69.3 36 106.2 0 153.9-103.5 153.9-196.8C384 71.3 298.2 6.5 204 6.5z" fill="#f60c19"/></svg>
                                <div class="text">
                                    <p>Pinterest</p>
                                    <span>Pin</span>
                                </div>
                            </a>
                        </li>
                        <li class="social_item instagram flex">
                             <a href="{{ $config_general['instagram'] ?? '/' }}" aria-label="instagram" rel="nofollow" class="flex" target="_blank">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" width="42" height="42"><path d="M224.1 141c-63.6 0-114.9 51.3-114.9 114.9s51.3 114.9 114.9 114.9S339 319.5 339 255.9 287.7 141 224.1 141zm0 189.6c-41.1 0-74.7-33.5-74.7-74.7s33.5-74.7 74.7-74.7 74.7 33.5 74.7 74.7-33.6 74.7-74.7 74.7zm146.4-194.3c0 14.9-12 26.8-26.8 26.8-14.9 0-26.8-12-26.8-26.8s12-26.8 26.8-26.8 26.8 12 26.8 26.8zm76.1 27.2c-1.7-35.9-9.9-67.7-36.2-93.9-26.2-26.2-58-34.4-93.9-36.2-37-2.1-147.9-2.1-184.9 0-35.8 1.7-67.6 9.9-93.9 36.1s-34.4 58-36.2 93.9c-2.1 37-2.1 147.9 0 184.9 1.7 35.9 9.9 67.7 36.2 93.9s58 34.4 93.9 36.2c37 2.1 147.9 2.1 184.9 0 35.9-1.7 67.7-9.9 93.9-36.2 26.2-26.2 34.4-58 36.2-93.9 2.1-37 2.1-147.8 0-184.8zM398.8 388c-7.8 19.6-22.9 34.7-42.6 42.6-29.5 11.7-99.5 9-132.1 9s-102.7 2.6-132.1-9c-19.6-7.8-34.7-22.9-42.6-42.6-11.7-29.5-9-99.5-9-132.1s-2.6-102.7 9-132.1c7.8-19.6 22.9-34.7 42.6-42.6 29.5-11.7 99.5-9 132.1-9s102.7-2.6 132.1 9c19.6 7.8 34.7 22.9 42.6 42.6 11.7 29.5 9 99.5 9 132.1s2.7 102.7-9 132.1z" fill="#8823b6"/></svg>
                                <div class="text">
                                    <p>Instagram</p>
                                    <span>Theo dõi</span>
                                </div>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="info_address info_item">
                    <span class="fw-600">Địa chỉ</span>
                    <p>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512" width="16" height="16"><path d="M215.7 499.2C267 435 384 279.4 384 192C384 86 298 0 192 0S0 86 0 192c0 87.4 117 243 168.3 307.2c12.3 15.3 35.1 15.3 47.4 0zM192 128a64 64 0 1 1 0 128 64 64 0 1 1 0-128z"/></svg>
                        {{ $config_contact['address'] ?? '' }}
                    </p>
                </div>
                <div class="info_phone info_item">
                    <span class="fw-600">Điện thoại</span>
                    <p class="phone_item">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512" width="16" height="16"><path d="M16 64C16 28.7 44.7 0 80 0H304c35.3 0 64 28.7 64 64V448c0 35.3-28.7 64-64 64H80c-35.3 0-64-28.7-64-64V64zM224 448a32 32 0 1 0 -64 0 32 32 0 1 0 64 0zM304 64H80V384H304V64z"/></svg>
                        Phone: {{ $config_contact['phone'] ?? '' }}
                    </p>
                    @if(isset($config_contact['tel']) && $config_contact['tel'] != '' )
                     <p class="phone_item">
                       <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" width="16" height="16"><path d="M164.9 24.6c-7.7-18.6-28-28.5-47.4-23.2l-88 24C12.1 30.2 0 46 0 64C0 311.4 200.6 512 448 512c18 0 33.8-12.1 38.6-29.5l24-88c5.3-19.4-4.6-39.7-23.2-47.4l-96-40c-16.3-6.8-35.2-2.1-46.3 11.6L304.7 368C234.3 334.7 177.3 277.7 144 207.3L193.3 167c13.7-11.2 18.4-30 11.6-46.3l-40-96z"/></svg>
                        Tel: {{ $config_contact['tel'] ?? '' }}
                    </p>
                    @endif
                     <p class="phone_item">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" width="16" height="16"><path d="M64 112c-8.8 0-16 7.2-16 16v22.1L220.5 291.7c20.7 17 50.4 17 71.1 0L464 150.1V128c0-8.8-7.2-16-16-16H64zM48 212.2V384c0 8.8 7.2 16 16 16H448c8.8 0 16-7.2 16-16V212.2L322 328.8c-38.4 31.5-93.7 31.5-132 0L48 212.2zM0 128C0 92.7 28.7 64 64 64H448c35.3 0 64 28.7 64 64V384c0 35.3-28.7 64-64 64H64c-35.3 0-64-28.7-64-64V128z"/></svg>
                        Email: {{ $config_contact['email'] ?? '' }}
                    </p>

                </div>
            </div>
        </div>
    </div>
</main>
@endsection
@section('foot')
    <script defer src="{{ '/assets/build/js/page.min.js?v='.config('SudoAsset.vesion') }}"></script>
@endsection

