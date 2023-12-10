<div class="attribute-detail">
    <ul>
        <li class="li-first">
            <div class="attribute-detail__content">@lang('Tên thuộc tính')</div>
            <div class="attribute-detail__content">@lang('Đường dẫn')</div>
            <div class="attribute-detail__content">@lang('Màu')</div>
            <div class="attribute-detail__content">@lang('Hình ảnh')</div>
            <div class="attribute-detail__remove">@lang('Xóa')</div>
        </li>
        @if(isset($attribute_detail))
        @foreach($attribute_detail as $key => $value)
        <li>
            <div class="attribute-detail__content">
                <input type="text" data_attribute_detail_title name="attribute[{!! $value->id !!}][name][]" value="{!! $value->name !!}">
            </div>
            <div class="attribute-detail__content">
                <input type="text" data_attribute_detail_slug name="attribute[{!! $value->id !!}][slug][]" value="{!! $value->slug !!}">
            </div>
            <div class="attribute-detail__content">
                <input type="color" class="tags_color_code" name="attribute[{!! $value->id !!}][color_code][]" value="{!! $value->color_code !!}">
            </div>
            <div class="attribute-detail__content">
                <input type="hidden" name="attribute[{!! $value->id !!}][image][]" id="input-image_{!! $key !!}" value="{!! $value->image??'' !!}">
                <img style="cursor: pointer;width: 40px;max-height: 40px;" data-image="{{ route('media.index', ['uploads' => 'direct','only' => 'image']) }}&field_id=image_{!! $key !!}" src="{!! $value->image != '' ? $value->image : '/core/img/default_image.png' !!}" alt="" id="image_{!! $key !!}">
            </div>
            <div class="attribute-detail__remove"><i class="bx bx-trash"></i></div>
        </li>
        @endforeach
        @endif
        <li class="li-last">
            <a href="javascript:;" title="" id="add-attribute-detail">@lang('Thêm chi tiết thuộc tính')</a>
        </li>
    </ul>
</div>
<script>
    $(document).ready(function(){
        @if(isset($attribute_detail))
            var i = {{count($attribute_detail)}};
        @else
            var i = 0;
        @endif
        $('body').on('click', '#add-attribute-detail',function(){
            i++;
            var html =  '<li>'+
                        '<div class="attribute-detail__content"><input type="text" data_attribute_detail_title name="attribute[0][name][]"></div>'+
                        '<div class="attribute-detail__content"><input type="text" data_attribute_detail_slug name="attribute[0][slug][]"></div>'+
                        '<div class="attribute-detail__content"><input type="color" class="tags_color_code" name="attribute[0][color_code][]" value=""></div>'+
                        '<div class="attribute-detail__content">'+
                        '<input type="hidden" name="attribute[0][image][]" id="input-image_'+i+'" value="">'+
                        '<img style="cursor: pointer;width: 40px;max-height: 40px;" data-image="{{ route('media.index', ['uploads' => 'direct','only' => 'image']) }}&field_id=image_'+i+'" src="/core/img/default_image.png" alt="" id="image_'+i+'">'+
                        '</div>'+
                        '<div class="attribute-detail__remove"><i class="bx bx-trash"></i></div>'+
                        '</li>';
            $('.li-last').before(html);
        });
        $('body').on('click', '.attribute-detail__remove i',function(){
            $(this).parents('li').remove();
        });
        $('body').on('keyup', '*[data_attribute_detail_title]', function(){
            var title = $(this).val();
            var slug = convertToSlug(title);
            $(this).parents('li').find('[data_attribute_detail_slug]').val(slug);
        });
        $('.attribute-detail ul').sortable();
    });
    
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
</script>