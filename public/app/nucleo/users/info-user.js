var getInfoUser = function (e) {

    var cpf = $(e).val();
    $('.errors > p').html('');
    $('.info-user').hide('slow');

    if (cpf != '') {
        $.ajax({
            method: 'POST',
            dataType: "json",
            url: '/nucleo/users/infoUser',
            data: {cpf: cpf}
        }).success(function (returned) {

            if (typeof returned == 'string') {
                $('.errors > p').html('Não foi possível identificar a origem dos dados desse usuário.<br>');
                $('#email').val('');
            } else {
                $('.info-user').show('slow');
                $.each(returned, function (index, value) {
                    $('.data-' + index).html(value);
                });
                $('#email').val(returned.EMAIL);
            }
        }).fail(function (returned) {
            $('.errors > p').html('Não foi possível identificar a origem dos dados desse usuário.<br>');
            $('#email').val('');
        });
    }
}