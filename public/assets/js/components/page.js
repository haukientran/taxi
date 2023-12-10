$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
$(document).ready(function() {
    //slide video
    sudoSlide(
        'review_customer',
        [
            {'maxWidth': 99999999999999, 'minWidth': 0, 'qtyItem': 3, 'nextItem': 1},
            {'maxWidth': 1200, 'minWidth': 768, 'qtyItem': 3, 'nextItem': 1},
            {'maxWidth': 768, 'minWidth': 480, 'qtyItem': 3, 'nextItem': 1},
            {'maxWidth': 480, 'minWidth': 0, 'qtyItem': 2, 'nextItem': 1}
        ],
        true ,false, false, 5000, 1, 0, 1, 'data-thumnail');
    sudoSlide(
            'image_personnel',
            [
                {'maxWidth': 99999999999999, 'minWidth': 0, 'qtyItem': 3, 'nextItem': 1},
                {'maxWidth': 1200, 'minWidth': 480, 'qtyItem': 3, 'nextItem': 1},
                {'maxWidth': 480, 'minWidth': 0, 'qtyItem': 2, 'nextItem': 1}
            ],
            false ,true, false, 5000, 1, 15, 1, 'data-thumnail');
});
function loadSend(form) {
    if(validForm(form) == true) {
        var name = $('#'+form+' input[name="name"]').val();
        var type = $('#'+form+' input[name="type"]').val();
        var email = $('#'+form+' input[name="email"]').val();
        var phone = $('#'+form+' input[name="phone"]').val();
        var address = $('#'+form+' input[name="address"]').val();
        var note = $('#'+form+' textarea[name="note"]').val();
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: '/lien-he',
            method: "POST",
            data: {
                name:name,
                email:email,
                type:type,
                note:note,
                phone: phone,
                address: address,
            },
            beforeSend: function () {
                loadingBox('open');
            },
            success: function (data) {
                setTimeout(function(){
                    loadingBox('close');
                }, 2000);
                if (data.status === 'success') {
                    alert_show('success', data.message);
                } else {
                    alert_show('error', data.message);
                }
                $('#'+form+' .form-item input, #'+form+' .form-item textarea').val('');
            },
            error: function (error) {
                loadingBox('close');
                alert_show('error', $('#loading_box').data('error'));
            }
        })
    }
}
