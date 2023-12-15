$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
$(document).ready(function() {
      // hiển thị danh mục menu
    $('body').on('click', '.header-menu .menu-btn',function(event) {
        $('.header-menu').toggleClass('header-menu--open');
        $('.menu-popup').toggleClass('active');
    });
    $('body').on('click', '.menu-close',function(event) {
        $('.menu-popup').removeClass('active');
    });
    // nút mở rộng bộ lọc
    $("body").on("click",".has-child",function(e){
        var closestSubMenu = $(this).closest('li').find('> .submenu').toggleClass('active');
        $(this).toggleClass('active');
        closestSubMenu.find('.submenu').removeClass('active');
    });
    if($('.adminbar').length > 0){
        var height_adminbar = $('.adminbar').height();
    } else{
        var height_adminbar = 0;
    }
    var height_header = $('.header').outerHeight();
    $('.header').css('top',height_adminbar);
    $('main').css('margin-top',height_header+height_adminbar);
    $('main').css('margin-top', 105);
    $(window).scroll(function(){
        if($(this).scrollTop() > 0) {
            if($('.header').hasClass('home')){
                $('.header').removeClass('home');
            }else {
                $('.header').css('top',height_adminbar);
            }
            $('.header').addClass('active');

        } else {
            if($('.header').hasClass('header_home')){
                $('.header').addClass('home');
            }
            $('.header').removeClass('active');
        }
    });
    //slide video home
    sudoSlide(
        'slideList',
        [
            {'maxWidth': 99999999999999, 'minWidth': 0, 'qtyItem': 1, 'nextItem': 1},
        ],
        true ,false, false, 5000, 1, 0, 1, 'data-thumnail');

    //slide điều kiện tham gia
    sudoSlide(
        'contidion-list',
        [
            {'maxWidth': 99999999999999, 'minWidth': 0, 'qtyItem': 1, 'nextItem': 1},
        ],
        false ,true, false, 5000, 1, 0, 1, 'data-thumnail');
    // //slide dịch vụ
    // sudoSlide(
    //     'service_grid3-list',
    //     [
    //         {'maxWidth': 99999999999999, 'minWidth': 0, 'qtyItem': 1, 'nextItem': 1},
    //     ],
    //     false ,true, false, 5000, 1, 0, 1, 'data-thumnail');
    //slide phản hồi học viên
    sudoSlide(
        'feedback-list',
        [
            {'maxWidth': 99999999999999, 'minWidth': 480, 'qtyItem': 2, 'nextItem': 1},
            {'maxWidth': 480, 'minWidth': 0, 'qtyItem': 1, 'nextItem': 1},
        ],
        false ,true, false, 5000, 1, 15, 1, 'data-thumnail');
    sudoSlide(
        'evaluate-slide',
        [
            {'maxWidth': 99999999999999, 'minWidth': 480, 'qtyItem': 2, 'nextItem': 1},
            {'maxWidth': 480, 'minWidth': 0, 'qtyItem': 1, 'nextItem': 1}
        ],
        false ,true, false, 5000, 1, 15, 1,  'data-thumnail');
    sudoSlide(
        'team_world',
        [
            {'maxWidth': 99999999999999, 'minWidth': 0, 'qtyItem': 4, 'nextItem': 1},
            {'maxWidth': 1200, 'minWidth': 768, 'qtyItem': 4, 'nextItem': 1},
            {'maxWidth': 768, 'minWidth': 480, 'qtyItem': 3, 'nextItem': 1},
            {'maxWidth': 480, 'minWidth': 0, 'qtyItem': 2, 'nextItem': 1}
        ],
        true ,false, false, 5000, 1, 15, 1, 'data-thumnail');
    $('.activity-list.s-wrap').each(function(e) {
        let id = $(this).attr('id');
        sudoSlide(
            id,
            [
                {'maxWidth': 99999999999999, 'minWidth': 480, 'qtyItem': 2, 'nextItem': 1},
                {'maxWidth': 480, 'minWidth': 0, 'qtyItem': 1.1, 'nextItem': 1},
            ],
            false ,true, false, 5000, 1, 10, 1, 'data-thumnail');
    })
    //tìm kiếm
    var isExpanded = false;
    $('body').on('click','.search-category',function(){
        $(this).parent().find('.keyword-category').slideToggle();
        $(this).parent().find('.header-search__result').slideToggle();
        // $(this).find('svg').addClass('rotate-180');
        if (isExpanded) {
            $(this).find('svg').removeClass('rotate-180');
        } else {
            $(this).find('svg').addClass('rotate-180');
        }
        isExpanded = !isExpanded; // Đảo ngược trạng thái
    });
    $(document).click(function(event) {
        var searchCategory = $(".header-search");
        if (!searchCategory.is(event.target) && searchCategory.has(event.target).length === 0) {
            // Kiểm tra nếu sự kiện click xảy ra bên ngoài phần tử .search-category
            searchCategory.find('.search-category svg').removeClass("rotate-180"); // Xoay ngược lại
            $('.keyword-category').slideUp();
            $('.header-search__result').slideUp();
            isExpanded = false; // Đặt lại trạng thái khi click ra ngoài
        }
    });
    $(".checkbox input").change(function() {
        $('.keyword-category').slideUp();
        type = []; // Xóa danh sách hiện tại để cập nhật lại
        $(".header-search .checkbox input:checked").each(function() {
            var itemId = $(this).attr("id");
            type.push(itemId);
        });
        $.ajax({
            url: "/ajax/search-category",
            method: "POST",
            data: {
                type: type,
            },
            beforeSend: function () {
                loadingBox('open');
            },
            success: function (result) {
                loadingBox('close');
                $('.header-search__result').html(result)
                $('.header-search__result').slideDown();
            },
            error: function (error) {
                loadingBox('close');
                alert_show('error', $('#loading_box').data('error'));
            }
        });
    });
    // hiển thị danh mục menu
    $('body').on('click', 'footer .footer-item',function(event) {
        $(this).toggleClass('active');
    });
    //tab menu footer
    customTabs('menu', 'footer-center', 'active');
    //tab menu footer thanh taskbar
    customTabs('menu', 'footer-taskbar__content', 'active', false);
    $(document).click(function(event) {
        var footerTaskbar = $(".footer-taskbar");
        if (!footerTaskbar.is(event.target) && footerTaskbar.has(event.target).length === 0) {
            // Kiểm tra nếu sự kiện click xảy ra bên ngoài phần tử .footer-taskbar
            footerTaskbar.find('.footer-taskbar__content').removeClass('active');
        }
    });
    // sự kiện xem thêm quốc gia du học
    var pageNation = 1;
    // sự kiện xem thêm quốc gia du học
    $('body').on('click','.nation-see-more',function(){
        $type = $(this).data('hidden');
        if ($type) {
            // Load lại trang
            location.reload();
            $('html, body').animate({
                scrollTop: $('.nation-list').position().top - 300
            }, 300);
        }else {
            pushOrUpdate({ page: ++pageNation, });
        }
        loadProduct('append', '.nation-list', '.nation-see-more');
    });
    // Đăng kí ngay
    $('body').on('click', '#register_now',function(e) {
        $('.popup-register').addClass('active');
    })
    $('body').on('click', '.btn-close', function(event) {
        event.stopPropagation();
        $(this).closest('.popup').removeClass('active');
    });
        // xem them phần phàn hồi khách hàng
    // $('body').on('mouseenter', '.evaluate-item__see-more',function(e) {
    //     var $evaluateItem = $(this).closest('.evaluate-item');
    //     var $evaluateItemContent = $evaluateItem.find('.evaluate-item__content');

    //     $evaluateItemContent.css('max-height', 'inherit');
    //     $(this).hide();
    //     $evaluateItem.on('mouseleave', function() {
    //         $evaluateItemContent.css('max-height', '36px');
    //         $('.evaluate-item__see-more', $evaluateItem).show();
    //     });
    // })
    // Bỏ mặc định thẻ a
    $('body').on('click', '.has-child.item-link', function(event) {
        event.preventDefault();
    });
    // phân trang
    $('body').on('click', '#category_post .pagination a', function(e) {
        e.preventDefault();

        var pageUrl = $(this).attr('href');
        var page = getUrlParameter(pageUrl, 'page');
        pushOrUpdate({ page: page, });
        let newUrl = pageUrl.split('?')[0] || data_href
        newUrl = newUrl + '#trang='+page
        update_url(newUrl);
        loadData('', '', '', false);
    });
});
function loadSendForm(form) {
    var type = $('#' + form + ' .register-action').data('type');
    if(validFormRegister(form,type) == true) {
        var formData = {
            name: $('#' + form + ' input[name="name"]').val(),
            email: $('#' + form + ' input[name="email"]').val(),
            phone: $('#' + form + ' input[name="phone"]').val(),
            note: $('#' + form + ' textarea[name="note"]').val(),
            type: type
        };

        if (type === 1) {
            formData.country = $('#' + form + ' select[name="country"]').val();
            formData.educational = $('#' + form + ' select[name="educational"]').val();
        }

        if (type === 2) {
            formData.course = $('#' + form + ' select[name="course"]').val();
            formData.province = $('#' + form + ' select[name="province"]').val();
        }
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: '/ajax/send_form',
            method: "POST",
            data: formData,
            beforeSend: function () {
                loadingBox('open');
            },
            success: function (data) {
                setTimeout(function(){
                    loadingBox('close');
                }, 2000);
                if (data.status === 'success') {
                    alert_show('success', data.message);
                    $('.popup-register').removeClass('active');
                    $('#'+form+' .form-item input, #'+form+' .form-item textarea').val('');
                    $('#' + form + ' select').val('');
                } else {
                    alert_show('error', data.message);
                }
            },
            error: function (error) {
                loadingBox('close');
                alert_show('error', $('#loading_box').data('error'));
            }
        })
    }
}
// check validate order
function validFormRegister(form, type) {
    var check = true;
    $('.err_show').removeClass('active');
    $('#'+form+' .form-control').each(function(){
        var name = $( this ).attr('name');
        $( this ).css({'border':'1px solid #d5d5d5'}).css({'visibility':'visible'});

        if($( this ).val() == '' && name == 'name') {
            $( this ).parent().find('.err_show').addClass('active');
            $( this ).css({'border':'2px solid #dc1f26'}).css({'visibility':'visible'});
            check = false;
        }
        if($( this ).val() == '' && $( this ).attr('name') == 'email') {
            $( this ).focus();
            $( this ).parent().find('.err_show.null').addClass('active');
            $( this ).css({'border':'2px solid #dc1f26'}).css({'visibility':'visible'});
            check = false;
        }
        if($( this ).val() != '' && name == 'email' && !isEmail($( this ).val())) {
            $( this ).parent().find('.err_show.email').addClass('active');
            $( this ).css({'border':'2px solid #dc1f26'}).css({'visibility':'visible'});
            check = false;
        }
        if($( this ).val() == '' && $( this ).attr('name') == 'phone') {
            $( this ).focus();
            $( this ).parent().find('.err_show.null').addClass('active');
            $( this ).css({'border':'2px solid #dc1f26'}).css({'visibility':'visible'});
            check = false;
        }
        if($( this ).val() != '' && name == 'phone' && !isPhone($( this ).val())) {
            $( this ).parent().find('.err_show.phone').addClass('active');
            $( this ).css({'border':'2px solid #dc1f26'}).css({'visibility':'visible'});
            check = false;
        }
        if (type === 1) {
            if ($( this ).val() == '' && $( this ).attr('name') == 'country') {
                $( this ).parent().find('.err_show').addClass('active');
                $( this ).css({'border':'2px solid #dc1f26'}).css({'visibility':'visible'});
                check = false;
            }
            if ($( this ).val() == '' && $( this ).attr('name') == 'educational') {
                $( this ).parent().find('.err_show').addClass('active');
                $( this ).css({'border':'2px solid #dc1f26'}).css({'visibility':'visible'});
                check = false;
            }
        }
        if (type === 2) {
            if ($( this ).val() == '' && $( this ).attr('name') == 'course') {
                $( this ).parent().find('.err_show').addClass('active');
                $( this ).css({'border':'2px solid #dc1f26'}).css({'visibility':'visible'});
                check = false;
            }
            if ($( this ).val() == '' && $( this ).attr('name') == 'province') {
                $( this ).parent().find('.err_show').addClass('active');
                $( this ).css({'border':'2px solid #dc1f26'}).css({'visibility':'visible'});
                check = false;
            }
        }
    });
    return check;
}
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
// menu: class của menu có cấu trúc ul[class=menu]>li>a[href="#content_id_name"]
// content: class của thẻ bao nội dung VD: div[class=content,id=content_id_name]
// active: tên class khi active content
function customTabs(menu, content, active, first='true') {
    // Ẩn toàn bộ nội dung trong content
    // $("."+content).hide();
    // Hiển thị và đánh active cho thẻ li và content đầu tiên nếu first = true
    if(first == true) {
        $("ul."+menu+" li:first").addClass('active').fadeIn();
        $("."+content+":first").addClass(active);
    }
    // khi thẻ li được click
    $("ul."+menu+" li").on('click',function(e){
        e.preventDefault();
        // bỏ toàn bộ active cho các thẻ li trước đó
        $("ul."+menu+" li").removeClass('active');
        // Đánh lại active cho thẻ li này
        $(this).addClass('active');
        var activeTab = $(this).find('a').attr('href');
        $("."+content).removeClass('active');
        $(activeTab).addClass('active');
    });
}

