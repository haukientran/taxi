document.addEventListener("DOMContentLoaded", function(event) {
    $(document).ready(function() {
        variable = $('.lang_comments').data('value');
        variable = atob(variable);
        variable = JSON.parse(variable);

        $('body').on('click', '.comments .action_like', function(e) {
            let id = $(this).data('id');

            var $qtyLike = $('.qty_like_' + id);
            data = {
                id: id,
            };
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'POST',
                url: variable.ajax_like,
                data: data,
                success:function(result) {
                    $qtyLike.html(result);
                },
                error: function (error) {
                }
            })
        });
       //ẩn trả lời bình luận
        $('body').on('click', '.acition_hidden', function(e) {
            $('.item-reply').find('.comments-add').css('display', 'none');
        });
        $('body').on('click', '.comments-content .pagination a', function(e) {
            e.preventDefault();
            href = $(this).attr('href');
            type = $(this).closest('.comments').data('type');
            type_id = $(this).closest('.comments').data('type_id');
            var pageCmt = getUrlParameter(href, 'pageCmt');
            commentLoad(type, type_id, pageCmt, $(this), 1);
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
        // Chọn số sao đánh giá
        $('.comments-add__rate .star svg').on('click', function(event) {
            currentValue = $(this).attr('evaluate');
            $(this).closest('.comments-add__rate').find('.rank').val(currentValue);
            var stars = $('.comments-add__rate .rating svg');
            $(stars).removeClass('active');
            $(stars).find('path').addClass('active');

            // Thay đổi thuộc tính fill của các thẻ svg
            for (var i = 0; i < stars.length; i++) {
                var starValue = $(stars[i]).attr('evaluate');
                if (starValue <= currentValue) {
                    $(stars[i]).addClass('active');
                    $(stars[i]).attr('fill', '#fd9727');
                    stars.find('path').attr('stroke', '#fd9727')
                }
            }

        });

        $('.comments-add__rate .star svg').hover(
            function() {
                // Xử lý khi con trỏ chuột di chuyển qua thẻ SVG
                currentValue = $(this).attr('evaluate');
                var stars = $('.comments-add__rate .rating svg');

                // Thay đổi thuộc tính fill của các thẻ svg
                for (var i = 0; i < stars.length; i++) {
                    var starValue = $(stars[i]).attr('evaluate');
                    stars.find('path').attr('stroke', '#fd9727')
                    if (starValue <= currentValue) {
                        $(stars[i]).attr('fill', '#fd9727');
                    }
                }
            },
            function() {
                // Xử lý khi con trỏ chuột rời khỏi thẻ SVG
                var stars = $('.comments-add__rate .rating svg');
                stars.attr('fill', 'none');
                stars.find('path').attr('stroke', '#111')
            }
        );
        // Thêm bình luận
        $('body').on('click', '.comments *[data-comments_submit]', function(e) {
            e.preventDefault();
            e.stopImmediatePropagation();
            comments = $(this).closest('.comments');
            type = comments.data('type');
            type_id = comments.data('type_id');
            name = $(this).closest('.comments-add').find('*[name=name]').val();
            phone = $(this).closest('.comments-add').find('*[name=phone]').val();
            email = $(this).closest('.comments-add').find('*[name=email]').val();
            content = $(this).closest('.comments-add').find('*[name=content]').val();
            parent_id = $(this).closest('.comments-add').find('*[name=parent_id]').val();
            rank = $(this).closest('.comments-add').find('*[name=rank]').val() ?? 0;
            if (rank == 0) {
                $(this).closest('.comments-add__form').find('.star_req').show();
            }
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
                form_data.append('rank', rank);
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
                // Thay đổi số lượng bình luận ở tổng bình luận
                $('.comments').find('.total-comment').text('('+result.comment_totals+') đánh giá');
                //set lại chart bình luận
                $('.comments').find('.block-rate__chart').html(result.chart);

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
                    // Set lại giá trị số trang hiện tại ở nút xem thêm
                    this_element.closest('.comments').find('*[data-page_cmt]').attr('data-page_cmt', 1).data('page_cmt', 1);
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
});
