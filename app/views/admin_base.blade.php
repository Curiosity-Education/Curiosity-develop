<!DOCTYPE html>
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
    {{ HTML::style('/packages/css/curiosity/preloadSpinner.css') }}
    {{ HTML::style('/packages/css/libs/tooltipster/tooltipster.css') }}
    {{ HTML::style('/packages/css/libs/sweetalert/sweetalert.css') }}
    {{HTML::style('/packages/css/libs/cropper/cropper.min.css')}}
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
                  {{Auth::user()->persona()->first()->nombre}} {{Auth::user()->persona()->first()->apellido_paterno}} <i class="fa fa-angle-down" id="arrow"></i>
                </a>
                <ul class="dropdown-menu">
                  <li class="user-header">
                    <!-- Ìmagen de perfil de la parte superior derecha -->
                    <!--{{HTML::image(User::get_imagen_perfil(Auth::user()->id), 'alt', array('class' => 'img-circle img-profile'))}}-->
                    <img src="/packages/images/avatars/lupa.png" alt="" class="img-profile">
                    <p>
                     @if(Auth::user()->hasRole('root'))
                      	<small><b>¡ Soy curiosity !</b></small>
                      @endif
                      @if(Auth::user()->hasRole('padre') || Auth::user()->hasRole('padre_free') || Auth::user()->hasRole('demo_padre'))
                      	<small><b>¡ Soy curiosity !</b></small>
                      @endif
                      @if(Auth::user()->hasRole('hijo') || Auth::user()->hasRole('hijo_free') || Auth::user()->hasRole('demo_hijo'))
                      	<small><b>¡ Qué tu curiosidad no tenga límites !</b></small>
                      @endif
                    </p>
                  </li>

                  <!-- Footer Menu -->
                  <li class="user-footer">
                    <!--<div class="pull-left">
                      <a href="/perfil" class="btn btn-primary">
                        <span class="fa fa-gear"></span>
                        Editar Perfil
                      </a>
                    </div>-->
                    <div class="">
                      <a href="/logout" class="btn form-control" style="width:70%; margin-left:15%; background-color:#44c6ee; color:white;">
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
            </li> -->
            <!-- <li id="menuPremium" class="">
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

            <li id="menuDatos">
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
          <!-- <h4 class="textPreloader">Espera un momento...</h4> -->
        </div>
      </div>
      <!-- Fin de preloader -->
      <!-- Zona de Contenido general -->
      <div class="content-wrapper" hidden="hidden"><br><br>
        <!-- Encabezado de la pagina -->
        <section class="content-header" id="img-portada">
          <div class="">
            @if(Auth::user()->hasRole('hijo') || Auth::user()->hasRole('hijo_free') || Auth::user()->hasRole('demo_hijo'))
           	<h1 id="titulo_hijo">
                @yield('titulo_contenido')
            		@yield('titulo_contenido_hijo')
              	<!-- <button class="btn btn pull-right tooltipShow" id="portada-btn" data-toggle="tooltip" data-placement="bottom" title="Cambiar imagen"><i class="fa fa-picture-o"></i></button> -->
  			   </h1>
            @else
          	<h1 id="titulo">
          		@yield('titulo_contenido')
          		<!-- <button class="btn btn pull-right tooltipShow" id="portada-btn" data-toggle="tooltip" data-placement="bottom" title="Cambiar imagen"><i class="fa fa-picture-o"></i></button> -->
			      </h1>
            @endif
          <div class="custom-brands">
    				@if(Auth::user()->hasRole('padre') || Auth::user()->hasRole('padre_free') || Auth::user()->hasRole('demo_padre'))
    				<h4 id="msj_bienvenida">@yield('titulo_small')</h4>
    				@endif

				 {{--@if(Auth::user()->hasRole('hijo') || Auth::user()->hasRole('hijo_free') || Auth::user()->hasRole('demo_hijo'))
					<h4 id="msj_bienvenida_hijo">@yield('titulo_small_hijo')
						<a href="#estados_animo" class="pull-right tooltipShow" title="¿Cómo te sientes hoy {{Auth::user()->username}}?"
							data-toggle="collapse" aria-expanded="false" aria-controls="estados_animo">
							<!-- Aqui aparece el emoji del estado del niño -->
							<img src="/packages/icons/happiness.png" class="img-responsive" alt="" style="width:35px; height:35px;" id="estado_actual">
						</a>
						<div class="">
							<div class="collapse" id="estados_animo" style="margin-top:5px;">
							  <div class="well pull-right" style="color:black; z-index:1000; position:absolute;
							  	background-color:white; border:5px solid #44c6ee;">
							  	<h2 class="fontHijo" style="margin-top:0px;">¿Cómo te sientes?
							  	<small>Da click en el emoji</small><hr class="hrHijo" style="background-color:#2d96ba; margin-bottom:15px; margin-top:0px; width:100%;"></h2>
							  	<div class="content-emocion">
							  		<a href="#" id="feliz" role="button">
										<span><img src="/packages/icons/happy-1.png" class="img-responsive" alt="" style="width:35px; height:35px;"></span>
									</a>
									<div class="nombres">
										<p>Feliz</p>
									</div>
							  	</div>
							  	<div class="content-emocion">
							  		<a href="#" id="triste" role="button">
							  			<span><img src="/packages/icons/sad-1.png" class="img-responsive" alt="" style="width:35px; height:35px;"></span>
							  		</a>
							  		<div class="nombres">
							  			<p>Triste</p>
							  		</div>
							  	</div>
							  	<div class="content-emocion">
							  		<a href="#" id="enojado" role="button">
							  			<span><img src="/packages/icons/angry.png" class="img-responsive" alt="" style="width:35px; height:35px;"></span>
							  		</a>
							  		<div class="nombres">
							  			<p>Enojado</p>
							  		</div>
							  	</div>
							  	<div class="content-emocion">
							  		<a href="#" id="aburrido" role="button">
							  			<span><img src="/packages/icons/indifferent.png" class="img-responsive" alt="" style="width:35px; height:35px;"></span>
							  		</a>
							  		<div class="nombres">
							  			<p>Aburrido</p>
							  		</div>
							  	</div>
							  	<div class="content-emocion">
							  		<a href="#" id="asombrado" role="button">
							  			<span><img src="/packages/icons/amazed.png" class="img-responsive" alt="" style="width:35px; height:35px;"></span>
							  		</a>
							  		<div class="nombres">
							  			<p>Asombrado</p>
							  		</div>
							  	</div>

							  </div>
							</div>
						</div>
					</h4>
				 @endif --}}
              <ul id="migas">
                @yield('migas')
              </ul>
            </div>
          </div>
        </section>

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
            <!-- <br>
            <button type="button" id="botonPremium" class="btn btn-primary btn-lg">
              Notificarle a mis Padres
            </button> -->
          </div>
        </div>
      </div>
    </div>

      <!-- Footer principal general -->
      <!--<footer class="main-footer">
        <div class="pull-right hidden-xs">
          <small>
            <b>¡Qué tu curiosidad no tenga límites!</b>
          </small>
        </div>
        <strong>Copyright &copy; 2016 <a href="javascript:void(0)">Curiosity.com.mx</a></strong>
      </footer>-->

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
  {{HTML::script('/packages/js/libs/cropper/cropper.min.js')}}
  {{HTML::script('/packages/js/libs/notificacion_toast/jquery.toast.js')}}
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

	/*Sección para la gestion de actualización y registro de hijo*/
