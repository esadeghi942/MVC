$('.deleteuser').click(function (e) {
    e.preventDefault();
    var conf=window.confirm('آیا برای حذف کاربر هستید؟')
    if(!conf)
        return;
    var id = $(this).data('id');
    var item=$(this);
    $.ajax({
        type: 'Post',
        url: 'adminUserDelete/',
        data: {'id':id},
        success: function (result) {
            result = $.parseJSON(result);
            message.show(result.status, result.message, 3000);
            if (result.status == 'success') {
                item.closest('tr').remove();
            }
        }
    });
});
