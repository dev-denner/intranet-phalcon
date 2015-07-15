
{{ content() }}

<table width="100%">
    <tr>
        <td align="left">
            {{ link_to("apps/index", "Go Back") }}
        </td>
        <td align="right">
            {{ link_to("apps/new", "Create ") }}
        </td>
    </tr>
</table>

<table class="browse" align="center">
    <thead>
        <tr>
            <th>ID</th>
            <th>CONTROLLER</th>
            <th>NAME</th>
            <th>MODULE</th>
            <th>SOFTDEL</th>
            <th>USERCREATE</th>
            <th>DATECREATE</th>
            <th>USERUPDATE</th>
            <th>DATEUPDATE</th>
         </tr>
    </thead>
    <tbody>
    {% if page.items is defined %}
    {% for app in page.items %}
        <tr>
            <td>{{ app.getID() }}</td>
            <td>{{ app.getControlleR() }}</td>
            <td>{{ app.getNamE() }}</td>
            <td>{{ app.getModulE() }}</td>
            <td>{{ app.getSoftdeL() }}</td>
            <td>{{ app.getUsercreatE() }}</td>
            <td>{{ app.getDatecreatE() }}</td>
            <td>{{ app.getUserupdatE() }}</td>
            <td>{{ app.getDateupdatE() }}</td>
            <td>{{ link_to("apps/edit/"~app.getID(), "Edit") }}</td>
            <td>{{ link_to("apps/delete/"~app.getID(), "Delete") }}</td>
        </tr>
    {% endfor %}
    {% endif %}
    </tbody>
    <tbody>
        <tr>
            <td colspan="2" align="right">
                <table align="center">
                    <tr>
                        <td>{{ link_to("apps/search", "First") }}</td>
                        <td>{{ link_to("apps/search?page="~page.before, "Previous") }}</td>
                        <td>{{ link_to("apps/search?page="~page.next, "Next") }}</td>
                        <td>{{ link_to("apps/search?page="~page.last, "Last") }}</td>
                        <td>{{ page.current~"/"~page.total_pages }}</td>
                    </tr>
                </table>
            </td>
        </tr>
    </tbody>
</table>
