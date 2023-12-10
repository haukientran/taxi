$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
$(document).ready(function() {
    
});
// check validate order
function validForm(form) {
    var check = true;
    $('.err_show').removeClass('active');
    $('#'+form+' .form-control').each(function(){
        var name = $( this ).attr('name');
        $( this ).css({'border':'1px solid #d5d5d5'}).css({'visibility':'visible'});
        if($( this ).val() == '') {
            $( this ).focus();
            $( this ).parent().find('.err_show.null').addClass('active');
            $( this ).css({'border':'2px solid #dc1f26'}).css({'visibility':'visible'});
            check = false;
        }
        if($( this ).val() != '' && $( this ).attr('name') == 'email' && !isEmail($( this ).val())) {
            $( this ).parent().find('.err_show.email').addClass('active');
            $( this ).css({'border':'2px solid #dc1f26'}).css({'visibility':'visible'});
            check = false;
        }
        if($( this ).val() != '' && $( this ).attr('name') == 'phone' && !isPhone($( this ).val())) {
            $( this ).parent().find('.err_show.phone').addClass('active');
            $( this ).css({'border':'2px solid #dc1f26'}).css({'visibility':'visible'});
            check = false;
        }
        if($( this ).val() == 0 && $( this ).attr('name') == 'product_name') {
            $( this ).parent().find('.err_show').addClass('active');
            $( this ).css({'border':'2px solid #dc1f26'}).css({'visibility':'visible'});
            check = false;
        }
        if(check == false){
            // console.log($('#'+form+' .form-control:first-child .err_show.active'))
            var f = form;
            if(f == 'formComment' || f.includes('formComment')){
                f = 'cmt_vote';
            }
            // nếu là form tu vấn chi tiết sp thì khoogn scroll
            if(f != 'form_contact'){
                var t = $('#'+f).position().top;
                $("html, body").animate({ scrollTop: t }, "slow");
            }
        }
    });
    return check;
} 
function setCookie(key, value, minute) {
    var expires = new Date();
    expires.setTime(expires.getTime() + (minute * 60 * 1000));
    document.cookie = key + '=' + value + ';path=/;expires=' + expires.toUTCString();
}
function isEmail(email) {
    var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    return regex.test(email);
};
function isPhone(phone) {
    var regex = /((09|03|07|08|05)+([0-9]{8})\b)/g;
    return regex.test(phone);
}; 
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
function alert_show(type='success',message='') {
    $('#toast-container .toast').addClass('toast-'+type);
    $('#toast-container .toast div').text(message);
    $('#toast-container').css('display','block');
    setTimeout(function() {
        $('#toast-container').css('display','none');
        $('#toast-container .toast').removeClass('toast-'+type);
        $('#toast-container .toast div').text('');
    }, 2000);
}