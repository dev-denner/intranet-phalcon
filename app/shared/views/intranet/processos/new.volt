{{ content() }}


<div class="card">
    <div class="card-header">
        <h2>Processos <small>Insira os dados para criar um novo processo.</small></h2>
    </div>

    <div class="card-body card-padding">
        {{ form("intranet/processos/create", "method":"post", "autocomplete" : "off") }}
        <div class="row">
            <div class="col-lg-5 col-lg-offset-1">
                <div class="form-group fg-float">
                    <div class="fg-line">
                        {{ text_field("code", "class" : "form-control fg-input", 'required': 'required') }}
                        <label class="fg-label">Código do processo</label>
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
                                'class' => 'form-control',
                                'required' => 'required']
                            );
                            ?>
                        </div>
                        <label class="fg-label">Departamento</label>
                    </div>
                </div>
                <br />
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4 col-lg-offset-1">
                <div class="form-group fg-float">
                    <div class="fg-line">
                        {{ text_field("link", "class" : "form-control fg-input", 'required': 'required') }}
                        <label class="fg-label">Link</label>
                    </div>
                </div>
                <br />
            </div>
            <div class="col-lg-2">
                <div class="form-group fg-float">
                    <div class="fg-line">
                        {{ text_field("version", "class" : "form-control fg-input") }}
                        <label class="fg-label">Versão</label>
                    </div>
                </div>
                <br />
            </div>
            <div class="col-lg-4">
                <div class="form-group fg-float">
                    <div class="fg-line">
                        {{ text_field("dateUpdated", "class" : "form-control fg-input datepicker") }}
                        <label class="fg-label">Data de Atualização</label>
                    </div>
                </div>
                <br />
            </div>
        </div>

        <div class="row">
            <div class="col-lg-10 col-lg-offset-1">
                <div class="form-group">
                    <div class="fg-line">
                        <label class="fg-label">Descrição</label>
                        {{ text_area("description", "class" : "form-control fg-input") }}
                    </div>
                </div>
                <br />
            </div>
        </div>

        <div class="row">
            <div class="col-lg-2  col-lg-offset-10">
                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-sm m-t-10 waves-effect">Inserir</button>
                </div>
            </div>
        </div>
    </div>
</div>
{{ end_form() }}
