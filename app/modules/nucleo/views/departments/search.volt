<div class="row">
    <nav>
        <ul class="pager">
            <li class="previous">{{ link_to("departments/index", "Go Back") }}</li>
            <li class="next">{{ link_to("departments/new", "Create ") }}</li>
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
            <th>Status</th>
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
        {% for department in page.items %}
            <tr>
                <td>{{ department.getId() }}</td>
            <td>{{ department.getName() }}</td>
            <td>{{ department.getStatus() }}</td>
            <td>{{ department.getSdel() }}</td>
            <td>{{ department.getCreateby() }}</td>
            <td>{{ department.getCreatein() }}</td>
            <td>{{ department.getUpdateby() }}</td>
            <td>{{ department.getUpdatein() }}</td>

                <td>{{ link_to("departments/edit/"~department.getId(), "Edit") }}</td>
                <td>{{ link_to("departments/delete/"~department.getId(), "Delete") }}</td>
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
                <li>{{ link_to("departments/search", "First") }}</li>
                <li>{{ link_to("departments/search?page="~page.before, "Previous") }}</li>
                <li>{{ link_to("departments/search?page="~page.next, "Next") }}</li>
                <li>{{ link_to("departments/search?page="~page.last, "Last") }}</li>
            </ul>
        </nav>
    </div>
</div>
