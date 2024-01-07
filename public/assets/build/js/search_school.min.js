$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
$(document).ready(function() {
    // bộ lọc tìm kiếm
    // Sự kiện onchange cho phần tử select
    $(".filter-select").on("change", function () {
        let value = $(this).find("option:selected").val();
        let id = $(this).data('id');
        let paramName = `filter_${id}`;
        loadUrl(paramName, value);
    });
    $('body').on('click', '.filter-search', function(e) {
        loadProduct('empty');
    });
    // sự kiện xem thêm sản phẩm
     var page = 1;
     $('body').on('click','.button-action .view_school',function(){
        $type = $(this).data('hidden');
        if ($type) {
            // Load lại trang
            location.reload();
        }else {
            pushOrUpdate({ page: ++page, });
        }
        loadProduct('append');
    });
});
function loadUrl(name, value) {
    var url = $('#current_url').val();
    // Xử lý phần cuối của URL (nếu cần)
    if (url.lastIndexOf('&page') !== -1) {
        url = url.split('&page')[0];
    }
    if (url.lastIndexOf('?page') !== -1) {
        url = url.split('?page');
        url = url[0];
    }
    var urlObj = new URL(url);
    // Xóa tham số nếu tồn tại
    if (urlObj.searchParams.has(name)) {
        urlObj.searchParams.delete(name);
    }

    // Thêm tham số mới
    urlObj.searchParams.append(name, value);
    // Lấy URL mới sau khi cập nhật
    var newUrl = urlObj.origin + urlObj.pathname + urlObj.search;

    // Cập nhật giá trị của phần tử có id là "current_url" với URL mới
    $('#current_url').val(newUrl);
}
