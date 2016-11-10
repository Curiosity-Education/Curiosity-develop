<!DOCTYPE html5>
<html lang="es">
<head name="theme-color">
	<meta charset="UTF-8">
	<link rel="icon" type="image/png" href="/packages/images/landing/logo.png">
	<meta http-equiv="X-UA-Compatible" content="IE=Edge">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta name="keywords" content="Curiosity, Educación,equidad, divertida,juegos,pdf, documentos, videos,retroalimentación,aventura,limites,evaluado,resultados, profesores">
	<meta name="description" content="Curiosity educación  permite aprender con videojuegos educativos, apoyo de videos animados y documentos PDF con los temas vistos en clase">
	<meta name="theme-color" content="#2262ae" >
	{{ HTML::style('/packages/css/libs/css-mdb/bootstrap.min.css') }}
	{{ HTML::style('/packages/css/libs/css-mdb/mdb.min.css') }}
	{{ HTML::style('/packages/css/curiosity/style-index.min.css') }}
	{{ HTML::style('/packages/css/libs/awensome/css/font-awesome.min.css') }}
	{{ HTML::style('/packages/css/curiosity/preloadSpinner.min.css') }}
  @yield('css')
	<title>@yield('title')</title>
</head>
<body>
<!--Navbar-->
<nav class="navbar navbar-dark navbar_inicio navbar-fixed-top">
    <!-- Collapse button-->
    <button class="navbar-toggler hidden-sm-up" type="button" data-toggle="collapse" data-target="#collapseEx2">
      <i class="fa fa-bars"></i>
    </button>
     <div class="container-fluid">
      <!--Collapse content-->
      <div class="collapse navbar-toggleable-xs" id="collapseEx2">
          <!--Navbar Brand-->
          <div hidden="hidden">
          	<a class="btn success-rounded-outline waves-effect pull-right">Iniciar sesión</a>
  					<a class="btn warning-rounded-outline waves-effect pull-right">Registrarse</a>
          </div><br>
          <a href="/" class="navbar-brand pull-left  chicle font-curiosity">
						<span><img src="/packages/images/landing/logo.png" alt="logo-curiosity" class="logo-current"></span>
						Curiosity Educación
          </a>
          <!--Links-->
          <ul class="nav navbar-nav pull-right">
              @yield('menu')
          </ul>
    	</div>
			<!--/.Collapse content-->
    </div>
</nav>
<!--/.Navbar-->

@yield('contenido')
@yield('footer')

</div>
 <!-- Preloader web -->
  <div id="cssload-pgloading" hidden="hidden">
    <div class="cssload-loadingwrap">
      <ul class="cssload-bokeh">
        <li></li>
        <li></li>
        <li></li>
        <li></li>
      </ul>
      <h4 class="textPreloader">Espera un momento...</h4>
    </div>
  </div>
  <!-- Fin de preloader -->

	<script type="text/javascript" src="/packages/js/libs/jquery/jquery.min.js"></script>
	<script type="text/javascript" src="/packages/js/libs/mdb/tether.min.js"></script>
	<script type="text/javascript" src="/packages/js/libs/mdb/bootstrap.min.js"></script>
	<script type="text/javascript" src="/packages/js/libs/mdb/mdb.min.js"></script>
	<script type="text/javascript" src="/packages/js/curiosity/app-index.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			$(function () {
				$("#mdb-lightbox-ui").load("mdb-addons/mdb-lightbox-ui.html");
			});
		});

		new WOW().init();
        $('a').click(function(e){
            e.preventDefault();
            window.location = $(this).attr('href');
        });
	</script>
  @yield('js')
</body>
</html>
