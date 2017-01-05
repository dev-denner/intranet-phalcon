$(document).ready(function () {

    $(".chosen").data({placeholder: '', autocomplete: 'on'}).chosen({disable_search_threshold: 10});

    $('.textareaEdit').summernote({
        lang: 'pt-BR',
        height: 150,
        codemirror: {
            theme: 'monokai'
        },
        toolbar: [
            ['style', ['bold', 'italic', 'underline', 'clear']],
            ['font', ['strikethrough', 'superscript', 'subscript']],
            ['fontsize', ['fontsize']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['height', ['height']]
        ],
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

    $('.formatMoney').priceFormat({
        prefix: 'R$ ',
        centsSeparator: ',',
        thousandsSeparator: '.'
    });

    $('.onlyFloat').priceFormat({
        prefix: '',
        centsSeparator: ',',
        thousandsSeparator: ''
    });

    $('.onlyFloatWithDot').priceFormat({
        prefix: '',
        centsSeparator: ',',
        thousandsSeparator: '.'
    });

    $('.onlyNumber').bind('keypress', function () {
        var tecla = (window.event) ? event.keyCode : e.which;
        if ((tecla > 47 && tecla < 58))
            return true;
        else {
            if (tecla == 8 || tecla == 0)
                return true;
            else
                return false;
        }
    });

});