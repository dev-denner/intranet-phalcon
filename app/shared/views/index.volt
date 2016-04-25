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

        <!-- Vendor CSS -->
        <link href="{{ static_url('assets/vendors/bower_components/fullcalendar/dist/fullcalendar.min.css') }}" rel="stylesheet">
        <link href="{{ static_url('assets/vendors/bower_components/animate.css/animate.min.css') }}" rel="stylesheet">
        <link href="{{ static_url('assets/vendors/bower_components/bootstrap-sweetalert/lib/sweet-alert.css') }}" rel="stylesheet">
        <link href="{{ static_url('assets/vendors/bower_components/material-design-iconic-font/dist/css/material-design-iconic-font.min.css') }}" rel="stylesheet">
        <link href="{{ static_url('assets/vendors/bower_components/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.min.css" rel="stylesheet') }}" rel="stylesheet">
        <link href="{{ static_url('assets/vendors/bootgrid/jquery.bootgrid.min.css" rel="stylesheet') }}">

        <link href="{{ static_url('assets/css/main.css') }}" rel="stylesheet">

        {{ assets.outputCss('headerCss')}}

        <script src="{{ static_url('assets/vendors/bower_components/jquery/dist/jquery.min.js') }}"></script>
        <script src="{{ static_url('assets/vendors/bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>

        {{ assets.outputJs('headerJs')}}

    </head>

    {{ content() }}

    <!-- Older IE warning message -->
    <!--[if lt IE 9]>
        <div class="ie-warning">
            <h1 class="c-white">Warning!!</h1>
            <p>You are using an outdated version of Internet Explorer, please upgrade <br/>to any of the following web browsers to access this website.</p>
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
                            <div>IE (New)</div>
                        </a>
                    </li>
                </ul>
            </div>
            <p>Sorry for the inconvenience!</p>
        </div>
    <![endif]-->

    <!-- Javascript Libraries -->

    <script src="{{ static_url('assets/vendors/bower_components/moment/min/moment.min.js') }}"></script>
    <script src="{{ static_url('assets/vendors/bower_components/fullcalendar/dist/fullcalendar.min.js') }}"></script>
    <script src="{{ static_url('assets/vendors/bower_components/simpleWeather/jquery.simpleWeather.min.js') }}"></script>
    <script src="{{ static_url('assets/vendors/bower_components/Waves/dist/waves.min.js') }}"></script>
    <script src="{{ static_url('assets/vendors/bootstrap-growl/bootstrap-growl.min.js') }}"></script>

    <script src="{{ static_url('assets/vendors/bower_components/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js') }}"></script>
    <script src="{{ static_url('assets/vendors/bootgrid/jquery.bootgrid.updated.min.js') }}"></script>

    <!-- Placeholder for IE9 -->
    <!--[if IE 9 ]>
        <script src="{{ static_url('assets/vendors/bower_components/jquery-placeholder/jquery.placeholder.min.js') }}"></script>
    <![endif]-->

    <script src="{{ static_url('assets/js/functions.js') }}"></script>
    <script src="{{ static_url('assets/js/main.min.js') }}"></script>
    {{ assets.outputJs('footerJs') }}

    <div id="overlay">
        <div class="loading text-center">
            <figure>
                <img src="{{ static_url('assets/img/cubo-empresas.gif') }}" class="img-responsive img-circle" alt="Cubo MPE" title="Carregando..." />
            </figure>
            <p class="c-black f-12">Carregando dados. <br />Aguarde...</p>
        </div>

    </div>
</body>
</html>