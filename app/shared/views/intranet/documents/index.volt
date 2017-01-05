{{ content() }}
<div class="card">
    <div class="card-header">
        <h2>Documentos<small>Referência de Documentos no ECM </small></h2>
    </div>

    {% for departament in departaments %}
    {% if count(departament.PagesCategories) > 0 %}
    <div class="card-body card-padding">
        <div class="title_category">
            <h3 data-id="{{ departament.id }}"><i class="{{ departament.icon }}"></i> {{ departament.title }}</h3>
        </div>
        <div class="media">
            <div class="media-body">
                {% for document in departament.PagesCategories %}
                {% if document.category == 2 %}
                <div class="p-5" data-id="{{ document.id }}">
                    {{ document.description }}
                </div>
                {% endif %}
                {% endfor %}
            </div>
        </div>
        <a class="lv-item" href="http://ecm.grupompe.com.br/" target="_new">
            <div class="media">
                <div class="pull-left p-relative"><img class="lv-img-sm" src="{{ static_url('assets/img/logos/apps/totvs.png') }}" alt=""></div>
                <div class="media-body">
                    <div class="lv-title">ECM - TOTVS</div>
                    <small class="lv-small">Gerenciador de Documentos</small>
                </div>
            </div>
        </a>
    </div>
    {% endif %}
    {% endfor %}
</div>