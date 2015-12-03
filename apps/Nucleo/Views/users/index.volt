{{ content() }}
<h1>Pesquisar Usuários</h1>
<div align="right">
  {{ link_to("users/new", "New", 'class' : 'btn btn-success') }}
</div>

<div class="col-md-6 col-sm-6">
  {{ form("users/search", "method":"post", "autocomplete" : "off", "class": "form-horizontal") }}
  <fieldset>

    {% for elementos in form %}

    <div class="form-group">
      {{ elementos.label() }}
      {{ elementos.render(['class': 'form-control']) }}
    </div>

    {% endfor %}

    <div class="form-group">
      {{ submit_button("Buscar", "class": "btn btn-success col-sm-offset-4") }}
    </div>
  </fieldset>
</form>
</div>
