{{ content() }}

<div class="row">
    <div class="col-lg-10 col-lg-offset-1">
        <div class="card">
            <div class="card-header">
                <h2>Documentos de Categorias <small>Insira os dados para criar um novo documento de categoria.</small></h2>
            </div>
            <div class="card-body card-padding">
                {{ form("nucleo/categories_documents/save", "method":"post", "autocomplete" : "off") }}
                {{ hidden_field("id", 'required': 'required') }}
                <div class="form-group fg-float">
                    <div class="fg-line">
                        <div class="select">
                            <?php
                            echo $this->tag->select(['department',
                                \Nucleo\Models\Departments::find(),
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

                <div class="form-group fg-float">
                    <div class="fg-line">
                        <div class="select">
                            <?php
                            echo $this->tag->select(['category',
                                \Nucleo\Models\Categories::find(),
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

                <div class="form-group fg-float">
                    <div class="fg-line">
                        {{ text_area("description", "class" : "form-control fg-input textareaEdit") }}
                        <label class="fg-label">Descrição</label>
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