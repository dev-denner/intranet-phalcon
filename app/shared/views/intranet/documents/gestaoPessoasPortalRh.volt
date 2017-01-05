{{ content() }}
<div class="card">
    <div class="card-header">
        <h2>Portal RH<small>Portal RH do Colaborador </small></h2>
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
                {% if document.category == 6 %}
                <div class="p-5" data-id="{{ document.id }}">
                    {{ document.description }}
                </div>
                {% endif %}
                {% endfor %}
            </div>
        </div>
        <a class="lv-item" href="http://portalrh.grupompe.com.br/" target="_new">
            <div class="media">
                <div class="pull-left p-relative"><img class="lv-img-sm" src="{{ static_url('assets/img/logos/apps/totvs.png') }}" alt=""></div>
                <div class="media-body">
                    <div class="lv-title">Portal RH - TOTVS</div>
                    <small class="lv-small">Portal RH do Colaborador</small>
                </div>
            </div>
        </a>
    </div>
    {% endif %}
    {% endfor %}
</div>