{{ content() }}

<div class="row">
    <div class="col-lg-6 col-lg-offset-3">
        <div class="card">
            <div class="card-header">
                <h2>Ações <small>Insira os dados para atualizar a ação.</small></h2>
            </div>

            <div class="card-body card-padding">
                {{ form("nucleo/actions/save", "method":"post", "autocomplete" : "off") }}

                {{ hidden_field("id", 'required': 'required') }}
                <div class="form-group fg-float">
                    <div class="fg-line">
                        {{ text_field("title", "class" : "form-control fg-input", 'required': 'required') }}
                        <label class="fg-label">Nome da ação</label>
                    </div>
                </div>
                <br />

                <div class="form-group fg-float">
                    <div class="fg-line">
                        {{ text_field('slug', 'class' : 'form-control fg-input', 'required': 'required') }}
                        <label class="fg-label">Slug</label>
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