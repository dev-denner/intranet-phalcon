var getEmailUser = function (e) {

    var cpf = $(e).val();
    $('.error_cpf').html('');
    $('#email').val('');

    if (cpf != '') {
        $.ajax({
            method: 'POST',
            dataType: "json",
            url: base_url_intranet + '/nucleo/users/infoUserAjax',
            data: {search: cpf}
        }).success(function (returned) {
            if (returned.EMAIL == null) {
                $('.error_cpf').html('Não há e-mail associado a esse CPF. <br />Por favor entre em contato com a Central de Serviços de TIC e Processos pelo e-mail <b>suporte@grupompe.com.br</b>.');
            } else {
                $('#email').val(returned.EMAIL);
                $('#email').trigger('focus');
            }
        }).fail(function (returned) {
            $('.error_cpf').html('CPF não encontrado no cadastro de Colaboradores!');
        });
    }
}