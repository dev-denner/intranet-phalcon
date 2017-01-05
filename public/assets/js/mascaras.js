$(document).ready(function () {

    $('.datepicker').inputmask("d/m/y", {"placeholder": "dd/mm/aaaa"});
    $('.monthPicker').inputmask("m/y", {"placeholder": "mm/aaaa"});
    $(".cpfMask").inputmask({"mask": "999.999.999-99", "placeholder": " "});
    $(".cnpjMask").inputmask({"mask": "99.999.999/9999-99", "placeholder": " "});
    $(".cepMask").inputmask({"mask": "99999-999", "placeholder": " "});
    $(".naturezaMask").inputmask({"mask": "999-9", "placeholder": " "});
    $(".cnaeMask").inputmask({"mask": "9999-9/99", "placeholder": " "});

    $(".telefone")
            .inputmask({"mask": "(##) ####[#]-####", "placeholder": " "})
            .focusout(function (event) {
                var target, phone, element;
                target = (event.currentTarget) ? event.currentTarget : event.srcElement;
                phone = target.value.replace(/\D/g, '');
                element = $(target);
                element.inputmask('remove');
                if (phone.length > 10) {
                    element.inputmask({"mask": "(##) ####[#]-####", "placeholder": " "});
                } else {
                    element.inputmask({"mask": "(##) ####-[#]####", "placeholder": " "});
                }
            });

    $('.emailMask').inputmask({
        mask: "*{1,20}[.*{1,20}][.*{1,20}][.*{1,20}]@*{1,20}[.*{2,6}][.*{1,2}]",
        greedy: false,
        placeholder: " ",
        onBeforePaste: function (pastedValue, opts) {
            pastedValue = pastedValue.toLowerCase();
            return pastedValue.replace("mailto:", "");
        },
        definitions: {
            '*': {
                validator: "[0-9A-Za-z!#$%&'*+/=?^_`{|}~\-]",
                cardinality: 1,
                casing: "lower"
            }
        }
    });

});