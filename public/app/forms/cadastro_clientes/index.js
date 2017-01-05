$(document).ready(function () {

    $('input[name="Pessoa"]').bind('click', function () {

        $('#cnpjCpf').inputmask('remove');

        var pessoa = $('input[name="Pessoa"]:checked').val();

        if (pessoa == 'Física') {
            $("#cnpjCpf").inputmask({"mask": "999.999.999-99", "placeholder": " "});
        } else {

            $("#cnpjCpf").inputmask({"mask": "99.999.999/9999-99", "placeholder": " "});
        }
    });
});

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