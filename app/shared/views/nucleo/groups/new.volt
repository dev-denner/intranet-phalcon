{{ content() }}

<div class="row">
    <div class="col-lg-10 col-lg-offset-1">
        <div class="card">
            <div class="card-header">
                <h2>Grupos <small>Insira os dados para criar um novo grupo.</small></h2>
            </div>

            <div class="card-body card-padding">
                {{ form("nucleo/groups/create", "method":"post", "autocomplete" : "off") }}

                <div class="row">
                    <div class="col-sm-5">
                        <div class="form-group fg-line">
                            <label class="fg-label">Nome do grupo</label>
                            {{ text_field("title", "class" : "form-control fg-input fc-alt", 'required': 'required') }}
                        </div>
                    </div>

                    <div class="col-sm-5 col-sm-offset-2">
                        <div class="form-group fg-line">
                            <label class="fg-label">Nome do grupo</label>
                            <?php
                            echo $this->tag->select(['status',
                                \App\Modules\Nucleo\Models\TablesSystem::find("table = 'status'"),
                                'using' => ['code', 'value'],
                                'useEmpty' => true,
                                'emptyText' => 'Status (Escolha uma opção)',
                                'emptyValue' => '',
                                'class' => 'form-control']
                            );
                            ?>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-10">
                        <div class="form-group fg-line">
                            <label class="radio radio-inline m-r-20">
                                Tipo Grupo
                            </label>
                            <label class="radio radio-inline m-r-20">
                                {{ radio_field('type', 'value': 'S') }}
                                <i class="input-helper"></i>
                                Público
                            </label>
                            <label class="radio radio-inline m-r-20">
                                {{ radio_field('type', 'value': 'N', 'checked': 'checked') }}
                                <i class="input-helper"></i>
                                Normal
                            </label>
                            <label class="radio radio-inline m-r-20">
                                {{ radio_field('type', 'value': 'U') }}
                                <i class="input-helper"></i>
                                Super Usuário
                            </label>
                        </div>
                    </div>
                </div>
                <hr />
                <div class="row">
                    <div class="col-sm-4">
                        <div class="form-group radio">
                            <label class="m-b-10">
                                Módulos
                            </label>
                            <br />
                            {% for key, module in modules %}
                            <label class="m-b-5">
                                <input type="radio" id="modules{{ key }}" name="modules" value="{{ module.id }}" />
                                <i class="input-helper"></i>
                                {{ module.title }}
                            </label>
                            <br />
                            {% endfor %}
                        </div>

                    </div>
                    <div class="col-sm-4" id="controllers">
                        <label class="m-b-10">
                            Controladores
                        </label>
                        <br />
                    </div>
                    <div class="col-sm-4" id="actions">
                        <label class="m-b-10">
                            Ações
                        </label>
                        <br />
                    </div>
                </div>
            </div>
        </div>
        {{ end_form() }}
    </div>
</div>