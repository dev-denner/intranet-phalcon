{{ content() }}

<div class="card">
    <div class="card-header">
        <h2>Cadastro de Produtos <small>Preencha as informações para realizar a solicitação desejada.</small></h2>
    </div>

    <div class="card-body card-padding">
        <div class="form-wizard-basic fw-container">
            {{ form("forms/cadastro_produtos/sendForm", "method":"post", "enctype": "multipart/form-data", "autocomplete" : "off", "onsubmit": "overlay(true);") }}
            <fieldset class="well well-alt">
                <legend><span class="badge bgm-green">1.0</span> Dados Gerais</legend>
                <div class="row">
                    <div class="col-md-5">
                        <!-- nome_do_material -->
                        <div class="form-group">
                            <label><i class="badge bgm-lightgreen">1.1</i> Nome do Material <span class="text-danger">*</span></label>
                            {{ text_field("Nome do Material", "class" : "form-control fg-input fc-alt", "required": "required") }}
                        </div>
                        <!-- /nome_do_material -->

                        <!-- nome_modificado -->
                        <div class="form-group fg-line">
                            <label><i class="badge bgm-lightgreen">1.2</i> Nome Modificador</label>
                            {{ text_field("Nome Modificador", "class" : "form-control fg-input fc-alt") }}
                        </div>
                        <!-- /nome_modificado -->

                        <!-- material_de_fabricacao -->
                        <div class="form-group fg-line">
                            <label><i class="badge bgm-lightgreen">1.3</i> Material de Fabricação <span class="text-danger">*</span></label>
                            {{ text_field("Material de Fabricação", "class" : "form-control fg-input fc-alt", "required": "required") }}
                        </div>
                        <!-- /material_de_fabricacao -->

                        <!-- tratamento_superficial -->
                        <div class="form-group fg-line">
                            <label><i class="badge bgm-lightgreen">1.4</i> Tratamento Superficial</label>
                            {{ text_field("Tratamento Superficial", "class" : "form-control fg-input fc-alt") }}
                        </div>
                        <!-- /tratamento_superficial -->

                        <!-- norma_construtiva -->
                        <div class="form-group fg-line">
                            <label><i class="badge bgm-lightgreen">1.5</i> Norma Construtiva</label>
                            {{ text_field("Norma Construtiva", "class" : "form-control fg-input fc-alt") }}
                        </div>
                        <!-- /norma_construtiva -->

                        <!-- norma_do_material -->
                        <div class="form-group fg-line">
                            <label><i class="badge bgm-lightgreen">1.6</i> Norma do Material</label>
                            {{ text_field("Norma do Material", "class" : "form-control fg-input fc-alt") }}
                        </div>
                        <!-- /norma_do_material -->

                    </div>
                    <div class="col-md-5 col-md-offset-1">

                        <!-- cor_acabamento_ph_capacidade_construcao -->
                        <div class="form-group fg-line">
                            <label><i class="badge bgm-lightgreen">1.7</i> Cor / Acabamento / PH / Capacidade / Construção <span class="text-danger">*</span></label>
                            {{ text_field("Cor / Acabamento / PH / Capacidade / Construção", "class" : "form-control fg-input fc-alt", "required": "required") }}
                        </div>
                        <!-- /cor_acabamento_ph_capacidade_construcao -->

                        <!-- embalagem_apresentacao_acondicionamento -->
                        <div class="form-group fg-line">
                            <label><i class="badge bgm-lightgreen">1.8</i> Embalagem / Apresentação / Acondicionamento <span class="text-danger">*</span></label>
                            {{ text_field("Embalagem / Apresentação / Acondicionamento", "class" : "form-control fg-input fc-alt", "required": "required") }}
                        </div>
                        <!-- /embalagem_apresentacao_acondicionamento -->

                        <!-- utilizacao_aplicacao -->
                        <div class="form-group fg-line">
                            <label><i class="badge bgm-lightgreen">1.9</i> Utilização / Aplicação</label>
                            {{ text_field("Utilização / Aplicação", "class" : "form-control fg-input fc-alt") }}
                        </div>
                        <!-- /utilizacao_aplicacao -->

                        <!-- tipo_de_conexao_rosca -->
                        <div class="form-group fg-line">
                            <label><i class="badge bgm-lightgreen">1.10</i> Tipo de Conexão / Rosca</label>
                            {{ text_field("Tipo de Conexão / Rosca", "class" : "form-control fg-input fc-alt") }}
                        </div>
                        <!-- /tipo_de_conexao_rosca -->

                        <!-- processo_de_fabricacao -->
                        <div class="form-group fg-line">
                            <label><i class="badge bgm-lightgreen">1.11</i> Processo de Fabricação</label>
                            {{ text_field("Processo de Fabricação", "class" : "form-control fg-input fc-alt") }}
                        </div>
                        <!-- /processo_de_fabricacao -->

                    </div>
                </div>
            </fieldset>
            <fieldset class="well well-alt">
                <legend><span class="badge bgm-green">2.0</span> Referênciais</legend>
                <div class="row">
                    <div class="col-md-5">

                        <!-- fabricante_referencia -->
                        <div class="form-group fg-line">
                            <label><i class="badge bgm-lightgreen">2.1</i> Fabricante / Referência <span class="text-danger">*</span></label>
                            {{ text_field("Fabricante / Referência", "class" : "form-control fg-input fc-alt", "required": "required") }}
                        </div>
                        <!-- /fabricante_referencia -->

                        <!-- instalacoes -->
                        <div class="form-group fg-line">
                            <label><i class="badge bgm-lightgreen">2.2</i> Instalações</label>
                            {{ text_field("Instalações", "class" : "form-control fg-input fc-alt") }}
                        </div>
                        <!-- /instalacoes -->

                        <!-- temperatura_de_trabalho -->
                        <div class="form-group fg-line">
                            <label><i class="badge bgm-lightgreen">2.3</i> Temperatura de Trabalho</label>
                            {{ text_field("Temperatura de Trabalho", "class" : "form-control fg-input fc-alt") }}
                        </div>
                        <!-- /temperatura_de_trabalho -->

                        <!-- material_de_fabricacao_secundario -->
                        <div class="form-group fg-line">
                            <label><i class="badge bgm-lightgreen">2.4</i> Material de Fabricação Secundário</label>
                            {{ text_field("Material de Fabricação Secundário", "class" : "form-control fg-input fc-alt") }}
                        </div>
                        <!-- /material_de_fabricacao_secundario -->

                    </div>
                    <div class="col-md-5 col-md-offset-1">

                        <!-- especificacao_tecnica -->
                        <div class="form-group fg-line">
                            <label><i class="badge bgm-lightgreen">2.5</i> Especificação Técnica</label>
                            {{ text_field("Especificação Técnica", "class" : "form-control fg-input fc-alt") }}
                        </div>
                        <!-- /especificacao_tecnica -->

                        <!-- informacoes_adicionais -->
                        <div class="form-group fg-line">
                            <label><i class="badge bgm-lightgreen">2.6</i> Informações Adicionais</label>
                            {{ text_field("Informações Adicionais", "class" : "form-control fg-input fc-alt") }}
                        </div>
                        <!-- /informacoes_adicionais -->

                        <!-- configuracoes_display_canais_ip -->
                        <div class="form-group fg-line">
                            <label><i class="badge bgm-lightgreen">2.7</i> Configurações / Display / Canais / IP</label>
                            {{ text_field("Configurações / Display / Canais / IP", "class" : "form-control fg-input fc-alt") }}
                        </div>
                        <!-- /configuracoes_display_canais_ip -->

                    </div>
                </div>
            </fieldset>
            <fieldset class="well well-alt">
                <legend><span class="badge bgm-green">3.0</span> Anexos</legend>
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">

                        <!-- enviaArquivos -->
                        <div class="form-group fg-line">
                            <label class="control-label"><i class="badge bgm-lightgreen">3.1</i> Enviar Anexo(s)</label>
                            {{ file_field("enviaArquivos", "name": "enviaArquivos[]", "class" : "form-control fg-input fc-alt file-loading fileUpload", "multiple": true) }}
                        </div>
                        <p class="help-block">Extensões de arquivos aceitas: .jpg, .jpeg, .png, .gif, .pdf, .doc, .docx, .txt, .zip, .rar, .gz, .tgz</p>
                        <!-- /enviaArquivos -->

                    </div>
                </div>
            </fieldset>
            <div class="form-group clearfix">
                <button type="submit" class="btn btn-success pull-right">Enviar</button>
            </div>
            {{ end_form() }}
        </div>
    </div>
</div>
