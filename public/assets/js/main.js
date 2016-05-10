// @koala-prepend "bootgrid/jquery.bootgrid.min.js"
// @koala-prepend "bootgrid/jquery.bootgrid.fa.min.js"
// @koala-prepend "jquery-ui.min.js"
// @koala-prepend "mask.js"
// @koala-prepend "isotope-2.2.2.js"
// @koala-prepend "monthPicker.js"
// @koala-prepend "summernote/summernote.min.js"
// @koala-prepend "summernote/lang/summernote-pt-BR.js"
// @koala-prepend "price-format.2.0.min.js"

$(document).ready(function () {

    $('.tooltips').tooltip();

    $('textarea').summernote({
        lang: 'pt-BR'
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
    $('.datepicker').mask("99/99/9999");
    $('.monthPicker').MonthPicker({
        ShowIcon: false,
        option: 'Animation',
        i18n: {
            year: 'Ano',
            prevYear: 'Ano Anterior',
            nextYear: 'Próximo Ano',
            next12Years: 'Pular 12 Anos Acima',
            prev12Years: 'Pular 12 Anos Atrás',
            nextLabel: 'Próximo',
            prevLabel: 'Anterior',
            buttonText: 'Escolha o mês',
            jumpYears: 'Pular Anos',
            backTo: 'Voltar para',
            months: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez']
        }
    });
    $('.monthPicker').mask("99/9999");
    $('.grid-isotope').isotope({
        itemSelector: '.grid-item',
        masonry: {
            columnWidth: '.grid-item'
        }
    });
    $(".datatable").bootgrid({
        caseSensitive: false,
        searchSettings: {
            delay: 100,
        },
        rowCount: [10, 25, 50, 100, 500, -1],
        multiSort: true,
        labels: {
            all: "Todos",
            infos: "Exibindo {{ctx.start}} até {{ctx.end}} de {{ctx.total}} registros",
            loading: "Carregando...",
            noResults: "Nenhum resultado encontrado!",
            refresh: "Recarregar",
            search: "Busca"
        },
        formatters: {
            commands: function (column, row) {
                return '<button type="button" class="btn waves-effect bgm-amber tooltips" onclick="editItem(\'' + row.commands + '/edit/\', ' + row.id + ')" title="Editar" data-row-id=' + row.id + '"><span class="zmdi zmdi-edit"></span></button> ' +
                        '<button type="button" class="btn waves-effect bgm-red tooltips" onclick="deleteItem(\'' + row.commands + '/delete/\', ' + row.id + ')" title="Deletar" data-row-id="' + row.id + '"><span class="zmdi zmdi-delete"></span></button>';
            },
            icon: function (column, row) {
                return '<span class="f-20"><i class="' + row.icon + '"></i></span>';
            }
        }
    });

    $('.formatMoney').priceFormat({
        prefix: 'R$ ',
        centsSeparator: ',',
        thousandsSeparator: '.'
    });

    overlay(false);

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

var editItem = function (url, id) {
    window.location.href = url + id;
}