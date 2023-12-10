$(document).ready(function() {
	variable = $('.lang_comments').data('value');
	variable = atob(variable);
	variable = JSON.parse(variable);
	
    // Popup hình ảnh
    $('body').on('click', '.comments .popup-image', function(e) {
        e.preventDefault();
        e.stopImmediatePropagation();
        src = $(this).data('image');
        $(this).closest('.comments').find('.previews').find('.comments-popup__body').find('img').attr('src', src);
        $(this).closest('.comments').find('.previews').addClass('open');
        $('body').css('overflow', 'hidden');
    });

    // Ảnh preview
    $('body').on('change', 'input[name=comment_file]', function(e) {
        e.preventDefault();
        file = this.files;
        check_extention = 0;
        allowed_size = variable.allowed_size; // Tổng kích thước các file là được dặt trong config
        allowed_extention = ['jpg','jpeg','png']; // Chỉ cho phép upload một số file nhất định
        let item_file = 0 ;
        $(this).closest('.comments-add').find('.comments-add__preview').empty().change();

        $.each(file,function(index,file_data) {
            if (file_data.size > allowed_size) {
                check_size = 1;
            }
            if ($.inArray(file_data.name.split('.').pop().toLowerCase(), allowed_extention) == -1) {
                // TH có ext khác thì k insert
                check_extention = 1;
            }else {
                image_preview = URL.createObjectURL(file_data);
                let html_image = `<div class="image">
                    <img src="${image_preview}">
                    <input type="file" name="image[]" id="upload_${item_file}" style="display: none;">
                </div>`;
                $('.comments-add').find('.comments-add__preview').append(html_image);
                let fileInput = document.querySelector('input#upload_'+item_file);
                let b = new ClipboardEvent("").clipboardData || new DataTransfer();
                // lớn hơn 500kb thì reduce
                if(file_data.size > 512000 || file_data.fileSize > 512000) {
                    resizeImage(file_data, {
                        use_reader: false,
                        mode: 2,
                        val: 400,
                        type: 'image/jpeg',
                        quality: 0.8,
                        callback: function(result) {
                            let myFile = dataURLtoFile(result, file_data.name);
                            b.items.add(myFile)
                            fileInput.files =  b.files;
                        }
                    });
                }else {
                    b.items.add(file_data)
                    fileInput.files =  b.files;
                }
                item_file++;
            }
        });
        if (check_extention == 1) {
            alertTextCmt(variable.valid_extention+' '+allowed_extention.join(', '));
        }
    });

    // load thêm bình luận
    $('body').on('click', '.comments *[data-comments_loadmore]', function(e) {
        e.preventDefault();
        e.stopImmediatePropagation();
        type = $(this).closest('.comments').data('type');
        type_id = $(this).closest('.comments').data('type_id');
        pageCmt = parseInt($(this).data('page_cmt'));
        pageCmt = pageCmt+1;
        if ($(this).closest('.comments').find('.comments-info__filter').find('input[name=keyword]').val() == '') {
            commentLoad(type, type_id, pageCmt, $(this));
        } else {
            value = $(this).closest('.comments').find('.comments-info__filter').find('input[name=keyword]').val();
            commentSearch(type, type_id, value, pageCmt, $(this), false);
        }
    });

    // Tìm kiếm bình luận
    start = null;
    $('body').on('click', '.comments-info__filter button[type=submit]', function(e) {
        e.preventDefault();
        e.stopImmediatePropagation();
        e = $(this);
        clearTimeout(start);
        comments = e.closest('.comments');
        type = comments.data('type');
        type_id = comments.data('type_id');
        value = e.closest('.comments-info__filter').find('input[name=keyword]').val();
        commentSearch(type, type_id, value, 1, e, true);
    })
    $('body').on('keyup', '.comments-info__filter input[name=keyword]', function(e) {
        e.preventDefault();
        e.stopImmediatePropagation();
        e = $(this);
        clearTimeout(start);
        value = e.val();
        start = setTimeout(function() {
            e.closest('.comments-info__filter').find('button[type=submit]').click();
        }, 2000);
    })

	// Trả lời bình luận
	$('body').on('click', '.comments *[data-reply]', function(e) {
		e.preventDefault();
        e.stopImmediatePropagation();
		item = $(this).closest('.item[data-comment_id]');
		tags = $(this).data('reply');
		$('.item-reply').find('.comments-add').css('display', 'none');
		$('.comments-add__moreinfo').css('display', 'none');
		item.find('.item-reply').find('.comments-add').slideDown();
		item.find('.item-reply').find('.comments-add').find('.comments-add__form-field').val(tags);
	});

    content = null;
    file_data = null;
    parent_id = null;
    // Hiển thị thông tin thêm
    $('body').on('click', '.comments *[data-comments_moreinfo]', function(e) {
        e.preventDefault();
        e.stopImmediatePropagation();
        $(this).closest('.comments').find('.moreinfo').addClass('open');
        $('body').css('overflow', 'hidden');
        content = $(this).closest('.comments-add').find('*[name=content]').val();
        parent_id = $(this).data('comment_id');
        if (variable.upload_image == true) { 
            file_data = $(this).closest('.comments-add').find('*[name=comment_file]').prop("files"); 
        }
	})

	// Đóng popup
	$('body').on('click', '.comments *[data-comments_close]', function(e) {
		e.preventDefault();
        e.stopImmediatePropagation();
		$(this).closest('.comments-popup').removeClass('open');
        $('body').css('overflow', 'auto');
        content = null;
        file_data = null;
        parent_id = null;
	})

    // Thêm bình luận
    $('body').on('click', '.comments *[data-comments_submit]', function(e) {
        e.preventDefault();
        e.stopImmediatePropagation();
        comments = $(this).closest('.comments');
        type = comments.data('type');
        type_id = comments.data('type_id');
        name = $(this).closest('.moreinfo').find('*[name=name]').val();
        phone = $(this).closest('.moreinfo').find('*[name=phone]').val();
        email = $(this).closest('.moreinfo').find('*[name=email]').val();
        if (content == '' || name == '' || phone == '' || email == '') {
            alertTextCmt(variable.valid_empty);
        } else if (!validatePhoneCmt(phone)) {
            alertTextCmt(variable.valid_format_phone);
        } else if (!validateEmailCmt(email)) {
            alertTextCmt(variable.valid_format_email);
        } else {
            form_data = new FormData();
            form_data.append('type', type);
            form_data.append('type_id', type_id);
            form_data.append('content', content);
            form_data.append('name', name);
            form_data.append('phone', phone);
            form_data.append('email', email);
            form_data.append('parent_id', parent_id);
            $('.comments .comments-add__preview .image').each(function(){
                let input = $(this).find('input');
                form_data.append('files[]', input[0].files[0]);
            });
            commendAdd(type, type_id, $(this), form_data);
        }
    })
});
function dataURLtoFile(dataurl, filename) {
    var arr = dataurl.split(','),
        mime = arr[0].match(/:(.*?);/)[1],
        bstr = atob(arr[1]),
        n = bstr.length,
        u8arr = new Uint8Array(n);

    while(n--){
        u8arr[n] = bstr.charCodeAt(n);
    }
    return new File([u8arr], filename, {type:mime});
}
// Alert
function alertTextCmt(text) {
	alert(text);
}
// format định dạng kích thước
function formatSizeCommentFile(bytes){
    if      (bytes >= 1073741824) { bytes = (bytes / 1073741824).toFixed(2) + " GB"; }
    else if (bytes >= 1048576)    { bytes = (bytes / 1048576).toFixed(2) + " MB"; }
    else if (bytes >= 1024)       { bytes = (bytes / 1024).toFixed(2) + " KB"; }
    else if (bytes > 1)           { bytes = bytes + " bytes"; }
    else if (bytes == 1)          { bytes = bytes + " byte"; }
    else                          { bytes = "0 bytes"; }
    return bytes;
}

