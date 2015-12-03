{{ content() }}

<div class="btn-toolbar">
    {{ link_to("profiles/index", "Go Back", "class": "btn btn-success") }}
    {{ link_to("profiles/new", "Create", "class": "btn btn-success") }}
</div>

<div class="panel panel-default">
    <!-- Table -->
    <table class="table">
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
                <th>Usercreate</th>
                <th>Datacreate</th>
                <th>Userupdate</th>
                <th>Dataupdate</th>

            </tr>
        </thead>
        <tbody>
            {% if page.items is defined %}
                {% for profile in page.items %}
                    <tr>
                        <td>{{ profile.getId() }}</td>
                        <td>{{ profile.getUser() }}</td>
                        <td>{{ profile.getGroup() }}</td>
                        <td>{{ profile.getModule() }}</td>
                        <td>{{ profile.getController() }}</td>
                        <td>{{ profile.getAction() }}</td>
                        <td>{{ profile.getStatus() }}</td>
                        <td>{{ profile.getSdel() }}</td>
                        <td>{{ profile.getUsercreate() }}</td>
                        <td>{{ profile.getDatacreate() }}</td>
                        <td>{{ profile.getUserupdate() }}</td>
                        <td>{{ profile.getDataupdate() }}</td>

                        <td>{{ link_to("profiles/edit/"~profile.getId(), "Edit") }}</td>
                        <td>{{ link_to("profiles/delete/"~profile.getId(), "Delete") }}</td>
                    </tr>
                {% endfor %}
            {% endif %}
        </tbody>
    </table>
</div>
<nav>
    <ul class="pagination">
        <li>{{ link_to("profiles/search", "First") }}</li>
        <li>{{ link_to("profiles/search?page="~page.before, "Previous") }}</li>
        <li>{{ link_to("profiles/search?page="~page.next, "Next") }}</li>
        <li>{{ link_to("profiles/search?page="~page.last, "Last") }}</li>
    </ul>
</nav>