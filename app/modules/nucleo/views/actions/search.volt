<div class="row">
    <nav>
        <ul class="pager">
            <li class="previous">{{ link_to("actions/index", "Go Back") }}</li>
            <li class="next">{{ link_to("actions/new", "Create ") }}</li>
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
            <th>Controller</th>
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
        {% for action in page.items %}
            <tr>
                <td>{{ action.getId() }}</td>
            <td>{{ action.getTitle() }}</td>
            <td>{{ action.getSlug() }}</td>
            <td>{{ action.getController() }}</td>
            <td>{{ action.getStatus() }}</td>
            <td>{{ action.getIspublic() }}</td>
            <td>{{ action.getSdel() }}</td>
            <td>{{ action.getCreateby() }}</td>
            <td>{{ action.getCreatein() }}</td>
            <td>{{ action.getUpdateby() }}</td>
            <td>{{ action.getUpdatein() }}</td>

                <td>{{ link_to("actions/edit/"~action.getId(), "Edit") }}</td>
                <td>{{ link_to("actions/delete/"~action.getId(), "Delete") }}</td>
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
                <li>{{ link_to("actions/search", "First") }}</li>
                <li>{{ link_to("actions/search?page="~page.before, "Previous") }}</li>
                <li>{{ link_to("actions/search?page="~page.next, "Next") }}</li>
                <li>{{ link_to("actions/search?page="~page.last, "Last") }}</li>
            </ul>
        </nav>
    </div>
</div>
