{{ content() }}

<div class="btn-toolbar">
    {{ link_to("groups/index", "Go Back", "class": "btn btn-success") }}
    {{ link_to("groups/new", "Create", "class": "btn btn-success") }}
</div>

<div class="panel panel-default">
    <!-- Table -->
    <table class="table">
        <thead>
            <tr>
                <th>Id</th>
                <th>Nome</th>
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
                {% for group in page.items %}
                    <tr>
                        <td>{{ group.getId() }}</td>
                        <td>{{ group.getNome() }}</td>
                        <td>{{ group.getStatus() }}</td>
                        <td>{{ group.getSdel() }}</td>
                        <td>{{ group.getUsercreate() }}</td>
                        <td>{{ group.getDatacreate() }}</td>
                        <td>{{ group.getUserupdate() }}</td>
                        <td>{{ group.getDataupdate() }}</td>

                        <td>{{ link_to("groups/edit/"~group.getId(), "Edit") }}</td>
                        <td>{{ link_to("groups/delete/"~group.getId(), "Delete") }}</td>
                    </tr>
                {% endfor %}
            {% endif %}
        </tbody>
    </table>
</div>
<nav>
    <ul class="pagination">
        <li>{{ link_to("groups/search", "First") }}</li>
        <li>{{ link_to("groups/search?page="~page.before, "Previous") }}</li>
        <li>{{ link_to("groups/search?page="~page.next, "Next") }}</li>
        <li>{{ link_to("groups/search?page="~page.last, "Last") }}</li>
    </ul>
</nav>