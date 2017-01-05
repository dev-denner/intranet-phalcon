{{ content() }}

<div id="errors" class="text-danger"></div>

<div class="card">
    <div class="card-header">
        <h2>Processos <small>Digite abaixo o processo desejado e então clique no botão Buscar.</small></h2>
    </div>
    <div class="card-body card-padding">
        <div class="row">
            {{ form('consultas/processos', 'role': 'form', 'method': 'post', 'autocomplete': 'off', 'onsubmit': 'overlay(true)') }}
            <div class="col-sm-6">
                <div class="input-group fg-float">
                    <span class="input-group-addon"><i class="zmdi zmdi-keyboard"></i></span>
                    <div class="fg-line">
                        <input type="text" class="form-control" name="processos" id="processos" value="{{ pesquisa }}" onclick="this.select()" />
                        <label class="fg-label">Digite sua pesquisa</label>
                    </div>
                </div>
            </div>
            <div class="col-sm-1">
                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-sm m-t-5 waves-effect">Buscar</button>
                    <br class="visible-xs-block" />
                    <br class="visible-xs-block" />
                </div>
            </div>
            {{ end_form() }}
        </div>
    </div>
</div>
<div class="card">
    <div class="card-header">
        Resultado para pesquisa: <span class="text-danger">{{ pesquisa }}</span>
        <ul class="actions">
            {% if export %}
            <li>
                {{ link_to('export?obj=processos&type=excel&search='~pesquisa, '<i class="fa fa-file-excel-o c-green" aria-hidden="true"></i>', 'class': 'tooltips', 'title': 'Exportar para Excel', 'target': '_new') }}
            </li>
            <li>
                {{ link_to('export?obj=processos&type=pdf&search='~pesquisa, '<i class="fa fa-file-pdf-o c-red" aria-hidden="true"></i>', 'class': 'tooltips', 'title': 'Exportar para PDF', 'target': '_new') }}
            </li>
            {% endif %}
        </ul>
    </div>
    <div class="card-body card-padding">
        <div class="table-responsive">
            {% if processos is not empty %}
            <table class="table table-striped table-vmiddle datatable">
                <thead>
                    <tr>
                        <th data-column-id="code">Código</th>
                        <th data-column-id="department">Departamento</th>
                        <th data-column-id="description">Descrição</th>
                        <th data-column-id="link" data-formatter="link">Link ECM</th>
                        <th data-column-id="version">Versão</th>
                        <th data-column-id="dateUpdated">Dt. Atualização</th>
                    </tr>
                </thead>
                <tbody>
                    {% for processo in processos %}
                    <tr>
                        <td>{{ processo.code }}</td>
                        <td>{{ processo.departments.title }}</td>
                        <td>{{ processo.description }}</td>
                        <td>{{ processo.link }}|Abrir</td>
                        <td>{{ processo.version }}</td>
                        <td>{{ processo.dateUpdated }}</td>
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
