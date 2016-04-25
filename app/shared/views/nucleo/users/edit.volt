{{ content() }}

<div class="row">
    <div class="col-lg-6 col-lg-offset-3">
        <div class="card">
            <div class="card-header">
                <h2>Usuários <small>Insira os dados para atualizar o usuário.</small></h2>
            </div>

            <div class="card-body card-padding">
                {{ form("nucleo/users/save", "method":"post", "autocomplete" : "off") }}

                {{ hidden_field("id", 'required': 'required') }}
                <div class="form-group fg-float">
                    <div class="fg-line">
                        {{ text_field('cpf', 'class': 'form-control', 'required': 'required', 'maxlength': 14, 'onblur': 'getInfoUser(this);') }}
                        <label class="fg-label">CPF do Usuário</label>
                    </div>
                </div>
                <br />

                <div class="form-group fg-float">
                    <div class="fg-line">
                        {{ email_field('email', 'class': 'form-control', 'required': 'required') }}
                        <label class="fg-label">E-mail</label>
                    </div>
                </div>
                <br />

                <div class="checkbox">
                    <label>
                        {% if mustChangePassword is 'S' %}
                        {{ check_field('mustChangePassword', 'value':'S', 'checked': 'checked') }}
                        {% else %}
                        {{ check_field('mustChangePassword', 'value':'S') }}
                        {% endif %}
                        <i class="input-helper"></i>
                        Trocar senha na próxima vez que logar?
                    </label>
                </div>

                <div class="form-group">
                    <div class="fg-line">
                        <div class="select">
                            <?php
                            echo $this->tag->select(["status",
                                \Nucleo\Models\TablesSystem::find("table = 'status'"),
                                "using" => ["code", "value"],
                                'useEmpty' => true,
                                'emptyText' => 'Status (Escolha uma opção)',
                                'emptyValue' => '',
                                'class' => 'form-control']
                            );
                            ?>
                        </div>
                    </div>
                </div>
                <br />

                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-sm m-t-10 waves-effect">Atualizar</button>
                </div>
                <hr />
                <div class="errors">
                    <p class="text-danger"></p>
                </div>
                <div class="info-user" style="display: block">
                    <div class="row">
                        <div class="col-lg-6">

                            <dl>
                                <dt>Empresa:</dt>
                                <dd class="m-b-5 text-info data-EMPRESA">{{ info_user['EMPRESA'] }}</dd>
                                <dt>Nome:</dt>
                                <dd class="m-b-5 text-info data-NOME">{{ info_user['NOME'] }}</dd>
                                <dt>Situação:</dt>
                                <dd class="m-b-5 text-info data-SITUACAO">{{ info_user['SITUACAO'] }}</dd>
                                <dt>CPF:</dt>
                                <dd class="m-b-5 text-info data-CPF">{{ info_user['CPF'] }}</dd>
                                <dt>E-mail:</dt>
                                <dd class="m-b-5 text-info data-EMAIL">{{ info_user['EMAIL'] }}</dd>
                                <dt>Data Admissão:</dt>
                                <dd class="m-b-5 text-info data-DATAADMISSAO">{{ info_user['DATAADMISSAO'] }}</dd>
                            </dl>
                        </div>
                        <div class="col-lg-6">
                            <dl>
                                <dt>Pessoa:</dt>
                                <dd class="m-b-5 text-info data-PESSOA">{{ info_user['PESSOA'] }}</dd>
                                <dt>Seção:</dt>
                                <dd class="m-b-5 text-info data-CODSECAO">{{ info_user['CODSECAO'] }}</dd>
                                <dt>CC / EO:</dt>
                                <dd class="m-b-5 text-info data-CCEO">{{ info_user['CCEO'] }}</dd>
                                <dt>CNPJ:</dt>
                                <dd class="m-b-5 text-info data-CNPJ">{{ info_user['CNPJ'] }}</dd>
                                <dt>Ramal:</dt>
                                <dd class="m-b-5 text-info data-RAMAL">{{ info_user['RAMAL'] }}</dd>
                                <dt>Data Demissão:</dt>
                                <dd class="m-b-5 text-info data-DATADEMISSAO">{{ info_user['DATADEMISSAO'] }}</dd>
                                <dt>Motivo Demissão:</dt>
                                <dd class="m-b-5 text-info data-MOTIVODEMISSAO">{{ info_user['MOTIVODEMISSAO'] }}</dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{ end_form() }}
    </div>
</div>