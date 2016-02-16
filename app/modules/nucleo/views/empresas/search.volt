<div class="row">
    <nav>
        <ul class="pager">
            <li class="previous">{{ link_to("empresas/index", "Go Back") }}</li>
            <li class="next">{{ link_to("empresas/new", "Create ") }}</li>
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
            <th>Codigo</th>
            <th>Cnpj</th>
            <th>RazaoSocial</th>
            <th>NomeFantasia</th>
            <th>CodProtheus</th>
            <th>LojaProtheus</th>
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
        {% for empresa in page.items %}
            <tr>
                <td>{{ empresa.getId() }}</td>
            <td>{{ empresa.getCodigo() }}</td>
            <td>{{ empresa.getCnpj() }}</td>
            <td>{{ empresa.getRazaosocial() }}</td>
            <td>{{ empresa.getNomefantasia() }}</td>
            <td>{{ empresa.getCodprotheus() }}</td>
            <td>{{ empresa.getLojaprotheus() }}</td>
            <td>{{ empresa.getSdel() }}</td>
            <td>{{ empresa.getCreateby() }}</td>
            <td>{{ empresa.getCreatein() }}</td>
            <td>{{ empresa.getUpdateby() }}</td>
            <td>{{ empresa.getUpdatein() }}</td>

                <td>{{ link_to("empresas/edit/"~empresa.getId(), "Edit") }}</td>
                <td>{{ link_to("empresas/delete/"~empresa.getId(), "Delete") }}</td>
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
                <li>{{ link_to("empresas/search", "First") }}</li>
                <li>{{ link_to("empresas/search?page="~page.before, "Previous") }}</li>
                <li>{{ link_to("empresas/search?page="~page.next, "Next") }}</li>
                <li>{{ link_to("empresas/search?page="~page.last, "Last") }}</li>
            </ul>
        </nav>
    </div>
</div>
