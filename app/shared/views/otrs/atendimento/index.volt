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
                    echo $this->tag->selectStatic(['tipo',
                        $tipo,
                        'class' => 'form-control fc-alt']
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
                {{ link_to('export?obj=atendimento&type=excel&search='~search, '<i class="fa fa-file-excel-o c-green" aria-hidden="true"></i>', 'class': 'tooltips', 'title': 'Exportar para Excel', 'target': '_new') }}
            </li>
            <li>
                {{ link_to('export?obj=atendimento&type=pdf&search='~search, '<i class="fa fa-file-pdf-o c-red" aria-hidden="true"></i>', 'class': 'tooltips', 'title': 'Exportar para PDF', 'target': '_new') }}
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
                        <th data-column-id="dataAbertura">Data Abertura</th>
                        <th data-column-id="dataFechamento">Data Fecham.</th>
                        <th data-column-id="status">Status</th>
                        <th data-column-id="diasAberto" data-type="numeric">Dias Ab.</th>
                        <th data-column-id="perDiasAberto" data-type="numeric">Per. Dias Ab.</th>
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
                        <td>{{ chamado.dataAbertura }}</td>
                        <td>{{ chamado.dataFechamento }}</td>
                        <td>{{ chamado.status }}</td>
                        <td>{{ chamado.diasAberto }}</td>
                        <td>{{ chamado.periodoDiasAberto }}</td>
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
