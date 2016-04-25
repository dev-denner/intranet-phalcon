$(document).ready(function () {
    $.ajax({
        method: 'GET',
        dataType: "json",
        url: 'fornecedores',
    }).success(function (returned) {
        $('.receive.fornecedores').html(returned.fornecedores);
    }).fail(function (returned) {
        $('.receive.fornecedores').html('erro');
    });
});