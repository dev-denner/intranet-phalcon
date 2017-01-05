$('#cpf').bind('blur', function () {
    overlay(true);
    var cpf = $('#cpf').val();
    $('.error_solicitante').html('');
    $('.nome_solicitante').html('<p class="text-center"><i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i><span class="sr-only">Loading...</span></p>');

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
            $('.nome_solicitante').html(returned.NOME);
            $('#nome_solicitante').val(returned.NOME);
            $('#email_solicitante').val(returned.EMAIL);
        } else {
            $('.error_solicitante').html('Não foi encontrado esse CPF na base de dados.');
            $('.nome_solicitante').html('');
            $('#nome_solicitante').val();
            $('#email_solicitante').val();
        }
        overlay(false);
    }).fail(function (returned) {
        $('.error_solicitante').html('Não foi encontrado esse CPF na base de dados.');
        $('.nome_solicitante').html('');
        $('#nome_solicitante').val();
        $('#email_solicitante').val();
        overlay(false);
    });
});


$(document).ready(function () {

    $('input[name="Consórcio"]').bind('click', function () {
        $('#percentual_de_participacao').parents('.form-group').removeClass('has-error').find('.help-block').html('');
    });

    $('input[name="Consórcio"]').bind('click', function () {
        var consorcio = $('input[name="Consórcio"]:checked').val();
        if (consorcio == 'Sim') {
            $("#percentual_de_participacao").removeAttr('disabled').attr('required', 'required').parents('.form-group').find('label').html('Percentual de Participação <span class="text-danger">*</span>');
        } else {
            $("#percentual_de_participacao").removeAttr('required').attr('disabled', 'disabled').val('').parents('.form-group').find('label').html('Percentual de Participação');
        }
    });

    $('input[name="Opção de Garantia"]').click(function () {

        if ($(this).val() == 'Garantia Nova') {
            $('.endosso').fadeOut(500, function () {
                $('.garantiaNova').fadeIn();
                endosso(false);
                garantiaNova(true);
            });
        } else {
            $('.garantiaNova').fadeOut(500, function () {
                $('.endosso').fadeIn();
                garantiaNova(false);
                endosso(true);
            });
        }
    });

    $('input[name="Tipo de Modalidade"]').click(function () {

        if ($(this).val() == 'Pública') {
            $('.garantiaNovaPrivada').fadeOut(500, function () {
                $('.garantiaNovaPublica').fadeIn();
                garantiaNovaPrivada(false);
                garantiaNovaPublica(true);
            });
        } else {
            $('.garantiaNovaPublica').fadeOut(500, function () {
                $('.garantiaNovaPrivada').fadeIn();
                garantiaNovaPublica(false);
                garantiaNovaPrivada(true);
            });
        }
    });

});

