{{ content() }}
<table class="table table-bordered table-condensed">
    <caption><h2 style="text-align: center">Seguro Garantia</h2></caption>
    <tbody>
        {% for key, campo in campos %}

        {% if campo is null %}
        {% continue %}
        {% endif %}

        {% if key == 'Empresa_do_Grupo' %}
        <tr><th colspan="2"><h4 style="text-align: center">Dados da Solicitação</h4></th></tr>
        {% endif %}

        {% if key == 'Número_do_Contrato' %}
        <tr><th colspan="2"><h4 style="text-align: center">Dados do Contrato</h4></th></tr>
        {% endif %}

        {% if key == 'Opção_de_Garantia' %}
        <tr><th colspan="2"><h4 style="text-align: center">Dados da Garantia</h4></th></tr>
        {% endif %}

        {% if key == 'Observações' %}
        <tr><th colspan="2"><h4 style="text-align: center">Observações</h4></th></tr>
        {% endif %}

        <tr>
            <th style="border: 1px solid #CCC">{{ str_replace('_', ' ', key) }} : </th>
            <td style="border: 1px solid #CCC">{{ campo|nl2br }}</td>
        </tr>
        {% endfor %}
    </tbody>
</table>