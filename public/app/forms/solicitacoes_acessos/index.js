var liberado_portal_rh = true;

$('#cpf').bind('blur', function () {
    overlay(true);
    var cpf = $('#cpf').val();
    $('.errors_colaborador').html('');
    $('.infomations_colaborador').html('<p class="text-center"><i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i><span class="sr-only">Loading...</span></p>');

    var msg_error = 'CPF não encontrado no Banco de Dados.<br>Caso seja um novo colaborador, realizar uma nova solicitação no prazo de 1 (um) dia útil.';

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
            var template = '<dl class="dl-horizontal">';
            template += '<dt>Nome:</dt><dd>' + returned.NOME + '</dd>';
            template += '<dt>Data Nascimento:</dt><dd>' + returned.DTNASCIMENTO + '</dd>';
            template += '<dt>Empresa:</dt><dd>' + returned.EMPRESA + '</dd>';
            template += '<dt>Filial:</dt><dd>' + returned.FILIAL + '</dd>';
            template += '<dt>Matrícula:</dt><dd>' + returned.CHAPA + '</dd>';
            template += '<dt>Data Admissão:</dt><dd>' + returned.DATA_ADMISSAO + '</dd>';
            template += '<dt>Função:</dt><dd>' + returned.FUNCAO + '</dd>';
            template += '<dt>Centro de Custo:</dt><dd>' + returned.CCEO + ' - ' + returned.DESCCCEO + '</dd>';
            template += '<dt>Seção:</dt><dd>' + returned.CODSECAO + ' - ' + returned.SECAO + '</dd>';
            if (returned.EMAIL != null) {
                template += '<dt>E-mail:</dt><dd>' + returned.EMAIL + '</dd>';
                $('#email_colaborador').val(returned.EMAIL);
            }
            template += '</dl>';

            $('.infomations_colaborador').html(template);
            $('#info_colaborador').val(template);

            $('#nome_colaborador').val(returned.NOME);
        } else {
            $('#cpf').val('');
            $('.errors_colaborador').html(msg_error);
            $('.infomations_colaborador').html('<p class="text-center">Digite o CPF</p>');
            $('#info_colaborador').val('');
            $('#email_colaborador').val('');
            $('#nome_colaborador').val('');
        }

        overlay(false);

    }).fail(function (returned) {
        $('#cpf').val('');
        $('.errors_colaborador').html(msg_error);
        $('.infomations_colaborador').html('<p class="text-center">Digite o CPF</p>');
        $('#info_colaborador').val('');
        $('#email_colaborador').val('');
        $('#nome_colaborador').val('');
        overlay(false);
    });
});

$('#email_gestor').bind('blur', function () {
    overlay(true);
    var email = $('#email_gestor').val();
    $('.errors_gestor').html('');
    $('.infomations_gestor').html('<p class="text-center"><i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i><span class="sr-only">Loading...</span></p>');

    $.ajax({
        method: 'POST',
        dataType: "json",
        url: base_url_intranet + '/nucleo/users/infoUserAjax',
        data: {
            search: email,
            all: true,
        }
    }).success(function (returned) {

        if (returned != false) {
            var template = '<dl class="dl-horizontal">';
            template += '<dt>Nome:</dt><dd>' + returned.NOME + '</dd>';
            template += '<dt>Empresa:</dt><dd>' + returned.EMPRESA + '</dd>';
            template += '<dt>Filial:</dt><dd>' + returned.FILIAL + '</dd>';
            template += '<dt>Matrícula:</dt><dd>' + returned.CHAPA + '</dd>';
            template += '<dt>Função:</dt><dd>' + returned.FUNCAO + '</dd>';
            template += '<dt>Centro de Custo:</dt><dd>' + returned.CCEO + ' - ' + returned.DESCCCEO + '</dd>';
            template += '</dl>';

            $('.infomations_gestor').html(template);
            $('#info_gestor').val(template);
            $('#email_gestor_h').val(returned.EMAIL);
            $('#nome_gestor').val(returned.NOME);
        } else {
            $('#email_gestor').val('');
            $('.errors_gestor').html('E-mail não foi encontrado no Banco de Dados.');
            $('.infomations_gestor').html('<p class="text-center">Digite o E-mail</p>');
            $('#info_gestor').val('');
            $('#email_gestor_h').val('');
            $('#nome_gestor').val('');
        }
        overlay(false);

    }).fail(function (returned) {
        $('#email_gestor').val('');
        $('.errors_gestor').html('E-mail não foi encontrado no Banco de Dados.');
        $('.infomations_gestor').html('<p class="text-center">Digite o E-mail</p>');
        $('#info_gestor').val('');
        $('#email_gestor_h').val('');
        $('#nome_gestor').val('');
        overlay(false);
    });
});

