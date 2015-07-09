{{ content() }}

<div class="btn-toolbar">
    {{ link_to("perfil/index", "Go Back", "class": "btn btn-success") }}
    {{ link_to("perfil/new", "Create", "class": "btn btn-success") }}
</div>

<div class="panel panel-default">
    <!-- Table -->
    <table class="table">
        <thead>
            <tr>
                <th>Id</th>
                <th>Description</th>
                <th>Status</th>
                <th>Delete</th>
                <th>Usercreate</th>
                <th>Datecreate</th>
                <th>Userupdate</th>
                <th>Dateupdate</th>

            </tr>
        </thead>
        <tbody>
            {% if page.items is defined %}
                {% for perfil in page.items %}
                    <tr>
                        <td>{{ perfil.getId() }}</td>
                        <td>{{ perfil.getDescription() }}</td>
                        <td>{{ perfil.getStatus() }}</td>
                        <td>{{ perfil.getDelete() }}</td>
                        <td>{{ perfil.getUsercreate() }}</td>
                        <td>{{ perfil.getDatecreate() }}</td>
                        <td>{{ perfil.getUserupdate() }}</td>
                        <td>{{ perfil.getDateupdate() }}</td>

                        <td>{{ link_to("perfil/edit/"~perfil.getId(), "Edit") }}</td>
                        <td>{{ link_to("perfil/delete/"~perfil.getId(), "Delete") }}</td>
                    </tr>
                {% endfor %}
            {% endif %}
        </tbody>
    </table>
</div>
<nav>
    <ul class="pagination">
        <li>{{ link_to("perfil/search", "First") }}</li>
        <li>{{ link_to("perfil/search?page="~page.before, "Previous") }}</li>
        <li>{{ link_to("perfil/search?page="~page.next, "Next") }}</li>
        <li>{{ link_to("perfil/search?page="~page.last, "Last") }}</li>
    </ul>
</nav>