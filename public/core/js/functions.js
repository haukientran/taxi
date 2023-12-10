// load ajax
/*
    loadAjaxPost(url, params, {
        beforeSend: function(){},
        success:function(result){},
        error: function (error) {}
    }, 'progress');
*/
function loadAjaxPost(url, params, option, type='progress'){
    var _option = {
        beforeSend:function(){},
        success:function(){},
        error:function(){}
    }
    $.extend(_option,option);
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: 'POST',
        url: url,
        data: params,
        beforeSend: function(){
            switch (type) {
            	case 'progress': activeProgress(0); break;
            	case 'loading': loadingBox('open'); break;
            }
            _option.beforeSend();
        },
        success:function(result){
            switch (type) {
            	case 'progress': activeProgress(99, 'close'); break;
            	case 'loading': loadingBox('close'); break;
            }
            _option.success(result);
        },
        error: function (error) {
            /* Có lỗi sẽ ân Module Loading và thông báo */
            switch (type) {
            	case 'progress': activeProgress(99, 'close'); break;
            	case 'loading': loadingBox('close'); break;
            }
            alertText('Có lỗi xảy ra. Vui lòng thử lại!', 'error')
            _option.error(error);
        }
    })
}
/*
    loadAjaxGet(url, {
        beforeSend: function(){},
        success:function(result){},
        error: function (error) {}
    }, 'progress');
*/
function loadAjaxGet(url, option, type='progress'){
    var _option = {
        beforeSend:function(){},
        success:function(){},
        error:function(){}
    }
    $.extend(_option,option);
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: 'GET',
        url: url,
        beforeSend: function(){
            switch (type) {
                case 'progress': activeProgress(0); break;
                case 'loading': loadingBox('open'); break;
            }
            _option.beforeSend();
        },
        success:function(result){
            switch (type) {
                case 'progress': activeProgress(99, 'close'); break;
                case 'loading': loadingBox('close'); break;
            }
            _option.success(result);
        },
        error: function (error) {
            /* Có lỗi sẽ ân Module Loading và thông báo */
            switch (type) {
                case 'progress': activeProgress(99, 'close'); break;
                case 'loading': loadingBox('close'); break;
            }
            alertText('Có lỗi xảy ra. Vui lòng thử lại!', 'error')
            _option.error(error);
        }
    })
}
// LoadingBox
function loadingBox(type='open') {
	if (type == 'open') {
		$("#loading_box").css({visibility:"visible", opacity: 0.0}).animate({opacity: 1.0},200);
	} else {
		$("#loading_box").animate({opacity: 0.0}, 200, function(){
            $("#loading_box").css("visibility","hidden");
        });
	}
}
// LoadProgessBar
var progress = null;
function activeProgress(number=0, type='open') {
	clearInterval(progress);
	$('.progress-box').css('display', 'block');
	$('.progress-run').css('width', number+'%');
	progress = setInterval(function() {
		if (number <= 100) {
			$('.progress-run').css('width', number+'%');
			number = number + 1;
		} else {
			clearInterval(progress);
		}
	}, 100);
	if (type == 'close') {
		setTimeout(function() {
			$('.progress-run').css('width', '0%');
			$('.progress-box').css('display', 'none');
		}, 1000);
	}
}
function alertText(text='', type='success') {
	switch (type) {
		case 'success': 
			toastr.success(text);
		break;
		case 'info': 
			toastr.info(text);
		break;
		case 'error': 
			toastr.error(text);
		break;
		case 'warning': 
			toastr.warning(text);
		break;
	}
}
// lưu html 1 thẻ vào clipboard và copy
window.Clipboard = (function(window, document, navigator) {
    var textArea,
        copy;
    function isOS() {
        return navigator.userAgent.match(/ipad|iphone/i);
    }
    function createTextArea(text) {
        textArea = document.createElement('textArea');
        textArea.value = text;
        document.body.appendChild(textArea);
    }
    function selectText() {
        var range,
            selection;
        if (isOS()) {
            range = document.createRange();
            range.selectNodeContents(textArea);
            selection = window.getSelection();
            selection.removeAllRanges();
            selection.addRange(range);
            textArea.setSelectionRange(0, 999999);
        } else {
            textArea.select();
        }
    }
    function copyToClipboard() {        
        document.execCommand('copy');
        document.body.removeChild(textArea);
    }
    copy = function(text) {
        createTextArea(text);
        selectText();
        copyToClipboard();
    };
    return {
        copy: copy
    };
})(window, document, navigator);

