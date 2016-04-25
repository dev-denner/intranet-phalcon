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
                    <img src="{{ static_url('assets/img/logo.png') }}" alt="{{ titleLogo }}" title="{{ titleLogo }}" class="img-responsive img-thumbnail" />
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

                    <li class="hidden-xs" id="chat-trigger" data-trigger="#chat">
                        <a href=""><i class="tm-icon zmdi zmdi-comment-alt-text"></i></a>
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
                        <img src="{{ static_url('assets/img/icons-profile-users/people.png') }}" alt="">
                    </div>

                    <div class="profile-info">
                        {{ auth_identity.nome }} <i class="zmdi zmdi-caret-down"></i>
                    </div>
                </a>

                <ul class="main-menu">
                    <li>
                        <a href="{{ static_url('profile') }}"><i class="zmdi zmdi-account"></i> Ver Perfil</a>
                    </li>
                    <li>
                        <a data-action="fullscreen" href="">
                            <i class="zmdi zmdi-fullscreen"></i> Tela Cheia
                        </a>
                    </li>
                    <!--                    <li>
                                            <a data-action="clear-localstorage" href="">
                                                <i class="zmdi zmdi-delete"></i> Limpar lista de Acessos
                                            </a>
                                        </li>-->
                    <li>
                        <a  href="{{ static_url('login/logout') }}"><i class="zmdi zmdi-time-restore"></i> Logout</a>
                    </li>
                </ul>
            </div>
            {{ elements.renderMenuPrincipal() }}
        </aside>

        <aside id="chat" class="sidebar c-overflow">

            <div class="chat-search">
                <div class="fg-line">
                    <input type="text" class="form-control" placeholder="Search People">
                </div>
            </div>

            <div class="listview">
                <a class="lv-item" href="">
                    <div class="media">
                        <div class="pull-left p-relative">
                            <img class="lv-img-sm" src="" alt="">
                            <i class="chat-status-busy"></i>
                        </div>
                        <div class="media-body">
                            <div class="lv-title">Jonathan Morris</div>
                            <small class="lv-small">Available</small>
                        </div>
                    </div>
                </a>
            </div>
        </aside>


        <section id="content">
            <div class="container">
                {{ breadcrumb.build('bootstrap', null, true, '') }}
                {{ flash.output() }}
                {{ content() }}
            </div>
        </section>  
    </section>

    <footer id="footer">
        <p>&copy; 2016 - {{ date('Y') }} Grupo MPE <br />
            Make with <strong>Phalcon</strong> <em>v. <?php echo Phalcon\Version::get(); ?></em></p>
    </footer>

    <script src="{{ static_url('assets/vendors/bower_components/bootstrap-sweetalert/lib/sweet-alert.min.js') }}"></script>