{{ content() }}

<div class="card">
    <div class="card-header">
        <h2>Centro de Custos <small>Digite abaixo o centro de custo desejado e então clique no botão Buscar.</small></h2>
    </div>
    <div class="card-body card-padding">
        <div class="row">
            {{ form('consultas/centroCustos', 'role': 'form', 'method': 'post', 'autocomplete': 'off', 'onsubmit': 'overlay(true)') }}
            <div class="col-sm-4">
                <div class="input-group fg-float">
                    <span class="input-group-addon"><i class="zmdi zmdi-keyboard"></i></span>
                    <div class="fg-line">
                        <input type="text" class="form-control" name="centro_custo" id="centro_custo" value="{{ pesquisa }}" onclick="this.select()" required />
                        <label class="fg-label">Digite sua pesquisa</label>
                    </div>
                </div>
            </div>
            <div class="col-sm-2">
                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-sm m-t-5 waves-effect">Buscar</button>
                </div>
            </div>

        </div>
        {{ end_form() }}
    </div>
</div>
{% if pesquisa is not empty %}
<div class="card">
    <div class="card-header">
        Resultado para pesquisa: {{ pesquisa }}
    </div>
    <div class="card-body card-padding">
        <div class="table-responsive">
            {% if centro_custos is not empty %}
            <table class="table table-striped table-vmiddle datatable">
                <thead>
                    <tr>
                        <th data-column-id="CTT_CUSTO">Código</th>
                        <th data-column-id="CTT_CLASSE">Classe</th>
                        <th data-column-id="CTT_DESC01">Descrição</th>
                        <th data-column-id="CTT_XBLMOV">Bloqueiado</th>
                        <th data-column-id="CTT_CCSUP">CC Superior</th>
                        <th data-column-id="CTT_OPERAC">Operação</th>
                    </tr>
                </thead>
                <tbody>
                    {% for centro_custo in centro_custos %}
                    <tr>
                        <td>{{ centro_custo['CTT_CUSTO']|trim }}</td>
                        <td>{{ centro_custo['CTT_CLASSE']|trim }}</td>
                        <td>{{ centro_custo['CTT_DESC01']|trim }}</td>
                        <td>
                            {% if centro_custo['CTT_XBLMOV']|trim is empty%}
                            S
                            {% endif %}
                        </td>
                        <td>{{ centro_custo['CTT_CCSUP']|trim }}</td>
                        <td>{{ centro_custo['CTT_OPERAC']|trim }}</td>
                    </tr>
                    {% endfor %}
                </tbody>
            </table>
            {% else %}
            <table class="table table-striped table-vmiddle">
                <tr><td>Não há dados a exibir</td></tr>
            </table>
            {% endif %}
        </div>
    </div>
</div>
{% endif %}