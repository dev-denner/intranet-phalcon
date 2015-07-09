{{ content() }}
<h1>Create users</h1>

<div class="col-md-6 col-sm-6">
    {{ form("users/create", "method":"post", "class": "form-horizontal") }}
        {{ link_to("users", "Go Back") }}
        <fieldset>
            
            <div class="form-group">
                <label for="cpf" class="control-label col-sm-4">Cpf</label>
                <div class="input-group">
                    {{ text_field("cpf", "size" : 30, "class": "form-control") }}
                </div>
            </div>

            <div class="form-group">
                <label for="password" class="control-label col-sm-4">Password</label>
                <div class="input-group">
                    {{ text_field("password", "size" : 30, "class": "form-control") }}
                </div>
            </div>

            <div class="form-group">
                <label for="email" class="control-label col-sm-4">Email</label>
                <div class="input-group">
                    {{ text_field("email", "size" : 30, "class": "form-control") }}
                </div>
            </div>

            <div class="form-group">
                <label for="name" class="control-label col-sm-4">Name</label>
                <div class="input-group">
                    {{ text_field("name", "size" : 30, "class": "form-control") }}
                </div>
            </div>

            <div class="form-group">
                <label for="status" class="control-label col-sm-4">Status</label>
                <div class="input-group">
                    {{ text_field("status", "class": "form-control") }}
                </div>
            </div>

            <div class="form-group">
                <label for="token" class="control-label col-sm-4">Token</label>
                <div class="input-group">
                    {{ text_field("token", "size" : 30, "class": "form-control") }}
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
