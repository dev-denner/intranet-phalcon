{{ content() }}
<table class="table table-bordered table-condensed">
    <caption><h2 style="text-align: center">Cadastro de Centro de Custo</h2></caption>
    <tbody>
        {% for key, campo in campos %}

        {% if key == 'Número_do_Contrato' %}
        <tr><th colspan="2"><h4 style="text-align: center">Informações do Contrato</h4></th></tr>
        {% endif %}

        {% if key == 'Gestor' %}
        <tr><th colspan="2"><h4 style="text-align: center">Informações para TI</h4></th></tr>
        {% endif %}

        {% if key == 'Ítem_Contábil' %}
        <tr><th colspan="2"><h4 style="text-align: center">Informações para Contabilidade e Fiscal</h4></th></tr>
        {% endif %}

        {% if key == 'Folha_de_Pagamento' %}
        <tr><th colspan="2"><h4 style="text-align: center">Informações para o Departamento Pessoal</h4></th></tr>
        {% endif %}

        <tr>
            <th style="border: 1px solid #CCC">{{ str_replace('_', ' ', key) }} : </th>
            <td style="border: 1px solid #CCC">{{ campo }}</td>
        </tr>
        {% endfor %}
    </tbody>
</table>
