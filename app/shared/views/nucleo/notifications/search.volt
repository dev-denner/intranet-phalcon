<div class="row">
    <nav>
        <ul class="pager">
            <li class="previous">{{ link_to("notifications/index", "Go Back") }}</li>
            <li class="next">{{ link_to("notifications/new", "Create ") }}</li>
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
            <th>Section</th>
            <th>Subsection</th>
            <th>Recipient</th>
            <th>Message</th>
            <th>Redirect</th>
            <th>Seen</th>
            <th>CreateIn</th>
            <th>UpdateIn</th>

                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
        {% if page.items is defined %}
        {% for notification in page.items %}
            <tr>
                <td>{{ notification.getId() }}</td>
            <td>{{ notification.getUserid() }}</td>
            <td>{{ notification.getSection() }}</td>
            <td>{{ notification.getSubsection() }}</td>
            <td>{{ notification.getRecipient() }}</td>
            <td>{{ notification.getMessage() }}</td>
            <td>{{ notification.getRedirect() }}</td>
            <td>{{ notification.getSeen() }}</td>
            <td>{{ notification.getCreatein() }}</td>
            <td>{{ notification.getUpdatein() }}</td>

                <td>{{ link_to("notifications/edit/"~notification.getId(), "Edit") }}</td>
                <td>{{ link_to("notifications/delete/"~notification.getId(), "Delete") }}</td>
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
                <li>{{ link_to("notifications/search", "First") }}</li>
                <li>{{ link_to("notifications/search?page="~page.before, "Previous") }}</li>
                <li>{{ link_to("notifications/search?page="~page.next, "Next") }}</li>
                <li>{{ link_to("notifications/search?page="~page.last, "Last") }}</li>
            </ul>
        </nav>
    </div>
</div>
