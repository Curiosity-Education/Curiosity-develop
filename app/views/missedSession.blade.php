<!DOCTYPE html5>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <link rel="icon" type="image/png" href="/packages/images/Curiosity.png">
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">

  {{HTML::style('/packages/css/libs/bootstrap/bootstrap.min.css')}}
  {{HTML::style('/packages/css/libs/awensome/css/font-awesome.min.css')}}
  {{HTML::style('/packages/css/curiosity/userStyle.css')}}
  <title>Curiosity | Sesion vencida</title>
</head>
<body>
  <style media="screen">
    body{
      background-image: url(/packages/images/fondos/fondo.jpg);
      background-position: center;
      background-repeat: no-repeat;
      background-size: 100% 100%;
    }

    .well{
      background-color: rgba(0, 0, 0, 0.5);
      border: 1px solid black;
      margin-top: -100px;
    }
    .lock-img{
        width: 60px;
        height: 45px;
    }
      .btn-default{
        border-radius: 20px;
        border: 1px solid #fff;
        background: transparent;
        color: #fff;
        margin-top: 10px;
      }
      .btn-default:hover{
        color: #3166a3;
      }
      .fa-6x{
        font-size: 10em;
      }
      
      @media (max-width:678px){
          .container-fluid{
              margin-top: 50px;
          }
      }
      @media (max-width:768px){
          .container-fluid{
              margin-top: 50px;
          }
      }
       @media (max-width:1028px){
          .container-fluid{
              margin-top: 50px;
          }
      }
  </style>

  <br><br>
  <div class="container-fluid">
    <div class="row">
      <div class="col-xs-12">
        <div class="lockscreen-wrapper">
          <div class="well well-lg" style="color:#fff;">
            <div class="row">
                <div class="pull-right">
                    {{HTML::image('/packages/images/landing/nuevo_log.png', 'alt', array('class' => 'img-responsive wow bounceIn lock-img'))}}
                </div>
            </div>
            <div class="row">
                <h3 class="text-center"><b>Su sesión fue cerrada!</b></h3>
                <h4 class="text-center"><b>Motivo:</b> Se ha iniciado sesión en otro dispositivo.</h4>
            </div><br>
            <center><i class="fa fa-6x" id="device-icon" aria-hidden="true"></i></center><br>
            <h4 class="text-center"><b><i>Dispositivo actualmente con sesión activa</i></b></h4>
            <b>Nombre del Dispositivo:</b> <span id="device"></span><br>
            <b>Navegador:</b> <span id="browser"></span> <br>
            <b>Version: </b> <span id="app_version"></span><br>
            <b>Fecha de Acceso: </b> <span id="date"></span>
            </h4>
            <center class="text-center"><a class="btn btn-default" href="/login" >Iniciar sesión</a></center>
            <div class="lockscreen-footer text-center">
              Copyright &copy; {{ date('Y') }} | <b>Curiosity</b><br>
              Todos los derechos reservados.
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

{{HTML::script('/packages/js/libs/jquery/jquery.min.js')}}
{{HTML::script('/packages/js/libs/bootstrap/bootstrap.min.js')}}
{{HTML::script('//wurfl.io/wurfl.js')}}
<script>
    $(document).ready(function(){
       $.ajax({
           url:'/last-session',
           method:'POST',
           dataType:'JSON'
       }).done(function(response){
           if(response.mobile == 0)
                $("#device-icon").addClass('fa-desktop');
            else
                $("#device-icon").addClass('fa-mobile');
            $("#device").text(response.device);
            $("#browser").text(response.browser);
            $("#app_version").text(response.app_version);
            $("#date").text(response.date_login.date.replace('.000000',''));
       }).fail(function(error){
           console.log(error);
       }); 
    });    
</script>
</body>
</html>