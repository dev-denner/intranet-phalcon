$(document).ready(function () {
    $('#tipo').on('change', function () {

        $('#name, #cceo').val('');

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

            if (typeof returned == 'string') {
                $('.errors > p').html('Não foi possível identificar a origem dos dados desse usuário.<br>');
            } else {
                setTimeout(function () {
                    $('#name').val(returned.NOME);
                    $('#name').trigger('focus');
                }, 300);
                setTimeout(function () {
                    $('#cceo').val(returned.CCEO);
                    $('#cceo').trigger('focus');
                }, 300);


            }
        }).fail(function (returned) {
            console.log(returned);
            $('.errors > p').html('Não foi possível identificar a origem dos dados desse usuário.<br>');
        });
    }
}