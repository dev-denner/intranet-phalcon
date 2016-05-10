var getEmailUser = function (e) {

    var cpf = $(e).val();

    if (cpf != '') {
        $.ajax({
            method: 'POST',
            dataType: "json",
            url: '/nucleo/users/infoUser',
            data: {cpf: cpf}
        }).success(function (returned) {
            $('.error_cpf').html('');
            $('#email').val(returned.EMAIL);
        }).fail(function (returned) {
            $('.error_cpf').html('CPF não cadastrado no sistema ERP da empresa. Por favor procure o administrador do sistema.');
        });
    }
}