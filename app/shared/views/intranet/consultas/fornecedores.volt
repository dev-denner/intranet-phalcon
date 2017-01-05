{{ content() }}

<div class="card">
    <div class="card-header">
        <h2>Fornecedores <small>Digite a informação desejada.</small></h2>
    </div>
    <div class="card-body card-padding">
        <div class="row">
            {{ form('consultas/fornecedores', 'role': 'form', 'method': 'post', 'autocomplete': 'off', 'onsubmit': 'overlay(true)') }}
            <div class="col-sm-4">
                <div class="input-group fg-float">
                    <span class="input-group-addon"><i class="zmdi zmdi-keyboard"></i></span>
                    <div class="fg-line">
                        <input type="text" class="form-control" name="fornecedor" id="fornecedor" value="{{ pesquisa }}" onclick="this.select()" required />
                        <label class="fg-label">Digite sua pesquisa</label>
                    </div>
                    <p class="help-block">Buscar por Código, Nome ou CNPJ.</p>
                </div>
            </div>
            <div class="col-sm-2">
                <button type="submit" class="btn btn-primary btn-sm m-t-5 waves-effect">Buscar</button>
            </div>
            <div class="col-sm-12">
                <br />
                Nº de fornecedores cadastrados: <span class="badge receive fornecedores"></span>
                <br />
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
                {{ link_to('export?obj=fornecedores&type=excel&search='~pesquisa, '<i class="fa fa-file-excel-o c-green" aria-hidden="true"></i>', 'class': 'tooltips', 'title': 'Exportar para Excel', 'target': '_new') }}
            </li>
            <li>
                {{ link_to('export?obj=fornecedores&type=pdf&search='~pesquisa, '<i class="fa fa-file-pdf-o c-red" aria-hidden="true"></i>', 'class': 'tooltips', 'title': 'Exportar para PDF', 'target': '_new') }}
            </li>
            {% endif %}
        </ul>
    </div>
    <div class="card-body card-padding">
        <div class="table-responsive">
            <table class="table table-striped table-vmiddle datatable2">
                <thead>
                    <tr>
                        <th data-column-id="CODIGO">CÓDIGO</th>
                        <th data-column-id="LOJA">LOJA</th>
                        <th data-column-id="NOME">NOME</th>
                        <th data-column-id="CNPJ">CNPJ</th>
                        <th data-column-id="UF">UF</th>
                        <th data-column-id="MUNICIPIO">MUNICÍPIO</th>
                        <th data-column-id="BLQ">BLQ</th>
                    </tr>
                </thead>
                <tbody>
                    {% for fornecedor in fornecedores %}
                    <tr>
                        <td>{{ fornecedor.CODIGO }}</td>
                        <td>{{ fornecedor.LOJA }}</td>
                        <td>{{ fornecedor.NOME }}</td>
                        <td>{{ fornecedor.CNPJ }}</td>
                        <td>{{ fornecedor.UF }}</td>
                        <td>{{ fornecedor.MUNICIPIO }}</td>
                        <td>{{ fornecedor.BLQ }}</td>
                    </tr>
                    {% endfor %}
                </tbody>
            </table>
        </div>
    </div>
</div>
{% endif %}
