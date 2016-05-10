<body class="login-content">
    {{ flash.output() }}
    {{ content() }}
    <footer id="l-footer">
        Intranet Grupo MPE &copy;2016 {% if date('Y') != 2016 %} - {{ date('Y') }} {% endif %}
    <!--   <br /> Make with <strong>Phalcon</strong> <em>v. <?php echo Phalcon\Version::get(); ?></em>-->
    </footer>