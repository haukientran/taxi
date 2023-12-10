<section id="register_study_abroad" class="register mt-30">
    <div class="container register-container">
        <h2 class="section-title">{{ 'Đăng ký tư vấn miễn phí' }}</h2>
        <div class="register-form">
            <div class="form-item">
                <input type="text" class="register-form-item form-control" name="name" placeholder="Họ và tên học viên *" aria-label="Họ và tên học viên" title="Họ và tên học viên">
                <p class="err_show null">Họ và Tên là bắt buộc!</p>
            </div>
            <div class="form-item">
                <select name="province" class="register-form-item form-control" aria-label="{{ isset($study_abroad_category['province_title']) ? $study_abroad_category['province_title'] : 'Tỉnh thành, phố' }}">
                    <option value="">{{ isset($study_abroad_category['province_title']) ? $study_abroad_category['province_title'] : 'Tỉnh thành, phố *' }}</option>
                    @if(isset($config_study_abroad['province']['name']) && count($config_study_abroad['province']['name']) > 0)
                        @foreach($config_study_abroad['province']['name'] as $key => $province)
                        <option value="{{ $province }}">{{ $province ?? '' }}</option>
                        @endforeach
                    @endif
                </select>
                <p class="err_show null">{{ isset($study_abroad_category['province_title']) ? $study_abroad_category['province_title'] : 'Tỉnh thành, phố' }} là bắt buộc!</p>
            </div>
            <div class="form-item">
                <input type="text" class="register-form-item form-control" name="phone" placeholder="Số điện thoại liên hệ *" aria-label="Số điện thoại liên hệ" title="Số điện thoại liên hệ">
                <p class="err_show null">Số điện thoại là bắt buộc!</p>
                <p class="err_show phone">Số điện thoại không đúng định dạng!</p>
            </div>
            <div class="form-item">
                <select name="course" class="register-form-item form-control" aria-label="{{ isset($study_abroad_category['course_title']) ? $study_abroad_category['course_title'] : 'Khóa học *'}}">
                    <option value="">{{ isset($study_abroad_category['course_title']) ? $study_abroad_category['course_title'] : 'Khóa học *' }}</option>
                    @if(isset($config_study_abroad['course']['name']) && count($config_study_abroad['course']['name']) > 0)
                        @foreach($config_study_abroad['course']['name'] as $key => $course)
                        <option value="{{ $course }}">{{ $course ?? '' }}</option>
                        @endforeach
                    @endif
                </select>
                <p class="err_show null">{{ isset($study_abroad_category['course_title']) ? $study_abroad_category['course_title'] : 'Khóa học' }} là bắt buộc!</p>
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
            <button type="button" class="btn btn-primary register-action fs-18" name="register-action" onclick="loadSendForm('register_study_abroad')" data-type="2" aria-label="Gửi" title="Gửi">Gửi</button>
        </div>
    </div>
</section>
