{{ content() }}
<h1>Create access</h1>

<div class="col-md-6 col-sm-6">
    {{ form("access/create", "method":"post", "class": "form-horizontal") }}
        {{ link_to("access", "Go Back") }}
        <fieldset>
            
            <div class="form-group">
                <label for="perfil" class="control-label col-sm-4">Perfil</label>
                <div class="input-group">
                    {{ text_field("perfil", "size" : 30, "type": "numeric", "class": "form-control") }}
                </div>
            </div>

            <div class="form-group">
                <label for="action" class="control-label col-sm-4">Action</label>
                <div class="input-group">
                    {{ text_field("action", "size" : 30, "type": "numeric", "class": "form-control") }}
                </div>
            </div>

            <div class="form-group">
                <label for="permission" class="control-label col-sm-4">Permission</label>
                <div class="input-group">
                    {{ text_field("permission", "size" : 30, "class": "form-control") }}
                </div>
            </div>

            <div class="form-group">
                <label for="delete" class="control-label col-sm-4">Delete</label>
                <div class="input-group">
                    {{ text_field("delete", "size" : 30, "class": "form-control") }}
                </div>
            </div>

            <div class="form-group">
                <label for="usercreate" class="control-label col-sm-4">Usercreate</label>
                <div class="input-group">
                    {{ text_field("usercreate", "size" : 30, "type": "numeric", "class": "form-control") }}
                </div>
            </div>

            <div class="form-group">
                <label for="datecreate" class="control-label col-sm-4">Datecreate</label>
                <div class="input-group">
                    {{ text_field("datecreate", "size" : 30, "class": "form-control") }}
                </div>
            </div>

            <div class="form-group">
                <label for="userupdate" class="control-label col-sm-4">Userupdate</label>
                <div class="input-group">
                    {{ text_field("userupdate", "size" : 30, "type": "numeric", "class": "form-control") }}
                </div>
            </div>

            <div class="form-group">
                <label for="dateupdate" class="control-label col-sm-4">Dateupdate</label>
                <div class="input-group">
                    {{ text_field("dateupdate", "size" : 30, "class": "form-control") }}
                </div>
            </div>

            <div class="form-group">
                {{ submit_button("Save", "class": "btn btn-success col-sm-offset-4") }}
            </div>
        </fieldset>
    </form>
</div>
