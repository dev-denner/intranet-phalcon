{{ content() }}



<div class="card">
    <div class="card-header">
        <h2>Perfis <small>Insira os dados para atualizar o perfil.</small></h2>
    </div>

    <div class="card-body card-padding">
        {{ form("nucleo/perfils/save", "method":"post", "autocomplete" : "off") }}

        {{ hidden_field("id", 'required': 'required') }}
        <div class="row">
            <div class="col-lg-5 col-lg-offset-1">
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
                        <label class="fg-label">Usuário (Escolha um Usuário ou um Grupo)</label>
                    </div>
                </div>
                <br />
            </div>

            <div class="col-lg-5">
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
                        <label class="fg-label">Grupo (Escolha um Usuário ou um Grupo)</label>
                    </div>
                </div>
                <br />
            </div>

            <div class="col-lg-5 col-lg-offset-1">
                <div class="form-group fg-float">
                    <div class="fg-line">
                        <div class="select">
                            <?php
                            echo $this->tag->select(['module',
                                \Nucleo\Models\Modules::find(['order' => 'name']),
                                'using' => ['id', 'name'],
                                'useEmpty' => true,
                                'emptyText' => '',
                                'emptyValue' => '',
                                'class' => 'form-control',
                                'required' => 'required']
                            );
                            ?>
                        </div>
                        <label class="fg-label">Módulos (Escolha uma opção)</label>
                    </div>
                </div>
                <br />
            </div>

            <div class="col-lg-5">
                <div class="form-group fg-float">
                    <div class="fg-line">
                        <div class="select">
                            <?php
                            echo $this->tag->select(['controller',
                                \Nucleo\Models\Controllers::find(['order' => 'title']),
                                'using' => ['id', 'title'],
                                'useEmpty' => true,
                                'emptyText' => '',
                                'emptyValue' => '',
                                'class' => 'form-control',
                                'required' => 'required']
                            );
                            ?>
                        </div>
                        <label class="fg-label">Controller (Escolha uma opção)</label>
                    </div>
                </div>
                <br />
            </div>

            <div class="col-lg-5 col-lg-offset-1">
                <div class="form-group fg-float">
                    <div class="fg-line">
                        <div class="select">
                            <?php
                            echo $this->tag->select(['action',
                                \Nucleo\Models\Actions::find(['order' => 'title']),
                                'using' => ['id', 'title'],
                                'useEmpty' => true,
                                'emptyText' => '',
                                'emptyValue' => '',
                                'class' => 'form-control',
                                'required' => 'required']
                            );
                            ?>
                        </div>
                        <label class="fg-label">Ação (Escolha uma opção)</label>
                    </div>
                </div>
                <br />
            </div>

            <div class="col-lg-5">
                <div class="form-group fg-float">
                    <div class="fg-line">
                        <div class="select">
                            <?php
                            echo $this->tag->selectStatic([
                                'permission', [
                                    'S' => 'Permitido',
                                    'N' => 'Proibido',
                                ], 'class' => 'form-control',
                                'required' => 'required'
                            ]);
                            ?>
                        </div>
                        <label class="fg-label">Permissão de Acesso</label>
                    </div>
                </div>
                <br />
            </div>
            <div class="col-lg-5 col-lg-offset-1">
                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-sm m-t-10 waves-effect">Atualizar</button>
                </div>
            </div>
        </div>
        {{ end_form() }}
    </div>
