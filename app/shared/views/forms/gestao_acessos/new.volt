{{ content() }}

<div class="row">
    <div class="col-lg-6 col-lg-offset-3">
        <div class="card">
            <div class="card-header">
                <h2>Gestão de Acessos dos Formulários <small>Insira os dados para criar uma nova gestão de acessos dos formulários.</small></h2>
            </div>

            <div class="card-body card-padding">
                {{ form("forms/gestao_acessos/create", "method":"post", "autocomplete" : "off", 'onsubmit': 'overlay(true)') }}

                <div class="form-group fg-float">
                    <div class="fg-line">
                        {{ text_field("nomeFormulario", "class" : "form-control fg-input", 'required': 'required') }}
                        <label class="fg-label">Nome do Formulário</label>
                    </div>
                </div>
                <br />

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
                                'class' => 'form-control',
                                'required' => 'required']
                            );
                            ?>
                        </div>
                        <label class="fg-label">Usuário (Escolha uma opção)</label>
                    </div>
                </div>
                <br />

                <div class="form-group fg-float">
                    <div class="fg-line">
                        {{ text_field("amarracao", "class" : "form-control fg-input", 'required': 'required') }}
                        <label class="fg-label">Amarração</label>
                    </div>
                </div>
                <br />

                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-sm m-t-10 waves-effect">Inserir</button>
                </div>
            </div>

        </div>
        {{ end_form() }}
    </div>
</div>