// check định dạng email
function validateEmailCmt(email) {
	var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
	return re.test(String(email).toLowerCase());
}
// check định dạng điện thoại
function validatePhoneCmt(phone) {
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

function commentLoad(type, type_id, pageCmt, this_element, reload) {
	data = {
		type: type,
		type_id: type_id,
		pageCmt: pageCmt,
	};
	$.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: 'POST',
        url: variable.ajax_load_url,
        data: data,
        beforeSend: function(){
            $(".comments-loading").css({visibility:"visible", opacity: 0.0}).animate({opacity: 1.0},200);
        },
        success:function(result) {
            $(".comments-loading").animate({opacity: 0.0}, 200, function(){
                $(".comments-loading").css("visibility","hidden");
            });
            // Thay đổi số lượng bình luận ở tổng bình luận
            this_element.closest('.comments').find('.total-comment').text(result.comment_totals);

            if (result.has_more == false) {
                // has_more bằng false thì ẩn box xem thêm
            	this_element.closest('.comments').find('.comments-loadmore').css('display', 'none');
            } else {
                // Hiển thị box xem thêm
            	this_element.closest('.comments').find('.comments-loadmore').css('display', 'block');
            }

            // reload là true thì sẽ load lại box bình luận
            if (reload == true) {
                // làm trống danh sách sách và đổ lại
                this_element.closest('.comments').find('.comments-list').empty().append(result.html);
            } else {
                // Đổ tiếp bình luận dưới bình luận hiện có
            	this_element.closest('.comments').find('.comments-list').append(result.html);
            }

            // Set lại giá trị số trang hiện tại ở nút xem thêm
            this_element.closest('.comments').find('*[data-comments_loadmore]').data('page_cmt', pageCmt).attr('data-page_cmt', pageCmt);
            
            // Set lại giá trị ô tìm kiếm vè rỗng
            this_element.closest('.comments').find('.comments-info__filter').find('input[name=keyword]').val('');
        },
        error: function (error) {
            /* Có lỗi sẽ ân Module Loading và thông báo */
            $(".comments-loading").animate({opacity: 0.0}, 200, function(){
                $(".comments-loading").css("visibility","hidden");
            });
            alertTextCmt(variable.ajax_load_error_text);
        }
    })
}

