{{ content() }}

<div class="card">
    <div class="card-header">
        <h2>Cadastro de Clientes <small>Preencha as informações para realizar a solicitação desejada.</small></h2>
    </div>

    <div class="card-body card-padding">
        <div class="form-wizard-basic fw-container">
            {{ form("forms/cadastro_clientes/sendForm", "method":"post", "autocomplete" : "off", 'onsubmit': 'overlay(true);') }}
            <fieldset class="well well-alt">
                <legend><span class="badge bgm-green">1.0</span> Dados Gerais</legend>
                <div class="row">
                    <div class="col-md-5">
                        <!-- pessoa -->
                        <div class="form-group">
                            <label><i class="badge bgm-lightgreen">1.1</i> Pessoa <span class="text-danger">*</span></label>
                            <br />
                            <label class="radio radio-inline">
                                {{ radio_field("Pessoa", "value" : "Física", "required": "required") }}
                                <i class="input-helper"></i>
                                Física
                            </label>
                            <label class="radio radio-inline">
                                {{ radio_field("Pessoa", "value" : "Jurídica") }}
                                <i class="input-helper"></i>
                                Jurídica
                            </label>
                        </div>
                        <!-- /pessoa -->

                        <!-- cnpjCpf -->
                        <div class="form-group fg-line">
                            <label><i class="badge bgm-lightgreen">1.2</i> CPF / CNPJ <span class="text-danger">*</span></label>
                            {{ text_field("cnpjCpf", "name" : "CPF / CNPJ", "class" : "form-control fg-input fc-alt", "required": "required") }}
                        </div>
                        <!-- /cnpjCpf -->

                        <!-- razao_social -->
                        <div class="form-group fg-line">
                            <label><i class="badge bgm-lightgreen">1.3</i> Razão Social <span class="text-danger">*</span></label>
                            {{ text_field("Razão Social", "class" : "form-control fg-input fc-alt", "required": "required") }}
                        </div>
                        <!-- /razao_social -->

                    </div>
                    <div class="col-md-5 col-md-offset-1">

                        <!-- nome_fantasia -->
                        <div class="form-group fg-line">
                            <label><i class="badge bgm-lightgreen">1.4</i> Nome Fantasia <span class="text-danger">*</span></label>
                            {{ text_field("Nome Fantasia", "class" : "form-control fg-input fc-alt", "required": "required") }}
                        </div>
                        <!-- /nome_fantasia -->

                        <!-- insc_estadual -->
                        <div class="form-group fg-line">
                            <label><i class="badge bgm-lightgreen">1.5</i> Inscrição Estadual <span class="text-danger">*</span></label>
                            {{ text_field("Inscrição Estadual", "class" : "form-control fg-input fc-alt", "required": "required") }}
                        </div>
                        <!-- /insc_estadual -->

                        <!-- insc_municipal -->
                        <div class="form-group fg-line">
                            <label><i class="badge bgm-lightgreen">1.6</i> Inscrição Municipal <span class="text-danger">*</span></label>
                            {{ text_field("Inscrição Municipal", "class" : "form-control fg-input fc-alt", "required": "required") }}
                        </div>
                        <!-- /insc_municipal -->

                    </div>
                </div>
            </fieldset>
            <fieldset class="well well-alt">
                <legend><span class="badge bgm-green">2.0</span> Localização</legend>
                <div class="row">
                    <div class="col-md-5">

                        <!-- cep -->
                        <div class="form-group fg-line">
                            <label><i class="badge bgm-lightgreen">2.1</i> CEP <span class="text-danger">*</span></label>
                            {{ text_field("cep", "name" : "CEP", "class" : "form-control fg-input fc-alt cepMask", "required": "required") }}
                        </div>
                        <!-- /cep -->

                        <!-- endereco -->
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group fg-line">
                                    <label>
                                        <i class="badge bgm-lightgreen">2.2</i> Endereço <span class="text-danger">*</span>
                                    </label>
                                    {{ text_field("endereco", "name" : "Endereço", "class" : "form-control fg-input fc-alt", "required": "required") }}
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group fg-line">
                                    <label>
                                        <i class="badge bgm-lightgreen">2.3</i> Número <span class="text-danger">*</span>
                                    </label>

                                    {{ text_field("Número", "class" : "form-control fg-input fc-alt", "required": "required") }}
                                </div>
                            </div>
                        </div>
                        <!-- /endereco -->

                        <!-- complemento -->
                        <div class="form-group fg-line">
                            <label><i class="badge bgm-lightgreen">2.4</i> Complemento</label>
                            {{ text_field("Complemento", "class" : "form-control fg-input fc-alt") }}
                        </div>
                        <!-- /complemento -->

                    </div>
                    <div class="col-md-5 col-md-offset-1">

                        <!-- bairro -->
                        <div class="form-group fg-line">
                            <label><i class="badge bgm-lightgreen">2.5</i> Bairro <span class="text-danger">*</span></label>
                            {{ text_field("bairro", "name" : "Bairro", "class" : "form-control fg-input fc-alt", "required": "required") }}
                        </div>
                        <!-- /bairro -->

                        <!-- municipio -->
                        <div class="form-group fg-line">
                            <label><i class="badge bgm-lightgreen">2.6</i> Município <span class="text-danger">*</span></label>
                            {{ text_field("cidade", "name" : "Município", "class" : "form-control fg-input fc-alt", "required": "required") }}
                        </div>
                        <!-- /municipio -->

                        <!-- estado -->
                        <div class="form-group fg-line">
                            <label><i class="badge bgm-lightgreen">2.7</i> Estado <span class="text-danger">*</span></label>
                            {{ text_field("uf", "name" : "Estado", "class" : "form-control fg-input fc-alt", "required": "required", "maxlength": 2) }}
                        </div>
                        <!-- /estado -->

                    </div>

                </div>
            </fieldset>
            <fieldset class="well well-alt">
                <legend><span class="badge bgm-green">3.0</span> Contatos</legend>
                <div class="row">
                    <div class="col-md-5">

                        <!-- tel -->
                        <div class="form-group fg-line">
                            <label><i class="badge bgm-lightgreen">3.1</i> Tel / Fax <span class="text-danger">*</span></label>
                            {{ text_field("Tel / Fax", "class" : "form-control fg-input fc-alt telefone", "required": "required") }}
                        </div>
                        <!-- /tel -->

                        <!-- contato -->
                        <div class="form-group fg-line">
                            <label><i class="badge bgm-lightgreen">3.2</i> Contato</label>
                            {{ text_field("Contato", "class" : "form-control fg-input fc-alt") }}
                        </div>
                        <!-- /contato -->

                    </div>
                    <div class="col-md-5 col-md-offset-1">

                        <!-- email -->
                        <div class="form-group fg-line">
                            <label><i class="badge bgm-lightgreen">3.3</i> E-mail <span class="text-danger">*</span></label>
                            {{ email_field("E-mail", "class" : "form-control fg-input fc-alt emailMask", "required": "required") }}
                        </div>
                        <!-- /email -->

                        <!-- site -->
                        <div class="form-group fg-line">
                            <label><i class="badge bgm-lightgreen">3.4</i> Site</label>
                            {{ text_field("Site", "class" : "form-control fg-input fc-alt") }}
                        </div>
                        <!-- /site -->

                    </div>
                </div>
            </fieldset>
            <fieldset class="well well-alt">
                <legend><span class="badge bgm-green">4.0</span> Dados Bancários</legend>
                <div class="row">
                    <div class="col-md-5">

                        <!-- banco -->
                        <div class="form-group fg-line">
                            <label><i class="badge bgm-lightgreen">4.1</i> Banco <span class="text-danger">*</span></label>
                            {{ text_field("Banco", "class" : "form-control fg-input fc-alt", 'required': 'required') }}
                        </div>
                        <!-- /banco -->

                        <!-- agencia -->
                        <div class="form-group fg-line">
                            <label><i class="badge bgm-lightgreen">4.2</i> Agência <span class="text-danger">*</span></label>
                            {{ text_field("Agência", "class" : "form-control fg-input fc-alt", 'required': 'required') }}
                        </div>
                        <!-- /agencia -->

                    </div>
                    <div class="col-md-5 col-md-offset-1">

                        <!-- contaCorrente -->
                        <div class="form-group fg-line">
                            <label><i class="badge bgm-lightgreen">4.3</i> Conta Corrente <span class="text-danger">*</span></label>
                            {{ text_field("Conta Corrente", "class" : "form-control fg-input fc-alt", 'required': 'required') }}
                        </div>
                        <!-- /contaCorrente -->

                        <!-- nBanco -->
                        <div class="form-group fg-line">
                            <label><i class="badge bgm-lightgreen">4.4</i> Nº Banco <span class="text-danger">*</span></label>
                            {{ text_field("Nº Banco", "class" : "form-control fg-input fc-alt onlyNumber", 'required': 'required') }}
                        </div>
                        <!-- /nBanco -->

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
