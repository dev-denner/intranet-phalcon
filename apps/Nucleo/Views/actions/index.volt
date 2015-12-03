{{ content() }}
<h1>Search actions</h1>

<div class="col-md-6 col-sm-6">
    {{ form("actions/search", "method":"post", "autocomplete" : "off", "class": "form-horizontal") }}
        {{ link_to("actions/new", "Create actions") }}
        <fieldset>
            
            <div class="form-group">
                <label for="id" class="control-label col-sm-4">Id</label>
                <div class="input-group">
                    {{ text_field("id", "size" : 30, "type": "numeric", "class": "form-control") }}
                </div>
            </div>

            <div class="form-group">
                <label for="title" class="control-label col-sm-4">Title</label>
                <div class="input-group">
                    {{ text_field("title", "size" : 30, "class": "form-control") }}
                </div>
            </div>

            <div class="form-group">
                <label for="slug" class="control-label col-sm-4">Slug</label>
                <div class="input-group">
                    {{ text_field("slug", "size" : 30, "class": "form-control") }}
                </div>
            </div>

            <div class="form-group">
                <label for="controller" class="control-label col-sm-4">Controller</label>
                <div class="input-group">
                    {{ text_field("controller", "size" : 30, "type": "numeric", "class": "form-control") }}
                </div>
            </div>

            <div class="form-group">
                <label for="status" class="control-label col-sm-4">Status</label>
                <div class="input-group">
                    {{ text_field("status", "size" : 30, "class": "form-control") }}
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
                {{ submit_button("Search", "class": "btn btn-success col-sm-offset-4") }}
            </div>
        </fieldset>
    </form>
</div>
