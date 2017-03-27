$(document).ready(function(){
    var hover = false;
    $('#user').click(function(){
        open();
    });
    function open() {
        if (!$('#ddmenu').hasClass('visible')) {
            $('#ddmenu').removeClass('hidden').addClass("visible");
        } else {
            $('#ddmenu').removeClass("visible").addClass('hidden');
        }
    }
});
