{{ content() }}

<div id="errors" class="text-danger"></div>

<div class="card">
    <div class="card-header">
        <h2>Relatório Catraca <small>Digite a informação desejada ou deixe em branco para buscar escolhendo um range de datas.</small></h2>
    </div>
    <div class="card-body card-padding">
        <div class="row">
            {{ form('catraca/reports/', 'role': 'form', 'method': 'post', 'autocomplete': 'off', 'onsubmit': 'overlay(true)') }}
            <div class="col-sm-3">
                <div class="input-group fg-float">
                    <span class="input-group-addon"><i class="zmdi zmdi-keyboard"></i></span>
                    <div class="fg-line">
                        {{ text_field("pesquisa", "class" : "form-control") }}
                        <label class="fg-label">Pesquisa</label>
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="input-group fg-float">
                    <span class="input-group-addon"><i class="zmdi zmdi-calendar"></i></span>
                    <div class="fg-line">
                        {{ text_field("dateFrom", "class" : "form-control datepicker") }}
                        <label class="fg-label">Data de</label>
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="input-group fg-float">
                    <span class="input-group-addon"><i class="zmdi zmdi-calendar"></i></span>
                    <div class="fg-line">
                        {{ text_field("dateTo", "class" : "form-control datepicker") }}
                        <label class="fg-label">Data até</label>
                    </div>
                </div>
            </div>
            <div class="col-sm-1">
                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-sm m-t-5 waves-effect">Busca</button>
                    <br class="visible-xs-block" />
                    <br class="visible-xs-block" />
                </div>
            </div>
            {{ end_form() }}
        </div>
    </div>
</div>
{% if pesquisa is not empty %}
<div class="card">
    <div class="card-header">
        Resultado para pesquisa: <span class="text-danger">{{ pesquisa }}</span>
        <ul class="actions">
            {% if export %}
            <li>
                {{ link_to('export?obj=catraca&type=excel&search='~pesquisa, '<i class="fa fa-file-excel-o c-green" aria-hidden="true"></i>', 'class': 'tooltips', 'title': 'Exportar para Excel', 'target': '_new') }}
            </li>
            <li>
                {{ link_to('export?obj=catraca&type=pdf&search='~pesquisa, '<i class="fa fa-file-pdf-o c-red" aria-hidden="true"></i>', 'class': 'tooltips', 'title': 'Exportar para PDF', 'target': '_new') }}
            </li>
            {% endif %}
        </ul>
    </div>
    <div class="card-body card-padding">
        <div class="table-responsive">
            <table class="table table-striped table-vmiddle datatable">
                <thead>
                    <tr>
                        <th data-column-id="EMPRESA">Empresa</th>
                        <th data-column-id="NOME">Nome</th>
                        <th data-column-id="CPF">CPF</th>
                        <th data-column-id="CCEO">CCEO</th>
                        <th data-column-id="SECAO">Seção</th>
                        <th data-column-id="DATA">Data</th>
                        <th data-column-id="HORA">Hora</th>
                        <th data-column-id="TIPO">Ação</th>
                    </tr>
                </thead>
                <tbody>
                    {% for movimento in movimentos %}
                    <tr>
                        <td>{{ movimento.EMPRESA }}</td>
                        <td>{{ movimento.NOME }}</td>
                        <td>{{ movimento.CPF }}</td>
                        <td>{{ movimento.CCEO }}</td>
                        <td>{{ movimento.SECAO }}</td>
                        <td>{{ movimento.DATA }}</td>
                        <td>{{ movimento.HORA }}</td>
                        <td>{{ movimento.TIPO }}</td>
                    </tr>
                    {% endfor %}
                </tbody>
            </table>
        </div>
    </div>
</div>
{% endif %}