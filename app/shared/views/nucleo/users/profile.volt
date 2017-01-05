<div class="block-header">
    <h2>{{ auth_identity.nome }} <small>{{ auth_identity.funcao }}</small></h2>
</div>

<div class="card" id="profile-main">
    <div class="pm-overview c-overflow">
        <div class="pmo-pic">
            <div class="p-relative">
                <img class="img-responsive mCS_img_loaded" src="{{ static_url("assets/img/profile-pics/"~icon_identity~".png") }}" alt="" />
            </div>
            <div class="pmo-stat bgm-green">
                <h2 class="m-0 c-white">{{ auth_identity.chapa }}</h2>
                Matricula
            </div>
        </div>
    </div>

    <div class="pm-body clearfix">
        <ul class="tab-nav tn-justified">
            <li class="active waves-effect"><a href="javascript:;">Informações</a></li>
            <li class="active waves-effect"><a href="javascript:;">&nbsp;</a></li>
            <li class="active waves-effect"><a href="javascript:;">&nbsp;</a></li>
            <li class="active waves-effect"><a href="javascript:;">&nbsp;</a></li>
        </ul>

        <div class="pmb-block">
            <div class="pmbb-header">
                <h2><i class="fa fa-user"></i> Usuário</h2>
            </div>
            <div class="pmbb-body p-l-30">
                <div class="pmbb-view row">
                    <dl class="col-sm-6">
                        <dt>Código do Usuário:</dt>
                        <dd class="m-b-5">{{ auth_identity.userId }}</dd>
                    </dl>
                    <dl class="col-sm-6">
                        <dt>Nome de Usuário:</dt>
                        <dd class="m-b-5">{{ auth_identity.userName }}</dd>
                    </dl>
                </div>
            </div>

            <div class="pmbb-header">
                <h2><i class="fa fa-smile-o"></i> Pessoais</h2>
            </div>
            <div class="pmbb-body p-l-30">
                <div class="pmbb-view row">
                    <dl class="col-sm-6">
                        <dt>Nome:</dt>
                        <dd class="m-b-5">{{ auth_identity.nome }}</dd>
                        <dt>CPF:</dt>
                        <dd class="m-b-5">{{ auth_identity.userCpf }}</dd>
                    </dl>
                    <dl class="col-sm-6">
                        {% if auth_identity.sexo is not empty %}
                        <dt>Sexo:</dt>
                        <dd class="m-b-5">
                            {{ auth_identity.sexo }}
                            {% if auth_identity.sexo == 'M' %}
                            - Masculino
                            {% else %}
                            - Feminino
                            {% endif %}
                        </dd>
                        {% endif %}
                        {% if auth_identity.dataNascimento is not empty %}
                        <dt>Data de Nascimento:</dt>
                        <dd class="m-b-5">{{ auth_identity.dataNascimento }}</dd>
                        {% endif %}

                    </dl>
                </div>
            </div>

            <div class="pmbb-header">
                <h2><i class="fa fa-building"></i> Empresa</h2>
            </div>
            <div class="pmbb-body p-l-30">
                <div class="pmbb-view row">
                    <dl class="col-sm-6">
                        <dt>Empresa</dt>
                        <dd class="m-b-5">
                            {% if auth_identity.coligada is not empty %}
                            {{ auth_identity.coligada }} -
                            {% endif %}
                            {{ auth_identity.empresa }}
                        </dd>
                        {% if auth_identity.chapa is not empty %}
                        <dt>Chapa</dt>
                        <dd class="m-b-5">
                            {{ auth_identity.chapa }}
                        </dd>
                        {% endif %}
                        <dt>Situação</dt>
                        <dd class="m-b-5">
                            {{ auth_identity.situacao }}
                            {% if auth_identity.descSituacao is not empty %}
                            - {{ auth_identity.descSituacao }}
                            {% endif %}
                        </dd>
                        <dt>Seção</dt>
                        <dd class="m-b-5">
                            {{ auth_identity.codSecao }}
                            {% if auth_identity.secao is not empty %}
                            - {{ auth_identity.secao }}
                            {% endif %}
                        </dd>
                        {% if auth_identity.funcao is not empty %}
                        <dt>Função</dt>
                        <dd class="m-b-5">{{ auth_identity.funcao }}</dd>
                        {% endif %}
                    </dl>
                    <dl class="col-sm-6">
                        {% if auth_identity.codTipoFuncionario is not empty %}
                        <dt>Tipo Contratação</dt>
                        <dd class="m-b-5">
                            {{ auth_identity.codTipoFuncionario }} - {{ auth_identity.tipoFuncionario }}
                        </dd>
                        {% endif %}
                        <dt>Data Admissão</dt>
                        <dd class="m-b-5">{{ auth_identity.dataAdmissao }}</dd>
                        <dt>Pessoa:</dt>
                        <dd class="m-b-5">
                            {{ auth_identity.pessoa }}
                            {% if auth_identity.pessoa == 'F' %}
                            - Física
                            {% else %}
                            - Jurídica
                            {% endif %}
                        </dd>
                        {% if auth_identity.cnpj is not empty %}
                        <dt>CNPJ:</dt>
                        <dd class="m-b-5">{{ auth_identity.cnpj }}</dd>
                        {% endif %}
                        {% if auth_identity.dataDemissao is not empty %}
                        <dt>Data de Demissão:</dt>
                        <dd class="m-b-5">{{ auth_identity.dataDemissao }}</dd>
                        {% endif %}
                        {% if auth_identity.motivoDemissao is not empty %}
                        <dt>Cód. Motivo de Demissão:</dt>
                        <dd class="m-b-5">{{ auth_identity.motivoDemissao }}</dd>
                        {% endif %}
                        <dt>CC / EO</dt>
                        <dd>{{ auth_identity.cceo }}</dd>
                    </dl>
                </div>
            </div>
            <div class="pmbb-header">
                <h2><i class="zmdi zmdi-phone m-r-5"></i>Contato</h2>
            </div>
            <div class="pmbb-body p-l-30">
                <div class="pmbb-view row">
                    <dl class="col-sm-6">
                        <dt>E-mail:</dt>
                        <dd class="m-b-5">
                            {{ auth_identity.email }}
                            {% if auth_identity.emailCorporativo is not empty %}
                            {% if auth_identity.emailCorporativo != auth_identity.email %}
                            <br />{{ auth_identity.emailCorporativo }}
                            {% endif %}
                            {% endif %}
                            {% if auth_identity.emailPessoal is not empty %}
                            {% if auth_identity.emailPessoal != auth_identity.email %}
                            <br />{{ auth_identity.emailPessoal }}
                            {% endif %}
                            {% endif %}
                        </dd>
                    </dl>
                    <dl class="col-sm-6">
                        {% if auth_identity.ramal is not empty %}
                        <dt>Ramal:</dt>
                        <dd class="m-b-5">
                            {{ auth_identity.ramal }}
                        </dd>
                        {% endif %}
                    </dl>
                </div>
            </div>
        </div>
    </div>
</div>
