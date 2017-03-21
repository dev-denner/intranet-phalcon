{{ content() }}

<div class="card">
    <div class="card-header">
        <h2>Relatório Indicadores do SGI <small>Preencha as informações divididas por assunto clicando nas abas.</small></h2>
    </div>

    <div class="card-body card-padding">
        <div class="form-wizard-basic fw-container">
            {{ form("forms/indicadores_sgi/relatorio", "method":"post", "autocomplete" : "off", 'onsubmit': 'overlay(true)') }}
            <div class="row">
                <div class="col-sm-3 m-b-20">
                    <div class="form-group fg-line">
                        <div class="form-group fg-line">
                            <label>Ano</label>
                            <?php
                            echo $this->tag->selectStatic(['anoComp',
                                $anoComp,
                                'useEmpty' => true,
                                'emptyText' => 'Escolha uma opção',
                                'emptyValue' => '',
                                'class' => 'form-control fg-input fc-alt',
                                'required' => 'required'
                            ]);
                            ?>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3 m-b-20">
                    <div class="form-group fg-line">
                        <label>Centro de Custo</label>
                        <?php
                        echo $this->tag->selectStatic(['cc',
                            $cc,
                            'useEmpty' => true,
                            'emptyText' => 'Escolha uma opção',
                            'emptyValue' => '',
                            'class' => 'form-control fg-input fc-alt',
                            'required' => 'required'
                        ]);
                        ?>
                    </div>
                </div>
                <div class="col-sm-2 m-b-20">
                    <label>&nbsp;</label>
                    <button type="submit" class="btn bgm-green form-control fg-input fc-alt">Enviar</button>
                </div>
            </div>
            {{ end_form() }}
        </div>
    </div>
    {% if dados is not empty %}
    <div class="card">
        <div class="card-header">
            <ul class="actions">
                <li>
                    {{ form("forms/indicadores_sgi/export", "method":"post", 'target': '_new') }}
                    {{ hidden_field("type", "value": "excel") }}
                    {{ hidden_field("search", "value": search) }}
                    <button type="submit" class="btn btn-link tooltips" title="Exportar para Excel">
                        <i class="fa fa-file-excel-o c-green" aria-hidden="true"></i>
                    </button>
                    {{ end_form() }}
                </li>
                <li>
                    {{ form("forms/indicadores_sgi/export", "method":"post", 'target': '_new') }}
                    {{ hidden_field("type", "value": "pdf") }}
                    {{ hidden_field("search", "value": search) }}
                    <button type="submit" class="btn btn-link tooltips" title="Exportar para PDF">
                        <i class="fa fa-file-pdf-o c-red" aria-hidden="true"></i>
                    </button>
                    {{ end_form() }}
                </li>
            </ul>
        </div>

        <div class="card-body card-padding">

            <ul class="tab-nav text-center fw-nav" role="tablist" data-tab-color="teal">
                <li class="active"><a href="#saude_segurança" data-toggle="tab" aria-expanded="true">Saúde e Segurança</a></li>
                <li class=""><a href="#integrado" data-toggle="tab" aria-expanded="false">Integrado</a></li>
                <li class=""><a href="#qualidade" data-toggle="tab" aria-expanded="false">Qualidade</a></li>
                <li class=""><a href="#meio_ambiente" data-toggle="tab" aria-expanded="false">Meio Ambiente</a></li>
                <li class=""><a href="#geral" data-toggle="tab" aria-expanded="false">Geral</a></li>
            </ul>

            <div class="tab-content">
                <!-- #saude_segurança -->
                <div class="tab-pane fade active in" id="saude_segurança">

                    <div class="table-responsive">
                        <table class="table table-striped table-vmiddle bootgrid-table">
                            <caption><span class="badge bgm-green">1.0</span> Horas Trabalhadas</caption>
                            <thead>
                                <tr>
                                    <th>Ítem</th>
                                    <th>Jan</th>
                                    <th>Fev</th>
                                    <th>Mar</th>
                                    <th>Abr</th>
                                    <th>Mai</th>
                                    <th>Jun</th>
                                    <th>Jul</th>
                                    <th>Ago</th>
                                    <th>Set</th>
                                    <th>Out</th>
                                    <th>Nov</th>
                                    <th>Dez</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th><i class="badge bgm-lightgreen">1.1</i> Número de Empregados</th>
                                    {% for key, value in dados %}
                                    {% if dados[key] == false %}
                                    <td>0</td>
                                    {% else %}
                                    {% if key == 'total'  %}
                                    {% for val in value['nEmpregados'] %}
                                    <th>{{ val }}</th>
                                    {% endfor %}
                                    {% else %}
                                    <td>{{ value.nEmpregados }}</td>
                                    {% endif %}
                                    {% endif %}
                                    {% endfor %}
                                </tr>
                                <tr>
                                    <th><i class="badge bgm-lightgreen">1.2</i> Número de Empregados Terceirizados</th>
                                    {% for key, value in dados %}
                                    {% if dados[key] == false %}
                                    <td>0</td>
                                    {% else %}
                                    {% if key == 'total'  %}
                                    {% for val in value['nEmpregadosTerc'] %}
                                    <th>{{ val }}</th>
                                    {% endfor %}
                                    {% else %}
                                    <td>{{ value.nEmpregadosTerc }}</td>
                                    {% endif %}
                                    {% endif %}
                                    {% endfor %}
                                </tr>
                                <tr>
                                    <th><i class="badge bgm-lightgreen">1.3</i> Homens Hora Exposição ao Risco (HHER)</th>
                                    {% for key, value in dados %}
                                    {% if dados[key] == false %}
                                    <td>0,00</td>
                                    {% else %}
                                    {% if key == 'total'  %}
                                    {% for val in value['hher'] %}
                                    <th>{{ number_format(val, 2, ',', '.') }}</th>
                                    {% endfor %}
                                    {% else %}
                                    <td>{{ value.hher }}</td>
                                    {% endif %}
                                    {% endif %}
                                    {% endfor %}
                                </tr>
                                <tr>
                                    <th><i class="badge bgm-lightgreen">1.4</i> Homens Hora Exposição ao Risco (HHER) - Terceiros</th>
                                    {% for key, value in dados %}
                                    {% if dados[key] == false %}
                                    <td>0,00</td>
                                    {% else %}
                                    {% if key == 'total'  %}
                                    {% for val in value['hherTerc'] %}
                                    <th>{{ number_format(val, 2, ',', '.') }}</th>
                                    {% endfor %}
                                    {% else %}
                                    <td>{{ value.hherTerc }}</td>
                                    {% endif %}
                                    {% endif %}
                                    {% endfor %}
                                </tr>
                                <tr>
                                    <th><i class="badge bgm-lightgreen">1.5</i> Total de Homens Horas de Exposição ao Risco (HHER)</th>
                                    {% for key, value in dados %}
                                    {% if dados[key] == false %}
                                    <td>0,00</td>
                                    {% else %}
                                    {% if key == 'total'  %}
                                    {% for val in value['hherTotal'] %}
                                    <th>{{ number_format(val, 2, ',', '.') }}</th>
                                    {% endfor %}
                                    {% else %}
                                    <td>{{ value.hherTotal }}</td>
                                    {% endif %}
                                    {% endif %}
                                    {% endfor %}
                                </tr>
        <!--                                <tr>
                                    <th><i class="badge bgm-lightgreen">1.6</i> Total de Horas Acumuladas no ano</th>
                                    {% for key, value in dados %}
                                        {% if dados[key] == false %}
                                            <td>0,00</td>
                                        {% else %}
                                            {% if key == 'total'  %}
                                                {% for val in value['hherTotalAno'] %}
                                                    <th>{{ number_format(val, 2, ',', '.') }}</th>
                                                {% endfor %}
                                            {% else %}
                                                <td>{{ value.hherTotalAno }}</td>
                                            {% endif %}
                                        {% endif %}
                                    {% endfor %}
                                </tr>-->
                            </tbody>
                        </table>
                    </div>
                    <br />

                    <div class="table-responsive">
                        <table class="table table-striped table-vmiddle bootgrid-table">
                            <caption><span class="badge bgm-green">2.0</span> Incidentes Reportáveis</caption>
                            <thead>
                                <tr>
                                    <th>Ítem</th>
                                    <th>Jan</th>
                                    <th>Fev</th>
                                    <th>Mar</th>
                                    <th>Abr</th>
                                    <th>Mai</th>
                                    <th>Jun</th>
                                    <th>Jul</th>
                                    <th>Ago</th>
                                    <th>Set</th>
                                    <th>Out</th>
                                    <th>Nov</th>
                                    <th>Dez</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th><i class="badge bgm-lightgreen">2.1</i> Número de acidentes com afastamento (Típicos)</th>
                                    {% for key, value in dados %}
                                    {% if dados[key] == false %}
                                    <td>0</td>
                                    {% else %}
                                    {% if key == 'total'  %}
                                    {% for val in value['acidComAfast'] %}
                                    <th>{{ val }}</th>
                                    {% endfor %}
                                    {% else %}
                                    <td>{{ value.acidComAfast }}</td>
                                    {% endif %}
                                    {% endif %}
                                    {% endfor %}
                                </tr>
                                <tr>
                                    <th><i class="badge bgm-lightgreen">2.2</i> Número de dias perdidos por acidentes com afastamento (Típicos)</th>
                                    {% for key, value in dados %}
                                    {% if dados[key] == false %}
                                    <td>0</td>
                                    {% else %}
                                    {% if key == 'total'  %}
                                    {% for val in value['acidComAfastDiasPerd'] %}
                                    <th>{{ val }}</th>
                                    {% endfor %}
                                    {% else %}
                                    <td>{{ value.acidComAfastDiasPerd }}</td>
                                    {% endif %}
                                    {% endif %}
                                    {% endfor %}
                                </tr>
                                <tr>
                                    <th><i class="badge bgm-lightgreen">2.3</i> Número de dias debitados por acidentes com afastamento (Típicos)</th>
                                    {% for key, value in dados %}
                                    {% if dados[key] == false %}
                                    <td>0</td>
                                    {% else %}
                                    {% if key == 'total'  %}
                                    {% for val in value['acidComAfastDiasDebit'] %}
                                    <th>{{ val }}</th>
                                    {% endfor %}
                                    {% else %}
                                    <td>{{ value.acidComAfastDiasDebit }}</td>
                                    {% endif %}
                                    {% endif %}
                                    {% endfor %}
                                </tr>
                                <tr>
                                    <th><i class="badge bgm-lightgreen">2.4</i> TFCA - Taxa de Frequência de Acidentes com Afastamento - Acumulada (Acidentes Típicos)</th>
                                    {% for key, value in dados %}
                                    {% if dados[key] == false %}
                                    <td>0,00</td>
                                    {% else %}
                                    {% if key == 'total'  %}
                                    {% for val in value['tfcaMes'] %}
                                    <th>{{ number_format(val, 2, ',', '.') }}</th>
                                    {% endfor %}
                                    {% else %}
                                    <td>{{ value.tfcaMes }}</td>
                                    {% endif %}
                                    {% endif %}
                                    {% endfor %}
                                </tr>
        <!--                                <tr>
                                    <th><span class="c-green"><i class="badge bgm-lightgreen">AC</i> Acumulado TFCA</span></th>
                                    {% for key, value in dados %}
                                        {% if dados[key] == false %}
                                            <td>0,00</td>
                                        {% else %}
                                            {% if key == 'total'  %}
                                                {% for val in value['tfca'] %}
                                                    <th>{{ number_format(val, 2, ',', '.') }}</th>
                                                {% endfor %}
                                            {% else %}
                                                <td>{{ value.tfca }}</td>
                                            {% endif %}
                                        {% endif %}
                                    {% endfor %}
                                </tr>-->
                                <tr>
                                    <th><i class="badge bgm-lightgreen">2.5</i> TG - Taxa de Gravidade</th>
                                    {% for key, value in dados %}
                                    {% if dados[key] == false %}
                                    <td>0</td>
                                    {% else %}
                                    {% if key == 'total'  %}
                                    {% for val in value['txGravAcumMes'] %}
                                    <th>{{ val }}</th>
                                    {% endfor %}
                                    {% else %}
                                    <td>{{ value.txGravAcumMes }}</td>
                                    {% endif %}
                                    {% endif %}
                                    {% endfor %}
                                </tr>
        <!--                                <tr>
                                    <th><span class="c-green"><i class="badge bgm-lightgreen">AC</i> Acumulado TG</span></th>
                                    {% for key, value in dados %}
                                        {% if dados[key] == false %}
                                            <td>0</td>
                                        {% else %}
                                            {% if key == 'total'  %}
                                                {% for val in value['txGravAcum'] %}
                                                    <th>{{ val }}</th>
                                                {% endfor %}
                                            {% else %}
                                                <td>{{ value.txGravAcum }}</td>
                                            {% endif %}
                                        {% endif %}
                                    {% endfor %}
                                </tr>-->
                                <tr>
                                    <th><i class="badge bgm-lightgreen">2.6</i> Número de acidentes sem afastamento (Típicos)</th>
                                    {% for key, value in dados %}
                                    {% if dados[key] == false %}
                                    <td>0</td>
                                    {% else %}
                                    {% if key == 'total'  %}
                                    {% for val in value['nAcidSemAfast'] %}
                                    <th>{{ val }}</th>
                                    {% endfor %}
                                    {% else %}
                                    <td>{{ value.nAcidSemAfast }}</td>
                                    {% endif %}
                                    {% endif %}
                                    {% endfor %}
                                </tr>
                                <tr>
                                    <th><i class="badge bgm-lightgreen">2.7</i> TFSA - Taxa de Frequência de Acidentes sem Afastamento</th>
                                    {% for key, value in dados %}
                                    {% if dados[key] == false %}
                                    <td>0,00</td>
                                    {% else %}
                                    {% if key == 'total'  %}
                                    {% for val in value['tfsaMes'] %}
                                    <th>{{ number_format(val, 2, ',', '.') }}</th>
                                    {% endfor %}
                                    {% else %}
                                    <td>{{ value.tfsaMes }}</td>
                                    {% endif %}
                                    {% endif %}
                                    {% endfor %}
                                </tr>
        <!--                                <tr>
                                    <th><span class="c-green"><i class="badge bgm-lightgreen">AC</i> Acumulado TFSA</span></th>
                                    {% for key, value in dados %}
                                        {% if dados[key] == false %}
                                            <td>0,00</td>
                                        {% else %}
                                            {% if key == 'total'  %}
                                                {% for val in value['tfsa'] %}
                                                    <th>{{ number_format(val, 2, ',', '.') }}</th>
                                                {% endfor %}
                                            {% else %}
                                                <td>{{ value.tfsa }}</td>
                                            {% endif %}
                                        {% endif %}
                                    {% endfor %}
                                </tr>-->
                                <tr>
                                    <th><i class="badge bgm-lightgreen">2.8</i> TOR - Taxa de Ocorrências Registráveis</th>
                                    {% for key, value in dados %}
                                    {% if dados[key] == false %}
                                    <td>0,00</td>
                                    {% else %}
                                    {% if key == 'total'  %}
                                    {% for val in value['torMes'] %}
                                    <th>{{ number_format(val, 2, ',', '.') }}</th>
                                    {% endfor %}
                                    {% else %}
                                    <td>{{ value.torMes }}</td>
                                    {% endif %}
                                    {% endif %}
                                    {% endfor %}
                                </tr>
        <!--                                <tr>
                                    <th><span class="c-green"><i class="badge bgm-lightgreen">AC</i> Acumulado TOR</span></th>
                                    {% for key, value in dados %}
                                        {% if dados[key] == false %}
                                            <td>0,00</td>
                                        {% else %}
                                            {% if key == 'total'  %}
                                                {% for val in value['tor'] %}
                                                    <th>{{ number_format(val, 2, ',', '.') }}</th>
                                                {% endfor %}
                                            {% else %}
                                                <td>{{ value.tor }}</td>
                                            {% endif %}
                                        {% endif %}
                                    {% endfor %}
                                </tr>-->
                                <tr>
                                    <th><i class="badge bgm-lightgreen">2.9</i> Número de Quase acidentes</th>
                                    {% for key, value in dados %}
                                    {% if dados[key] == false %}
                                    <td>0</td>
                                    {% else %}
                                    {% if key == 'total'  %}
                                    {% for val in value['nQuaseAcid'] %}
                                    <th>{{ val }}</th>
                                    {% endfor %}
                                    {% else %}
                                    <td>{{ value.nQuaseAcid }}</td>
                                    {% endif %}
                                    {% endif %}
                                    {% endfor %}
                                </tr>
                                <tr>
                                    <th><i class="badge bgm-lightgreen">2.10</i> Número de desvios</th>
                                    {% for key, value in dados %}
                                    {% if dados[key] == false %}
                                    <td>0</td>
                                    {% else %}
                                    {% if key == 'total'  %}
                                    {% for val in value['nDesvio'] %}
                                    <th>{{ val }}</th>
                                    {% endfor %}
                                    {% else %}
                                    <td>{{ value.nDesvio }}</td>
                                    {% endif %}
                                    {% endif %}
                                    {% endfor %}
                                </tr>
                                <tr>
                                    <th><i class="badge bgm-lightgreen">2.11</i> Número de acidentes sem afastamento (Acidentes de Trajeto)</th>
                                    {% for key, value in dados %}
                                    {% if dados[key] == false %}
                                    <td>0</td>
                                    {% else %}
                                    {% if key == 'total'  %}
                                    {% for val in value['nAcidTrajSemAfast'] %}
                                    <th>{{ val }}</th>
                                    {% endfor %}
                                    {% else %}
                                    <td>{{ value.nAcidTrajSemAfast }}</td>
                                    {% endif %}
                                    {% endif %}
                                    {% endfor %}
                                </tr>
                                <tr>
                                    <th><i class="badge bgm-lightgreen">2.12</i> Número de acidentes com afastamento (Acidentes de Trajeto)</th>
                                    {% for key, value in dados %}
                                    {% if dados[key] == false %}
                                    <td>0</td>
                                    {% else %}
                                    {% if key == 'total'  %}
                                    {% for val in value['nAcidTrajComAfast'] %}
                                    <th>{{ val }}</th>
                                    {% endfor %}
                                    {% else %}
                                    <td>{{ value.nAcidTrajComAfast }}</td>
                                    {% endif %}
                                    {% endif %}
                                    {% endfor %}
                                </tr>
                                <tr>
                                    <th><i class="badge bgm-lightgreen">2.13</i> Número de dias perdidos por acidentes de trajeto com afastamento</th>
                                    {% for key, value in dados %}
                                    {% if dados[key] == false %}
                                    <td>0</td>
                                    {% else %}
                                    {% if key == 'total'  %}
                                    {% for val in value['nDiasPerdAcidTrajComAfast'] %}
                                    <th>{{ val }}</th>
                                    {% endfor %}
                                    {% else %}
                                    <td>{{ value.nDiasPerdAcidTrajComAfast }}</td>
                                    {% endif %}
                                    {% endif %}
                                    {% endfor %}
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <br />

                    <div class="table-responsive">
                        <table class="table table-striped table-vmiddle bootgrid-table">
                            <caption><span class="badge bgm-green">3.0</span> Doenças Ocupacionais</caption>
                            <thead>
                                <tr>
                                    <th>Ítem</th>
                                    <th>Jan</th>
                                    <th>Fev</th>
                                    <th>Mar</th>
                                    <th>Abr</th>
                                    <th>Mai</th>
                                    <th>Jun</th>
                                    <th>Jul</th>
                                    <th>Ago</th>
                                    <th>Set</th>
                                    <th>Out</th>
                                    <th>Nov</th>
                                    <th>Dez</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th><i class="badge bgm-lightgreen">3.1</i> Número de casos de doenças ocupacionais</th>
                                    {% for key, value in dados %}
                                    {% if dados[key] == false %}
                                    <td>0</td>
                                    {% else %}
                                    {% if key == 'total'  %}
                                    {% for val in value['nCasosDoencasOcup'] %}
                                    <th>{{ val }}</th>
                                    {% endfor %}
                                    {% else %}
                                    <td>{{ value.nCasosDoencasOcup }}</td>
                                    {% endif %}
                                    {% endif %}
                                    {% endfor %}
                                </tr>
                                <tr>
                                    <th><i class="badge bgm-lightgreen">3.2</i> Número de dias perdidos por doenças</th>
                                    {% for key, value in dados %}
                                    {% if dados[key] == false %}
                                    <td>0</td>
                                    {% else %}
                                    {% if key == 'total'  %}
                                    {% for val in value['nDiasPerdDoencas'] %}
                                    <th>{{ val }}</th>
                                    {% endfor %}
                                    {% else %}
                                    <td>{{ value.nDiasPerdDoencas }}</td>
                                    {% endif %}
                                    {% endif %}
                                    {% endfor %}
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <br />

                    <div class="table-responsive">
                        <table class="table table-striped table-vmiddle bootgrid-table">
                            <caption><span class="badge bgm-green">4.0</span> Outras Doenças Reportáveis</caption>
                            <thead>
                                <tr>
                                    <th>Ítem</th>
                                    <th>Jan</th>
                                    <th>Fev</th>
                                    <th>Mar</th>
                                    <th>Abr</th>
                                    <th>Mai</th>
                                    <th>Jun</th>
                                    <th>Jul</th>
                                    <th>Ago</th>
                                    <th>Set</th>
                                    <th>Out</th>
                                    <th>Nov</th>
                                    <th>Dez</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th><i class="badge bgm-lightgreen">4.1</i> Primeiros socorros</th>
                                    {% for key, value in dados %}
                                    {% if dados[key] == false %}
                                    <td>0</td>
                                    {% else %}
                                    {% if key == 'total'  %}
                                    {% for val in value['primeirosSocorros'] %}
                                    <th>{{ val }}</th>
                                    {% endfor %}
                                    {% else %}
                                    <td>{{ value.primeirosSocorros }}</td>
                                    {% endif %}
                                    {% endif %}
                                    {% endfor %}
                                </tr>
                                <tr>
                                    <th><i class="badge bgm-lightgreen">4.2</i> Incêndios</th>
                                    {% for key, value in dados %}
                                    {% if dados[key] == false %}
                                    <td>0</td>
                                    {% else %}
                                    {% if key == 'total'  %}
                                    {% for val in value['incendios'] %}
                                    <th>{{ val }}</th>
                                    {% endfor %}
                                    {% else %}
                                    <td>{{ value.incendios }}</td>
                                    {% endif %}
                                    {% endif %}
                                    {% endfor %}
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <br />

                    <div class="table-responsive">
                        <table class="table table-striped table-vmiddle bootgrid-table">
                            <caption><span class="badge bgm-green">5.0</span> Outras Doenças Reportáveis</caption>
                            <thead>
                                <tr>
                                    <th>Ítem</th>
                                    <th>Jan</th>
                                    <th>Fev</th>
                                    <th>Mar</th>
                                    <th>Abr</th>
                                    <th>Mai</th>
                                    <th>Jun</th>
                                    <th>Jul</th>
                                    <th>Ago</th>
                                    <th>Set</th>
                                    <th>Out</th>
                                    <th>Nov</th>
                                    <th>Dez</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th><i class="badge bgm-lightgreen">5.1</i> Quantitativo de profissionais pertencente ao SESMT</th>
                                    {% for key, value in dados %}
                                    {% if dados[key] == false %}
                                    <td>0</td>
                                    {% else %}
                                    {% if key == 'total'  %}
                                    {% for val in value['quantProfPertSesmt'] %}
                                    <th>{{ val }}</th>
                                    {% endfor %}
                                    {% else %}
                                    <td>{{ value.quantProfPertSesmt }}</td>
                                    {% endif %}
                                    {% endif %}
                                    {% endfor %}
                                </tr>
                                <tr>
                                    <th><i class="badge bgm-lightgreen">5.2</i> Membros do SESMT</th>
                                    {% for key, value in dados %}
                                    {% if dados[key] == false %}
                                    <td></td>
                                    {% else %}
                                    {% if key == 'total'  %}
                                    <th></th>
                                    {% else %}
                                    <td>{{ value.membros }}</td>
                                    {% endif %}
                                    {% endif %}
                                    {% endfor %}
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- /#saude_segurança -->
                <!-- #integrado -->
                <div class="tab-pane fade" id="integrado">

                    <div class="table-responsive">
                        <table class="table table-striped table-vmiddle bootgrid-table">
                            <caption><span class="badge bgm-green">6.0</span> Índices Pró-Ativos</caption>
                            <thead>
                                <tr>
                                    <th>Ítem</th>
                                    <th>Jan</th>
                                    <th>Fev</th>
                                    <th>Mar</th>
                                    <th>Abr</th>
                                    <th>Mai</th>
                                    <th>Jun</th>
                                    <th>Jul</th>
                                    <th>Ago</th>
                                    <th>Set</th>
                                    <th>Out</th>
                                    <th>Nov</th>
                                    <th>Dez</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th><i class="badge bgm-lightgreen">6.1</i> Total de HHT (Homem Hora Treinamento)</th>
                                    {% for key, value in dados %}
                                    {% if dados[key] == false %}
                                    <td>0</td>
                                    {% else %}
                                    {% if key == 'total'  %}
                                    {% for val in value['totalHht'] %}
                                    <th>{{ val }}</th>
                                    {% endfor %}
                                    {% else %}
                                    <td>{{ value.totalHht }}</td>
                                    {% endif %}
                                    {% endif %}
                                    {% endfor %}
                                </tr>
                                <tr>
                                    <th><i class="badge bgm-lightgreen">6.2</i> Percentual de Hh em Treinamento</th>
                                    {% for key, value in dados %}
                                    {% if dados[key] == false %}
                                    <td>0,00</td>
                                    {% else %}
                                    {% if key == 'total'  %}
                                    {% for val in value['percHhTrein'] %}
                                    <th>{{ number_format(val, 2, ',', '.') }}</th>
                                    {% endfor %}
                                    {% else %}
                                    <td>{{ value.percHhTrein }}</td>
                                    {% endif %}
                                    {% endif %}
                                    {% endfor %}
                                </tr>
                                <tr>
                                    <th><i class="badge bgm-lightgreen">6.3</i> Campanha de Conscientização de SMS</th>
                                    {% for key, value in dados %}
                                    {% if dados[key] == false %}
                                    <td>0</td>
                                    {% else %}
                                    {% if key == 'total'  %}
                                    {% for val in value['campConscSms'] %}
                                    <th>{{ val }}</th>
                                    {% endfor %}
                                    {% else %}
                                    <td>{{ value.campConscSms }}</td>
                                    {% endif %}
                                    {% endif %}
                                    {% endfor %}
                                </tr>
                                <tr>
                                    <th><i class="badge bgm-lightgreen">6.4</i> Número de Auditorias Comportamentais ou similar</th>
                                    {% for key, value in dados %}
                                    {% if dados[key] == false %}
                                    <td>0</td>
                                    {% else %}
                                    {% if key == 'total'  %}
                                    {% for val in value['nAudComp'] %}
                                    <th>{{ val }}</th>
                                    {% endfor %}
                                    {% else %}
                                    <td>{{ value.nAudComp }}</td>
                                    {% endif %}
                                    {% endif %}
                                    {% endfor %}
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <br />

                    <div class="table-responsive">
                        <table class="table table-striped table-vmiddle bootgrid-table">
                            <caption><span class="badge bgm-green">7.0</span> Ação Preventiva / Corretiva e não Conformidade</caption>
                            <thead>
                                <tr>
                                    <th>Ítem</th>
                                    <th>Jan</th>
                                    <th>Fev</th>
                                    <th>Mar</th>
                                    <th>Abr</th>
                                    <th>Mai</th>
                                    <th>Jun</th>
                                    <th>Jul</th>
                                    <th>Ago</th>
                                    <th>Set</th>
                                    <th>Out</th>
                                    <th>Nov</th>
                                    <th>Dez</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th><i class="badge bgm-lightgreen">7.1</i> Número de Ações Preventivas</th>
                                    {% for key, value in dados %}
                                    {% if dados[key] == false %}
                                    <td>0</td>
                                    {% else %}
                                    {% if key == 'total'  %}
                                    {% for val in value['nAcoesPrevent'] %}
                                    <th>{{ val }}</th>
                                    {% endfor %}
                                    {% else %}
                                    <td>{{ value.nAcoesPrevent }}</td>
                                    {% endif %}
                                    {% endif %}
                                    {% endfor %}
                                </tr>
                                <tr>
                                    <th><i class="badge bgm-lightgreen">7.2</i> Número de Ações Corretivas</th>
                                    {% for key, value in dados %}
                                    {% if dados[key] == false %}
                                    <td>0</td>
                                    {% else %}
                                    {% if key == 'total'  %}
                                    {% for val in value['nAcoesCorret'] %}
                                    <th>{{ val }}</th>
                                    {% endfor %}
                                    {% else %}
                                    <td>{{ value.nAcoesCorret }}</td>
                                    {% endif %}
                                    {% endif %}
                                    {% endfor %}
                                </tr>
                                <tr>
                                    <th><i class="badge bgm-lightgreen">7.3</i> Número de Não Conformidades</th>
                                    {% for key, value in dados %}
                                    {% if dados[key] == false %}
                                    <td>0</td>
                                    {% else %}
                                    {% if key == 'total'  %}
                                    {% for val in value['nNaoConform'] %}
                                    <th>{{ val }}</th>
                                    {% endfor %}
                                    {% else %}
                                    <td>{{ value.nNaoConform }}</td>
                                    {% endif %}
                                    {% endif %}
                                    {% endfor %}
                                </tr>
                            </tbody>
                        </table>
                    </div>

                </div>
                <!-- /#integrado -->
                <!-- #qualidade -->
                <div class="tab-pane fade" id="qualidade">

                    <div class="table-responsive">
                        <table class="table table-striped table-vmiddle bootgrid-table">
                            <caption><span class="badge bgm-green">8.0</span> Avaliação da Satisfação do Cliente</caption>
                            <thead>
                                <tr>
                                    <th>Ítem</th>
                                    <th>Jan</th>
                                    <th>Fev</th>
                                    <th>Mar</th>
                                    <th>Abr</th>
                                    <th>Mai</th>
                                    <th>Jun</th>
                                    <th>Jul</th>
                                    <th>Ago</th>
                                    <th>Set</th>
                                    <th>Out</th>
                                    <th>Nov</th>
                                    <th>Dez</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th><i class="badge bgm-lightgreen">8.1</i> Meta estabelecida avaliação da satisfação do cliente</th>
                                    {% for key, value in dados %}
                                    {% if dados[key] == false %}
                                    <td>0,00</td>
                                    {% else %}
                                    {% if key == 'total'  %}
                                    {% for val in value['metaEstabAvalSatisfCli'] %}
                                    <th>{{ number_format(val, 2, ',', '.') }} </th>
                                    {% endfor %}
                                    {% else %}
                                    <td>{{ value.metaEstabAvalSatisfCli }} {{ value.unMetaEstabAvalSatisfCli }}</td>
                                    {% endif %}
                                    {% endif %}
                                    {% endfor %}
                                </tr>
                                <tr>
                                    <th><i class="badge bgm-lightgreen">8.2</i> Resultado da avaliação da satisfação do cliente</th>
                                    {% for key, value in dados %}
                                    {% if dados[key] == false %}
                                    <td>0,00</td>
                                    {% else %}
                                    {% if key == 'total'  %}
                                    {% for val in value['resultAvalSatisfCli'] %}
                                    <th>{{ number_format(val, 2, ',', '.') }} </th>
                                    {% endfor %}
                                    {% else %}
                                    <td>{{ value.resultAvalSatisfCli }} {{ value.unResultAvalSatisfCli }}</td>
                                    {% endif %}
                                    {% endif %}
                                    {% endfor %}
                                </tr>
                                <tr>
                                    <th><i class="badge bgm-lightgreen">8.3</i> Número de reclamações apresentadas pelo cliente</th>
                                    {% for key, value in dados %}
                                    {% if dados[key] == false %}
                                    <td>0,00</td>
                                    {% else %}
                                    {% if key == 'total'  %}
                                    {% for val in value['nReclamApresCli'] %}
                                    <th>{{ val }} </th>
                                    {% endfor %}
                                    {% else %}
                                    <td>{{ value.nReclamApresCli }}</td>
                                    {% endif %}
                                    {% endif %}
                                    {% endfor %}
                                </tr>
                                <tr>
                                    <th><i class="badge bgm-lightgreen">8.4</i> Número de reclamações apresentadas pelo cliente atendidas</th>
                                    {% for key, value in dados %}
                                    {% if dados[key] == false %}
                                    <td>0,00</td>
                                    {% else %}
                                    {% if key == 'total'  %}
                                    {% for val in value['nReclamApresCliAtend'] %}
                                    <th>{{ val }} </th>
                                    {% endfor %}
                                    {% else %}
                                    <td>{{ value.nReclamApresCliAtend }}</td>
                                    {% endif %}
                                    {% endif %}
                                    {% endfor %}
                                </tr>
                            </tbody>
                        </table>
                    </div>

                </div>
                <!-- /#qualidade -->
                <!-- #meio_ambiente -->
                <div class="tab-pane fade" id="meio_ambiente">

                    <div class="table-responsive">
                        <table class="table table-striped table-vmiddle bootgrid-table">
                            <caption><span class="badge bgm-green">9.0</span> Resíduos Classe I (Perigosos)</caption>
                            <thead>
                                <tr>
                                    <th>Ítem</th>
                                    <th>Jan</th>
                                    <th>Fev</th>
                                    <th>Mar</th>
                                    <th>Abr</th>
                                    <th>Mai</th>
                                    <th>Jun</th>
                                    <th>Jul</th>
                                    <th>Ago</th>
                                    <th>Set</th>
                                    <th>Out</th>
                                    <th>Nov</th>
                                    <th>Dez</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th><i class="badge bgm-lightgreen">9.1</i> Lâmpadas</th>
                                    {% for key, value in dados %}
                                    {% if dados[key] == false %}
                                    <td>0</td>
                                    {% else %}
                                    {% if key == 'total'  %}
                                    {% for val in value['lampadas'] %}
                                    <th>{{ val }} </th>
                                    {% endfor %}
                                    {% else %}
                                    <td>{{ value.lampadas }}</td>
                                    {% endif %}
                                    {% endif %}
                                    {% endfor %}
                                </tr>
                                <tr>
                                    <th><i class="badge bgm-lightgreen">9.2</i> Resíduos de óleo</th>
                                    {% for key, value in dados %}
                                    {% if dados[key] == false %}
                                    <td>0,00</td>
                                    {% else %}
                                    {% if key == 'total'  %}
                                    {% for val in value['residOleo'] %}
                                    <th>{{ number_format(val, 2, ',', '.') }} </th>
                                    {% endfor %}
                                    {% else %}
                                    <td>{{ value.residOleo }}</td>
                                    {% endif %}
                                    {% endif %}
                                    {% endfor %}
                                </tr>
                                <tr>
                                    <th><i class="badge bgm-lightgreen">9.3</i> Residuos contaminados com óleo ou derivados</th>
                                    {% for key, value in dados %}
                                    {% if dados[key] == false %}
                                    <td>0,00</td>
                                    {% else %}
                                    {% if key == 'total'  %}
                                    {% for val in value['residContamOleoDerivados'] %}
                                    <th>{{ number_format(val, 2, ',', '.') }} </th>
                                    {% endfor %}
                                    {% else %}
                                    <td>{{ value.residContamOleoDerivados }} {{ value.unResidContamOleoDerivados }}</td>
                                    {% endif %}
                                    {% endif %}
                                    {% endfor %}
                                </tr>
                                <tr>
                                    <th><i class="badge bgm-lightgreen">9.4</i> Resíduos Eletro-Eletrônicos</th>
                                    {% for key, value in dados %}
                                    {% if dados[key] == false %}
                                    <td>0,00</td>
                                    {% else %}
                                    {% if key == 'total'  %}
                                    {% for val in value['residuosEletroEletronico'] %}
                                    <th>{{ number_format(val, 2, ',', '.') }} </th>
                                    {% endfor %}
                                    {% else %}
                                    <td>{{ value.residuosEletroEletronico }} {{ value.unResiduosEletroEletronico }}</td>
                                    {% endif %}
                                    {% endif %}
                                    {% endfor %}
                                </tr>
                                <tr>
                                    <th><i class="badge bgm-lightgreen">9.5</i> Resíduos de Emergências Ambientais</th>
                                    {% for key, value in dados %}
                                    {% if dados[key] == false %}
                                    <td>0,00</td>
                                    {% else %}
                                    {% if key == 'total'  %}
                                    {% for val in value['residuosEmergenciasAmbientais'] %}
                                    <th>{{ number_format(val, 2, ',', '.') }} </th>
                                    {% endfor %}
                                    {% else %}
                                    <td>{{ value.residuosEmergenciasAmbientais }} {{ value.unResiduosEmergenciasAmbientais }}</td>
                                    {% endif %}
                                    {% endif %}
                                    {% endfor %}
                                </tr>
                                <tr>
                                    <th><i class="badge bgm-lightgreen">9.6</i> Outros resíduos perigoso (Tipo e Volume)</th>
                                    {% for key, value in dados %}
                                    {% if dados[key] == false %}
                                    <td></td>
                                    {% else %}
                                    {% if key == 'total'  %}
                                    <th> </th>
                                    {% else %}
                                    <td>{{ value.outResidPerig }}</td>
                                    {% endif %}
                                    {% endif %}
                                    {% endfor %}
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <br />

                    <div class="table-responsive">
                        <table class="table table-striped table-vmiddle bootgrid-table">
                            <caption><span class="badge bgm-green">10.0</span> Resíduos Classe II A (Não inerte)</caption>
                            <thead>
                                <tr>
                                    <th>Ítem</th>
                                    <th>Jan</th>
                                    <th>Fev</th>
                                    <th>Mar</th>
                                    <th>Abr</th>
                                    <th>Mai</th>
                                    <th>Jun</th>
                                    <th>Jul</th>
                                    <th>Ago</th>
                                    <th>Set</th>
                                    <th>Out</th>
                                    <th>Nov</th>
                                    <th>Dez</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th><i class="badge bgm-lightgreen">10.1</i> Total de Resíduos de Papel</th>
                                    {% for key, value in dados %}
                                    {% if dados[key] == false %}
                                    <td>0,00</td>
                                    {% else %}
                                    {% if key == 'total'  %}
                                    {% for val in value['totalResidPapel'] %}
                                    <th>{{ number_format(val, 2, ',', '.') }} </th>
                                    {% endfor %}
                                    {% else %}
                                    <td>{{ value.totalResidPapel }} {{ value.unTotalResidPapel }}</td>
                                    {% endif %}
                                    {% endif %}
                                    {% endfor %}
                                </tr>
                                <tr>
                                    <th><i class="badge bgm-lightgreen">10.2</i> Total de Resíduos de Madeira</th>
                                    {% for key, value in dados %}
                                    {% if dados[key] == false %}
                                    <td>0,00</td>
                                    {% else %}
                                    {% if key == 'total'  %}
                                    {% for val in value['totalResidMadeira'] %}
                                    <th>{{ number_format(val, 2, ',', '.') }} </th>
                                    {% endfor %}
                                    {% else %}
                                    <td>{{ value.totalResidMadeira }} {{ value.unTotalResidMadeira }}</td>
                                    {% endif %}
                                    {% endif %}
                                    {% endfor %}
                                </tr>
                                <tr>
                                    <th><i class="badge bgm-lightgreen">10.3</i> Total de Resíduos não recicláveis</th>
                                    {% for key, value in dados %}
                                    {% if dados[key] == false %}
                                    <td>0,00</td>
                                    {% else %}
                                    {% if key == 'total'  %}
                                    {% for val in value['totalResidNaoRecicl'] %}
                                    <th>{{ number_format(val, 2, ',', '.') }} </th>
                                    {% endfor %}
                                    {% else %}
                                    <td>{{ value.totalResidNaoRecicl }} {{ value.unTotalResidNaoRecicl }}</td>
                                    {% endif %}
                                    {% endif %}
                                    {% endfor %}
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <br />

                    <div class="table-responsive">
                        <table class="table table-striped table-vmiddle bootgrid-table">
                            <caption><span class="badge bgm-green">11.0</span> Resíduos Classe II B (Inerte)</caption>
                            <thead>
                                <tr>
                                    <th>Ítem</th>
                                    <th>Jan</th>
                                    <th>Fev</th>
                                    <th>Mar</th>
                                    <th>Abr</th>
                                    <th>Mai</th>
                                    <th>Jun</th>
                                    <th>Jul</th>
                                    <th>Ago</th>
                                    <th>Set</th>
                                    <th>Out</th>
                                    <th>Nov</th>
                                    <th>Dez</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th><i class="badge bgm-lightgreen">11.1</i> Total de Resíduos de Plástico</th>
                                    {% for key, value in dados %}
                                    {% if dados[key] == false %}
                                    <td>0,00</td>
                                    {% else %}
                                    {% if key == 'total'  %}
                                    {% for val in value['totalResidPlastico'] %}
                                    <th>{{ number_format(val, 2, ',', '.') }} </th>
                                    {% endfor %}
                                    {% else %}
                                    <td>{{ value.totalResidPlastico }} {{ value.unTotalResidPlastico }}</td>
                                    {% endif %}
                                    {% endif %}
                                    {% endfor %}
                                </tr>
                                <tr>
                                    <th><i class="badge bgm-lightgreen">11.2</i> Total de Resíduos de Metal</th>
                                    {% for key, value in dados %}
                                    {% if dados[key] == false %}
                                    <td>0,00</td>
                                    {% else %}
                                    {% if key == 'total'  %}
                                    {% for val in value['totalResidMetal'] %}
                                    <th>{{ number_format(val, 2, ',', '.') }} </th>
                                    {% endfor %}
                                    {% else %}
                                    <td>{{ value.totalResidMetal }} {{ value.unTotalResidMetal }}</td>
                                    {% endif %}
                                    {% endif %}
                                    {% endfor %}
                                </tr>
                                <tr>
                                    <th><i class="badge bgm-lightgreen">11.3</i> Total de Resíduos de Vidro</th>
                                    {% for key, value in dados %}
                                    {% if dados[key] == false %}
                                    <td>0,00</td>
                                    {% else %}
                                    {% if key == 'total'  %}
                                    {% for val in value['totalResidVidro'] %}
                                    <th>{{ number_format(val, 2, ',', '.') }} </th>
                                    {% endfor %}
                                    {% else %}
                                    <td>{{ value.totalResidVidro }} {{ value.unTotalResidVidro }}</td>
                                    {% endif %}
                                    {% endif %}
                                    {% endfor %}
                                </tr>
                                <tr>
                                    <th><i class="badge bgm-lightgreen">11.4</i> Resíduos da construção civil</th>
                                    {% for key, value in dados %}
                                    {% if dados[key] == false %}
                                    <td>0,00</td>
                                    {% else %}
                                    {% if key == 'total'  %}
                                    {% for val in value['residConstrucaoCivil'] %}
                                    <th>{{ number_format(val, 2, ',', '.') }} </th>
                                    {% endfor %}
                                    {% else %}
                                    <td>{{ value.residConstrucaoCivil }} {{ value.unResidConstrucaoCivil }}</td>
                                    {% endif %}
                                    {% endif %}
                                    {% endfor %}
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <br />

                    <div class="table-responsive">
                        <table class="table table-striped table-vmiddle bootgrid-table">
                            <caption><span class="badge bgm-green">12.0</span> Situações de emergência</caption>
                            <thead>
                                <tr>
                                    <th>Ítem</th>
                                    <th>Jan</th>
                                    <th>Fev</th>
                                    <th>Mar</th>
                                    <th>Abr</th>
                                    <th>Mai</th>
                                    <th>Jun</th>
                                    <th>Jul</th>
                                    <th>Ago</th>
                                    <th>Set</th>
                                    <th>Out</th>
                                    <th>Nov</th>
                                    <th>Dez</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th><i class="badge bgm-lightgreen">12.1</i> Vazamentos de gases</th>
                                    {% for key, value in dados %}
                                    {% if dados[key] == false %}
                                    <td>0,00</td>
                                    {% else %}
                                    {% if key == 'total'  %}
                                    {% for val in value['vazamGas'] %}
                                    <th>{{ number_format(val, 2, ',', '.') }} </th>
                                    {% endfor %}
                                    {% else %}
                                    <td>{{ value.vazamGas }} {{ value.unVazamGas }}</td>
                                    {% endif %}
                                    {% endif %}
                                    {% endfor %}
                                </tr>
                                <tr>
                                    <th><i class="badge bgm-lightgreen">12.2</i> Vazamentos de resíduos oleosos</th>
                                    {% for key, value in dados %}
                                    {% if dados[key] == false %}
                                    <td>0,00</td>
                                    {% else %}
                                    {% if key == 'total'  %}
                                    {% for val in value['vazamResidOleoso'] %}
                                    <th>{{ number_format(val, 2, ',', '.') }} </th>
                                    {% endfor %}
                                    {% else %}
                                    <td>{{ value.vazamResidOleoso }} {{ value.unVazamResidOleoso }}</td>
                                    {% endif %}
                                    {% endif %}
                                    {% endfor %}
                                </tr>
                                <tr>
                                    <th><i class="badge bgm-lightgreen">11.3</i> Total de Resíduos de Vidro</th>
                                    {% for key, value in dados %}
                                    {% if dados[key] == false %}
                                    <td>0,00</td>
                                    {% else %}
                                    {% if key == 'total'  %}
                                    {% for val in value['totalResidVidro'] %}
                                    <th>{{ number_format(val, 2, ',', '.') }} </th>
                                    {% endfor %}
                                    {% else %}
                                    <td>{{ value.totalResidVidro }} {{ value.unTotalResidVidro }}</td>
                                    {% endif %}
                                    {% endif %}
                                    {% endfor %}
                                </tr>
                            </tbody>
                        </table>
                    </div>

                </div>
                <!-- /#meio_ambiente -->
                <!-- #geral -->
                <div class="tab-pane fade in" id="geral">

                    <div class="table-responsive">
                        <table class="table table-striped table-vmiddle bootgrid-table">
                            <caption><span class="badge bgm-green">13.0</span> Observações</caption>
                            <thead>
                                <tr>
                                    <th>Meses</th>
                                    <th><i class="badge bgm-lightgreen">13.1</i> Observações</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th>Jan</th>
                                    <td>
                                        {% if dados[1] != false %}
                                        {{ dados[1].obs }}
                                        {% endif %}
                                    </td>
                                </tr>
                                <tr>
                                    <th>Fev</th>
                                    <td>
                                        {% if dados[2] != false %}
                                        {{ dados[2].obs }}
                                        {% endif %}
                                    </td>
                                </tr>
                                <tr>
                                    <th>Mar</th>
                                    <td>
                                        {% if dados[3] != false %}
                                        {{ dados[3].obs }}
                                        {% endif %}
                                    </td>
                                </tr>
                                <tr>
                                    <th>Abr</th>
                                    <td>
                                        {% if dados[4] != false %}
                                        {{ dados[4].obs }}
                                        {% endif %}
                                    </td>
                                </tr>
                                <tr>
                                    <th>Mai</th>
                                    <td>
                                        {% if dados[5] != false %}
                                        {{ dados[5].obs }}
                                        {% endif %}
                                    </td>
                                </tr>
                                <tr>
                                    <th>Jun</th>
                                    <td>
                                        {% if dados[6] != false %}
                                        {{ dados[6].obs }}
                                        {% endif %}
                                    </td>
                                </tr>
                                <tr>
                                    <th>Jul</th>
                                    <td>
                                        {% if dados[7] != false %}
                                        {{ dados[7].obs }}
                                        {% endif %}
                                    </td>
                                </tr>
                                <tr>
                                    <th>Ago</th>
                                    <td>
                                        {% if dados[8] != false %}
                                        {{ dados[8].obs }}
                                        {% endif %}
                                    </td>
                                </tr>
                                <tr>
                                    <th>Set</th>
                                    <td>
                                        {% if dados[9] != false %}
                                        {{ dados[9].obs }}
                                        {% endif %}
                                    </td>
                                </tr>
                                <tr>
                                    <th>Out</th>
                                    <td>
                                        {% if dados[10] != false %}
                                        {{ dados[10].obs }}
                                        {% endif %}
                                    </td>
                                </tr>
                                <tr>
                                    <th>Nov</th>
                                    <td>
                                        {% if dados[11] != false %}
                                        {{ dados[11].obs }}
                                        {% endif %}
                                    </td>
                                </tr>
                                <tr>
                                    <th>Dez</th>
                                    <td>
                                        {% if dados[12] != false %}
                                        {{ dados[12].obs }}
                                        {% endif %}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                </div>
                <!-- /#geral -->

            </div>
        </div>
    </div>
    {% endif %}
</div>