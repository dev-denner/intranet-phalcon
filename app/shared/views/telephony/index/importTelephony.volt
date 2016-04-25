{{ content() }}

<div class="card">
    <div class="card-header">
        <h2>Importar dados para Telefonia <small>Clique no botão para importar os dados do mês corrente.</small></h2>
    </div>
    <div class="card-body card-padding">
        <div class="row">
            {{ form('telephony/index/importTelephony', 'role': 'form', 'method': 'post', 'autocomplete': 'off', 'onsubmit': 'overlay(true)') }}
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
