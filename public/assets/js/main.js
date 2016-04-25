// @koala-prepend "datatable/datatable.js"
// @koala-prepend "tablecloth/jquery.metadata.js"
// @koala-prepend "tablecloth/jquery.tablecloth.js"
// @koala-prepend "tablecloth/jquery.tablesorter.min.js"
// @koala-prepend "jquery-ui.min.js"

$(document).ready(function () {
    $('#overlay').css('display', 'none');

    $('.datatable').dataTable({
        "aLengthMenu": [[10, 25, 50, 75, 100, -1], [10, 25, 50, 75, 100, "All"]],
        "language": {
            "sEmptyTable": "Nenhum registro encontrado",
            "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
            "sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
            "sInfoFiltered": "(Filtrados de _MAX_ registros)",
            "sInfoPostFix": "",
            "sInfoThousands": ".",
            "sLengthMenu": "_MENU_ resultados por página",
            "sLoadingRecords": "Carregando...",
            "sProcessing": "Processando...",
            "sZeroRecords": "Nenhum registro encontrado",
            "sSearch": "Pesquisar",
            "oPaginate": {
                "sNext": "Próximo",
                "sPrevious": "Anterior",
                "sFirst": "Primeiro",
                "sLast": "Último"
            },
            "oAria": {
                "sSortAscending": ": Ordenar colunas de forma ascendente",
                "sSortDescending": ": Ordenar colunas de forma descendente"
            }
        },
        "iDisplayLength": 100
    });
    $(".datatable").tablecloth({
        theme: "stats",
        bordered: true,
        condensed: true,
        striped: true,
        sortable: true,
        clean: true,
        cleanElements: "th td",
        customClass: "table table-hover"
    });

    $('.datepicker').datepicker({
        dateFormat: "dd/mm/yy",
        changeMonth: true,
        changeYear: true,
        yearRange: "c-40:c+10",
        showOtherMonths: true,
        selectOtherMonths: true,
        showButtonPanel: true,
        closeText: 'OK',
        currentText: 'Hoje',
        dayNames: ['Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sábado', 'Domingo'],
        dayNamesMin: ['D', 'S', 'T', 'Q', 'Q', 'S', 'S', 'D'],
        dayNamesShort: ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sáb', 'Dom'],
        monthNames: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'],
        monthNamesShort: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez']
    });

    $.fn.monthYearPicker = function (options) {
        options = $.extend({
            dateFormat: "mm/yy",
            changeMonth: true,
            changeYear: true,
            showButtonPanel: true,
            showAnim: "",
            closeText: 'OK',
            currentText: 'Este Mês',
            dayNames: ['Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sábado', 'Domingo'],
            dayNamesMin: ['D', 'S', 'T', 'Q', 'Q', 'S', 'S', 'D'],
            dayNamesShort: ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sáb', 'Dom'],
            monthNames: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'],
            monthNamesShort: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'],
        }, options);
        function hideDaysFromCalendar() {
            var thisCalendar = $(this);
            $('.ui-datepicker-calendar').detach();
            // Also fix the click event on the Done button.
            $('.ui-datepicker-close').unbind("click").click(function () {
                var month = $("#ui-datepicker-div .ui-datepicker-month :selected").val();
                var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
                thisCalendar.datepicker('setDate', new Date(year, month, 1));
            });
        }
        $(this).datepicker(options).focus(hideDaysFromCalendar);
    }
    $('.monthPicker').monthYearPicker();

});

var overlay = function (on) {
    if (on) {
        $('#overlay').fadeIn('slow');
    } else {
        $('#overlay').fadeOut('slow');
    }
}

var deleteItem = function (url, id) {
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
    }, function (isConfirm1) {
        if (isConfirm1) {
            var ajax = $.ajax({
                method: 'POST',
                url: url,
                data: {id: id}
            });
            ajax.success(function (returned) {

                if (returned == 'ok') {
                    swal({
                        title: "Deletado!",
                        text: "O registro foi deletado com sucesso!!!",
                        type: "success"
                    }, function (isConfirm2) {
                        if (isConfirm2) {
                            overlay(true);
                            location.reload();
                        } else {
                            swal("Errors", returned, "error");
                        }
                    });

                } else {
                    $('#errors').html(returned);
                }
            });
            ajax.fail(function (returned) {
                $('#errors').html(returned);
            });
        } else {
            swal("Cancelado", "Registro a salvo :-)", "error");
        }
    });
}