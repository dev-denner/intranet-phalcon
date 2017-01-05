{{ content() }}

<div class="card">
    <div class="card-header">
        <h2>Abertura de Filial <small>Preencha as informações para realizar a solicitação desejada.</small></h2>
    </div>

    <div class="card-body card-padding">
        <div class="form-wizard-basic fw-container">
            {{ form("forms/cadastro_filiais/sendForm", "method":"post", "autocomplete" : "off", 'onsubmit': 'overlay(true);') }}
            <fieldset class="well well-alt">
                <legend><span class="badge bgm-green">1.0</span> Dados Gerais</legend>
                <div class="row">
                    <div class="col-md-5">
                        <!-- nome_comercial -->
                        <div class="form-group">
                            <label><i class="badge bgm-lightgreen">1.1</i> Nome Comercial <span class="text-danger">*</span></label>
                            {{ text_field("Nome Comercial", "class" : "form-control fg-input fc-alt", "required": "required") }}
                        </div>
                        <!-- /nome_comercial -->

                        <!-- cnpj -->
                        <div class="form-group fg-line">
                            <label><i class="badge bgm-lightgreen">1.2</i> CNPJ <span class="text-danger">*</span></label>
                            {{ text_field("CNPJ", "class" : "form-control fg-input fc-alt cnpjMask", "required": "required") }}
                        </div>
                        <!-- /cnpj -->

                        <!-- insc_estadual -->
                        <div class="form-group fg-line">
                            <label><i class="badge bgm-lightgreen">1.3</i> Nome da Filial para os Sistemas <span class="text-danger">*</span></label>
                            {{ text_field("Nome da Filial no Sistema", "class" : "form-control fg-input fc-alt", "required": "required") }}
                        </div>
                        <!-- /insc_estadual -->

                    </div>
                    <div class="col-md-5 col-md-offset-1">

                        <!-- insc_estadual -->
                        <div class="form-group fg-line">
                            <label><i class="badge bgm-lightgreen">1.4</i> Inscrição Estadual</label>
                            {{ text_field("Inscrição Estadual", "class" : "form-control fg-input fc-alt onlyNumber") }}
                        </div>
                        <!-- /insc_estadual -->

                        <!-- insc_municipal -->
                        <div class="form-group fg-line">
                            <label><i class="badge bgm-lightgreen">1.5</i> Inscrição Municipal</label>
                            {{ text_field("Inscrição Municipal", "class" : "form-control fg-input fc-alt onlyNumber") }}
                        </div>
                        <!-- /insc_municipal -->

                        <!-- telefone -->
                        <div class="form-group fg-line">
                            <label><i class="badge bgm-lightgreen">1.6</i> Telefone <span class="text-danger">*</span></label>
                            {{ text_field("Telefone", "class" : "form-control fg-input fc-alt telefone", "required": "required") }}
                        </div>
                        <!-- /telefone -->

                    </div>
                </div>
            </fieldset>
            <fieldset class="well well-alt">
                <legend><span class="badge bgm-green">2.0</span> Endereço Fiscal / Entrega</legend>
                <div class="row">
                    <div class="col-md-5">

                        <!-- cep -->
                        <div class="form-group fg-line">
                            <label><i class="badge bgm-lightgreen">2.1</i> CEP <span class="text-danger">*</span></label>
                            {{ text_field("cep", "name" : "CEP Fiscal / Entrega", "class" : "form-control fg-input fc-alt cepMask", "required": "required") }}
                        </div>
                        <!-- /cep -->

                        <!-- endereco -->
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group fg-line">
                                    <label>
                                        <i class="badge bgm-lightgreen">2.2</i> Endereço <span class="text-danger">*</span>
                                    </label>
                                    {{ text_field("endereco", "name" : "Endereço Fiscal / Entrega", "class" : "form-control fg-input fc-alt", "required": "required") }}
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group fg-line">
                                    <label>
                                        <i class="badge bgm-lightgreen">2.3</i> Número <span class="text-danger">*</span>
                                    </label>

                                    {{ text_field("Número Fiscal / Entrega", "class" : "form-control fg-input fc-alt", "required": "required") }}
                                </div>
                            </div>
                        </div>
                        <!-- /endereco -->

                        <!-- complemento -->
                        <div class="form-group fg-line">
                            <label><i class="badge bgm-lightgreen">2.4</i> Complemento</label>
                            {{ text_field("Complemento Fiscal / Entrega", "class" : "form-control fg-input fc-alt") }}
                        </div>
                        <!-- /complemento -->

                        <!-- bairro -->
                        <div class="form-group fg-line">
                            <label><i class="badge bgm-lightgreen">2.5</i> Bairro <span class="text-danger">*</span></label>
                            {{ text_field("bairro", "name" : "Bairro Fiscal / Entrega", "class" : "form-control fg-input fc-alt", "required": "required") }}
                        </div>
                        <!-- /bairro -->

                    </div>
                    <div class="col-md-5 col-md-offset-1">

                        <!-- municipio -->
                        <div class="form-group fg-line">
                            <label><i class="badge bgm-lightgreen">2.6</i> Município <span class="text-danger">*</span></label>
                            {{ text_field("cidade", "name" : "Município Fiscal / Entrega", "class" : "form-control fg-input fc-alt", "required": "required") }}
                        </div>
                        <!-- /municipio -->

                        <!-- estado -->
                        <div class="form-group fg-line">
                            <label><i class="badge bgm-lightgreen">2.7</i> Estado <span class="text-danger">*</span></label>
                            {{ text_field("uf", "name" : "Estado Fiscal / Entrega", "class" : "form-control fg-input fc-alt", "required": "required", "maxlength": 2) }}
                        </div>
                        <!-- /estado -->

                        <!-- codigo_do_municipio -->
                        <div class="form-group fg-line">
                            <label><i class="badge bgm-lightgreen">2.8</i> Código do Município <span class="text-danger">*</span></label>
                            {{ text_field("codMunicipio", "name" : "Código do Município Fiscal / Entrega", "class" : "form-control fg-input fc-alt", "required": "required") }}
                        </div>
                        <!-- /codigo_do_municipio -->

                    </div>
                </div>
            </fieldset>
            <fieldset class="well well-alt">
                <legend><span class="badge bgm-green">3.0</span> Endereço de Cobrança</legend>
                <div class="row">
                    <div class="col-md-5">

                        <!-- endereco_de_cobranca_mesmo_de_entrega -->
                        <div class="form-group fg-line">
                            <label><i class="badge bgm-lightgreen">3.1</i> Endereço de Cobrança mesmo de entrega <span class="text-danger">*</span></label>
                            <br />
                            <label class="radio radio-inline">
                                {{ radio_field("Endereço de Cobrança mesmo de entrega", "value" : "Sim", "required": "required") }}
                                <i class="input-helper"></i>
                                Sim
                            </label>
                            <label class="radio radio-inline">
                                {{ radio_field("Endereço de Cobrança mesmo de entrega", "value" : "Não") }}
                                <i class="input-helper"></i>
                                Não
                            </label>
                        </div>
                        <!-- /endereco_de_cobranca_mesmo_de_entrega -->

                        <div class="enderecoCobrancaBox">
                            <!-- cep_cobranca -->
                            <div class="form-group fg-line">
                                <label><i class="badge bgm-lightgreen">2.1</i> CEP <span class="text-danger">*</span></label>
                                {{ text_field("cepCobranca", "name" : "CEP Cobrança", "class" : "form-control fg-input fc-alt cepMask") }}
                            </div>
                            <!-- /cep_cobranca -->

                            <!-- endereco_cobranca -->
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group fg-line">
                                        <label>
                                            <i class="badge bgm-lightgreen">2.2</i> Endereço <span class="text-danger">*</span>
                                        </label>
                                        {{ text_field("enderecoCobranca", "name" : "Endereço Cobrança", "class" : "form-control fg-input fc-alt") }}
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group fg-line">
                                        <label>
                                            <i class="badge bgm-lightgreen">2.3</i> Número <span class="text-danger">*</span>
                                        </label>

                                        {{ text_field("Número Cobrança", "class" : "form-control fg-input fc-alt") }}
                                    </div>
                                </div>
                            </div>
                            <!-- /endereco_cobranca -->

                            <!-- complemento_cobranca -->
                            <div class="form-group fg-line">
                                <label><i class="badge bgm-lightgreen">2.4</i> Complemento</label>
                                {{ text_field("Complemento Cobrança", "class" : "form-control fg-input fc-alt") }}
                            </div>
                            <!-- /complemento_cobranca -->

                        </div>
                    </div>
                    <div class="col-md-5 col-md-offset-1">
                        <div class="enderecoCobrancaBox">
                            <!-- bairro_cobranca -->
                            <div class="form-group fg-line">
                                <label><i class="badge bgm-lightgreen">2.5</i> Bairro <span class="text-danger">*</span></label>
                                {{ text_field("bairroCobranca", "name" : "Bairro Cobrança", "class" : "form-control fg-input fc-alt") }}
                            </div>
                            <!-- /bairro_cobranca -->

                            <!-- municipio_cobranca -->
                            <div class="form-group fg-line">
                                <label><i class="badge bgm-lightgreen">2.6</i> Município <span class="text-danger">*</span></label>
                                {{ text_field("cidadeCobranca", "name" : "Município Cobrança", "class" : "form-control fg-input fc-alt") }}
                            </div>
                            <!-- /municipio_cobranca -->

                            <!-- estado_cobranca -->
                            <div class="form-group fg-line">
                                <label><i class="badge bgm-lightgreen">2.7</i> Estado <span class="text-danger">*</span></label>
                                {{ text_field("ufCobranca", "name" : "Estado Cobrança", "class" : "form-control fg-input fc-alt", "maxlength": 2) }}
                            </div>
                            <!-- /estado_cobranca -->

                        </div>
                    </div>
                </div>
            </fieldset>
            <fieldset class="well well-alt">
                <legend><span class="badge bgm-green">4.0</span> Complementos</legend>
                <div class="row">
                    <div class="col-md-5">

                        <!-- natureza_juridica -->
                        <div class="form-group">
                            <div class="fg-line">
                                <label><i class="badge bgm-lightgreen">4.1</i> Natureza Jurídica <span class="text-danger">*</span></label>
                                {{ text_field("Natureza Jurídica", "class" : "form-control fg-input fc-alt naturezaMask", 'required': 'required') }}
                            </div>
                            <p class="help-block"><a href="http://www.receita.fazenda.gov.br/pessoajuridica/cnpj/tabelas/natjurqualificaresponsavel.htm" target="_new">Referência: Link da Receita Federal</a></p>
                        </div>
                        <!-- /natureza_juridica -->

                    </div>
                    <div class="col-md-5 col-md-offset-1">

                        <!-- codigo_cnae -->
                        <div class="form-group">
                            <div class="fg-line">
                                <label><i class="badge bgm-lightgreen">4.2</i> Código CNAE <span class="text-danger">*</span></label>
                                {{ text_field("Código CNAE", "class" : "form-control fg-input fc-alt cnaeMask", 'required': 'required') }}
                            </div>
                            <p class="help-block"><a href="http://www.receita.fazenda.gov.br/PessoaJuridica/CNAEFiscal/cnaef.htm" target="_new">Referência: Link da Receita Federal</a></p>
                        </div>
                        <!-- /codigo_cnae -->

                    </div>
                </div>
            </fieldset>
            <fieldset class="well well-alt">
                <legend><span class="badge bgm-green">5.0</span> Adicionais</legend>
                <div class="row">
                    <div class="col-md-5">

                        <!-- numero_nire -->
                        <div class="form-group fg-line">
                            <label><i class="badge bgm-lightgreen">5.1</i> Número NIRE <span class="text-danger">*</span></label>
                            {{ text_field("Número NIRE", "class" : "form-control fg-input fc-alt onlyNumber", 'required': 'required', "maxlength": 11) }}
                        </div>
                        <!-- /numero_nire -->

                        <!-- data_nire -->
                        <div class="form-group fg-line">
                            <label><i class="badge bgm-lightgreen">5.2</i> Data NIRE <span class="text-danger">*</span></label>
                            {{ text_field("Data NIRE", "class" : "form-control fg-input fc-alt datePicker", 'required': 'required') }}
                        </div>
                        <!-- /data_nire -->

                    </div>
                    <div class="col-md-5 col-md-offset-1">

                        <!-- inscricoes_suframa -->
                        <div class="form-group fg-line">
                            <label><i class="badge bgm-lightgreen">5.3</i> Inscrições Suframa</label>
                            {{ text_field("Inscrições Suframa", "class" : "form-control fg-input fc-alt") }}
                        </div>
                        <!-- /inscricoes_suframa -->

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
