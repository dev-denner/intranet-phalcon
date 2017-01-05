{{ content() }}

<div class="card">
    <div class="card-header">
        <h2>Solicitações ao RH/DP <small>Preencha as informações para realizar a solicitação desejada.</small></h2>
    </div>

    <div class="card-body card-padding">
        <div class="form-wizard-basic fw-container">
            {{ form("forms/solicitacoes_externas/sendForm", "method":"post", "enctype": "multipart/form-data", "autocomplete" : "off", 'onsubmit': 'overlay(true)') }}

            <fieldset class="well well-alt">
                <legend><span class="badge bgm-green">1.0</span> Identificação</legend>
                <div class="row">
                    <div class="col-lg-5">

                        <!-- cpf -->
                        <div class="form-group fg-line">
                            <label><i class="badge bgm-lightgreen">1.1</i> CPF <span class="text-danger">*</span></label>
                            {{ text_field("cpf", "name": "CPF", "class" : "form-control fg-input fc-alt cpfMask", 'required': 'required') }}
                        </div>
                        <!-- /cpf -->
                        <!-- nome -->
                        <div class="form-group fg-line">
                            <label><i class="badge bgm-lightgreen">1.2</i> Nome <span class="text-danger">*</span></label>
                            {{ text_field("nome", "name": "Nome", "class" : "form-control fg-input fc-alt", 'required': 'required') }}
                        </div>
                        <!-- /nome -->
                        <!-- dt_nascimento -->
                        <div class="form-group fg-line">
                            <label><i class="badge bgm-lightgreen">1.3</i> Data de Nascimento</label>
                            {{ text_field("dt_nascimento", "name": "Data de Nascimento", "class" : "form-control fg-input fc-alt datepicker") }}
                        </div>
                        <!-- /dt_nascimento -->
                        <!-- funcao -->
                        <div class="form-group fg-line">
                            <label><i class="badge bgm-lightgreen">1.4</i> Função/Cargo</label>
                            {{ text_field("funcao", "name": "Função/Cargo", "class" : "form-control fg-input fc-alt") }}
                        </div>
                        <!-- /funcao -->
                    </div>
                    <div class="col-lg-5 col-lg-offset-2">
                        <!-- empresa -->
                        <div class="form-group fg-line">
                            <label><i class="badge bgm-lightgreen">1.5</i> Empresa <span class="text-danger">*</span></label>
                            <?php
                            $empresa = $empresas;
                            $empresa['OUTROS'] = 'OUTROS';
                            echo $this->tag->selectStatic(['empresa',
                                $empresa,
                                'useEmpty' => true,
                                'emptyText' => 'Escolha uma opção',
                                'emptyValue' => '',
                                'class' => 'form-control fg-input fc-alt',
                                'name' => 'Empresa',
                                'required' => 'required']
                            );
                            ?>
                        </div>
                        <div class="form-group fg-line hidden">
                            <label> Outros <span class="text-danger">*</span></label>
                            {{ text_field("empresa_outros", "name": "Empresa - Outros", "class" : "form-control fg-input fc-alt", "placeholder": "Digite o nome da empresa") }}
                        </div>
                        <!-- /empresa -->
                        <!-- email -->
                        <div class="form-group fg-line">
                            <label><i class="badge bgm-lightgreen">1.6</i> E-mail <span class="text-danger">*</span></label>
                            {{ email_field("email", "name": "E-mail", "class" : "form-control fg-input fc-alt", 'required': 'required') }}
                        </div>
                        <!-- /email -->
                        <!-- email -->
                        <div class="form-group fg-line">
                            <label><i class="badge bgm-lightgreen">1.7</i> Telefone <span class="text-danger">*</span></label>
                            {{ text_field("telefone", "name": "Telefone", "class" : "form-control fg-input fc-alt telefone", 'required': 'required') }}
                        </div>
                        <!-- /email -->
                    </div>
                </div>
            </fieldset>
            <fieldset class="well well-alt">
                <legend><span class="badge bgm-green">2.0</span> Localização</legend>
                <div class="row">
                    <div class="col-md-5">

                        <!-- cep -->
                        <div class="form-group fg-line">
                            <label><i class="badge bgm-lightgreen">2.1</i> CEP <span class="text-danger">*</span></label>
                            {{ text_field("cep", "name" : "CEP", "class" : "form-control fg-input fc-alt cepMask", "required": "required") }}
                        </div>
                        <!-- /cep -->

                        <!-- endereco -->
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group fg-line">
                                    <label>
                                        <i class="badge bgm-lightgreen">2.2</i> Endereço <span class="text-danger">*</span>
                                    </label>
                                    {{ text_field("endereco", "name" : "Endereço", "class" : "form-control fg-input fc-alt", "required": "required") }}
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group fg-line">
                                    <label>
                                        <i class="badge bgm-lightgreen">2.3</i> Número <span class="text-danger">*</span>
                                    </label>

                                    {{ text_field("Número", "class" : "form-control fg-input fc-alt", "required": "required") }}
                                </div>
                            </div>
                        </div>
                        <!-- /endereco -->

                        <!-- complemento -->
                        <div class="form-group fg-line">
                            <label><i class="badge bgm-lightgreen">2.4</i> Complemento</label>
                            {{ text_field("Complemento", "class" : "form-control fg-input fc-alt") }}
                        </div>
                        <!-- /complemento -->

                    </div>
                    <div class="col-md-5 col-md-offset-2">

                        <!-- bairro -->
                        <div class="form-group fg-line">
                            <label><i class="badge bgm-lightgreen">2.5</i> Bairro <span class="text-danger">*</span></label>
                            {{ text_field("bairro", "name" : "Bairro", "class" : "form-control fg-input fc-alt", "required": "required") }}
                        </div>
                        <!-- /bairro -->

                        <!-- municipio -->
                        <div class="form-group fg-line">
                            <label><i class="badge bgm-lightgreen">2.6</i> Município <span class="text-danger">*</span></label>
                            {{ text_field("cidade", "name" : "Município", "class" : "form-control fg-input fc-alt", "required": "required") }}
                        </div>
                        <!-- /municipio -->

                        <!-- estado -->
                        <div class="form-group fg-line">
                            <label><i class="badge bgm-lightgreen">2.7</i> Estado <span class="text-danger">*</span></label>
                            {{ text_field("uf", "name" : "Estado", "class" : "form-control fg-input fc-alt", "required": "required", "maxlength": 2) }}
                        </div>
                        <!-- /estado -->

                    </div>

                </div>
            </fieldset>

            <fieldset class="">
                <legend>Opções de Solicitações</legend>
                <ul class="tab-nav text-center fw-nav tablist" role="tablist" data-tab-color="teal">
                    <li class="active"><a href="#ppp" data-tab="ppp" data-toggle="tab" aria-expanded="true">PPP</a></li>
                    <li class=""><a href="#informe_rendimentos" data-tab="informe_rendimentos" data-toggle="tab" aria-expanded="false">Informe de Rendimentos</a></li>
                    <li class=""><a href="#outros" data-tab="outros" data-toggle="tab" aria-expanded="false">Outros</a></li>
                </ul>
            </fieldset>

            {{ hidden_field("area_ativa", "value": "ppp") }}

            <div class="tab-content">
                <!-- #ppp -->
                <div class="tab-pane fade active in" id="ppp">

                    <fieldset class="well well-alt">
                        <legend><span class="badge bgm-green">3.0</span> PPP</legend>
                        <div class="row">
                            <div class="col-lg-5">

                                <!-- descricao_da_atividade -->
                                <div class="form-group fg-line">
                                    <label><i class="badge bgm-lightgreen">3.1</i> Descrição da Atividade</label>
                                    {{ text_field("descricao_da_atividade", "name": "Descrição da Atividade", "class" : "form-control fg-input fc-alt") }}
                                </div>
                                <!-- /descricao_da_atividade -->
                                <!-- local_de_trabalho -->
                                <div class="form-group fg-line">
                                    <label><i class="badge bgm-lightgreen">3.2</i> Local de Trabalho</label>
                                    {{ text_field("local_de_trabalho", "name": "Local de Trabalho", "class" : "form-control fg-input fc-alt") }}
                                </div>
                                <!-- /local_de_trabalho -->
                                <!-- ctps -->
                                <div class="form-group fg-line">
                                    <label><i class="badge bgm-lightgreen">3.3</i> CTPS</label>
                                    {{ text_field("ctps", "name": "CTPS", "class" : "form-control fg-input fc-alt") }}
                                </div>
                                <!-- /ctps -->
                                <!-- pis -->
                                <div class="form-group fg-line">
                                    <label><i class="badge bgm-lightgreen">3.4</i> PIS <span class="text-danger">*</span></label>
                                    {{ text_field("pis", "name": "PIS", "class" : "form-control fg-input fc-alt", "required": "required") }}
                                </div>
                                <!-- /pis -->
                            </div>
                            <div class="col-lg-5 col-lg-offset-2">
                                <!-- data_de_admissao -->
                                <div class="form-group fg-line">
                                    <label><i class="badge bgm-lightgreen">3.5</i> Data de Admissão</label>
                                    {{ text_field("data_de_admissao", "name": "Data de Admissão", "class" : "form-control fg-input fc-alt datepicker") }}
                                </div>
                                <!-- /data_de_demissao -->
                                <!-- data_de_admissao -->
                                <div class="form-group fg-line">
                                    <label><i class="badge bgm-lightgreen">3.6</i> Data de Demissão <span class="text-danger">*</span></label>
                                    {{ text_field("data_de_demissao", "name": "Data de Demissão", "class" : "form-control fg-input fc-alt datepicker", "required": "required") }}
                                </div>
                                <!-- /data_de_demissao -->
                                <!-- observacao -->
                                <div class="form-group fg-line">
                                    <label><i class="badge bgm-lightgreen">3.7</i> Observação</label>
                                    {{ text_area("observacao", "name": "Data de Admissão", "class" : "form-control fg-input fc-alt", "rows": 5) }}
                                </div>
                                <!-- /observacao -->
                            </div>
                            <div class="col-lg-8 col-lg-offset-2">
                                <hr />
                                <!-- enviaArquivos -->
                                <div class="form-group fg-line">
                                    <label class="control-label"><i class="badge bgm-lightgreen">3.8</i> Anexo(s)</label>
                                    {{ file_field("enviaArquivos", "name": "enviaArquivos[]", "class" : "form-control fg-input fc-alt file-loading fileUpload", "multiple": "multiple") }}
                                </div>
                                <p class="help-block">Extensões de arquivos aceitas: <b>.jpg, .jpeg, .png, .gif, .pdf, .doc, .docx, .txt, .zip, .rar, .gz, .tgz</b><br />
                                    Tamanho Máximo do Arquivo: <b>15mb</b>.
                                </p>
                                <!-- /enviaArquivos -->

                            </div>
                        </div>
                    </fieldset>

                </div>
                <!-- /#ppp -->
                <!-- #informe_rendimentos -->
                <div class="tab-pane fade" id="informe_rendimentos">
                    <fieldset class="well well-alt">
                        <legend><span class="badge bgm-green">3.0</span> Informe de Rendimentos</legend>
                        <div class="row">

                            <div class="col-lg-8 col-lg-offset-2">
                                <div class="table-responsive">
                                    <table class="table table-striped table-condensed bootgrid-table">
                                        <thead>
                                            <tr>
                                                <th><label><i class="badge bgm-lightgreen">3.1</i> Ano Base</label></th>
                                                <th><label><i class="badge bgm-lightgreen">3.2</i> Empresa</label></th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <!-- ano_base -->
                                                    <div class="form-group fg-line">
                                                        <?php
                                                        $anos = [];
                                                        foreach (range(date('Y'), date('Y') - 40) as $ano) {
                                                            $anos[$ano] = $ano;
                                                        }
                                                        echo $this->tag->selectStatic(['ano_base',
                                                            $anos,
                                                            'useEmpty' => true,
                                                            'emptyText' => 'Escolha uma opção',
                                                            'emptyValue' => '',
                                                            'class' => 'form-control fg-input fc-alt',
                                                            'name' => 'Ano Base[]']
                                                        );
                                                        ?>
                                                    </div>
                                                    <!-- /ano_base -->
                                                </td>
                                                <td>
                                                    <!-- empresa -->
                                                    <div class="form-group fg-line">
                                                        <?php
                                                        echo $this->tag->selectStatic(['empresa_informe',
                                                            $empresas,
                                                            'useEmpty' => true,
                                                            'emptyText' => 'Escolha uma opção',
                                                            'emptyValue' => '',
                                                            'class' => 'form-control fg-input fc-alt',
                                                            'name' => 'empresa_informe[]']
                                                        );
                                                        ?>
                                                    </div>
                                                    <!-- /empresa -->
                                                </td>
                                                <td>
                                                    <div class="form-group">
                                                        <button type="button" class="btn btn-success waves-effect" onclick="addLinha(this);"><span class="zmdi zmdi-plus zmdi-hc-fw"></span></button>
                                                        <button type="button" class="btn btn-danger waves-effect" onclick="removeLinha(this);"><span class="zmdi zmdi-minus zmdi-hc-fw"></span></button>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                </div>
                <!-- /#informe_rendimentos -->
                <!-- #outros -->
                <div class="tab-pane fade" id="outros">

                    <fieldset class="well well-alt">
                        <legend><span class="badge bgm-green">3.0</span> Outros</legend>
                        <div class="row">
                            <div class="col-lg-5">

                                <!-- assunto -->
                                <div class="form-group fg-line">
                                    <label><i class="badge bgm-lightgreen">3.1</i> Assunto</label>
                                    <?php
                                    echo $this->tag->selectStatic(['assunto',
                                        [],
                                        'useEmpty' => true,
                                        'emptyText' => 'Escolha uma opção',
                                        'emptyValue' => '',
                                        'class' => 'form-control fg-input fc-alt',
                                        'name' => 'Assunto']
                                    );
                                    ?>
                                </div>
                                <!-- /assunto -->
                            </div>
                            <div class="col-lg-5 col-lg-offset-2">

                                <!-- mensagem -->
                                <div class="form-group fg-line">
                                    <label><i class="badge bgm-lightgreen">3.2</i> Mensagem</label>
                                    {{ text_area("mensagem", "name": "Mensagem", "class" : "form-control fg-input fc-alt", "rows": 5) }}
                                </div>
                                <!-- /mensagem -->

                            </div>
                        </div>
                    </fieldset>

                </div>
                <!-- /#outros -->
                <div class="row">
                    <div class="col-sm-1 col-sm-offset-11">
                        <button type="submit" class="btn bgm-green">Enviar</button>
                    </div>
                </div>
            </div>
            {{ end_form() }}
        </div>
    </div>
</div>