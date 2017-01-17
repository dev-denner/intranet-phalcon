{{ content() }}

<div id="errors" class="text-danger"></div>

<div class="card">
    <div class="card-header">
        <h2>Indicadores do SGI <small>Escolha o centro de custo e a competência para gerar o formulário.</small></h2>
    </div>
    <div class="card-body card-padding">
        <div class="row">
            {{ form('forms/indicadores_sgi/new', 'role': 'form', 'method': 'post', 'autocomplete': 'off', 'onsubmit': 'overlay(true)') }}
            <div class="col-sm-5">
                <div class="form-group fg-float">
                    <div class="fg-line">
                        <div class="select">
                            <?php
                            $userId = $auth_identity->userId;
                            $search = "nomeFormulario = 'Indicadores SGI' AND userId = '{$userId}'";
                            echo $this->tag->select(['centro_custo',
                                \App\Modules\Forms\Models\GestaoAcesso::find($search),
                                'using' => ['amarracao', 'amarracao'],
                                'useEmpty' => true,
                                'emptyText' => '',
                                'emptyValue' => '',
                                'class' => 'form-control',
                                'required' => 'required']
                            );
                            ?>
                        </div>
                        <label class="fg-label">Centro de Custo</label>
                    </div>
                </div>
            </div>
            <div class="col-sm-5">
                <div class="input-group fg-float">
                    <span class="input-group-addon"><i class="zmdi zmdi-calendar"></i></span>
                    <div class="fg-line">
                        <input type="text" class="form-control monthPicker" name="comp" id="comp" value="" required />
                        <label class="fg-label">Competência</label>
                    </div>
                </div>
            </div>
            <div class="col-sm-2">
                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-sm m-t-5 waves-effect">Preencher Fomulário</button>
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
            <table class="table table-striped table-vmiddle datatable">
                <thead>
                    <tr>
                        <th data-column-id="id" data-type="numeric">ID</th>
                        <th data-column-id="commands" data-formatter="commands" data-sortable="false">Comandos</th>
                    </tr>
                </thead>
                <tbody>
                    {% for gestao_acesso in gestao_acessos %}
                    <tr>
                        <td>{{ gestao_acesso.id }}</td>
                        <td>{{ static_url('forms/indicadores_sgi') }}</td>
                    </tr>
                    {% endfor %}
                </tbody>
            </table>
        </div>
    </div>
</div>
