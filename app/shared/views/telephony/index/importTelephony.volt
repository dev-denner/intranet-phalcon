{{ content() }}

<div class="card">
    <div class="card-header">
        <h2>Importar Extrato de Conta <small>Escolha a competência referente ao arquivo setado no banco de dados e então clique no botão para importar os dados.</small></h2>
    </div>
    <div class="card-body card-padding">
        <div class="row">
            {{ form('telephony/index/importTelephony', 'role': 'form', 'method': 'post', 'autocomplete': 'off', 'onsubmit': 'overlay(true)') }}
            <div class="col-sm-4">
                <div class="input-group fg-float">
                    <span class="input-group-addon"><i class="zmdi zmdi-keyboard"></i></span>
                    <div class="fg-line">
                        {{ text_field("mes", "class" : "form-control fg-input monthPicker", 'required': 'required') }}
                        <label class="fg-label">Mês de Referência</label>
                    </div>
                </div>
            </div>
            <div class="col-sm-2">
                <button type="submit" class="btn btn-primary btn-sm m-t-5 waves-effect">Importar</button>
            </div>

            {{ end_form() }}
        </div>
    </div>
</div>
{% if linhasAlteradas is not empty %}
<h3>Foram importados {{ linhasAlteradas }} registros.</h3>
{% endif %}