$('#empresas').bind('change', function () {

    $.ajax({
        method: 'POST',
        dataType: "json",
        url: base_url_intranet + '/forms/solicitacoes_acessos',
        data: {
            empresa: $('#empresas').val(),
        }
    }).success(function (returned) {
        var template = '';
        $.each(returned, function (index, value) {
            template += '<option value="' + value.CODEMPRESA + value.CODFILIAL + ' - ' + value.EMPRESA + ' / ' + value.FILIAL + '" selected="selected">' + value.CODFILIAL + ' ' + value.FILIAL + '</option>'
        });

        $('#filiais').html(template);

    }).fail(function (returned) {
        $('#filiais').html('Erro desconhecido');
    });

});

var addProtheus = function () {
    var filial = $('#filiais').val();
    var template = '<option value="' + filial + '" selected="selected">' + filial + '</option>';
    $('#adicionados').append(template);

    var value = '';
    $("#adicionados option").each(function () {
        value += $(this).text() + ';'
    });

    $('#adicionados_hidden').val(value + filial + ';');


}

var removeProtheus = function () {
    var item = $('#adicionados').val();
    $("#adicionados option[value='" + item + "']").remove();

    var value = '';
    $("#adicionados option").each(function () {
        value += $(this).text() + ';'
    });
    $('#adicionados_hidden').val(value);

}

$(document).ready(function () {

    $('input, select').bind('click', function () {
        $(this).parents('.form-group').removeClass('has-error').find('.help-block').html('');
    });
    $('input[name="justificativa"]').bind('click', function () {
        $('#justificativa_outros').parents('.form-group').removeClass('has-error').find('.help-block').html('');
    });
    $('#servico_email, #servico_sistemas, #servico_matriz, #servico_sistemas_protheus, #servico_sistemas_rm, #servico_sistemas_ecm, #servico_sistemas_bi, #servico_sistemas_otrs, #servico_matriz_rede, #servico_matriz_catraca').bind('click', function () {
        $('.errors').html('');
        $('.errors_sistemas').html('');
        $('.errors_matriz').html('');
    });
    $('input[name="justificativa"]').bind('click', function () {
        var justificativa = $('input[name="justificativa"]:checked').val();
        if (justificativa == 'Outros') {
            $("#justificativa_outros").removeAttr('disabled').attr('placeholder', 'Digite justificativa').attr('required', 'required');
        } else {
            $("#justificativa_outros").removeAttr('placeholder').removeAttr('required').attr('disabled', 'disabled');
        }
    });

    $('#servico_email').click(function () {
        if ($('#servico_email').prop('checked')) {
            $('#servico_email_box').fadeIn();
        } else {
            $('#servico_email_box').fadeOut();
        }
    });

    $('#servico_sistemas').click(function () {
        if ($('#servico_sistemas').prop('checked')) {
            $('#servico_sistemas_box').fadeIn('slow');
        } else {
            $('#servico_sistemas_box').fadeOut('slow');
        }
    });

    $('#servico_sistemas_protheus').click(function () {
        if ($('#servico_sistemas_protheus').prop('checked')) {
            $('.servico_sistemas_protheus_box').fadeIn('slow');
        } else {
            $('.servico_sistemas_protheus_box').fadeOut('slow');
        }
    });

    $('#servico_sistemas_rm').click(function () {
        if ($('#servico_sistemas_rm').prop('checked')) {
            $('.servico_sistemas_rm_box').fadeIn('slow');
        } else {
            $('.servico_sistemas_rm_box').fadeOut('slow');
        }
    });

    $('input[name="modulos_rm[]"]').bind('click', function () {
        var modulos_rm = $('input[name*="modulos_rm"]:checked');
        var id = 0;
        var vl = '';
        $.each(modulos_rm, function (index, value) {
            id = index;
            vl = $(value).val();
        });

        if (id == 0 && vl == 'Portal RH') {
            $('input[name*="perfils_rm"]').each(
                    function () {
                        $(this).prop("checked", false).attr('disabled', 'disabled');
                    }
            );
            liberado_portal_rh = false;
        } else {
            //$('input[name*="coligadas"]').removeAttr('disabled');
            $('input[name*="perfils_rm"]').removeAttr('disabled');
            liberado_portal_rh = true;
        }
    });

    $('#servico_sistemas_ecm').click(function () {
        if ($('#servico_sistemas_ecm').prop('checked')) {
            $('.servico_sistemas_ecm_box').fadeIn('slow');
        } else {
            $('.servico_sistemas_ecm_box').fadeOut('slow');
        }
    });

    $('#servico_sistemas_bi').click(function () {
        if ($('#servico_sistemas_bi').prop('checked')) {
            $('.servico_sistemas_bi_box').fadeIn('slow');
        } else {
            $('.servico_sistemas_bi_box').fadeOut('slow');
        }
    });

    $('#servico_sistemas_otrs').click(function () {
        if ($('#servico_sistemas_otrs').prop('checked')) {
            $('.servico_sistemas_otrs_box').fadeIn('slow');
        } else {
            $('.servico_sistemas_otrs_box').fadeOut('slow');
        }
    });

    $('#servico_matriz').click(function () {
        if ($('#servico_matriz').prop('checked')) {
            $('#servico_matriz_box').fadeIn('slow');
        } else {
            $('#servico_matriz_box').fadeOut('slow');
        }
    });

    $('#servico_matriz_rede').click(function () {
        if ($('#servico_matriz_rede').prop('checked')) {
            $('.servico_matriz_rede_box').fadeIn('slow');
        } else {
            $('.servico_matriz_rede_box').fadeOut('slow');
        }
    });

    $('#servico_matriz_catraca').click(function () {
        if ($('#servico_matriz_catraca').prop('checked')) {
            $('.servico_matriz_catraca_box').fadeIn('slow');
        } else {
            $('.servico_matriz_catraca_box').fadeOut('slow');
        }
    });

});

