<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    {{ get_title() }}
    {{ stylesheet_link('css/main.css') }}
    {{ javascript_include('js/vendor/modernizr.js') }}

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    {{ content() }}

    {{ javascript_include('js/vendor/jquery.js') }}
    {{ javascript_include('js/vendor/bootstrap.min.js') }}
    {{ javascript_include('js/vendor/foundation.min.js') }}
    {{ javascript_include('js/main.min.js') }}
    <script>
      $(document).foundation();
      login();
    </script>
  </body>
</html>