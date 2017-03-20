{{ content() }}

<div class="card">
    <div class="card-header">
        <h2>TES - Tipos de Entradas e Saídas <small>Digite a informação desejada ou deixe em branco para buscar TODOS os dados disponíveis.</small></h2>
    </div>
    <div class="card-body card-padding">
        <div class="row">
            {{ form('consultas/tes', 'role': 'form', 'method': 'post', 'autocomplete': 'off', 'onsubmit': 'overlay(true)') }}
            <div class="col-sm-4">
                <div class="input-group fg-float">
                    <span class="input-group-addon"><i class="zmdi zmdi-keyboard"></i></span>
                    <div class="fg-line">
                        <input type="text" class="form-control" name="tes" id="tes" value="{{ pesquisa }}" onclick="this.select()" />
                        <label class="fg-label">Digite sua pesquisa</label>
                    </div>
                    <p class="help-block">Buscar por Código, Tipo, Código Fiscal, Operação de Movimento, Texto Padrão ou Finalidade.</p>
                </div>
            </div>
            <div class="col-sm-2">
                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-sm m-t-5 waves-effect">Buscar</button>
                </div>
            </div>

        </div>
        {{ end_form() }}
    </div>
</div>
{% if tess is not empty %}
<div class="card">
    <div class="card-header">
        Resultado para pesquisa: <span class="text-danger">{{ pesquisa }}</span>
        <ul class="actions">
            {% if export %}
            <li>
                {{ link_to('export?obj=tes&type=excel&search='~pesquisa, '<i class="fa fa-file-excel-o c-green" aria-hidden="true"></i>', 'class': 'tooltips', 'title': 'Exportar para Excel', 'target': '_new') }}
            </li>
            <li>
                {{ link_to('export?obj=tes&type=pdf&search='~pesquisa, '<i class="fa fa-file-pdf-o c-red" aria-hidden="true"></i>', 'class': 'tooltips', 'title': 'Exportar para PDF', 'target': '_new') }}
            </li>
            {% endif %}
        </ul>
    </div>
    <div class="card-body card-padding">
        <div class="table-responsive">
            <table class="table table-striped table-vmiddle datatable">
                <thead>
                    <tr>
                        <th data-column-id="CODIGO">Código</th>
                        <th data-column-id="TIPO">Tipo</th>
                        <th data-column-id="CODIGO_FISCAL">Cód. Fiscal</th>
                        <th data-column-id="OPERACAO_MOVIMENTO">Op. Mov.</th>
                        <th data-column-id="TEXTO_PADRAO">T. Padrão</th>
                        <th data-column-id="FINALIDADE">Finalidade</th>
                        <th data-column-id="GERA_DUPLICADA">Duplicata</th>
                        <th data-column-id="ATUALIZA_ESTOQUE">Estoque</th>
                        <th data-column-id="CALCULA_ICMS">Calc. ICMS</th>
                        <th data-column-id="CREDITA_ICMS">Cred. ICMS</th>
                        <th data-column-id="CALCULA_IPI">Calc. IPI</th>
                        <th data-column-id="CREDITA_IPI">Cred. IPI</th>
                        <th data-column-id="LIVRO_FISCAL_ICMS">LF ICMS</th>
                        <th data-column-id="LIVRO_FISCAL_IPI">LF IPI</th>
                        <th data-column-id="BLOQUEADO">BLQ</th>
                    </tr>
                </thead>
                <tbody>
                    {% for tes in tess %}
                    <tr>
                        <td>{{ tes.CODIGO }}</td>
                        <td>{{ tes.TIPO }}</td>
                        <td>{{ tes.CODIGO_FISCAL }}</td>
                        <td>{{ tes.OPERACAO_MOVIMENTO }}</td>
                        <td>{{ tes.TEXTO_PADRAO }}</td>
                        <td>{{ tes.FINALIDADE }}</td>
                        <td>{{ tes.GERA_DUPLICADA }}</td>
                        <td>{{ tes.ATUALIZA_ESTOQUE }}</td>
                        <td>{{ tes.CALCULA_ICMS }}</td>
                        <td>{{ tes.CREDITA_ICMS }}</td>
                        <td>{{ tes.CALCULA_IPI }}</td>
                        <td>{{ tes.CREDITA_IPI }}</td>
                        <td>{{ tes.LIVRO_FISCAL_ICMS }}</td>
                        <td>{{ tes.LIVRO_FISCAL_IPI }}</td>
                        <td>{{ tes.BLOQUEADO }}</td>
                    </tr>
                    {% endfor %}
                </tbody>
            </table>
        </div>
    </div>
</div>
{% endif %}