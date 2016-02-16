<div class="row">
    <nav>
        <ul class="pager">
            <li class="previous">{{ link_to("modules/index", "Go Back") }}</li>
            <li class="next">{{ link_to("modules/new", "Create ") }}</li>
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
            <th>Name</th>
            <th>Department</th>
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
        {% for module in page.items %}
            <tr>
                <td>{{ module.getId() }}</td>
            <td>{{ module.getName() }}</td>
            <td>{{ module.getDepartment() }}</td>
            <td>{{ module.getStatus() }}</td>
            <td>{{ module.getIspublic() }}</td>
            <td>{{ module.getSdel() }}</td>
            <td>{{ module.getCreateby() }}</td>
            <td>{{ module.getCreatein() }}</td>
            <td>{{ module.getUpdateby() }}</td>
            <td>{{ module.getUpdatein() }}</td>

                <td>{{ link_to("modules/edit/"~module.getId(), "Edit") }}</td>
                <td>{{ link_to("modules/delete/"~module.getId(), "Delete") }}</td>
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
                <li>{{ link_to("modules/search", "First") }}</li>
                <li>{{ link_to("modules/search?page="~page.before, "Previous") }}</li>
                <li>{{ link_to("modules/search?page="~page.next, "Next") }}</li>
                <li>{{ link_to("modules/search?page="~page.last, "Last") }}</li>
            </ul>
        </nav>
    </div>
</div>