function copyText(text) {
    if(document.execCommand('copy')) {
        var $input = $("<input />");
        $input.val(text);
        $("body").append($input);
        $input.select();
        document.execCommand("copy");
        $input.remove();
    } else {
        Clipboard.copy(text);
    }
}
// Chuyển chuỗi sang dạng slug
function convertToSlug(str) {
    //Đổi chữ hoa thành chữ thường
    slug = str.toLowerCase();
    //Đổi ký tự có dấu thành không dấu
    slug = slug.replace(/á|à|ả|ạ|ã|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ/gi, 'a');
    slug = slug.replace(/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ/gi, 'e');
    slug = slug.replace(/i|í|ì|ỉ|ĩ|ị/gi, 'i');
    slug = slug.replace(/ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ/gi, 'o');
    slug = slug.replace(/ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự/gi, 'u');
    slug = slug.replace(/ý|ỳ|ỷ|ỹ|ỵ/gi, 'y');
    slug = slug.replace(/đ/gi, 'd');
    //Xóa các ký tự đặt biệt
    slug = slug.replace(/\`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|\'|\"|\:|\;|_/gi, '');
    //Đổi khoảng trắng thành ký tự gạch ngang
    slug = slug.replace(/ /gi, "-");
    //Đổi nhiều ký tự gạch ngang liên tiếp thành 1 ký tự gạch ngang
    //Phòng trường hợp người nhập vào quá nhiều ký tự trắng
    slug = slug.replace(/\-\-\-\-\-/gi, '-');
    slug = slug.replace(/\-\-\-\-/gi, '-');
    slug = slug.replace(/\-\-\-/gi, '-');
    slug = slug.replace(/\-\-/gi, '-');
    //Xóa các ký tự gạch ngang ở đầu và cuối
    slug = '@' + slug + '@';
    slug = slug.replace(/\@\-|\-\@|\@/gi, '');
    //In slug ra textbox có id “slug”
    return slug
}
// check định dạng email
function validateEmail(email) {
	var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
	return re.test(String(email).toLowerCase());
}
// check định dạng điện thoại
function validatePhone(phone) {
	var flag = false;
	phone = phone.trim();
    phone = phone.replace('(+84)', '0');
    phone = phone.replace('+84', '0');
    phone = phone.replace('0084', '0');
    phone = phone.replace(/ /g, '');
    if (phone != '') {
        if (phone.length >= 9 && phone.length <=11) {
        	flag = true;
        } else {
        	flag = false;
        }
    }
    return flag;
}
// Thêm/Sửa localstorage
function setLocalStorage(key,value) {
    localStorage.setItem(key,value);
}
function getLocalStorage(key) {
    return localStorage.getItem(key);
}
// thêm cookie
function setCookie(key, value, day) {
    var expires = new Date();
    expires.setTime(expires.getTime() + (day * 24 * 60 * 60 * 1000));
    document.cookie = key + '=' + value + ';path=/;expires=' + expires.toUTCString();
}
function setCookieWithPath(key, path ,value) {
	var expires = new Date();
    expires.setTime(expires.getTime() + (day * 24 * 60 * 60 * 1000));
    document.cookie = key + '=' + value + ';path='+path+';expires=' + expires.toUTCString();
}
// lấy cookie
function getCookie(key) {
    var keyValue = document.cookie.match('(^|;) ?' + key + '=([^;]*)(;|$)');
    return keyValue ? keyValue[2] : null;
}
// Xóa cookie
function deleteCookie(key,path) {
	var expires = new Date();
    expires.setTime(expires.getTime()-1);
    document.cookie = key + '=; path='+path+'; expires=' + expires.toUTCString();
}
// rewrite url: thêm trên url không load lại trang
function update_url(url_page) {
    history.pushState(null, null, url_page);
}
// Check giá trị tồn tại trong mảng
function checkValue(value,arr){
	var status = false;
	for(var i=0; i<arr.length; i++){
		var name = arr[i];
		if(name == value){
		  	status = true;
		  	break;
		}
	}
	return status;
}
// Trả về true nếu rỗng
function checkEmpty(value) {
	if (value == null) {
		return true;
	} else if (value == 'null') { 
		return true;
	} else if (value == undefined) { 
		return true;
	} else if (value == '') { 
		return true;
	} else if(value == []) {
        return true;
    } else {
		return false;
	}
}
// Lấy gái trị param tại Url
var getUrlParameter = function(url,name){
    var results = new RegExp('[\?&]' + name + '=([^&#]*)').exec(url);
    if (results==null) {
       return null;
    }
    return decodeURI(results[1]) || 0;
}
// truyền param lên url
// param_obj: là một obj có dạng {key:value,key1:value2}
function pushOrUpdate(param_obj) {
    var url = new URL(window.location.href);
    $.each(param_obj, function(key, value) {
        url.searchParams.set(key, value);
    })
    var newUrl = url.href;
    update_url(newUrl);
}

function newPushOrUpdate(param_obj) {
    let href = $('input.newUpdateUrl').val();
    if(checkEmpty(href)) {
        href = window.location.href;
    }
    var url = new URL(href);
    $.each(param_obj, function(key, value) {
        url.searchParams.set(key, value);
    })
    var newUrl = url.href;
    newUpdateUrl(newUrl);
}
function newUpdateUrl(newurl) {
    $('input.newUpdateUrl').val(newurl).change();
}
/* Tạo tự động mật khẩu */
function passwordGenerator(len) {
    var length = (len)?(len):(10);
    var string = "abcdefghijklmnopqrstuvwxyz"; //to upper 
    var numeric = '0123456789';
    var punctuation = '!@#$%^&*()';
    var password = "";
    var character = "";
    var crunch = true;
    while( password.length<length ) {
        entity1 = Math.ceil(string.length * Math.random()*Math.random());
        entity2 = Math.ceil(numeric.length * Math.random()*Math.random());
        entity3 = Math.ceil(punctuation.length * Math.random()*Math.random());
        hold = string.charAt( entity1 );
        hold = (password.length%2==0)?(hold.toUpperCase()):(hold);
        character += hold;
        character += numeric.charAt( entity2 );
        character += punctuation.charAt( entity3 );
        password = character;
    }
    password=password.split('').sort(function(){return 0.5-Math.random()}).join('');
    return password.substr(0,len);
}
/* Kiểm tra độ mạnh mật khẩu */
function passwordStrength(password){ 
    //initial strength
    var strength = 0    
    if (password.length == 0) {
        return strength;
    }
    if (password.match(/[a-z]+/)) {
        strength += 1;
    }
    if (password.match(/[A-Z]+/)) {
        strength += 1;
    }
    if (password.match(/[0-9]+/)) {
        strength += 1;
    }
    if (password.match(/[!@#$%^&*()]+/)) {
        strength += 1;
    }
    if (password.length >= 6) {
        strength += 1;
    }
    return strength;
}
// Trình Editor
function addTinyMCE(selector_id, height = 400) {
    id = selector_id.replace('#','');
    tinymce.execCommand('mceRemoveEditor', false, id);
    tinymce.init({
        path_absolute : "/",
        selector:selector_id,
        branding: false,
        hidden_input: false,
        relative_urls: false,
        convert_urls: false,
        height : height,
        autosave_ask_before_unload:true,
        autosave_interval:'10s',
        autosave_restore_when_empty:true,
        entity_encoding : "raw",
        fontsize_formats: "8px 9px 10px 11px 12px 13px 14px 15px 16px 17px 18px 19px 20px 22px 24px 26px 28px 30px 32px 36px 40px 46px 52px 60px",
        // autosave
        plugins: [
            "textcolor toc",
            "advlist autolink lists link image imagetools charmap print preview anchor",
            "searchreplace visualblocks code fullscreen",
            "insertdatetime media table contextmenu paste wordcount"
        ],
        wordcount_countregex: /[\w\u2019\x27\-\u00C0-\u1FFF]+/g,
        language: ($('meta[name=language]').attr('content') == 'vi') ? 'vi_VN' : '',
        autosave_retention:"30m",
        autosave_prefix: "tinymce-autosave-{path}{query}-{id}-",
        wordcount_cleanregex: /[0-9.(),;:!?%#$?\x27\x22_+=\\\/\-]*/g,
        toolbar: "undo redo | bold italic | table | sudomedia | styleselect | fontselect |  fontsizeselect " +
            "| forecolor backcolor | alignleft aligncenter alignright alignjustify | bullist numlist | outdent " +
            "indent | link unlink | fullscreen restoredraft | toc",
        setup: function (editor) {
            editor.addButton('sudomedia', {
                icon: 'image',
                label:'Nhúng ảnh vào nội dung',
                onclick: function () {
                    admin_dir = $('meta[name=admin_dir]').attr('content');
                    url_media = '/'+admin_dir+'/media?uploads=editor&field_id='+selector_id.replace('#','')+'&only=image';
                    $('#media').find('iframe').attr('src', url_media);
                    $('#media').modal('toggle');
                }
            });
        },
    });
}
/* FORM HTML Generate */
function formLoading($type) {
    $image = '';
    switch ($type) {
        case 'loading':
            $image = `<img src="/core/img/loading_image.gif" class="form-loading" alt="">`;
        break;
        case 'success':
            $image = `<img src="/core/img/icon-check.png" class="form-loading" alt="">`;
        break;
        case 'error': 
            $image = `<img src="/core/img/icon-error.png" class="form-loading" alt="">`;
        break;
    }
    return $image;
}
function formHelper($text) {
    return '<span class="error helper">'+$text+'</span>'
}
function convertStringToNumber(name){
    $('body').on('click','button[type=submit]', function(e) {
        value = $(name).val();
        value = value.replaceAll(',', '');
        value = parseInt(value);
        if(value == 0) value = '';
        $(name).val(value);
    });
}
// validate form
function validateInput(name, text_error) {
    $('body').on('keyup change', name, function() {
        $(name).parent().find('.error').remove();
        $(name).css('border', '1px solid #ced4da');
    });
    $('body').on('click','button[type=submit]', function(e) {
        value = $(name).val();
        $(name).parent().find('.error').remove();
        $(name).css('border', '1px solid #ced4da');
        if (checkEmpty(value)) {
            e.preventDefault();
            $(name).parent().append(formHelper(text_error));
            $(name).css('border', '1px solid #ff0000');
        }
    });
}
function validateSlug(status, name, text_error) {
    $(name).parent().find('.error').remove();
    $(name).css('border', '1px solid #ced4da');
    if (status == false) {
        $(name).parent().append(formHelper(text_error));
        $(name).css('border', '1px solid #ff0000');
    }
}
function validateSelect(name, text_error) {
    $('body').on('keyup change', name, function() {
        $(name).parent().find('.error').remove();
        $(name).css('border', '1px solid #ced4da');
        $(name).parent().find('.select2-selection').css('border', '1px solid #ced4da');
    });
    $('body').on('click','button[type=submit]', function(e) {
        value = $(name).val();
        $(name).parent().find('.error').remove();
        $(name).parent().find('.select2-selection').css('border', '1px solid #ced4da');
        if (checkEmpty(value)) {
            e.preventDefault();
            $(name).parent().append(formHelper(text_error));
            $(name).css('border', '1px solid #ff0000');
            $(name).parent().find('.select2-selection').css('border', '1px solid #ff0000');
        }
    });
}
function format_price(number, decimals, dec_point, thousands_sep) {
    var _decimals = 0;
    var _dec_point = ',';
    var _thousands_sep = '.';
    $.extend(_decimals, decimals);
    $.extend(_dec_point, dec_point);
    $.extend(_thousands_sep, thousands_sep);
    number = (number + '')
        .replace(/[^0-9+\-Ee.]/g, '');
    var n = !isFinite(+number) ? 0 : +number,
        prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
        sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
        dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
        s = '',
        toFixedFix = function (n, prec) {
            var k = Math.pow(10, prec);
            return '' + (Math.round(n * k) / k)
                .toFixed(prec);
        };
    // Fix for IE parseFloat(0.55).toFixed(0) = 0;
    s = (prec ? toFixedFix(n, prec) : '' + Math.round(n))
        .split('.');
    if (s[0].length > 3) {
        s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
    }
    if ((s[1] || '')
            .length < prec) {
        s[1] = s[1] || '';
        s[1] += new Array(prec - s[1].length + 1)
            .join('0');
    }
    return s.join(dec);
}
