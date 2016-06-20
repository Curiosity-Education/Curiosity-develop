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
                <span for="username" class="input-group-addon" id="login-icon-user">
                  <span class="fa fa-user"></span>
                </span>
                <input type="text" class="form-control"  style="-webkit-user-select: text;" placeholder="Nombre de Usuario" name="username" id="username"/>
              </div>
            </div>

            <div class="form-group" id="input-pass" hidden="hidden">
              <div class="input-group">
                <span for="password" class="input-group-addon" id="login-icon-pass">
                  <span class="fa fa-lock"></span>
                </span>
                <input type="password" class="form-control" placeholder="Contraseña" style="-webkit-user-select: text;" name="password" id="password">
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
        <button id="btn-fb" class="btn btn-block hide" style="background:#4267B2; color:#f7f7f7;" scope="public_profile,email" ><span class="fa fa-facebook-official"></span> Iniciar sesión con Facebook</button>

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
{{HTML::script('/packages/js/curiosity/desktop-notify.js')}}
{{HTML::script('/packages/js/libs/noty/packaged/jquery.noty.packaged.min.js')}}
{{HTML::script('/packages/js/libs/noty/layouts/bottomRight.js')}}
{{HTML::script('/packages/js/libs/noty/layouts/topRight.js')}}
{{HTML::script('/packages/js/curiosity/curiosity.js')}}
{{HTML::script('/packages/js/curiosity/login.js')}}
<script>

  </script>
<!--
  Below we include the Login Button social plugin. This button uses
  the JavaScript SDK to present a graphical Login button that triggers
  the FB.login() function when clicked.
-->
<script type="text/javascript">
    $(document).ready(function(){
        var statusFB;
          window.fbAsyncInit = function() {
            FB.init({
              appId      : '847478262051734',
              xfbml      : true,
              version    : 'v2.6'
            });
          };
          (function(d, s, id){
             var js, fjs = d.getElementsByTagName(s)[0];
             if (d.getElementById(id)) {return;}
             js = d.createElement(s); js.id = id;
             js.src = "//connect.facebook.net/en_US/sdk.js";
             fjs.parentNode.insertBefore(js, fjs);
           }(document, 'script', 'facebook-jssdk'));
        $('#btn-fb').click(function(e){
              e.preventDefault();
              $(this).attr('disabled',true);
              FB.getLoginStatus(function(response) {
                   if (response.status === 'connected') {
                       FB.api('/me', 'GET',
                          {"fields":"email,first_name,last_name,id,gender,picture"},
                          function(response) {
                            FB.api('/me/picture?width=300&height=300',function(picture){
                                statusFB = {
                                    status:'success',
                                    profile:{
                                        email:response.email,
                                        first_name:response.first_name,
                                        last_name:response.last_name,
                                        id:response.id,
                                        gender:response.gender,
                                        picture:{
                                            data:{
                                                url:"http://graph.facebook.com/"+response.id+"/picture?type=large"
                                            }
                                        }

                                    }
                                }
                                console.log(picture);
                                console.log(statusFB);
                                $.ajax({
                                  url:'login-fb',
                                  method:'POST',
                                  dataType:'JSON',
                                  data:statusFB.profile
                              }).done(function(res){
                                if(res[0] == 'success'){
                                    $curiosity.noty('Bienvenid@ '+statusFB.profile.first_name, 'message','Bienvenido a Curiosity!!',"http://graph.facebook.com/"+response.id+"/picture?type=large");
                                    window.location.href = '/perfil';
                                }
                              }).fail(function(error){

                              });
                            });

                        });
                    }
                    else{
                        FB.login(function(response) {
                            if (response.authResponse) {
                             FB.api('/me', 'post','GET',
                                  {"fields":"email,first_name,last_name,id,gender,picture"},
                                  function(response) {
                                    statusFB = {
                                        status:'success',
                                        data:response
                                    }
                                    $.ajax({
                                          url:'login-fb',
                                          method:'POST',
                                          dataType:'JSON',
                                          data:statusFB.data
                                      }).done(function(response){
                                        if(response[0] == 'success'){
                                            $curiosity.noty('Bienvenid@ '+statusFB.data.first_name, 'message','Bienvenido a Curiosity!!',statusFB.data.picture.data.url);
                                            window.location.href = '/perfil';
                                        }
                                      }).fail(function(error){

                                      });
                                });
                            } else {
                             console.log('User cancelled login or did not fully authorize.');
                            }
                        });

                    }
              });
              if(statusFB != undefined && statusFB.status == 'success' ){

              }
            $(this).attr('disabled',false);
          });
    });
</script>
</body>
</html>
