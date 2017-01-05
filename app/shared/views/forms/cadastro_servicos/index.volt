{{ content() }}

<div class="card">
    <div class="card-header">
        <h2>Cadastro de Serviços <small>Preencha as informações para realizar a solicitação desejada.</small></h2>
    </div>

    <div class="card-body card-padding">
        <div class="form-wizard-basic fw-container">
            {{ form("forms/cadastro_servicos/sendForm", "method":"post", "enctype": "multipart/form-data", "autocomplete" : "off", 'onsubmit': 'overlay(true);') }}
            <fieldset class="well well-alt">
                <legend><span class="badge bgm-green">1.0</span> Dados Gerais</legend>
                <div class="row">
                    <div class="col-md-5">
                        <!-- tipo_do_servico -->
                        <div class="form-group">
                            <label><i class="badge bgm-lightgreen">1.1</i> Tipo do Serviço <span class="text-danger">*</span></label>
                            {{ text_field("Tipo do Serviço", "class" : "form-control fg-input fc-alt", "required": "required") }}
                        </div>
                        <!-- /tipo_do_servico -->

                        <!-- nome_modificado_do_servico -->
                        <div class="form-group fg-line">
                            <label><i class="badge bgm-lightgreen">1.2</i> Nome Modificador do Serviço<span class="text-danger">*</span></label>
                            {{ text_field("Nome Modificador do Serviço", "class" : "form-control fg-input fc-alt", "required": "required") }}
                        </div>
                        <!-- /nome_modificado_do_servico -->

                    </div>
                    <div class="col-md-5 col-md-offset-1">

                        <!-- descricao_complementar -->
                        <div class="form-group fg-line">
                            <label><i class="badge bgm-lightgreen">1.3</i> Descrição Complementar</label>
                            {{ text_field("Descrição Complementar", "class" : "form-control fg-input fc-alt") }}
                        </div>
                        <!-- /descricao_complementar -->

                    </div>
                </div>
            </fieldset>
            <fieldset class="well well-alt">
                <legend><span class="badge bgm-green">2.0</span> Referênciais</legend>
                <div class="row">
                    <div class="col-md-5">

                        <!-- prestador_de_servico -->
                        <div class="form-group fg-line">
                            <label><i class="badge bgm-lightgreen">2.1</i> Prestador de Serviço</label>
                            {{ text_field("Prestador de Serviço", "class" : "form-control fg-input fc-alt") }}
                        </div>
                        <!-- /prestador_de_servico -->

                        <!-- contratacao_periodo -->
                        <div class="form-group fg-line">
                            <label><i class="badge bgm-lightgreen">2.2</i> Contratação / Período</label>
                            {{ text_field("Contratação / Período", "class" : "form-control fg-input fc-alt") }}
                        </div>
                        <!-- /contratacao_periodo -->

                    </div>
                    <div class="col-md-5 col-md-offset-1">

                        <!-- certificados -->
                        <div class="form-group fg-line">
                            <label><i class="badge bgm-lightgreen">2.3</i> Certificados</label>
                            {{ text_field("Certificados", "class" : "form-control fg-input fc-alt") }}
                        </div>
                        <!-- /certificados -->

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
