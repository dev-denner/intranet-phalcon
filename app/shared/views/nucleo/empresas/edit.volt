{{ content() }}


<div class="card">
    <div class="card-header">
        <h2>Empresas <small>Insira os dados para atualizar a empresas.</small></h2>
    </div>

    <div class="card-body card-padding">
        {{ form("nucleo/empresas/save", "method":"post", "autocomplete" : "off") }}

        {{ hidden_field("id", 'required': 'required') }}
        <div class="row">
            <div class="col-lg-5 col-lg-offset-1">
                <div class="form-group fg-float">
                    <div class="fg-line">
                        {{ text_field("codigo", "class" : "form-control fg-input", 'required': 'required') }}
                        <label class="fg-label">Coligada da Empresa</label>
                    </div>
                </div>
                <br />
            </div>
            <div class="col-lg-5">
                <div class="form-group fg-float">
                    <div class="fg-line">
                        {{ text_field("cnpj", "class" : "form-control fg-input", 'required': 'required') }}
                        <label class="fg-label">CNPJ</label>
                    </div>
                </div>
                <br />
            </div>
            <div class="col-lg-5 col-lg-offset-1">
                <div class="form-group fg-float">
                    <div class="fg-line">
                        {{ text_field("razaoSocial", "class" : "form-control fg-input", 'required': 'required') }}
                        <label class="fg-label">Razão Social</label>
                    </div>
                </div>
                <br />
            </div>
            <div class="col-lg-5">
                <div class="form-group fg-float">
                    <div class="fg-line">
                        {{ text_field("nomeFantasia", "class" : "form-control fg-input", 'required': 'required') }}
                        <label class="fg-label">Nome Fantasia</label>
                    </div>
                </div>
                <br />
            </div>
            <div class="col-lg-5 col-lg-offset-1">
                <div class="form-group fg-float">
                    <div class="fg-line">
                        {{ text_field("codProtheus", "class" : "form-control fg-input", 'required': 'required') }}
                        <label class="fg-label">Código no Protheus</label>
                    </div>
                </div>
                <br />
            </div>
            <div class="col-lg-5">
                <div class="form-group fg-float">
                    <div class="fg-line">
                        {{ text_field("lojaProtheus", "class" : "form-control fg-input", 'required': 'required') }}
                        <label class="fg-label">Código Loja do Protheus</label>
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
</div>