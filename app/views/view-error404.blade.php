<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <link rel="icon" type="image/png" href="/packages/images/Curiosity.png">
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">

  {{HTML::style('/packages/css/libs/bootstrap/bootstrap.min.css')}}
  {{HTML::style('/packages/css/libs/awensome/css/font-awesome.min.css')}}
  {{HTML::style('/packages/css/curiosity/userStyle.css')}}  
  <title>Curiosity | ERROR 404</title>
</head>
<body>
  <style media="screen">
    body{
      background-image: url(/packages/images/fondos/fondo.jpg);
      background-position: center;
      background-repeat: no-repeat;
      background-size: cover;
    }

    .well{
      background-color: rgba(0, 0, 0, 0.5);
      border: 1px solid black;
      margin-top: -100px;
    }
  </style>

  <br><br>
  <div class="container-fluid">
    <div class="row">
      <div class="col-xs-12">
        <div class="lockscreen-wrapper">
          <div class="well well-lg" style="color:#fff;">
            <div class="lockscreen-logo">
              <!-- <b>Curiosity</b><small>.com.mx</small> -->
              <center>
                {{HTML::image('/packages/images/pg-curiosity.png', 'alt', array('class' => 'img-responsive wow bounceIn lock-img'))}}
              </center>
            </div>
            <h1 class="text-center"><b>404</b></h1>
            <h4 class="text-center">La pagina que usted intenta buscar no existe</h4>
            <div class="lockscreen-footer text-center">
              Copyright &copy; 2016 | <b>Curiosity</b><br>
              Todos los derechos reservados.
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

{{HTML::script('/packages/js/libs/jquery/jquery.min.js')}}
{{HTML::script('/packages/js/libs/bootstrap/bootstrap.min.js')}}
</body>
</html>
