<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="icon" type="image/png" href="/packages/images/Curiosity.png">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">

    {{ HTML::style('/packages/css/libs/bootstrap/bootstrap.min.css')}}
    {{ HTML::style('/packages/css/libs/awensome/css/font-awesome.min.css')}}
  	{{ HTML::style('/packages/css/libs/animate/animate.min.css')}}
    {{ HTML::style('/packages/css/skins/_all-skins.min.css') }}
    {{ HTML::style('/packages/css/curiosity/userStyle.css') }}
    {{ HTML::style('/packages/css/curiosity/vistaEstandar.css') }}
    {{ HTML::style('/packages/css/libs/tooltipster/tooltipster.css') }}
    {{ HTML::style('/packages/css/libs/sweetalert/sweetalert.css') }}
    @yield('mi_css')
    <title>Curiosity | @yield('title')</title>
  </head>
  <body class="hold-transition skin-blue sidebar-mini">
    <audio src="/packages/notificaciones/music.mp3" id="notyAudio"></audio>
    <div class="wrapper">

      <header class="main-header">
        <div class="logo">
          <span class="logo-mini">
            {{HTML::image('/packages/images/Curiosity-mini.png')}}
          </span>
          <span class="logo-lg">
            {{HTML::image('/packages/images/Curiosity-mini.png')}}
            <b>Curiosity<small>.com.mx</small></b>
          </span>
        </div>

        <!-- Header Navbar -->
        <nav class="navbar navbar-static-top" role="navigation">
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button"></a>
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">

              <!-- Menu de cuenta de usuario -->
              <li class="dropdown user user-menu hidden-xs">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  {{HTML::image(User::get_imagen_perfil(Auth::user()->id), 'alt', array('class' => 'user-image img-profile'))}}
                  <span class="hidden-xs">{{Auth::user()->persona()->first()->nombre}} {{Auth::user()->persona()->first()->apellido_paterno}}</span>
                </a>
                <ul class="dropdown-menu">
                  <li class="user-header">
                    <!-- Ìmagen de perfil de la parte superior derecha -->
                    {{HTML::image(User::get_imagen_perfil(Auth::user()->id), 'alt', array('class' => 'img-circle img-profile'))}}
                    <p>
                      <b>
                      <small><b>¡ Soy Curiosity !</b></small>
                    </p>
                  </li>

                  <!-- Footer Menu -->
                  <li class="user-footer">
                    <div class="pull-left">
                      <a href="#" class="btn btn-primary">
                        <span class="fa fa-gear"></span>
                        Editar Perfil
                      </a>
                    </div>
                    <div class="pull-right">
                      <a href="/logout" class="btn btn-danger">
                        <span class="fa fa-arrow-circle-right"></span>
                        Cerrar Sesión
                      </a>
                    </div>
                  </li>
                </ul>
              </li>

            </ul>
          </div>
        </nav>
      </header>

      <!-- Barra lateral izquierda con menu y estatus -->
      <aside class="main-sidebar">
        <section class="sidebar">
          <br>
          <div class="user-panel">
            <div class="pull-left image">
            <!-- Imagen de Perfil de la parte del menú -->
            {{HTML::image(User::get_imagen_perfil(Auth::user()->id), 'alt', array('class' => 'img-circle img-profile'))}}
            </div>
            <div class="pull-left info">
              <p>{{Auth::user()->username}}</p>
              Tel: {{Auth::user()->persona()->first()->telefono}}
            </div>
          </div>

          <!-- menu en la barra lateral izquierda -->
          <br>
          <ul class="sidebar-menu">

            <li id="menuPerfil">
              <a href="/perfil">
                <i class="fa fa-user"></i>
                <span>Perfil</span>
              </a>
            </li>
            @if(Entrust::can('realizar_actividades'))
              <li id="menuNivel">
                <a href="/nivel">
                  <i class="fa fa-graduation-cap"></i>
                  <span>Actividades</span>
                </a>
              </li>
            @endif

            @if(Entrust::can('gestionar_niveles'))
              <li id="menuAdminNivel">
                <a href="/adminNivel">
                  <i class="fa fa-gears"></i>
                  <span>Gestión Contenido</span>
                </a>
              </li>
            @endif

            @if(Entrust::can('gestionar_escuelas'))
              <li id="menuAdminEscuela">
                <a href="/adminEscuela">
                  <i class="fa fa-gears"></i>
                  <span>Gestión Escuelas</span>
                </a>
              </li>
            @endif

            @if(Entrust::can('gestionar_profesores'))
              <li id="menuAdminProfesor">
                <a href="/adminProfesor">
                  <i class="fa fa-gears"></i>
                  <span>Gestión Profesores</span>
                </a>
              </li>
            @endif

            <li class="visible-xs">
              <a href="/">
                <i class="fa fa-arrow-circle-right"></i>
                <span>Salir</span>
              </a>
            </li>
        </ul>
      </section>
    </aside>

      <!-- Zona de Contenido general -->
      <div class="content-wrapper">
        <!-- Encabezado de la pagina -->
        <section class="content-header">
          <div class="well">
            <h1>
              @yield('titulo_contenido')
            </h1>
            <div class="custom-brands">
              <ul>
                @yield('migas')
              </ul>
            </div>
          </div>
        </section>

        <!-- Contenido principal -->
        <section class="content">
            <div class="container-fluid">
              <div class="row" id="make-all">
              <!-- panel para biblioteca de estudio -->
                @yield('panel_opcion')
              </div>
            </div>
        </section>
      </div>

      <!-- Footer principal general -->
      <footer class="main-footer">
        <div class="pull-right hidden-xs">
          <small>
            <b>¡Qué tu curiosidad no tenga límites!</b>
          </small>
        </div>
        <strong>Copyright &copy; 2016 <a href="javascript:void(0)">Curiosity.com.mx</a></strong>
      </footer>

  {{HTML::script('/packages/js/libs/jquery/jquery.min.js')}}
  {{HTML::script('/packages/js/libs/bootstrap/bootstrap.min.js')}}
  {{HTML::script('/packages/js/app.min.js')}}
  {{HTML::script('/packages/js/libs/sweetalert/sweetalert.min.js')}}
  {{HTML::script('/packages/js/libs/noty/packaged/jquery.noty.packaged.min.js')}}
  {{HTML::script('/packages/js/libs/noty/layouts/bottomRight.js')}}
  {{HTML::script('/packages/js/libs/noty/layouts/topRight.js')}}
  {{HTML::script('/packages/js/curiosity/curiosity.js')}}
  {{HTML::script('/packages/js/libs/tooltipster/jquery.tooltipster.min.js')}}

  <script type="text/javascript">
    $(document).ready(function(){
      $(".tooltipShow").tooltipster({
        position : 'bottom',
        touchDevices: true
      });
    });
  </script>

  @yield('mi_js')
  </body>
</html>
