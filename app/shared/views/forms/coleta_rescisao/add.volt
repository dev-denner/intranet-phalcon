{{ content() }}
<table class="table table-bordered table-condensed">
    <caption><h2 style="text-align: center">Coleta de Informações para Rescisão Contratual</h2></caption>
    <tbody>
        {% for key, campo in campos %}

        {% if campo is null or key == 'sequence' %}
        {% continue %}
        {% endif %}

        {% if key == 'CPF' %}
        <tr><th colspan="2"><h4 style="text-align: center">Dados do Colaborador</h4></th></tr>
        {% endif %}

        {% if key == 'Periculosidade' %}
        <tr><th colspan="2"><h4 style="text-align: center">Adicionais</h4></th></tr>
        {% endif %}

        {% if key == 'Verbas' %}
        <tr><th colspan="2"><h4 style="text-align: center">Verbas</h4></th></tr>

        {% for key, verba in campo %}
        <?php
        $value = 'value' . $key;
        $$value = $verba;
        ?>
        {% endfor %}
        {% continue %}

        {% endif %}

        {% if key == 'Valor_Verbas' %}

        {% for key, verba_valor in campo %}
        <tr>
            <th style="border: 1px solid #CCC">
                <?php
                $value = 'value' . $key;
                echo str_replace('_', ' ', $$value);
                ?> :
            </th>
            <td style="border: 1px solid #CCC">{{ verba_valor }}</td>
        </tr>
        {% endfor %}

        {% continue %}

        {% endif %}

        {% if key == 'Observação' %}
        <tr><th colspan="2"><h4 style="text-align: center">Observação</h4></th></tr>
        {% endif %}

        {% if key == 'Tipo_de_Desligamento' %}
        <tr><th colspan="2"><h4 style="text-align: center">Motivo da Demissão</h4></th></tr>
        {% endif %}

        <tr>
            <th style="border: 1px solid #CCC">{{ str_replace('_', ' ', key) }} : </th>
            <td style="border: 1px solid #CCC">{{ campo|nl2br  }}</td>
        </tr>
        {% endfor %}
    </tbody>
</table>