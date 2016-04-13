<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<link rel="icon" type="image/png" href="/packages/images/Curiosity.png">
	<meta http-equiv="X-UA-Compatible" content="IE=Edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
  {{HTML::style('/packages/css/libs/bootstrap/bootstrap.min.css')}}
  {{HTML::style('/packages/css/libs/awensome/css/font-awesome.min.css')}}
	{{HTML::style('/packages/css/libs/animate/animate.min.css')}}
  {{HTML::style('/packages/css/curiosity/style.css')}}
  <title>Curiosity</title>
</head>
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
        <li><a href="javascript:void(0)" id="link-inicio">Inicio</a></li>
        <li class="hidden-xs hidden-sm"><a href="javascript:void(0)" id="link-ofrecemos">¿Qué es Curiosity?</a></li>
				<li><a href="javascript:void(0)" id="link-pagos">Formas de Pago</a></li>
        <li><a href="javascript:void(0)" id="link-escuelas">Escuelas Asociadas</a></li>
				<li><a href="javascript:void(0)">Registrarme</a></li>
        <li><a href="/login">Iniciar Sesión</a></li>
      </ul>
    </div>
  </div>
</div>

<!-- / inicio / -->
  <section class="container-fluid pantalla-total" id="inicio">
    <div class="row">

      <div class="col-md-6 col-md-offset-3 hidden-xs hidden-sm text-center">
        {{HTML::image('/packages/images/pg-curiosity_beta.png', 'alt', array('class' => 'img-responsive logo-inicio wow bounceIn'))}}
      </div>
      <div class="col-xs-12 visible-xs visible-sm cel-logo-principal">
				{{HTML::image('/packages/images/pg-curiosity_beta.png', 'alt', array('class' => 'img-responsive logo-inicio wow bounceIn'))}}
      </div>

    </div>
    <div class="row hidden-xs hidden-sm">
      <div id="slogan" class="col-md-12 text-center wow fadeInLeft" data-wow-delay="0.5s">
        <h1>¡Qué tu curiosidad no tenga límites!</h1>
      </div>
    </div>

    <div class="row">
      <div class="col-md-12 hidden-xs hidden-sm">
        <br><br>
        <div class="col-md-6 text-right">
          <a href="/login" class="btn btn-primary btn-lg boton-inicio bg-green wow fadeInLeft" data-wow-delay="0.8s">
            <span class="fa fa-mortar-board"></span>
            Iniciar Sesión
          </a>
        </div>
        <div class="col-md-6 text-left">
          <a href="/subscripcion" class="btn btn-warning btn-lg boton-inicio bg-orange wow pulse" data-wow-iteration="infinite" data-wow-duration="4s">
            <span class="fa fa-plus-circle"></span>
            Regístrate
          </a>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-xs-12 visible-xs visible-sm">
        <br><br>
        <div class="col-md-12 text-center">
          <a href="/login" class="btn btn-primary btn-lg cel-boton-inicio bg-green">
            <span class="fa fa-mortar-board"></span>
            Iniciar Sesión
          </a>
        </div>
        <div class="col-md-12 text-center">
          <a href="javascript:void(0)" class="btn btn-warning btn-lg cel-boton-inicio bg-orange">
            <span class="fa fa-plus-circle"></span>
            Regístrate
          </a>
        </div>
      </div>
    </div>
  </section>

