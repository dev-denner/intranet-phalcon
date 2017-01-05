{{ content() }}

<div class="card">
    <div class="card-header">
        <h2>Coleta de Informações para Rescisão Contratual <small>Preencha as informações para realizar a solicitação desejada.</small>
        </h2>
    </div>

    <div class="card-body card-padding">
        <div class="form-wizard-basic fw-container">
            {{ form("forms/coleta_rescisao/add", "method":"post", "autocomplete" : "off", "enctype": "multipart/form-data", 'onsubmit': 'overlay(true);') }}
            <fieldset class="well well-alt">
                <legend><span class="badge bgm-green">1.0</span> Dados do Colaborador</legend>
                <div class="row">
                    <div class="col-md-5">

                        <!-- cpf -->
                        <div class="form-group fg-line">
                            <label><i class="badge bgm-lightgreen">1.1</i> CPF <span class="text-danger">*</span></label>
                            {{ text_field("cpf", "name": "CPF", "class": "form-control fg-input fc-alt cpfMask", "required": "required") }}
                        </div>
                        <!-- /cnpjCpf -->

                        <!-- filial -->
                        <div class="form-group fg-line">
                            <label><i class="badge bgm-lightgreen">1.2</i> Filial <span class="text-danger">*</span></label>
                            {{ text_field("filial", "name": "Filial", "class" : "form-control fg-input fc-alt", "required": "required") }}
                        </div>
                        <!-- /filial -->

                        <!-- secao -->
                        <div class="form-group fg-line">
                            <label><i class="badge bgm-lightgreen">1.3</i> Seção <span class="text-danger">*</span></label>
                            {{ text_field("secao", "name": "Seção", "class" : "form-control fg-input fc-alt", "required": "required") }}
                        </div>
                        <!-- /secao -->

                        <!-- nome -->
                        <div class="form-group fg-line">
                            <label><i class="badge bgm-lightgreen">1.4</i> Nome <span class="text-danger">*</span></label>
                            {{ text_field("nome", "name": "Nome", "class" : "form-control fg-input fc-alt", "required": "required") }}
                        </div>
                        <!-- /nome -->

                    </div>
                    <div class="col-md-5 col-md-offset-1">

                        <!-- data_admissao -->
                        <div class="form-group fg-line">
                            <label><i class="badge bgm-lightgreen">1.5</i> Data Admissão <span class="text-danger">*</span></label>
                            {{ text_field("data_admissao", "name": "Data Admissão", "class" : "form-control fg-input fc-alt datepicker", "required": "required") }}
                        </div>
                        <!-- /data_admissao -->

                        <!-- matricula -->
                        <div class="form-group fg-line">
                            <label><i class="badge bgm-lightgreen">1.6</i> Matrícula <span class="text-danger">*</span></label>
                            {{ text_field("matricula", "name": "Matrícula", "class" : "form-control fg-input fc-alt", "required": "required") }}
                        </div>
                        <!-- /matricula -->

                        <!-- pis -->
                        <div class="form-group fg-line">
                            <label><i class="badge bgm-lightgreen">1.7</i> PIS</label>
                            {{ text_field("pis", "name": "PIS", "class" : "form-control fg-input fc-alt") }}
                        </div>
                        <!-- /pis -->

                        <!-- salario -->
                        <div class="form-group fg-line">
                            <label><i class="badge bgm-lightgreen">1.8</i> Salário <span class="text-danger">*</span></label>
                            {{ text_field("salario", "name": "Salário", "class" : "form-control fg-input fc-alt formatMoney", "required": "required") }}
                        </div>
                        <!-- /salario -->

                    </div>
                </div>
            </fieldset>
            <fieldset class="well well-alt">
                <legend><span class="badge bgm-green">2.0</span> Adicionais</legend>
                <div class="row">
                    <div class="col-md-5">

                        <!-- periculosidade -->
                        <div class="form-group fg-line">
                            <label><i class="badge bgm-lightgreen">2.1</i> Periculosidade</label>
                            {{ text_field("Periculosidade", "class" : "form-control fg-input fc-alt") }}
                        </div>
                        <!-- /periculosidade -->

                        <!-- insalubridade -->
                        <div class="form-group fg-line">
                            <label><i class="badge bgm-lightgreen">2.2</i> Insalubridade</label>
                            {{ text_field("Insalubridade", "class" : "form-control fg-input fc-alt") }}
                        </div>
                        <!-- /insalubridade -->

                        <!-- adicional_de_transferencia -->
                        <div class="form-group fg-line">
                            <label><i class="badge bgm-lightgreen">2.3</i> Adicional de Transferência</label>
                            {{ text_field("Adicional de Transferência", "class" : "form-control fg-input fc-alt") }}
                        </div>
                        <!-- /adicional_de_transferencia -->

                        <!-- percentual_de_pensao -->
                        <div class="row">
                            <div class="col-md-7">
                                <div class="form-group">
                                    <label class="control-label"><i class="badge bgm-lightgreen">2.4</i> Percentual de Pensão <span class="text-danger">*</span></label><br />
                                    <label class="radio radio-inline">
                                        {{ radio_field( "Percentual de Pensão", "value" : "Não", 'required': 'required') }}
                                        <i class="input-helper"></i>
                                        Não
                                    </label>
                                    <label class="radio radio-inline">
                                        {{ radio_field("Percentual de Pensão", "value" : "Sim") }}
                                        <i class="input-helper"></i>
                                        Sim
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group fg-line">
                                    <label>%</label>
                                    {{ text_field("percentual_pensao", "name": "Percentual de Pensão - %", "class" : "form-control fg-input fc-alt", "disabled": "disabled") }}

                                </div>
                            </div>
                        </div>
                        <!-- /percentual_de_pensao -->

                    </div>
                    <div class="col-md-5 col-md-offset-1">

                        <!-- ajuda_de_custo -->
                        <div class="form-group fg-line">
                            <label><i class="badge bgm-lightgreen">2.5</i> Ajuda de Custo</label>
                            {{ text_field("Ajuda de Custo", "class" : "form-control fg-input fc-alt") }}
                        </div>
                        <!-- /ajuda_de_custo -->

                        <!-- data_de_desligamento -->
                        <div class="form-group fg-line">
                            <label><i class="badge bgm-lightgreen">2.6</i> Data de Desligamento <span class="text-danger">*</span></label>
                            {{ text_field("Data de Desligamento", "class" : "form-control fg-input fc-alt datepicker", "required": "required") }}
                        </div>
                        <!-- /data_de_desligamento -->

                        <!-- aviso_previo -->
                        <div class="form-group fg-line">
                            <label><i class="badge bgm-lightgreen">2.7</i> Aviso Prévio <span class="text-danger">*</span></label>
                            <br />
                            <div class="radio m-b-15">
                                <label>
                                    {{ radio_field("Aviso Prévio", "value" : "Funcionário no Período de Experiência", "required": "required") }}
                                    <i class="input-helper"></i>
                                    Funcionário no Período de Experiência
                                </label>
                            </div>

                            <div class="radio m-b-15">
                                <label>
                                    {{ radio_field("Aviso Prévio", "value" : "Indenizado") }}
                                    <i class="input-helper"></i>
                                    Indenizado
                                </label>
                            </div>

                            <div class="radio m-b-15">
                                <label>
                                    {{ radio_field("Aviso Prévio", "value" : "Descontar") }}
                                    <i class="input-helper"></i>
                                    Descontar
                                </label>
                            </div>

                            <div class="radio m-b-15">
                                <label>
                                    {{ radio_field("Aviso Prévio", "value" : "Não Descontar") }}
                                    <i class="input-helper"></i>
                                    Não Descontar
                                </label>
                            </div>

                            <div class="row" style="margin-top: -16px;">
                                <div class="col-md-4">
                                    <div class="radio m-b-15">
                                        <label>
                                            {{ radio_field("Aviso Prévio", "value" : "Trabalhado") }}
                                            <i class="input-helper"></i>
                                            Trabalhado
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label class="col-sm-6 control-label">Data de Início:</label>
                                        <div class="col-sm-6">
                                            <div class="fg-line">
                                                {{ text_field("data_inicio", "name": "Aviso Prévio - Início", "class" : "form-control fg-input fc-alt datepicker", "disabled": "disabled") }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <!-- /aviso_previo -->

                    </div>
                </div>
            </fieldset>
            <fieldset class="well well-alt">
                <legend><span class="badge bgm-green">3.0</span> Verbas</legend>
                <div class="row">
                    <div class="col-md-10 col-md-offset-1">
                        <div class="table-responsive">
                            <table class="table table-striped table-condensed bootgrid-table">
                                <thead>
                                    <tr>
                                        <th>Verba</th>
                                        <th>Valor</th>
                                        <th width="18%"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <div class="form-group fg-line">
                                                <?php
                                                echo $this->tag->selectStatic(['verbas',
                                                    $verbas,
                                                    'useEmpty' => true,
                                                    'emptyText' => 'Escolha uma opção',
                                                    'emptyValue' => '',
                                                    'class' => 'form-control fg-input fc-alt',
                                                    'name' => 'Verbas[]']
                                                );
                                                ?>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group fg-line">
                                                {{ text_field("valor_verbas", "name": "Valor Verbas[]", "class" : "form-control fg-input fc-alt") }}
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group">
                                                <button type="button" class="btn btn-success waves-effect" onclick="addLinha(this);"><span class="zmdi zmdi-plus zmdi-hc-fw"></span></button>
                                                <button type="button" class="btn btn-danger waves-effect" onclick="removeLinha(this);"><span class="zmdi zmdi-minus zmdi-hc-fw"></span></button>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                        </div>
                    </div>

                </div>
            </fieldset>
            <fieldset class="well well-alt">
                <legend><span class="badge bgm-green">4.0</span> Observação</legend>
                <div class="row">
                    <div class="col-md-5">

                        <!-- observacao -->
                        <div class="form-group fg-line">
                            <label><i class="badge bgm-lightgreen">4.1</i> Observação</label>
                            {{ text_area("Observação", "class" : "form-control fg-input fc-alt", 'rows': 5) }}
                        </div>
                        <!-- /observacao -->

                    </div>

                </div>
            </fieldset>
            <fieldset class="well well-alt">
                <legend><span class="badge bgm-green">5.0</span> Motivo da Demissão</legend>
                <div class="row">
                    <div class="col-md-5">

                        <!-- tipo_de_desligamento -->
                        <div class="form-group fg-line">
                            <label><i class="badge bgm-lightgreen">5.1</i> Tipo de Desligamento <span class="text-danger">*</span></label>
                            <br />
                            <div class="radio m-b-15">
                                <label>
                                    {{ radio_field("Tipo de Desligamento", "value" : "Dispensa sem Justa Causa", "required": "required") }}
                                    <i class="input-helper"></i>
                                    Dispensa sem Justa Causa
                                </label>
                            </div>

                            <div class="radio m-b-15">
                                <label>
                                    {{ radio_field("Tipo de Desligamento", "value" : "Pedido de Demissão") }}
                                    <i class="input-helper"></i>
                                    Pedido de Demissão
                                </label>
                            </div>

                            <div class="radio m-b-15">
                                <label>
                                    {{ radio_field("Tipo de Desligamento", "value" : "Antecipação de Término de Contrato") }}
                                    <i class="input-helper"></i>
                                    Antecipação de Término de Contrato
                                </label>
                            </div>

                            <div class="radio m-b-15">
                                <label>
                                    {{ radio_field("Tipo de Desligamento", "value" : "Término de Contrato (Por parte do Empregador)") }}
                                    <i class="input-helper"></i>
                                    Término de Contrato (Por parte do Empregador)
                                </label>
                            </div>

                            <div class="radio m-b-15">
                                <label>
                                    {{ radio_field("Tipo de Desligamento", "value" : "Distrato") }}
                                    <i class="input-helper"></i>
                                    Distrato
                                </label>
                            </div>

                            <div class="radio m-b-15">
                                <label>
                                    {{ radio_field("Tipo de Desligamento", "value" : "Falecimento") }}
                                    <i class="input-helper"></i>
                                    Falecimento
                                </label>
                            </div>

                            <div class="radio m-b-15">
                                <label>
                                    {{ radio_field("Tipo de Desligamento", "value" : "Rescisão Indireta") }}
                                    <i class="input-helper"></i>
                                    Rescisão Indireta
                                </label>
                            </div>

                            <div class="row" style="margin-top: -16px;">
                                <div class="col-md-4">
                                    <div class="radio m-b-15">
                                        <label>
                                            {{ radio_field("Tipo de Desligamento", "value" : "Justa Causa") }}
                                            <i class="input-helper"></i>
                                            Justa Causa
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Por:</label>
                                        <div class="col-sm-9">
                                            <div class="fg-line">
                                                {{ text_field("justa_causa", "name": "Justa Causa por", "class" : "form-control fg-input fc-alt", "disabled": "disabled") }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <!-- /tipo_de_desligamento -->
                    </div>
                </div>
            </fieldset>
            <fieldset class="well well-alt">
                <legend><span class="badge bgm-green">6.0</span> Anexos</legend>
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">

                        <!-- enviaArquivos -->
                        <div class="form-group fg-line">
                            <label class="control-label"><i class="badge bgm-lightgreen">6.1</i> Enviar Anexo(s) <span class="text-danger">*</span></label>
                            {{ file_field("enviaArquivos", "name": "enviaArquivos[]", "class" : "form-control fg-input fc-alt file-loading fileUploadAlt", 'required' : 'required') }}
                        </div>
                        <p class="help-block"><b class="text-danger">Dispensa assinada ou carta do pedido de demissão, e em casos de falecimento a certidão de óbito.</b><br />
                            Extensão de arquivo aceita: <b>.pdf</b><br />
                            Tamanho Máximo do Arquivo: <b>500kb</b>.
                        </p>
                        <!-- /enviaArquivos -->

                    </div>
                </div>
            </fieldset>
            <div class="form-group clearfix">
                <button type="submit" class="btn btn-warning pull-right">Adicionar</button>
            </div>
            {{ end_form() }}
        </div>
    </div>
</div>