$(function ()
  {
    @if(!Auth::user()->hasRole('padre') && !Auth::user()->hasRole('padre_free') && !Auth::user()->hasRole('demo_padre') && !Auth::user()->hasRole('root'))
      $("a[href='#reg-admins']").trigger("click");
    @endif
  //   $("#wizard-admin").steps({
  //     headerTag: "h4",
  //     bodyTag: "section",
  //     transitionEffect:"slideLeft",
  //     autoFocus:true,
  //     cancel:true,
  //     onFinishing: function (event, currentIndex) {
  //           if($("#frm-reg-admins").valid()){
  //               return true;
  //           }else{
  //               return false;
  //           }
  //       },
  //       onStepChanging: function (event, currentIndex, newIndex){
  //         if(newIndex>currentIndex){
  //          if($(".current input,.current select").valid()){
  //              return true;
  //          }else return false;
  //        }else return true;
  //       },
  //       labels: {
  //         cancel: "Cancelar",
  //         //  current: "current step:",
  //         pagination: "Paginación",
  //         finish: "Registar",
  //         next: "Siguiente",
  //         previous: "Anterior",
  //         loading: "Registrando ..."
  //       },
  //   });
  //   $("#wizard1").steps({
  //       headerTag: "h2",
  //       bodyTag: "section",
  //       transitionEffect: "slideLeft",
  //       autoFocus:true,
  //       onFinishing: function (event, currentIndex) {
  //           if($("#frm-reg-hijos").valid()){
  //               return true;
  //           }else{
  //               return false;
  //           }
  //       },
  //       labels: {
  //         cancel: "Cancelar",
  //         //  current: "current step:",
  //         pagination: "Paginación",
  //         finish: "Actualizar",
  //         next: "Siguiente",
  //         previous: "Anterior",
  //         loading: "Actualizando ..."
  //       },
  //       onStepChanging: function (event, currentIndex, newIndex){
  //         if(newIndex>currentIndex){
  //          if($(".current input").valid()){
  //              return true;
  //          }else return false;
  //        }else return true;
  //       },
  //
  // });
  //
  //   $("#wizard").steps({
  //       headerTag: "h2",
  //       bodyTag: "section",
  //       transitionEffect: "slideLeft",
  //       autoFocus:true,
  //       next:"Siguiente",
  //       finish:"Finalizar",
  //       previous:"Anterior",
  //       onFinishing: function (event, currentIndex) {
  //           if($("#frm-reg-hijos").valid()){
  //               return true;
  //           }else{
  //               return false;
  //           }
  //       },
  //       labels: {
  //         cancel: "Cancelar",
  //         //  current: "current step:",
  //         pagination: "Paginación",
  //         finish: "Finalizar",
  //         next: "Siguiente",
  //         previous: "Anterior",
  //         loading: "Cargando ..."
  //       },
  //       onStepChanging: function (event, currentIndex, newIndex){
  //         if(newIndex>currentIndex){
  //          if($(".current input").valid()){
  //              return true;
  //          }else return false;
  //        }else return true;
  //       },
  //
  // });



    $('#image').cropper({
    aspectRatio: 1/1,
    responsive: true,
    autoCropArea:1,
    preview:".preview",
    dragMode:'move',
    crop: function(e) {
      // Output the result data for cropping image.
      $("input[name='x']").val(e.x);
      $("input[name='y']").val(e.y);
      $("input[name='width']").val(e.width);
      $("input[name='height']").val(e.height);

    }
    });
    $("img[data-target='#modalPrueba']").click(function(){


    });
     $(".btnRecortar").click(function(){
         var formData = new FormData(document.getElementById('frm-change-image'));
          $.ajax({
            url:$("#frm-change-image").attr("action"),
            type:$("#frm-change-image").attr("method"),
            data:formData,
            cache:false,
            contentType:false,
            processData:false,
            beforeSend: function(){
                message = "Espera.. La imagen se esta recortando...";
                $curiosity.noty(message, 'info');
                }

         }).done(function(r){
            console.log(r);
            $(".img-profile").attr("src",r);
            $curiosity.noty("La imagen fue guardada y/o recortada exitosamente","success");
            $("button[data-dismiss='modal']").trigger("click");
         }).fail(function(){

         }).always(function(){

       });
     });
        var $inputImage = $('#inImage');
        var URL = window.URL || window.webkitURL;
        var blobURL;
        var $image = $('#image');

            $inputImage.change(function () {
              var files = this.files;
              var file;

              if (!$image.data('cropper')) {
                return;
              }

              if (files && files.length) {
                file = files[0];
                if (/^image\/\w+$/.test(file.type)) {
                    blobURL = URL.createObjectURL(file);
                    $image.one('built.cropper', function () {


                    URL.revokeObjectURL(blobURL);
                  }).cropper('reset').cropper('replace', blobURL);

                } else {
                  window.alert('Please choose an image file.');
                }
              }
      });
});
	/*Fin de la sección de la gestion de actualización y modificación del perfil de usuario y registro de hijos*/

    });
  </script>
  @yield('mi_js')
  </body>
</html>
