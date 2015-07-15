
{{ content() }}

<table width="100%">
    <tr>
        <td align="left">
            {{ link_to("actions/index", "Go Back") }}
        </td>
        <td align="right">
            {{ link_to("actions/new", "Create ") }}
        </td>
    </tr>
</table>

<table class="browse" align="center">
    <thead>
        <tr>
            <th>ID</th>
            <th>NAME</th>
            <th>SLUG</th>
            <th>APP</th>
            <th>SOFTDEL</th>
            <th>USERCREATE</th>
            <th>DATECREATE</th>
            <th>USERUPDATE</th>
            <th>DATEUPDATE</th>
         </tr>
    </thead>
    <tbody>
    {% if page.items is defined %}
    {% for action in page.items %}
        <tr>
            <td>{{ action.getID() }}</td>
            <td>{{ action.getNamE() }}</td>
            <td>{{ action.getSluG() }}</td>
            <td>{{ action.getApP() }}</td>
            <td>{{ action.getSoftdeL() }}</td>
            <td>{{ action.getUsercreatE() }}</td>
            <td>{{ action.getDatecreatE() }}</td>
            <td>{{ action.getUserupdatE() }}</td>
            <td>{{ action.getDateupdatE() }}</td>
            <td>{{ link_to("actions/edit/"~action.getID(), "Edit") }}</td>
            <td>{{ link_to("actions/delete/"~action.getID(), "Delete") }}</td>
        </tr>
    {% endfor %}
    {% endif %}
    </tbody>
    <tbody>
        <tr>
            <td colspan="2" align="right">
                <table align="center">
                    <tr>
                        <td>{{ link_to("actions/search", "First") }}</td>
                        <td>{{ link_to("actions/search?page="~page.before, "Previous") }}</td>
                        <td>{{ link_to("actions/search?page="~page.next, "Next") }}</td>
                        <td>{{ link_to("actions/search?page="~page.last, "Last") }}</td>
                        <td>{{ page.current~"/"~page.total_pages }}</td>
                    </tr>
                </table>
            </td>
        </tr>
    </tbody>
</table>