var validaForm = function (e) {
    overlay(true);

    var flag = true;

    if ($('#cpf').val() == '') {
        flag = false;
        $('#cpf').parents('.form-group').addClass('has-error').find('.help-block').html('Campo <b>obrigatório</b>!');
    }

    if ($('input[name="localizacao"]:checked').length == 0) {
        flag = false;
        $('input[name="localizacao"]').parents('.form-group').addClass('has-error').find('.help-block').html('<b>Escolha uma opção!</b>');
    }

    if ($("input[name='justificativa']:checked").length == 0) {
        flag = false;
        $('input[name="justificativa"]').parents('.form-group').addClass('has-error').find('.help-block').html('<b>Escolha uma opção!</b>');
    } else {
        if ($("input[name='justificativa']:checked").val() == 'Outros'
                && $('#justificativa_outros').val() == '') {
            flag = false;
            $('#justificativa_outros').parents('.form-group').addClass('has-error').find('.help-block').html('Campo <b>obrigatório</b>!');
        }
    }

    if ($('#email_gestor').val() == '') {
        flag = false;
        $('#email_gestor').parents('.form-group').addClass('has-error').find('.help-block').html('Campo <b>obrigatório</b>!');
    }

    if ($('#email_gestor').val() == $('#email_colaborador').val()) {
        flag = false;
        $('#email_gestor').parents('.form-group').addClass('has-error').find('.help-block').html('E-mails de Colaborador e Gestor iguais. Por favor insira outra conta de e-mail para o gestor.');
    }

    if (!$('#servico_email').prop('checked')
            && !$('#servico_sistemas').prop('checked')
            && !$('#servico_matriz').prop('checked')) {
        flag = false;
        $('.errors').html('Escolha uma das opções abaixo!');
    }

    if ($('#servico_email').prop('checked')) {
        if ($("input[name='acao_email']:checked").length == 0) {
            flag = false;
            $('input[name="acao_email"]').parents('.form-group').addClass('has-error').find('.help-block').html('<b>Escolha uma opção!</b>');
        }
        if ($("input[name='acao_email']:checked").val() == 'Bloquear Conta'
                && $('#email_colaborador').val() == '') {
            flag = false;
            $('input[name="acao_email"]').parents('.form-group').addClass('has-error').find('.help-block').html('O CPF do colaborador não está vinculado a nenhuma conta de e-mail na base de dados. Por favor entre em contato com o administrador do sistema.');
        }
    }

    if ($('#servico_sistemas').prop('checked')) {

        if (!$('#servico_sistemas_protheus').prop('checked')
                && !$('#servico_sistemas_rm').prop('checked')
                && !$('#servico_sistemas_ecm').prop('checked')
                && !$('#servico_sistemas_bi').prop('checked')
                && !$('#servico_sistemas_otrs').prop('checked')
                ) {
            flag = false;
            $('.errors_sistemas').html('Escolha uma das opções abaixo!');
        }

        if ($('#servico_sistemas_protheus').prop('checked')) {

            if ($("input[name='acao_protheus']:checked").length == 0) {
                flag = false;
                $('input[name="acao_protheus"]').parents('.form-group').addClass('has-error').find('.help-block').html('<b>Escolha uma opção!</b>');
            }

            if ($('#adicionados').val() == null) {
                flag = false;
                $('#adicionados').parents('.form-group').addClass('has-error').find('.help-block').html('Campo <b>obrigatório</b>!');
            }

            if ($("input[name='modulos_protheus[]']:checked").length == 0) {
                flag = false;
                $('input[name="modulos_protheus[]"]').parents('.form-group').addClass('has-error').find('.help-block').html('<b>Escolha uma opção!</b>');
            }
        }

        if ($('#servico_sistemas_rm').prop('checked')) {
            if ($("input[name='acao_rm']:checked").length == 0) {
                flag = false;
                $('input[name="acao_rm"]').parents('.form-group').addClass('has-error').find('.help-block').html('<b>Escolha uma opção!</b>');
            }

            if ($("input[name='modulos_rm[]']:checked").length == 0) {
                flag = false;
                $('input[name="modulos_rm[]"]').parents('.form-group').addClass('has-error').find('.help-block').html('<b>Escolha uma opção!</b>');
            }
            if ($("input[name='coligadas[]']:checked").length == 0) {
                flag = false;
                $('input[name="coligadas[]"]').parents('.form-group').addClass('has-error').find('.help-block').html('<b>Escolha uma opção!</b>');
            }
            if (liberado_portal_rh) {
                if ($("input[name='perfils_rm[]']:checked").length == 0) {
                    flag = false;
                    $('input[name="perfils_rm[]"]').parents('.form-group').addClass('has-error').find('.help-block').html('<b>Escolha uma opção!</b>');
                }
            }

        }

        if ($('#servico_sistemas_ecm').prop('checked')) {

            if ($("input[name='acao_ecm']:checked").length == 0) {
                flag = false;
                $('input[name="acao_ecm"]').parents('.form-group').addClass('has-error').find('.help-block').html('<b>Escolha uma opção!</b>');
            }

            if ($("input[name='modulos_ecm[]']:checked").length == 0) {
                flag = false;
                $('input[name="modulos_ecm[]"]').parents('.form-group').addClass('has-error').find('.help-block').html('<b>Escolha uma opção!</b>');
            }

            if ($("input[name='perfils_ecm[]']:checked").length == 0) {
                flag = false;
                $('input[name="perfils_ecm[]"]').parents('.form-group').addClass('has-error').find('.help-block').html('<b>Escolha uma opção!</b>');
            }

        }

        if ($('#servico_sistemas_bi').prop('checked')) {

            if ($("input[name='acao_bi']:checked").length == 0) {
                flag = false;
                $('input[name="acao_bi"]').parents('.form-group').addClass('has-error').find('.help-block').html('<b>Escolha uma opção!</b>');
            }

            if ($("input[name='grupos_bi[]']:checked").length == 0) {
                flag = false;
                $('input[name="grupos_bi[]"]').parents('.form-group').addClass('has-error').find('.help-block').html('<b>Escolha uma opção!</b>');
            }

        }

        if ($('#servico_sistemas_otrs').prop('checked')) {

            if ($("input[name='acao_otrs']:checked").length == 0) {
                flag = false;
                $('input[name="acao_otrs"]').parents('.form-group').addClass('has-error').find('.help-block').html('<b>Escolha uma opção!</b>');
            }

            if ($("input[name='papeis_otrs[]']:checked").length == 0) {
                flag = false;
                $('input[name="papeis_otrs[]"]').parents('.form-group').addClass('has-error').find('.help-block').html('<b>Escolha uma opção!</b>');
            }

        }
    }

    if ($('#servico_matriz').prop('checked')) {

        if (!$('#servico_matriz_rede').prop('checked')
                && !$('#servico_matriz_catraca').prop('checked')
                ) {
            flag = false;
            $('.errors_matriz').html('Escolha uma das opções abaixo!');
        }

        if ($('#servico_matriz_rede').prop('checked')) {

            if ($("input[name='acao_rede_matriz']:checked").length == 0) {
                flag = false;
                $('input[name="acao_rede_matriz"]').parents('.form-group').addClass('has-error').find('.help-block').html('<b>Escolha uma opção!</b>');
            }

            if ($("input[name='rede_matriz[]']:checked").length == 0) {
                flag = false;
                $('input[name="rede_matriz[]"]').parents('.form-group').addClass('has-error').find('.help-block').html('<b>Escolha uma opção!</b>');
            }

        }

        if ($('#servico_matriz_catraca').prop('checked')) {

            if ($("input[name='acao_catraca']:checked").length == 0) {
                flag = false;
                $('input[name="acao_catraca"]').parents('.form-group').addClass('has-error').find('.help-block').html('<b>Escolha uma opção!</b>');
            }

        }
    }

    overlay(false);
    return flag;
}