{{ content() }}

<div id="errors" class="text-danger"></div>

<div class="card">
    <div class="card-header">
        <h2>Relatório de Chamados <small>Escolha as opções abaixo e então clique no botão Buscar.</small></h2>

    </div>
    <div class="card-body card-padding">

        {{ form('otrs/atendimento', 'role': 'form', 'method': 'post', 'autocomplete': 'off', 'onsubmit': 'overlay(true)') }}
        <div class="row filtro_pesquisar">

            <div class="col-sm-5 col-sm-offset-1">
                <div class="form-group fg-line">
                    <label class="fg-label">Tipo de Chamados</label>
                    <?php
                    echo $this->tag->selectStatic(['tipo', $tipo, 'class' => 'form-control fc-alt']
                    );
                    ?>
                </div>
            </div>

            <div class="col-sm-5">
                <div class="form-group fg-line">
                    <label class="fg-label">Título do Chamado</label>
                    {{ text_field("assunto", "class" : "form-control fg-input fc-alt") }}
                </div>
            </div>
        </div>
        <div class="row filtro_pesquisar">

            <div class="col-sm-5 col-sm-offset-1">
                <div class="form-group fg-line">
                    <label class="fg-label">Fila</label>
                    <?php
                    echo $this->tag->selectStatic(['fila',
                        $fila,
                        'useEmpty' => true,
                        'emptyText' => '',
                        'emptyValue' => '',
                        'class' => 'form-control fc-alt']
                    );
                    ?>
                </div>
            </div>
            <div class="col-sm-5">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="fg-label">Data de</label>
                            <div class="fg-line">
                                {{ text_field("dataDe", "class" : "form-control fg-input datePicker fc-alt") }}
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="fg-label">Data até</label>
                            <div class="fg-line">
                                {{ text_field("dataAte", "class" : "form-control fg-input datePicker fc-alt") }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row filtro_pesquisar">
            <div class="col-sm-5 col-sm-offset-1">
                <div class="form-group fg-line">
                    <label class="fg-label">Gestor</label>
                    <?php
                    echo $this->tag->selectStatic(['gestor',
                        $gestores,
                        'useEmpty' => true,
                        'emptyText' => '',
                        'emptyValue' => '',
                        'class' => 'form-control chosen fc-alt',
                        'data-placeholder' => ' ',
                        'name' => 'gestor[]',
                        'multiple' => true]
                    );
                    ?>
                </div>
            </div>

            <div class="col-sm-5">
                <div class="form-group fg-line">
                    <label class="fg-label">Centro de Custo</label>
                    <?php
                    echo $this->tag->selectStatic(['centrocusto',
                        $ccs,
                        'useEmpty' => true,
                        'emptyText' => '',
                        'emptyValue' => '',
                        'class' => 'form-control chosen fc-alt',
                        'data-placeholder' => ' ',
                        'name' => 'centrocusto[]',
                        'multiple' => true]
                    );
                    ?>
                </div>
            </div>
        </div>

        <div class="row filtro_pesquisar">

            <div class="col-sm-5 col-sm-offset-1">
                <div class="form-group fg-line">
                    <label class="fg-label">Departamento</label>
                    <?php
                    echo $this->tag->selectStatic(['departamento',
                        $departamentos,
                        'useEmpty' => true,
                        'emptyText' => '',
                        'emptyValue' => '',
                        'class' => 'form-control chosen fc-alt',
                        'data-placeholder' => ' ',
                        'name' => 'departamento[]',
                        'multiple' => true]
                    );
                    ?>
                </div>
            </div>

            <div class="col-sm-5">
                <div class="form-group fg-line">
                    <label class="fg-label">Cliente</label>
                    <?php
                    echo $this->tag->select(['cliente',
                        $cliente,
                        'using' => ['cliente', 'cliente'],
                        'useEmpty' => true,
                        'emptyText' => '',
                        'emptyValue' => '',
                        'class' => 'form-control chosen fc-alt',
                        'data-placeholder' => ' ',
                        'name' => 'cliente[]',
                        'multiple' => true]
                    );
                    ?>
                </div>
            </div>

        </div>

        <div class="row filtro_pesquisar">
            <div class="col-sm-5 col-sm-offset-1">
                <div class="form-group fg-line">
                    <label class="fg-label">Responsável</label>
                    <?php
                    echo $this->tag->select(['responsavel',
                        $responsavel,
                        'using' => ['responsavel', 'responsavel'],
                        'useEmpty' => true,
                        'emptyText' => '',
                        'emptyValue' => '',
                        'class' => 'form-control chosen fc-alt',
                        'data-placeholder' => ' ',
                        'name' => 'responsavel[]',
                        'multiple' => true]
                    );
                    ?>
                </div>
            </div>

            <div class="col-sm-5">
                <div class="form-group fg-line">
                    <label class="fg-label">Proprietário</label>
                    <?php
                    echo $this->tag->select(['proprietario',
                        $proprietario,
                        'using' => ['proprietario', 'proprietario'],
                        'useEmpty' => true,
                        'emptyText' => '',
                        'emptyValue' => '',
                        'class' => 'form-control chosen fc-alt',
                        'data-placeholder' => ' ',
                        'name' => 'proprietario[]',
                        'multiple' => true]
                    );
                    ?>
                </div>
            </div>

        </div>

        <div class="row filtro_pesquisar">
            <div class="col-sm-5 col-sm-offset-1">
                <div class="form-group fg-line">
                    <label class="fg-label">Status</label>
                    <?php
                    echo $this->tag->select(['status',
                        $status,
                        'using' => ['status', 'status'],
                        'useEmpty' => true,
                        'emptyText' => '',
                        'emptyValue' => '',
                        'class' => 'form-control chosen fc-alt',
                        'data-placeholder' => ' ',
                        'name' => 'status[]',
                        'multiple' => true]
                    );
                    ?>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <div class="form-group">
                    <div class="pull-right">
                        <button type="submit" class="btn btn-primary btn-sm m-t-5 waves-effect">Buscar</button>
                    </div>
                </div>
            </div>
        </div>
        {{ end_form() }}
    </div>
</div>
<div class="card">
    <div class="card-header">
        Resultado para pesquisa: <span class="text-danger" style="max-width: 80%;display: inline-table;">{{ pesquisa }}</span>

        <ul class="actions">
            {% if export %}
            <li>
                <a href="javascript:;" class="tooltips" title="Exportar para Arquivo" data-toggle="modal" data-target="#modal-exports">
                    <i class="fa fa-download" aria-hidden="true"></i>
                </a>
            </li>
            {% endif %}
        </ul>
    </div>
    <div class="card-body card-padding">
        <div class="table-responsive">
            <table class="table table-striped table-vmiddle datatable">
                <thead>
                    <tr>
                        <th data-column-id="Chamado" data-formatter="linkOtrs">Chamado</th>
                        <th data-column-id="assunto">Assunto</th>
                        <th data-column-id="fila">Fila</th>
                        {% if selTipo == 'Abertos' %}
                        <th data-column-id="dataAbertura">Data Abertura</th>
                        {% else %}
                        <th data-column-id="dataFechamento">Data Fecham.</th>
                        {% endif %}
                        <th data-column-id="status">Status</th>
                        <th data-column-id="diasAberto" data-type="numeric">Dias Ab.</th>
                        <th data-column-id="depto">Depto</th>
                        <th data-column-id="cliente">Cliente</th>
                        <th data-column-id="proprietario">Prop.</th>
                        <th data-column-id="responsavel">Resp.</th>
                    </tr>
                </thead>
                <tbody>
                    {% if chamados is defined %}
                    {% for chamado in chamados %}
                    <tr>
                        <td>{{ chamado.id~'|'~chamado.chamado }}</td>
                        <td>{{ chamado.assunto }}</td>
                        <td>{{ chamado.fila }}</td>
                        {% if selTipo == 'Abertos' %}
                        <td>{{ chamado.dataAbertura }}</td>
                        {% else %}
                        <td>{{ chamado.dataFechamento }}</td>
                        {% endif %}
                        <td>{{ chamado.status }}</td>
                        <td>{{ chamado.diasAberto }}</td>
                        <td>{{ chamado.depto }}</td>
                        <td>{{ chamado.cliente }}</td>
                        <td>{{ chamado.proprietario }}</td>
                        <td>{{ chamado.responsavel }}</td>
                    </tr>
                    {% endfor %}
                    {% endif %}
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="modal fade" id="modal-exports" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Exportar para arquivo</h4>
            </div>
            {{ form('otrs/atendimento/relatorio', 'role': 'form', 'method': 'post', 'autocomplete': 'off', 'target': '_blank') }}
            <div class="modal-body">
                {{ hidden_field("search", "value" : search) }}
                {{ hidden_field("questions", "value" : questions) }}

                <div class="row">
                    <div class="col-sm-8 col-sm-offset-1">
                        <div class="form-group fg-line">
                            <label class="fg-label">Campos</label>
                            <div class="row">
                                <div class="col-sm-4">
                                    <?php
                                    $i = 0;
                                    $count = count($fields['fields']) / 3;
                                    ?>
                                    <?php foreach ($fields['fields'] as $key => $field): ?>
                                        <label class="checkbox checkbox-inline check-legend">
                                            {{ check_field('fields'~i, 'value' : field, 'name': 'fields['~key~']') }}
                                            <i class="input-helper"></i> {{ field }}
                                        </label>
                                        <br />
                                        <?php $i++; ?>
                                        <?php if ($i > $count): ?>
                                        </div>
                                        <div class="col-sm-4">
                                            <?php $i = 0; ?>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </div>
                                <div class="col-sm-6">
                                    <label class="checkbox checkbox-inline check-legend">
                                        {{ check_field('fields_all', 'value' : '') }}
                                        <i class="input-helper"></i> Marcar / Desmarcar Todos
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group fg-line">
                            <label class="fg-label">Exportar para</label>
                            <?php
                            echo $this->tag->selectStatic(['type_export',
                                ['excel' => 'Excel', 'pdf' => 'PDF'],
                                'class' => 'form-control fc-alt',
                                'data-placeholder' => ' ',]
                            );
                            ?>
                        </div>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-primary">Exportar</button>
            </div>
            {{ end_form() }}
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->