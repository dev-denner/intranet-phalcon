{{ content() }}

<div class="card">
    <div class="card-header">
        <h2>Indicadores do SGI <small>Preencha as informações divididas por assunto clicando nas abas.</small></h2>
    </div>

    <div class="card-body card-padding">
        <div class="form-wizard-basic fw-container">
            {{ form("forms/indicadores_sgi/create", "method":"post", "autocomplete" : "off", 'onsubmit': 'overlay(true)') }}
            <div class="row">
                <div class="col-sm-3 m-b-20">
                    <div class="form-group fg-line">
                        <label>Competência <span class="text-danger">*</span></label>
                        {{ text_field("comp", "class" : "form-control monthPicker fg-input fc-alt", 'placeholder': 'Competência', 'required': 'required') }}
                    </div>
                </div>
                <div class="col-sm-3 m-b-20">
                    <div class="form-group fg-line">
                        <label>Centro de Custo <span class="text-danger">*</span></label>
                        <?php
                        $userId = $auth_identity->userId;
                        $search = "nomeFormulario = 'Indicadores SGI' AND userId = '{$userId}'";
                        echo $this->tag->select(['cc',
                            App\Modules\Forms\Models\GestaoAcesso::find($search),
                            'using' => ['amarracao', 'amarracao'],
                            'useEmpty' => true,
                            'emptyText' => 'Escolha uma opção',
                            'emptyValue' => '',
                            'class' => 'form-control fg-input fc-alt',
                            'required' => 'required'
                        ]);
                        ?>
                    </div>
                </div>
                <div class="col-sm-3 m-b-20">
                    <p class="centro_custo m-t-25 f-14"></p>
                </div>
            </div>
            <ul class="tab-nav text-center fw-nav" role="tablist" data-tab-color="teal">
                <li class="active"><a href="#saude_segurança" data-toggle="tab" aria-expanded="true">Saúde e Segurança</a></li>
                <li class=""><a href="#integrado" data-toggle="tab" aria-expanded="false">Integrado</a></li>
                <li class=""><a href="#qualidade" data-toggle="tab" aria-expanded="false">Qualidade</a></li>
                <li class=""><a href="#meio_ambiente" data-toggle="tab" aria-expanded="false">Meio Ambiente</a></li>
                <li class=""><a href="#geral" data-toggle="tab" aria-expanded="false">Geral</a></li>
            </ul>

            {{ hidden_field("cpf", 'required': 'required', 'value': auth_identity.cpf) }}

            <div class="tab-content">
                <!-- #saude_segurança -->
                <div class="tab-pane fade active in" id="saude_segurança">

                    <fieldset class="well well-alt">
                        <legend><span class="badge bgm-green">1.0</span> Horas Trabalhadas</legend>
                        <div class="row">
                            <div class="col-lg-5">
                                <!-- nEmpregados -->
                                <div class="form-group fg-line">
                                    <label><i class="badge bgm-lightgreen">1.1</i> Número de Empregados</label>
                                    {{ text_field("nEmpregados", "class" : "form-control fg-input fc-alt onlyNumber", 'placeholder': 'Número') }}
                                </div>
                                <br />
                                <!-- /nEmpregados -->
                                <!-- nEmpregadosTerc -->
                                <div class="form-group fg-line">
                                    <label><i class="badge bgm-lightgreen">1.2</i> Número de Empregados Terceirizados</label>
                                    {{ text_field("nEmpregadosTerc", "class" : "form-control fg-input fc-alt onlyNumber", 'placeholder': 'Número') }}
                                </div>
                                <br />
                                <!-- /nEmpregadosTerc -->
                                <!-- hher -->
                                <div class="form-group fg-line">
                                    <label><i class="badge bgm-lightgreen">1.3</i> Homens Hora Exposição ao Risco (HHER)</label>
                                    {{ text_field("hher", "class" : "form-control fg-input fc-alt onlyFloatWithDot", 'placeholder': 'Horas') }}
                                </div>
                                <br />
                                <!-- /hher -->
                            </div>
                            <div class="col-lg-5 col-lg-offset-2">
                                <!-- hherTerc -->
                                <div class="form-group fg-line">
                                    <label><i class="badge bgm-lightgreen">1.4</i> Homens Hora Exposição ao Risco (HHER) - Terceiros</label>
                                    {{ text_field("hherTerc", "class" : "form-control fg-input fc-alt onlyFloatWithDot", 'placeholder': 'Horas') }}
                                </div>
                                <br />
                                <!-- /hherTerc -->
                                <!-- hherTotal -->
                                <div class="form-group fg-line">
                                    <label><i class="badge bgm-lightgreen">1.5</i> Total de Homens Horas de Exposição ao Risco (HHER)</label>
                                    {{ text_field("hherTotal", "class" : "form-control fg-input fc-alt onlyFloatWithDot", 'placeholder': 'Horas', "readonly": "readonly") }}
                                </div>
                                <p class="help-block">(1.3 + 1.4)</p>
                                <br />
                                <!-- /hherTotal -->
                                <!-- hherTotalAno -->
                                <div class="form-group fg-line">
                                    <label><i class="badge bgm-lightgreen">1.6</i> Total de Horas Acumuladas no ano</label>
                                    {{ text_field("hherTotalAno", "class" : "form-control fg-input fc-alt onlyFloatWithDot", 'placeholder': 'Horas', "readonly": "readonly") }}
                                </div>
                                <br />
                                <!-- /hherTotalAno -->
                            </div>
                        </div>
                    </fieldset>
                    <br />
                    <fieldset class="well well-alt">
                        <legend><span class="badge bgm-green">2.0</span> Incidentes Reportáveis</legend>
                        <div class="row">
                            <div class="col-lg-5">
                                <!-- acidComAfast -->
                                <div class="form-group fg-line">
                                    <label><i class="badge bgm-lightgreen">2.1</i> Número de acidentes com afastamento (Típicos)</label>
                                    {{ text_field("acidComAfast", "class" : "form-control fg-input fc-alt onlyNumber", 'placeholder': 'Número') }}
                                </div>
                                <br />
                                <!-- /acidComAfast -->
                                <!-- acidComAfastDiasPerd -->
                                <div class="form-group fg-line">
                                    <label><i class="badge bgm-lightgreen">2.2</i> Número de dias perdidos por acidentes com afastamento (Típicos)</label>
                                    {{ text_field("acidComAfastDiasPerd", "class" : "form-control fg-input fc-alt onlyNumber", 'placeholder': 'Número') }}
                                </div>
                                <br />
                                <!-- /acidComAfastDiasPerd -->
                                <!-- acidComAfastDiasDebit -->
                                <div class="form-group fg-line">
                                    <label><i class="badge bgm-lightgreen">2.3</i> Número de dias debitados por acidentes com afastamento (Típicos)</label>
                                    {{ text_field("acidComAfastDiasDebit", "class" : "form-control fg-input fc-alt onlyNumber", 'placeholder': 'Número') }}
                                </div>
                                <br />
                                <!-- /acidComAfastDiasDebit -->
                                <!-- tfca -->
                                <div class="form-group fg-line">
                                    <label><i class="badge bgm-lightgreen">2.4</i> TFCA - Taxa de Frequência de Acidentes com Afastamento - Acumulada (Acidentes Típicos)</label>
                                    {{ text_field("tfcaMes", "class" : "form-control fg-input fc-alt onlyFloatWithDot", "readonly": "readonly") }}
                                    <label>Acumulado TFCA</label>
                                    {{ text_field("tfca", "class" : "form-control fg-input fc-alt onlyFloatWithDot", "readonly": "readonly") }}
                                </div>
                                <p class="help-block">(2.1 x 10<sup>6</sup> ) / 1.5</p>
                                <br />
                                <!-- /tfca -->
                                <!-- txGravAcum -->
                                <div class="form-group fg-line">
                                    <label><i class="badge bgm-lightgreen">2.5</i> TG - Taxa de Gravidade</label>
                                    {{ text_field("txGravAcumMes", "class" : "form-control fg-input fc-alt onlyNumber", "readonly": "readonly") }}
                                    <label>Acumulado TG</label>
                                    {{ text_field("txGravAcum", "class" : "form-control fg-input fc-alt onlyNumber", "readonly": "readonly") }}
                                </div>
                                <p class="help-block">((2.2 + 2.3) x 10<sup>6</sup> ) / 1.5</p>
                                <br />
                                <!-- /txGravAcum -->
                                <!-- nAcidSemAfast -->
                                <div class="form-group fg-line">
                                    <label><i class="badge bgm-lightgreen">2.6</i> Número de acidentes sem afastamento (Típicos)</label>
                                    {{ text_field("nAcidSemAfast", "class" : "form-control fg-input fc-alt onlyNumber", 'placeholder': 'Número') }}
                                </div>
                                <br />
                                <!-- /nAcidSemAfast -->
                                <!-- tfsa -->
                                <div class="form-group fg-line">
                                    <label><i class="badge bgm-lightgreen">2.7</i> TFSA - Taxa de Frequência de Acidentes sem Afastamento</label>
                                    {{ text_field("tfsaMes", "class" : "form-control fg-input fc-alt onlyFloatWithDot", "readonly": "readonly") }}
                                    <label>Acumulado TFSA</label>
                                    {{ text_field("tfsa", "class" : "form-control fg-input fc-alt onlyFloatWithDot", "readonly": "readonly") }}
                                </div>
                                <p class="help-block">(2.6 x 10<sup>6</sup> ) / 1.5</p>
                                <br />
                                <!-- /tfsa -->
                            </div>
                            <div class="col-lg-5 col-lg-offset-2">
                                <!-- tor -->
                                <div class="form-group fg-line">
                                    <label><i class="badge bgm-lightgreen">2.8</i> TOR - Taxa de Ocorrências Registráveis</label>
                                    {{ text_field("torMes", "class" : "form-control fg-input fc-alt onlyFloatWithDot", "readonly": "readonly") }}
                                    <label>Acumulado TOR</label>
                                    {{ text_field("tor", "class" : "form-control fg-input fc-alt onlyFloatWithDot", "readonly": "readonly") }}
                                </div>
                                <p class="help-block">((2.1 + 2.6) x 10<sup>6</sup> ) / 1.5</p>
                                <br />
                                <!-- /tor -->
                                <!-- nQuaseAcid -->
                                <div class="form-group fg-line">
                                    <label><i class="badge bgm-lightgreen">2.9</i> Número de Quase acidentes </label>
                                    {{ text_field("nQuaseAcid", "class" : "form-control fg-input fc-alt onlyNumber", 'placeholder': 'Número') }}
                                </div>
                                <br />
                                <!-- /nQuaseAcid -->
                                <!-- nDesvio -->
                                <div class="form-group fg-line">
                                    <label><i class="badge bgm-lightgreen">2.10</i> Número de desvios</label>
                                    {{ text_field("nDesvio", "class" : "form-control fg-input fc-alt onlyNumber", 'placeholder': 'Número') }}
                                </div>
                                <br />
                                <!-- /nDesvio -->
                                <!-- nAcidTrajSemAfast -->
                                <div class="form-group fg-line">
                                    <label><i class="badge bgm-lightgreen">2.11</i> Número de acidentes sem afastamento (Acidentes de Trajeto)</label>
                                    {{ text_field("nAcidTrajSemAfast", "class" : "form-control fg-input fc-alt onlyNumber", 'placeholder': 'Número') }}
                                </div>
                                <br />
                                <!-- /nAcidTrajSemAfast -->
                                <!-- nAcidTrajComAfast -->
                                <div class="form-group fg-line">
                                    <label><i class="badge bgm-lightgreen">2.12</i> Número de acidentes com afastamento (Acidentes de Trajeto)</label>
                                    {{ text_field("nAcidTrajComAfast", "class" : "form-control fg-input fc-alt onlyNumber", 'placeholder': 'Número') }}
                                </div>
                                <br />
                                <!-- /nAcidTrajComAfast -->
                                <!-- nDiasPerdAcidTrajComAfast -->
                                <div class="form-group fg-line">
                                    <label><i class="badge bgm-lightgreen">2.13</i> Número de dias perdidos por acidentes de trajeto com afastamento</label>
                                    {{ text_field("nDiasPerdAcidTrajComAfast", "class" : "form-control fg-input fc-alt onlyNumber", 'placeholder': 'Número') }}
                                </div>
                                <br />
                                <!-- /nDiasPerdAcidTrajComAfast -->
                            </div>
                        </div>
                    </fieldset>
                    <br />
                    <fieldset class="well well-alt">
                        <legend><span class="badge bgm-green">3.0</span> Doenças Ocupacionais</legend>
                        <div class="row">
                            <div class="col-lg-5">

                                <!-- nCasosDoencasOcup -->
                                <div class="form-group fg-line">
                                    <label><i class="badge bgm-lightgreen">3.1</i> Número de casos de doenças ocupacionais</label>
                                    {{ text_field("nCasosDoencasOcup", "class" : "form-control fg-input fc-alt onlyNumber", 'placeholder': 'Número') }}
                                </div>
                                <br />
                                <!-- /nCasosDoencasOcup -->
                            </div>
                            <div class="col-lg-5 col-lg-offset-2">
                                <!-- nDiasPerdDoencas -->
                                <div class="form-group fg-line">
                                    <label><i class="badge bgm-lightgreen">3.2</i> Número de dias perdidos por doenças</label>
                                    {{ text_field("nDiasPerdDoencas", "class" : "form-control fg-input fc-alt onlyNumber", 'placeholder': 'Número') }}
                                </div>
                                <br />
                                <!-- /nDiasPerdDoencas -->
                            </div>
                        </div>
                    </fieldset>
                    <br />
                    <fieldset class="well well-alt">
                        <legend><span class="badge bgm-green">4.0</span> Outras Doenças Reportáveis</legend>
                        <div class="row">
                            <div class="col-lg-5">

                                <!-- primeirosSocorros -->
                                <div class="form-group fg-line">
                                    <label><i class="badge bgm-lightgreen">4.1</i> Primeiros socorros</label>
                                    {{ text_field("primeirosSocorros", "class" : "form-control fg-input fc-alt onlyNumber", 'placeholder': 'Número') }}
                                </div>
                                <br />
                                <!-- /primeirosSocorros -->
                            </div>
                            <div class="col-lg-5 col-lg-offset-2">
                                <!-- incendios -->
                                <div class="form-group fg-line">
                                    <label><i class="badge bgm-lightgreen">4.2</i> Incêndios</label>
                                    {{ text_field("incendios", "class" : "form-control fg-input fc-alt onlyNumber", 'placeholder': 'Número') }}
                                </div>
                                <br />
                                <!-- /incendios -->
                            </div>
                        </div>
                    </fieldset>
                    <br />
                    <fieldset class="well well-alt">
                        <legend><span class="badge bgm-green">5.0</span> Outras Doenças Reportáveis</legend>
                        <div class="row">
                            <div class="col-lg-5">

                                <!-- quantProfPertSesmt -->
                                <div class="form-group fg-line">
                                    <label><i class="badge bgm-lightgreen">5.1</i> Quantitativo de profissionais pertencente ao SESMT</label>
                                    {{ text_field("quantProfPertSesmt", "class" : "form-control fg-input fc-alt onlyNumber", 'placeholder': 'Número') }}
                                </div>
                                <p class="help-block">Informar no campo "Membros do SESMT" o nome e matricula dos Profissionais.</p>
                                <br />
                                <!-- /quantProfPertSesmt -->
                            </div>
                            <div class="col-lg-7">
                                <!-- membros -->
                                <div class="form-group fg-line">
                                    <label><i class="badge bgm-lightgreen">5.2</i> Membros do SESMT</label>
                                    {{ text_area("membros", "class" : "form-control fg-input fc-alt", 'rows': 5) }}
                                </div>
                                <br />
                                <!-- /membros -->
                            </div>
                        </div>
                    </fieldset>

                </div>
                <!-- /#saude_segurança -->
                <!-- #integrado -->
                <div class="tab-pane fade" id="integrado">

                    <fieldset class="well well-alt">
                        <legend><span class="badge bgm-green">6.0</span> Índices Pró-Ativos</legend>
                        <div class="row">
                            <div class="col-lg-5">
                                <!-- totalHht -->
                                <div class="form-group fg-line">
                                    <label><i class="badge bgm-lightgreen">6.1</i> Total de HHT (Homem Hora Treinamento)</label>
                                    {{ text_field("totalHht", "class" : "form-control fg-input fc-alt onlyNumber", 'placeholder': 'Número') }}
                                </div>
                                <br />
                                <!-- /totalHht -->
                                <!-- percHhTrein -->
                                <div class="form-group fg-line">
                                    <label><i class="badge bgm-lightgreen">6.2</i> Percentual de Hh em Treinamento</label>
                                    {{ text_field("percHhTrein", "class" : "form-control fg-input fc-alt onlyNumber", 'placeholder': 'Número', "readonly": "readonly") }}
                                </div>
                                <p class="help-block">%</p>
                                <br />
                                <!-- /percHhTrein -->
                            </div>
                            <div class="col-lg-5 col-lg-offset-2">
                                <!-- campConscSms -->
                                <div class="form-group fg-line">
                                    <label><i class="badge bgm-lightgreen">6.3</i> Campanha de Conscientização de SMS</label>
                                    {{ text_field("campConscSms", "class" : "form-control fg-input fc-alt onlyNumber", 'placeholder': 'Número') }}
                                </div>
                                <br />
                                <!-- /campConscSms -->
                                <!-- nAudComp -->
                                <div class="form-group fg-line">
                                    <label><i class="badge bgm-lightgreen">6.4</i> Número de Auditorias Comportamentais ou similar</label>
                                    {{ text_field("nAudComp", "class" : "form-control fg-input fc-alt onlyNumber", 'placeholder': 'Número') }}
                                </div>
                                <br />
                                <!-- /nAudComp -->
                            </div>
                        </div>
                    </fieldset>
                    <br />
                    <fieldset class="well well-alt">
                        <legend><span class="badge bgm-green">7.0</span> Ação Preventiva / Corretiva e não Conformidade</legend>
                        <div class="row">
                            <div class="col-lg-5">
                                <!-- nAcoesPrevent -->
                                <div class="form-group fg-line">
                                    <label><i class="badge bgm-lightgreen">7.1</i> Número de Ações Preventivas</label>
                                    {{ text_field("nAcoesPrevent", "class" : "form-control fg-input fc-alt onlyNumber", 'placeholder': 'Número') }}
                                </div>
                                <br />
                                <!-- /nAcoesPrevent -->
                                <!-- nAcoesCorret -->
                                <div class="form-group fg-line">
                                    <label><i class="badge bgm-lightgreen">7.2</i> Número de Ações Corretivas</label>
                                    {{ text_field("nAcoesCorret", "class" : "form-control fg-input fc-alt onlyNumber", 'placeholder': 'Número') }}
                                </div>
                                <br />
                                <!-- /nAcoesCorret -->
                            </div>
                            <div class="col-lg-5 col-lg-offset-2">
                                <!-- nNaoConform -->
                                <div class="form-group fg-line">
                                    <label><i class="badge bgm-lightgreen">7.3</i> Número de Não Conformidades</label>
                                    {{ text_field("nNaoConform", "class" : "form-control fg-input fc-alt onlyNumber", 'placeholder': 'Número') }}
                                </div>
                                <br />
                                <!-- /nNaoConform -->
                            </div>
                        </div>
                    </fieldset>

                </div>
                <!-- /#integrado -->
                <!-- #qualidade -->
                <div class="tab-pane fade" id="qualidade">
                    <fieldset class="well well-alt">
                        <legend><span class="badge bgm-green">8.0</span> Avaliação da Satisfação do Cliente</legend>
                        <div class="row">
                            <div class="col-lg-5">
                                <!-- metaEstabAvalSatisfCli -->
                                <div class="form-group clearfix">
                                    <label><i class="badge bgm-lightgreen">8.1</i> Meta estabelecida avaliação da satisfação do cliente</label>
                                    <div class="row">
                                        <div class="col-sm-8">
                                            <div class="fg-line">
                                                {{ text_field("metaEstabAvalSatisfCli", "class" : "form-control fg-input fc-alt onlyFloatWithDot", 'placeholder': 'Número') }}
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <?php
                                            echo $this->tag->select(['unMetaEstabAvalSatisfCli',
                                                \App\Modules\Nucleo\Models\TablesSystem::find("table = 'medida1'"),
                                                'using' => ['code', 'value'],
                                                'class' => 'form-control fg-input fc-alt',
                                            ]);
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                <br />
                                <!-- /metaEstabAvalSatisfCli -->
                                <!-- resultAvalSatisfCli -->
                                <div class="form-group clearfix">
                                    <label><i class="badge bgm-lightgreen">8.2</i> Resultado da avaliação da satisfação do cliente</label>
                                    <div class="row">
                                        <div class="col-sm-8">
                                            <div class="fg-line">
                                                {{ text_field("resultAvalSatisfCli", "class" : "form-control fg-input fc-alt onlyFloatWithDot", 'placeholder': 'Número') }}
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <?php
                                            echo $this->tag->select(['unResultAvalSatisfCli',
                                                \App\Modules\Nucleo\Models\TablesSystem::find("table = 'medida1'"),
                                                'using' => ['code', 'value'],
                                                'class' => 'form-control fg-input fc-alt',
                                            ]);
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                <br />
                                <!-- /resultAvalSatisfCli -->
                            </div>
                            <div class="col-lg-5 col-lg-offset-2">
                                <!-- nReclamApresCli -->
                                <div class="form-group fg-line">
                                    <label><i class="badge bgm-lightgreen">8.3</i> Número de reclamações apresentadas pelo cliente</label>
                                    {{ text_field("nReclamApresCli", "class" : "form-control fg-input fc-alt onlyNumber", 'placeholder': 'Número') }}
                                </div>
                                <br />
                                <!-- /nReclamApresCli -->
                                <!-- nAudComp -->
                                <div class="form-group fg-line">
                                    <label><i class="badge bgm-lightgreen">8.4</i> Número de reclamações apresentadas pelo cliente atendidas</label>
                                    {{ text_field("nReclamApresCliAtend", "class" : "form-control fg-input fc-alt onlyNumber", 'placeholder': 'Número') }}
                                </div>
                                <br />
                                <!-- /nAudComp -->
                            </div>
                        </div>
                    </fieldset>

                </div>
                <!-- /#qualidade -->
                <!-- #meio_ambiente -->
                <div class="tab-pane fade" id="meio_ambiente">

                    <fieldset class="well well-alt">
                        <legend><span class="badge bgm-green">9.0</span> Resíduos Classe I (Perigosos)</legend>
                        <div class="row">
                            <div class="col-lg-5">

                                <!-- lampadas -->
                                <div class="form-group fg-line">
                                    <label><i class="badge bgm-lightgreen">9.1</i> Lâmpadas</label>
                                    {{ text_field("lampadas", "class" : "form-control fg-input fc-alt onlyNumber", 'placeholder': 'Unidade') }}
                                </div>
                                <br />
                                <!-- /lampadas -->
                                <!-- residOleo -->
                                <div class="form-group fg-line">
                                    <label><i class="badge bgm-lightgreen">9.2</i> Resíduos de óleo</label>
                                    {{ text_field("residOleo", "class" : "form-control fg-input fc-alt onlyFloatWithDot", 'placeholder': 'Litros') }}
                                </div>
                                <br />
                                <!-- /residOleo -->
                                <!-- residContamOleoDerivados -->
                                <div class="form-group clearfix">
                                    <label><i class="badge bgm-lightgreen">9.3</i> Residuos contaminados com óleo ou derivados</label>
                                    <div class="row">
                                        <div class="col-sm-8">
                                            <div class="fg-line">
                                                {{ text_field("residContamOleoDerivados", "class" : "form-control fg-input fc-alt onlyFloatWithDot", 'placeholder': 'Número') }}
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <?php
                                            echo $this->tag->select(['unResidContamOleoDerivados',
                                                \App\Modules\Nucleo\Models\TablesSystem::find("table = 'medida2'"),
                                                'using' => ['code', 'value'],
                                                'class' => 'form-control fg-input fc-alt',
                                            ]);
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                <br />
                                <!-- /residContamOleoDerivados -->
                            </div>
                            <div class="col-lg-5 col-lg-offset-2">

                                <!-- residuosEletroEletronico -->
                                <div class="form-group clearfix">
                                    <label><i class="badge bgm-lightgreen">9.4</i> Resíduos Eletro-Eletrônicos</label>
                                    <div class="row">
                                        <div class="col-sm-8">
                                            <div class="fg-line">
                                                {{ text_field("residuosEletroEletronico", "class" : "form-control fg-input fc-alt onlyFloatWithDot") }}
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <?php
                                            echo $this->tag->select(['unResiduosEletroEletronico',
                                                \App\Modules\Nucleo\Models\TablesSystem::find("table = 'medida4'"),
                                                'using' => ['code', 'value'],
                                                'class' => 'form-control fg-input fc-alt',
                                            ]);
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                <br />
                                <!-- /residuosEletroEletronico -->

                                <!-- residuosEmergenciasAmbientais -->
                                <div class="form-group clearfix">
                                    <label><i class="badge bgm-lightgreen">9.5</i> Resíduos de Emergências Ambientais</label>
                                    <div class="row">
                                        <div class="col-sm-8">
                                            <div class="fg-line">
                                                {{ text_field("residuosEmergenciasAmbientais", "class" : "form-control fg-input fc-alt onlyFloatWithDot") }}
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <?php
                                            echo $this->tag->select(['unResiduosEmergenciasAmbientais',
                                                \App\Modules\Nucleo\Models\TablesSystem::find("table = 'medida4'"),
                                                'using' => ['code', 'value'],
                                                'class' => 'form-control fg-input fc-alt',
                                            ]);
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                <br />
                                <!-- /residuosEmergenciasAmbientais -->

                                <!-- outResidPerig -->
                                <div class="form-group">
                                    <label><i class="badge bgm-lightgreen">9.6</i> Outros resíduos perigoso (Tipo e Volume)</label>
                                    <div class="fg-line">
                                        {{ text_area("outResidPerig", "class" : "form-control fg-input fc-alt", 'rows': 5) }}
                                    </div>
                                </div>
                                <br />
                                <!-- /outResidPerig -->

                            </div>
                        </div>
                    </fieldset>
                    <br />
                    <fieldset class="well well-alt">
                        <legend><span class="badge bgm-green">10.0</span> Resíduos Classe II A (Não inerte)</legend>
                        <div class="row">
                            <div class="col-lg-5">

                                <!-- totalResidPapel -->
                                <div class="form-group clearfix">
                                    <label><i class="badge bgm-lightgreen">10.1</i> Total de Resíduos de Papel</label>
                                    <div class="row">
                                        <div class="col-sm-8">
                                            <div class="fg-line">
                                                {{ text_field("totalResidPapel", "class" : "form-control fg-input fc-alt onlyFloatWithDot", 'placeholder': 'Número') }}
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <?php
                                            echo $this->tag->select(['unTotalResidPapel',
                                                \App\Modules\Nucleo\Models\TablesSystem::find("table = 'medida2'"),
                                                'using' => ['code', 'value'],
                                                'class' => 'form-control fg-input fc-alt',
                                            ]);
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                <br />
                                <!-- /totalResidPapel -->
                                <!-- totalResidMadeira -->
                                <div class="form-group clearfix">
                                    <label><i class="badge bgm-lightgreen">10.2</i> Total de Resíduos de Madeira</label>
                                    <div class="row">
                                        <div class="col-sm-8">
                                            <div class="fg-line">
                                                {{ text_field("totalResidMadeira", "class" : "form-control fg-input fc-alt onlyFloatWithDot", 'placeholder': 'Número') }}
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <?php
                                            echo $this->tag->select(['unTotalResidMadeira',
                                                \App\Modules\Nucleo\Models\TablesSystem::find("table = 'medida2'"),
                                                'using' => ['code', 'value'],
                                                'class' => 'form-control fg-input fc-alt',
                                            ]);
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                <br />
                                <!-- /totalResidMadeira -->

                            </div>
                            <div class="col-lg-5 col-lg-offset-2">
                                <!-- totalResidNaoRecicl -->
                                <div class="form-group clearfix">
                                    <label><i class="badge bgm-lightgreen">10.3</i> Total de Resíduos não recicláveis</label>
                                    <div class="row">
                                        <div class="col-sm-8">
                                            <div class="fg-line">
                                                {{ text_field("totalResidNaoRecicl", "class" : "form-control fg-input fc-alt onlyFloatWithDot", 'placeholder': 'Número') }}
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <?php
                                            echo $this->tag->select(['unTotalResidNaoRecicl',
                                                \App\Modules\Nucleo\Models\TablesSystem::find("table = 'medida2'"),
                                                'using' => ['code', 'value'],
                                                'class' => 'form-control fg-input fc-alt',
                                            ]);
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                <br />
                                <!-- /totalResidNaoRecicl -->
                            </div>
                        </div>
                    </fieldset>
                    <br />
                    <fieldset class="well well-alt">
                        <legend><span class="badge bgm-green">11.0</span> Resíduos Classe II B (Inerte)</legend>
                        <div class="row">
                            <div class="col-lg-5">

                                <!-- totalResidPlastico -->
                                <div class="form-group clearfix">
                                    <label><i class="badge bgm-lightgreen">11.1</i> Total de Resíduos de Plástico</label>
                                    <div class="row">
                                        <div class="col-sm-8">
                                            <div class="fg-line">
                                                {{ text_field("totalResidPlastico", "class" : "form-control fg-input fc-alt onlyFloatWithDot", 'placeholder': 'Número') }}
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <?php
                                            echo $this->tag->select(['unTotalResidPlastico',
                                                \App\Modules\Nucleo\Models\TablesSystem::find("table = 'medida2'"),
                                                'using' => ['code', 'value'],
                                                'class' => 'form-control fg-input fc-alt',
                                            ]);
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                <br />
                                <!-- /totalResidPlastico -->
                                <!-- totalResidMetal -->
                                <div class="form-group clearfix">
                                    <label><i class="badge bgm-lightgreen">11.2</i> Total de Resíduos de Metal</label>
                                    <div class="row">
                                        <div class="col-sm-8">
                                            <div class="fg-line">
                                                {{ text_field("totalResidMetal", "class" : "form-control fg-input fc-alt onlyFloatWithDot", 'placeholder': 'Número') }}
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <?php
                                            echo $this->tag->select(['unTotalResidMetal',
                                                \App\Modules\Nucleo\Models\TablesSystem::find("table = 'medida2'"),
                                                'using' => ['code', 'value'],
                                                'class' => 'form-control fg-input fc-alt',
                                            ]);
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                <br />
                                <!-- /totalResidMetal -->

                            </div>
                            <div class="col-lg-5 col-lg-offset-2">
                                <!-- totalResidVidro -->
                                <div class="form-group clearfix">
                                    <label><i class="badge bgm-lightgreen">11.3</i> Total de Resíduos de Vidro</label>
                                    <div class="row">
                                        <div class="col-sm-8">
                                            <div class="fg-line">
                                                {{ text_field("totalResidVidro", "class" : "form-control fg-input fc-alt onlyFloatWithDot", 'placeholder': 'Número') }}
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <?php
                                            echo $this->tag->select(['unTotalResidVidro',
                                                \App\Modules\Nucleo\Models\TablesSystem::find("table = 'medida2'"),
                                                'using' => ['code', 'value'],
                                                'class' => 'form-control fg-input fc-alt',
                                            ]);
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                <br />
                                <!-- /totalResidVidro -->
                                <!-- residConstrucaoCivil -->
                                <div class="form-group clearfix">
                                    <label><i class="badge bgm-lightgreen">11.3</i> Resíduos da construção civil</label>
                                    <div class="row">
                                        <div class="col-sm-8">
                                            <div class="fg-line">
                                                {{ text_field("residConstrucaoCivil", "class" : "form-control fg-input fc-alt onlyFloatWithDot", 'placeholder': 'Número') }}
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <?php
                                            echo $this->tag->select(['unResidConstrucaoCivil',
                                                \App\Modules\Nucleo\Models\TablesSystem::find("table = 'medida2'"),
                                                'using' => ['code', 'value'],
                                                'class' => 'form-control fg-input fc-alt',
                                            ]);
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                <br />
                                <!-- /residConstrucaoCivil -->
                            </div>
                        </div>
                    </fieldset>
                    <br />
                    <fieldset class="well well-alt">
                        <legend><span class="badge bgm-green">12.0</span> Situações de emergência</legend>
                        <div class="row">
                            <div class="col-lg-5">

                                <!-- vazamGas -->
                                <div class="form-group">
                                    <label><i class="badge bgm-lightgreen">12.1</i> Vazamentos de gases</label>
                                    <div class="row">
                                        <div class="col-sm-8">
                                            <div class="fg-line">
                                                {{ text_field("vazamGas", "class" : "form-control fg-input fc-alt onlyFloatWithDot", 'placeholder': 'Número') }}
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <?php
                                            echo $this->tag->select(['unVazamGas',
                                                \App\Modules\Nucleo\Models\TablesSystem::find("table = 'medida3'"),
                                                'using' => ['code', 'value'],
                                                'class' => 'form-control fg-input fc-alt',
                                            ]);
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                <br />
                                <!-- /vazamGas -->
                                <!-- vazamResidOleoso -->
                                <div class="form-group clearfix">
                                    <label><i class="badge bgm-lightgreen">12.2</i> Vazamentos de resíduos oleosos</label>
                                    <div class="row">
                                        <div class="col-sm-8">
                                            <div class="fg-line">
                                                {{ text_field("vazamResidOleoso", "class" : "form-control fg-input fc-alt onlyFloatWithDot", 'placeholder': 'Número') }}
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <?php
                                            echo $this->tag->select(['unVazamResidOleoso',
                                                \App\Modules\Nucleo\Models\TablesSystem::find("table = 'medida3'"),
                                                'using' => ['code', 'value'],
                                                'class' => 'form-control fg-input fc-alt',
                                            ]);
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                <br />
                                <!-- /vazamResidOleoso -->

                            </div>
                            <div class="col-lg-5 col-lg-offset-2">
                                <!-- vazamLigInflamaveis -->
                                <div class="form-group clearfix">
                                    <label><i class="badge bgm-lightgreen">12.3</i> Vazamentos de líquidos inflamáveis</label>
                                    <div class="row">
                                        <div class="col-sm-8">
                                            <div class="fg-line">
                                                {{ text_field("vazamLigInflamaveis", "class" : "form-control fg-input fc-alt onlyFloatWithDot", 'placeholder': 'Número') }}
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <?php
                                            echo $this->tag->select(['unVazamLigInflamaveis',
                                                \App\Modules\Nucleo\Models\TablesSystem::find("table = 'medida3'"),
                                                'using' => ['code', 'value'],
                                                'class' => 'form-control fg-input fc-alt',
                                            ]);
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                <br />
                                <!-- /vazamLigInflamaveis -->
                            </div>
                        </div>
                    </fieldset>

                </div>
                <!-- /#meio_ambiente -->
                <!-- #geral -->
                <div class="tab-pane fade in" id="geral">

                    <fieldset class="well well-alt">
                        <legend><span class="badge bgm-green">13.0</span> Observações</legend>
                        <div class="row">
                            <div class="col-lg-8 col-lg-offset-2">

                                <!-- obs -->
                                <div class="form-group fg-line">
                                    <label><i class="badge bgm-lightgreen">13.1</i> Observações</label>
                                    {{ text_area("obs", "class" : "form-control fg-input fc-alt", 'rows': 5) }}
                                </div>
                                <br />
                                <!-- /obs -->
                            </div>
                        </div>
                    </fieldset>

                </div>
                <!-- /#geral -->

                <div class="row">
                    <div class="col-sm-2 col-sm-offset-10">
                        <button type="submit" class="btn bgm-green">Salvar</button>
                    </div>
                </div>
            </div>
            {{ end_form() }}
        </div>
    </div>
</div>