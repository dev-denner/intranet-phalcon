
{{ content() }}

<table width="100%">
  <tr>
    <td align="left">
      {{ link_to("users/index", "Go Back") }}
    </td>
    <td align="right">
      {{ link_to("users/new", "Create ") }}
    </td>
  </tr>
</table>

<table class="browse" align="center">
  <thead>
    <tr>
      <th>ID</th>
      <th>CPF</th>
      <th>PASSWORD</th>
      <th>EMAIL</th>
      <th>NAME</th>
      <th>STATUS</th>
      <th colspan="2">ACTIONS</th>
    </tr>
  </thead>
  <tbody>
    {% if page.items is defined %}
    {% for user in page.items %}
    <tr>
      <td>{{ user.getID() }}</td>
      <td>{{ user.getCpF() }}</td>
      <td>{{ user.getPassworD() }}</td>
      <td>{{ user.getEmaiL() }}</td>
      <td>{{ user.getNamE() }}</td>
      <td>{{ user.getStatuS() }}</td>
      <td>{{ link_to("users/edit/"~user.getID(), "Edit") }}</td>
      <td>{{ link_to("users/delete/"~user.getID(), "Delete") }}</td>
    </tr>
    {% endfor %}
    {% endif %}
  </tbody>
  <tbody>
    <tr>
      <td>{{ page.current~"/"~page.total_pages }}</td>
      <td colspan="3"></td>
      <td>{{ link_to("users/search", "First") }}</td>
      <td>{{ link_to("users/search?page="~page.before, "Previous") }}</td>
      <td>{{ link_to("users/search?page="~page.next, "Next") }}</td>
      <td>{{ link_to("users/search?page="~page.last, "Last") }}</td>
    </tr>
  </tbody>
</table>
