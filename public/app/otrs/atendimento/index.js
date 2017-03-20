$('#tipo').bind('change', function () {

    overlay(true);
    getField('fila');
    getField('gestor');
    getField('centrocusto');
    getField('departamento');
    getField('cliente');
    getField('responsavel');
    getField('proprietario');
    getField('status');
    overlay(false);
});
$('#fila, #dataDe, #dataAte').bind('change', function () {
    overlay(true);
    getField('gestor');
    getField('centrocusto');
    getField('departamento');
    getField('cliente');
    getField('responsavel');
    getField('proprietario');
    getField('status');
    overlay(false);
});
$('#gestor').bind('change', function () {
    overlay(true);
    getField('centrocusto');
    getField('departamento');
    getField('cliente');
    getField('responsavel');
    getField('proprietario');
    getField('status');
    overlay(false);
});
$('#centrocusto').bind('change', function () {
    overlay(true);
    getField('departamento');
    getField('cliente');
    getField('responsavel');
    getField('proprietario');
    getField('status');
    overlay(false);
});
$('#departamento').bind('change', function () {
    overlay(true);
    getField('cliente');
    getField('responsavel');
    getField('proprietario');
    getField('status');
    overlay(false);
});
$('#cliente').bind('change', function () {
    overlay(true);
    getField('responsavel');
    getField('proprietario');
    getField('status');
    overlay(false);
});
$('#responsavel').bind('change', function () {
    overlay(true);
    getField('proprietario');
    getField('status');
    overlay(false);
});
$('#proprietario').bind('change', function () {
    overlay(true);
    getField('status');
    overlay(false);
});



$("#fields_all").click(function () {
    if ($(this).prop("checked")) {
        marcardesmarcar(true);
    } else {
        marcardesmarcar(false);
    }
});

function marcardesmarcar(bool) {
    $('input[name*="fields"]').each(function () {
        $(this).prop("checked", bool);
    }
    );
}

var fields = function (entity) {

    return {
        entity: entity,
        tipo: $('#tipo').val(),
        fila: $('#fila').val(),
        assunto: $('#assunto').val(),
        dataDe: $('#dataDe').val(),
        dataAte: $('#dataAte').val(),
        gestor: $('#gestor').val(),
        centrocusto: $('#centrocusto').val(),
        departamento: $('#departamento').val(),
        cliente: $('#cliente').val(),
        responsavel: $('#responsavel').val(),
        proprietario: $('#proprietario').val(),
        status: $('#status').val(),
    }

};
var getField = function (entity) {

    var field = fields(entity);
    sendAjax(field, function (returned) {

        var opt = '<option value=""></option>';
        $.each(returned, function (index, value) {
            opt += '<option value="' + index + '">' + value + '</option>';
        });
        $('#' + entity).html(opt).trigger("chosen:updated");
    });
}

var sendAjax = function (fields, callback) {

    $.ajax({
        method: 'POST',
        url: base_url_intranet + 'otrs/atendimento',
        cache: false,
        dataType: "json",
        data: {
            fields: fields
        },
        success: callback,
    });
}