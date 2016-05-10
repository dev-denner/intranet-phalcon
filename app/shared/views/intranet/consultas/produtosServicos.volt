{{ content() }}

<div class="card">
    <div class="card-header">
        <h2>Produtos e Serviços <small>Digite a informação desejada.</small></h2>
    </div>
    <div class="card-body card-padding">
        <div class="row">
            {{ form('produtos', 'role': 'form', 'method': 'post', 'autocomplete': 'off', 'onsubmit': 'overlay(true)') }}
            <div class="col-sm-4">
                <div class="input-group fg-float">
                    <span class="input-group-addon"><i class="zmdi zmdi-keyboard"></i></span>
                    <div class="fg-line">
                        <input type="text" class="form-control" name="produto" id="produto" value="{{ pesquisa }}" onclick="this.select()" required />
                        <label class="fg-label">Digite sua pesquisa</label>
                    </div>
                    <p class="help-block">Buscar por Código, Descrição ou Grupo.</p>
                </div>
            </div>
            <div class="col-sm-2">
                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-sm m-t-5 waves-effect">Buscar</button>
                </div>
            </div>
            <div class="col-sm-12">
                <br />
                Nº de produtos cadastrados: <span class="badge receive produtos"></span>
                <br />
                Nº de serviços cadastrados: <span class="badge receive servicos"></span>
                <br />
            </div>
        </div>
        {{ end_form() }}
    </div>
</div>
{% if pesquisa is not empty %}
<div class="card">
    <div class="card-header">
        Resultado para pesquisa: <span class="text-danger">{{ pesquisa }}</span>
        <ul class="actions">
            {% if export %}
            <li>
                {{ link_to('export?obj=produtos&type=excel&search='~pesquisa, '<i class="fa fa-file-excel-o c-green" aria-hidden="true"></i>', 'class': 'tooltips', 'title': 'Exportar para Excel', 'target': '_new') }}
            </li>
            <li>
                {{ link_to('export?obj=produtos&type=pdf&search='~pesquisa, '<i class="fa fa-file-pdf-o c-red" aria-hidden="true"></i>', 'class': 'tooltips', 'title': 'Exportar para PDF', 'target': '_new') }}
            </li>
            {% endif %}
        </ul>
    </div>
    <div class="card-body card-padding">
        <div class="table-responsive">
            <table class="table table-striped table-vmiddle datatable">
                <thead>
                    <tr>
                        <th data-column-id="CODIGO" data-type="numeric">CÓDIGO</th>
                        <th data-column-id="DESCRICAO">DESCRIÇÃO</th>
                        <th data-column-id="DESCRICAO_COMPLETA">DESCRIÇÃO COMPLETA</th>
                        <th data-column-id="DESCRICAO_GRUPO">GRUPO</th>
                        <th data-column-id="UN">UN</th>
                        <th data-column-id="NCM">NCM</th>
                    </tr>
                </thead>
                <tbody>
                    {% for produto in produtos %}
                    <tr>
                        <td>{{ produto.CODIGO }}</td>
                        <td>{{ produto.DESCRICAO }}</td>
                        <td>{{ produto.DESCRICAO_COMPLETA }}</td>
                        <td>{{ produto.DESCRICAO_GRUPO }}</td>
                        <td>{{ produto.UN }}</td>
                        <td>{{ produto.NCM }}</td>
                    </tr>
                    {% endfor %}
                </tbody>
            </table>
        </div>
    </div>
</div>
{% endif %}
