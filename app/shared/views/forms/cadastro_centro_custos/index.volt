{{ content() }}

<div class="card">
    <div class="card-header">
        <h2>Cadastro de Centro de Custo <small>Preencha as informações para realizar a solicitação desejada.</small></h2>
    </div>

    <div class="card-body card-padding">
        <div class="form-wizard-basic fw-container">
            {{ form("forms/cadastro_centro_custos/sendForm", "method":"post", "enctype": "multipart/form-data", "autocomplete" : "off", 'onsubmit': 'overlay(true);') }}
            <fieldset class="well well-alt">
                <legend><span class="badge bgm-green">1.0</span> Informações do Contrato</legend>
                <div class="row">
                    <div class="col-md-5">

                        <!-- numero_do_contrato -->
                        <div class="form-group">
                            <label><i class="badge bgm-lightgreen">1.1</i> Número do Contrato <span class="text-danger">*</span></label>
                            {{ text_field("Número do Contrato", "class" : "form-control fg-input fc-alt", "required": "required") }}
                        </div>
                        <!-- /numero_do_contrato -->

                        <!-- descricao_do_centro_de_custo -->
                        <div class="form-group fg-line">
                            <label><i class="badge bgm-lightgreen">1.2</i> Descrição do Centro de Custo <span class="text-danger">*</span></label>
                            {{ text_field("Descrição do Centro de Custo", "class" : "form-control fg-input fc-alt", "required": "required", "maxlength": 22) }}
                        </div>
                        <!-- /descricao_do_centro_de_custo -->

                        <!-- empresa -->
                        <div class="form-group fg-line">
                            <label><i class="badge bgm-lightgreen">1.3</i> Empresa <span class="text-danger">*</span></label>
                            <?php
                            echo $this->tag->selectStatic(['empresa',
                                $empresas,
                                'useEmpty' => true,
                                'emptyText' => 'Escolha uma opção',
                                'emptyValue' => '',
                                'class' => 'form-control fg-input fc-alt',
                                'name' => 'Código da Empresa',
                                'required' => 'required']
                            );
                            ?>
                            {{ hidden_field("nomeEmpresa", "name": "Nome da Empresa") }}
                        </div>
                        <!-- /empresa -->

                        <!-- filial -->
                        <div class="form-group fg-line">
                            <label><i class="badge bgm-lightgreen">1.4</i> Filial <span class="text-danger">*</span></label>
                            <?php
                            echo $this->tag->selectStatic(['filial',
                                [],
                                'useEmpty' => true,
                                'emptyText' => 'Escolha uma empresa',
                                'emptyValue' => '',
                                'name' => 'Filial',
                                'class' => 'form-control fg-input fc-alt',
                                'required' => 'required']
                            );
                            ?>
                        </div>
                        <!-- /filial -->

                    </div>
                    <div class="col-md-5 col-md-offset-1">

                        <!-- cliente -->
                        <div class="form-group">
                            <div class="fg-line">
                                <label><i class="badge bgm-lightgreen">1.5</i> CNPJ do Cliente <span class="text-danger">*</span></label>
                                {{ text_field("Cliente", "class" : "form-control fg-input fc-alt cnpjMask", "required": "required") }}
                            </div>
                            <p class="nome_cliente"></p>
                            {{ hidden_field("codigoCliente", "name": "Código do Cliente") }}
                            {{ hidden_field("lojaCliente", "name": "Loja do Cliente") }}
                            {{ hidden_field("nomeCliente", "name": "Nome do Cliente") }}
                            {{ hidden_field("razaoSocialCliente", "name": "Razão Social do Cliente") }}
                        </div>
                        <!-- /cliente -->

                        <!-- responsavel -->
                        <div class="form-group fg-line">
                            <label><i class="badge bgm-lightgreen">1.6</i> Responsável <span class="text-danger">*</span></label>
                            {{ text_field("Responsável", "class" : "form-control fg-input fc-alt", "required": "required") }}
                        </div>
                        <!-- /responsavel -->

                        <!-- consorcio -->
                        <div class="form-group fg-line">
                            <label class="control-label"><i class="badge bgm-lightgreen">1.7</i> Consórcio <span class="text-danger">*</span></label>
                            <br />
                            <label class="radio radio-inline">
                                {{ radio_field( "Consórcio", "value" : "Sim", 'required': 'required') }}
                                <i class="input-helper"></i>
                                Sim
                            </label>
                            <label class="radio radio-inline">
                                {{ radio_field("Consórcio", "value" : "Não") }}
                                <i class="input-helper"></i>
                                Não
                            </label>
                        </div>
                        <!-- /consorcio -->

                        <!-- inicio_da_atividade -->
                        <div class="form-group fg-line">
                            <label><i class="badge bgm-lightgreen">1.8</i> Início da Atividade <span class="text-danger">*</span></label>
                            {{ text_field("Início da Atividade", "class" : "form-control fg-input fc-alt datePicker", "required": "required") }}
                        </div>
                        <!-- /inicio_da_atividade -->

                    </div>
                </div>
            </fieldset>
            <fieldset class="well well-alt">
                <legend><span class="badge bgm-green">2.0</span> Informações para TI</legend>
                <div class="row">
                    <div class="col-md-5">

                        <!-- gestor -->
                        <div class="form-group fg-line">
                            <label><i class="badge bgm-lightgreen">2.1</i> Gestor <span class="text-danger">*</span></label>
                            <?php
                            echo $this->tag->selectStatic(['Gestor',
                                $gestores,
                                'useEmpty' => true,
                                'emptyText' => 'Escolha uma opção',
                                'emptyValue' => '',
                                'class' => 'form-control fg-input fc-alt',
                                'required' => 'required']
                            );
                            ?>
                        </div>
                        <!-- /gestor -->

                    </div>
                </div>
            </fieldset>
            <fieldset class="well well-alt">
                <legend><span class="badge bgm-green">3.0</span> Informações para Contabilidade e Fiscal</legend>
                <div class="row">
                    <div class="col-md-5">

                        <!-- item_contabil -->
                        <div class="form-group fg-line">
                            <label><i class="badge bgm-lightgreen">3.1</i> Ítem Contábil <span class="text-danger">*</span></label>
                            <?php
                            echo $this->tag->selectStatic(['Ítem Contábil',
                                $itensFiscais,
                                'useEmpty' => true,
                                'emptyText' => 'Escolha uma opção',
                                'emptyValue' => '',
                                'class' => 'form-control fg-input fc-alt',
                                'required' => 'required']
                            );
                            ?>
                        </div>
                        <!-- /item_contabil -->

                    </div>
                    <div class="col-md-5 col-md-offset-1">

                        <!-- classe_de_valor -->
                        <div class="form-group fg-line">
                            <label><i class="badge bgm-lightgreen">3.2</i> Classe de Valor <span class="text-danger">*</span></label>
                            <?php
                            echo $this->tag->selectStatic(['Classe de Valor',
                                $classesValores,
                                'useEmpty' => true,
                                'emptyText' => 'Escolha uma opção',
                                'emptyValue' => '',
                                'class' => 'form-control fg-input fc-alt',
                                'required' => 'required']
                            );
                            ?>
                        </div>
                        <!-- /classe_de_valor -->

                    </div>
                </div>
            </fieldset>
            <fieldset class="well well-alt">
                <legend><span class="badge bgm-green">4.0</span> Informações para o Departamento Pessoal</legend>
                <div class="row">
                    <div class="col-md-5">

                        <!-- folha_de_pagamento -->
                        <div class="form-group fg-line">
                            <label class="control-label"><i class="badge bgm-lightgreen">4.1</i> Folha de Pagamento <span class="text-danger">*</span></label>
                            <br />
                            <label class="radio radio-inline">
                                {{ radio_field( "Folha de Pagamento", "value" : "Sim", 'required': 'required') }}
                                <i class="input-helper"></i>
                                Sim
                            </label>
                            <label class="radio radio-inline">
                                {{ radio_field("Folha de Pagamento", "value" : "Não") }}
                                <i class="input-helper"></i>
                                Não
                            </label>
                        </div>
                        <!-- /folha_de_pagamento -->

                        <!-- empresa_para_secao -->
                        <div class="form-group fg-line">
                            <label><i class="badge bgm-lightgreen">4.2</i> Empresa para Seção </label>
                            <?php
                            echo $this->tag->selectStatic(['empresaSecao',
                                $empresas,
                                'useEmpty' => true,
                                'emptyText' => 'Escolha uma opção',
                                'emptyValue' => '',
                                'class' => 'form-control fg-input fc-alt',
                                'name' => 'Empresa para Seção',]
                            );
                            ?>
                            {{ hidden_field("nomeEmpresaSecao", "name": "Nome da Empresa para Seção") }}
                        </div>
                        <!-- /empresa_para_secao -->

                    </div>
                    <div class="col-md-5 col-md-offset-1">

                        <!-- filial_para_secao -->
                        <div class="form-group fg-line">
                            <label><i class="badge bgm-lightgreen">4.3</i> Filial para Seção</label>
                            <?php
                            echo $this->tag->selectStatic(['filialSecao',
                                [],
                                'useEmpty' => true,
                                'emptyText' => 'Escolha uma empresa',
                                'emptyValue' => '',
                                'name' => 'Filial para Seção',
                                'class' => 'form-control fg-input fc-alt',]
                            );
                            ?>
                        </div>
                        <!-- /filial_para_secao -->

                        <!-- numero_do_cei -->
                        <div class="form-group">
                            <div class="fg-line">
                                <label><i class="badge bgm-lightgreen">4.4</i> Número do CEI</label>
                                {{ text_field("Número do CEI", "class" : "form-control fg-input fc-alt") }}
                            </div>
                            <p class="help-block">Caso o empreendimento possua o CEI enviar um documento de comprovação do número.</p>
                        </div>
                        <!-- /numero_do_cei -->

                    </div>
                </div>
            </fieldset>
            <fieldset class="well well-alt">
                <legend><span class="badge bgm-green">5.0</span> Anexos</legend>
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">

                        <!-- enviaArquivos -->
                        <div class="form-group fg-line">
                            <label class="control-label"><i class="badge bgm-lightgreen">5.1</i> Enviar Anexo(s) <span class="text-danger">*</span></label>
                            {{ file_field("enviaArquivos", "name": "enviaArquivos[]", "class" : "form-control fg-input fc-alt file-loading fileUpload", "multiple": true, 'required' : 'required') }}
                        </div>
                        <p class="help-block"><b class="text-danger">Obrigatório Anexar o Contrato</b><br />
                            Extensões de arquivos aceitas: <b>.jpg, .jpeg, .png, .gif, .pdf, .doc, .docx, .txt, .zip, .rar, .gz, .tgz</b><br />
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
