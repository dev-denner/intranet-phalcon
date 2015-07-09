{{ content() }}

<div class="btn-toolbar">
    {{ link_to("modules/index", "Go Back", "class": "btn btn-success") }}
    {{ link_to("modules/new", "Create", "class": "btn btn-success") }}
</div>

<div class="panel panel-default">
    <!-- Table -->
    <table class="table">
        <thead>
            <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Delete</th>
                <th>Usercreate</th>
                <th>Datecreate</th>
                <th>Userupdate</th>
                <th>Dateupdate</th>

            </tr>
        </thead>
        <tbody>
            {% if page.items is defined %}
                {% for module in page.items %}
                    <tr>
                        <td>{{ module.getId() }}</td>
                        <td>{{ module.getName() }}</td>
                        <td>{{ module.getDelete() }}</td>
                        <td>{{ module.getUsercreate() }}</td>
                        <td>{{ module.getDatecreate() }}</td>
                        <td>{{ module.getUserupdate() }}</td>
                        <td>{{ module.getDateupdate() }}</td>

                        <td>{{ link_to("modules/edit/"~module.getId(), "Edit") }}</td>
                        <td>{{ link_to("modules/delete/"~module.getId(), "Delete") }}</td>
                    </tr>
                {% endfor %}
            {% endif %}
        </tbody>
    </table>
</div>
<nav>
    <ul class="pagination">
        <li>{{ link_to("modules/search", "First") }}</li>
        <li>{{ link_to("modules/search?page="~page.before, "Previous") }}</li>
        <li>{{ link_to("modules/search?page="~page.next, "Next") }}</li>
        <li>{{ link_to("modules/search?page="~page.last, "Last") }}</li>
    </ul>
</nav>