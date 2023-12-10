function CleanVal(input)
{
    var val = input;
    val = val.replace("\\u003cb\\u003e", "");
    val = val.replace("\\u003c\\/b\\u003e", "");
    val = val.replace("\\u003c\\/b\\u003e", "");
    val = val.replace("\\u003cb\\u003e", "");
    val = val.replace("\\u003c\\/b\\u003e", "");
    val = val.replace("\\u003cb\\u003e", "");
    val = val.replace("\\u003cb\\u003e", "");
    val = val.replace("\\u003c\\/b\\u003e", "");
    val = val.replace("\\u0026amp;", "&");
    val = val.replace("\\u003cb\\u003e", "");
    val = val.replace("\\u0026", "");
    val = val.replace("\\u0026#39;", "'");
    val = val.replace("#39;", "'");
    val = val.replace("\\u003c\\/b\\u003e", "");
    val = val.replace("\\u2013", "2013");
    if (val.length > 4 && val.substring(0, 4) == "http") val = "";
    return val;
}
function loadingBox(type='open') {
    if (type == 'open') {
        $("#loading_box").css({visibility:"visible", opacity: 0.0}).animate({opacity: 1.0},200);
    } else {
        $("#loading_box").animate({opacity: 0.0}, 200, function(){
            $("#loading_box").css("visibility","hidden");
        });
    }
}
function checkSeoOnPage(show_loading = 0){
    var sidebar = $('.check-seo');
    var keyword = $('#keyword_seo').val();
    if(keyword != '' && keyword != undefined){
        var keyword = $('#keyword_seo').val();
        var secondary_key = $('#secondary_key').val();
        var title_seo = $('#meta_title').val();
        var des_seo = $('#meta_description').val();
        var category_id = $('#category_id').val();
        var slug = $('#slug').val();
        var post_id = $('#post_id').val();
        var table_name = $('#post_id').data('table');
        var detail = window.editor['detail'].getData() || $('textarea[name="detail"]').val();
        var dataForm = new FormData;

        dataForm.append('keyword',keyword);
        dataForm.append('detail',detail);
        dataForm.append('title_seo',title_seo);
        dataForm.append('des_seo',des_seo);
        dataForm.append('slug',slug);
        dataForm.append('post_id',post_id);
        dataForm.append('secondary_key',secondary_key);
        dataForm.append('category_id',category_id);
        dataForm.append('table_name',table_name);
        $('.check_primary_keyword').removeClass('active').removeClass('danger').find('p').remove();
        $.ajax({
            url:'/admin/ajax/checkSEOPost',
            type:'POST',
            dataType:'JSON',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data:dataForm,
            processData: false,
            contentType: false,
            beforeSend:function(){
                if(show_loading == 1){
                    loadingBox('open');
                }
            },
            success:function(rest){
                if(rest.status == 1){
                    $('#point_seo').val(rest.point);
                    $('.seo_bar_nav p').text(rest.point);
                    $('#seo_point').val(rest.point).change();
                    $('#count-word').html(rest.total_word);
                    $('#count-heading').html(rest.count_heading);
                    $('#count-internal').html(rest.countTagLinks.totalInternal || 0);
                    $('#count-external').html(rest.countTagLinks.totalExternal || 0);
                    (option.series[0].data[0].value = +(rest.point).toFixed(0)), myChart.setOption(option, !0);
                    option && "object" == typeof option && myChart.setOption(option, !0);

                    // each li check list seo
                    $(rest.check_list).each(function(i,value){
                        var stt = i+1;
                        var item1 = $('.check-list-seo > ul > li:nth-child('+stt+')');
                        item1.removeAttr('class');
                        if(value.status == 1){
                            item1.addClass('success_check_seo');
                        }else if(value.status == 2){
                            item1.addClass('warning_check_seo');
                        }else{
                            item1.addClass('error_check_seo');
                        }
                        $(value.check).each(function(i2,value2){
                            var stt2 = i2+1;
                            var item2 = item1.find('li:nth-child('+stt2+')');
                            item2.removeAttr('class');
                            if(value2 == 1){
                                item2.addClass('success_check_seo');
                            }else if(value2 == 2){
                                item2.addClass('warning_check_seo');
                            }else{
                                item2.addClass('error_check_seo');
                            }
                        });
                    });
                    if(rest.checkPrimaryKey.status === true) {
                        $('.check_primary_keyword').addClass('active');
                    } else {
                        $('.check_primary_keyword').addClass('danger');
                        $('.check_primary_keyword').append(`<p>Từ khóa bị trùng (<a href="${rest.checkPrimaryKey.postLink || ''}">Xem bài viết</a>)</p>`);
                    }
                    let linkSuggest =  '';
                    $.each(rest.suggestInternalLink, function(index, value) {
                        linkSuggest += `<li>
                            <a href="${value.link}">${value.name}</a><b> Từ khóa: ${value.primaryKey}</b>
                            <span><i class="fa fa-link"></i><span >${value.count}</span></span>
                            </li>`;
                    });
                    $('.check_internal_title').css('display', 'none')
                    if(linkSuggest != '') {
                        $('.check_internal_title').css('display', 'block')
                    }
                    $('#check_internal').html(linkSuggest)
                }else{
                    alert(rest.messages);
                }
                loadingBox('close');
            }
        });
    }else{
        alert('Bạn phải nhập từ khóa chính.');
    }
}
function validURL(str) {
  var pattern = new RegExp('^(https?:\\/\\/)?'+ // protocol
    '((([a-z\\d]([a-z\\d-]*[a-z\\d])*)\\.)+[a-z]{2,}|'+ // domain name
    '((\\d{1,3}\\.){3}\\d{1,3}))'+ // OR ip (v4) address
    '(\\:\\d+)?(\\/[-a-z\\d%_.~+]*)*'+ // port and path
    '(\\?[;&a-z\\d%_.~+=-]*)?'+ // query string
    '(\\#[-a-z\\d_]*)?$','i'); // fragment locator
  return !!pattern.test(str);
}
$(document).ready(function(){
    $('body').on('click', '.seo_bar_nav', function(e) {
        $(this).parent().addClass('active');
    })
    $('body').on('click', '.seo_bar .close', function(e) {
        $(this).closest('.seo_bar').removeClass('active');
    })
    $('.check-list-seo li').on('click', function(){
        $(this).find('.tooltip_help_seo').slideToggle();
    });
    $('body').on('click', '.form-actions button[type="submit"]', function(e){
        let check = true;
        let countError = 0;
        $('.ck-content a').each(function(){
            let href= $(this).attr('href');
            let checkMce = $(this).closest('.mce-toc');
            let checkMceSudo = $(this).closest('.sudo-toc');
            if(href == undefined && (!checkMce.length && !checkMceSudo.length)) {
                check = false;
                $(this).css({'background-color': 'red', 'color': "#fff"})
                countError += 1;
            } else if(!checkMce.length && !checkMceSudo.length) {
                if(!validURL(href)) {
                    check = false;
                    $(this).css({'background-color': 'red', 'color': "#fff"})
                    countError += 1;
                }
            }
        })
        if(!check) {
            if(!confirm(`Có ${countError} đường dẫn (Link) bị lỗi sai cấu trúc, Các link lỗi được bôi đậm nền màu đỏ cần được chỉnh sửa. Bạn có chắc chắn vẫn muốn lưu bài viết này?`)) {
                e.preventDefault()
            }
        }
    })
});
