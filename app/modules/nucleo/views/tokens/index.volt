<div class="page-header">
    <h1>
        Search tokens
    </h1>
    <p>
        {{ link_to("tokens/new", "Create tokens") }}
    </p>
</div>

{{ content() }}

{{ form("tokens/search", "method":"post", "autocomplete" : "off", "class" : "form-horizontal") }}

<div class="form-group">
    <label for="fieldId" class="col-sm-2 control-label">Id</label>
    <div class="col-sm-10">
        {{ text_field("id", "type" : "numeric", "class" : "form-control", "id" : "fieldId") }}
    </div>
</div>

<div class="form-group">
    <label for="fieldUsersid" class="col-sm-2 control-label">UsersId</label>
    <div class="col-sm-10">
        {{ text_field("usersId", "type" : "numeric", "class" : "form-control", "id" : "fieldUsersid") }}
    </div>
</div>

<div class="form-group">
    <label for="fieldToken" class="col-sm-2 control-label">Token</label>
    <div class="col-sm-10">
        {{ select_static("token", "using": [], "class" : "form-control", "id" : "fieldToken") }}
    </div>
</div>

<div class="form-group">
    <label for="fieldUseragent" class="col-sm-2 control-label">UserAgent</label>
    <div class="col-sm-10">
        {{ text_field("userAgent", "size" : 30, "class" : "form-control", "id" : "fieldUseragent") }}
    </div>
</div>

<div class="form-group">
    <label for="fieldCreatein" class="col-sm-2 control-label">CreateIn</label>
    <div class="col-sm-10">
        {{ text_field("createIn", "size" : 30, "class" : "form-control", "id" : "fieldCreatein") }}
    </div>
</div>


<div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
        {{ submit_button('Search', 'class': 'btn btn-default') }}
    </div>
</div>

</form>
