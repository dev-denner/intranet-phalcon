$('#cpf').bind('blur', function () {
    overlay(true);
    var cpf = $(this).val();

    $.ajax({
        method: 'POST',
        dataType: "json",
        url: base_url_intranet + '/nucleo/users/infoUserAjax',
        data: {
            search: cpf,
            all: true,
        }
    }).success(function (returned) {
        if (returned != false) {
            $('#nome').val(returned.NOME);
            $('#dt_nascimento').val(returned.DTNASCIMENTO);
            $('#funcao').val(returned.FUNCAO);
            $('#empresa').val(returned.EMPRESA);
            $('#email').val(returned.EMAILPP);
            $('#pis').val(returned.PISPASEP);
            $('#data_de_admissao').val(returned.DATA_ADMISSAO);
            $('#data_de_demissao').val(returned.DATA_DEMISSAO);
        }

        overlay(false);

    }).fail(function (returned) {
        overlay(false);
    });
});

$('#cep').bind('blur', function () {

    var url = 'http://api.postmon.com.br/v1/cep/' + $(this).val();

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

$(document).ready(function () {

    $('#empresa').bind('change', function () {
        if ($(this).val() == 'OUTROS') {
            $('#empresa_outros').attr('required', 'required').parents('.form-group').removeClass('hidden');
        } else {
            $('#empresa_outros').removeAttr('required').parents('.form-group').addClass('hidden');
        }
    });


    $('.tablist li a').bind('click', function () {
        $('#ppp, #informe_rendimentos, #outros').find('input, select').val('');
        $('#pis').val('');
        var tab = $(this).data('tab');
        $('#area_ativa').val(tab);

        if (tab != 'ppp') {
            $('#pis').removeAttr('required');
            $('#data_de_demissao').removeAttr('required');
        } else {
            $('#pis').attr('required', 'required');
            $('#data_de_demissao').attr('required', 'required');
        }

    });

});

/**
 *
 * @param {type} e
 * @returns {undefined}
 */
var addLinha = function (e) {
    var $linha = $(e).closest('tr').clone();
    var tr = $(e).closest('tr');

    tr.after($linha);
    $linha.find('input[type=text], input[type=hidden], select').val('');
    $linha.find('.waves-ripple').remove();

}

/**
 *
 * @param {type} e
 * @returns {undefined}
 */
var removeLinha = function (e) {

    if ($(e).parents('tbody').find('tr').length != 1) {
        var tr = $(e).closest('tr');
        tr.fadeOut(400, function () {
            tr.remove();
        });
    } else {
        $.notify({
            icon: 'fa fa-exclamation-triangle',
            title: "<strong>Não Permitido:</strong> ",
            message: "Ação não permitida!",
        }, {
            type: 'warning',
        });
    }
}