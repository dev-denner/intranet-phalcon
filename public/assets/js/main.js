// @koala-prepend "mascaras.js"
// @koala-prepend "formatos.js"


$(document).ready(function () {

    $('.tooltips').tooltip();

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
            commands2: function (column, row) {

                var edit = '<button type="button" class="btn waves-effect bgm-amber tooltips" onclick="editItem(\'' + row.commands + '/edit/\', ' + row.sequence + ')" title="Editar" data-row-id=' + row.sequence + '"><span class="zmdi zmdi-edit"></span></button> ';
                var view = '<a href="/downloads/coleta_rescisao/' + row.sequence + '/' + row.sequence + '.pdf" class="btn waves-effect bgm-cyan tooltips" title="Visualizar" target="_new"><span class="glyphicon glyphicon-eye-open"></span></a> ';
                var send = '<button type="button" class="btn waves-effect bgm-green tooltips" onclick="enviarRequisicao(\'' + row.sequence + '\')" title="Enviar"><span class="glyphicon glyphicon-send"></span></button>';
                if (row.status.trim() == 'Aberto') {
                    return edit + send;
                } else {
                    return view;
                }
            },
            commands3: function (column, row) {

                var close = '<button type="button" class="btn waves-effect bgm-green tooltips" onclick="editItem(\'' + row.commands + '/close/\', ' + row.id + ')" title="Encerrar"><span class="zmdi zmdi-close"></span></button>';
                var del = '<button type="button" class="btn waves-effect bgm-red tooltips" onclick="deleteItem(\'' + row.commands + '/delete/\', ' + row.id + ')" title="Deletar" data-row-id="' + row.id + '"><span class="zmdi zmdi-delete"></span></button>';

                if (row.status.trim() == 'Aberto') {
                    return close + del;
                } else {
                    return del;
                }


            },
            icon: function (column, row) {
                return '<span class="f-20"><i class="' + row.icon + '"></i></span>';
            },
            linkOtrs: function (column, row) {
                var elements = row.Chamado.split('|');
                return '<a href="http://otrs.grupompe.com.br/otrs/index.pl?Action=AgentTicketZoom;TicketID=' + elements[0] + '" target="_new">' + elements[1] + '</a>';
            },
            link: function (column, row) {
                var elements = row.link.split('|');
                return '<a href="' + elements[0] + '" target="_new">' + elements[1] + '</a>';
            }
        }
    });

    $('.datatable2').dataTable({
        "aLengthMenu": [[10, 25, 50, 75, 100, -1], [10, 25, 50, 75, 100, "All"]],
        "iDisplayLength": 100
    });

    $(".datatable2").tablecloth({
        theme: "stats",
        bordered: true,
        condensed: true,
        striped: true,
        sortable: true,
        clean: true,
        cleanElements: "th td",
        customClass: "table table-hover"
    });



    $('.lc-block.valid-block li[data-block]').bind('click', function () {
        var inputs = $(this).parents('.lc-block').find('input:not(input[type=hidden])').val();
        if (inputs != '') {
            $(this).parents('.lc-block').find('button[type=submit]').addClass("pulse");
            setTimeout(function () {
                $(".pulse").removeClass("pulse");
            }, 9999);
            return false;
        }
    });

    $(".fileUpload").fileinput({
        language: "pt-BR",
        previewFileType: "any",
        allowedFileTypes: ["jpg", "jpeg", "png", "gif", "pdf", "doc", "docx", "txt", "zip", "rar", "gz", "tgz"],
        previewClass: "bg-default",
        showUpload: false,
        maxFileSize: 15360,
        maxFilePreviewSize: 15360,
        overwriteInitial: false,
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
    overlay(true);
    window.location.href = url + id;
}