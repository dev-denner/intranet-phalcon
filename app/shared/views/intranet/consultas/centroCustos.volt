{{ content() }}

<div class="card">
    <div class="card-header">
        <h2>Centros de Custos <small>Digite a informação desejada ou deixe em branco para buscar TODOS os dados disponíveis.</small></h2>
    </div>
    <div class="card-body card-padding">
        <div class="row">
            {{ form('consultas/centroCustos', 'role': 'form', 'method': 'post', 'autocomplete': 'off', 'onsubmit': 'overlay(true)') }}
            <div class="col-sm-4">
                <div class="input-group fg-float">
                    <span class="input-group-addon"><i class="zmdi zmdi-keyboard"></i></span>
                    <div class="fg-line">
                        <input type="text" class="form-control" name="centro_custo" id="centro_custo" value="{{ pesquisa }}" onclick="this.select()" />
                        <label class="fg-label">Digite sua pesquisa</label>
                    </div>
                    <p class="help-block">Buscar por Código, Descrição, Gestor, Empresa ou Operação.</p>
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
{% if centro_custos is not empty %}
<div class="card">
    <div class="card-header">
        Resultado para pesquisa: <span class="text-danger">{{ pesquisa }}</span>
        <ul class="actions">
            {% if export %}
            <li>
                {{ link_to('export?obj=centro_custo&type=excel&search='~pesquisa, '<i class="fa fa-file-excel-o c-green" aria-hidden="true"></i>', 'class': 'tooltips', 'title': 'Exportar para Excel', 'target': '_new') }}
            </li>
            <li>
                {{ link_to('export?obj=centro_custo&type=pdf&search='~pesquisa, '<i class="fa fa-file-pdf-o c-red" aria-hidden="true"></i>', 'class': 'tooltips', 'title': 'Exportar para PDF', 'target': '_new') }}
            </li>
            {% endif %}
        </ul>
    </div>
    <div class="card-body card-padding">
        <div class="table-responsive">
            <table class="table table-striped table-vmiddle datatable">
                <thead>
                    <tr>
                        <th data-column-id="CODIGO_CC">Código</th>
                        <th data-column-id="DESCRICAO_CC">Descrição</th>
                        <th data-column-id="NOME_EMPRESA">Empresa</th>
                        <th data-column-id="NOME_GESTOR">Gestor</th>
                        <th data-column-id="DESCRICAO_OPERACAO">Operação</th>
                        <th data-column-id="DATA_BLOQUEIO">Blq</th>
                        <th data-column-id="NOVO_CODIGO_CC">Novo Código (De/Para)</th>
                    </tr>
                </thead>
                <tbody>
                    {% for centro_custo in centro_custos %}
                    <tr>
                        <td>{{ centro_custo.CODIGO_CC }}</td>
                        <td>{{ centro_custo.DESCRICAO_CC }}</td>
                        <td>{{ centro_custo.CODIGO_EMPRESA }} - {{ centro_custo.NOME_EMPRESA }}</td>
                        <td>{{ centro_custo.CODIGO_GESTOR }} - {{ centro_custo.NOME_GESTOR }}</td>
                        <td>{{ centro_custo.CODIGO_OPERACAO }} - {{ centro_custo.DESCRICAO_OPERACAO }}</td>
                        <td>{{ centro_custo.DATA_BLOQUEIO }}</td>
                        <td>{{ centro_custo.NOVO_CODIGO_CC }}</td>
                    </tr>
                    {% endfor %}
                </tbody>
            </table>
        </div>
    </div>
</div>
{% endif %}