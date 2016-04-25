{{ content() }}

<div class="row">
    <div class="col-lg-6 col-lg-offset-3">
        <div class="card">
            <div class="card-header">
                <h2>Grupos x Usuários <small>Insira os dados para atualizar o grupo x usuário.</small></h2>
            </div>

            <div class="card-body card-padding">
                {{ form("nucleo/users_groups/save", "method":"post", "autocomplete" : "off") }}

                {{ hidden_field("id", 'required': 'required') }}
                <div class="form-group fg-float">
                    <div class="fg-line">
                        <div class="select">
                            <?php
                            echo $this->tag->select(['userId',
                                \Nucleo\Models\Users::find(),
                                'using' => ['id', 'email'],
                                'useEmpty' => true,
                                'emptyText' => 'Usuário (Escolha um Usuário)',
                                'emptyValue' => '',
                                'class' => 'form-control',
                                'required' => 'required']
                            );
                            ?>
                        </div>
                    </div>
                </div>
                <br />

                <div class="form-group fg-float">
                    <div class="fg-line">
                        <div class="select">
                            <?php
                            echo $this->tag->select(['groupId',
                                \Nucleo\Models\Groups::find(),
                                'using' => ['id', 'name'],
                                'useEmpty' => true,
                                'emptyText' => 'Grupo (Escolha um Grupo)',
                                'emptyValue' => '',
                                'class' => 'form-control',
                                'required' => 'required']
                            );
                            ?>
                        </div>
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