<!DOCTYPE html5>
<html lang="es">
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <link rel="icon" type="image/png" href="/packages/images/landing/logo.png">
      <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">

      {{ HTML::style('/packages/css/libs/bootstrap/bootstrap.min.css')}}
      {{ HTML::style('/packages/css/libs/awensome/css/font-awesome.min.css')}}
      {{ HTML::style('/packages/css/libs/animate/animate.min.css')}}
      {{ HTML::style('/packages/css/curiosity/preloadSpinner.css') }}
      {{ HTML::style('/packages/css/curiosity/alert.css') }}
      {{ HTML::style('/packages/css/curiosity/userStyle.css') }}
      {{ HTML::style('/packages/css/curiosity/vistaEstandar.css') }}
      {{ HTML::style('/packages/css/libs/tooltipster/tooltipster.css') }}
      {{ HTML::style('/packages/css/libs/sweetalert/sweetalert.css') }}
      {{HTML::style('/packages/css/libs/notificacion_toast/jquery.toast.css')}}
      <link rel="stylesheet" href="/packages/css/skins/{{User::getSkin()->skin}}.css">
      @yield('mi_css')
      <title>Curiosity | @yield('title')</title>
   </head>
   <body class="hold-transition {{User::getSkin()->skin}} sidebar-mini sidebar-collapse">
      <audio src="/packages/notificaciones/music.mp3" id="notyAudio"></audio>
      <div class="wrapper">

         <header class="main-header" >
            <div class="logo">
               <span class="logo-mini">
                  <img src="/packages/images/Curiosity-mini.png" style="width:30px; height:30px;">
               </span>
               <span class="logo-lg">
                  <img src="/packages/images/Curiosity-mini.png" style="width:30px; height:30px;">
                  &nbsp;
                  <b>Curiosity Edu<small></small></b>
               </span>
            </div>

            <!-- Header Navbar -->
            <nav class="navbar navbar-fixed-top" role="navigation">
               <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button" title="ocultar/mostrar menu"></a>
               <div class="navbar-custom-menu">
                  <ul class="nav navbar-nav">

                     <!-- Menu de cuenta de usuario -->
                     <li class="dropdown user user-menu hidden-xs">
                        <a id="menu-usuario" href="#" class="dropdown-toggle" data-toggle="dropdown">
                           {{HTML::image(User::get_imagen_perfil(Auth::user()->id), 'alt', array('class' => 'user-image img-profile'))}}
                           {{Auth::user()->persona()->first()->nombre}} {{Auth::user()->persona()->first()->apellido_paterno}}
                           <i class="fa fa-angle-down" id="arrow"></i>
                        </a>
                        <ul class="dropdown-menu">
                           <li class="user-header">
                              <img src="/packages/images/avatars/lupa.png" alt="" class="img-profile">
                              <p>
                                 @if(Auth::user()->hasRole('root'))
                                 <small><b>¡ Soy curiosity !</b></small>
                                 @endif
                                 @if(Auth::user()->hasRole('padre') || Auth::user()->hasRole('padre_free') || Auth::user()->hasRole('demo_padre'))
                                 <small><b>¡ Soy curiosity !</b></small>
                                 @endif
                                 @if(Auth::user()->hasRole('hijo') || Auth::user()->hasRole('hijo_free') || Auth::user()->hasRole('demo_hijo'))
                                 <small id="txtprofchild"><b>{{Lang::get('landingPage.eslogan')}}</b></small>
                                 @endif
                              </p>
                           </li>

                           <!-- Footer Menu -->
                           <li class="user-footer">
                              <div class="text-center">
                                 <a href="/logout" class="btn form-control" style="width:90%; background-color:#44c6ee; color:white; border-radius:50px; outline:none;">
                                    <span class="fa fa-sign-out"></span>
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
         <aside class="main-sidebar" id="main-sidebar">
            <section class="sidebar">

               <div class="user-panel">
                  <div class="pull-left image">
                     <!-- Imagen de Perfil de la parte del menú -->
                     {{HTML::image(User::get_imagen_perfil(Auth::user()->id), 'alt', array('class' => 'img-circle img-profile'))}}
                  </div>
                  <div class="pull-left info">
                     <h4 style="">{{Auth::user()->username}}</h4>
                     <small></small>
                  </div>
               </div><hr id="hrAside">

               <!-- menu en la barra lateral izquierda -->

               <ul class="sidebar-menu">
                  <!-- Inicio -->
                  @if(Entrust::can('realizar_actividades'))
                  <li id="menuInicioAct">
                     <a href="/inicio">
                        <i class="fa fa-home"></i>
                        <span>Inicio</span>
                     </a>
                     <div class="arrowAsideActive"></div>
                  </li>
                  @endif

                  @if(Entrust::can('realizar_actividades'))
                  <li id="menuNivel">
                     <a href="/nivel">
                        <i class="fa fa-graduation-cap"></i>
                        <span>Actividades</span>
                     </a>
                     <div class="arrowAsideActive"></div>
                  </li>
                  @endif

                  <!-- Perfil de usuario -->
                  <li id="menuPerfil">
                     <a href="/perfil">
                        <i class="fa fa-user"></i>
                        <span>Mi perfil</span>
                     </a>
                     <div class="arrowAsideActive"></div>
                  </li>

                  @if(Auth::user()->hasRole('padre') || Auth::user()->hasRole('padre_free') || Auth::user()->hasRole('demo_padre'))
                  <li id="menuMisHijos">
                     <a href="/misHijos">
                        <i class="fa fa-child"></i>
                        <span>Mis hijos</span>
                     </a>
                     <div class="arrowAsideActive"></div>
                  </li>
                  <li id="menuPuntajes">
                     <a href="/puntajes">
                        <i class="fa fa-line-chart"></i>
                        <span>Estadísticas</span>
                     </a>
                     <div class="arrowAsideActive"></div>
                  </li>
                  <!-- <li id="menuAlertas">
                     <a href="/alertas">
                        <i class="fa fa-bullhorn"></i>
                        <span>Alertas</span>
                     </a>
                     <div class="arrowAsideActive"></div>
                  </li>
                  <li id="menuPremium" class="">
                     <button class="btn form-control" id="premium">
                        <i class="fa fa-diamond"></i>
                        <span>Premium</span>
                     </button>
                     <div class="arrowAsideActive"></div>
                  </li> -->
                  @endif

                  @if(Auth::user()->hasRole('hijo') || Auth::user()->hasRole('hijo_free') || Auth::user()->hasRole('demo_hijo'))
                  <li id="menuTiendaAvatar">
                     <a href="/tienda">
                        <i class="fa fa-shopping-bag"></i>
                        <span>Tienda Curiosity</span>
                     </a>
                     <div class="arrowAsideActive"></div>
                  </li>

                  <li id="menuDatos" hidden="hidden">
                     <a href="javascript:void(0)">
                        <i class="fa fa-pencil-square-o"></i>
                        <span>Editar mis datos</span>
                     </a>
                     <div class="arrowAsideActive"></div>
                  </li>
                  @endif

                  @if(Entrust::can('gestionar_niveles'))
                  <li id="menuAdminNivel">
                     <a href="/adminNivel">
                        <i class="fa fa-cubes"></i>
                        <span>Gestión Contenido</span>
                     </a>
                     <div class="arrowAsideActive"></div>
                  </li>
                  @endif

                  @if(Entrust::can('gestionar_actividades'))
                  <li id="videosInicio">
                     <a href="/videoInicio">
                        <i class="fa fa-play-circle"></i>
                        <span>Videos de Inicio</span>
                     </a>
                     <div class="arrowAsideActive"></div>
                  </li>
                  @endif

                  @if(Entrust::can('gestionar_escuelas'))
                  <li id="menuAdminEscuela">
                     <a href="/adminEscuela">
                        <i class="fa fa-institution"></i>
                        <span>Gestión Escuelas</span>
                     </a>
                     <div class="arrowAsideActive"></div>
                  </li>
                  @endif

                  @if(Entrust::can('gestionar_profesores'))
                  <li id="menuAdminProfesor">
                     <a href="/adminProfesor">
                        <i class="fa fa-group"></i>
                        <span>Gestión Profesores</span>
                     </a>
                     <div class="arrowAsideActive"></div>
                  </li>
                  @endif

                  @if(Entrust::can('gestionar_avatar'))
                  <li id="menuAdminAvatar">
                     <a href="/adminavatar">
                        <i class="fa fa-bug"></i>
                        <span>Gestión Avatar</span>
                     </a>
                     <div class="arrowAsideActive"></div>
                  </li>
                  @endif

                  @if(Entrust::can('gestionar_novedades'))
                  <li id="menuAdminNovedad">
                     <a href="/vistaNovedades">
                        <i class="fa fa-file-text"></i>
                        <span>Gestión Novedades</span>
                     </a>
                     <div class="arrowAsideActive"></div>
                  </li>
                  @endif
                  @if(Entrust::can('gestionar_avatar'))
                  <li id="menuAdminNavegadores">
                     <a href="/getBrowsers">
                        <i class="fa fa-chrome"></i>
                        <span>Navegadores</span>
                     </a>
                     <div class="arrowAsideActive"></div>
                  </li>
                  @endif
                  @if(Entrust::can('gestionar_escuelas'))
                  <li id="linkVendedores">
                     <a href="/lista-vendedores">
                        <i class="fa fa-address-book"></i>
                        <span>Vendedores</span>
                     </a>
                     <div class="arrowAsideActive"></div>
                  </li>
                  @endif

                  <li class="visible-xs">
                     <a href="/logout" class="btn" id="logOut">
                        <i class="fa fa-sign-out"></i>
                        <span>Cerrar sesión</span>
                     </a>
                     <div class="arrowAsideActive"></div>
                  </li>
               </ul>
            </section>
         </aside>

         <!-- Preloader web -->
         <div id="cssload-pgloading">
            <div class="cssload-loadingwrap">
               <ul class="cssload-bokeh">
                  <li></li>
                  <li></li>
                  <li></li>
                  <li></li>
               </ul>
            </div>
         </div>
         <!-- Fin de preloader -->

         <!-- Zona de Contenido general -->
         <div class="content-wrapper" hidden="hidden"><br><br>
            <!-- Contenido principal -->
            <section class="content_body">
               <div class="container-fluid">
                  <div class="row" id="make-all">
                     @if (!Auth::user()->hasRole('padre') and !Auth::user()->hasRole('padre_free') and !Auth::user()->hasRole('demo_padre'))
                     <div class="form-group" id="navSearch">
                        <div class="input-group">
                           <form action="/buscarTema" method="post" id="formFind">
                              <input type="text" class="pull-left form-control" id="navbar-search-input" name="buscarTema" placeholder="Buscar Temas">
                           </form>
                           <span class="input-group-addon" id="btnfind">
                              <spna class="fa fa-search"></spna>
                           </span>
                        </div>
                     </div>
                     @endif
                     @yield('panel_opcion') <!-- panel para contenido en general -->
                  </div>
               </div>
            </section>
         </div>

         <!-- modal premium alert -->
         <div class="modal fade" id="modalPremium" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true" data-keyboard="false">
            <div class="modal-dialog">
               <div class="modal-content">
                  <div class="modal-body text-center">
                     <button type="button" class="close" data-dismiss="modal" id="closePrem" aria-hidden="true">&times;</button>
                     <span class="fa fa-star" id="iconPrem"></span>
                     <br><br>
                     <h4 class="tituloPrem">Curiosity Premium</h4>
                     <br>
                     <p class="text-center bodyPrem">
                        Este Tema se encuentra bloqueado por hoy.<br><br>
                        Para poder practicar en este juego es necesario que seas un usuario premium. <br>
                        Nos encontramos en fase Beta actualmente. <br>
                        En poco tiempo podrás cambiar tu cuenta a premium ¡Cuentale a tus papás!
                     </p>
                     <br>
                     <!-- <button type="button" id="botonPremium" class="btn btn-primary btn-lg">
                        Notificarle a mis Padres
                     </button> -->
                  </div>
               </div>
            </div>
         </div>

      {{HTML::script('/packages/js/libs/jquery/jquery.min.js')}}
      <script type="text/javascript">
         function finalizado (){
            $("#cssload-pgloading").fadeOut('slow', function() {
               setTimeout(function () {
                  $(".content-wrapper").fadeIn('slow');
               }, 500);
            });
         };
         window.onload = function(){
            finalizado();
         };
      </script>
      {{HTML::script('/packages/js/libs/bootstrap/bootstrap.min.js')}}
      {{HTML::script('/packages/js/app.min.js')}}
      {{HTML::script('/packages/js/curiosity/desktop-notify.js')}}
      {{HTML::script('/packages/js/curiosity/alert.js')}}
      {{HTML::script('/packages/js/libs/sweetalert/sweetalert.min.js')}}
      {{HTML::script('/packages/js/curiosity/curiosity.js')}}
      {{HTML::script('/packages/js/libs/mask/jquery-mask/jquery.mask.js')}}
      {{HTML::script('/packages/js/libs/tooltipster/jquery.tooltipster.min.js')}}
      {{HTML::script('/packages/js/libs/validation/jquery.validate.min.js')}}
      {{HTML::script('/packages/js/libs/validation/localization/messages_es.min.js')}}
      {{HTML::script('/packages/js/libs/notificacion_toast/jquery.toast.js')}}
      {{HTML::script('/packages/js/libs/knob/jquery.knob.js')}}
      {{HTML::script('/packages/js/libs/highcharts/highcharts.js')}}
      {{HTML::script('/packages/js/libs/highcharts/highcharts-more.js')}}
      {{HTML::script('/packages/js/curiosity/finding.js')}}

      <script type="text/javascript">
         $(document).ready(function(){

            $('#menuDatos').click(function(){
               if($(window).width() <= 767){
                  $(".sidebar-toggle").trigger("click");
               }
            });

            $(function () {
               $('[data-toggle="tooltip"]').tooltip()
            });

            $(".tooltipShow").tooltipster({
               position : 'bottom',
               touchDevices: true
            });


            $(".tooltipShowRight").tooltipster({
               position : 'right',
               touchDevices: true
            });

            var source;

            if (window.EventSource) {
               var source = new EventSource('/recordatorio');
               source.onopen = function (e) {
                  //console.log(e);
               };

               source.onerror = function (e) {
                  //console.log(e);
               };

               source.addEventListener('message',function(e){
                  var data = JSON.parse(e.data);
                  $.each(data,function(i,array){
                     $curiosity.noty(array.mensaje,"message","Papa dice: ","packages/images/perfil/"+array.foto_perfil);
                  });
               },false);

            }

         });
      </script>
      @yield('mi_js')
   </body>
</html>
