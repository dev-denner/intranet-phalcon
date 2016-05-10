$(document).ready(function () {


    var dataBootGrid = function (url) {

        var grid = $(".datatable").bootgrid({
            ajax: true,
            post: function () {
                return {
                    id: "b0df282a-0d67-40e5-8558-c9e93b7befed"
                };
            },
            url: url,
            formatters: {
                "commands": function (column, row) {
                    return "<a href='" + url + "edit/" + row.id + "' class='btn btn-warning btn-sm m-t-5 waves-effect tooltip' title='Editar'><i class='zmdi zmdi-edit'></i></a>" +
                            "<button type='button' class='btn btn-danger btn-sm m-t-5 waves-effect tooltip' onclick=\"deleteItem('" + url + "delete')}}', '" + row.id + "')\" title='Deletar'><i class='zmdi zmdi-close-circle'></i></button>";
                }
            }
        }).on("loaded.rs.jquery.bootgrid", function () {

        });
    }

});