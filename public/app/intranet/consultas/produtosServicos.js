$(document).ready(function () {
    $.ajax({
        method: 'GET',
        dataType: "json",
        url: 'produtos',
    }).success(function (returned) {
        $('.receive.produtos').html(returned.produtos);
        $('.receive.servicos').html(returned.servicos);
    }).fail(function (returned) {
        $('.receive.produtos').html('erro');
        $('.receive.servicos').html('erro');
    });
});