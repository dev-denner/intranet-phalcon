{{ content() }}

<div class="row">
    <div class="col-lg-6 col-lg-offset-3">
        <div class="card">
            <div class="card-header">
                <h2>Grupos <small>Insira os dados para atualizar o grupo.</small></h2>
            </div>

            <div class="card-body card-padding">
                {{ form("nucleo/groups/save", "method":"post", "autocomplete" : "off") }}

                {{ hidden_field("id", 'required': 'required') }}
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
                            echo $this->tag->select(["status",
                                \Nucleo\Models\TablesSystem::find("table = 'status'"),
                                "using" => ["code", "value"],
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
                        {% if isPublic is 'S' %}
                        {{ radio_field('isPublic', 'value': 'S', 'checked': 'checked') }}
                        {% else %}
                        {{ radio_field('isPublic', 'value': 'S') }}
                        {% endif %}
                        <i class="input-helper"></i>
                        SIM
                    </label>
                    <label class="radio radio-inline m-r-20">
                        {% if isPublic is 'N' %}
                        {{ radio_field('isPublic', 'value': 'N', 'checked': 'checked') }}
                        {% else %}
                        {{ radio_field('isPublic', 'value': 'N') }}
                        {% endif %}
                        <i class="input-helper"></i>
                        Não
                    </label>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-sm m-t-10 waves-effect">Atualizar</button>
                </div>
            </div>


        </div>
        {{ end_form() }}
    </div>
</div>

