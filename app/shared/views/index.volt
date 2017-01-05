<html lang="pt-br">
    <!DOCTYPE html>
    <!--[if IE 9 ]><html class="ie9"><![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        {{ get_title() }}

        <link type="text/plain" rel="author" href="{{ static_url("humans.txt") }}" />
        <link rel="apple-touch-icon" href="{{ static_url("assets/icons/apple-touch-icon.png") }}">
        <link rel="shortcut icon" href="{{ static_url("assets/icons/favicon.ico") }}">

        <link href="{{ static_url('assets/css/main.css') }}" rel="stylesheet">

        {{ assets.outputCss('headerCss')}}

        <script type="text/javascript">
            var base_url_intranet = '{{  static_url() }}';
        </script>

    </head>

    <div id="overlay">
        <div class="loading text-center">
            <div class="mpc_preloader">
                <div class="mpc_preloader18"></div>
                <span class="mpc_preloader18_label">Carregando...</span>
            </div>
        </div>
    </div>

    {{ content() }}

    <!-- Older IE warning message -->
    <!--[if lt IE 10]>
        <div class="ie-warning">
            <h1 class="c-white">Aviso!!</h1>
            <p>Você está usando uma versão desatualizada do Internet Explorer, faça o upgrade <br/> a qualquer um dos seguintes navegadores da Web para acessar este site.</p>
            <div class="iew-container">
                <ul class="iew-download">
                    <li>
                        <a href="http://www.google.com/chrome/">
                            <img src="{{ static_url('assets/img/browsers/chrome.png') }}" alt="">
                            <div>Chrome</div>
                        </a>
                    </li>
                    <li>
                        <a href="https://www.mozilla.org/en-US/firefox/new/">
                            <img src="{{ static_url('assets/img/browsers/firefox.png') }}" alt="">
                            <div>Firefox</div>
                        </a>
                    </li>
                    <li>
                        <a href="http://www.opera.com">
                            <img src="{{ static_url('assets/img/browsers/opera.png') }}" alt="">
                            <div>Opera</div>
                        </a>
                    </li>
                    <li>
                        <a href="https://www.apple.com/safari/">
                            <img src="{{ static_url('assets/img/browsers/safari.png') }}" alt="">
                            <div>Safari</div>
                        </a>
                    </li>
                    <li>
                        <a href="http://windows.microsoft.com/en-us/internet-explorer/download-ie">
                            <img src="{{ static_url('assets/img/browsers/ie.png') }}" alt="">
                            <div>IE (Novo)</div>
                        </a>
                    </li>
                </ul>
            </div>
            <p>Desculpe pela inconveniência!</p>
        </div>
    <![endif]-->

    <!-- Javascript Libraries -->

    <script src="{{ static_url('assets/vendors/bower_components/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ static_url('assets/vendors/bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>

    <!-- Placeholder for IE9 -->
    <!--[if IE 9 ]>
        <script src="{{ static_url('assets/vendors/bower_components/jquery-placeholder/jquery.placeholder.min.js') }}"></script>
    <![endif]-->

    {{ assets.outputJs('headerJs')}}

    <script src="{{ static_url('assets/js/plugins.min.js') }}"></script>
    <script src="{{ static_url('assets/js/functions.js') }}"></script>
    <script src="{{ static_url('assets/js/main.min.js') }}"></script>
    {{ assets.outputJs('footerJs') }}
</body>
</html>