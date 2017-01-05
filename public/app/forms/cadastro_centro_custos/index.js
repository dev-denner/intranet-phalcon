$('#empresa').bind('change', function () {

    $('#filial').html('<option>Loading...</option>');

    var ajax = $.ajax({
        method: 'POST',
        url: base_url_intranet + '/forms/cadastro_centro_custos',
        dataType: "json",
        data: {
            data: $(this).val(),
            type: 'filial',
        }
    });
    ajax.success(function (returned) {
        var template = '';
        $.each(returned, function (index, value) {
            template += '<option value="' + value.name + '">' + value.name + '</option>'
            $('#nomeEmpresa').val(value.nameEmpresa);
        });
        $('#filial').html(template);
    });
});

$('#empresaSecao').bind('change', function () {
    $('#filialSecao').html('<option>Loading...</option>');
    var ajax = $.ajax({
        method: 'POST',
        url: base_url_intranet + '/forms/cadastro_centro_custos',
        dataType: "json",
        data: {
            data: $(this).val(),
            type: 'filial',
        }
    });
    ajax.success(function (returned) {

        var template = '';
        $.each(returned, function (index, value) {
            template += '<option value="' + value.name + '">' + value.name + '</option>'
            $('#nomeEmpresaSecao').val(value.nameEmpresa);
        });
        $('#filialSecao').html(template);
    });
});

$('#Cliente').bind('blur', function () {
    var ajax = $.ajax({
        method: 'POST',
        url: base_url_intranet + '/forms/cadastro_centro_custos',
        dataType: "json",
        data: {
            data: $('#Cliente').val(),
            type: 'cliente',
        }
    });
    ajax.success(function (returned) {

        if (returned == '') {
            $('.nome_cliente').html('Cliente não cadastrado no sistema.').addClass('text-danger');
            $('#Cliente').attr('placeholder', $('#Cliente').val()).val('');
            $('#codigoCliente').val('');
            $('#lojaCliente').val('');
            $('#nomeCliente').val('');
            $('#razaoSocialCliente').val('');
            return;
        }

        returned = returned[0];
        var template = '';

        template += '<b>Razão Social:</b> ' + returned.razao + '<br />';
        template += '<b>Nome Fantasia:</b> ' + returned.name + '<br />';
        template += '<b>Código:</b> ' + returned.code + '<br />';
        template += '<b>Loja:</b> ' + returned.loja + '<br />';

        $('.nome_cliente').html(template).removeClass('text-danger');
        $('#Cliente').removeAttr('placeholder');
        $('#codigoCliente').val(returned.code);
        $('#lojaCliente').val(returned.loja);
        $('#nomeCliente').val(returned.name);
        $('#razaoSocialCliente').val(returned.razao);
    });
});


$(document).ready(function () {

    $('input[name="Folha de Pagamento"]').bind('click', function () {
        var justificativa = $('input[name="Folha de Pagamento"]:checked').val();
        if (justificativa == 'Sim') {

            $("#percentual_de_participacao").removeAttr('disabled').attr('required', 'required').parents('.form-group').find('label').html('Percentual de Participação <span class="text-danger">*</span>');

            $("#empresaSecao").attr('required', 'required').parents('.form-group').find('label').html('<i class="badge bgm-lightgreen">4.2</i> Empresa para Seção <span class="text-danger">*</span>');
            $("#filialSecao").attr('required', 'required').parents('.form-group').find('label').html('<i class="badge bgm-lightgreen">4.3</i> Filial para Seção <span class="text-danger">*</span>');
        } else {
            $("#empresaSecao").removeAttr('required').parents('.form-group').find('label').html('<i class="badge bgm-lightgreen">4.2</i> Empresa para Seção');
            $("#filialSecao").removeAttr('required').parents('.form-group').find('label').html('<i class="badge bgm-lightgreen">4.3</i> Filial para Seção');
        }
    });

});