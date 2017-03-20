
$('input[name="modules"]').bind('click', function () {
    controller(this);
});

var sendAjax = function (type, module, controller, callback) {

    $.ajax({
        method: 'POST',
        url: base_url_intranet + 'nucleo/groups/ajax',
        cache: false,
        dataType: "json",
        data: {
            type: type,
            module: module,
            controller: controller,
        },
        success: callback,
    });

}

var controller = function (e) {
    sendAjax('module', $(e).val(), null, function (returned) {

        var opt = '<label class="m-b-10">';
        opt += 'Ações';
        opt += '</label>';
        opt += '<br />';

        $('#actions').html(opt);

        var opt = '<label class="m-b-10">';
        opt += 'Controladores';
        opt += '</label>';
        opt += '<br />';

        $.each(returned, function (index, value) {

            opt += '<div class="form-group fg-line">';
            opt += '<div class="radio">';
            opt += '<label class="m-b-5">';
            opt += '<input type="radio" id="controllers' + value[0] + '" name="controllers" value="' + value[0] + '" onClick="actions(' + $(e).val() + ', '+ value[0] + ')" />';
            opt += '<i class="input-helper"></i>';
            opt += value[1]
            opt += '</label>';
            opt += '</div>';
            opt += '</div>';

        });
        $('#controllers').html(opt);
    })
}

var actions = function (valueModule, valueController) {
    sendAjax('controller', valueModule, valueController, function (returned) {

        var opt = '<label class="m-b-10">';
        opt += 'Ações';
        opt += '</label>';
        opt += '<br />';

        $.each(returned, function (index, value) {

            opt += '<div class="form-group fg-line">';
            opt += '<div class="checkbox">';
            opt += '<label>';
            opt += '<input type="checkbox" id="actions' + value[0] + '" name="actions[]" value="' + value[0] + '" />';
            opt += '<i class="input-helper"></i>';
            opt += value[1]
            opt += '</label>';
            opt += '</div>';
            opt += '</div>';

        });
        $('#actions').html(opt);
    })
}