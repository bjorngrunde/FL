$(document).ready(function() {
    var i = 0;
    var url = 'http://178.62.115.229/';
    $.get(url+'notifications', function(data){
        $.each(data, function(index, value) {
            $('#notificationMenu').append('<li><a href="#" class="dark-sh-well-no-radius">' + value.body +'</a></li>');
            if(value.is_read == 0)
            {
                i++;
            }
        })
        if(i != 0)
        {
            $('.badge-notify').append(i);
        }
    })
    $('#notification').click(function(e) {
        e.preventDefault();
        if(i != 0)
        {
            if(! $('.badge-notify').hasClass('hidden'))
            {
                $('.badge-notify').addClass('hidden');
            }
        }
        $.get(url+'removereadnotifications', function(data){
            console.log(data);
        })
    })
});