var endosso = function (on) {

    if (on) {
        var asterisco = ' <span class="text-danger">*</span>';

        $('#Endosso').attr('required', 'required').parents('.form-group').find('label span').html('Endosso' + asterisco);
        $('input[name="Nº da Apólice / Carta Fiança"]').attr('required', 'required').parents('.form-group').find('label span').html('Nº da Apólice / Carta Fiança' + asterisco);
        $('input[name="Seguradora / Banco atual"]').attr('required', 'required').parents('.form-group').find('label span').html('Seguradora / Banco atual' + asterisco);
        $('input[name="Importância Segurada atual"]').attr('required', 'required').parents('.form-group').find('label span').html('Importância Segurada atual' + asterisco);
        $('input[name="Vigência atual - Início"]').attr('required', 'required').parents('.form-group').find('label span').html('Vigência atual' + asterisco);
        $('input[name="Vigência atual - Final"]').attr('required', 'required');
        $('input[name="Importância Segurada após Endosso"]').attr('required', 'required').parents('.form-group').find('label span').html('Importância Segurada após Endosso' + asterisco);
        $('input[name="Vigência Após Endosso - Início"]').attr('required', 'required').parents('.form-group').find('label span').html('Vigência Após Endosso' + asterisco);
        $('input[name="Vigência Após Endosso - Final"]').attr('required', 'required');
    } else {

        $('#Endosso').removeAttr('required').parents('.form-group').find('label span').html('Endosso');
        $('input[name="Nº da Apólice / Carta Fiança"]').removeAttr('required').parents('.form-group').find('label span').html('Nº da Apólice / Carta Fiança');
        $('input[name="Seguradora / Banco atual"]').removeAttr('required').parents('.form-group').find('label span').html('Seguradora / Banco atual');
        $('input[name="Importância Segurada atual"]').removeAttr('required').parents('.form-group').find('label span').html('Importância Segurada atual');
        $('input[name="Vigência atual - Início"]').removeAttr('required').parents('.form-group').find('label span').html('Vigência atual');
        $('input[name="Vigência atual - Final"]').removeAttr('required');
        $('input[name="Importância Segurada após Endosso"]').removeAttr('required').parents('.form-group').find('label span').html('Importância Segurada após Endosso');
        $('input[name="Vigência Após Endosso - Início"]').removeAttr('required').parents('.form-group').find('label span').html('Vigência Após Endosso');
        $('input[name="Vigência Após Endosso - Final"]').removeAttr('required');
    }

}

var garantiaNova = function (on) {

    if (on) {

        var asterisco = ' <span class="text-danger">*</span>';

        $('input[name="Tipo de Modalidade"]').attr('required', 'required').parents('.form-group').find('label span').html('Tipo de Modalidade' + asterisco);
        $('input[name="Percentual de Garantia"]').attr('required', 'required').parents('.form-group').find('label span').html('Percentual de Garantia' + asterisco);
        $('input[name="Valor da Garantia"]').attr('required', 'required').parents('.form-group').find('label span').html('Valor da Garantia' + asterisco);
        $('input[name="Vigência da Garantia - Início"]').attr('required', 'required').parents('.form-group').find('label span').html('Vigência da Garantia' + asterisco);
        $('input[name="Vigência da Garantia - Final"]').attr('required', 'required');
        $('input[name="Cobertura de Multas Trabalhistas"]').attr('required', 'required').parents('.form-group').find('label span').html('Cobertura de Multas Trabalhistas' + asterisco);
    } else {

        $('input[name="Tipo de Modalidade"]').removeAttr('required').parents('.form-group').find('label span').html('Tipo de Modalidade');
        $('input[name="Percentual de Garantia"]').removeAttr('required').parents('.form-group').find('label span').html('Percentual de Garantia');
        $('input[name="Valor da Garantia"]').removeAttr('required').parents('.form-group').find('label span').html('Valor da Garantia');
        $('input[name="Vigência da Garantia - Início"]').removeAttr('required').parents('.form-group').find('label span').html('Vigência da Garantia');
        $('input[name="Vigência da Garantia - Final"]').removeAttr('required');
        $('input[name="Cobertura de Multas Trabalhistas"]').removeAttr('required').parents('.form-group').find('label span').html('Cobertura de Multas Trabalhistas');

    }
}

var garantiaNovaPublica = function (on) {

    if (on) {

        var asterisco = ' <span class="text-danger">*</span>';

        $('select[name="Modalidade - Pública"]').attr('required', 'required').parents('.form-group').find('label span').html('Modalidade' + asterisco);
    } else {
        $('select[name="Modalidade - Pública"]').removeAttr('required').parents('.form-group').find('label span').html('Modalidade');
    }

}

var garantiaNovaPrivada = function (on) {

    if (on) {

        var asterisco = ' <span class="text-danger">*</span>';

        $('select[name="Modalidade - Privada"]').attr('required', 'required').parents('.form-group').find('label span').html('Modalidade' + asterisco);
    } else {
        $('select[name="Modalidade - Privada"]').removeAttr('required').parents('.form-group').find('label span').html('Modalidade');
    }

}