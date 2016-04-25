{{ content() }}

<div class="row">
    <div class="col-lg-6 col-lg-offset-3">
        <div class="card">
            <div class="card-header">
                <h2>Acesso a Linha <small>Insira os dados para criar um novo acesso a linha.</small></h2>
            </div>

            <div class="card-body card-padding">
                {{ form("telephony/access_line/create", "method":"post", "autocomplete" : "off") }}

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
                    <button type="submit" class="btn btn-primary btn-sm m-t-10 waves-effect">Inserir</button>
                </div>
            </div>

        </div>
        {{ end_form() }}
    </div>
</div>