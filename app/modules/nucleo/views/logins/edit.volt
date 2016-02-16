<div class="row">
    <nav>
        <ul class="pager">
            <li class="previous">{{ link_to("logins", "Go Back") }}</li>
        </ul>
    </nav>
</div>

<div class="page-header">
    <h1>
        Edit logins
    </h1>
</div>

{{ content() }}

{{ form("logins/save", "method":"post", "autocomplete" : "off", "class" : "form-horizontal") }}

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
        {{ select_static("ipAddress", "using": [], "class" : "form-control", "id" : "fieldIpaddress") }}
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


{{ hidden_field("id") }}

<div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
        {{ submit_button('Send', 'class': 'btn btn-default') }}
    </div>
</div>

</form>
