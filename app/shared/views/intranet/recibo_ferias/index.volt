{{ content() }}
<div class="card">
    <div class="card-header">
        <h2>Recibo de Férias <small>Clique nos botões abaixo para acessar os Recibos de Férias desejados.</small></h2>
    </div>
    <div class="card-body card-padding">
        <div class="row">
            {% for recibo_feria in recibo_ferias %}
            <div class="col-sm-1">
                <div class="form-group">
                    {{ link_to('recibo_ferias/view/'~recibo_feria.FIM_PERIODO_AQUISITIVO, recibo_feria.ANO, 'class': 'btn bgm-bluegray m-t-5 waves-effect') }}
                    <br class="visible-xs-block" />
                    <br class="visible-xs-block" />
                </div>
            </div>

            {% endfor %}

        </div>
    </div>
</div>
