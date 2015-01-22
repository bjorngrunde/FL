<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Family Legion</title>
    <meta name="description" content=""/>

    <meta name="viewport" content="width=1000, initial-scale=1.0, maximum-scale=1.0">
    <link href="/css/vendor/less/bootstrap.min.css" rel="stylesheet">
    <link href="/css/admin-style.css" rel="stylesheet">
    <link href="/css/datepicker/default.css" rel="stylesheet">
    <link href="/css/datepicker/default.date.css" rel="stylesheet">
    <link href="/css/datepicker/default.time.css" rel="stylesheet">
    <style>
        body{padding-top: 65px;}
    </style>
    <link rel="shortcut icon" href="img/favicon.ico">
    <!--[if lt IE 9]>
      <script src="/js/vendor/html5shiv.js"></script>
      <script src="/js/vendor/respond.min.js"></script>

    <![endif]-->

  </head>
  <body>
    @include('layouts/partials/admin_nav')
    <section class="container">
        @yield('content')
    </section>
    <section class="container">
       @include('layouts/partials/admin_footer')
    </section>
    <script src="/js/vendor/jquery.min.js"></script>
    <script src="/js/flat-ui.min.js"></script>
    <script src="/js/datepicker/picker.js"></script>
    <script src="/js/datepicker/picker.date.js"></script>
    <script src="/js/datepicker/picker.time.js"></script>
    <script src="/js/datepicker/legacy.js"></script>
    <script src="/js/datepicker/sv_SE.js"></script>
    <!--<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.2.27/angular.min.js"></script> senare -->

    <script>
        $('.datum').pickadate();
    </script>
    <script>
        $('.startTid').pickatime({
            format: ' HH:i'
        });
    </script>
    <script>
        $('.slutTid').pickatime({
            format: ' HH:i'
        });
    </script>
    @yield('javascript')
</body>
</html>