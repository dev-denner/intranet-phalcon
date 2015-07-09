{{ content() }}

<div class="btn-toolbar">
    {{ link_to("access/index", "Go Back", "class": "btn btn-success") }}
    {{ link_to("access/new", "Create", "class": "btn btn-success") }}
</div>

<div class="panel panel-default">
    <!-- Table -->
    <table class="table">
        <thead>
            <tr>
                <th>Id</th>
                <th>Perfil</th>
                <th>Action</th>
                <th>Permission</th>
                <th>Delete</th>
                <th>Usercreate</th>
                <th>Datecreate</th>
                <th>Userupdate</th>
                <th>Dateupdate</th>

            </tr>
        </thead>
        <tbody>
            {% if page.items is defined %}
                {% for acces in page.items %}
                    <tr>
                        <td>{{ acces.getId() }}</td>
                        <td>{{ acces.getPerfil() }}</td>
                        <td>{{ acces.getAction() }}</td>
                        <td>{{ acces.getPermission() }}</td>
                        <td>{{ acces.getDelete() }}</td>
                        <td>{{ acces.getUsercreate() }}</td>
                        <td>{{ acces.getDatecreate() }}</td>
                        <td>{{ acces.getUserupdate() }}</td>
                        <td>{{ acces.getDateupdate() }}</td>

                        <td>{{ link_to("access/edit/"~acces.getId(), "Edit") }}</td>
                        <td>{{ link_to("access/delete/"~acces.getId(), "Delete") }}</td>
                    </tr>
                {% endfor %}
            {% endif %}
        </tbody>
    </table>
</div>
<nav>
    <ul class="pagination">
        <li>{{ link_to("access/search", "First") }}</li>
        <li>{{ link_to("access/search?page="~page.before, "Previous") }}</li>
        <li>{{ link_to("access/search?page="~page.next, "Next") }}</li>
        <li>{{ link_to("access/search?page="~page.last, "Last") }}</li>
    </ul>
</nav>