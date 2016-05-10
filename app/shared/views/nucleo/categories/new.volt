{{ content() }}

<div class="row">
    <div class="col-lg-6 col-lg-offset-3">
        <div class="card">
            <div class="card-header">
                <h2>Categorias <small>Insira os dados para criar uma nova categoria.</small></h2>
            </div>

            <div class="card-body card-padding">
                {{ form("nucleo/categories/create", "method":"post", "autocomplete" : "off") }}

                <div class="form-group fg-float">
                    <div class="fg-line">
                        {{ text_field("title", "class" : "form-control fg-input", 'required': 'required') }}
                        <label class="fg-label">Nome da categoria</label>
                    </div>
                </div>
                <br />

                <div class="form-group fg-float">
                    <div class="fg-line">
                        {{ text_field("description", "class" : "form-control fg-input") }}
                        <label class="fg-label">Descrição</label>
                    </div>
                </div>
                <br />

                <div class="row">
                    <div class="col-lg-10">
                        <div class="form-group fg-float">
                            <div class="fg-line">
                                {{ text_field("icon", "class" : "form-control fg-input") }}
                                <label class="fg-label">Ícone da Categoria</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <span class="f-20 icon-view text-center"><i></i></span>
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