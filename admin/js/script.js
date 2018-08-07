tinymce.init({ selector:'textarea' });

$(document).ready(function () {

    $('#selectAllBox').click(function(event){
        if (this.checked){
            $('.checkbox').each(function() {
                this.checked = true;
            });
        }else {
            $('.checkbox').each(function() {
                this.checked = false;
            });
        }
    });
});

function loadUserOnline() {
    $.get("admin_function.php?onlineusers=result", function(data) {
       $('.useronline').text(data);
    });
}
setInterval(function(){
    loadUserOnline();
},500);


