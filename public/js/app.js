$(document).ready(function(){
    $("#form_submit").click(function(){
        $("#target_form").submit();
    });

    $("#form_category_submit").click(function(){
        $("#target_category_form").submit();
    });

    $(".delete_group").click(function(event){

        $("#btn_delete_group").prop('href', '/forum/group/' + event.target.id + '/delete');
    });
});