/*
    Made by: @kanalumaddela
*/
$(".button-collapse").sideNav();
$('select').material_select();
$('.tooltipped').tooltip({
    delay: 50
});
$('.modal').modal({
    dismissible: false,
    inDuration: 300,
    outDuration: 200
});
function checkBackgroundType() {
    var type_default = document.getElementById("bg_type_default").checked;
    var type_color = document.getElementById("bg_type_color").checked;
    if ( type_default === true || type_color === true ) {
        $('#background_image').parent().fadeOut(500);
    } else {
        $('#background_image').parent().fadeIn(500);
    }
}
$('.tool').click( function(){
    user_type = $(this).data('user_type');
    user_action = $(this).data('post');
    arraydata = [];
    if (user_type == 'member') {
        if (user_action == 'save_theme') {
            arraydata = [
                $('#theme').val(),
                $("input:radio[name ='background_type']:checked").val(),
                $('#background_image').val(),
                $('#color_bg').val(),
                $('#color_text').val(),
                $('#color_primary').val(),
                $('#color_secondary').val()
            ];
        }
        if (user_action == 'save_media') {
            arraydata = [
                $('#media_volume').val(),
                $("input:radio[name ='music_type']:checked").val(),
                $('#media_yt_playlist').val()
            ];
        }
    }
    if (user_type == 'admin') {
        if (user_action == 'ban_user') {
            var steamid1 = $('#steamid1').val();
            if (typeof(steamid1) != 'undefined' && steamid1.length > 0) {
                arraydata = [steamid1];
            } else {
                $('#modal_bottom_text').html('Please enter a steamid');
                return;
            }
        }
        if (user_action == 'unban_user') {
            var steamid2 = $('#steamid2').val();
            if (typeof(steamid2) != 'undefined' && steamid2.length > 0) {
                arraydata = [steamid2];
            } else {
                $('#modal_bottom_text').html('Please enter a steamid');
                return;
            }
        }
    }
    $.post('./action.php', {
        type: user_type,
        action: user_action,
        data: arraydata
    } , function(data,status){
        $('#modal_bottom_text').html(data);
    });
});
function fixbasepath() {
    $.get("../", function(data){});
}