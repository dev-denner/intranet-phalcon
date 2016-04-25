{{ content() }}

<div id="errors" class="text-danger"></div>

<div class="card">
    <div class="card-header">
        <h2>Categorias <small>Digite abaixo a categoria desejada e então clique no botão Buscar.</small></h2>
    </div>
    <div class="card-body card-padding">
        <div class="row">
            {{ form('nucleo/categories', 'role': 'form', 'method': 'post', 'autocomplete': 'off', 'onsubmit': 'overlay(true)') }}
            <div class="col-sm-6">
                <div class="input-group fg-float">
                    <span class="input-group-addon"><i class="zmdi zmdi-keyboard"></i></span>
                    <div class="fg-line">
                        <input type="text" class="form-control" name="categories" id="categories" value="{{ pesquisa }}" onclick="this.select()" />
                        <label class="fg-label">Digite sua pesquisa</label>
                    </div>
                </div>
            </div>
            <div class="col-sm-1">
                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-sm m-t-5 waves-effect">Buscar</button>
                    <br class="visible-xs-block" />
                    <br class="visible-xs-block" />
                </div>
            </div>
            <div class="col-sm-1 col-sm-offset-4">
                <div class="form-group">
                    {{ link_to('nucleo/categories/new', 'Novo', 'class': 'btn btn-success btn-sm m-t-5 waves-effect') }}
                    <br class="visible-xs-block" />
                    <br class="visible-xs-block" />
                </div>
            </div>
            {{ end_form() }}
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        Resultado para pesquisa: <span class="text-danger">{{ pesquisa }}</span>
    </div>
    <div class="card-body card-padding">
        <div class="table-responsive">
            {% if categories is not empty %}
            <table class="table table-striped table-vmiddle datatable">
                <thead>
                    <tr>
                        <th data-column-id="id" data-type="numeric">ID</th>
                        <th data-column-id="title">Título</th>
                        <th data-column-id="description">Descrição</th>
                        <th data-column-id="icon">Ícone</th>
                        <th width='20'>Comandos</th>
                    </tr>
                </thead>
                <tbody>
                    {% for category in categories %}
                    <tr>
                        <td>{{ category.id }}</td>
                        <td>{{ category.title }}</td>
                        <td>{{ category.description }}</td>
                        <td class="text-center f-20"><span class='{{ category.icon }}'></span></td>
                        <td style="white-space: nowrap">
                            {{ link_to('nucleo/categories/edit/'~category.id, '<i class="zmdi zmdi-edit"></i>', 'class': 'btn btn-warning btn-sm m-t-5 waves-effect') }}
                            <button type="button" class="btn btn-danger btn-sm m-t-5 waves-effect" onclick="deleteItem('{{ static_url('nucleo/categories/delete')}}', '{{category.id}}')"><i class="zmdi zmdi-close-circle"></i></button>
                        </td>
                    </tr>
                    {% endfor %}
                </tbody>
            </table>
            {% else %}
            <table class="table table-striped table-vmiddle">
                <tr><td>Não há dados a exibir</td></tr>
            </table>
            {% endif %}
        </div>
    </div>
</div>

