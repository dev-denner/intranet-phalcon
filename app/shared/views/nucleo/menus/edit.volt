{{ content() }}

<div class="card">
    <div class="card-header">
        <h2>Menus <small>Insira os dados para atualizar o menu.</small></h2>
    </div>

    <div class="card-body card-padding">
        {{ form("nucleo/menus/save", "method":"post", "autocomplete" : "off") }}
        {{ hidden_field("id", 'required': 'required') }}
        <div class="row">
            <div class="col-lg-5 col-lg-offset-1">
                <div class="form-group fg-float">
                    <div class="fg-line">
                        {{ text_field("title", "class" : "form-control fg-input", 'required': 'required') }}
                        <label class="fg-label">Nome do menu</label>
                    </div>
                </div>
                <br />
            </div>
            <div class="col-lg-5">
                <div class="form-group fg-float">
                    <div class="fg-line">
                        {{ text_field("slug", "class" : "form-control fg-input") }}
                        <label class="fg-label">Slug</label>
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
                                \Nucleo\Models\Modules::find(['order' => 'title']),
                                'using' => ['id', 'title'],
                                'useEmpty' => true,
                                'emptyText' => '',
                                'emptyValue' => '',
                                'class' => 'form-control',
                                'required' => 'required']
                            );
                            ?>
                        </div>
                        <label class="fg-label">Módulo (Escolha uma opção)</label>
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
                        <label class="fg-label">Controlador (Escolha uma opção)</label>
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
                            echo $this->tag->select(['department',
                                \Nucleo\Models\Departments::find(['order' => 'title']),
                                'using' => ['id', 'title'],
                                'useEmpty' => true,
                                'emptyText' => '',
                                'emptyValue' => '',
                                'class' => 'form-control']
                            );
                            ?>
                        </div>
                        <label class="fg-label">Departamento</label>
                    </div>
                </div>
                <br />
            </div>
            <div class="col-lg-5 col-lg-offset-1">
                <div class="form-group fg-float">
                    <div class="fg-line">
                        <div class="select">
                            <?php
                            echo $this->tag->select(['category',
                                \Nucleo\Models\Categories::find(['order' => 'title']),
                                'using' => ['id', 'title'],
                                'useEmpty' => true,
                                'emptyText' => '',
                                'emptyValue' => '',
                                'class' => 'form-control']
                            );
                            ?>
                        </div>
                        <label class="fg-label">Categoria</label>
                    </div>
                </div>
                <br />
            </div>
            <div class="col-lg-5">
                <div class="form-group fg-float">
                    <div class="fg-line">
                        <div class="select">
                            <?php
                            echo $this->tag->select(['type',
                                \Nucleo\Models\TablesSystem::find(["table = 'type_menu'", 'order' => 'value']),
                                'using' => ['code', 'value'],
                                'useEmpty' => true,
                                'emptyText' => '',
                                'emptyValue' => '',
                                'class' => 'form-control']
                            );
                            ?>
                        </div>
                        <label class="fg-label">Tipo</label>
                    </div>
                </div>
                <br />
            </div>
            <div class="col-lg-5 col-lg-offset-1">
                <div class="form-group fg-float">
                    <div class="fg-line">
                        {{ numeric_field("position", "class" : "form-control fg-input") }}
                        <label class="fg-label">Posição</label>
                    </div>
                </div>
                <br />
            </div>
            <div class="col-lg-5">
                <div class="row">
                    <div class="col-lg-10">
                        <div class="form-group fg-float">
                            <div class="fg-line">
                                {{ text_field("icon", "class" : "form-control fg-input") }}
                                <label class="fg-label">Ícone do Menu</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <span class="f-20 icon-view text-center"><i class="{{ icon }}"></i></span>
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
    </div>
</div>
{{ end_form() }}