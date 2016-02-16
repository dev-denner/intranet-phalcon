<div class="row">
    <nav>
        <ul class="pager">
            <li class="previous">{{ link_to("groups/index", "Go Back") }}</li>
            <li class="next">{{ link_to("groups/new", "Create ") }}</li>
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
        {% for group in page.items %}
            <tr>
                <td>{{ group.getId() }}</td>
            <td>{{ group.getName() }}</td>
            <td>{{ group.getStatus() }}</td>
            <td>{{ group.getSdel() }}</td>
            <td>{{ group.getCreateby() }}</td>
            <td>{{ group.getCreatein() }}</td>
            <td>{{ group.getUpdateby() }}</td>
            <td>{{ group.getUpdatein() }}</td>

                <td>{{ link_to("groups/edit/"~group.getId(), "Edit") }}</td>
                <td>{{ link_to("groups/delete/"~group.getId(), "Delete") }}</td>
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
                <li>{{ link_to("groups/search", "First") }}</li>
                <li>{{ link_to("groups/search?page="~page.before, "Previous") }}</li>
                <li>{{ link_to("groups/search?page="~page.next, "Next") }}</li>
                <li>{{ link_to("groups/search?page="~page.last, "Last") }}</li>
            </ul>
        </nav>
    </div>
</div>
