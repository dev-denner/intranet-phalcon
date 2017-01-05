<!DOCTYPE html>
<html>
    <head>
        <title>Intranet :: Exportar PDF :: Grupo MPE</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <link href="{{ static_url('assets/css/pdf.css') }}" rel="stylesheet">
    </head>
    <body>

        <div class="card">
            <div class="card-header">
                <h1>{{ title }}</h1>
            </div>
            <div class="card-body">

                {% for dado in dados %}
                {% if loop.first %}
                <table class="table table-striped table-vmiddle datatable bootgrid-table">
                    <thead>
                        <tr>
                            {% for index, value in dado %}
                            <th>{{ str_replace('_', ' ', index)|lower|capitalize }}</th>
                            {% endfor %}
                        </tr>
                    </thead>
                    <tbody>
                        {% endif %}
                        <tr>
                            {% for index, value in dado %}
                            <td>{{ value }}</td>
                            {% endfor %}
                        </tr>
                        {% if loop.last %}
                    </tbody>
                </table>
                {% endif %}
                {% endfor %}
            </div>
        </div>
    </body>
</html>
