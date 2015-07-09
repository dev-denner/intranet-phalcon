{{ content() }}

<div class="btn-toolbar">
    {{ link_to("apps/index", "Go Back", "class": "btn btn-success") }}
    {{ link_to("apps/new", "Create", "class": "btn btn-success") }}
</div>

<div class="panel panel-default">
    <!-- Table -->
    <table class="table">
        <thead>
            <tr>
                <th>Id</th>
                <th>Controller</th>
                <th>Name</th>
                <th>Module</th>
                <th>Delete</th>
                <th>Usercreate</th>
                <th>Datecreate</th>
                <th>Userupdate</th>
                <th>Dateupdate</th>

            </tr>
        </thead>
        <tbody>
            {% if page.items is defined %}
                {% for app in page.items %}
                    <tr>
                        <td>{{ app.getId() }}</td>
                        <td>{{ app.getController() }}</td>
                        <td>{{ app.getName() }}</td>
                        <td>{{ app.getModule() }}</td>
                        <td>{{ app.getDelete() }}</td>
                        <td>{{ app.getUsercreate() }}</td>
                        <td>{{ app.getDatecreate() }}</td>
                        <td>{{ app.getUserupdate() }}</td>
                        <td>{{ app.getDateupdate() }}</td>

                        <td>{{ link_to("apps/edit/"~app.getId(), "Edit") }}</td>
                        <td>{{ link_to("apps/delete/"~app.getId(), "Delete") }}</td>
                    </tr>
                {% endfor %}
            {% endif %}
        </tbody>
    </table>
</div>
<nav>
    <ul class="pagination">
        <li>{{ link_to("apps/search", "First") }}</li>
        <li>{{ link_to("apps/search?page="~page.before, "Previous") }}</li>
        <li>{{ link_to("apps/search?page="~page.next, "Next") }}</li>
        <li>{{ link_to("apps/search?page="~page.last, "Last") }}</li>
    </ul>
</nav>