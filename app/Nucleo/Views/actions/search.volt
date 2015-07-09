{{ content() }}

<div class="btn-toolbar">
    {{ link_to("actions/index", "Go Back", "class": "btn btn-success") }}
    {{ link_to("actions/new", "Create", "class": "btn btn-success") }}
</div>

<div class="panel panel-default">
    <!-- Table -->
    <table class="table">
        <thead>
            <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Slug</th>
                <th>App</th>
                <th>Delete</th>
                <th>Usercreate</th>
                <th>Datecreate</th>
                <th>Userupdate</th>
                <th>Dateupdate</th>

            </tr>
        </thead>
        <tbody>
            {% if page.items is defined %}
                {% for action in page.items %}
                    <tr>
                        <td>{{ action.getId() }}</td>
                        <td>{{ action.getName() }}</td>
                        <td>{{ action.getSlug() }}</td>
                        <td>{{ action.getApp() }}</td>
                        <td>{{ action.getDelete() }}</td>
                        <td>{{ action.getUsercreate() }}</td>
                        <td>{{ action.getDatecreate() }}</td>
                        <td>{{ action.getUserupdate() }}</td>
                        <td>{{ action.getDateupdate() }}</td>

                        <td>{{ link_to("actions/edit/"~action.getId(), "Edit") }}</td>
                        <td>{{ link_to("actions/delete/"~action.getId(), "Delete") }}</td>
                    </tr>
                {% endfor %}
            {% endif %}
        </tbody>
    </table>
</div>
<nav>
    <ul class="pagination">
        <li>{{ link_to("actions/search", "First") }}</li>
        <li>{{ link_to("actions/search?page="~page.before, "Previous") }}</li>
        <li>{{ link_to("actions/search?page="~page.next, "Next") }}</li>
        <li>{{ link_to("actions/search?page="~page.last, "Last") }}</li>
    </ul>
</nav>