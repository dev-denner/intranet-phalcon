{{ content() }}
<h1>Search perfil</h1>

<div class="col-md-6 col-sm-6">
    {{ form("perfil/search", "method":"post", "autocomplete" : "off", "class": "form-horizontal") }}
        {{ link_to("perfil/new", "Create perfil") }}
        <fieldset>
            
            <div class="form-group">
                <label for="id" class="control-label col-sm-4">Id</label>
                <div class="input-group">
                    {{ text_field("id", "size" : 30, "type": "numeric", "class": "form-control") }}
                </div>
            </div>

            <div class="form-group">
                <label for="description" class="control-label col-sm-4">Description</label>
                <div class="input-group">
                    {{ text_field("description", "size" : 30, "class": "form-control") }}
                </div>
            </div>

            <div class="form-group">
                <label for="status" class="control-label col-sm-4">Status</label>
                <div class="input-group">
                    {{ text_field("status", "size" : 30, "class": "form-control") }}
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
                {{ submit_button("Search", "class": "btn btn-success col-sm-offset-4") }}
            </div>
        </fieldset>
    </form>
</div>
