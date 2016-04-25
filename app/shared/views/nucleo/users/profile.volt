<div class="block-header">
    <h2>{{ auth_identity.nome }} <small>{{ auth_identity.funcao }}</small></h2>
</div>
<div class="card" id="profile-main">
    <div class="pm-overview c-overflow">
        <div class="pmo-pic">
            <div class="p-relative">
                <img class="img-responsive" src="{{ static_url('assets/img/icons-profile-users/people.png') }}" alt="{{ auth_identity.nome }}">
            </div>
            <div class="pmo-stat bgm-green">
                <h2 class="m-0 c-white">{{ auth_identity.chapa }}</h2>
                Matricula
            </div>
        </div>
    </div>

    <div class="pm-body clearfix">
        <ul class="tab-nav tn-justified">
            <li class="active waves-effect"><a href="javascript:;">Sobre Usuário</a></li>
            <li class="active waves-effect"><a href="javascript:;">&nbsp;</a></li>
            <li class="active waves-effect"><a href="javascript:;">&nbsp;</a></li>
            <li class="active waves-effect"><a href="javascript:;">&nbsp;</a></li>
        </ul>

        <div class="pmb-block">
            <div class="pmbb-header">
                <h2><i class="zmdi zmdi-account m-r-5"></i> Informações</h2>
            </div>
            <div class="pmbb-body p-l-30">
                <div class="pmbb-view">
                    <dl class="dl-horizontal">
                        <dt>Usuário</dt>
                        <dd class="m-b-5">{{ auth_identity.userId }} - {{ auth_identity.userName }}</dd>
                        <dt>Nome</dt>
                        <dd class="m-b-5">{{ auth_identity.nome }}</dd>
                        <dt>Empresa</dt>
                        <dd class="m-b-5">
                            {{ auth_identity.empresa }}
                            {% if auth_identity.coligada is not empty %}
                            - Coligada: {{ auth_identity.coligada }}
                            {% endif %}
                        </dd>
                        <dt>CPF</dt>
                        <dd class="m-b-5">{{ auth_identity.cpf }}</dd>
                        <dt>Função</dt>
                        <dd class="m-b-5">{{ auth_identity.funcao }}</dd>
                        <dt>Data Admissão</dt>
                        <dd class="m-b-5">{{ auth_identity.dataAdmissao }}</dd>
                        <dt>Situação</dt>
                        <dd class="m-b-5">
                            {% if auth_identity.codSituacao is not empty %}
                            {{ auth_identity.codSituacao }} -
                            {% endif %}
                            {{ auth_identity.situacao }}
                        </dd>
                        <dt>Tipo Contratação</dt>
                        <dd class="m-b-5">{{ auth_identity.codTipoFuncionario }} - {{ auth_identity.tipoFuncionario }}
                        </dd>
                        <dt>Seção</dt>
                        <dd class="m-b-5">{{ auth_identity.secao }} - {{ auth_identity.codSecao }}</dd>
                        <dt>CC / EO</dt>
                        <dd>{{ auth_identity.cceo }}</dd>
                    </dl>
                </div>
            </div>
        </div>


        <div class="pmb-block">
            <div class="pmbb-header">
                <h2><i class="zmdi zmdi-phone m-r-5"></i> Informações de Contato</h2>
            </div>
            <div class="pmbb-body p-l-30">
                <div class="pmbb-view">
                    <dl class="dl-horizontal">
                        {% if auth_identity.emailCorporativo is not empty %}
                        <dt>E-mail Corp.</dt>
                        <dd class="m-b-5">{{ auth_identity.emailCorporativo }}</dd>
                        {% endif %}
                        {% if auth_identity.emailPessoal is not empty %}
                        <dt>E-mail Pessoal</dt>
                        <dd class="m-b-5">{{ auth_identity.emailPessoal }}</dd>
                        {% endif %}
                        <dt>E-mail Usuário</dt>
                        <dd>{{ auth_identity.email }}</dd>
                    </dl>
                </div>
            </div>
        </div>
    </div>
</div>