// Thêm bình luận
function commendAdd(type, type_id, this_element, form_data) {
	$.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: 'POST',
        url: variable.ajax_add_url,
        data: form_data,
        enctype: 'multipart/form-data',
        processData: false,
        contentType: false,
        beforeSend: function(){
            $(".comments-loading").css({visibility:"visible", opacity: 0.0}).animate({opacity: 1.0},200);
        },
        success:function(result){
            $(".comments-loading").animate({opacity: 0.0}, 200, function(){
                $(".comments-loading").css("visibility","hidden");
            });
            if (result.status == 2) {
            	alertTextCmt(result.message);
            } else {
                // Reload bình luận
            	commentLoad(type, type_id, 1, this_element, true);
                // Set các giá trị tại form về rỗng
                this_element.closest('.comments').find('*[name=content]').val('');
                this_element.closest('.comments').find('*[name=name]').val('');
                this_element.closest('.comments').find('*[name=phone]').val('');
                this_element.closest('.comments').find('*[name=email]').val('');
                this_element.closest('.comments').find('*[name=parent_id]').val('');
                this_element.closest('.comments').find('*[name=comment_file]').val('');
                // Set lại giá trị số trang hiện tại ở nút xem thêm
                this_element.closest('.comments').find('*[data-page_cmt]').attr('data-page_cmt', 1).data('page_cmt', 1);
                // Làm trống box review ảnh
                this_element.closest('.comments').find('.comments-add__preview').empty();
                // ẩn box thông tin người dùng
                this_element.closest('.comments').find('.moreinfo').removeClass('open');
                $('body').css('overflow', 'auto');
            }
        },
        error: function (error) {
            /* Có lỗi sẽ ân Module Loading và thông báo */
            $(".comments-loading").animate({opacity: 0.0}, 200, function(){
                $(".comments-loading").css("visibility","hidden");
            });
            alertTextCmt(variable.ajax_load_error_text);
        }
    })
}

function commentSearch(type, type_id, keyword, pageCmt, this_element, reload) {
    data = {
        type: type,
        type_id: type_id,
        keyword: keyword,
        pageCmt: pageCmt,
    };
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: 'POST',
        url: variable.ajax_search_url,
        data: data,
        beforeSend: function(){
            $(".comments-loading").css({visibility:"visible", opacity: 0.0}).animate({opacity: 1.0},200);
        },
        success:function(result) {
            $(".comments-loading").animate({opacity: 0.0}, 200, function(){
                $(".comments-loading").css("visibility","hidden");
            });

            if (result.has_more == false) {
                // has_more bằng false thì ẩn box xem thêm
                this_element.closest('.comments').find('.comments-loadmore').css('display', 'none');
            } else {
                // Hiển thị box xem thêm
                this_element.closest('.comments').find('.comments-loadmore').css('display', 'block');
            }

            // reload là true thì sẽ load lại box bình luận
            if (reload == true) {
                // làm trống danh sách sách và đổ lại
                this_element.closest('.comments').find('.comments-list').empty().append(result.html);
            } else {
                // Đổ tiếp bình luận dưới bình luận hiện có
                this_element.closest('.comments').find('.comments-list').append(result.html);
            }
            // Set lại giá trị số trang hiện tại ở nút xem thêm
            this_element.closest('.comments').find('*[data-comments_loadmore]').data('page_cmt', pageCmt).attr('data-page_cmt', pageCmt);
        },
        error: function (error) {
            /* Có lỗi sẽ ân Module Loading và thông báo */
            $(".comments-loading").animate({opacity: 0.0}, 200, function(){
                $(".comments-loading").css("visibility","hidden");
            });
            alertTextCmt(variable.ajax_load_error_text);
        }
    })
}
