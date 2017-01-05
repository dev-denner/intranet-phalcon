{{ content() }}

<div class="row">
    <div class="col-lg-6 col-lg-offset-3">
        <div class="card">
            <div class="card-header">
                <h2>Acessos Exclusivos a Linhas <small>Insira os dados para atualizar o acesso exclusivo cpf x linha.</small></h2>
            </div>

            <div class="card-body card-padding">
                {{ form("telephony/access_line/save", "method":"post", "autocomplete" : "off") }}

                {{ hidden_field("id", 'required': 'required') }}
                <div class="form-group fg-float">
                    <div class="fg-line">
                        <div class="select">
                            <?php
                            echo $this->tag->select(['cpf',
                                $cpfs,
                                'useEmpty' => true,
                                'emptyText' => '',
                                'emptyValue' => '',
                                'class' => 'form-control',
                                'required' => 'required']
                            );
                            ?>
                            <label class="fg-label">Quem deve visualizar a linha</label>
                        </div>
                    </div>
                </div>
                <br />

                <div class="form-group fg-float">
                    <div class="fg-line">
                        <div class="select">
                            <?php
                            echo $this->tag->select(['linha',
                                $linhas,
                                'useEmpty' => true,
                                'emptyText' => '',
                                'emptyValue' => '',
                                'class' => 'form-control',
                                'required' => 'required']
                            );
                            ?>
                            <label class="fg-label">Linha</label>
                        </div>
                    </div>
                </div>
                <br />
                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-sm m-t-10 waves-effect">Atualizar</button>
                </div>
            </div>

        </div>
        {{ end_form() }}
    </div>
</div>