{{ content() }}
<table class="table table-bordered table-condensed">
    <caption><h2 style="text-align: center">Solictações Externas</h2></caption>
    <tbody>
        {% for key, campo in campos %}

        {% if campo is null %}
        {% continue %}
        {% endif %}

        {% if key == 'CPF' %}
        <tr><th colspan="2"><h4 style="text-align: center">Identificação</h4></th></tr>
        {% endif %}

        {% if key == 'CEP' %}
        <tr><th colspan="2"><h4 style="text-align: center">Localização</h4></th></tr>
        {% endif %}

        {% if key == 'area_ativa' %}

        {% if campo == 'ppp' %}
        <tr><th colspan="2"><h4 style="text-align: center">PPP</h4></th></tr>
        {% endif %}

        {% if campo == 'informe_rendimentos' %}
        <tr><th colspan="2"><h4 style="text-align: center">Informe de Rendimentos</h4></th></tr>
        <tr><th style="border: 1px solid #CCC">Ano</th><th style="border: 1px solid #CCC">Empresa</th></tr>
        {% endif %}

        {% if campo == 'outros' %}
        <tr><th colspan="2"><h4 style="text-align: center">Outros</h4></th></tr>
        {% endif %}

        {% continue %}

        {% endif %}

        {% if key == 'Ano_Base' %}
        {% if campo[0] is empty %}
        {% continue %}
        {% endif %}

        {% for key, ano_base in campo %}
        <?php
        $value = 'value' . $key;
        $$value = $ano_base;
        ?>
        {% endfor %}
        {% continue %}
        {% endif %}

        {% if key == 'empresa_informe' %}
        {% if campo[0] is empty %}
        {% continue %}
        {% endif %}

        {% for key, empresa_informe in campo %}
        <tr>
            <td style="border: 1px solid #CCC">
                <?php
                $value = 'value' . $key;
                echo str_replace('_', ' ', $$value);
                ?>
            </td>
            <td style="border: 1px solid #CCC">{{ empresa_informe }}</td>
        </tr>
        {% endfor %}
        {% continue %}
        {% endif %}

        <tr>
            <th style="border: 1px solid #CCC">{{ str_replace('_', ' ', key) }} : </th>
            <td style="border: 1px solid #CCC">{{ campo|nl2br }}</td>
        </tr>

        {% endfor %}
    </tbody>
</table>
