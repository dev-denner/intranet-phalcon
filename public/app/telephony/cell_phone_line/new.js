$(document).ready(function () {
    $('#tipo').on('change', function () {

        $('#name, #cceo, #cpf').val('');

        if ($('#tipo').val() != 'Colaborador') {
            $('#name, #cceo').removeAttr('readonly');
        } else {
            $('#name, #cceo').attr('readonly', 'readonly');
        }
    });

    $('#cpf').on('blur', function () {

        $('#name, #cceo').val('');

        getInfoUser();
    });

});

var getInfoUser = function () {

    var cpf = $('#cpf').val();
    $('.errors > p').html('');

    if (cpf != '') {
        $.ajax({
            method: 'POST',
            dataType: "json",
            url: '/nucleo/users/infoUser',
            data: {cpf: cpf}
        }).success(function (returned) {
            $('#tipo').val('Colaborador');
            setTimeout(function () {
                $('#name').val(returned.NOME);
                $('#name').trigger('focus');
            }, 300);
            setTimeout(function () {
                $('#cceo').val(returned.CCEO);
                $('#cceo').trigger('focus');
            }, 400);
        }).fail(function (returned) {
            if ($('#tipo').val() == 'Colaborador') {
                $('.errors > p').html('Não foi possível identificar a origem dos dados desse usuário.<br>');
            }
        });
    }
}

var validaAccessLine = function () {

    return false;
}