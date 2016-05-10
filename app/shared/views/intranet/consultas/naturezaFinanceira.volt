{{ content() }}

<div class="card">
    <div class="card-header">
        <h2>Naturezas Financeiras <small>Digite a informação desejada ou deixe em branco para buscar TODOS os dados disponíveis.</small></h2>
    </div>
    <div class="card-body card-padding">
        <div class="row">
            {{ form('consultas/naturezaFinanceira', 'role': 'form', 'method': 'post', 'autocomplete': 'off', 'onsubmit': 'overlay(true)') }}
            <div class="col-sm-4">
                <div class="input-group fg-float">
                    <span class="input-group-addon"><i class="zmdi zmdi-keyboard"></i></span>
                    <div class="fg-line">
                        <input type="text" class="form-control" name="natureza_financeira" id="natureza_financeira" value="{{ pesquisa }}" onclick="this.select()" />
                        <label class="fg-label">Digite sua pesquisa</label>
                    </div>
                    <p class="help-block">Buscar por Código, Descrição, Tipo ou Uso.</p>
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

<div class="card">
    <div class="card-header">
        Resultado para pesquisa: <span class="text-danger">{{ pesquisa }}</span>
        <ul class="actions">
            {% if export %}
            <li>
                {{ link_to('export?obj=natureza_financeria&type=excel&search='~pesquisa, '<i class="fa fa-file-excel-o c-green" aria-hidden="true"></i>', 'class': 'tooltips', 'title': 'Exportar para Excel', 'target': '_new') }}
            </li>
            <li>
                {{ link_to('export?obj=natureza_financeria&type=pdf&search='~pesquisa, '<i class="fa fa-file-pdf-o c-red" aria-hidden="true"></i>', 'class': 'tooltips', 'title': 'Exportar para PDF', 'target': '_new') }}
            </li>
            {% endif %}
        </ul>
    </div>
    <div class="card-body card-padding">
        <div class="table-responsive">
            <table class="table table-striped table-vmiddle datatable">
                <thead>
                    <tr>
                        <th data-column-id="CODIGO">Código</th>
                        <th data-column-id="DESCRICAO">Descrição</th>
                        <th data-column-id="TIPO">Tipo</th>
                        <th data-column-id="USO">Uso</th>
                        <th data-column-id="CALCULA_IRRF">IRRF</th>
                        <th data-column-id="CALCULA_ISS">ISS</th>
                        <th data-column-id="CALCULA_INSS">INSS</th>
                        <th data-column-id="CALCULA_CSLL">CSLL</th>
                        <th data-column-id="CALCULA_PIS">PIS</th>
                        <th data-column-id="CALCULA_COFINS">COFINS</th>
                        <th data-column-id="BLOQUEADO">BLQ</th>
                    </tr>
                </thead>
                <tbody>
                    {% for natureza_financeira in natureza_financeiras %}
                    <tr>
                        <td>{{ natureza_financeira.CODIGO }}</td>
                        <td>{{ natureza_financeira.DESCRICAO }}</td>
                        <td>{{ natureza_financeira.TIPO }}</td>
                        <td>{{ natureza_financeira.USO }}</td>
                        <td>{{ natureza_financeira.CALCULA_IRRF }}</td>
                        <td>{{ natureza_financeira.CALCULA_ISS }}</td>
                        <td>{{ natureza_financeira.CALCULA_INSS }}</td>
                        <td>{{ natureza_financeira.CALCULA_CSLL }}</td>
                        <td>{{ natureza_financeira.CALCULA_PIS }}</td>
                        <td>{{ natureza_financeira.CALCULA_COFINS }}</td>
                        <td>{{ natureza_financeira.BLOQUEADO }}</td>
                    </tr>
                    {% endfor %}
                </tbody>
            </table>
        </div>
    </div>
</div>