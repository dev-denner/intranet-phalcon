{{ content() }}

<div class="row">
    <div class="col-xs-10 col-xs-offset-1">
        <div class="card">
            <div class="card-header">
                <ul class="actions hidden-print">
                    <li>
                        {{ link_to('', '<i class="fa fa-print c-blue" aria-hidden="true"></i>', 'class': 'tooltips', 'title': 'Imprimir', 'onclick': 'window.print(); return false') }}
                    </li>
                    <!--                    <li>
                                            {{ link_to('export?obj=recibo_ferias&type=pdf&search='~periodo, '<i class="fa fa-file-pdf-o c-red" aria-hidden="true"></i>', 'class': 'tooltips', 'title': 'Exportar para PDF', 'target': '_new') }}
                                        </li>-->

                </ul>
                <div class="row">
                    <div class="col-xs-3 text-center">
                        <img src="{{ static_url('/assets/img/logos/empresas/'~logo~'_color.png') }}" class="img-responsive img-thumbnail b-0" />
                    </div>
                    <div class="col-xs-9">
                        <h2>
                            {{ coligada.NOME }}
                            <small>
                                {{ coligada.CGC }} <br />
                                {{ coligada.RUA }} - {{ coligada.BAIRRO }} - {{ coligada.CIDADE }}
                            </small>
                        </h2>
                    </div>
                </div>
            </div>
            <div class="card-body card-padding">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="well">
                            <b>Chapa:</b> {{ colaborador.CHAPA }} <br />
                            <b>Nome:</b> {{ colaborador.NOME }} <br />
                            <b>Função:</b> {{ colaborador.FUNCAO }} <br />
                            <b>Seção:</b> {{ colaborador.CODSECAO }} - {{ colaborador.DESC_SECAO }}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-6">
                        <div class="col-xs-12"><b>Vencimento da Férias:</b> {{ colaborador.VENCIMENTO_FERIAS }}</div>
                        <div class="col-xs-12"><b>Período Gozo Férias:</b> {{ colaborador.PERIODO_GOZO }}</div>
                        <div class="col-xs-12"><b>Abono Pecuniario:</b> {{ colaborador.ABONO }} Dias</div>
                    </div>
                    <div class="col-xs-6">
                        <div class="col-xs-12"><b>Salário Base:</b> {{ number_format(colaborador.SALARIO, 2, ',', '.') }}</div>
                        <div class="col-xs-12"><b>Cart. Trabalho:</b> {{ colaborador.CARTEIRA_TRABALHO }} <b>Série:</b> {{ colaborador.SERIE_CART_TRAB }}</div>
                    </div>
                </div>
                <hr />
                <div class="row">
                    <div class="col-xs-12"><p class="text-center f-16"><b>Base para Cálculo da Remuneração das Férias</b></p></div>
                </div>
                <div class="row">
                    <div class="table-responsive">
                        <table class="table table-condensed table-bordered table-striped f-12">
                            <thead>
                                <tr>
                                    <th width='10%'>Cod.</th>
                                    <th>Descrição</th>
                                    <th class="text-center">Ref.</th>
                                    <th class="text-right">Proventos</th>
                                    <th class="text-right">Descontos</th>
                                </tr>
                            </thead>
                            <tbody>
                                {% for valor in valores %}
                                <tr>
                                    <td>{{ valor.CODEVENTO }}</td>
                                    <td>{{ valor.DESCRICAO }}</td>
                                    <td class="text-center">{{ valor.REF }}</td>
                                    <td class="text-right">{{ number_format(valor.PROVENTOS, 2, ',', '.') }}</td>
                                    <td class="text-right">{{ number_format(valor.DESCONTOS, 2, ',', '.') }}</td>
                                </tr>
                                {% endfor %}
                            </tbody>
                        </table>
                    </div>
                </div>
                <hr />
                <div class="row">
                    <div class="col-xs-4">
                        <p class="text-center"><b>PROVENTOS: {{ number_format(totalizadores.TOTAL_PROVENTOS, 2, ',', '.') }}</b></p>
                    </div>
                    <div class="col-xs-4">
                        <p class="text-center"><b>DESCONTOS: {{ number_format(totalizadores.TOTAL_DESCONTOS, 2, ',', '.') }}</b></p>
                    </div>
                    <div class="col-xs-4">
                        <p class="text-center"><b>LÍQUIDO: {{ number_format(totalizadores.LIQUIDO, 2, ',', '.') }}</b></p>
                    </div>
                </div>
            </div>
        </div>
    </div>