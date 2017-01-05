{{ content() }}

<div class="card">
    <div class="card-header">
        <h2>Cadastro de Fornecedores <small>Preencha as informações para realizar a solicitação desejada.</small></h2>
    </div>

    <div class="card-body card-padding">
        <div class="form-wizard-basic fw-container">
            {{ form("forms/cadastro_fornecedores/sendForm", "method":"post", "autocomplete" : "off", 'onsubmit': 'overlay(true);') }}
            <fieldset class="well well-alt">
                <legend><span class="badge bgm-green">1.0</span> Dados Gerais</legend>
                <div class="row">
                    <div class="col-md-5">

                        <!-- sistema -->
                        <div class="form-group fg-line">
                            <label><i class="badge bgm-lightgreen">1.1</i> Sistema <span class="text-danger">*</span></label>
                            <select name="Sistema" id="sistema" class="form-control fg-input fc-alt" required>
                                <option value="Protheus" checked>Protheus</option>
                                <option value="Siscorp">Siscorp</option>
                            </select>
                        </div>
                        <!-- /sistema -->

                        <!-- cnpj -->
                        <div class="form-group fg-line">
                            <label><i class="badge bgm-lightgreen">1.2</i> CNPJ <span class="text-danger">*</span></label>
                            {{ text_field("CNPJ", "class" : "form-control fg-input fc-alt cnpjMask", "required": "required") }}
                        </div>
                        <!-- /cnpjCpf -->

                        <!-- razao_social -->
                        <div class="form-group fg-line">
                            <label><i class="badge bgm-lightgreen">1.3</i> Razão Social <span class="text-danger">*</span></label>
                            {{ text_field("Razão Social", "class" : "form-control fg-input fc-alt", "required": "required") }}
                        </div>
                        <!-- /razao_social -->

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
                    <div class="col-md-5 col-md-offset-1">

                        <!-- optante_simples -->
                        <div class="form-group fg-line">
                            <label><i class="badge bgm-lightgreen">1.7</i> Optante pelo Simples <span class="text-danger">*</span></label>
                            <select name="optante_simples" id="optante_simples" class="form-control fg-input fc-alt" required>
                                <option value="Sim" checked>Sim</option>
                                <option value="Não">Não</option>
                            </select>
                        </div>
                        <!-- /optante_simples -->

                        <!-- metodos_avaliacao -->
                        <div class="form-group fg-line">
                            <label><i class="badge bgm-lightgreen">1.8</i> Métodos de Avaliação <span class="text-danger">*</span></label>
                            <br />
                            <div class="radio m-b-15">
                                <label>
                                    {{ radio_field("Métodos de Avaliação", "value" : "Histórico de fornecimentos anteriores ou atestados de fornecimentos similares a outras empresas", "required": "required") }}
                                    <i class="input-helper"></i>
                                    Histórico de fornecimentos anteriores ou atestados de fornecimentos similares a outras empresas;
                                </label>
                            </div>
                            <div class="radio m-b-15">
                                <label>
                                    {{ radio_field("Métodos de Avaliação", "value" : "Apresentação de certificados de testes e análises feitos por instituições comprovadamente reconhecidas") }}
                                    <i class="input-helper"></i>
                                    Apresentação de certificados de testes e análises feitos por instituições comprovadamente reconhecidas;
                                </label>
                            </div>
                            <div class="radio m-b-15">
                                <label>
                                    {{ radio_field("Métodos de Avaliação", "value" : "Análise de amostras fornecidas para testes / ensaios e/ou aprovação do cliente final") }}
                                    <i class="input-helper"></i>
                                    Análise de amostras fornecidas para testes / ensaios e/ou aprovação do cliente final;
                                </label>
                            </div>
                            <div class="radio m-b-15">
                                <label>
                                    {{ radio_field("Métodos de Avaliação", "value" : "Avaliação “in loco” da capacidade dos fornecedores e/ou dos sistemas de gestão implementados na organização avaliada") }}
                                    <i class="input-helper"></i>
                                    Avaliação “in loco” da capacidade dos fornecedores e/ou dos sistemas de gestão implementados na organização avaliada;
                                </label>
                            </div>
                            <div class="radio m-b-15">
                                <label>
                                    {{ radio_field("Métodos de Avaliação", "value" : "Certificação formal, por órgão independente, da qualidade do item / serviço,  e/ou da conformidade do SGI com base nos requisitos especificados, assim como da legislação referente as suas atividades") }}
                                    <i class="input-helper"></i>
                                    Certificação formal, por órgão independente, da qualidade do item / serviço,  e/ou da conformidade do SGI com base nos requisitos especificados, assim como da legislação referente as suas atividades;
                                </label>
                            </div>
                            <div class="radio m-b-15">
                                <label>
                                    {{ radio_field("Métodos de Avaliação", "value" : "Indicação / qualificação pelos clientes, considerando os aspectos mínimos acima citados e do produto ou serviço fornecido") }}
                                    <i class="input-helper"></i>
                                    Indicação / qualificação pelos clientes, considerando os aspectos mínimos acima citados e do produto ou serviço fornecido;
                                </label>
                            </div>
                            <div class="radio m-b-15">
                                <label>
                                    {{ radio_field("Métodos de Avaliação", "value" : "Oportunidade inicial") }}
                                    <i class="input-helper"></i>
                                    Oportunidade inicial;
                                </label>
                            </div>
                        </div>
                        <!-- /metodos_avaliacao -->

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
                    <div class="col-md-5 col-md-offset-1">

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
