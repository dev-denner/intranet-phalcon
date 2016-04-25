{{ content() }}

<div class="card">
    <div class="card-header">
        <h2>Menus <small>Insira os dados para criar um novo menu.</small></h2>
    </div>

    <div class="card-body card-padding">
        {{ form("nucleo/menus/create", "method":"post", "autocomplete" : "off") }}
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
                <div class="form-group">
                    <div class="fg-line">
                        <div class="select">
                            <?php
                            echo $this->tag->select(['module',
                                \Nucleo\Models\Modules::find(),
                                'using' => ['id', 'name'],
                                'useEmpty' => true,
                                'emptyText' => 'Módulo (Escolha uma opção)',
                                'emptyValue' => '',
                                'class' => 'form-control',
                                'required' => 'required']
                            );
                            ?>
                        </div>
                    </div>
                </div>
                <br />
            </div>
            <div class="col-lg-5">
                <div class="form-group">
                    <div class="fg-line">
                        <div class="select">
                            <?php
                            echo $this->tag->select(['controller',
                                \Nucleo\Models\Controllers::find(),
                                'using' => ['id', 'title'],
                                'useEmpty' => true,
                                'emptyText' => 'Controlador (Escolha uma opção)',
                                'emptyValue' => '',
                                'class' => 'form-control',
                                'required' => 'required']
                            );
                            ?>
                        </div>
                    </div>
                </div>
                <br />
            </div>
            <div class="col-lg-5 col-lg-offset-1">
                <div class="form-group">
                    <div class="fg-line">
                        <div class="select">
                            <?php
                            echo $this->tag->select(['action',
                                \Nucleo\Models\Actions::find(),
                                'using' => ['id', 'title'],
                                'useEmpty' => true,
                                'emptyText' => 'Ação (Escolha uma opção)',
                                'emptyValue' => '',
                                'class' => 'form-control',
                                'required' => 'required']
                            );
                            ?>
                        </div>
                    </div>
                </div>
                <br />
            </div>
            <div class="col-lg-5">
                <div class="form-group">
                    <div class="fg-line">
                        <div class="select">
                            <?php
                            echo $this->tag->select(['department',
                                \Nucleo\Models\Departments::find(),
                                'using' => ['id', 'title'],
                                'useEmpty' => true,
                                'emptyText' => 'Departamento',
                                'emptyValue' => '',
                                'class' => 'form-control']
                            );
                            ?>
                        </div>
                    </div>
                </div>
                <br />
            </div>
            <div class="col-lg-5 col-lg-offset-1">
                <div class="form-group">
                    <div class="fg-line">
                        <div class="select">
                            <?php
                            echo $this->tag->select(['category',
                                \Nucleo\Models\Categories::find(),
                                'using' => ['id', 'title'],
                                'useEmpty' => true,
                                'emptyText' => 'Categoria',
                                'emptyValue' => '',
                                'class' => 'form-control']
                            );
                            ?>
                        </div>
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
                        <span class="f-20 icon-view text-center"><i></i></span>
                    </div>
                </div>
                <br />
            </div>
            <div class="col-lg-5 col-lg-offset-1">

                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-sm m-t-10 waves-effect">Inserir</button>
                </div>
            </div>
        </div>
    </div>
</div>
{{ end_form() }}