<!-- que ofrecemos -->
<section class="hidden-xs hidden-sm" id="ofrecemos">
  <div class="">
		<div class="">
			<div id="carousel-1" class="carousel slide" data-ride="carousel" >
				 <!-- indicadores -->
				 <ol  class="carousel-indicators">
						<li data-target="#carousel-1" data-slide-to="0" class="active"></li>
						<li data-target="#carousel-1" data-slide-to="1"></li>
						<li data-target="#carousel-1" data-slide-to="2"></li>
				 </ol>

				 <!-- Slide Content -->
				 <div class="carousel-inner" role="listbox">
						<div class="item active slideIMG">
							<div class="col-xs-3 col-xs-offset-2">
								<span class="fa fa-graduation-cap fa-6x make-circle bg-red" id="icon-educacion"></span>
							</div>
							<div class="col-xs-6 slide-titulo text-justify">
								<label></label>
								<h1><b>Educación de Excelente Calidad</b></h1>
								<p>
									Curiosity es un gimnasio para tu cerebro. En Curiosity creemos que una mente fuerte y saludable es la clave para una vida más plena y exitosa. Es por eso que hemos desarrollado un conjunto de juegos y ejercicios para ayudarte a alcanzar todas tus metas en la escuela desarrollando tus habilidades de una forma sencilla y divertida que te servirán toda la vida.
								</p>
							</div>
						</div>

						<div class="item slideIMG">
							<div class="col-xs-3 col-xs-offset-2">
								<span class="fa fa-book fa-6x make-circle bg-pink" id="icon-apoyo"></span>
							</div>
							<div class="col-xs-6 slide-titulo text-justify">
								<label></label>
								<h1><b>Apoyo para Papá y Mamá</b></h1>
								<p>
									Sabemos que para Mamá y Papá tú eres lo más importante. En Curiosity queremos ser sus mejores aliados y apoyarte al momento de hacer tus tareas. El plan de Curiosity viene adaptado a tus necesidades para brindarte los mejores resultados sin tener que invertir tanto tiempo. Así que, si estás por empezar tu tarea y tienes dudas o sólo buscas divertirte, ten seguro que nuestros juegos te divertirán poniendo a trabajar tus neuronas hasta ponerlas en forma.
								</p>
							</div>
						</div>

						<div class="item slideIMG">
							<div class="col-xs-3 col-xs-offset-2">
								<span class="fa fa-group fa-6x make-circle bg-blue" id="icon-comunidad"></span>
							</div>
							<div class="col-xs-6 slide-titulo text-justify">
								<label></label>
								<h1><b>Comunidad Educativa</b></h1>
								<p>
									Tanto Curiosity como las Principales Escuelas de la región creen en ti. Es por eso que sus excelentes profesores te ayudarán a resolver todas tus dudas y podrás revisar sus clases cuantas veces lo necesites.
								</p>
							</div>
						</div>

						<div class="item slideIMG">
							<div class="col-xs-3 col-xs-offset-2">
								<span class="fa fa-puzzle-piece fa-6x make-circle bg-green" id="icon-diviertete"></span>
							</div>
							<div class="col-xs-6 slide-titulo text-justify">
								<label></label>
								<h1><b>Aprende y Diviértete</b></h1>
								<p>
									¿Quién dijo que aprender no es divertido? En Curiosity queremos que aprendas jugando, por eso hemos diseñado juegos con los que podrás divertirte y al mismo tiempo aprender.
								</p>
							</div>
						</div>

						<div class="item slideIMG">
							<div class="col-xs-3 col-xs-offset-2">
								<span class="fa fa-bar-chart fa-6x make-circle bg-yellow" id="icon-avances"></span>
							</div>
							<div class="col-xs-6 slide-titulo text-justify">
								<label></label>
								<h1><b>Seguimiento de Avances</b></h1>
								<p>
									En Curiosity queremos que desarrolles tu aprendizaje y para ello te brindaremos  retroalimentación en base a tus avances, utilizando tecnología de punta para que fortalezcas tus áreas de oportunidad. Conforme vayas avanzando, recibirás divertidas recompensas de acuerdo a tu nivel y puntaje.
								</p>
							</div>
						</div>

						<div class="item slideIMG">
							<div class="col-xs-3 col-xs-offset-2">
								<span class="fa fa-desktop fa-6x make-circle bg-purple" id="icon-monitoreo"></span>
							</div>
							<div class="col-xs-6 slide-titulo text-justify">
								<label></label>
								<h1><b>Acceso para Mamá y Papá</b></h1>
								<p>
									Tus padres tendrán acceso a un panel y recibirán actualizaciones por correo electrónico en donde podrán ver tu progreso.
								</p>
							</div>
						</div>
				 </div>

				 <a href="#carousel-1" class="left carousel-control" role="button" data-slide="prev">
						<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
				 </a>

				 <a href="#carousel-1" class="right carousel-control" role="button" data-slide="next">
						<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
				 </a>
			</div>
		</div>
  </div>

