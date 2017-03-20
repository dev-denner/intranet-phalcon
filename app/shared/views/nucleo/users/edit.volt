{{ content() }}

<div class="row">
    <div class="col-lg-8 col-lg-offset-2">
        <div class="card">
            <div class="card-header">
                <h2>Usuários <small>Insira os dados para atualizar o usuário.</small></h2>
            </div>

            <div class="card-body card-padding">
                {{ form("nucleo/users/save", "method":"post", "autocomplete" : "off") }}

                {{ hidden_field("id", 'required': 'required') }}
                {{ hidden_field("name", 'required': 'required') }}

                <div class="row">
                    <div class="col-sm-5">
                        <div class="form-group fg-line">
                            <label class="fg-label">CPF do Usuário</label>
                            {{ text_field('cpf', 'class': 'form-control fg-input fc-alt', 'required': 'required', 'maxlength': 14, 'onblur': 'getInfoUser(this);') }}
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-5">
                        <div class="form-group fg-line">
                            <label class="fg-label">E-mail</label>
                            {{ email_field('email', 'class': 'form-control fc-alt', 'required': 'required', 'readonly': 'readonly') }}
                        </div>
                    </div>

                    <div class="col-sm-5 col-sm-offset-2">
                        <div class="form-group fg-line">
                            <label class="fg-label">User Name</label>
                            {{ text_field('userName', 'class': 'form-control fc-alt', 'readonly': 'readonly') }}
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-5">
                        <div class="form-group fg-line">
                            <div class="checkbox">
                                <label>
                                    {% if mustChangePassword is 'S' %}
                                    {{ check_field('mustChangePassword', 'value':'S', 'checked': 'checked') }}
                                    {% else %}
                                    {{ check_field('mustChangePassword', 'value':'S') }}
                                    {% endif %}
                                    <i class="input-helper"></i>
                                    Trocar a senha no próximo login?
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-5 col-sm-offset-2">
                        <div class="form-group fg-line">
                            <label class="fg-label">Status</label>
                            <?php
                            echo $this->tag->select(["status",
                                \App\Modules\Nucleo\Models\TablesSystem::find("table = 'status'"),
                                "using" => ["code", "value"],
                                'useEmpty' => true,
                                'emptyText' => 'Status (Escolha uma opção)',
                                'emptyValue' => '',
                                'class' => 'form-control fc-alt']
                            );
                            ?>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-sm m-t-10 waves-effect">Atualizar</button>
                </div>

                <hr />
                <div class="errors">
                    <p class="text-danger"></p>
                </div>

                <ul class="tab-nav text-center fw-nav" role="tablist" data-tab-color="teal">
                    <li class="active"><a href="#info_user" data-toggle="tab" aria-expanded="true">Informações do Usuário</a></li>
                    <li class=""><a href="#grupo" data-toggle="tab" aria-expanded="false">Grupos</a></li>
                </ul>
                <div class="tab-content">
                    <!-- #saude_segurança -->
                    <div class="tab-pane fade active in" id="info_user">

                        <div class="info-user" style="display: block">
                            <div class="row">
                                <div class="col-lg-6">

                                    <dl>
                                        <dt>Empresa :</dt>
                                        <dd class="m-b-5 text-info data-EMPRESA">{{ info_user['EMPRESA'] }}</dd>
                                        <dt>Nome :</dt>
                                        <dd class="m-b-5 text-info data-NOME">{{ info_user['NOME'] }}</dd>
                                        <dt>Situação :</dt>
                                        <dd class="m-b-5 text-info data-SITUACAO">{{ info_user['SITUACAO'] }}</dd>
                                        <dt>CPF :</dt>
                                        <dd class="m-b-5 text-info data-CPF">{{ info_user['CPF'] }}</dd>
                                        <dt>E-mail :</dt>
                                        <dd class="m-b-5 text-info data-EMAIL">{{ info_user['EMAIL'] }}</dd>
                                        <dt>Data Admissão :</dt>
                                        <dd class="m-b-5 text-info data-DATAADMISSAO">{{ info_user['DATAADMISSAO'] }}</dd>
                                    </dl>
                                </div>
                                <div class="col-lg-6">
                                    <dl>
                                        <dt>Pessoa :</dt>
                                        <dd class="m-b-5 text-info data-PESSOA">{{ info_user['PESSOA'] }}</dd>
                                        <dt>Seção :</dt>
                                        <dd class="m-b-5 text-info data-CODSECAO">{{ info_user['CODSECAO'] }}</dd>
                                        <dt>CC / EO :</dt>
                                        <dd class="m-b-5 text-info data-CCEO">{{ info_user['CCEO'] }}</dd>
                                        <dt>CNPJ :</dt>
                                        <dd class="m-b-5 text-info data-CNPJ">{{ info_user['CNPJ'] }}</dd>
                                        <dt>Ramal :</dt>
                                        <dd class="m-b-5 text-info data-RAMAL">{{ info_user['RAMAL'] }}</dd>
                                        <dt>Data Demissão :</dt>
                                        <dd class="m-b-5 text-info data-DATADEMISSAO">{{ info_user['DATADEMISSAO'] }}</dd>
                                        <dt>Motivo Demissão :</dt>
                                        <dd class="m-b-5 text-info data-MOTIVODEMISSAO">{{ info_user['MOTIVODEMISSAO'] }}</dd>
                                    </dl>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="grupo">
                        <div class="row">
                            <div class="col-sm-5">
                                <div class="form-group fg-line">
                                    <label class="fg-label">Grupos do Usuário</label>
                                    {% for group in groups %}
                                    <div class="form-group fg-line">
                                        <div class="checkbox">
                                            <label>
                                                {% set check = '' %}
                                                {% for usersgroup in usersgroups %}
                                                    {% if group.id == usersgroup.groupId %}
                                                        {% set check = "checked='checked'" %}
                                                    {% else %}
                                                        {% continue %}
                                                    {% endif %}
                                                {% endfor %}
                                                <input type="checkbox" id="group" name="group[]" value="{{ group.id }}" {{ check }} />
                                                       <i class="input-helper"></i>
                                                {{ group.title }}
                                            </label>
                                        </div>
                                    </div>
                                    {% endfor %}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        {{ end_form() }}
    </div>
</div>