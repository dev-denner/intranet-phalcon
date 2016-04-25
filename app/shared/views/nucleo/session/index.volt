{{ content() }}

<!-- Login -->
<div class="lc-block toggled" id="l-login">
    {{ form('login/logon', 'method': 'post', 'autocomplete': 'off', 'onsubmit': 'overlay(true)') }}
    <h3>Login</h3>
    <input type="hidden" name="{{ keyToken }}" value="{{ valueToken }}" />
    <div class="input-group m-b-20">
        <span class="input-group-addon"><i class="zmdi zmdi-account"></i></span>
        <div class="fg-line">
            {{ text_field('cpf', 'class': 'form-control', 'placeholder': 'CPF', 'required': 'required', 'maxlength': 14) }}
        </div>
    </div>

    <div class="input-group m-b-20">
        <span class="input-group-addon"><i class="zmdi zmdi-lock zmdi-hc-fw"></i></span>
        <div class="fg-line">
            {{ password_field('password', 'class': 'form-control', 'placeholder': 'Senha', 'required': 'required') }}
        </div>
    </div>

    <div class="clearfix"></div>

    <div class="checkbox">
        <label>
            <input type="checkbox" name="rememberMe">
            <i class="input-helper"></i>
            Mantenha-me conectado
        </label>
    </div>

    <button type="submit" class="btn btn-login bgm-green btn-float">
        <i class="zmdi zmdi-arrow-forward"></i>
    </button>

    {{ end_form() }}
    <ul class="login-navigation">
        <li data-block="#l-register" class="bgm-red">Registrar-se</li>
        <li data-block="#l-forget-password" class="bgm-orange">Esqueceu a Senha?</li>
    </ul>
</div>

<!-- Register -->
<div class="lc-block" id="l-register">
    {{ form('login/register', 'method': 'post', 'autocomplete': 'off', 'onsubmit': 'overlay(true)') }}
    <h3>Registrar-se</h3>
    <input type="hidden" name="{{ keyToken }}" value="{{ valueToken }}" />
    <div class="input-group m-b-20">
        <span class="input-group-addon"><i class="zmdi zmdi-account"></i></span>
        <div class="fg-line">
            {{ text_field('cpf', 'class': 'form-control', 'placeholder': 'CPF', 'required': 'required', 'maxlength': 14, 'onblur': 'getEmailUser(this)') }}
        </div>
    </div>

    <div class="input-group m-b-20">
        <span class="input-group-addon"><i class="zmdi zmdi-email"></i></span>
        <div class="fg-line">
            {{ email_field('email', 'class': 'form-control', 'placeholder': 'E-mail', 'required': 'required') }}
        </div>
    </div>

    <div class="input-group m-b-20">
        <span class="input-group-addon"><i class="zmdi zmdi-calendar zmdi-hc-fw"></i></span>
        <div class="fg-line">
            {{ text_field('dataAdmissao', 'class': 'form-control datepicker', 'placeholder': 'Data Admissão', 'required': 'required') }}
        </div>
    </div>

    <div class="input-group m-b-20">
        <span class="input-group-addon"><i class="fa fa-building zmdi-hc-fw"></i></span>
        <div class="fg-line">
            <div class="select">
                <?php
                echo $this->tag->selectStatic([
                    'empresa',
                    $empresas,
                    'useEmpty' => true,
                    'emptyText' => 'Empresa (Escolha uma opção)',
                    'emptyValue' => '',
                    'class' => 'form-control',
                    'required' => 'required'
                ]);
                ?>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-6">
            <div class="input-group m-b-20">
                <span class="input-group-addon"><i class="zmdi zmdi-lock zmdi-hc-fw"></i></span>
                <div class="fg-line">
                    {{ password_field('password', 'class': 'form-control', 'placeholder': 'Senha', 'required': 'required') }}
                </div>
            </div>
        </div>
        <div class="col-xs-6">
            <div class="input-group m-b-20">
                <span class="input-group-addon"><i class="zmdi zmdi-lock-outline zmdi-hc-fw"></i></span>
                <div class="fg-line">
                    {{ password_field('confirmPassword', 'class': 'form-control', 'placeholder': 'Confirme sua Senha', 'required': 'required') }}
                </div>
            </div>
        </div>
    </div>

    <div class="clearfix"></div>

    <button type="submit" class="btn btn-login bgm-red btn-float">
        <i class="zmdi zmdi-arrow-forward"></i>
    </button>
    {{ end_form() }}

    <ul class="login-navigation">
        <li data-block="#l-login" class="bgm-green">Login</li>
        <li data-block="#l-forget-password" class="bgm-orange">Esqueceu a Senha?</li>
    </ul>
</div>

<!-- Forgot Password -->
<div class="lc-block" id="l-forget-password">
    {{ form('login/forgotPassword', 'method': 'post', 'autocomplete': 'off', 'onsubmit': 'overlay(true)') }}
    <h3>Esqueceu a senha?</h3>
    <input type="hidden" name="{{ keyToken }}" value="{{ valueToken }}" />
    <p class="text-left">Se você esqueceu sua senha digite seu e-mail para uma nova senha temporária.</p>

    <div class="input-group m-b-20">
        <span class="input-group-addon"><i class="zmdi zmdi-email"></i></span>
        <div class="fg-line">
            {{ email_field('email', 'class': 'form-control', 'placeholder': 'E-mail', 'required': 'required') }}
        </div>
    </div>

    <button type="submit" class="btn btn-login bgm-orange btn-float">
        <i class="zmdi zmdi-arrow-forward"></i>
    </button>
    {{ end_form() }}

    <ul class="login-navigation">
        <li data-block="#l-login" class="bgm-green">Login</li>
        <li data-block="#l-register" class="bgm-red">Registrar-se</li>
    </ul>
</div>
