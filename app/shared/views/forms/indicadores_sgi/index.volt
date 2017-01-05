{{ content() }}

<div id="errors" class="text-danger"></div>

<div class="card">
    <div class="card-header">
        <h2>Indicadores do SGI <small>Escolha o centro de custo e a competência para gerar o formulário.</small></h2>
    </div>
    <div class="card-body card-padding">
        <div class="row">
            {{ form('forms/indicadores_sgi/', 'role': 'form', 'method': 'post', 'autocomplete': 'off', 'onsubmit': 'overlay(true)') }}
            <div class="col-sm-5">
                <div class="input-group fg-float">
                    <span class="input-group-addon"><i class="zmdi zmdi-calendar"></i></span>
                    <div class="fg-line">
                        <input type="text" class="form-control monthPicker" name="comp" id="comp" value="{{ pesquisa }}" />
                        <label class="fg-label">Competência</label>
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
                    {{ link_to('forms/indicadores_sgi/new', 'Novo', 'class': 'btn btn-success btn-sm m-t-5 waves-effect') }}
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
                        <th data-column-id="mesComp">Competência</th>
                        <th data-column-id="cc">Centro de Custo</th>
                        <th data-column-id="commands" data-formatter="commands" data-sortable="false">Comandos</th>
                    </tr>
                </thead>
                <tbody>
                    {% for indicadores in indicadores_sgi %}
                    <tr>
                        <td>{{ indicadores.id }}</td>
                        <td><?php echo str_pad($indicadores->mesComp, 2, 0, STR_PAD_LEFT); ?>/{{ indicadores.anoComp }}</td>
                        <td>{{ indicadores.cc }}</td>
                        <td>{{ static_url('forms/indicadores_sgi') }}</td>
                    </tr>
                    {% endfor %}
                </tbody>
            </table>
        </div>
    </div>
</div>
