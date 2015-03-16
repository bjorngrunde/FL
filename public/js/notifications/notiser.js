$(document).ready(function() {
    var i = 0;
    var url = 'http://beta.thefamilylegion.se/';
    $.get(url+'notifications', function(data){
        $.each(data, function(index, value) {
            $('#notificationMenu').append(value.body);
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