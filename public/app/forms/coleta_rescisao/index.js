$(document).ready(function () {

    $(".fileUploadAlt").fileinput({
        language: "pt-BR",
        previewFileType: "any",
        allowedFileTypes: ["pdf"],
        previewClass: "bg-default",
        showUpload: false,
        maxFilePreviewSize: 512
    });

    $('input[name="Percentual de Pensão"]').bind('click', function () {
        var percentual_pensao = $('input[name="Percentual de Pensão"]:checked').val();
        if (percentual_pensao == 'Sim') {
            $("#percentual_pensao").removeAttr('disabled').attr('required', 'required');
        } else {
            $("#percentual_pensao").removeAttr('required').attr('disabled', 'disabled');
        }
    });

    $('input[name="Aviso Prévio"]').bind('click', function () {
        var aviso_previo = $('input[name="Aviso Prévio"]:checked').val();
        if (aviso_previo == 'Trabalhado') {
            $("#data_inicio").removeAttr('disabled').attr('required', 'required');
        } else {
            $("#data_inicio").removeAttr('required').attr('disabled', 'disabled').val('');
        }
    });

    $('input[name="Tipo de Desligamento"]').bind('click', function () {
        var tipo_desligamento = $('input[name="Tipo de Desligamento"]:checked').val();
        if (tipo_desligamento == 'Justa Causa') {
            $("#justa_causa").removeAttr('disabled').attr('required', 'required');
        } else {
            $("#justa_causa").removeAttr('required').attr('disabled', 'disabled').val('');
        }
    });

});

$('#cpf').bind('blur', function () {
    overlay(true);
    var ajax = $.ajax({
        method: 'POST',
        dataType: "json",
        url: base_url_intranet + '/nucleo/users/infoUserAjax',
        data: {
            search: $(this).val(),
            all: true,
        },
    });
    ajax.success(function (returned) {

        $('#filial').val(returned.CODFILIAL + ' - ' + returned.FILIAL);
        $('#secao').val(returned.CODSECAO + ' - ' + returned.SECAO);
        $('#nome').val(returned.NOME);
        $('#data_admissao').val(returned.DATA_ADMISSAO);
        $('#matricula').val(returned.CHAPA);
        $('#pis').val(returned.PISPASEP);

        $('#salario').val(floatToString(returned.SALARIO)).trigger('blur');
        overlay(false);
    });
    ajax.fail(function (returned) {
        $('#filial').val('');
        $('#secao').val('');
        $('#nome').val('');
        $('#data_admissao').val('');
        $('#matricula').val('');
        $('#pis').val('');
        $('#salario').val('');
        overlay(false);
    });

});

/**
 *
 * @param {type} n
 * @param {type} c
 * @param {type} d
 * @param {type} t
 * @returns {@var;t|s|@var;d|String}
 */
var floatToString = function (n, c, d, t) {
    c = isNaN(c = Math.abs(c)) ? 2 : c,
            d = d == undefined ? "," : d,
            t = t == undefined ? "." : t,
            s = n < 0 ? "-" : "",
            i = parseInt(n = Math.abs(+n || 0).toFixed(c)) + "",
            j = (j = i.length) > 3 ? j % 3 : 0;

    return s + (j ? i.substr(0, j) + t : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t) + (c ? d + Math.abs(n - i).toFixed(c).slice(2) : "");
}

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

/**
 *
 * @param {type} sequence
 * @returns {undefined}
 */
var enviarRequisicao = function (sequence) {

    swal({
        title: "Enviar remessa agora?",
        text: "Você está prestes a enviar este lote de rescisões para a Matriz. Após isso você não poderá incluir mais colaboradores nesta remessa.",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        confirmButtonText: "Sim",
        cancelButtonClass: "btn-success",
        cancelButtonText: "Não",
        closeOnConfirm: false,
        closeOnCancel: false,
        showLoaderOnConfirm: true,
    }, function (isConfirm1) {
        if (isConfirm1) {
            var ajax = $.ajax({
                method: 'POST',
                dataType: "json",
                data: {
                    sequence: sequence
                },
                url: base_url_intranet + '/forms/coleta_rescisao/sendForm/',
            });
            ajax.success(function (returned) {
                swal({
                    title: "Enviado!",
                    text: "O lote de rescisões foi enviado para matriz. Você receberá, em breve, um e-mail contendo as informações dessa solicitação.",
                    type: "success"
                }, function (isConfirm2) {
                    overlay(true);
                    location.reload();
                });

            });
            ajax.fail(function (returned) {
                location.reload();
            });
        } else {
            swal("Cancelado", "Lote não enviado.", "error");
        }
    });
}