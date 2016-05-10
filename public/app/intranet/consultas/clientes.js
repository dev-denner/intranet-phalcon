$(document).ready(function () {
    $.ajax({
        method: 'GET',
        dataType: "json",
        url: 'clientes',
    }).success(function (returned) {
        $('.receive.clientes').html(returned.clientes);
    }).fail(function (returned) {
        $('.receive.clientes').html('erro');
    });
});