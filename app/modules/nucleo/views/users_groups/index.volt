<div class="page-header">
    <h1>
        Search users_groups
    </h1>
    <p>
        {{ link_to("users_groups/new", "Create users_groups") }}
    </p>
</div>

{{ content() }}

{{ form("users_groups/search", "method":"post", "autocomplete" : "off", "class" : "form-horizontal") }}

<div class="form-group">
    <label for="fieldId" class="col-sm-2 control-label">Id</label>
    <div class="col-sm-10">
        {{ text_field("id", "type" : "numeric", "class" : "form-control", "id" : "fieldId") }}
    </div>
</div>

<div class="form-group">
    <label for="fieldUserid" class="col-sm-2 control-label">UserId</label>
    <div class="col-sm-10">
        {{ text_field("userId", "type" : "numeric", "class" : "form-control", "id" : "fieldUserid") }}
    </div>
</div>

<div class="form-group">
    <label for="fieldGroupid" class="col-sm-2 control-label">GroupId</label>
    <div class="col-sm-10">
        {{ text_field("groupId", "type" : "numeric", "class" : "form-control", "id" : "fieldGroupid") }}
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
        {{ submit_button('Search', 'class': 'btn btn-default') }}
    </div>
</div>

</form>
