{{ content() }}

<div class="row">
    <div class="col-lg-6 col-lg-offset-3">
        <div class="card">
            <div class="card-header">
                <h2>Cadastro de Linhas <small>Insira os dados para atualizar o cadastro de linha.</small></h2>
            </div>

            <div class="card-body card-padding">
                {{ form("telephony/cell_phone_line/save", "method":"post", "autocomplete" : "off") }}

                {{ hidden_field("id", 'required': 'required') }}
                <div class="form-group fg-float">
                    <div class="fg-line">
                        {{ text_field("linha", "class" : "form-control fg-input", 'required': 'required') }}
                        <label class="fg-label">Linha</label>
                    </div>
                </div>
                <br />

                <div class="form-group fg-float">
                    <div class="fg-line">
                        <div class="select">
                            <?php
                            echo $this->tag->select(['tipo',
                                [
                                    'Colaborador' => 'Colaborador',
                                    'Terceiro' => 'Terceiro',
                                    'Outro' => 'Outro',
                                ],
                                'class' => 'form-control',
                                'required' => 'required']
                            );
                            ?>
                            <label class="fg-label">Tipo</label>
                        </div>
                    </div>
                </div>
                <br />

                <div class="form-group fg-float">
                    <div class="fg-line">
                        {{ text_field("cpf", "class" : "form-control fg-input") }}
                        <label class="fg-label">CPF atribuído à Linha</label>
                    </div>
                </div>
                <br />
                <div class="errors">
                    <p class="text-danger"></p>
                </div>

                <div class="form-group fg-float">
                    <div class="fg-line">
                        {{ text_field("name", "class" : "form-control fg-input", 'required': 'required', 'readonly': 'readonly') }}
                        <label class="fg-label">Nome atribuído à Linha</label>
                    </div>
                </div>
                <br />

                <div class="form-group fg-float">
                    <div class="fg-line">
                        {{ text_field("cceo", "class" : "form-control fg-input", 'required': 'required', 'readonly': 'readonly') }}
                        <label class="fg-label">CC ou EO atribuído à Linha</label>
                    </div>
                </div>
                <br />

                <div class="checkbox">
                    <label>
                        {{ check_field('descontaFolha', 'value':'S') }}
                        <i class="input-helper"></i>
                        Desconta em Folha?
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