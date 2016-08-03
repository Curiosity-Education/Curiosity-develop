<!DOCTYPE html5>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="icon" type="image/png" href="/packages/images/Curiosity.png">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <style type="text/css">
      body,html{
        background-color:#5a88ba!important;
      }
    </style>

    {{HTML::style('/packages/css/libs/bootstrap/bootstrap.min.css')}}
  	{{HTML::style('/packages/css/libs/animate/animate.min.css')}}
    @yield('mi_css')
    <title>Curiosity | @yield('title')</title>
  </head>
  <body class="hold-transition">
  @yield('zona_game')


  {{HTML::script('/packages/js/libs/jquery/jquery.min.js')}}
  {{HTML::script('/packages/js/libs/bootstrap/bootstrap.min.js')}}
  {{HTML::script('/packages/js/curiosity/curiosity.js')}}
  {{ HTML::script('/packages/js/curiosity/juegos/juegos_layer.js') }}
  {{HTML::script('/packages/js/libs/noty/packaged/jquery.noty.packaged.min.js')}}
  {{HTML::script('/packages/js/libs/noty/layouts/bottomRight.js')}}
  {{HTML::script('/packages/js/libs/noty/layouts/topRight.js')}}
  <script type="text/javascript">
  $(document).ready(function(){
  });
  </script>
  @yield('mi_js')
  </body>
</html>
