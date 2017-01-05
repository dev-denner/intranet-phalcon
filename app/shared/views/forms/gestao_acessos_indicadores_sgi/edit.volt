{{ content() }}

<div class="row">
    <div class="col-lg-6 col-lg-offset-3">
        <div class="card">
            <div class="card-header">
                <h2>Gestão de Acessos dos Formulários <small>Insira os dados para atualizar a gestão de acessos dos formulários.</small></h2>
            </div>

            <div class="card-body card-padding">
                {{ form("forms/gestao_acessos_indicadores_sgi/save", "method":"post", "autocomplete" : "off", 'onsubmit': 'overlay(true)') }}
                {{ hidden_field("id", 'required': 'required') }}
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
                        <div class="select">
                            <?php
                            echo $this->tag->select([
                                'amarracao',
                                $centro_custos,
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
                <br />


                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-sm m-t-10 waves-effect">Atualizar</button>
                </div>
            </div>

        </div>
        {{ end_form() }}
    </div>
</div>