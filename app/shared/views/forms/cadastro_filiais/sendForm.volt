{{ content() }}
<table class="table table-bordered table-condensed">
    <caption><h2 style="text-align: center">Abertura de Filial</h2></caption>
    <tbody>
        {% for key, campo in campos %}

        {% if campo is null %}
        {% continue %}
        {% endif %}

        {% if key == 'Nome_Comercial' %}
        <tr><th colspan="2"><h4 style="text-align: center">Dados Gerais</h4></th></tr>
        {% endif %}

        {% if key == 'CEP_Fiscal_/_Entrega' %}
        <tr><th colspan="2"><h4 style="text-align: center">Endereço Fiscal / Entrega</h4></th></tr>
        {% endif %}

        {% if key == 'Endereço_de_Cobrança_mesmo_de_entrega' %}
        <tr><th colspan="2"><h4 style="text-align: center">Endereço de Cobrança</h4></th></tr>
        {% endif %}

        {% if key == 'Natureza_Jurídica' %}
        <tr><th colspan="2"><h4 style="text-align: center">Complementos</h4></th></tr>
        {% endif %}

        {% if key == 'Número_NIRE' %}
        <tr><th colspan="2"><h4 style="text-align: center">Adicionais</h4></th></tr>
        {% endif %}

        <tr>
            <th style="border: 1px solid #CCC">{{ str_replace('_', ' ', key) }} : </th>
            <td style="border: 1px solid #CCC">{{ campo }}</td>
        </tr>
        {% endfor %}
    </tbody>
</table>
