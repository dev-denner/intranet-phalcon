{{ content() }}

<div class="card">
    <div class="card-header">
        <h2>Produtos e Serviços <small>Digite abaixo o produto ou serviço desejado e então clique no botão Buscar.</small></h2>
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
        Resultado para pesquisa: {{ pesquisa }}
    </div>
    <div class="card-body card-padding">
        <div class="table-responsive">
            {% if produtos is not empty %}
            <table class="table table-striped table-vmiddle datatable">
                <thead>
                    <tr>
                        <th data-column-id="CODIGO" data-type="numeric">CÓDIGO</th>
                        <th data-column-id="DESCPROD">DESCRIÇÃO PRODUTO</th>
                        <th data-column-id="DESCPRODCOMP">DESCRIÇÃO PRODUTO COMPLETA</th>
                        <th data-column-id="GRUPO">GRUPO</th>
                        <th data-column-id="UM">UM</th>
                        <th data-column-id="NCM">NCM</th>
                    </tr>
                </thead>
                <tbody>
                    {% for produto in produtos %}
                    <tr>
                        <td>{{ produto['CODIGO']|trim }}</td>
                        <td>{{ produto['DESCPROD']|trim }}</td>
                        <td>{{ produto['DESCPRODCOMP']|trim }}</td>
                        <td>{{ produto['DESCGRUPO']|trim }}</td>
                        <td>{{ produto['UM']|trim }}</td>
                        <td>{{ produto['NCM']|trim }}</td>
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
