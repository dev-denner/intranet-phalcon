$(document).ready(function () {
    $('#tipo').on('change', function () {

        $('#name, #cceo, #cpf').val('');

        if ($('#tipo').val() != 'Colaborador') {
            $('#name, #cceo').removeAttr('readonly').attr('required', 'required');
            $('#cpf').removeAttr('required');
        } else {
            $('#cpf').attr('required', 'required');
            $('#name, #cceo').attr('readonly', 'readonly').removeAttr('required');
        }
    });

    $('#cpf').on('blur', function () {
        $('#name, #cceo').val('');
        getInfoUser();
    });

    $("#linha")
            .inputmask({"mask": "0##-####[#]-####", "placeholder": " "})
            .focusout(function (event) {
                var target, phone, element;
                target = (event.currentTarget) ? event.currentTarget : event.srcElement;
                phone = target.value.replace(/\D/g, '');
                element = $(target);
                element.inputmask('remove');
                if (phone.length > 11) {
                    element.inputmask({"mask": "0##-####[#]-####", "placeholder": " "});
                } else {
                    element.inputmask({"mask": "0##-####-[#]####", "placeholder": " "});
                }
            });

});

var getInfoUser = function () {

    var cpf = $('#cpf').val();
    $('.errors > p').html('');

    if (cpf != '') {
        $.ajax({
            method: 'POST',
            dataType: "json",
            url: base_url_intranet + 'nucleo/users/infoUser',
            data: {cpf: cpf}
        }).success(function (returned) {
            $('#tipo').val('Colaborador');
            setTimeout(function () {
                $('#name').val(returned.NOME);
                $('#name').trigger('focus');
            }, 300);
            setTimeout(function () {
                $('#cceo').val(returned.CCEO);
                $('#cceo').trigger('focus');
            }, 400);
        }).fail(function (returned) {
            if ($('#tipo').val() == 'Colaborador') {
                $('.errors > p').html('Não foi possível identificar a origem dos dados desse usuário.<br>');
            }
        });
    }
}
