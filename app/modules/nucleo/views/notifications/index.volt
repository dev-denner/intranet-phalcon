<div class="page-header">
    <h1>
        Search notifications
    </h1>
    <p>
        {{ link_to("notifications/new", "Create notifications") }}
    </p>
</div>

{{ content() }}

{{ form("notifications/search", "method":"post", "autocomplete" : "off", "class" : "form-horizontal") }}

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
    <label for="fieldSection" class="col-sm-2 control-label">Section</label>
    <div class="col-sm-10">
        {{ text_field("section", "size" : 30, "class" : "form-control", "id" : "fieldSection") }}
    </div>
</div>

<div class="form-group">
    <label for="fieldSubsection" class="col-sm-2 control-label">Subsection</label>
    <div class="col-sm-10">
        {{ text_field("subsection", "size" : 30, "class" : "form-control", "id" : "fieldSubsection") }}
    </div>
</div>

<div class="form-group">
    <label for="fieldRecipient" class="col-sm-2 control-label">Recipient</label>
    <div class="col-sm-10">
        {{ text_field("recipient", "type" : "numeric", "class" : "form-control", "id" : "fieldRecipient") }}
    </div>
</div>

<div class="form-group">
    <label for="fieldMessage" class="col-sm-2 control-label">Message</label>
    <div class="col-sm-10">
        {{ text_area("message", "cols": "30", "rows": "4", "class" : "form-control", "id" : "fieldMessage") }}
    </div>
</div>

<div class="form-group">
    <label for="fieldRedirect" class="col-sm-2 control-label">Redirect</label>
    <div class="col-sm-10">
        {{ text_field("redirect", "size" : 30, "class" : "form-control", "id" : "fieldRedirect") }}
    </div>
</div>

<div class="form-group">
    <label for="fieldSeen" class="col-sm-2 control-label">Seen</label>
    <div class="col-sm-10">
        {{ text_field("seen", "type" : "numeric", "class" : "form-control", "id" : "fieldSeen") }}
    </div>
</div>

<div class="form-group">
    <label for="fieldCreatein" class="col-sm-2 control-label">CreateIn</label>
    <div class="col-sm-10">
        {{ text_field("createIn", "size" : 30, "class" : "form-control", "id" : "fieldCreatein") }}
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
