$(document).ready(function () {

    $('#comp').bind('blur', function () {
        hherTotalAno();
        tfca();
        txGravAcum();
        tfsa();
        tor();
        percHhTrein();
    });

    $('#cc').bind('change', function () {
        hherTotalAno();
        tfca();
        txGravAcum();
        tfsa();
        tor();
        percHhTrein();
    });

    $('#hher').bind('blur', function () {
        hherTotal();
        hherTotalAno();
        tfca();
        txGravAcum();
        tfsa();
        tor();
        percHhTrein();
    });

    $('#hherTerc').bind('blur', function () {
        hherTotal();
        hherTotalAno();
        tfca();
        txGravAcum();
        tfsa();
        tor();
        percHhTrein();
    });

    $('#acidComAfast').bind('blur', function () {
        tfca();
        tor();
    });
    $('#acidComAfastDiasPerd').bind('blur', function () {
        txGravAcum();
    });
    $('#acidComAfastDiasDebit').bind('blur', function () {
        txGravAcum();
    });
    $('#nAcidSemAfast').bind('blur', function () {
        tfsa();
        tor();
    });
    $('#totalHht').bind('blur', function () {
        percHhTrein();
    });

});

var hherTotal = function () {
    var hher = $('#hher').val() || '0';
    var hherTerc = $('#hherTerc').val() || '0';

    hher = stringToFloat(hher);
    hherTerc = stringToFloat(hherTerc)
    var total = parseFloat(hher) + parseFloat(hherTerc);

    $('#hherTotal').val(floatToString(total));
}

var hherTotalAno = function () {
    var hherTotal = $('#hherTotal').val() || '0';

    hherTotal = stringToFloat(hherTotal);

    sendAjax('hherTotalAno', function (returned) {
        if (typeof returned != 'string') {
            returned = 0;
        }
        var total = parseFloat(hherTotal) + parseFloat(returned);
        $('#hherTotalAno').val(floatToString(total));
    });

}

var tfca = function () {
    var acidComAfast = $('#acidComAfast').val() || '0'; //Campo 2.1
    var hherTotal = $('#hherTotal').val() || '1'; //Campo 1.5

    hherTotal = stringToFloat(hherTotal);

    var totalMes = (parseInt(acidComAfast) * 1000000) / parseFloat(hherTotal);
    $('#tfcaMes').val(floatToString(totalMes));

    sendAjax('tfca', function (returned) {
        if (typeof returned != 'string') {
            returned = 0;
        }
        var total = ((parseInt(acidComAfast) + parseFloat(returned)) * 1000000) / parseFloat(hherTotal);
        $('#tfca').val(floatToString(total));
    });
}

var txGravAcum = function () {
    var acidComAfastDiasPerd = $('#acidComAfastDiasPerd').val() || '0'; //Campo 2.2
    var acidComAfastDiasDebit = $('#acidComAfastDiasDebit').val() || '0'; //Campo 2.3
    var hherTotal = $('#hherTotal').val() || '1';

    hherTotal = stringToFloat(hherTotal);

    var totalMes = ((parseInt(acidComAfastDiasPerd) + parseInt(acidComAfastDiasDebit)) * 1000000) / parseFloat(hherTotal);
    $('#txGravAcumMes').val(Math.round(totalMes));

    sendAjax('txGravAcum', function (returned) {
        if (typeof returned != 'string') {
            returned = 0;
        }
        var total = ((parseInt(acidComAfastDiasPerd) + parseInt(acidComAfastDiasDebit) + parseInt(returned)) * 1000000) / parseFloat(hherTotal);
        $('#txGravAcum').val(Math.round(total));
    });


}

var tfsa = function () {
    var nAcidSemAfast = $('#nAcidSemAfast').val() || '0'; //Campo 2.6
    var hherTotal = $('#hherTotal').val() || '1'; //Campo 1.5

    hherTotal = stringToFloat(hherTotal);


    var totalMes = (parseInt(nAcidSemAfast) * 1000000) / parseFloat(hherTotal);
    $('#tfsaMes').val(floatToString(totalMes));

    sendAjax('tfsa', function (returned) {
        if (typeof returned != 'string') {
            returned = 0;
        }
        var total = ((parseInt(nAcidSemAfast) + parseFloat(returned)) * 1000000) / parseFloat(hherTotal);
        $('#tfsa').val(floatToString(total));
    });
}

var tor = function () {
    var acidComAfast = $('#acidComAfast').val() || '0';
    var nAcidSemAfast = $('#nAcidSemAfast').val() || '0';
    var hherTotal = $('#hherTotal').val() || '1';

    hherTotal = stringToFloat(hherTotal);

    var totalMes = ((parseInt(acidComAfast) + parseInt(nAcidSemAfast)) * 1000000) / parseFloat(hherTotal);
    $('#torMes').val(floatToString(totalMes));

    sendAjax('tor', function (returned) {
        if (typeof returned != 'string') {
            returned = 0;
        }
        var total = ((parseInt(acidComAfast) + parseInt(nAcidSemAfast) + returned) * 1000000) / parseFloat(hherTotal);
        $('#tor').val(floatToString(total));
    });
}

var percHhTrein = function () {
    var totalHht = $('#totalHht').val() || '0';
    var hherTotal = $('#hherTotal').val() || '1';

    hherTotal = stringToFloat(hherTotal);

    var total = parseInt(totalHht) / parseFloat(hherTotal);
    $('#percHhTrein').val(floatToString(total));
}

var sendAjax = function (field, callback) {
    var comp = $('#comp').val();
    var cc = $('#cc').val();

    if (comp != '' && cc != "") {
        $.ajax({
            method: 'POST',
            url: base_url_intranet + '/forms/indicadores_sgi/formulasAjax',
            cache: false,
            dataType: "json",
            data: {
                comp: comp,
                cc: cc,
                field: field,
            },
            success: callback,
        });
    }
}

var floatToString = function (n, c, d, t) {
    c = isNaN(c = Math.abs(c)) ? 2 : c,
            d = d == undefined ? "," : d,
            t = t == undefined ? "." : t,
            s = n < 0 ? "-" : "",
            i = parseInt(n = Math.abs(+n || 0).toFixed(c)) + "",
            j = (j = i.length) > 3 ? j % 3 : 0;

    return s + (j ? i.substr(0, j) + t : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t) + (c ? d + Math.abs(n - i).toFixed(c).slice(2) : "");
}

var stringToFloat = function (valor) {
    return isNaN(valor) == false ? parseFloat(valor) : parseFloat(valor.replace("R$", "").replace(".", "").replace(",", "."));
}