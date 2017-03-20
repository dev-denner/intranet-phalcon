{{ content() }}

<div class="card">
    <div class="card-header">
        <h2>Extrato Geral de Conta <small>Escolha o número da linha desejado e então clique no botão Buscar.</small></h2>
    </div>
    <div class="card-body card-padding">
        <div class="row">
            {{ form('telephony/index/contaCelularAdmin/', 'role': 'form', 'method': 'post', 'autocomplete': 'off', 'onsubmit': 'overlay(true)') }}
            <div class="col-sm-4">
                <div class="input-group fg-float">
                    <span class="input-group-addon"><i class="zmdi zmdi-keyboard"></i></span>
                    <div class="fg-line">
                        <div class="select">
                            <?php
                            echo $this->tag->select(['linhas',
                                $linhas,
                                'useEmpty' => true,
                                'emptyText' => 'Linhas (Escolha uma opção)',
                                'emptyValue' => '',
                                'class' => 'form-control',
                                'required' => 'required']
                            );
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="input-group fg-float">
                    <span class="input-group-addon"><i class="zmdi zmdi-keyboard"></i></span>
                    <div class="fg-line">
                        {{ text_field("mes", "class" : "form-control fg-input monthPicker", 'required': 'required') }}
                        <label class="fg-label">Mês de Referência</label>
                    </div>
                </div>
            </div>
            <div class="col-sm-2">
                <button type="submit" class="btn btn-primary btn-sm m-t-5 waves-effect">Buscar</button>
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
                {{ link_to('export?obj=telefonia&type=excel&search='~pesquisa, '<i class="fa fa-file-excel-o c-green" aria-hidden="true"></i>', 'class': 'tooltips', 'title': 'Exportar para Excel', 'target': '_new') }}
            </li>
            <li>
                {{ link_to('export?obj=telefonia&type=pdf&search='~pesquisa, '<i class="fa fa-file-pdf-o c-red" aria-hidden="true"></i>', 'class': 'tooltips', 'title': 'Exportar para PDF', 'target': '_new') }}
            </li>
            {% endif %}
        </ul>
    </div>
    <div class="card-body card-padding">
        <div class="table-responsive">
            {% if extratos is not empty %}
            <table class="table table-striped table-bordered table-vmiddle datatable">
                <thead>
                    <tr>
                        <th data-column-id="mes">Mês Ref</th>
                        <th data-column-id="numAcs">Linha</th>
                        <th data-column-id="data">Data</th>
                        <th data-column-id="hora">Hora</th>
                        <th data-column-id="origem">Origem</th>
                        <th data-column-id="destino">Destino</th>
                        <th data-column-id="numChamada">Nº Chamado</th>
                        <th data-column-id="tipo">Tipo</th>
                        <th data-column-id="duracao">Duração</th>
                        <th data-column-id="valor">Valor</th>
                    </tr>
                </thead>
                <tbody>
                    {% for extrato in extratos %}
                    <tr>
                        <td>{{ extrato.mes|trim }}</td>
                        <td>{{ extrato.numAcs|trim }}</td>
                        <td>{{ extrato.data|trim }}</td>
                        <td>{{ extrato.hora|trim }}</td>
                        <td>{{ extrato.origem|trim }}</td>
                        <td>{{ extrato.destino|trim }}</td>
                        <td>{{ extrato.numChamada|trim }}</td>
                        <td>{{ extrato.tipo|trim }}</td>
                        <td>{{ extrato.duracao|trim }}</td>
                        <td>R$ {{ number_format(extrato.valor, 2, ',', '.') }}</td>
                    </tr>
                    {% endfor %}
                </tbody>
                <tfoot>
                    {% for total in totais %}
                    <tr>
                        <td>{{ total.mes }}</td>
                        <td>{{ total.numAcs }}</td>
                        <td colspan="3">{{ total.plano }}</td>
                        <td colspan="4">{{ total.tpServ }}</td>
                        <td>R$ {{ number_format(total.valor, 2, ',', '.') }}</td>
                    </tr>
                    {% endfor %}
                    <tr>
                        <td colspan="9"><b>Total</b></td>
                        <td><b>R$ {{ number_format(totalLinha['VALOR'], 2, ',', '.') }}</b></td>
                    </tr>
                </tfoot>
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