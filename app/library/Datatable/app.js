/**
 * Datatable js
 * Author: denner.fernandes - denners777@hotmail.com
 */

//functions

/**
 * datatable_reload
 * @returns {undefined}
 */

var datatable_submit = function (e) {

    if (typeof e == 'undefined') {
        e = $('#datatable_hide_length').val();
    }

    $('input[name=datatable_length]').val(e);
    $('input[name=datatable_filter]').val($('#datatable_filter').val());
    $('#emissary').submit();
};


/**
 * datatable_selected
 * @param {type} e
 * @returns {undefined}
 */
var datatable_selected = function (e) {
    /*var tr = $(e);
     var id = $(tr).find('td:first').data('id');

     $('.datatable_button').attr('data-id', id);

     $('.datatable_data tr').removeClass('info');
     tr.addClass("info");*/

};


/**
 * datatable_view
 * @param {type} e
 * @returns {undefined}
 */
var datatable_view = function (e) {

    var id = $(e).attr('data-id');
    var url = $(e).attr('data-href') + '/' + id;
    var title = $('#datatable_hide_title').val() + ' - Visualização';

    sendByAjax(id, url, 'datatable_modal_content');

    $('#datatable_modal .modal-title').html(title);
    $('#datatable_modal').modal('toggle');
    $('#datatable_modal_bt').show();


}
/**
 * datatable_new
 * @param {type} e
 * @returns {undefined}
 */
var datatable_new = function (e) {


    var url = $(e).attr('data-href');
    var title = $('#datatable_hide_title').val() + ' - Inserção';

    sendByAjax(0, url, 'datatable_modal_content');

    $('#datatable_modal .modal-title').html(title);
    $('#datatable_modal').modal('toggle');
    $('#datatable_modal_bt').hide();

}

/**
 * datatable_view
 * @param {type} e
 * @returns {undefined}
 */
var datatable_edit = function (e) {


    var id = $(e).attr('data-id');
    var url = $(e).attr('data-href') + '/' + id;
    var title = $('#datatable_hide_title').val() + ' - Edição';

    sendByAjax(id, url, 'datatable_modal_content', 'GET');

    $('#datatable_modal .modal-title').html(title);
    $('#datatable_modal').modal('toggle');
    $('#datatable_modal_bt').hide();


}

var datatable_delete = function (e) {

    swal({
        title: "Você está certo disso?",
        text: "Realmente deseja deletar este registro?",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        confirmButtonText: "Sim, tenho certeza!",
        cancelButtonText: "Não delete isso",
        closeOnConfirm: false,
        closeOnCancel: false
    }, function (isConfirm) {
        if (isConfirm) {
            var id = $(e).attr('data-id');
            var url = $(e).attr('data-href');
            var title = $('#datatable_hide_title').val() + ' - Erros';
            sendByAjax(id, url, '', 'POST');
            $('#datatable_modal .modal-title').html(title);

        } else {
            swal("Cancelado", "Registro a salvo :-)", "error");
        }
    });

}

var datatable_search = function (e) {

    var url = $(e).attr('data-href');
    var title = $('#datatable_hide_title').val() + ' - Busca';

    sendByAjax(0, url, 'datatable_modal_content');

    $('#datatable_modal .modal-title').html(title);
    $('#datatable_modal').modal('toggle');
    $('#datatable_modal_bt').hide();

}

var datatable_sorting = function (e) {

    var desc = '';

    if ($('#datatable_hide_order').val() == e) {
        desc = ' DESC';
    }

    $('input[name=datatable_order]').val(e + desc);
    datatable_submit();
}

//helpers

/**
 * sendByAjax
 * @param {type} data
 * @param {type} url
 * @param {type} container
 * @returns {undefined}
 */
var sendByAjax = function (data, url, container, method) {

    method = method || 'POST';

    var ajax = $.ajax({
        method: method,
        url: url,
        data: {id: data}
    });
    ajax.success(function (returned) {
        console.log(returned)
        if (returned == 'ok') {
            swal({
                title: "Deletado!",
                text: "O registro foi deletado com sucesso!!!",
                type: "success"
            }, function (isConfirm) {
                if (isConfirm) {
                    location.reload();
                } else {
                    swal("Errors", returned, "error");
                }
            });

        } else {
            $('#' + container).html(returned);
        }
    });
    ajax.fail(function (returned) {
        $('#' + container).html(returned);
    });
};

/**
 *
 * @returns {undefined}
 */
var resetting = function () {
    $('#reset').parents('form').find('input:not(.btn), select').val('');
    $('#reset').parents('form').submit();

}
