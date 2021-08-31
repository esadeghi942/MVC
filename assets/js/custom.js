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
