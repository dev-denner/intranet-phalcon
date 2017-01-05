{{ content() }}

<div class="card">
    <div class="card-header">
        <h2>Acessos a Serviços de TI <small>Preencha as informações para realizar a solicitação desejada.</small></h2>
    </div>

    <div class="card-body card-padding">
        <div class="form-wizard-basic fw-container">
            {{ form("forms/solicitacoes_acessos/sendForm", "method":"post", "autocomplete" : "off", 'onsubmit': 'return validaForm(this);', 'novalidate': true) }}
            <fieldset class="well well-alt">
                <legend><span class="badge bgm-green">1.0</span> Identificação</legend>
                <div class="row">
                    <div class="col-md-4">
                        <!-- cpf -->
                        <div class="form-group">
                            <div class="fg-line">
                                <label class="control-label"><i class="badge bgm-lightgreen">1.1</i> CPF do Colaborador <span class="text-danger">*</span></label>
                                {{ text_field('cpf', 'class' : 'form-control fg-input fc-alt cpfMask', 'placeholder': 'Número', 'required': 'required') }}
                            </div>
                            <p class="errors_colaborador text-danger"></p>
                            <p class="help-block"></p>
                        </div>
                        <!-- /cpf -->
                        <!-- telefone -->
                        <div class="form-group fg-line">
                            <label class="control-label"><i class="badge bgm-lightgreen">1.2</i> Telefone</label>
                            {{ text_field("telefone", "class" : "form-control fg-input fc-alt telefone", 'placeholder': 'Número') }}
                        </div>

                        <!-- /telefone -->
                        <!-- localizacao -->
                        <div class="form-group">
                            <label class="control-label"><i class="badge bgm-lightgreen">1.3</i> Localização <span class="text-danger">*</span></label>
                            <br />
                            <label class="radio radio-inline">
                                {{ radio_field("localizacao", "value" : "Matriz", 'required': 'required') }}
                                <i class="input-helper"></i>
                                Matriz
                            </label>
                            <label class="radio radio-inline">
                                {{ radio_field("localizacao", "value" : "Filial / Empreendimento") }}
                                <i class="input-helper"></i>
                                Filial / Empreendimento
                            </label>
                            <p class="help-block"></p>
                        </div>
                        <!-- /localizacao -->
                        <!-- justificativa -->
                        <div class="form-group">
                            <label class="control-label"><i class="badge bgm-lightgreen">1.4</i> Justificativa de Solicitação <span class="text-danger">*</span></label>
                            <br />
                            <label class="radio radio-inline">
                                {{ radio_field("justificativa", "value" : "Novo Colaborador", 'required': 'required') }}
                                <i class="input-helper"></i>
                                Novo Colaborador
                            </label>
                            <label class="radio radio-inline">
                                {{ radio_field("justificativa", "value" : "Outros") }}
                                <i class="input-helper"></i>
                                Outros
                            </label>
                            <p class="help-block"></p>
                        </div>
                        <div class="form-group fg-line">
                            {{ text_field("justificativa_outros", "class" : "form-control fg-input fc-alt", "disabled": "disabled") }}
                            <p class="help-block"></p>
                        </div>
                        <!-- /justificativa -->
                    </div>
                    <div class="col-md-6 col-md-offset-1">
                        {{ hidden_field('info_colaborador') }}
                        {{ hidden_field('email_colaborador') }}
                        {{ hidden_field('nome_colaborador') }}
                        <div class="infomations_colaborador well">
                            <p class="text-center">Digite o CPF</p>
                        </div>
                    </div>
                </div>
            </fieldset>
            <fieldset class="well well-alt">
                <legend><span class="badge bgm-green">2.0</span> Gestor Imediato</legend>
                <div class="row">
                    <div class="col-md-4">
                        <!-- email_gestor -->
                        <div class="form-group">
                            <div class="fg-line">
                                <label class="control-label"><i class="badge bgm-lightgreen">2.1</i> E-mail <span class="text-danger">*</span></label>
                                {{ email_field("email_gestor", "class" : "form-control fg-input fc-alt", 'required': 'required') }}
                            </div>
                            <p class="errors_gestor text-danger"></p>
                            <p class="help-block"></p>
                        </div>
                        <!-- /email_gestor -->
                    </div>
                    <div class="col-md-6 col-md-offset-1">
                        {{ hidden_field('info_gestor') }}
                        {{ hidden_field('email_gestor_h') }}
                        {{ hidden_field('nome_gestor') }}
                        <div class="infomations_gestor well">
                            <p class="text-center">Digite o E-mail</p>
                        </div>
                    </div>
                </div>
            </fieldset>
            <div class="errors text-danger"></div>
            <fieldset class="well well-alt">
                <legend>
                    <span class="badge bgm-green">3.0</span>
                    E-mail
                    <label class="checkbox checkbox-inline check-legend">
                        {{ check_field("servico_email", "value" : "Serviço de E-mail") }}
                        <i class="input-helper"></i>
                    </label>
                </legend>
                <!-- email -->
                <div id="servico_email_box">
                    <div class="row">
                        <div class="form-group clearfix">
                            <label class="m-l-15"><i class="badge bgm-lightgreen">3.1</i> Zimbra</label>
                            <div class="form-group pull-right m-r-15">
                                <label class="radio radio-inline">
                                    {{ radio_field("acao_email", "value" : "Criar Conta") }}
                                    <i class="input-helper"></i>
                                    Criar Conta
                                </label>
                                <label class="radio radio-inline">
                                    {{ radio_field("acao_email", "value" : "Bloquear Conta") }}
                                    <i class="input-helper"></i>
                                    Bloquear Conta
                                </label>
                                <p class="help-block"></p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- email -->
            </fieldset>
            <div class="errors_sistemas text-danger"></div>
            <fieldset class="well well-alt">
                <legend><span class="badge bgm-green">4.0</span>
                    Sistemas
                    <label class="checkbox checkbox-inline check-legend">
                        {{ check_field("servico_sistemas", "value" : "Serviço de Sistemas") }}
                        <i class="input-helper"></i>
                    </label>
                </legend>

                <div id="servico_sistemas_box">
                    <!-- protheus -->
                    <div class="row">
                        <label class="m-l-15">
                            <i class="badge bgm-lightgreen">4.1</i>
                            Protheus
                            <label class="checkbox checkbox-inline">
                                {{ check_field("servico_sistemas_protheus", "value" : "Serviço de Sistemas - Protheus") }}
                                <i class="input-helper"></i>
                            </label>
                        </label>
                        <div class="form-group pull-right m-r-15 servico_sistemas_protheus_box">
                            <label class="radio radio-inline">
                                {{ radio_field("acao_protheus", "value" : "Liberar") }}
                                <i class="input-helper"></i>
                                Liberar
                            </label>
                            <label class="radio radio-inline">
                                {{ radio_field("acao_protheus", "value" : "Bloquear") }}
                                <i class="input-helper"></i>
                                Bloquear
                            </label>
                            <p class="help-block"></p>
                        </div>
                    </div>
                    <div class="servico_sistemas_protheus_box">
                        <div class="row">
                            <div class="col-md-4">
                                <!-- empresas -->
                                <div class="form-group">
                                    <div class="fg-line">
                                        <label class="control-label">Empresas</label>
                                        <?php
                                        echo $this->tag->select(['empresas',
                                            $empresas,
                                            'size' => 5,
                                            'class' => 'form-control fg-input fc-alt'
                                        ]);
                                        ?>
                                    </div>
                                </div>
                                <!-- /empresas -->
                            </div>
                            <div class="col-md-3">
                                <!-- filiais -->
                                <div class="form-group">
                                    <div class="fg-line">
                                        <label class="control-label">Filiais</label>
                                        <select id="filiais" name="filiais" class="form-control fg-input fc-alt" size="5"></select>
                                    </div>
                                </div>
                                <!-- /filiais -->
                            </div>
                            <div class="col-md-1 col-xs-3">
                                <br /><br />
                                <p class="text-center">
                                    <button type="button" onclick="addProtheus()" class="btn bgm-green tooltips" title="Adicionar">
                                        <i class="fa fa-chevron-right" aria-hidden="true"></i>
                                    </button>
                                </p>
                                <p class="text-center">
                                    <button type="button" onclick="removeProtheus()" class="btn bgm-red text-center tooltips" title="Remover">
                                        <i class="fa fa-chevron-left" aria-hidden="true"></i>
                                    </button>
                                </p>
                            </div>
                            <div class="col-md-4 col-xs-9">
                                <!-- adicionados -->
                                <div class="form-group">
                                    <div class="fg-line">
                                        <label class="control-label">Selecionados</label>
                                        <select id="adicionados" multiple="multiple" name="adicionados[]" class="form-control fg-input fc-alt" size="5"></select>
                                    </div>
                                    <p class="help-block"></p>
                                    {{ hidden_field('adicionados_hidden', 'value': '') }}
                                </div>
                                <!-- /adicionados -->
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <label class="m-l-15 control-label">Módulos</label>
                                <br />

                                <div class="col-md-4">
                                    {% for key, modulo in modulos %}
                                    <label class="checkbox checkbox-inline">
                                        {{ check_field("modulos_protheus"~key, "name":"modulos_protheus[]", "value" : modulo.code) }}
                                        <i class="input-helper"></i>
                                        {{ modulo.value }}
                                    </label>
                                    <br />
                                    {% if (key + 1) % (count(modulos) / 3) == 0 %}
                                </div>
                                <div class="col-md-4">
                                    {% endif %}
                                    {% endfor %}
                                </div>
                                <p class="help-block"></p>
                            </div>
                        </div>
                    </div>
                    <!-- /protheus -->
                    <hr />
                    <!-- rm -->
                    <div class="row">
                        <label class="m-l-15"><i class="badge bgm-lightgreen">4.2</i>
                            RM
                            <label class="checkbox checkbox-inline">
                                {{ check_field("servico_sistemas_rm", "value" : "Serviço de Sistemas - RM") }}
                                <i class="input-helper"></i>
                            </label>
                        </label>
                        <div class="form-group pull-right m-r-15 servico_sistemas_rm_box">
                            <label class="radio radio-inline">
                                {{ radio_field("acao_rm", "value" : "Liberar") }}
                                <i class="input-helper"></i>
                                Liberar
                            </label>
                            <label class="radio radio-inline">
                                {{ radio_field("acao_rm", "value" : "Bloquear") }}
                                <i class="input-helper"></i>
                                Bloquear
                            </label>
                            <p class="help-block"></p>
                        </div>
                    </div>
                    <div class="servico_sistemas_rm_box">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">Módulos</label>
                                    <br />
                                    <label class="checkbox checkbox-inline">
                                        {{ check_field("modulos_rm1", "name":"modulos_rm[]", "value" : "Automação de Ponto (Chronus)") }}
                                        <i class="input-helper"></i>
                                        Automação de Ponto (Chronus)
                                    </label>
                                    <br />
                                    <label class="checkbox checkbox-inline">
                                        {{ check_field("modulos_rm2", "name":"modulos_rm[]", "value" : "Folha de Pagamento (Labore)") }}
                                        <i class="input-helper"></i>
                                        Folha de Pagamento (Labore)
                                    </label>
                                    <br />
                                    <label class="checkbox checkbox-inline">
                                        {{ check_field("modulos_rm3", "name":"modulos_rm[]", "value" : "Gestão de Pessoas (Vitae)") }}
                                        <i class="input-helper"></i>
                                        Gestão de Pessoas (Vitae)
                                    </label>
                                    <br />
                                    <label class="checkbox checkbox-inline">
                                        {{ check_field("modulos_rm4", "name":"modulos_rm[]", "value" : "Segurança e Med. do Trabalho (Vitae)") }}
                                        <i class="input-helper"></i>
                                        Segurança e Med. do Trabalho (Vitae)
                                    </label>
                                    <br />
                                    <label class="checkbox checkbox-inline">
                                        {{ check_field("modulos_rm5", "name":"modulos_rm[]", "value" : "Portal RH") }}
                                        <i class="input-helper"></i>
                                        Portal RH
                                    </label>
                                    <br />
                                    <p class="help-block"></p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">Empresas</label>
                                    <br />
                                    {% for key, coligada in coligadas %}
                                    <label class="checkbox checkbox-inline">
                                        {{ check_field("coligadas"~key, "name":"coligadas[]", "value" : coligada['CODCOLIGADA'] ~ ' - ' ~ coligada['NOME']) }}
                                        <i class="input-helper"></i>
                                        {{ coligada['NOME'] }}
                                    </label>
                                    <br />
                                    {% endfor %}
                                    <p class="help-block"></p>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label class="control-label">Perfis</label>
                                    <br />
                                    <div class="row">
                                        <div class="col-md-6">
                                            {% for key, perfil in perfils %}
                                            <label class="checkbox checkbox-inline">
                                                {{ check_field("perfils_rm"~key, "name":"perfils_rm[]", "value" : perfil.value) }}
                                                <i class="input-helper"></i>
                                                {{ perfil.value }}
                                            </label>
                                            <br />
                                            {% if (key + 1) % (count(perfils) / 2) == 0 %}
                                        </div>
                                        <div class="col-md-6">
                                            {% endif %}
                                            {% endfor %}
                                        </div>
                                    </div>
                                    <p class="help-block"></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /rm -->
                    <hr />
                    <!-- ecm -->
                    <div class="row">
                        <label class="m-l-15"><i class="badge bgm-lightgreen">4.3</i>
                            ECM
                            <label class="checkbox checkbox-inline">
                                {{ check_field("servico_sistemas_ecm", "value" : "Serviço de Sistemas - ECM") }}
                                <i class="input-helper"></i>
                            </label>
                        </label>
                        <div class="form-group pull-right m-r-15 servico_sistemas_ecm_box">
                            <label class="radio radio-inline">
                                {{ radio_field("acao_ecm", "value" : "Liberar") }}
                                <i class="input-helper"></i>
                                Liberar
                            </label>
                            <label class="radio radio-inline">
                                {{ radio_field("acao_ecm", "value" : "Bloquear") }}
                                <i class="input-helper"></i>
                                Bloquear
                            </label>
                            <p class="help-block"></p>
                        </div>
                    </div>
                    <div class="servico_sistemas_ecm_box">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Módulos</label>
                                    <br />
                                    <label class="checkbox checkbox-inline">
                                        {{ check_field("modulos_ecm1", "name":"modulos_ecm[]", "value" : "GED - Gerenciador Eletrônico de Documentos") }}
                                        <i class="input-helper"></i>
                                        GED - Gerenciador Eletrônico de Documentos
                                    </label>
                                    <br />
                                    <label class="checkbox checkbox-inline">
                                        {{ check_field("modulos_ecm2", "name":"modulos_ecm[]","value" : "Solicitação de Adiantamento + Reembolso de Despesas") }}
                                        <i class="input-helper"></i>
                                        Solicitação de Adiantamento + Reembolso de Despesas
                                    </label>
                                    <br />
                                    <p class="help-block"></p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Perfis</label>
                                    <br />
                                    <label class="checkbox checkbox-inline">
                                        {{ check_field("perfils_ecm1", "name":"perfils_ecm[]", "value" : "Solicitante") }}
                                        <i class="input-helper"></i>
                                        Solicitante
                                    </label>
                                    <br />
                                    <label class="checkbox checkbox-inline">
                                        {{ check_field("perfils_ecm2", "name":"perfils_ecm[]","value" : "Aprovador") }}
                                        <i class="input-helper"></i>
                                        Aprovador
                                    </label>
                                    <br />
                                    <p class="help-block"></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /ecm -->
                    <hr />
                    <!-- bi -->
                    <div class="row">
                        <label class="m-l-15"><i class="badge bgm-lightgreen">4.4</i>
                            BI - MicroStrategy
                            <label class="checkbox checkbox-inline">
                                {{ check_field("servico_sistemas_bi", "value" : "Serviço de Sistemas - BI") }}
                                <i class="input-helper"></i>
                            </label>
                        </label>
                        <div class="form-group pull-right m-r-15 servico_sistemas_bi_box">
                            <label class="radio radio-inline">
                                {{ radio_field("acao_bi", "value" : "Incluir") }}
                                <i class="input-helper"></i>
                                Incluir
                            </label>
                            <label class="radio radio-inline">
                                {{ radio_field("acao_bi", "value" : "Bloquear") }}
                                <i class="input-helper"></i>
                                Bloquear
                            </label>
                            <p class="help-block"></p>
                        </div>
                    </div>
                    <div class="servico_sistemas_bi_box">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Grupos</label>
                                    <br />
                                    <label class="checkbox checkbox-inline">
                                        {{ check_field("grupos_bi1", "name":"grupos_bi[]", "value" : "Gestão de Pessoas (RH/DP)") }}
                                        <i class="input-helper"></i>
                                        Gestão de Pessoas (RH/DP)
                                    </label>
                                    <br />
                                    <label class="checkbox checkbox-inline">
                                        {{ check_field("grupos_bi2", "name":"grupos_bi[]","value" : "Financeiro") }}
                                        <i class="input-helper"></i>
                                        Financeiro
                                    </label>
                                    <br />
                                    <p class="help-block"></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /bi -->
                    <hr />
                    <!-- otrs -->
                    <div class="row">
                        <label class="m-l-15"><i class="badge bgm-lightgreen">4.5</i>
                            OTRS
                            <label class="checkbox checkbox-inline">
                                {{ check_field("servico_sistemas_otrs", "value" : "Serviço de Sistemas - OTRS") }}
                                <i class="input-helper"></i>
                            </label>
                        </label>
                        <div class="form-group pull-right m-r-15 servico_sistemas_otrs_box">
                            <label class="radio radio-inline">
                                {{ radio_field("acao_otrs", "value" : "Liberar") }}
                                <i class="input-helper"></i>
                                Liberar
                            </label>
                            <label class="radio radio-inline">
                                {{ radio_field("acao_otrs", "value" : "Bloquear") }}
                                <i class="input-helper"></i>
                                Bloquear
                            </label>
                            <p class="help-block"></p>
                        </div>
                    </div>
                    <div class="servico_sistemas_otrs_box">
                        <div class="form-group">
                            <label class="control-label">Papéis</label>
                            <br />
                            <div class="row">
                                <div class="col-md-4">
                                    {% for key, otrs in papeis_otrs %}
                                    <label class="checkbox checkbox-inline">
                                        {{ check_field("papeis_otrs"~key, "name":"papeis_otrs[]", "value" : otrs.code) }}
                                        <i class="input-helper"></i>
                                        {{ otrs.value }}
                                    </label>
                                    <br />
                                    {% if (key + 1) % (count(papeis_otrs) / 2.5) == 0 %}
                                </div>
                                <div class="col-md-4">
                                    {% endif %}
                                    {% endfor %}
                                </div>
                            </div>
                            <p class="help-block"></p>
                        </div>
                    </div>
                    <!-- /otrs -->
                </div>
            </fieldset>
            <div class="errors_matriz text-danger"></div>
            <fieldset class="well well-alt">
                <legend><span class="badge bgm-green">5.0</span>
                    Matriz
                    <label class="checkbox checkbox-inline check-legend">
                        {{ check_field("servico_matriz", "value" : "Serviço da Matriz") }}
                        <i class="input-helper"></i>
                    </label>
                </legend>
                <div id="servico_matriz_box">
                    <!-- rede_matriz -->
                    <div class="row">
                        <label class="m-l-15"><i class="badge bgm-lightgreen">5.1</i>
                            Rede
                            <label class="checkbox checkbox-inline">
                                {{ check_field("servico_matriz_rede", "value" : "Serviço da Matriz - Rede") }}
                                <i class="input-helper"></i>
                            </label>
                        </label>
                        <div class="form-group pull-right m-r-15 servico_matriz_rede_box">
                            <label class="radio radio-inline">
                                {{ radio_field("acao_rede_matriz", "value" : "Liberar") }}
                                <i class="input-helper"></i>
                                Liberar
                            </label>
                            <label class="radio radio-inline">
                                {{ radio_field("acao_rede_matriz", "value" : "Bloquear") }}
                                <i class="input-helper"></i>
                                Bloquear
                            </label>
                            <p class="help-block"></p>
                        </div>
                    </div>
                    <div class="servico_matriz_rede_box">
                        <div class="row">
                            <div class="form-group">
                                <label class="m-l-15 control-label">Pastas compartilhadas a utilizar:</label>
                                <br />
                                <div class="col-md-3">
                                    {% for key, rede in rede_matriz %}
                                    <label class="checkbox checkbox-inline">
                                        {{ check_field("rede_matriz"~key, "name":"rede_matriz[]", "value" : rede.code) }}
                                        <i class="input-helper"></i>
                                        {{ rede.value }}
                                    </label>
                                    <br />
                                    {% if (key + 1) % (count(rede_matriz) / 4) == 0 %}
                                </div>
                                <div class="col-md-3">
                                    {% endif %}
                                    {% endfor %}
                                </div>
                                <p class="help-block"></p>
                            </div>
                        </div>
                    </div>
                    <!-- /rede_matriz -->
                    <hr />
                    <!-- catraca_biometrica -->
                    <div class="row">
                        <label class="m-l-15"><i class="badge bgm-lightgreen">5.2</i>
                            Catraca Biométrica
                            <label class="checkbox checkbox-inline">
                                {{ check_field("servico_matriz_catraca", "value" : "Serviço da Matriz - Catraca") }}
                                <i class="input-helper"></i>
                            </label>
                        </label>
                        <div class="form-group pull-right m-r-15 servico_matriz_catraca_box">
                            <label class="radio radio-inline">
                                {{ radio_field("acao_catraca", "value" : "Liberar") }}
                                <i class="input-helper"></i>
                                Liberar
                            </label>
                            <label class="radio radio-inline">
                                {{ radio_field("acao_catraca", "value" : "Bloquear") }}
                                <i class="input-helper"></i>
                                Bloquear
                            </label>
                            <p class="help-block"></p>
                        </div>
                    </div>
                    <!-- /catraca_biometrica -->
                </div>
            </fieldset>
            <div class="form-group clearfix">
                <button type="submit" class="btn btn-success pull-right">Enviar</button>
            </div>
            {{ end_form() }}
        </div>
    </div>
</div>
