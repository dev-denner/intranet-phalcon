<style type="text/css">
    body{
        background-image: url('{{ static_url() }}assets/img/logos/empresas/{{ logo }}.png');
        background-repeat: no-repeat;
        background-position: 97% 99%;
        background-blend-mode: soft-light;
    }
</style>

<body>
    <header id="header" class="clearfix" data-current-skin="green">
        <ul class="header-inner">
            <li id="menu-trigger" data-trigger="#sidebar">
                <div class="line-wrap">
                    <div class="line top"></div>
                    <div class="line center"></div>
                    <div class="line bottom"></div>
                </div>
            </li>

            <li class="logo">
                <a href="{{ static_url() }}">
                    <img src="{{ static_url('assets/img/logo.jpg') }}" alt="{{ titleLogo }}" title="{{ titleLogo }}" class="img-responsive img-thumbnail" />
                    <h1 class="text-hide hide">{{ titleLogo }}</h1></a>
            </li>

            <li class="pull-right">
                <ul class="top-menu">
                    <li id="toggle-width">
                        <div class="toggle-switch">
                            <input id="tw-switch" type="checkbox" hidden="hidden">
                            <label for="tw-switch" class="ts-helper"></label>
                        </div>
                    </li>
                    <li class="chat-trigger" id="chat-trigger" data-trigger="#chat" title="Aplicativos Externos">
                        <a href=""><i class="tm-icon zmdi zmdi-view-comfy"></i></a>
                    </li>
                </ul>
            </li>
        </ul>

        <!-- Top Search Content -->
        <div id="top-search-wrap">
            <div class="tsw-inner">
                <i id="top-search-close" class="zmdi zmdi-arrow-left"></i>
                <input type="text">
            </div>
        </div>
    </header>

    <section id="main">

        <aside id="sidebar" class="sidebar c-overflow">
            <div class="profile-menu">
                <a href="">
                    <div class="profile-pic">
                        <img src="{{ static_url("assets/img/profile-pics/"~icon_identity~".png") }}" alt="" class="mCS_img_loaded" />
                    </div>

                    <div class="profile-info">
                        {{ auth_identity.nome }} <i class="zmdi zmdi-caret-down"></i>
                    </div>
                </a>

                <ul class="main-menu">
                    <li>
                        <a href="{{ static_url('profile') }}"><i class="fa fa-user"></i> Perfil</a>
                    </li>
                    <li>
                        <a data-action="fullscreen" href="">
                            <i class="zmdi zmdi-fullscreen"></i> Tela Cheia
                        </a>
                    </li>
                    <li>
                        <a  href="{{ static_url('login/logout') }}"><i class="fa fa-power-off"></i> Sair</a>
                    </li>
                </ul>
            </div>
            {{ elements.renderMenuPrincipal() }}
        </aside>

        <aside id="chat" class="sidebar c-overflow">

            <div class="listview">
                <h6 class="m-l-10 text-muted">Aplicativos via Web</h6>

                <!-- WEBMAIL -->
                <a class="lv-item" href="https://webmail2.grupompe.com.br/" target="_blank">
                    <div class="media">
                        <div class="pull-left p-relative">
                            <img class="lv-img-sm" src="{{ static_url('assets/img/logos/apps/zimbra.png') }}" alt="">
                        </div>
                        <div class="media-body">
                            <div class="lv-title">Webmail - Zimbra</div>
                            <small class="lv-small">Acesso ao E-mail pela web</small>
                        </div>
                    </div>
                </a>
                <!-- WEBMAIL -->

                <!-- ECM -->
                <a class="lv-item" href="http://ecm.grupompe.com.br/" target="_blank">
                    <div class="media">
                        <div class="pull-left p-relative">
                            <img class="lv-img-sm" src="{{ static_url('assets/img/logos/apps/totvs.png') }}" alt="">
                        </div>
                        <div class="media-body">
                            <div class="lv-title">ECM - TOTVS</div>
                            <small class="lv-small">Gerenciador de Documentos</small>
                        </div>
                    </div>
                </a>
                <!-- /ECM -->

                <!-- PORTAL RH -->
                <a class="lv-item" href="http://portalrh.grupompe.com.br/" target="_blank">
                    <div class="media">
                        <div class="pull-left p-relative">
                            <img class="lv-img-sm" src="{{ static_url('assets/img/logos/apps/totvs.png') }}" alt="">
                        </div>
                        <div class="media-body">
                            <div class="lv-title">Portal RH - TOTVS</div>
                            <small class="lv-small">Portal RH do Colaborador</small>
                        </div>
                    </div>
                </a>
                <!-- /PORTAL RH -->

                <!-- PROTHEUS WEB -->
                <a class="lv-item" href="http://mpe.totvs.com.br:8088/" target="_blank">
                    <div class="media">
                        <div class="pull-left p-relative">
                            <img class="lv-img-sm" src="{{ static_url('assets/img/logos/apps/totvs.png') }}" alt="">
                        </div>
                        <div class="media-body">
                            <div class="lv-title">Protheus Web - TOTVS</div>
                            <small class="lv-small">Acesso ao ERP pela web</small>
                        </div>
                    </div>
                </a>
                <!-- /PROTHEUS WEB -->

                <!-- BI -->
                <a class="lv-item" href="http://bi.grupompe.com.br/" target="_blank">
                    <div class="media">
                        <div class="pull-left p-relative">
                            <img class="lv-img-sm" src="{{ static_url('assets/img/logos/apps/microstrategy.png') }}" alt="">
                        </div>
                        <div class="media-body">
                            <div class="lv-title">BI - MicroStrategy</div>
                            <small class="lv-small">Relatórios Gerenciais</small>
                        </div>
                    </div>
                </a>
                <!-- /BI -->

                <!-- OTRS -->
                <a class="lv-item" href="http://otrs.grupompe.com.br/" target="_blank">
                    <div class="media">
                        <div class="pull-left p-relative">
                            <img class="lv-img-sm" src="{{ static_url('assets/img/logos/apps/otrs.png') }}" alt="">
                        </div>
                        <div class="media-body">
                            <div class="lv-title">OTRS</div>
                            <small class="lv-small">Gerenciador de Chamados</small>
                        </div>
                    </div>
                </a>
                <!-- /OTRS -->

                <!-- GESTOR -->
                <a class="lv-item" href="https://www.grupompe.com.br/gestor" target="_blank">
                    <div class="media">
                        <div class="pull-left p-relative">
                            <img class="lv-img-sm" src="{{ static_url('assets/img/logos/apps/siscorp.png') }}" alt="">
                        </div>
                        <div class="media-body">
                            <div class="lv-title">Gestor - Siscorp</div>
                            <small class="lv-small">Relatórios</small>
                        </div>
                    </div>
                </a>
                <!-- /GESTOR -->

                <!-- MPEBOX -->
                <a class="lv-item" href="http://mpebox.grupompe.com.br/" target="_blank">
                    <div class="media">
                        <div class="pull-left p-relative">
                            <img class="lv-img-sm" src="{{ static_url('assets/img/logos/apps/owncloud.png') }}" alt="">
                        </div>
                        <div class="media-body">
                            <div class="lv-title">MPEBox - ownCloud</div>
                            <small class="lv-small">Arquivos na Núvem</small>
                        </div>
                    </div>
                </a>
                <!-- /MPEBOX -->

                <!-- SPARK -->
                <a class="lv-item" href="http://chat.grupompe.com.br/" target="_blank">
                    <div class="media">
                        <div class="pull-left p-relative">
                            <img class="lv-img-sm" src="{{ static_url('assets/img/logos/apps/spark.png') }}" alt="">
                        </div>
                        <div class="media-body">
                            <div class="lv-title">Spark Web</div>
                            <small class="lv-small">Chat online</small>
                        </div>
                    </div>
                </a>
                <!-- /SPARK -->

                <h6 class="m-l-10 text-muted">Aplicativos via Terminal Services</h6>

                <!-- SISCORP -->
                <a class="lv-item" href="http://www.grupompe.com.br/download/Siscorp1.RDP" download="">
                    <div class="media">
                        <div class="pull-left p-relative">
                            <img class="lv-img-sm" src="{{ static_url('assets/img/logos/apps/siscorp.png') }}" alt="">
                        </div>
                        <div class="media-body">
                            <div class="lv-title">Siscorp</div>
                            <small class="lv-small">Download TS Siscorp</small>
                        </div>
                    </div>
                </a>
                <!-- /SISCORP -->

                <!-- SISPRO -->
                <a class="lv-item" href="http://www.grupompe.com.br/download/sis.RDP" download="">
                    <div class="media">
                        <div class="pull-left p-relative">
                            <img class="lv-img-sm" src="{{ static_url('assets/img/logos/apps/sispro.png') }}" alt="">
                        </div>
                        <div class="media-body">
                            <div class="lv-title">Sispro</div>
                            <small class="lv-small">Download TS Sispro</small>
                        </div>
                    </div>
                </a>
                <!-- /SISPRO -->

            </div>
        </aside>


        <section id="content">
            <div class="container">
                <ol class="breadcrumb hidden-print">
                    {{ breadcrumbs.output() }}
                </ol>
                {{ flash.output() }}
                {{ content() }}
            </div>
        </section>
    </section>

    <footer id="footer">
        <p>Intranet Grupo MPE &copy;2016 {% if date('Y') != 2016 %} - {{ date('Y') }} {% endif %}
<!-- <br /> Make with <strong>Phalcon</strong> <em>v. <?php echo Phalcon\Version::get(); ?></em>-->
        </p>
    </footer>
    <script src="{{ static_url('assets/vendors/bower_components/bootstrap-sweetalert/dist/sweetalert.min.js') }}"></script>