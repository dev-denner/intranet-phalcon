<div class="row">
    <nav>
        <ul class="pager">
            <li class="previous">{{ link_to("controllers/index", "Go Back") }}</li>
            <li class="next">{{ link_to("controllers/new", "Create ") }}</li>
        </ul>
    </nav>
</div>

<div class="page-header">
    <h1>Search result</h1>
</div>

{{ content() }}

<div class="row">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Id</th>
            <th>Title</th>
            <th>Slug</th>
            <th>Module</th>
            <th>Status</th>
            <th>IsPublic</th>
            <th>Sdel</th>
            <th>CreateBy</th>
            <th>CreateIn</th>
            <th>UpdateBy</th>
            <th>UpdateIn</th>

                <th></th>
                <th></th>
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
            <td>{{ controller.getIspublic() }}</td>
            <td>{{ controller.getSdel() }}</td>
            <td>{{ controller.getCreateby() }}</td>
            <td>{{ controller.getCreatein() }}</td>
            <td>{{ controller.getUpdateby() }}</td>
            <td>{{ controller.getUpdatein() }}</td>

                <td>{{ link_to("controllers/edit/"~controller.getId(), "Edit") }}</td>
                <td>{{ link_to("controllers/delete/"~controller.getId(), "Delete") }}</td>
            </tr>
        {% endfor %}
        {% endif %}
        </tbody>
    </table>
</div>

<div class="row">
    <div class="col-sm-1">
        <p class="pagination" style="line-height: 1.42857;padding: 6px 12px;">
            {{ page.current~"/"~page.total_pages }}
        </p>
    </div>
    <div class="col-sm-11">
        <nav>
            <ul class="pagination">
                <li>{{ link_to("controllers/search", "First") }}</li>
                <li>{{ link_to("controllers/search?page="~page.before, "Previous") }}</li>
                <li>{{ link_to("controllers/search?page="~page.next, "Next") }}</li>
                <li>{{ link_to("controllers/search?page="~page.last, "Last") }}</li>
            </ul>
        </nav>
    </div>
</div>
