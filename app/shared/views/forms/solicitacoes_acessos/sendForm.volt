{{ content() }}
<table class="table table-bordered table-condensed">
    <caption><h2 style="text-align: center">Acessos a Serviços de TI</h2></caption>
    <tr><th colspan="2"><h3 style="text-align: center">Identificação</h4></th></tr>

    {% set info = str_replace('<dl class="dl-horizontal">', '', campos['info_colaborador']) %}
        {% set info = str_replace('<dt>', '<tr><th style="border: 1px solid #CCC">', info) %}
                {% set info = str_replace('</dd>', '</td></tr>', info) %}
        {% set info = str_replace('</dt><dd>', '</th><td style="border: 1px solid #CCC">', info) %}
            {% set info = str_replace('</dl>', '', info) %}
    {{ info}}
    <tr>
        <th style="border: 1px solid #CCC">CPF :</th>
        <td style="border: 1px solid #CCC">{{campos['cpf']}}</td>
    </tr>
    <tr>
        <th style="border: 1px solid #CCC">Telefone :</th>
        <td style="border: 1px solid #CCC">{{campos['telefone']}}</td>
    </tr>
    <tr>
        <th style="border: 1px solid #CCC">Localização:</th>
        <td style="border: 1px solid #CCC">{{campos['localizacao']}}</td>
    </tr>
    <tr>
        <th style="border: 1px solid #CCC">Justificativa:</th>
        <td style="border: 1px solid #CCC">
            {{ campos['justificativa'] }}
            {% if campos['justificativa_outros'] is defined %}
            | {{campos['justificativa_outros']}}
            {% endif %}
        </td>
    </tr>
    <tr><th colspan="2"><h3 style="text-align: center">Gestor Imediato</h4></th></tr>

    {% set info = str_replace('<dl class="dl-horizontal">', '', campos['info_gestor']) %}
        {% set info = str_replace('<dt>', '<tr><th style="border: 1px solid #CCC">', info) %}
                {% set info = str_replace('</dd>', '</td></tr>', info) %}
        {% set info = str_replace('</dt><dd>', '</th><td style="border: 1px solid #CCC">', info) %}
            {% set info = str_replace('</dl>', '', info) %}
    {{ info}}

    <tr>
        <th style="border: 1px solid #CCC">E-mail:</th>
        <td style="border: 1px solid #CCC">{{campos['email_gestor']}}</td>
    </tr>
    {% if campos['servico_email'] is defined %}
    <tr><th colspan="2"><h3 style="text-align: center">Serviço de E-mail</h4></th></tr>
    <tr>
        <th style="border: 1px solid #CCC">Serviço de E-mail:</th>
        <td style="border: 1px solid #CCC">{{campos['acao_email']}}</td>
    </tr>
    {% endif %}
    {% if campos['servico_sistemas'] is defined %}
    <tr><th colspan="2"><h3 style="text-align: center">Sistemas</h4></th></tr>
    {% if campos['servico_sistemas_protheus'] is defined %}
    <tr><th colspan="2"><h4>Protheus</h4></th></tr>
    <tr>
        <th style="border: 1px solid #CCC">Ação:</th>
        <td style="border: 1px solid #CCC">{{ campos['acao_protheus'] }}</td>
    </tr>
    <tr>
        <th style="border: 1px solid #CCC">Empresas:</th>
        <td style="border: 1px solid #CCC">
            {% set empresas = explode(';', campos['adicionados_hidden']) %}
            {% set empresas = array_unique(empresas) %}
            {% for empresa in empresas %}
            <p>{{ empresa }}</p>
            {% endfor %}
        </td>
    </tr>
    <tr>
        <th style="border: 1px solid #CCC">Módulos:</th>
        <td style="border: 1px solid #CCC">
            {% for modulo in campos['modulos_protheus'] %}
            <p>{{ modulo }}</p>
            {% endfor %}
        </td>
    </tr>
    {% endif %}
    {% if campos['servico_sistemas_rm'] is defined %}
    <tr><th colspan="2"><h4>RM</h4></th></tr>
    <tr>
        <th style="border: 1px solid #CCC">Ação:</th>
        <td style="border: 1px solid #CCC">{{ campos['acao_rm'] }}</td>
    </tr>
    <tr>
        <th style="border: 1px solid #CCC">Módulos:</th>
        <td style="border: 1px solid #CCC">
            {% for modulo in campos['modulos_rm'] %}
            <p>{{ modulo }}</p>
            {% endfor %}
        </td>
    </tr>
    <tr>
        <th style="border: 1px solid #CCC">Empresas:</th>
        <td style="border: 1px solid #CCC">
            {% for coligada in campos['coligadas'] %}
            <p>{{ coligada }}</p>
            {% endfor %}
        </td>
    </tr>
    <tr>
        <th style="border: 1px solid #CCC">Perfis:</th>
        <td style="border: 1px solid #CCC">
            {% for perfil in campos['perfils_rm'] %}
            <p>{{ perfil }}</p>
            {% endfor %}
        </td>
    </tr>
    {% endif %}
    {% if campos['servico_sistemas_ecm'] is defined %}
    <tr><th colspan="2"><h4>ECM</h4></th></tr>
    <tr>
        <th style="border: 1px solid #CCC">Ação:</th>
        <td style="border: 1px solid #CCC">{{ campos['acao_ecm'] }}</td>
    </tr>
    <tr>
        <th style="border: 1px solid #CCC">Módulos:</th>
        <td style="border: 1px solid #CCC">
            {% for modulo in campos['modulos_ecm'] %}
            <p>{{ modulo }}</p>
            {% endfor %}
        </td>
    </tr>
    <tr>
        <th style="border: 1px solid #CCC">Perfis:</th>
        <td style="border: 1px solid #CCC">
            {% for perfil in campos['perfils_ecm'] %}
            <p>{{ perfil }}</p>
            {% endfor %}
        </td>
    </tr>
    {% endif %}
    {% if campos['servico_sistemas_bi'] is defined %}
    <tr><th colspan="2"><h4>BI - MicroStrategy</h4></th></tr>
    <tr>
        <th style="border: 1px solid #CCC">Ação:</th>
        <td style="border: 1px solid #CCC">{{ campos['acao_bi'] }}</td>
    </tr>
    <tr>
        <th style="border: 1px solid #CCC">Perfis:</th>
        <td style="border: 1px solid #CCC">
            {% for grupo in campos['grupos_bi'] %}
            <p>{{ grupo }}</p>
            {% endfor %}
        </td>
    </tr>
    {% endif %}
    {% if campos['servico_sistemas_otrs'] is defined %}
    <tr><th colspan="2"><h4>OTRS</h4></th></tr>
    <tr>
        <th style="border: 1px solid #CCC">Ação:</th>
        <td style="border: 1px solid #CCC">{{ campos['acao_otrs'] }}</td>
    </tr>
    <tr>
        <th style="border: 1px solid #CCC">Papéis:</th>
        <td style="border: 1px solid #CCC">
            {% for papel in campos['papeis_otrs'] %}
            <p>{{ papel }}</p>
            {% endfor %}
        </td>
    </tr>
    {% endif %}
    {% endif %}
    {% if campos['servico_matriz'] is defined %}
    <tr><th colspan="2"><h3 style="text-align: center">Matriz</h4></th></tr>
    {% if campos['servico_matriz_rede'] is defined %}
    <tr><th colspan="2"><h4>Rede</h4></th></tr>
    <tr>
        <th style="border: 1px solid #CCC">Ação:</th>
        <td style="border: 1px solid #CCC">{{ campos['acao_rede_matriz'] }}</td>
    </tr>
    <tr>
        <th style="border: 1px solid #CCC">Pastas compartilhadas a utilizar:</th>
        <td style="border: 1px solid #CCC">
            {% for rede in campos['rede_matriz'] %}
            <p>{{ rede }}</p>
            {% endfor %}
        </td>
    </tr>
    {% endif %}
    {% if campos['servico_matriz_catraca'] is defined %}
    <tr><th colspan="2"><h4>Catraca Biométrica</h4></th></tr>
    <tr>
        <th style="border: 1px solid #CCC">Ação:</th>
        <td style="border: 1px solid #CCC">{{ campos['acao_catraca'] }}</td>
    </tr>
    {% endif %}
    {% endif %}
</table>