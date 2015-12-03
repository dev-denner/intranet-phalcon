{{ content() }}

<div class="btn-toolbar">
    {{ link_to("users/index", "Go Back", "class": "btn btn-success") }}
    {{ link_to("users/new", "Create", "class": "btn btn-success") }}
</div>

<div class="panel panel-default">
    <!-- Table -->
    <table class="table">
        <thead>
            <tr>
                <th>Id</th>
                <th>Cpf</th>
                <th>Password</th>
                <th>Email</th>
                <th>Name</th>
                <th>Status</th>
                <th>Token</th>
                <th>Sdel</th>
                <th>Usercreate</th>
                <th>Datacreate</th>
                <th>Userupdate</th>
                <th>Dataupdate</th>

            </tr>
        </thead>
        <tbody>
            {% if page.items is defined %}
                {% for user in page.items %}
                    <tr>
                        <td>{{ user.getId() }}</td>
                        <td>{{ user.getCpf() }}</td>
                        <td>{{ user.getPassword() }}</td>
                        <td>{{ user.getEmail() }}</td>
                        <td>{{ user.getName() }}</td>
                        <td>{{ user.getStatus() }}</td>
                        <td>{{ user.getToken() }}</td>
                        <td>{{ user.getSdel() }}</td>
                        <td>{{ user.getUsercreate() }}</td>
                        <td>{{ user.getDatacreate() }}</td>
                        <td>{{ user.getUserupdate() }}</td>
                        <td>{{ user.getDataupdate() }}</td>

                        <td>{{ link_to("users/edit/"~user.getId(), "Edit") }}</td>
                        <td>{{ link_to("users/delete/"~user.getId(), "Delete") }}</td>
                    </tr>
                {% endfor %}
            {% endif %}
        </tbody>
    </table>
</div>
<nav>
    <ul class="pagination">
        <li>{{ link_to("users/search", "First") }}</li>
        <li>{{ link_to("users/search?page="~page.before, "Previous") }}</li>
        <li>{{ link_to("users/search?page="~page.next, "Next") }}</li>
        <li>{{ link_to("users/search?page="~page.last, "Last") }}</li>
    </ul>
</nav>