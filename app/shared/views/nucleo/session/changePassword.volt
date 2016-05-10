{{ content() }}

<!-- Login -->
<div class="lc-block toggled" id="l-login">
    {{ form('change-password', 'method': 'post', 'autocomplete': 'off', 'onsubmit': 'overlay(true)') }}
    <h3>Altere sua Senha</h3>
    <input type="hidden" name="{{ keyToken }}" value="{{ valueToken }}" />
    <p><b>Senha do usuário:</b> {{ name }}</p>
    <div class="input-group m-b-20 fg-float">
        <span class="input-group-addon"><i class="zmdi zmdi-lock zmdi-hc-fw"></i></span>
        <div class="fg-line">
            {{ password_field('password', 'class': 'form-control', 'required': 'required') }}
            <label class="fg-label">Senha</label>
        </div>
    </div>

    <div class="input-group m-b-20 fg-float">
        <span class="input-group-addon"><i class="zmdi zmdi-lock-outline zmdi-hc-fw"></i></span>
        <div class="fg-line">
            {{ password_field('confirmPassword', 'class': 'form-control', 'required': 'required') }}
            <label class="fg-label">Confirme sua Senha</label>
        </div>
    </div>

    <button type="submit" class="btn btn-login bgm-indigo btn-float">
        <i class="zmdi zmdi-arrow-forward"></i>
    </button>

    {{ end_form() }}
</div>
