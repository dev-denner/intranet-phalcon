
{{ content() }}

<table width="100%">
    <tr>
        <td align="left">
            {{ link_to("perfil/index", "Go Back") }}
        </td>
        <td align="right">
            {{ link_to("perfil/new", "Create ") }}
        </td>
    </tr>
</table>

<table class="browse" align="center">
    <thead>
        <tr>
            <th>ID</th>
            <th>DESCRIPTION</th>
            <th>STATUS</th>
            <th>SOFTDEL</th>
            <th>USERCREATE</th>
            <th>DATECREATE</th>
            <th>USERUPDATE</th>
            <th>DATEUPDATE</th>
         </tr>
    </thead>
    <tbody>
    {% if page.items is defined %}
    {% for perfil in page.items %}
        <tr>
            <td>{{ perfil.getID() }}</td>
            <td>{{ perfil.getDescriptioN() }}</td>
            <td>{{ perfil.getStatuS() }}</td>
            <td>{{ perfil.getSoftdeL() }}</td>
            <td>{{ perfil.getUsercreatE() }}</td>
            <td>{{ perfil.getDatecreatE() }}</td>
            <td>{{ perfil.getUserupdatE() }}</td>
            <td>{{ perfil.getDateupdatE() }}</td>
            <td>{{ link_to("perfil/edit/"~perfil.getID(), "Edit") }}</td>
            <td>{{ link_to("perfil/delete/"~perfil.getID(), "Delete") }}</td>
        </tr>
    {% endfor %}
    {% endif %}
    </tbody>
    <tbody>
        <tr>
            <td colspan="2" align="right">
                <table align="center">
                    <tr>
                        <td>{{ link_to("perfil/search", "First") }}</td>
                        <td>{{ link_to("perfil/search?page="~page.before, "Previous") }}</td>
                        <td>{{ link_to("perfil/search?page="~page.next, "Next") }}</td>
                        <td>{{ link_to("perfil/search?page="~page.last, "Last") }}</td>
                        <td>{{ page.current~"/"~page.total_pages }}</td>
                    </tr>
                </table>
            </td>
        </tr>
    </tbody>
</table>
