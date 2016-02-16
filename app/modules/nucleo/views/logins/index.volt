<div class="page-header">
    <h1>
        Search logins
    </h1>
    <p>
        {{ link_to("logins/new", "Create logins") }}
    </p>
</div>

{{ content() }}

{{ form("logins/search", "method":"post", "autocomplete" : "off", "class" : "form-horizontal") }}

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
    <label for="fieldType" class="col-sm-2 control-label">Type</label>
    <div class="col-sm-10">
        {{ text_field("type", "size" : 30, "class" : "form-control", "id" : "fieldType") }}
    </div>
</div>

<div class="form-group">
    <label for="fieldIpaddress" class="col-sm-2 control-label">IpAddress</label>
    <div class="col-sm-10">
      {{ text_field("ipAddress", "size" : 30, "class" : "form-control", "id" : "fieldIpaddress") }}
    </div>
</div>

<div class="form-group">
    <label for="fieldAttempted" class="col-sm-2 control-label">Attempted</label>
    <div class="col-sm-10">
        {{ text_field("attempted", "type" : "numeric", "class" : "form-control", "id" : "fieldAttempted") }}
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
