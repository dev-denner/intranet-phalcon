<div class="row">
    <nav>
        <ul class="pager">
            <li class="previous">{{ link_to("funcionarios", "Go Back") }}</li>
        </ul>
    </nav>
</div>

<div class="page-header">
    <h1>
        Create funcionarios
    </h1>
</div>

{{ content() }}

{{ form("funcionarios/create", "method":"post", "autocomplete" : "off", "class" : "form-horizontal") }}

<div class="form-group">
    <label for="fieldId" class="col-sm-2 control-label">Id</label>
    <div class="col-sm-10">
        {{ text_field("id", "type" : "numeric", "class" : "form-control", "id" : "fieldId") }}
    </div>
</div>

<div class="form-group">
    <label for="fieldChapa" class="col-sm-2 control-label">Chapa</label>
    <div class="col-sm-10">
        {{ text_field("chapa", "size" : 30, "class" : "form-control", "id" : "fieldChapa") }}
    </div>
</div>

<div class="form-group">
    <label for="fieldNome" class="col-sm-2 control-label">Nome</label>
    <div class="col-sm-10">
        {{ text_field("nome", "size" : 30, "class" : "form-control", "id" : "fieldNome") }}
    </div>
</div>

<div class="form-group">
    <label for="fieldCpf" class="col-sm-2 control-label">Cpf</label>
    <div class="col-sm-10">
        {{ text_field("cpf", "size" : 30, "class" : "form-control", "id" : "fieldCpf") }}
    </div>
</div>

<div class="form-group">
    <label for="fieldEmpresa" class="col-sm-2 control-label">Empresa</label>
    <div class="col-sm-10">
        {{ text_field("empresa", "type" : "numeric", "class" : "form-control", "id" : "fieldEmpresa") }}
    </div>
</div>

<div class="form-group">
    <label for="fieldSituacao" class="col-sm-2 control-label">Situacao</label>
    <div class="col-sm-10">
        {{ text_field("situacao", "size" : 30, "class" : "form-control", "id" : "fieldSituacao") }}
    </div>
</div>

<div class="form-group">
    <label for="fieldTipo" class="col-sm-2 control-label">Tipo</label>
    <div class="col-sm-10">
        {{ text_field("tipo", "size" : 30, "class" : "form-control", "id" : "fieldTipo") }}
    </div>
</div>

<div class="form-group">
    <label for="fieldDataadmissao" class="col-sm-2 control-label">DataAdmissao</label>
    <div class="col-sm-10">
        {{ text_field("dataAdmissao", "size" : 30, "class" : "form-control", "id" : "fieldDataadmissao") }}
    </div>
</div>

<div class="form-group">
    <label for="fieldCargo" class="col-sm-2 control-label">Cargo</label>
    <div class="col-sm-10">
        {{ text_field("cargo", "size" : 30, "class" : "form-control", "id" : "fieldCargo") }}
    </div>
</div>

<div class="form-group">
    <label for="fieldEmail" class="col-sm-2 control-label">Email</label>
    <div class="col-sm-10">
        {{ text_field("email", "size" : 30, "class" : "form-control", "id" : "fieldEmail") }}
    </div>
</div>

<div class="form-group">
    <label for="fieldCentrocusto" class="col-sm-2 control-label">CentroCusto</label>
    <div class="col-sm-10">
        {{ text_field("centroCusto", "size" : 30, "class" : "form-control", "id" : "fieldCentrocusto") }}
    </div>
</div>

<div class="form-group">
    <label for="fieldSdel" class="col-sm-2 control-label">Sdel</label>
    <div class="col-sm-10">
        {{ text_field("sdel", "size" : 30, "class" : "form-control", "id" : "fieldSdel") }}
    </div>
</div>

<div class="form-group">
    <label for="fieldCreateby" class="col-sm-2 control-label">CreateBy</label>
    <div class="col-sm-10">
        {{ text_field("createBy", "size" : 30, "class" : "form-control", "id" : "fieldCreateby") }}
    </div>
</div>

<div class="form-group">
    <label for="fieldCreatein" class="col-sm-2 control-label">CreateIn</label>
    <div class="col-sm-10">
        {{ text_field("createIn", "size" : 30, "class" : "form-control", "id" : "fieldCreatein") }}
    </div>
</div>

<div class="form-group">
    <label for="fieldUpdateby" class="col-sm-2 control-label">UpdateBy</label>
    <div class="col-sm-10">
        {{ text_field("updateBy", "size" : 30, "class" : "form-control", "id" : "fieldUpdateby") }}
    </div>
</div>

<div class="form-group">
    <label for="fieldUpdatein" class="col-sm-2 control-label">UpdateIn</label>
    <div class="col-sm-10">
        {{ text_field("updateIn", "size" : 30, "class" : "form-control", "id" : "fieldUpdatein") }}
    </div>
</div>


<div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
        {{ submit_button('Save', 'class': 'btn btn-default') }}
    </div>
</div>

</form>
