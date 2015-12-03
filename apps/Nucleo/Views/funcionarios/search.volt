{{ content() }}

<div class="btn-toolbar">
    {{ link_to("funcionarios/index", "Go Back", "class": "btn btn-success") }}
    {{ link_to("funcionarios/new", "Create", "class": "btn btn-success") }}
</div>

<div class="panel panel-default">
    <!-- Table -->
    <table class="table">
        <thead>
            <tr>
                <th>Id</th>
                <th>Chapa</th>
                <th>Nome</th>
                <th>Cpf</th>
                <th>Empresa</th>
                <th>Situacao</th>
                <th>Tipo</th>
                <th>Dataadmissao</th>
                <th>Cargo</th>
                <th>Email</th>
                <th>Centrocusto</th>
                <th>Banco</th>
                <th>Numagencia</th>
                <th>Digagencia</th>
                <th>Numconta</th>
                <th>Digconta</th>
                <th>Periodopagto</th>
                <th>Sdel</th>
                <th>Usercreate</th>
                <th>Datacreate</th>
                <th>Userupdate</th>
                <th>Dataupdate</th>

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
                        <td>{{ funcionario.getBanco() }}</td>
                        <td>{{ funcionario.getNumagencia() }}</td>
                        <td>{{ funcionario.getDigagencia() }}</td>
                        <td>{{ funcionario.getNumconta() }}</td>
                        <td>{{ funcionario.getDigconta() }}</td>
                        <td>{{ funcionario.getPeriodopagto() }}</td>
                        <td>{{ funcionario.getSdel() }}</td>
                        <td>{{ funcionario.getUsercreate() }}</td>
                        <td>{{ funcionario.getDatacreate() }}</td>
                        <td>{{ funcionario.getUserupdate() }}</td>
                        <td>{{ funcionario.getDataupdate() }}</td>

                        <td>{{ link_to("funcionarios/edit/"~funcionario.getId(), "Edit") }}</td>
                        <td>{{ link_to("funcionarios/delete/"~funcionario.getId(), "Delete") }}</td>
                    </tr>
                {% endfor %}
            {% endif %}
        </tbody>
    </table>
</div>
<nav>
    <ul class="pagination">
        <li>{{ link_to("funcionarios/search", "First") }}</li>
        <li>{{ link_to("funcionarios/search?page="~page.before, "Previous") }}</li>
        <li>{{ link_to("funcionarios/search?page="~page.next, "Next") }}</li>
        <li>{{ link_to("funcionarios/search?page="~page.last, "Last") }}</li>
    </ul>
</nav>