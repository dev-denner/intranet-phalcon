<div class="row">
    <nav>
        <ul class="pager">
            <li class="previous">{{ link_to("menus/index", "Go Back") }}</li>
            <li class="next">{{ link_to("menus/new", "Create ") }}</li>
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
            <th>Parents</th>
            <th>Action</th>
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
        {% for menu in page.items %}
            <tr>
                <td>{{ menu.getId() }}</td>
            <td>{{ menu.getTitle() }}</td>
            <td>{{ menu.getSlug() }}</td>
            <td>{{ menu.getParents() }}</td>
            <td>{{ menu.getAction() }}</td>
            <td>{{ menu.getSdel() }}</td>
            <td>{{ menu.getCreateby() }}</td>
            <td>{{ menu.getCreatein() }}</td>
            <td>{{ menu.getUpdateby() }}</td>
            <td>{{ menu.getUpdatein() }}</td>

                <td>{{ link_to("menus/edit/"~menu.getId(), "Edit") }}</td>
                <td>{{ link_to("menus/delete/"~menu.getId(), "Delete") }}</td>
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
                <li>{{ link_to("menus/search", "First") }}</li>
                <li>{{ link_to("menus/search?page="~page.before, "Previous") }}</li>
                <li>{{ link_to("menus/search?page="~page.next, "Next") }}</li>
                <li>{{ link_to("menus/search?page="~page.last, "Last") }}</li>
            </ul>
        </nav>
    </div>
</div>