</section>

<!-- Computadorcita -->
<section id="computadorcita" class="hidden-xs ">
	<div class="container">
		<div class="row">
			<div class="col-md-6">
				<div id="fondoVideo">
					<video src="/packages/video/videoComputadorcita.mp4" muted loops autoplay id="video"></video>
				</div>
			</div>
			<div class="col-md-6">
				<div class="text-center" id="videoDesc">
					<h1><b>¡Qué tu curiosidad no tenga límites!</b></h1>
					<h2>Inicia tu suscripción ahora</h2>
					<a href="javascript:void(0)" class="btn btn-warning">
						Registrate
					</a>
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-12" id="vidFooter">
		<div class="row">
			<div class="col-md-4 text-center footerDesc">
				<i class="fa fa-check"></i>
				&nbsp;&nbsp;
				<label><b>Juegos Divertidos</b></label>
			</div>
			<div class="col-md-4 text-center footerDesc">
				<i class="fa fa-check"></i>
				&nbsp;&nbsp;
				<label><b>Fácil de Usar</b></label>
			</div>
			<div class="col-md-4 text-center footerDesc">
				<i class="fa fa-check"></i>
				&nbsp;&nbsp;
				<label><b>Apoyo en Video</b></label>
			</div>
		</div>
	</div>
</section>

<!-- formas de pago -->
<section id="pagos" class="bg-blue">
  <div class="container">
    <div class="row">
      <div class="col-xs-12 text-center">
        <!-- <h3>Formas de Pago y Registro</h3> -->
      </div>
    </div>

    <div class="row">
      <div class="col-md-4">
        <div class="pagos-panel text-center wow fadeInDown"
				data-wow-delay="0.2s"
				data-wow-duration="1s"
				id="mem1">
					<div class="numMem">
						<center>
							<h1>1</h1>
							<h2>Membresía 1 Hijo</h2>
							<h3>$50 pesos</h3>
						</center>
					</div>
        </div>
				<div id="mem1-footer" class="wow fadeInUp"
				data-wow-delay="0.2s"
				data-wow-duration="1s">
					<button type="button" class="btn btn-warning btn-block">
						Registrarme
					</button>
				</div>
      </div>
      <div class="col-md-4">
				<div class="pagos-panel text-center wow fadeInDown"
				data-wow-delay="0.4s"
				data-wow-duration="1s"
				id="mem2">
					<div class="numMem">
						<center>
							<h1>2</h1>
							<h2>Membresía 2 Hijos</h2>
							<h3>$100 pesos</h3>
						</center>
					</div>
        </div>
				<div id="mem1-footer" class="wow fadeInUp"
				data-wow-delay="0.4s"
				data-wow-duration="1s">
					<button type="button" class="btn btn-warning btn-block">
						Registrarme
					</button>
				</div>
      </div>
			<div class="col-md-4">
				<div class="pagos-panel text-center wow fadeInDown"
				data-wow-delay="0.6s"
				data-wow-duration="1s"
				id="mem3">
					<div class="numMem">
						<center>
							<h1>3</h1>
							<h2>Membresía 3 Hijos</h2>
							<h3>$150 pesos</h3>
						</center>
					</div>
        </div>
				<div id="mem1-footer" class="wow fadeInUp"
				data-wow-delay="0.6s"
				data-wow-duration="1s">
					<button type="button" class="btn btn-warning btn-block">
						Registrarme
					</button>
				</div>
      </div>
    </div>
  </div>
</section>

