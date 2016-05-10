{{ content() }}

<div id="errors" class="text-danger"></div>

<div class="card">
    <div class="card-header">
        <h2>Perfis <small>Digite abaixo o perfil desejado e então clique no botão Buscar.</small></h2>
    </div>
    <div class="card-body card-padding">
        <div class="row">
            {{ form('nucleo/perfils', 'role': 'form', 'method': 'post', 'autocomplete': 'off', 'onsubmit': 'overlay(true)') }}
            <div class="col-sm-3">
                <div class="form-group fg-float">
                    <div class="fg-line">
                        <div class="select">
                            <?php
                            echo $this->tag->select(['userId',
                                \Nucleo\Models\Users::find(['order' => 'name']),
                                'using' => ['id', 'name'],
                                'useEmpty' => true,
                                'emptyText' => '',
                                'emptyValue' => '',
                                'class' => 'form-control']
                            );
                            ?>
                        </div>
                        <label class="fg-label">Todos os Usuários</label>
                    </div>
                </div>
                <br />
            </div>
            <div class="col-sm-3">
                <div class="form-group fg-float">
                    <div class="fg-line">
                        <div class="select">
                            <?php
                            echo $this->tag->select(['groupId',
                                \Nucleo\Models\Groups::find(['order' => 'name']),
                                'using' => ['id', 'name'],
                                'useEmpty' => true,
                                'emptyText' => '',
                                'emptyValue' => '',
                                'class' => 'form-control']
                            );
                            ?>
                        </div>
                        <label class="fg-label">Todos os Grupos</label>
                    </div>
                </div>
                <br />
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
                    {{ link_to('nucleo/perfils/new', 'Novo', 'class': 'btn btn-success btn-sm m-t-5 waves-effect') }}
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
            {% if perfils is not empt %}
            <table class="table table-striped table-vmiddle datatable">
                <thead>
                    <tr>
                        <th data-column-id="id" data-type="numeric">ID</th>
                        <th data-column-id="userId">Usuário</th>
                        <th data-column-id="groupId">Grupo</th>
                        <th data-column-id="module">Módulo</th>
                        <th data-column-id="controller">Controlador</th>
                        <th data-column-id="action">Ação</th>
                        <th data-column-id="permission">Tem Permissão?</th>
                        <th data-column-id="commands" data-formatter="commands" data-sortable="false">Comandos</th>
                    </tr>
                </thead>
                <tbody>
                    {% for perfil in perfils %}
                    <tr>
                        <td>{{ perfil.id }}</td>
                        <td>
                            {% if perfil.users is true %}
                            {{ perfil.users.name }}
                            {% endif %}
                        </td>
                        <td>
                            {% if perfil.groups is true %}
                            {{ perfil.groups.name }}
                            {% endif %}
                        </td>
                        <td>{{ perfil.modules.name }}</td>
                        <td>{{ perfil.controllers.title }}</td>
                        <td>{{ perfil.actions.title }}</td>
                        <td>{{ perfil.permission }}</td>
                        <td>{{ static_url('nucleo/perfils') }}</td>
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
