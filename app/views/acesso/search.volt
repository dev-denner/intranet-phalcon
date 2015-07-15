
{{ content() }}

<table width="100%">
    <tr>
        <td align="left">
            {{ link_to("acesso/index", "Go Back") }}
        </td>
        <td align="right">
            {{ link_to("acesso/new", "Create ") }}
        </td>
    </tr>
</table>

<table class="browse" align="center">
    <thead>
        <tr>
            <th>ID</th>
            <th>PERFIL</th>
            <th>ACTION</th>
            <th>PERMISSION</th>
            <th>SOFTDEL</th>
            <th>USERCREATE</th>
            <th>DATECREATE</th>
            <th>USERUPDATE</th>
            <th>DATEUPDATE</th>
         </tr>
    </thead>
    <tbody>
    {% if page.items is defined %}
    {% for acesso in page.items %}
        <tr>
            <td>{{ acesso.getID() }}</td>
            <td>{{ acesso.getPerfiL() }}</td>
            <td>{{ acesso.getActioN() }}</td>
            <td>{{ acesso.getPermissioN() }}</td>
            <td>{{ acesso.getSoftdeL() }}</td>
            <td>{{ acesso.getUsercreatE() }}</td>
            <td>{{ acesso.getDatecreatE() }}</td>
            <td>{{ acesso.getUserupdatE() }}</td>
            <td>{{ acesso.getDateupdatE() }}</td>
            <td>{{ link_to("acesso/edit/"~acesso.getID(), "Edit") }}</td>
            <td>{{ link_to("acesso/delete/"~acesso.getID(), "Delete") }}</td>
        </tr>
    {% endfor %}
    {% endif %}
    </tbody>
    <tbody>
        <tr>
            <td colspan="2" align="right">
                <table align="center">
                    <tr>
                        <td>{{ link_to("acesso/search", "First") }}</td>
                        <td>{{ link_to("acesso/search?page="~page.before, "Previous") }}</td>
                        <td>{{ link_to("acesso/search?page="~page.next, "Next") }}</td>
                        <td>{{ link_to("acesso/search?page="~page.last, "Last") }}</td>
                        <td>{{ page.current~"/"~page.total_pages }}</td>
                    </tr>
                </table>
            </td>
        </tr>
    </tbody>
</table>
