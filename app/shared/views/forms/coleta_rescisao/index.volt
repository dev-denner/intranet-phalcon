{{ content() }}

<div id="errors" class="text-danger"></div>

<div class="card">
    <div class="card-header">
        <h2>Coleta de Informações para Rescisão Contratual
            {{ link_to('forms/coleta_rescisao/new', 'Novo', 'class': 'btn btn-success btn-sm m-t-5 waves-effect pull-right') }}
        </h2>
    </div>
    <div class="card-body card-padding">
    </div>
</div>

{% if coleta_rescisoes is not empty %}
<div class="card">
    <div class="card-body card-padding">
        <div class="table-responsive">
            <table class="table table-striped table-vmiddle datatable">
                <thead>
                    <tr>
                        <th data-column-id="id" data-type="numeric">ID</th>
                        <th data-column-id="sequence">Pasta</th>
                        <th data-column-id="status">Status</th>
                        <th data-column-id="commands" data-formatter="commands2" data-sortable="false">Comandos</th>
                    </tr>
                </thead>
                <tbody>
                    {% for coleta_rescisao in coleta_rescisoes %}
                    <tr>
                        <td>{{ coleta_rescisao.id }}</td>
                        <td>{{ coleta_rescisao.sequence }}</td>
                        <td>
                            {% if coleta_rescisao.status == 'A'%}
                            Aberto
                            {% else %}
                            Enviado
                            {% endif %}
                        </td>
                        <td>{{ static_url('forms/coleta_rescisao') }}</td>
                    </tr>
                    {% endfor %}
                </tbody>
            </table>

        </div>
    </div>
</div>
{% endif %}