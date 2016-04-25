<div class="row">
    <nav>
        <ul class="pager">
            <li class="previous">{{ link_to("tokens/index", "Go Back") }}</li>
            <li class="next">{{ link_to("tokens/new", "Create ") }}</li>
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
            <th>UsersId</th>
            <th>Token</th>
            <th>UserAgent</th>
            <th>CreateIn</th>

                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
        {% if page.items is defined %}
        {% for token in page.items %}
            <tr>
                <td>{{ token.getId() }}</td>
            <td>{{ token.getUsersid() }}</td>
            <td>{{ token.getToken() }}</td>
            <td>{{ token.getUseragent() }}</td>
            <td>{{ token.getCreatein() }}</td>

                <td>{{ link_to("tokens/edit/"~token.getId(), "Edit") }}</td>
                <td>{{ link_to("tokens/delete/"~token.getId(), "Delete") }}</td>
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
                <li>{{ link_to("tokens/search", "First") }}</li>
                <li>{{ link_to("tokens/search?page="~page.before, "Previous") }}</li>
                <li>{{ link_to("tokens/search?page="~page.next, "Next") }}</li>
                <li>{{ link_to("tokens/search?page="~page.last, "Last") }}</li>
            </ul>
        </nav>
    </div>
</div>
