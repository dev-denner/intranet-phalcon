$('#cep').bind('blur', function () {

    var url = 'http://api.postmon.com.br/v1/cep/' + $('#cep').val();

    var ajax = $.ajax({
        method: 'GET',
        url: url,
    });
    ajax.success(function (returned) {

        $('#endereco').val(returned.logradouro);
        $('#bairro').val(returned.bairro);
        $('#cidade').val(returned.cidade);
        $('#uf').val(returned.estado);
    });

});