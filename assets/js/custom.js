(function(win){
    var message = (function(){
        var template = '<div class=\'alert alert-{{type}} alert-dismissible\'>\n' +
            '                              <button type=\'button\' class=\'close\' data-dismiss=\'alert\' aria-hidden=\'true\'>×</button>\n' +
            '                              {{msg}}</div>';
        function show(type, msg, delay){
            if(!$('#app-messages').length){
                $('body .card-body').prepend('<div id="app-messages"></div>');
            }
            var message_str = template;
            message_str = message_str.replace(/{{type}}/g, type).replace(/{{msg}}/g, msg);
            $('#app-messages').append(message_str);
            if(delay){
                $('#app-messages').fadeIn(50).delay(delay).fadeOut(500, function(){
                    $(this).remove();
                });
            }else{
                $('#app-messages').fadeIn(50);
            }
        }
        function hide(){
            $('#app-messages').stop().fadeOut(500).remove();
        }
        return {
            show: show,
            hide: hide
        }
    })();
    if(!win.message) win.message = message;
})(window);

function log($str){
    console.log($str);
}
$(document).on('click','.close',function (e){
    e.preventDefault();
    $(this).closest('#app-messages').remove();
});

$('.deletefile').click(function (e) {
    e.preventDefault();
    var conf=window.confirm('آیا برای حذف فایل مطمئن هستید؟')
    if(!conf)
        return;
    var id = $(this).data('file');
    var item=$(this);
    $.ajax({
        type: 'Post',
        url: 'userFileDelete/',
        data: {'id':id},
        success: function (result) {
            result = $.parseJSON(result);
            message.show(result.status, result.message, 3000);
            if (result.status == 'success') {
                item.closest('.item').remove();
            }
        }
    });
});

$('.deleterequest').click(function (e) {
    e.preventDefault();
    var conf=window.confirm('آیا برای حذف درخواست مطمئن هستید؟')
    if(!conf)
        return;
    var id = $(this).data('id');
    var item=$(this);
    $.ajax({
        type: 'Post',
        url: 'userRequestDelete/',
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
$('.deletebug').click(function (e) {
    e.preventDefault();
    var conf=window.confirm('آیا برای حذف اعلام خرابی مطمئن هستید؟')
    if(!conf)
        return;
    var id = $(this).data('id');
    var item=$(this);
    $.ajax({
        type: 'Post',
        url: 'userBugDelete/',
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
$('.deletecomment').click(function (e) {
    e.preventDefault();
    var conf=window.confirm('آیا برای حذف تیکت مطمئن هستید؟')
    if(!conf)
        return;
    var id = $(this).data('id');
    var item=$(this);
    $.ajax({
        type: 'Post',
        url: 'commentDelete/',
        data: {'id':id},
        success: function (result) {
            result = $.parseJSON(result);
            message.show(result.status, result.message, 3000);
            if (result.status == 'success') {
                item.closest('li').remove();
            }
        }
    });
});
