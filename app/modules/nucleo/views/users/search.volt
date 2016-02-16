<div class="row">
  <nav>
    <ul class="pager">
      <li class="previous">{{ link_to("users/index", "Go Back") }}</li>
      <li class="next">{{ link_to("users/new", "Create ") }}</li>
    </ul>
  </nav>
</div>

<div class="page-header">
  <h1>Search result</h1>
</div>

{{ content() }}

<div class="row">
  <table class="table table-bordered table-condensed table-hover table-striped dataTabled">
    <thead class="tab-pane">
      <tr>
        <th>Id</th>
        <th>Cpf</th>
        <th>Email</th>
        <th>Nome</th>
        <th>Status</th>

      </tr>
    </thead>
    <tbody class="tab-content">
      {% if page.items is defined %}
      {% for user in page.items %}
      <tr>
        <td>{{ user.getId() }}</td>
        <td>{{ user.getCpf() }}</td>
        <td>{{ user.getEmail() }}</td>
        <td>{{ user.getName() }}</td>
        <td>{{ user.getStatus() }}</td>

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
        <li>{{ link_to('users/search', '<<') }}</li>
        <li>{{ link_to('users/search?page='~page.before, '<') }}</li>
        <li>{{ link_to('users/search?page='~page.next, '>') }}</li>
        <li>{{ link_to('users/search?page='~page.last, '>>') }}</li>
      </ul>
    </nav>
  </div>
</div>