{{ content() }}

<div class="card">
    <div class="card-header">
        <h2>Seguro Garantia <small>Preencha as informações para realizar a solicitação desejada.</small></h2>
    </div>

    <div class="card-body card-padding">
        <div class="form-wizard-basic fw-container">
            {{ form("forms/solicitacoes_garantias/sendForm", "method":"post", "enctype": "multipart/form-data", "autocomplete" : "off", 'onsubmit': 'overlay(true);') }}
            {{ hidden_field('Data Solicitação', 'value': date('d/m/Y')) }}
            <fieldset class="well well-alt">
                <legend><span class="badge bgm-green">1.0</span> Dados da Solicitação</legend>
                <div class="row">
                    <div class="col-md-5">

                        <!-- empresa_do_grupo -->
                        <div class="form-group fg-line">
                            <label><i class="badge bgm-lightgreen">1.1</i> Empresa do Grupo <span class="text-danger">*</span></label>
                            <?php
                            echo $this->tag->selectStatic(['Empresa do Grupo',
                                $empresas,
                                'useEmpty' => true,
                                'emptyText' => 'Escolha uma opção',
                                'emptyValue' => '',
                                'class' => 'form-control fg-input fc-alt',
                                'required' => 'required']
                            );
                            ?>
                        </div>
                        <!-- /empresa_do_grupo -->

                        <!-- cpf_do_solicitante -->
                        <div class="form-group">
                            <div class="fg-line">
                                <label><i class="badge bgm-lightgreen">1.2</i> CPF do Solicitante <span class="text-danger">*</span></label>
                                {{ text_field('cpf', 'name': 'CPF do Solicitante', 'class' : 'form-control fg-input fc-alt cpfMask', 'required': 'required') }}
                                {{ hidden_field('nome_solicitante', 'name': 'Nome do Solicitante') }}
                                {{ hidden_field('email_solicitante', 'name': 'Email do Solicitante') }}
                            </div>
                            <p class="nome_solicitante"></p>
                            <p class="error_solicitante"></p>
                        </div>
                        <!-- /cpf_do_solicitante -->

                        <!-- empreendimento -->
                        <div class="form-group fg-line">
                            <label><i class="badge bgm-lightgreen">1.3</i> Empreendimento <span class="text-danger">*</span></label>
                            {{ text_field("Empreendimento", "class" : "form-control fg-input fc-alt", "required": "required") }}
                        </div>
                        <!-- /empreendimento -->

                        <!-- centro_de_custo -->
                        <div class="form-group fg-line">
                            <label><i class="badge bgm-lightgreen">1.4</i> Centro de Custo <span class="text-danger">*</span></label>
                            {{ text_field("Centro de Custo", "class" : "form-control fg-input fc-alt", "required": "required") }}
                        </div>
                        <!-- /centro_de_custo -->

                    </div>
                    <div class="col-md-5 col-md-offset-1">

                        <!-- estado_de_realizacao -->
                        <div class="form-group fg-line">
                            <label><i class="badge bgm-lightgreen">1.5</i> Estado de Realização <span class="text-danger">*</span></label>
                            {{ text_field("Estado de Realização", "class" : "form-control fg-input fc-alt", "required": "required") }}
                        </div>
                        <!-- /estado_de_realizacao -->

                        <!-- gestor_responsavel -->
                        <div class="form-group fg-line">
                            <label><i class="badge bgm-lightgreen">1.6</i> Gestor Responsável <span class="text-danger">*</span></label>
                            {{ text_field("Gestor Responsável", "class" : "form-control fg-input fc-alt", "required": "required") }}
                        </div>
                        <!-- /gestor_responsavel -->

                        <!-- beneficiario_da_garantia -->
                        <div class="form-group fg-line">
                            <label><i class="badge bgm-lightgreen">1.7</i> Beneficiário da Garantia <span class="text-danger">*</span></label>
                            {{ text_field("Beneficiário da Garantia", "class" : "form-control fg-input fc-alt", "required": "required") }}
                        </div>
                        <!-- /beneficiario_da_garantia -->

                        <!-- cnpj -->
                        <div class="form-group fg-line">
                            <label><i class="badge bgm-lightgreen">1.8</i> CNPJ <span class="text-danger">*</span></label>
                            {{ text_field("CNPJ", "class" : "form-control fg-input fc-alt cnpjMask", "required": "required") }}
                        </div>
                        <!-- /cnpj -->

                    </div>
                </div>
            </fieldset>
            <fieldset class="well well-alt">
                <legend><span class="badge bgm-green">2.0</span> Dados do Contrato</legend>
                <div class="row">
                    <div class="col-md-5">

                        <!-- numero_do_documento -->
                        <div class="form-group fg-line">
                            <label><i class="badge bgm-lightgreen">2.1</i> Número do Contrato <span class="text-danger">*</span></label>
                            {{ text_field("Número do Contrato", "class" : "form-control fg-input fc-alt", "required": "required") }}
                        </div>
                        <!-- /numero_do_documento -->

                        <!-- valor_atual_do_contrato -->
                        <div class="form-group fg-line">
                            <label><i class="badge bgm-lightgreen">2.2</i> Valor Atual do Contrato <span class="text-danger">*</span></label>
                            {{ text_field("Valor Atual do Contrato", "class" : "form-control fg-input fc-alt formatMoney", "required": "required") }}
                        </div>
                        <!-- /valor_atual_do_contrato -->

                        <!-- vigencia_atual_do_contrato -->
                        <div class="form-group">
                            <label><i class="badge bgm-lightgreen">2.3</i> Vigência do Contrato <span class="text-danger">*</span></label>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="fg-line">
                                        {{ text_field("Vigência do Contrato - Início", "class" : "form-control fg-input fc-alt datePicker", "required": "required") }}
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="fg-line">
                                        {{ text_field("Vigência do Contrato - Final", "class" : "form-control fg-input fc-alt datePicker", "required": "required") }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /vigencia_atual_do_contrato -->

                    </div>
                    <div class="col-md-5 col-md-offset-1">

                        <!-- consorcio -->
                        <div class="row">
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label class="control-label"><i class="badge bgm-lightgreen">2.4</i> Consórcio <span class="text-danger">*</span></label>
                                    <label class="radio radio-inline">
                                        {{ radio_field( "Consórcio", "value" : "Não", 'required': 'required') }}
                                        <i class="input-helper"></i>
                                        Não
                                    </label>
                                    <label class="radio radio-inline">
                                        {{ radio_field("Consórcio", "value" : "Sim") }}
                                        <i class="input-helper"></i>
                                        Sim
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-7">
                                <div class="form-group fg-line">
                                    <label>Percentual de Participação</label>
                                    {{ text_field("percentual_de_participacao", "name": "Percentual de Participação", "class" : "form-control fg-input fc-alt", "disabled": "disabled") }}

                                </div>
                            </div>
                        </div>
                        <!-- /consorcio -->

                        <!-- objeto_do_contrato -->
                        <div class="form-group fg-line">
                            <label><i class="badge bgm-lightgreen">2.5</i> Objeto do Contrato <span class="text-danger">*</span></label>
                            {{ text_area("Objeto do Contrato", "class" : "form-control fg-input fc-alt", "required": "required", "rows": 7) }}
                        </div>
                        <!-- /objeto_do_contrato -->

                    </div>
                </div>
            </fieldset>
            <fieldset class="well well-alt">
                <legend><span class="badge bgm-green">3.0</span> Dados da Garantia</legend>
                <div class="row">

                    <div class="col-md-5">

                        <!-- opcao_de_garantia -->
                        <div class="form-group">
                            <label class="control-label"><i class="badge bgm-lightgreen">3.1</i> Opção de Garantia <span class="text-danger">*</span></label>
                            <br />
                            <label class="radio radio-inline">
                                {{ radio_field( "Opção de Garantia", "value" : "Garantia Nova", 'required': 'required') }}
                                <i class="input-helper"></i>
                                Garantia Nova
                            </label>
                            <label class="radio radio-inline">
                                {{ radio_field("Opção de Garantia", "value" : "Endosso") }}
                                <i class="input-helper"></i>
                                Endosso
                            </label>
                            <p class="help-block"></p>
                        </div>
                        <!-- /opcao_de_garantia -->

                        <div class="garantiaNova">
                            <!-- opcao_de_garantia -->
                            <div class="form-group">
                                <label class="control-label"><i class="badge bgm-lightgreen">3.2</i> <span>Tipo de Modalidade</span></label>
                                <br />
                                <label class="radio radio-inline">
                                    {{ radio_field( "Tipo de Modalidade", "value" : "Pública") }}
                                    <i class="input-helper"></i>
                                    Pública
                                </label>
                                <label class="radio radio-inline">
                                    {{ radio_field("Tipo de Modalidade", "value" : "Privada") }}
                                    <i class="input-helper"></i>
                                    Privada
                                </label>
                                <p class="help-block"></p>
                            </div>
                            <!-- /opcao_de_garantia -->
                            <div class="garantiaNovaPublica">
                                <!-- modalidade_publica -->
                                <div class="form-group fg-line">
                                    <label><i class="badge bgm-lightgreen">3.3</i> <span>Modalidade</span></label>
                                    <?php
                                    echo $this->tag->selectStatic(['Modalidade - Pública',
                                        ['Adiantamento De Pagamentos' => 'Adiantamento De Pagamentos',
                                            'Administrativo De Créditos Tributários' => 'Administrativo De Créditos Tributários',
                                            'Aduaneiro' => 'Aduaneiro',
                                            'Agência Nacional De Petróleo Executante' => 'Agência Nacional De Petróleo Executante',
                                            'Agência Nacional De Petróleo Licitante' => 'Agência Nacional De Petróleo Licitante',
                                            'Construção, Fornecimento Ou Prestação De Serviços' => 'Construção, Fornecimento Ou Prestação De Serviços',
                                            'Executante Concessionário' => 'Executante Concessionário',
                                            'Garantia De Término De Obras' => 'Garantia De Término De Obras',
                                            'Garantia Licitante' => 'Garantia Licitante',
                                            'Judicial' => 'Judicial',
                                            'Judicial Execução Fiscal' => 'Judicial Execução Fiscal',
                                            'Manutenção Corretiva' => 'Manutenção Corretiva',
                                            'Parcelamento Administrativo Fiscal' => 'Parcelamento Administrativo Fiscal',
                                            'Retenção De Pagamentos' => 'Retenção De Pagamentos',
                                            'Término De Obras - Banco Do Brasil' => 'Término De Obras - Banco Do Brasil',
                                            'Término De Obras - Infraestrutura' => 'Término De Obras - Infraestrutura',
                                            'Término De Obras - Manutenção Corretiva' => 'Término De Obras - Manutenção Corretiva',],
                                        'useEmpty' => true,
                                        'emptyText' => 'Escolha uma opção',
                                        'emptyValue' => '',
                                        'class' => 'form-control fg-input fc-alt']
                                    );
                                    ?>
                                </div>
                                <!-- /modalidade_publica -->

                            </div>
                            <div class="garantiaNovaPrivada">
                                <!-- modalidade_privada -->
                                <div class="form-group fg-line">
                                    <label><i class="badge bgm-lightgreen">3.3</i> <span>Modalidade</span></label>
                                    <?php
                                    echo $this->tag->selectStatic(['Modalidade - Privada',
                                        ['Adiantamento De Pagamentos' => 'Adiantamento De Pagamentos',
                                            'Construção, Fornecimento Ou Prestação De Serviços' => 'Construção, Fornecimento Ou Prestação De Serviços',
                                            'Garantia Financeira' => 'Garantia Financeira',
                                            'Garantia Licitante' => 'Garantia Licitante',
                                            'Imobiliário' => 'Imobiliário',
                                            'Manutenção Corretiva' => 'Manutenção Corretiva',
                                            'Retenção De Pagamentos' => 'Retenção De Pagamentos',],
                                        'useEmpty' => true,
                                        'emptyText' => 'Escolha uma opção',
                                        'emptyValue' => '',
                                        'class' => 'form-control fg-input fc-alt']
                                    );
                                    ?>
                                </div>
                                <!-- /modalidade_privada -->

                            </div>

                            <!-- percentual_de_garantia -->
                            <div class="form-group fg-line">
                                <label><i class="badge bgm-lightgreen">3.4</i> <span>Percentual de Garantia</span></label>
                                {{ text_field("Percentual de Garantia", "class" : "form-control fg-input fc-alt") }}
                            </div>
                            <!-- /percentual_de_garantia -->

                        </div>
                        <div class="endosso">
                            <!-- endosso -->
                            <div class="form-group fg-line">
                                <label><i class="badge bgm-lightgreen">3.2</i> <span>Endosso</span></label>
                                <?php
                                echo $this->tag->selectStatic(['Endosso',
                                    ['Endosso De Correção De Dados/Objeto' => 'Endosso De Correção De Dados/Objeto',
                                        'Endosso De Prorrogação De Prazo' => 'Endosso De Prorrogação De Prazo',
                                        'Endosso De Prorrogação De Prazo Com Aumento De Importância Segurada' => 'Endosso De Prorrogação De Prazo Com Aumento De Importância Segurada',
                                        'Endosso De Aumento De Importância Segurada' => 'Endosso De Aumento De Importância Segurada',
                                        'Endosso De Redução De Importância Segurada' => 'Endosso De Redução De Importância Segurada',
                                        'Endosso De Prorrogação De Prazo Com Redução De Importância Segurada' => 'Endosso De Prorrogação De Prazo Com Redução De Importância Segurada',
                                        'Endosso De Inclusão De Coberturas Segurada' => 'Endosso De Inclusão De Coberturas Segurada',],
                                    'useEmpty' => true,
                                    'emptyText' => 'Escolha uma opção',
                                    'emptyValue' => '',
                                    'class' => 'form-control fg-input fc-alt']
                                );
                                ?>
                            </div>
                            <!-- /endosso -->

                            <!-- n_da_apolice_carta_fianca  -->
                            <div class="form-group fg-line">
                                <label><i class="badge bgm-lightgreen">3.3</i> <span>Nº da Apólice / Carta Fiança </span></label>
                                {{ text_field("Nº da Apólice / Carta Fiança", "class" : "form-control fg-input fc-alt") }}
                            </div>
                            <!-- /n_da_apolice_carta_fianca -->

                            <!-- seguradora_banco_atual -->
                            <div class="form-group fg-line">
                                <label><i class="badge bgm-lightgreen">3.4</i> <span>Seguradora / Banco atual</span></label>
                                {{ text_field("Seguradora / Banco atual", "class" : "form-control fg-input fc-alt") }}
                            </div>
                            <!-- /numero_da_apolice_fianca_atual -->

                        </div>
                    </div>
                    <div class="col-md-5 col-md-offset-1">
                        <div class="garantiaNova">

                            <!-- valor_da_garantia -->
                            <div class="form-group fg-line">
                                <label><i class="badge bgm-lightgreen">3.5</i> <span>Valor da Garantia</span></label>
                                {{ text_field("Valor da Garantia", "class" : "form-control fg-input fc-alt formatMoney") }}
                            </div>
                            <!-- /valor_da_garantia -->

                            <!-- vigencia_da_garantia -->
                            <div class="form-group">
                                <label><i class="badge bgm-lightgreen">3.6</i> <span>Vigência da Garantia</span></label>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="fg-line">
                                            {{ text_field("Vigência da Garantia - Início", "class" : "form-control fg-input fc-alt datePicker") }}
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="fg-line">
                                            {{ text_field("Vigência da Garantia - Final", "class" : "form-control fg-input fc-alt datePicker") }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /vigencia_da_garantia -->

                            <!-- opcao_de_garantia -->
                            <div class="form-group">
                                <label class="control-label"><i class="badge bgm-lightgreen">3.7</i> <span>Cobertura de Multas Trabalhistas</span></label>
                                <br />
                                <label class="radio radio-inline">
                                    {{ radio_field( "Cobertura de Multas Trabalhistas", "value" : "Sim") }}
                                    <i class="input-helper"></i>
                                    Sim
                                </label>
                                <label class="radio radio-inline">
                                    {{ radio_field("Cobertura de Multas Trabalhistas", "value" : "Não") }}
                                    <i class="input-helper"></i>
                                    Não
                                </label>
                            </div>
                            <!-- /opcao_de_garantia -->
                        </div>
                        <div class="endosso">

                            <!-- importancia_segurada_atual -->
                            <div class="form-group fg-line">
                                <label><i class="badge bgm-lightgreen">3.5</i> <span>Importância Segurada atual</span></label>
                                {{ text_field("Importância Segurada atual", "class" : "form-control fg-input fc-alt formatMoney") }}
                            </div>
                            <!-- /importancia_segurada_atual -->

                            <!-- vigencia_atual -->
                            <div class="form-group">
                                <label><i class="badge bgm-lightgreen">3.6</i> <span>Vigência atual</span></label>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="fg-line">
                                            {{ text_field("Vigência atual - Início", "class" : "form-control fg-input fc-alt datePicker") }}
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="fg-line">
                                            {{ text_field("Vigência atual - Final", "class" : "form-control fg-input fc-alt datePicker") }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /vigencia_atual -->

                            <!-- importancia_segurada_apos_endosso -->
                            <div class="form-group fg-line">
                                <label><i class="badge bgm-lightgreen">3.7</i> <span>Importância Segurada após Endosso</span></label>
                                {{ text_field("Importância Segurada após Endosso", "class" : "form-control fg-input fc-alt formatMoney") }}
                            </div>
                            <!-- /importancia_segurada_apos_endosso -->

                            <!-- vigencia_apos_endosso -->
                            <div class="form-group fg-line">
                                <label><i class="badge bgm-lightgreen">3.8</i> <span>Vigência Após Endosso</span></label>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="fg-line">
                                            {{ text_field("Vigência Após Endosso - Início", "class" : "form-control fg-input fc-alt datePicker") }}
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="fg-line">
                                            {{ text_field("Vigência Após Endosso - Final", "class" : "form-control fg-input fc-alt datePicker") }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /vigencia_apos_endosso -->

                        </div>
                    </div>

                </div>
            </fieldset>

            <fieldset class="well well-alt">
                <legend><span class="badge bgm-green">4.0</span> Observações</legend>
                <div class="row">

                    <div class="col-md-5">

                        <!-- observacoes -->
                        <div class="form-group fg-line">
                            <label><i class="badge bgm-lightgreen">4.1</i> Observações</label>
                            {{ text_area("Observações", "class" : "form-control fg-input fc-alt", "rows": 5) }}
                        </div>
                        <!-- /observacoes -->

                    </div>
                </div>
            </fieldset>

            <fieldset class="well well-alt">
                <legend><span class="badge bgm-green">5.0</span> Anexos</legend>
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">

                        <!-- enviaArquivos -->
                        <div class="form-group fg-line">
                            <label class="control-label"><i class="badge bgm-lightgreen">5.1</i> Enviar Anexo(s)</label>
                            {{ file_field("enviaArquivos", "name": "enviaArquivos[]", "class" : "form-control fg-input fc-alt file-loading fileUpload", "multiple": true) }}
                        </div>
                        <p class="help-block">Extensões de arquivos aceitas: <b>.jpg, .jpeg, .png, .gif, .pdf, .doc, .docx, .txt, .zip, .rar, .gz, .tgz</b><br />
                            Tamanho Máximo do Arquivo: <b>10mb</b>.
                        </p>
                        <!-- /enviaArquivos -->

                    </div>
                </div>
            </fieldset>

            <div class="form-group clearfix">
                <button type="submit" class="btn btn-success pull-right">Enviar</button>
            </div>
            {{ end_form() }}
        </div>
    </div>
</div>
