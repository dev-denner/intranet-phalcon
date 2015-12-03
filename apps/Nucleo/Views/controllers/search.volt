{{ content() }}

<div class="btn-toolbar">
    {{ link_to("controllers/index", "Go Back", "class": "btn btn-success") }}
    {{ link_to("controllers/new", "Create", "class": "btn btn-success") }}
</div>

<div class="panel panel-default">
    <!-- Table -->
    <table class="table">
        <thead>
            <tr>
                <th>Id</th>
                <th>Title</th>
                <th>Slug</th>
                <th>Module</th>
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
                {% for controller in page.items %}
                    <tr>
                        <td>{{ controller.getId() }}</td>
                        <td>{{ controller.getTitle() }}</td>
                        <td>{{ controller.getSlug() }}</td>
                        <td>{{ controller.getModule() }}</td>
                        <td>{{ controller.getStatus() }}</td>
                        <td>{{ controller.getSdel() }}</td>
                        <td>{{ controller.getUsercreate() }}</td>
                        <td>{{ controller.getDatacreate() }}</td>
                        <td>{{ controller.getUserupdate() }}</td>
                        <td>{{ controller.getDataupdate() }}</td>

                        <td>{{ link_to("controllers/edit/"~controller.getId(), "Edit") }}</td>
                        <td>{{ link_to("controllers/delete/"~controller.getId(), "Delete") }}</td>
                    </tr>
                {% endfor %}
            {% endif %}
        </tbody>
    </table>
</div>
<nav>
    <ul class="pagination">
        <li>{{ link_to("controllers/search", "First") }}</li>
        <li>{{ link_to("controllers/search?page="~page.before, "Previous") }}</li>
        <li>{{ link_to("controllers/search?page="~page.next, "Next") }}</li>
        <li>{{ link_to("controllers/search?page="~page.last, "Last") }}</li>
    </ul>
</nav>