<div class="popup popup-register">
    <div class="popup-content">
        <div class="popup-content__header text-center">
            <h3 class="popup-title fs-20 lh-30 f-w-b">Đăng ký tư vấn miễn phí</h3>
        </div>
        <div class="popup-content__body">
            <form id="popup-register">
                @csrf
                <div class="register-form col-gird-6">
                    <div class="form-item">
                        <input type="text" class="register-form-item form-control" name="name" placeholder="Họ và tên học viên *" aria-label="Họ và tên học viên" title="Họ và tên học viên">
                        <p class="err_show null">Họ và Tên là bắt buộc!</p>
                    </div>
                    <div class="form-item">
                        <select name="country" class="register-form-item form-control">
                            <option value="">{{ isset($config_general['country_title']) ? $config_general['country_title'] : 'Quốc gia bạn muốn du học *' }}</option>
                            @if(isset($config_general['country']['name']) && count($config_general['country']['name']) > 0)
                                @foreach($config_general['country']['name'] as $key => $country)
                                <option value="{{ $country }}">{{ $country ?? '' }}</option>
                                @endforeach
                            @endif
                        </select>
                        <p class="err_show null">{{ isset($config_general['country_title']) ? $config_general['country_title'] : 'Quốc gia bạn muốn du học' }} là bắt buộc!</p>
                    </div>
                    <div class="form-item">
                        <input type="text" class="register-form-item form-control" name="phone" placeholder="Số điện thoại liên hệ *" aria-label="Số điện thoại liên hệ" title="Số điện thoại liên hệ">
                        <p class="err_show null">Số điện thoại là bắt buộc!</p>
                        <p class="err_show phone">Số điện thoại không đúng định dạng!</p>
                    </div>
                    <div class="form-item">
                        <select name="educational" class="register-form-item form-control">
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
                    <button type="button" class="btn btn-primary register-action fs-18" name="register-action" onclick="loadSendForm('popup-register')" data-type="1" aria-label="Gửi" title="Gửi">Gửi</button>
                </div>
            </form>
        </div>
        <div class="popup-content__close btn-close">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" width="20" height="20"><path d="M256 48a208 208 0 1 1 0 416 208 208 0 1 1 0-416zm0 464A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM175 175c-9.4 9.4-9.4 24.6 0 33.9l47 47-47 47c-9.4 9.4-9.4 24.6 0 33.9s24.6 9.4 33.9 0l47-47 47 47c9.4 9.4 24.6 9.4 33.9 0s9.4-24.6 0-33.9l-47-47 47-47c9.4-9.4 9.4-24.6 0-33.9s-24.6-9.4-33.9 0l-47 47-47-47c-9.4-9.4-24.6-9.4-33.9 0z" fill="rgba(249, 20, 30, 1)"/></svg>
        </div>
    </div>
</div>
