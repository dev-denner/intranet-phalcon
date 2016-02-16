<div class="row">
    <nav>
        <ul class="pager">
            <li class="previous">{{ link_to("perfils/index", "Go Back") }}</li>
            <li class="next">{{ link_to("perfils/new", "Create ") }}</li>
        </ul>
    </nav>
</div>

<div class="page-header">
    <h1>Search result</h1>
</div>

{{ content() }}

<div class="row">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Id</th>
            <th>User</th>
            <th>Group</th>
            <th>Module</th>
            <th>Controller</th>
            <th>Action</th>
            <th>Status</th>
            <th>Sdel</th>
            <th>CreateBy</th>
            <th>CreateIn</th>
            <th>UpdateBy</th>
            <th>UpdateIn</th>

                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
        {% if page.items is defined %}
        {% for perfil in page.items %}
            <tr>
                <td>{{ perfil.getId() }}</td>
            <td>{{ perfil.getUser() }}</td>
            <td>{{ perfil.getGroup() }}</td>
            <td>{{ perfil.getModule() }}</td>
            <td>{{ perfil.getController() }}</td>
            <td>{{ perfil.getAction() }}</td>
            <td>{{ perfil.getStatus() }}</td>
            <td>{{ perfil.getSdel() }}</td>
            <td>{{ perfil.getCreateby() }}</td>
            <td>{{ perfil.getCreatein() }}</td>
            <td>{{ perfil.getUpdateby() }}</td>
            <td>{{ perfil.getUpdatein() }}</td>

                <td>{{ link_to("perfils/edit/"~perfil.getId(), "Edit") }}</td>
                <td>{{ link_to("perfils/delete/"~perfil.getId(), "Delete") }}</td>
            </tr>
        {% endfor %}
        {% endif %}
        </tbody>
    </table>
</div>

<div class="row">
    <div class="col-sm-1">
        <p class="pagination" style="line-height: 1.42857;padding: 6px 12px;">
            {{ page.current~"/"~page.total_pages }}
        </p>
    </div>
    <div class="col-sm-11">
        <nav>
            <ul class="pagination">
                <li>{{ link_to("perfils/search", "First") }}</li>
                <li>{{ link_to("perfils/search?page="~page.before, "Previous") }}</li>
                <li>{{ link_to("perfils/search?page="~page.next, "Next") }}</li>
                <li>{{ link_to("perfils/search?page="~page.last, "Last") }}</li>
            </ul>
        </nav>
    </div>
</div>
