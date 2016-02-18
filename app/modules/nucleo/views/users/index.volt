<div class="row">
  <nav>
    <ul class="pager">
      <li class="previous">{{ link_to("users/search", "Go Back") }}</li>
      <li class="next">{{ link_to("users/new", "Create ") }}</li>
    </ul>
  </nav>
</div>

<div class="page-header">
  <h1>Search result</h1>
</div>

{{ content() }}

{{ datatable.render() }}