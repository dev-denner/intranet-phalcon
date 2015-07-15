
{{ content() }}

<table width="100%">
    <tr>
        <td align="left">
            {{ link_to("modules/index", "Go Back") }}
        </td>
        <td align="right">
            {{ link_to("modules/new", "Create ") }}
        </td>
    </tr>
</table>

<table class="browse" align="center">
    <thead>
        <tr>
            <th>ID</th>
            <th>NAME</th>
            <th>SOFTDEL</th>
            <th>USERCREATE</th>
            <th>DATECREATE</th>
            <th>USERUPDATE</th>
            <th>DATEUPDATE</th>
         </tr>
    </thead>
    <tbody>
    {% if page.items is defined %}
    {% for module in page.items %}
        <tr>
            <td>{{ module.getID() }}</td>
            <td>{{ module.getNamE() }}</td>
            <td>{{ module.getSoftdeL() }}</td>
            <td>{{ module.getUsercreatE() }}</td>
            <td>{{ module.getDatecreatE() }}</td>
            <td>{{ module.getUserupdatE() }}</td>
            <td>{{ module.getDateupdatE() }}</td>
            <td>{{ link_to("modules/edit/"~module.getID(), "Edit") }}</td>
            <td>{{ link_to("modules/delete/"~module.getID(), "Delete") }}</td>
        </tr>
    {% endfor %}
    {% endif %}
    </tbody>
    <tbody>
        <tr>
            <td colspan="2" align="right">
                <table align="center">
                    <tr>
                        <td>{{ link_to("modules/search", "First") }}</td>
                        <td>{{ link_to("modules/search?page="~page.before, "Previous") }}</td>
                        <td>{{ link_to("modules/search?page="~page.next, "Next") }}</td>
                        <td>{{ link_to("modules/search?page="~page.last, "Last") }}</td>
                        <td>{{ page.current~"/"~page.total_pages }}</td>
                    </tr>
                </table>
            </td>
        </tr>
    </tbody>
</table>
