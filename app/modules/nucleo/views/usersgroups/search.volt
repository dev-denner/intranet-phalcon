{{ content() }}

<div class="btn-toolbar">
    {{ link_to("users_groups/index", "Go Back", "class": "btn btn-success") }}
    {{ link_to("users_groups/new", "Create", "class": "btn btn-success") }}
</div>

<div class="panel panel-default">
    <!-- Table -->
    <table class="table">
        <thead>
            <tr>
                <th>Id</th>
                <th>User</th>
                <th>Group</th>
                <th>Sdel</th>
                <th>Usercreate</th>
                <th>Datacreate</th>
                <th>Userupdate</th>
                <th>Dataupdate</th>

            </tr>
        </thead>
        <tbody>
            {% if page.items is defined %}
                {% for users_group in page.items %}
                    <tr>
                        <td>{{ users_group.getId() }}</td>
                        <td>{{ users_group.getUser() }}</td>
                        <td>{{ users_group.getGroup() }}</td>
                        <td>{{ users_group.getSdel() }}</td>
                        <td>{{ users_group.getUsercreate() }}</td>
                        <td>{{ users_group.getDatacreate() }}</td>
                        <td>{{ users_group.getUserupdate() }}</td>
                        <td>{{ users_group.getDataupdate() }}</td>

                        <td>{{ link_to("users_groups/edit/"~users_group.getId(), "Edit") }}</td>
                        <td>{{ link_to("users_groups/delete/"~users_group.getId(), "Delete") }}</td>
                    </tr>
                {% endfor %}
            {% endif %}
        </tbody>
    </table>
</div>
<nav>
    <ul class="pagination">
        <li>{{ link_to("users_groups/search", "First") }}</li>
        <li>{{ link_to("users_groups/search?page="~page.before, "Previous") }}</li>
        <li>{{ link_to("users_groups/search?page="~page.next, "Next") }}</li>
        <li>{{ link_to("users_groups/search?page="~page.last, "Last") }}</li>
    </ul>
</nav>