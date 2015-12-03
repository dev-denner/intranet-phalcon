{{ content() }}
<h1>Search logins</h1>

<div class="col-md-6 col-sm-6">
    {{ form("logins/search", "method":"post", "autocomplete" : "off", "class": "form-horizontal") }}
        {{ link_to("logins/new", "Create logins") }}
        <fieldset>
            
            <div class="form-group">
                <label for="id" class="control-label col-sm-4">Id</label>
                <div class="input-group">
                    {{ text_field("id", "size" : 30, "type": "numeric", "class": "form-control") }}
                </div>
            </div>

            <div class="form-group">
                <label for="user" class="control-label col-sm-4">User</label>
                <div class="input-group">
                    {{ text_field("user", "size" : 30, "type": "numeric", "class": "form-control") }}
                </div>
            </div>

            <div class="form-group">
                <label for="type" class="control-label col-sm-4">Type</label>
                <div class="input-group">
                    {{ text_field("type", "size" : 30, "class": "form-control") }}
                </div>
            </div>

            <div class="form-group">
                <label for="ipaddress" class="control-label col-sm-4">Ipaddress</label>
                <div class="input-group">
                    {{ text_field("ipaddress", "class": "form-control") }}
                </div>
            </div>

            <div class="form-group">
                <label for="attempted" class="control-label col-sm-4">Attempted</label>
                <div class="input-group">
                    {{ text_field("attempted", "size" : 30, "type": "numeric", "class": "form-control") }}
                </div>
            </div>

            <div class="form-group">
                <label for="userAgent" class="control-label col-sm-4">UserAgent</label>
                <div class="input-group">
                    {{ text_field("userAgent", "size" : 30, "class": "form-control") }}
                </div>
            </div>

            <div class="form-group">
                <label for="datacreate" class="control-label col-sm-4">Datacreate</label>
                <div class="input-group">
                    {{ text_field("datacreate", "size" : 30, "class": "form-control") }}
                </div>
            </div>

            <div class="form-group">
                <label for="dataupdate" class="control-label col-sm-4">Dataupdate</label>
                <div class="input-group">
                    {{ text_field("dataupdate", "size" : 30, "class": "form-control") }}
                </div>
            </div>

            <div class="form-group">
                {{ submit_button("Search", "class": "btn btn-success col-sm-offset-4") }}
            </div>
        </fieldset>
    </form>
</div>