<!-- escuelas -->
<section id="escuelas">
  <div class="container">
    <div class="row">

      <div class="col-xs-12 text-center">
        <h3>Escuelas Asociadas</h3>
      </div>

			@foreach($escuelas as $escuela)
      <div class='col-xs-6 col-md-3'>
        <div class='escuelas-panel text-center wow flipInX' data-wow-duration="2s">
					{{HTML::image('/packages/images/escuelas/'.$escuela->logotipo, 'alt', array('class' => 'img-responsive escuelas-img-hover'))}}
        </div>
      </div>
      @endforeach

    </div>
		<br><br><br><br><br>
    <div class="row" hidden="hidden">
      <div class="col-xs-12 text-center">
        <div class="escuelas-mas wow fadeInLeft" data-wow-duration="2s" data-wow-delay="0.1s">
          <span class="fa fa-chevron-circle-right fa-4x"></span>
          <label>Mostrar Todas las Escuelas</label>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Pie de la pagina -->
<footer>
  <div class="container">
    <div class="row">
			<div class="col-xs-6 col-md-2">
				<h5><b>ACERCA DE NOSOTROS</b></h5>
				<ul class="lista-footer">
					<li><a href="/nosotros#parte1">Nuestra Misión</a></li>
					<li><a href="/nosotros#parte2">Nuestra Visión</a></li>
					<li><a href="/nosotros#parte3">Nuestros Valores</a></li>
					<li><a href="">Nuestro Equipo</a></li>
				</ul>
			</div>
			<div class="col-xs-6 col-md-2">
				<h5><b>APOYO</b></h5>
				<ul class="lista-footer">
					<li><a href="javascript:void(0)">Preguntas Frecuentes</a></li>
					<li><a href="javascript:void(0)">Centro de Ayuda</a></li>
				</ul>
			</div>
			<div class="col-xs-6 col-md-2">
				<h5><b>CONTACTOS</b></h5>
				<ul class="lista-footer">
					<li><a href="javascript:void(0)">Contacto Directo</a></li>
					<!-- <li><a href="javascript:void(0)">Prensa</a></li> -->
				</ul>
			</div>
			<!-- <div class="col-xs-6 col-md-2">
				<h5><b>BOLSA DE TRABAJO</b></h5>
				<ul class="lista-footer">
					<li><a href="javascript:void(0)">Tiempo Completo</a></li>
					<li><a href="javascript:void(0)">Medio Tiempo</a></li>
					<li><a href="javascript:void(0)">Pasantías</a></li>
				</ul>
			</div> -->
			<div class="col-xs-6 col-md-2">
				<h5><b>REDES SOCIALES</b></h5>
				<ul  class="lista-footer">
					<li><a href="javascript:void(0)"><span class="fa fa-facebook-square"></span> &nbsp;&nbsp;Facebook</a></li>
					<li><a href="javascript:void(0)"><span class="fa fa-twitter-square"></span> &nbsp;&nbsp;Twitter</a></li>
					<li><a href="javascript:void(0)"><span class="fa fa-instagram"></span> &nbsp;&nbsp;Instagram</a></li>
				</ul>
			</div>
			<!-- div fantasma jajaja --><div class="col-xs-6 col-md-2"></div><!-- fin div fantasma jajaja -->

			<div class="visible-md visible-lg col-md-2">
				<img src="/packages/images/Curiosity.png" class="img-responsive">
			</div>
    </div>
		<hr>
		<div class="row">
		  <div class="col-md-6">
		  	<a href="javascript:void(0)">Términos y Condiciones de Uso</a>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<a href="javascript:void(0)">Aviso de Privacidad</a>
		  </div>
			<div class="col-md-6 text-right">
				<label class="footer-desc"><b>&reg; 2016 Curiosity</b>.com.mx <br></label><br>
				<label class="footer-desc">Todos los derechos reservados.</label>
			</div>
		</div>
  </div>
</footer>

{{HTML::script('/packages/js/libs/jquery/jquery.min.js')}}
{{HTML::script('/packages/js/libs/bootstrap/bootstrap.min.js')}}
{{HTML::script('/packages/js/libs/wow/wow.min.js')}}
{{HTML::script('/packages/js/curiosity/customScroll.js')}}
<script type="text/javascript">
	wow = new WOW({
		animateClass: 'animated',
		offset: 100
	});
	wow.init();
</script>
</body>
</html>
