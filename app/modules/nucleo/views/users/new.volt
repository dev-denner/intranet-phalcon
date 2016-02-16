<div class="row">
    <nav>
        <ul class="pager">
            <li class="previous">{{ link_to("users", "Voltar") }}</li>
        </ul>
    </nav>
</div>

{{ content() }}

{{ form.renderForm() }}