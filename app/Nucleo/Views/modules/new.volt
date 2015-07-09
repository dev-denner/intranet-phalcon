{{ content() }}
<h1>Create modules</h1>

<div class="col-md-6 col-sm-6">
    {{ form("modules/create", "method":"post", "class": "form-horizontal") }}
        {{ link_to("modules", "Go Back") }}
        <fieldset>
            
            <div class="form-group">
                <label for="name" class="control-label col-sm-4">Name</label>
                <div class="input-group">
                    {{ text_field("name", "size" : 30, "class": "form-control") }}
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
