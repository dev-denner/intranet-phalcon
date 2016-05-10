{{ content() }}

<div class="row">
    <div class="col-lg-6 col-lg-offset-3">
        <div class="card">
            <div class="card-header">
                <h2>Usuários <small>Insira os dados para criar um novo usuário.</small></h2>
            </div>

            <div class="card-body card-padding">
                {{ form("nucleo/users/create", "method":"post", "autocomplete" : "off") }}

                {{ hidden_field("name", 'required': 'required') }}
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

                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-sm m-t-10 waves-effect">Inserir</button>
                </div>
                <hr />
                <div class="errors">
                    <p class="text-danger"></p>
                </div>
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
        </div>
        {{ end_form() }}
    </div>
</div>
