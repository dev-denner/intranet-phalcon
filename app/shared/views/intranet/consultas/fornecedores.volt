{{ content() }}

<div class="card">
    <div class="card-header">
        <h2>Fornecedores <small>Digite abaixo o fornecedor desejado e então clique no botão Buscar.</small></h2>
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
        Resultado para pesquisa: {{ pesquisa }}
    </div>
    <div class="card-body card-padding">
        <div class="table-responsive">
            {% if fornecedores is not empty %}
            <table class="table table-striped table-vmiddle datatable">
                <thead>
                    <tr>
                        <th data-column-id="CODIGO" data-type="numeric">CÓDIGO</th>
                        <th data-column-id="LOJA">LOJA</th>
                        <th data-column-id="NOME">NOME</th>
                        <th data-column-id="CGC">CGC</th>
                        <th data-column-id="UF">UF</th>
                        <th data-column-id="MUNICIPIO">MUNICÍPIO</th>
                        <th data-column-id="BLQ">BLQ</th>
                    </tr>
                </thead>
                <tbody>
                    {% for fornecedor in fornecedores %}
                    <tr>
                        <td>{{ fornecedor['CODIGO']|trim }}</td>
                        <td>{{ fornecedor['LOJA']|trim }}</td>
                        <td>{{ fornecedor['NOME']|trim }}</td>
                        <td>{{ fornecedor['CGC']|trim }}</td>
                        <td>{{ fornecedor['UF']|trim }}</td>
                        <td>{{ fornecedor['MUNICIPIO']|trim }}</td>
                        <td>{{ fornecedor['BLQ']|trim }}</td>
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
