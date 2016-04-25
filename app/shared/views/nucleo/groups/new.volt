{{ content() }}

<div class="row">
    <div class="col-lg-6 col-lg-offset-3">
        <div class="card">
            <div class="card-header">
                <h2>Grupos <small>Insira os dados para criar um novo grupo.</small></h2>
            </div>

            <div class="card-body card-padding">
                {{ form("nucleo/groups/create", "method":"post", "autocomplete" : "off") }}

                <div class="form-group fg-float">
                    <div class="fg-line">
                        {{ text_field("name", "class" : "form-control fg-input", 'required': 'required') }}
                        <label class="fg-label">Nome do grupo</label>
                    </div>
                </div>
                <br />
                <div class="form-group">
                    <div class="fg-line">
                        <div class="select">
                            <?php
                            echo $this->tag->select(['status',
                                \Nucleo\Models\TablesSystem::find("table = 'status'"),
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
                <br />
                <div class="form-group">
                    <label class="radio radio-inline m-r-20">
                        Grupo Público?
                    </label>
                    <label class="radio radio-inline m-r-20">
                        {{ radio_field('isPublic', 'value': 'S') }}
                        <i class="input-helper"></i>
                        SIM
                    </label>
                    <label class="radio radio-inline m-r-20">
                        {{ radio_field('isPublic', 'value': 'N', 'checked': 'checked') }}
                        <i class="input-helper"></i>
                        Não
                    </label>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-sm m-t-10 waves-effect">Inserir</button>
                </div>
            </div>


        </div>
        {{ end_form() }}
    </div>
</div>

