{{ content() }}

<div class="card">
    <div class="card-header">
        <h2>Funcionários <small>Insira os dados para atualizar o funcionário.</small></h2>
    </div>

    <div class="card-body card-padding">
        {{ form("nucleo/funcionarios/save", "method":"post", "autocomplete" : "off") }}

        {{ hidden_field("id", 'required': 'required') }}
        <div class="row">
            <div class="col-lg-5 col-lg-offset-1">
                <div class="form-group fg-float">
                    <div class="fg-line">
                        {{ text_field("chapa", "class" : "form-control fg-input", 'required': 'required') }}
                        <label class="fg-label">Chapa do funcionário</label>
                    </div>
                </div>
                <br />
            </div>

            <div class="col-lg-5">
                <div class="form-group fg-float">
                    <div class="fg-line">
                        {{ text_field("nome", "class" : "form-control fg-input", 'required': 'required') }}
                        <label class="fg-label">Nome do funcionário</label>
                    </div>
                </div>
                <br />
            </div>

            <div class="col-lg-5 col-lg-offset-1">
                <div class="form-group fg-float">
                    <div class="fg-line">
                        {{ text_field("cpf", "class" : "form-control fg-input", 'required': 'required') }}
                        <label class="fg-label">CPF</label>
                    </div>
                </div>
                <br />
            </div>

            <div class="col-lg-5">
                <div class="form-group fg-float">
                    <div class="fg-line">
                        <div class="select">
                            <?php
                            echo $this->tag->select(['empresa',
                                \Nucleo\Models\Empresas::find(),
                                'using' => ['id', 'nomeFantasia'],
                                'useEmpty' => true,
                                'emptyText' => 'Empresa (Escolha uma opção)',
                                'emptyValue' => '',
                                'class' => 'form-control',
                                'required' => 'required']
                            );
                            ?>
                        </div>
                    </div>
                </div>
                <br />
            </div>

            <div class="col-lg-5 col-lg-offset-1">
                <div class="form-group fg-float">
                    <div class="fg-line">
                        {{ text_field("situacao", "class" : "form-control fg-input") }}
                        <label class="fg-label">Situação</label>
                    </div>
                </div>
                <br />
            </div>

            <div class="col-lg-5">
                <div class="form-group fg-float">
                    <div class="fg-line">
                        {{ text_field("tipo", "class" : "form-control fg-input") }}
                        <label class="fg-label">Tipo</label>
                    </div>
                </div>
                <br />
            </div>

            <div class="col-lg-5 col-lg-offset-1">
                <div class="form-group fg-float">
                    <div class="fg-line">
                        {{ text_field("dataAdmissao", "class" : "form-control fg-input", 'required': 'required') }}
                        <label class="fg-label">Data Admissão</label>
                    </div>
                </div>
                <br />
            </div>

            <div class="col-lg-5">
                <div class="form-group fg-float">
                    <div class="fg-line">
                        {{ text_field("cargo", "class" : "form-control fg-input") }}
                        <label class="fg-label">Cargo</label>
                    </div>
                </div>
                <br />
            </div>

            <div class="col-lg-5 col-lg-offset-1">
                <div class="form-group fg-float">
                    <div class="fg-line">
                        {{ email_field("email", "class" : "form-control fg-input", 'required': 'required') }}
                        <label class="fg-label">E-mail</label>
                    </div>
                </div>
                <br />
            </div>

            <div class="col-lg-5">
                <div class="form-group fg-float">
                    <div class="fg-line">
                        {{ text_field("cc", "class" : "form-control fg-input") }}
                        <label class="fg-label">Centro de Custo</label>
                    </div>
                </div>
                <br />
            </div>

            <div class="col-lg-5 col-lg-offset-1">
                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-sm m-t-10 waves-effect">Atualizar</button>
                </div>
            </div>
        </div>
        {{ end_form() }}
    </div>
</div>