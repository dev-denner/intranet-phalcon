<div class="row">
    <nav>
        <ul class="pager">
            <li class="previous">{{ link_to("funcionarios/index", "Go Back") }}</li>
            <li class="next">{{ link_to("funcionarios/new", "Create ") }}</li>
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
            <th>Chapa</th>
            <th>Nome</th>
            <th>Cpf</th>
            <th>Empresa</th>
            <th>Situacao</th>
            <th>Tipo</th>
            <th>DataAdmissao</th>
            <th>Cargo</th>
            <th>Email</th>
            <th>CentroCusto</th>
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
        {% for funcionario in page.items %}
            <tr>
                <td>{{ funcionario.getId() }}</td>
            <td>{{ funcionario.getChapa() }}</td>
            <td>{{ funcionario.getNome() }}</td>
            <td>{{ funcionario.getCpf() }}</td>
            <td>{{ funcionario.getEmpresa() }}</td>
            <td>{{ funcionario.getSituacao() }}</td>
            <td>{{ funcionario.getTipo() }}</td>
            <td>{{ funcionario.getDataadmissao() }}</td>
            <td>{{ funcionario.getCargo() }}</td>
            <td>{{ funcionario.getEmail() }}</td>
            <td>{{ funcionario.getCentrocusto() }}</td>
            <td>{{ funcionario.getSdel() }}</td>
            <td>{{ funcionario.getCreateby() }}</td>
            <td>{{ funcionario.getCreatein() }}</td>
            <td>{{ funcionario.getUpdateby() }}</td>
            <td>{{ funcionario.getUpdatein() }}</td>

                <td>{{ link_to("funcionarios/edit/"~funcionario.getId(), "Edit") }}</td>
                <td>{{ link_to("funcionarios/delete/"~funcionario.getId(), "Delete") }}</td>
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
                <li>{{ link_to("funcionarios/search", "First") }}</li>
                <li>{{ link_to("funcionarios/search?page="~page.before, "Previous") }}</li>
                <li>{{ link_to("funcionarios/search?page="~page.next, "Next") }}</li>
                <li>{{ link_to("funcionarios/search?page="~page.last, "Last") }}</li>
            </ul>
        </nav>
    </div>
</div>
