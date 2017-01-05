{{ content() }}
<table class="table table-bordered table-condensed">
    <caption><h2 style="text-align: center">Cadastro de Produtos</h2></caption>
    <tbody>
        {% for key, campo in campos %}

        {% if campo is null %}
        {% continue %}
        {% endif %}

        {% if key == 'Nome_do_Material' %}
        <tr><th colspan="2"><h4 style="text-align: center">Dados Gerais</h4></th></tr>
        {% endif %}

        {% if key == 'Métodos_de_Avaliação' %}
        <tr><th colspan="2"><h4 style="text-align: center">Localização</h4></th></tr>
        {% endif %}

        <tr>
            <th style="border: 1px solid #CCC; width: 200px;">{{ str_replace('_', ' ', key) }} : </th>
            <td style="border: 1px solid #CCC">{{ campo }}</td>
        </tr>
        {% endfor %}
    </tbody>
</table>
