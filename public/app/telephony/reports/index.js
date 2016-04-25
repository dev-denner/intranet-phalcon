$(document).ready(function () {

    $('#relatorios').on('change', function () {
        if ($('#relatorios').val() >= 3) {
            $('#valor').attr('disabled', false);
        } else {
            $('#valor').attr('disabled', true);
        }
    });
});