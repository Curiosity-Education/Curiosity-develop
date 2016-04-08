<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <link rel="icon" type="image/png" href="/packages/images/Curiosity.png">
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">

  {{HTML::style('/packages/css/libs/bootstrap/bootstrap.min.css')}}
  {{HTML::style('/packages/css/libs/awensome/css/font-awesome.min.css')}}
  {{HTML::style('/packages/css/curiosity/style.css')}}
  {{HTML::style('/packages/css/curiosity/loginStyle.css')}}
  <title>Curiosity | login</title>
</head>
<body>
<audio src="/packages/notificaciones/music.mp3" id="notyAudio"></audio>
<!-- Navbar menu -->
<div class="navbar navbar-default navbar-fixed-top bg-blue" role="navigation">
  <div class="container-fluid">
    <div class="navbar-header">
      <button class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
        <span class="icon icon-bar"></span>
        <span class="icon icon-bar"></span>
        <span class="icon icon-bar"></span>
      </button>
      <a href="javascript:void(0)" class="navbar-brand">
				<span>{{HTML::image('/packages/images/Curiosity-mini.png')}}</span>
        Curiosity<small>.com.mx</small>
      </a>
    </div>
    <div class="collapse navbar-collapse">
      <ul class="nav navbar-nav navbar-right main-navigation">
        <li><a href="/" id="link-inicio">Inicio</a></li>
        <li><a href="/registro">Registrarme</a></li>
      </ul>
    </div>
  </div>
</div>

<section class="container">
  <div class="row">
    <div class="col-md-4 col-md-offset-4">
      <div class="login-box">
        <center>
          <img src="/packages/images/avatars/perfil-default.jpg" class="img-responsive img-thumbnail login-img">
        </center>
        <div class="login-txt">
          <form action="" method="post">
            <div class="form-group" id="input-user">
              <div class="input-group">
                <span class="input-group-addon" id="login-icon-user">
                  <span class="fa fa-user"></span>
                </span>
                <input type="text" class="form-control" placeholder="Nombre de Usuario" name="username" id="username">
              </div>
            </div>

            <div class="form-group" id="input-pass" hidden="hidden">
              <div class="input-group">
                <span class="input-group-addon" id="login-icon-pass">
                  <span class="fa fa-lock"></span>
                </span>
                <input type="password" class="form-control" placeholder="Contraseña" name="password" id="password">
              </div>
            </div>
          </form>
        </div>

        <button type="button" name="login-next" class="btn btn-primary btn-block" id="login-next">
          Siguiente
        </button>
        <button type="button" name="login-reg" class="btn btn-warning btn-block" id="login-reg">
          Registrarme
        </button>
        <div hidden="hidden" id="boxButtonsIn">
          <button type="button" name="login-int" class="btn btn-success btn-block" id="login-int">
            Entrar
          </button>
          <button type="button" name="login-back" class="btn btn-danger btn-block" id="login-back">
            Regresar
          </button>
        </div>
        <div class="text-center login-forgot" hidden="hidden">
          <a href="javascript:void(0)">
            Olvide mi usuario y/o contraseña
            <li class="fa fa-question-circle"></li>
          </a>
        </div>
      </div>
    </div>
  </div>
</section>


{{HTML::script('/packages/js/libs/jquery/jquery.min.js')}}
{{HTML::script('/packages/js/libs/bootstrap/bootstrap.min.js')}}
{{HTML::script('/packages/js/libs/noty/packaged/jquery.noty.packaged.min.js')}}
{{HTML::script('/packages/js/libs/noty/layouts/bottomRight.js')}}
{{HTML::script('/packages/js/libs/noty/layouts/topRight.js')}}
{{HTML::script('/packages/js/curiosity/curiosity.js')}}
{{HTML::script('/packages/js/curiosity/login.js')}}
</body>
</html>
