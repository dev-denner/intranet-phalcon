{{ content() }}
<div class="card">
    <div class="card-header">
        <h2>Processos<small>Processos do Departamento</small></h2>
    </div>
</div>

{% for departament in departaments %}
{% if count(departament.Processos) > 0 %}
<div class="card">
    <div class="card-header">
        <div class="title_category">
            <h3 data-id="{{ departament.id }}"><i class="{{ departament.icon }}"></i> {{ departament.title }}</h3>
        </div>
        <ul class="actions">
            <li>
                {{ link_to('export?obj=processos&type=excel&search=|'~departament.id, '<i class="fa fa-file-excel-o c-green" aria-hidden="true"></i>', 'class': 'tooltips', 'title': 'Exportar para Excel', 'target': '_new') }}
            </li>
            <li>
                {{ link_to('export?obj=processos&type=pdf&search=|'~departament.id, '<i class="fa fa-file-pdf-o c-red" aria-hidden="true"></i>', 'class': 'tooltips', 'title': 'Exportar para PDF', 'target': '_new') }}
            </li>
        </ul>
    </div>
    <div class="card-body card-padding">
        <div class="table-responsive">

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
                    {% for processo in departament.Processos %}
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
        </div>
    </div>
</div>
{% endif %}
{% endfor %}