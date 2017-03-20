{{ content() }}

<div class="card">
    <div class="card-header">
        <h2>Requisitos Mínimos <small>Digite a informação desejada ou deixe em branco para buscar TODOS os dados disponíveis.</small></h2>
    </div>
    <div class="card-body card-padding">
        <div class="row">
            {{ form('consultas/requisitoMinimo', 'role': 'form', 'method': 'post', 'autocomplete': 'off', 'onsubmit': 'overlay(true)') }}
            <div class="col-sm-4">
                <div class="input-group fg-float">
                    <span class="input-group-addon"><i class="zmdi zmdi-keyboard"></i></span>
                    <div class="fg-line">
                        <input type="text" class="form-control" name="requisito_minimo" id="requisito_minimo" value="{{ pesquisa }}" onclick="this.select()" />
                        <label class="fg-label">Digite sua pesquisa</label>
                    </div>
                    <p class="help-block">Buscar por Código ou Descrição.</p>
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
{% if requisito_minimos is not empty %}
<div class="card">
    <div class="card-header">
        Resultado para pesquisa: <span class="text-danger">{{ pesquisa }}</span>
        <ul class="actions">
            {% if export %}
            <li>
                {{ link_to('export?obj=requisitos_minimos&type=excel&search='~pesquisa, '<i class="fa fa-file-excel-o c-green" aria-hidden="true"></i>', 'class': 'tooltips', 'title': 'Exportar para Excel', 'target': '_new') }}
            </li>
            <li>
                {{ link_to('export?obj=requisitos_minimos&type=pdf&search='~pesquisa, '<i class="fa fa-file-pdf-o c-red" aria-hidden="true"></i>', 'class': 'tooltips', 'title': 'Exportar para PDF', 'target': '_new') }}
            </li>
            {% endif %}
        </ul>
    </div>
    <div class="card-body card-padding">
        <div class="table-responsive">
            <table class="table table-striped table-vmiddle datatable">
                <thead>
                    <tr>
                        <th data-column-id="CODIGO_REQMIN">Código</th>
                        <th data-column-id="DESCRICAO_REQMIN">Descrição</th>
                    </tr>
                </thead>
                <tbody>
                    {% for requisito_minimo in requisito_minimos %}
                    <tr>
                        <td>{{ requisito_minimo.CODIGO_REQMIN }}</td>
                        <td>{{ requisito_minimo.DESCRICAO_REQMIN }}</td>
                    </tr>
                    {% endfor %}
                </tbody>
            </table>
        </div>
    </div>
</div>
{% endif %}