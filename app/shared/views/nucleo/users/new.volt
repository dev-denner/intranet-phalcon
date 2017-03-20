{{ content() }}

<div class="row">
    <div class="col-lg-8 col-lg-offset-2">
        <div class="card">
            <div class="card-header">
                <h2>Usuários <small>Insira os dados para criar um novo usuário.</small></h2>
            </div>

            <div class="card-body card-padding">
                {{ form("nucleo/users/create", "method":"post", "autocomplete" : "off") }}

                {{ hidden_field("name", 'required': 'required') }}

                <div class="row">
                    <div class="col-sm-5">
                        <div class="form-group fg-line">
                            <label class="fg-label">CPF do Usuário</label>
                            {{ text_field('cpf', 'class': 'form-control fg-input fc-alt', 'required': 'required', 'maxlength': 14, 'onblur': 'getInfoUser(this);') }}
                        </div>
                    </div>

                    <div class="col-sm-5 col-sm-offset-2">
                        <div class="form-group fg-line">
                            <label class="fg-label">Senha</label>
                            {{ password_field('password', 'class': 'form-control fg-input fc-alt', 'required': 'required') }}
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
                            {{ text_field('userName', 'class': 'form-control fc-alt', 'required': 'required') }}
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-sm m-t-10 waves-effect">Inserir</button>
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

                        <div class="info-user">
                            <div class="row">
                                <div class="col-lg-6">

                                    <dl>
                                        <dt>Empresa :</dt>
                                        <dd class="m-b-5 text-info data-EMPRESA"></dd>
                                        <dt>Nome :</dt>
                                        <dd class="m-b-5 text-info data-NOME"></dd>
                                        <dt>Situação :</dt>
                                        <dd class="m-b-5 text-info data-situacao"></dd>
                                        <dt>CPF :</dt>
                                        <dd class="m-b-5 text-info data-CPF"></dd>
                                        <dt>E-mail :</dt>
                                        <dd class="m-b-5 text-info data-EMAIL"></dd>
                                        <dt>Data Admissão :</dt>
                                        <dd class="m-b-5 text-info data-DATAADMISSAO"></dd>
                                    </dl>
                                </div>
                                <div class="col-lg-6">
                                    <dl>
                                        <dt>Pessoa :</dt>
                                        <dd class="m-b-5 text-info data-PESSOA"></dd>
                                        <dt>Seção :</dt>
                                        <dd class="m-b-5 text-info data-CODSECAO"></dd>
                                        <dt>CC / EO :</dt>
                                        <dd class="m-b-5 text-info data-CCEO"></dd>
                                        <dt>CNPJ :</dt>
                                        <dd class="m-b-5 text-info data-CNPJ"></dd>
                                        <dt>Ramal :</dt>
                                        <dd class="m-b-5 text-info data-ramal"></dd>
                                        <dt>Data Demissão :</dt>
                                        <dd class="m-b-5 text-info data-DATADEMISSAO"></dd>
                                        <dt>Motivo Demissão :</dt>
                                        <dd class="m-b-5 text-info data-MOTIVODEMISSAO"></dd>
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
                                                <input type="checkbox" id="group" name="group[]" value="{{ group.id }}" />
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
