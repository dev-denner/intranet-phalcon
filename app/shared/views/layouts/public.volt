<body class="login-content">
  {{ flash.output() }}
  {{ content() }}
  <footer id="l-footer">
    &copy; 2016 - {{ date('Y') }} Grupo MPE <br />
    Make with <strong>Phalcon</strong> <em>v. <?php echo Phalcon\Version::get(); ?></em>
  </footer>