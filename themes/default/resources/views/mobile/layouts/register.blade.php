 <section id="register" class="register">
    <div class="container register-container">
        <h2 class="section-title register-title">{{ $title ?? 'ĐĂNG KÝ TƯ VẤN MIỄN PHÍ' }}</h2>
        <div class="register-form">
            <div class="form-item">
                <input type="text" class="register-form-item form-control" name="name" placeholder="Họ và tên học viên *" aria-label="Họ và tên học viên" title="Họ và tên học viên">
                <p class="err_show null">Họ và Tên là bắt buộc!</p>
            </div>
            <div class="form-item">
                <select name="country" class="register-form-item form-control" title="Country" aria-label="Country">
                    <option value="">{{ isset($config_general['country_title']) ? $config_general['country_title'] : 'Quốc gia bạn muốn du học *' }}</option>
                    @if(isset($config_general['country']['name']) && count($config_general['country']['name']) > 0)
                        @foreach($config_general['country']['name'] as $key => $country)
                        <option value="{{ $country }}">{{ $country ?? '' }}</option>
                        @endforeach
                    @endif
                </select>
                <p class="err_show null">{{ isset($config_general['country_title']) ? $config_general['country_title'] : 'Tỉnh thành, phố' }} là bắt buộc!</p>
            </div>
            <div class="form-item">
                <input type="text" class="register-form-item form-control" name="phone" placeholder="Số điện thoại liên hệ *" aria-label="Số điện thoại liên hệ" title="Số điện thoại liên hệ">
                <p class="err_show null">Số điện thoại là bắt buộc!</p>
                <p class="err_show phone">Số điện thoại không đúng định dạng!</p>
            </div>
            <div class="form-item">
                <select name="educational" class="register-form-item form-control" title="educational" aria-label="Educational">
                    <option value="">{{ isset($config_general['educational_title']) ? $config_general['educational_title'] : 'Bậc học quan tâm *' }}</option>
                    @if(isset($config_general['educational']['name']) && count($config_general['educational']['name']) > 0)
                        @foreach($config_general['educational']['name'] as $key => $educational)
                        <option value="{{ $educational }}">{{ $educational ?? '' }}</option>
                        @endforeach
                    @endif
                </select>
                <p class="err_show null">{{ isset($config_general['educational_title']) ? $config_general['educational_title'] : 'Bậc học quan tâm ' }} là bắt buộc!</p>
            </div>
            <div class="form-item">
                <input type="text" class="register-form-item form-control" name="email" placeholder="Email liên hệ *" aria-label="Email liên hệ" title="Email liên hệ">
                <p class="err_show null">Email là bắt buộc!</p>
                <p class="err_show email">Email không đúng định dạng!</p>
            </div>
            <div class="form-item">
                <textarea name="note" class="register-form-item form-control" rows="1" placeholder="Ghi chú thêm về nhu cầu học..."></textarea>
            </div>
        </div>
        <div class="flex-center">
            <button type="button" class="btn btn-primary register-action fs-18" name="register-action" onclick="loadSendForm('register')" data-type="1" aria-label="Gửi" title="Gửi">Gửi</button>
        </div>
    </div>
</section>


{{-- <div class="form-contact">
    <form action="javascript:;" id="contact-form">
        @csrf
        <input type="hidden" name="type" value="0">
        <p class="fs-24 color_text f-w-b mb-12 text-center title">Liên hệ với chúng tôi</p>
        <div class="form-item">
            <label  class="color_text fs-16 f-w-b">Tên khách hàng <span class="text_emb">*</span></label> <br>
            <input type="text" class="form-control field" name="name" placeholder="Họ và Tên" data-validate="text" aria-label="Họ và Tên">
            <p class="err_show null">Họ và Tên là bắt buộc!</p>
        </div>
        <div class="form-item">
            <label class="color_text fs-16 f-w-b">Số điện thoại <span class="text_emb">*</span></label><br>
            <input type="text" class="form-control field" name="phone" placeholder="Số điện thoại" data-validate="text" aria-label="Số điện thoại">
            <p class="err_show null">Số điện thoại là bắt buộc!</p>
            <p class="err_show phone">Số điện thoại không đúng định dạng!</p>
        </div>
        <div class="form-item">
            <label class="color_text fs-16 f-w-b">Email <span class="text_emb">*</span></label><br>
            <input type="text" class="form-control field" name="email"  placeholder="a@gmail.com" data-validate="text" aria-label="email">
            <p class="err_show null">Email là bắt buộc!</p>
            <p class="err_show email">Email không đúng định dạng!</p>
        </div>
        <div class="form-item">
            <label class="color_text fs-16 f-w-b">Tỉnh thành<span class="text_emb">*</span></label><br>
            <div class="form-item__select">
                <select name="province_id">
                    @foreach($provinces as $key => $value)
                            <option value="{!! $key !!}">{!! $value !!}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-item">
            <label class="color_text fs-16 f-w-b">Nội dung<span class="text_emb">*</span></label><br>
            <textarea class="form-control" name="note" cols="30" rows="10" placeholder="Nội dung yêu cầu tư vấn"  aria-label="Nội dung yêu cầu tư vấn"></textarea>
            <p class="err_show null">Nội dung là bắt buộc!</p>
        </div>
        <div class="form-item form-action">
            <button type="submit" class="button button__primary text-up color-white"  onclick="loadSendForm('contact-form')">
                <svg width="27" height="20" viewBox="0 0 27 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M26.0899 0.966882C25.8917 0.766419 25.5981 0.692311 25.3291 0.777909L1.1306 8.44232C0.844502 8.53301 0.640571 8.78544 0.610316 9.08371C0.580872 9.38315 0.732395 9.66982 0.994252 9.81449L6.78296 13.0062L21.8794 4.10238L9.57151 14.5427L19.2731 19.8917C19.3454 19.9308 19.4237 19.9588 19.5044 19.9731C19.6384 19.9967 19.7778 19.9837 19.9074 19.9335C20.1147 19.8522 20.2756 19.6826 20.3461 19.4726L26.2668 1.73122C26.3558 1.4626 26.2879 1.16833 26.0899 0.966882Z" fill="#FEFEFE"/>
                </svg>
                Gửi yêu cầu ngay
            </button>
            <p class="color_text lh-20">* Quý khách có thể liên hệ trực tiếp tới  <br>
                Holtine: <a href="tell:{{ $config_general['hotline_support'] ?? '' }}" rel="nofollow"  aria-label="hotline" class="a_default"> {{ $config_general['hotline_support'] ?? ''}} </a> để được giải đáp thắc mắc nhanh nhất</p>
        </div>
    </form>
</div>
 --}}
