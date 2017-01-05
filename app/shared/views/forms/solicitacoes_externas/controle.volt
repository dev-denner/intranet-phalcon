{{ content() }}

<div id="errors" class="text-danger"></div>

<div class="card">
    <div class="card-header">
        <h2>Solicitações Externas</h2>
    </div>
    <div class="card-body card-padding">
    </div>
</div>

{% if solicitacoes_externas is not empty %}
<div class="card">
    <div class="card-body card-padding">
        <div class="table-responsive">
            <table class="table table-striped table-vmiddle datatable">
                <thead>
                    <tr>
                        <th data-column-id="id" data-type="numeric">ID</th>
                        <th data-column-id="cpf">CPF</th>
                        <th data-column-id="type">Tipo</th>
                        <th data-column-id="status">Status</th>
                        <th data-column-id="commands" data-formatter="commands3" data-sortable="false">Comandos</th>
                    </tr>
                </thead>
                <tbody>
                    {% for solicitacao_externa in solicitacoes_externas %}
                    <tr>
                        <td>{{ solicitacao_externa.id }}</td>
                        <td>{{ solicitacao_externa.cpf }}</td>
                        <td>{{ solicitacao_externa.type }}</td>
                        <td>
                            {% if solicitacao_externa.status == 'A'%}
                            Aberto
                            {% else %}
                            Encerrado
                            {% endif %}
                        </td>
                        <td>{{ static_url('forms/solicitacoes_externas') }}</td>
                    </tr>
                    {% endfor %}
                </tbody>
            </table>

        </div>
    </div>
</div>
{% endif %}