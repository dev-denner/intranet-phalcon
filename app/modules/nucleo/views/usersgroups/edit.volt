{{ content() }}
<h1>Edit users_groups</h1>

<div class="col-md-6 col-sm-6">
    {{ form("users_groups/save", "method":"post", "class": "form-horizontal") }}
        {{ link_to("users_groups", "Go Back") }}
        <fieldset>
            {{ hidden_field("id") }}
            
            <div class="form-group">
                <label for="user" class="control-label col-sm-4">User</label>
                <div class="input-group">
                    {{ text_field("user", "size" : 30, "type": "numeric", "class": "form-control") }}
                </div>
            </div>

            <div class="form-group">
                <label for="group" class="control-label col-sm-4">Group</label>
                <div class="input-group">
                    {{ text_field("group", "size" : 30, "type": "numeric", "class": "form-control") }}
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