// Lấy giá trị param tại Url
function getUrlParameter(url, name) {
    var results = new RegExp('[\?&]' + name + '=([^&#]*)').exec(url);
    if (results==null) {
       return null;
    }
    return decodeURI(results[1]) || null;
}
// truyền param lên url
function update_input_url(url_page){
    $('input[name="current_url"]').val(url_page)
}

// param_obj: là một obj có dạng {key:value,key1:value2}
function pushOrUpdate(param_obj) {
    var url = new URL(window.location.href);
    $.each(param_obj, function(key, value) {
        url.searchParams.set(key, value);
    })
    var newUrl = url.href;
    update_input_url(newUrl);
}
function update_input_url(url_page){
    $('input[name="current_url"]').val(url_page)
}
function update_url(url_page) {
    history.pushState(null, null, url_page);
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
// Load Dữ liệu ListData
// animate: progress | loading | no_action
function loadAjaxGetPaginate(url, option, type){
    if (checkEmpty(type)) { type = 'progress'; }
    var _option = {
        beforeSend:function(){},
        success:function(result){},
        error:function(error){}
    }
    $.extend(_option,option);
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: 'POST',
        url: url,
        beforeSend: function(){
            loadingBox('open');
        },
        success:function(result){
            loadingBox('close');
            _option.success(result);
        },
        error: function (error) {
           /* Có lỗi sẽ ân Module Loading và thông báo */
            loadingBox('close');
            alert('Có lỗi xảy ra. Vui lòng thử lại!', 'error')
            _option.error(error);
        }
    })
}
// Load Dữ liệu ListData
// animate: progress | loading | no_action
function loadData(animate='progress',type='',type_wrapper='', typeAppend = true) {
    var url = $('input[name="current_url"]').val();
    loadAjaxGetPaginate(url, {
        beforeSend: function(){},
        success:function(result){
            var count_choosen = result.count_choosen > 0 ? result.count_choosen : 1;
            $('.pagination').empty();
            $('.pagination').append(result.pagination);
            if (!typeAppend) {
                $('html, body').animate({
                    scrollTop: $('#listdata').position().top
                }, 300)
                $('#listdata').empty()
                $('body .paginate_item').each(function(){
                    let href = $(this).data('href')
                    let page = getUrlParameter(href, 'page');
                    let newUrl = href.split('?')[0] || href
                    newUrl+='#trang='+page
                    let currentUrl = window.location.href
                    if(currentUrl == newUrl) {
                        $(this).addClass('active')
                    }
                })
            }
            $('#listdata').append(result.html);
        },
        error: function (error) {}
    }, animate);
}
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
function loadProduct(type='', listdata = '#listdata', btnMore = '.btn-more') {
    var url = $('input[name="current_url"]').val();

    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: 'POST',
        url: url,
        beforeSend: function(){
            // loadingBox('open');
        },
        success:function(result){
            // loadingBox('close');
            if(result.status == 1) {
                if (result.is_hide_more) {
                    $(btnMore).html('Quay lại');
                    $(btnMore).attr('data-hidden', 'true');
                } else {
                    $(btnMore).show();
                }
                if(type == 'empty'){
                    $(listdata).empty()
                    $(listdata).html(result.html);
                    $('html, body').animate({
                        scrollTop: $(listdata).position().top - 250
                    }, 300);
                } else{
                    $(listdata).append(result.html);
                }
            }
        },
        error: function (error) {
           /* Có lỗi sẽ ân Module Loading và thông báo */
            // loadingBox('close');
            alert('Có lỗi xảy ra. Vui lòng thử lại!', 'error')
            // _option.error(error);
        }
    })
}
