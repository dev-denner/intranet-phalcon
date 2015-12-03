{{ content() }}
<h1>Edit funcionarios</h1>

<div class="col-md-6 col-sm-6">
    {{ form("funcionarios/save", "method":"post", "class": "form-horizontal") }}
        {{ link_to("funcionarios", "Go Back") }}
        <fieldset>
            {{ hidden_field("id") }}
            
            <div class="form-group">
                <label for="id" class="control-label col-sm-4">Id</label>
                <div class="input-group">
                    {{ text_field("id", "size" : 30, "type": "numeric", "class": "form-control") }}
                </div>
            </div>

            <div class="form-group">
                <label for="chapa" class="control-label col-sm-4">Chapa</label>
                <div class="input-group">
                    {{ text_field("chapa", "size" : 30, "class": "form-control") }}
                </div>
            </div>

            <div class="form-group">
                <label for="nome" class="control-label col-sm-4">Nome</label>
                <div class="input-group">
                    {{ text_field("nome", "size" : 30, "class": "form-control") }}
                </div>
            </div>

            <div class="form-group">
                <label for="cpf" class="control-label col-sm-4">Cpf</label>
                <div class="input-group">
                    {{ text_field("cpf", "size" : 30, "class": "form-control") }}
                </div>
            </div>

            <div class="form-group">
                <label for="empresa" class="control-label col-sm-4">Empresa</label>
                <div class="input-group">
                    {{ text_field("empresa", "size" : 30, "type": "numeric", "class": "form-control") }}
                </div>
            </div>

            <div class="form-group">
                <label for="situacao" class="control-label col-sm-4">Situacao</label>
                <div class="input-group">
                    {{ text_field("situacao", "size" : 30, "class": "form-control") }}
                </div>
            </div>

            <div class="form-group">
                <label for="tipo" class="control-label col-sm-4">Tipo</label>
                <div class="input-group">
                    {{ text_field("tipo", "size" : 30, "class": "form-control") }}
                </div>
            </div>

            <div class="form-group">
                <label for="dataadmissao" class="control-label col-sm-4">Dataadmissao</label>
                <div class="input-group">
                    {{ text_field("dataadmissao", "size" : 30, "class": "form-control") }}
                </div>
            </div>

            <div class="form-group">
                <label for="cargo" class="control-label col-sm-4">Cargo</label>
                <div class="input-group">
                    {{ text_field("cargo", "size" : 30, "class": "form-control") }}
                </div>
            </div>

            <div class="form-group">
                <label for="email" class="control-label col-sm-4">Email</label>
                <div class="input-group">
                    {{ text_field("email", "size" : 30, "class": "form-control") }}
                </div>
            </div>

            <div class="form-group">
                <label for="centrocusto" class="control-label col-sm-4">Centrocusto</label>
                <div class="input-group">
                    {{ text_field("centrocusto", "size" : 30, "class": "form-control") }}
                </div>
            </div>

            <div class="form-group">
                <label for="banco" class="control-label col-sm-4">Banco</label>
                <div class="input-group">
                    {{ text_field("banco", "size" : 30, "type": "numeric", "class": "form-control") }}
                </div>
            </div>

            <div class="form-group">
                <label for="numagencia" class="control-label col-sm-4">Numagencia</label>
                <div class="input-group">
                    {{ text_field("numagencia", "size" : 30, "type": "numeric", "class": "form-control") }}
                </div>
            </div>

            <div class="form-group">
                <label for="digagencia" class="control-label col-sm-4">Digagencia</label>
                <div class="input-group">
                    {{ text_field("digagencia", "size" : 30, "class": "form-control") }}
                </div>
            </div>

            <div class="form-group">
                <label for="numconta" class="control-label col-sm-4">Numconta</label>
                <div class="input-group">
                    {{ text_field("numconta", "size" : 30, "type": "numeric", "class": "form-control") }}
                </div>
            </div>

            <div class="form-group">
                <label for="digconta" class="control-label col-sm-4">Digconta</label>
                <div class="input-group">
                    {{ text_field("digconta", "size" : 30, "class": "form-control") }}
                </div>
            </div>

            <div class="form-group">
                <label for="periodopagto" class="control-label col-sm-4">Periodopagto</label>
                <div class="input-group">
                    {{ text_field("periodopagto", "size" : 30, "type": "numeric", "class": "form-control") }}
                </div>
            </div>

            <div class="form-group">
                <label for="sdel" class="control-label col-sm-4">Sdel</label>
                <div class="input-group">
                    {{ text_field("sdel", "size" : 30, "class": "form-control") }}
                </div>
            </div>

            <div class="form-group">
                <label for="usercreate" class="control-label col-sm-4">Usercreate</label>
                <div class="input-group">
                    {{ text_field("usercreate", "size" : 30, "class": "form-control") }}
                </div>
            </div>

            <div class="form-group">
                <label for="datacreate" class="control-label col-sm-4">Datacreate</label>
                <div class="input-group">
                    {{ text_field("datacreate", "size" : 30, "class": "form-control") }}
                </div>
            </div>

            <div class="form-group">
                <label for="userupdate" class="control-label col-sm-4">Userupdate</label>
                <div class="input-group">
                    {{ text_field("userupdate", "size" : 30, "class": "form-control") }}
                </div>
            </div>

            <div class="form-group">
                <label for="dataupdate" class="control-label col-sm-4">Dataupdate</label>
                <div class="input-group">
                    {{ text_field("dataupdate", "size" : 30, "class": "form-control") }}
                </div>
            </div>

            <div class="form-group">
                {{ submit_button("Save", "class": "btn btn-success col-sm-offset-4") }}
            </div>
        </fieldset>
    </form>
</div>