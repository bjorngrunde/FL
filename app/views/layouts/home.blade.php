<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Family Legion</title>
    <meta name="description" content=""/>

    <meta name="viewport" content="width=1000, initial-scale=1.0, maximum-scale=1.0">
    <link href="/css/vendor/less/bootstrap.min.css" rel="stylesheet">
    <link href="/js/jquery-ui-1.11.2/jquery-ui.css" rel="stylesheet">
    <link href="/css/style.css" rel="stylesheet">
    <style>
        body{padding-top: 75px;}
    </style>
    <link rel="shortcut icon" href="img/favicon.ico">
    <!--[if lt IE 9]>
      <script src="/js/vendor/html5shiv.js"></script>
      <script src="/js/vendor/respond.min.js"></script>
    <![endif]-->
    <script type="text/javascript" src="http://static.wowhead.com/widgets/power.js"></script>
    <script>var wowhead_tooltips = { "colorlinks": true, "iconizelinks": false, "renamelinks": false}</script>


  </head>
  <body>
<section class="container">
    @include('layouts/partials.nav')
</section>
<section class="container">
    <div class="wrapper-container">

       		@yield('content')

    </div>
</section>
<section class="container">
    @include('layouts/partials/admin_footer')
</section>
    <script src="../../js/vendor/jquery.min.js"></script>
   <script src="../../js/flat-ui.min.js"></script>
   <script src="../../js/app.js"></script>
   <script src="../../js/jquery-ui-1.11.2/jquery-ui.min.js"></script>
   <script src="../../js/notifications/notiser.js"></script>
   <script>
    $('#auto').autocomplete({
        source: '/query',
        minLength: 2
    });
   </script>
  <script>

   </script>
   @yield('javascript')
  </body>
</html>