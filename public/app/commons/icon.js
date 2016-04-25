$(document).ready(function () {
    $('#icon').on("blur", function () {
        $('.icon-view i').removeClass();
        $('.icon-view i').addClass($('#icon').val());
    });
});