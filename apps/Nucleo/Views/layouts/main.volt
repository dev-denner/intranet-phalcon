<div id="wrap">
  <div id="header">
    <nav class="navbar navbar-inverse">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">{{ titleLogo }}</a>
        </div>
        {# elements.getMenu() #}
      </div>
    </nav>
  </div>

  <div id="main">
    <div class="container">

      {{ flash.output() }}

      <ul class="breadcrumb">
        {# breadcrumbs.generate() #}
      </ul>

      {{ content() }}

      <div class="clearfix"></div>
      <hr>
    </div> <!-- /container -->
  </div>
</div>

<footer id="footer" class="bg-success">
  <div class="container">
    <p>&copy; Company 2015</p>
  </div>
</footer>