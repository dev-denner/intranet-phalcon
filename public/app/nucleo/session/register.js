var getEmailUser = function (e) {

    var cpf = $(e).val();

    if (cpf != '') {
        $.ajax({
            method: 'POST',
            dataType: "json",
            url: '/nucleo/users/infoUser',
            data: {cpf: cpf}
        }).success(function (returned) {
            $('#email').val(returned.EMAIL);
        }).fail(function (returned) {

        });
    }
}