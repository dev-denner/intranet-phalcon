{{ content() }}

<div class="btn-toolbar">
    {{ link_to("empresas/index", "Go Back", "class": "btn btn-success") }}
    {{ link_to("empresas/new", "Create", "class": "btn btn-success") }}
</div>

<div class="panel panel-default">
    <!-- Table -->
    <table class="table">
        <thead>
            <tr>
                <th>Id</th>
                <th>Codigo</th>
                <th>Razaosocial</th>
                <th>Nomefantasia</th>
                <th>Codprotheus</th>
                <th>Lojaprotheus</th>
                <th>Sdel</th>
                <th>Usercreate</th>
                <th>Datacreate</th>
                <th>Userupdate</th>
                <th>Dataupdate</th>

            </tr>
        </thead>
        <tbody>
            {% if page.items is defined %}
                {% for empresa in page.items %}
                    <tr>
                        <td>{{ empresa.getId() }}</td>
                        <td>{{ empresa.getCodigo() }}</td>
                        <td>{{ empresa.getRazaosocial() }}</td>
                        <td>{{ empresa.getNomefantasia() }}</td>
                        <td>{{ empresa.getCodprotheus() }}</td>
                        <td>{{ empresa.getLojaprotheus() }}</td>
                        <td>{{ empresa.getSdel() }}</td>
                        <td>{{ empresa.getUsercreate() }}</td>
                        <td>{{ empresa.getDatacreate() }}</td>
                        <td>{{ empresa.getUserupdate() }}</td>
                        <td>{{ empresa.getDataupdate() }}</td>

                        <td>{{ link_to("empresas/edit/"~empresa.getId(), "Edit") }}</td>
                        <td>{{ link_to("empresas/delete/"~empresa.getId(), "Delete") }}</td>
                    </tr>
                {% endfor %}
            {% endif %}
        </tbody>
    </table>
</div>
<nav>
    <ul class="pagination">
        <li>{{ link_to("empresas/search", "First") }}</li>
        <li>{{ link_to("empresas/search?page="~page.before, "Previous") }}</li>
        <li>{{ link_to("empresas/search?page="~page.next, "Next") }}</li>
        <li>{{ link_to("empresas/search?page="~page.last, "Last") }}</li>
    </ul>
</nav>