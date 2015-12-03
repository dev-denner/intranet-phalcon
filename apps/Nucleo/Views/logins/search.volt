{{ content() }}

<div class="btn-toolbar">
    {{ link_to("logins/index", "Go Back", "class": "btn btn-success") }}
    {{ link_to("logins/new", "Create", "class": "btn btn-success") }}
</div>

<div class="panel panel-default">
    <!-- Table -->
    <table class="table">
        <thead>
            <tr>
                <th>Id</th>
                <th>User</th>
                <th>Type</th>
                <th>Ipaddress</th>
                <th>Attempted</th>
                <th>UserAgent</th>
                <th>Datacreate</th>
                <th>Dataupdate</th>

            </tr>
        </thead>
        <tbody>
            {% if page.items is defined %}
                {% for login in page.items %}
                    <tr>
                        <td>{{ login.getId() }}</td>
                        <td>{{ login.getUser() }}</td>
                        <td>{{ login.getType() }}</td>
                        <td>{{ login.getIpaddress() }}</td>
                        <td>{{ login.getAttempted() }}</td>
                        <td>{{ login.getUseragent() }}</td>
                        <td>{{ login.getDatacreate() }}</td>
                        <td>{{ login.getDataupdate() }}</td>

                        <td>{{ link_to("logins/edit/"~login.getId(), "Edit") }}</td>
                        <td>{{ link_to("logins/delete/"~login.getId(), "Delete") }}</td>
                    </tr>
                {% endfor %}
            {% endif %}
        </tbody>
    </table>
</div>
<nav>
    <ul class="pagination">
        <li>{{ link_to("logins/search", "First") }}</li>
        <li>{{ link_to("logins/search?page="~page.before, "Previous") }}</li>
        <li>{{ link_to("logins/search?page="~page.next, "Next") }}</li>
        <li>{{ link_to("logins/search?page="~page.last, "Last") }}</li>
    </ul>
</nav>