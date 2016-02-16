<div class="row">
    <nav>
        <ul class="pager">
            <li class="previous">{{ link_to("perfils", "Go Back") }}</li>
        </ul>
    </nav>
</div>

<div class="page-header">
    <h1>
        Edit perfils
    </h1>
</div>

{{ content() }}

{{ form("perfils/save", "method":"post", "autocomplete" : "off", "class" : "form-horizontal") }}

<div class="form-group">
    <label for="fieldId" class="col-sm-2 control-label">Id</label>
    <div class="col-sm-10">
        {{ text_field("id", "type" : "numeric", "class" : "form-control", "id" : "fieldId") }}
    </div>
</div>

<div class="form-group">
    <label for="fieldUser" class="col-sm-2 control-label">User</label>
    <div class="col-sm-10">
        {{ text_field("user", "type" : "numeric", "class" : "form-control", "id" : "fieldUser") }}
    </div>
</div>

<div class="form-group">
    <label for="fieldGroup" class="col-sm-2 control-label">Group</label>
    <div class="col-sm-10">
        {{ text_field("group", "type" : "numeric", "class" : "form-control", "id" : "fieldGroup") }}
    </div>
</div>

<div class="form-group">
    <label for="fieldModule" class="col-sm-2 control-label">Module</label>
    <div class="col-sm-10">
        {{ text_field("module", "type" : "numeric", "class" : "form-control", "id" : "fieldModule") }}
    </div>
</div>

<div class="form-group">
    <label for="fieldController" class="col-sm-2 control-label">Controller</label>
    <div class="col-sm-10">
        {{ text_field("controller", "type" : "numeric", "class" : "form-control", "id" : "fieldController") }}
    </div>
</div>

<div class="form-group">
    <label for="fieldAction" class="col-sm-2 control-label">Action</label>
    <div class="col-sm-10">
        {{ text_field("action", "type" : "numeric", "class" : "form-control", "id" : "fieldAction") }}
    </div>
</div>

<div class="form-group">
    <label for="fieldStatus" class="col-sm-2 control-label">Status</label>
    <div class="col-sm-10">
        {{ text_field("status", "size" : 30, "class" : "form-control", "id" : "fieldStatus") }}
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


{{ hidden_field("id") }}

<div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
        {{ submit_button('Send', 'class': 'btn btn-default') }}
    </div>
</div>

</form>
