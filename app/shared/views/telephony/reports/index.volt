{{ content() }}

<div class="card">
    <div class="card-header">
        <h2>Relatórios para Rateios de TI <small>Escolha o relatório desejado, escolha mês e ano, e se necessário digite um valor. Após clique no botão Gerar.</small></h2>
    </div>
    <div class="card-body card-padding">
        <div class="row">
            {{ form('telephony/reports', 'role': 'form', 'method': 'post', 'autocomplete': 'off', 'target': '_new') }}
            <div class="col-sm-4">
                <div class="input-group fg-float">
                    <span class="input-group-addon"><i class="zmdi zmdi-keyboard"></i></span>
                    <div class="fg-line">
                        <div class="select">
                            <?php
                            echo $this->tag->select(['relatorios',
                                [
                                    1 => 'Rateio Celular Folha Pagto',
                                    2 => 'Rateio Celular NF',
                                    3 => 'Rateio NF ERP',
                                    4 => 'Rateio NF E-mails',
                                    5 => 'Rateio NF Matriz',
                                ],
                                'useEmpty' => true,
                                'emptyText' => '',
                                'emptyValue' => '',
                                'class' => 'form-control',
                                'required' => 'required']
                            );
                            ?>
                            <label class="fg-label">Relatório</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-2">
                <div class="input-group fg-float">
                    <span class="input-group-addon"><i class="zmdi zmdi-calendar-alt"></i></span>
                    <div class="fg-line">
                        {{ text_field("mes", "class" : "form-control fg-input monthPicker", 'required': 'required') }}
                        <label class="fg-label">Mês de Referência</label>
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="input-group fg-float">
                    <span class="input-group-addon"><i class="zmdi zmdi-money"></i></span>
                    <div class="fg-line">
                        {{ text_field("valor", "class" : "form-control fg-input formatMoney", 'disabled': 'disabled') }}
                        <label class="fg-label">valor</label>
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <button type="submit" class="btn btn-primary btn-sm m-t-5 waves-effect">Buscar</button>

                {% if link is not empty %}
                {{ link_to(link, 'Baixar', 'class': 'btn btn-success p-5 waves-effect') }}
                {% endif %}
            </div>

            {{ end_form() }}
        </div>
    </div>
</div>