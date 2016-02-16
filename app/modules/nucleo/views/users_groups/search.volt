<div class="row">
    <nav>
        <ul class="pager">
            <li class="previous">{{ link_to("users_groups/index", "Go Back") }}</li>
            <li class="next">{{ link_to("users_groups/new", "Create ") }}</li>
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
            <th>UserId</th>
            <th>GroupId</th>
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
        {% for users_group in page.items %}
            <tr>
                <td>{{ users_group.getId() }}</td>
            <td>{{ users_group.getUserid() }}</td>
            <td>{{ users_group.getGroupid() }}</td>
            <td>{{ users_group.getSdel() }}</td>
            <td>{{ users_group.getCreateby() }}</td>
            <td>{{ users_group.getCreatein() }}</td>
            <td>{{ users_group.getUpdateby() }}</td>
            <td>{{ users_group.getUpdatein() }}</td>

                <td>{{ link_to("users_groups/edit/"~users_group.getId(), "Edit") }}</td>
                <td>{{ link_to("users_groups/delete/"~users_group.getId(), "Delete") }}</td>
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
                <li>{{ link_to("users_groups/search", "First") }}</li>
                <li>{{ link_to("users_groups/search?page="~page.before, "Previous") }}</li>
                <li>{{ link_to("users_groups/search?page="~page.next, "Next") }}</li>
                <li>{{ link_to("users_groups/search?page="~page.last, "Last") }}</li>
            </ul>
        </nav>
    </div>
</div>
