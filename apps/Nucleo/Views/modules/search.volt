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
                <th>Status</th>
                <th>Sdel</th>
                <th>Usercreate</th>
                <th>Datacreate</th>
                <th>Userupdate</th>
                <th>Dataupdate</th>

            </tr>
        </thead>
        <tbody>
            {% if page.items is defined %}
                {% for module in page.items %}
                    <tr>
                        <td>{{ module.getId() }}</td>
                        <td>{{ module.getName() }}</td>
                        <td>{{ module.getStatus() }}</td>
                        <td>{{ module.getSdel() }}</td>
                        <td>{{ module.getUsercreate() }}</td>
                        <td>{{ module.getDatacreate() }}</td>
                        <td>{{ module.getUserupdate() }}</td>
                        <td>{{ module.getDataupdate() }}</td>

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