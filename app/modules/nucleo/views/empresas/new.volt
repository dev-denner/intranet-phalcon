<div class="row">
    <nav>
        <ul class="pager">
            <li class="previous">{{ link_to("empresas", "Go Back") }}</li>
        </ul>
    </nav>
</div>

<div class="page-header">
    <h1>
        Create empresas
    </h1>
</div>

{{ content() }}

{{ form("empresas/create", "method":"post", "autocomplete" : "off", "class" : "form-horizontal") }}

<div class="form-group">
    <label for="fieldId" class="col-sm-2 control-label">Id</label>
    <div class="col-sm-10">
        {{ text_field("id", "type" : "numeric", "class" : "form-control", "id" : "fieldId") }}
    </div>
</div>

<div class="form-group">
    <label for="fieldCodigo" class="col-sm-2 control-label">Codigo</label>
    <div class="col-sm-10">
        {{ text_field("codigo", "size" : 30, "class" : "form-control", "id" : "fieldCodigo") }}
    </div>
</div>

<div class="form-group">
    <label for="fieldCnpj" class="col-sm-2 control-label">Cnpj</label>
    <div class="col-sm-10">
        {{ text_field("cnpj", "size" : 30, "class" : "form-control", "id" : "fieldCnpj") }}
    </div>
</div>

<div class="form-group">
    <label for="fieldRazaosocial" class="col-sm-2 control-label">RazaoSocial</label>
    <div class="col-sm-10">
        {{ text_field("razaoSocial", "size" : 30, "class" : "form-control", "id" : "fieldRazaosocial") }}
    </div>
</div>

<div class="form-group">
    <label for="fieldNomefantasia" class="col-sm-2 control-label">NomeFantasia</label>
    <div class="col-sm-10">
        {{ text_field("nomeFantasia", "size" : 30, "class" : "form-control", "id" : "fieldNomefantasia") }}
    </div>
</div>

<div class="form-group">
    <label for="fieldCodprotheus" class="col-sm-2 control-label">CodProtheus</label>
    <div class="col-sm-10">
        {{ text_field("codProtheus", "size" : 30, "class" : "form-control", "id" : "fieldCodprotheus") }}
    </div>
</div>

<div class="form-group">
    <label for="fieldLojaprotheus" class="col-sm-2 control-label">LojaProtheus</label>
    <div class="col-sm-10">
        {{ text_field("lojaProtheus", "size" : 30, "class" : "form-control", "id" : "fieldLojaprotheus") }}
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
