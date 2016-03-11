<body>
  <header id="header" class="clearfix" data-current-skin="blue">
    <ul class="header-inner">
      <li id="menu-trigger" data-trigger="#sidebar">
        <div class="line-wrap">
          <div class="line top"></div>
          <div class="line center"></div>
          <div class="line bottom"></div>
        </div>
      </li>

      <li class="logo hidden-xs">
        <a href="index.html">{{ titleLogo }}</a>
      </li>

      <li class="pull-right">
        <ul class="top-menu">
          <li id="toggle-width">
            <div class="toggle-switch">
              <input id="tw-switch" type="checkbox" hidden="hidden">
              <label for="tw-switch" class="ts-helper"></label>
            </div>
          </li>
          <li id="top-search">
            <a href=""><i class="tm-icon zmdi zmdi-search"></i></a>
          </li>

          <li class="dropdown">
            <a data-toggle="dropdown" href="">
              <i class="tm-icon zmdi zmdi-email"></i>

            </a>
            <div class="dropdown-menu dropdown-menu-lg pull-right">
              <div class="listview">
                <div class="lv-header">
                  Messages
                </div>
                <div class="lv-body">
                  <a class="lv-item" href="">
                    <div class="media">
                      <div class="pull-left">
                        <img class="lv-img-sm" src="" alt="">
                      </div>
                      <div class="media-body">
                        <div class="lv-title">David Belle</div>
                        <small class="lv-small">Cum sociis natoque penatibus et magnis dis parturient montes</small>
                      </div>
                    </div>
                  </a>

                </div>
                <a class="lv-footer" href="">View All</a>
              </div>
            </div>
          </li>
          <li class="dropdown">
            <a data-toggle="dropdown" href="">
              <i class="tm-icon zmdi zmdi-notifications"></i>
              <i class="tmn-counts">9</i>
            </a>
            <div class="dropdown-menu dropdown-menu-lg pull-right">
              <div class="listview" id="notifications">
                <div class="lv-header">
                  Notification
                  <ul class="actions">
                    <li class="dropdown">
                      <a href="" data-clear="notification">
                        <i class="zmdi zmdi-check-all"></i>
                      </a>
                    </li>
                  </ul>
                </div>
                <div class="lv-body">
                  <a class="lv-item" href="">
                    <div class="media">
                      <div class="pull-left">
                        <img class="lv-img-sm" src="" alt="">
                      </div>
                      <div class="media-body">
                        <div class="lv-title">David Belle</div>
                        <small class="lv-small">Cum sociis natoque penatibus et magnis dis parturient montes</small>
                      </div>
                    </div>
                  </a>
                </div>

                <a class="lv-footer" href="">View Previous</a>
              </div>

            </div>
          </li>
          <li class="dropdown">
            <a data-toggle="dropdown" href=""><i class="tm-icon zmdi zmdi-more-vert"></i></a>
            <ul class="dropdown-menu dm-icon pull-right">
              <li class="skin-switch hidden-xs">
                <span class="ss-skin bgm-lightblue" data-skin="lightblue"></span>
                <span class="ss-skin bgm-bluegray" data-skin="bluegray"></span>
                <span class="ss-skin bgm-cyan" data-skin="cyan"></span>
                <span class="ss-skin bgm-teal" data-skin="teal"></span>
                <span class="ss-skin bgm-orange" data-skin="orange"></span>
                <span class="ss-skin bgm-blue" data-skin="blue"></span>
              </li>
              <li class="divider hidden-xs"></li>
              <li class="hidden-xs">
                <a data-action="fullscreen" href="">
                  <i class="zmdi zmdi-fullscreen"></i> Toggle Fullscreen
                </a>
              </li>
              <li>
                <a data-action="clear-localstorage" href="">
                  <i class="zmdi zmdi-delete"></i> Clear Local Storage
                </a>
              </li>
            </ul>
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
    {# elements.getMenu() #}
    <aside id="sidebar" class="sidebar c-overflow">
      <div class="profile-menu">
        <a href="">
          <div class="profile-pic">
            <img src="{{ static_url('assets/img/profile-pics/1.jpg') }}" alt="">
          </div>

          <div class="profile-info">
            Denner Fernandes <i class="zmdi zmdi-caret-down"></i>
          </div>
        </a>

        <ul class="main-menu">
          <li>
            <a href="profile-about.html"><i class="zmdi zmdi-account"></i> Ver Perfil</a>
          </li>
          <li>
            <a  href=""><i class="zmdi zmdi-time-restore"></i> Logout</a>
          </li>
        </ul>
      </div>

      <ul class="main-menu">
        <li>
          <a href="index.html"><i class="zmdi zmdi-home"></i> Home</a>
        </li>
        <li class="sub-menu active toggled">
          <a href=""><i class="zmdi zmdi-view-compact"></i> Headers</a>

          <ul>
            <li><a href="textual-menu.html">Textual menu</a></li>
            <li><a href="image-logo.html">Image logo</a></li>
            <li><a href="top-mainmenu.html">Mainmenu on top</a></li>
          </ul>
        </li>
      </ul>
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

        <ul class="breadcrumb">
          {# breadcrumbs.generate() #}
        </ul>

        {{ flash.output() }}

        {{ content() }}

      </div>
    </section>
  </section>

  <footer id="footer">
    &copy; 2016 - {{ date('Y') }} Grupo MPE <br />
    Make with <strong>Phalcon</strong> <em>v. <?php echo Phalcon\Version::get(); ?></em>
  </footer>

  <script src="{{ static_url('assets/vendors/bower_components/bootstrap-sweetalert/lib/sweet-alert.min.js') }}"></script>