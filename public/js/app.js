$(document).ready(function(){
    $("#form_submit").click(function(){
        $("#target_form").submit();
    });

    $("#form_category_submit").click(function(){
        $("#target_category_form").submit();
    });
    $("#form_comment_submit").click(function(){
        $("#target_comment_form").submit();
    });

    $("#btn_thread_move").click(function(){
        $("#target_move_form").submit();
    });

    $("#btn_thread_copy").click(function(){
        $("#target_copy_form").submit();
    });

    $("#form_comment_quote_submit").click(function(){
        $("#target_comment_quote_form").submit();
    });

    $(".delete_group").click(function(event){

        $("#btn_delete_group").prop('href', '/forum/group/' + event.target.id + '/delete');
    });

    $(".delete_category").click(function(event){

        $("#btn_delete_category").prop('href', '/forum/category/' + event.target.id + '/delete');
    });

    $(".delete_comment").click(function(event){

        $("#btn_delete_comment").prop('href', '/forum/comment/' + event.target.id + '/delete');
    });
    $(".delete_thread").click(function(event){

        $("#btn_delete_thread").prop('href', '/forum/thread/' + event.target.id + '/delete');
    });

    $(".leave_chat").click(function(event){

        $("#btn_leave_chat").prop('href', '/conversation/leave/' + event.target.id);
    });

    $("#btn_add_member").click(function(){
        $("#target_add_member").submit();
    });

    $("#form_comment_edit_submit").click(function(){
       $("#target_comment_edit_form").submit();
    });
    $('#comment-quote-form').on('show.bs.modal', function(e) {

        var commentId = $(e.relatedTarget).data('comment-id');
        var user = $(e.relatedTarget).data('comment-user');
        var url = 'http://beta.thefamilylegion.se/forum/getForumQuote/'+ commentId;

        $.get(url, function(data){
            /*console.log(data);*/
            $(e.currentTarget).find('.forum_editor').attr('value', '');
            $(e.currentTarget).find('.forum_editor').val("[quote]" + data + " @"+user + "[/quote]");
        });


    });

    $('#comment_edit_form').on('show.bs.modal', function(e) {

        var commentId = $(e.relatedTarget).data('comment-id');
        var url = 'http://beta.thefamilylegion.se/forum/getForumQuote/'+ commentId;

        $.get(url, function(data){
        $("#target_comment_edit_form").attr('action', '/forum/thread/comment/edit/'+commentId);
        $(e.currentTarget).find('.forum_edit_editor').val(data);
        });
    });
});
