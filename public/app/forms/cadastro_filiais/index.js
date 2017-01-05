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
        $('#codMunicipio').val(returned.cidade_info.codigo_ibge);
    });

});

$('#cepCobranca').bind('blur', function () {

    var url = 'http://api.postmon.com.br/v1/cep/' + $('#cepCobranca').val();

    var ajax = $.ajax({
        method: 'GET',
        url: url,
    });
    ajax.success(function (returned) {

        $('#enderecoCobranca').val(returned.logradouro);
        $('#bairroCobranca').val(returned.bairro);
        $('#cidadeCobranca').val(returned.cidade);
        $('#ufCobranca').val(returned.estado);
    });

});

$(document).ready(function () {

    $('input[name="Endereço de Cobrança mesmo de entrega"]').bind('click', function () {
        var enderecoCobranca = $('input[name="Endereço de Cobrança mesmo de entrega"]:checked').val();

        if (enderecoCobranca == 'Não') {
            $(".enderecoCobrancaBox").fadeIn().find('input').attr('required', 'required');
        } else {
            $(".enderecoCobrancaBox").fadeOut().find('input').removeAttr('required');
        }
    });

});