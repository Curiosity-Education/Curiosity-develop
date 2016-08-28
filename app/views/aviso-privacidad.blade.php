<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<link rel="icon" type="image/png" href="/packages/images/landing/logo.png">
	<title>Aviso de privacidad</title>
	<link rel="stylesheet" href="/packages/css/libs/css-mdb/bootstrap.min.css">
	<link rel="stylesheet" href="/packages/css/libs/css-mdb/mdb.min.css">
	{{ HTML::style('/packages/css/libs/awensome/css/font-awesome.min.css')}}
	<style>
		*{
			margin: 0;
			padding: 0;
		}

		div#titulo{
			height: 200px;
			background: url("/packages/images/privacidad.jpg") repeat center center fixed;
			background-attachment: fixed;
			background-size:cover;
			background-repeat: no-repeat;
			margin-bottom: 30px;

		}


		h1.titulo-apartado{
			border-top: 2px solid white;
			border-bottom: 2px solid white;
			padding: 10px;
		}

		.index{
			padding: 5px 0px;
			border-bottom: 2px solid #2262ae;
		}

		.icon-circle{
			width: 40px;
			height: 40px;
			display: inline-block;
			-webkit-border-radius: 100%;
			-moz-border-radius: 100%;
			border-radius: 100%;
		}

		.icon-circle i{
			width: 40px;
			height: 40px;
			display: block;
			text-align: center;
			line-height: 40px;
			font-size: 20px;
			color: #fff;
		}


		div.bg-negro{
			background-color: rgba(0,0,0,0.7);
			height: 100%;
			width: 100%;
		}

		a#inicio{
			color: #fff;
			margin: 5px 5px;
		}

		.bg-nav{
			background-color: #2262ae;
		}

		div.logo-wrapper{
			border-bottom: 1px solid #2262ae;
		}

		/* Barra scroll */
		::-webkit-scrollbar {
			  width: 13px;
		}
		::-webkit-scrollbar-track {
			  background-color: #fff;
		}
		::-webkit-scrollbar-thumb {
					background-color: #2262ae;
					border: solid 3px #fff;
					border-radius: 10px;
		}
		::-webkit-scrollbar-corner {
			  background-color: transparent;
		}
		/* FIN Barra scroll */

		li{
			padding-top: 5px;
		}

		li a:hover{
			background-color: #f68e55;
			color: #fff !important;
		}

		.tab{
			margin-left: 30px;
			font-size: 1.1em;
		}

		.tab2{
			margin-left: 50px;
			font-size: 1.1em;
		}
	</style>
</head>
<body>

		<main>
			<div class="main-wrapper">

				<!--Navbar-->
				<nav class="navbar navbar-dark bg-nav">

					<!-- Collapse button-->
					<!--<a href="#" data-activates="slide-out" class="button-collapse" id="desplege"><i class="fa fa-bars"></i></a>-->
					<a id="inicio" class="nav-link pull-right waves-effect" href="/"><i class="fa fa-home"></i> INICIO <span class="sr-only">(current)</span></a>					<div class="">

						<!--Collapse content-->
						<div class="collapse navbar-toggleable-xs" id="collapseEx2">
							<!--Navbar Brand-->

							<!--Links-->
							<ul class="nav navbar-nav pull-right">
								<li class="nav-item active">
									<!--<a class="nav-link" href="#">INICIO <span class="sr-only">(current)</span></a>-->
								</li>
							</ul>
							<!--Search form-->

						</div>
						<!--/.Collapse content-->

					</div>

				</nav>
				<!--/.Navbar-->

					<!-- Encabezado -->
					<div class="col-md-12 view hm-black-strong z-depth-1" id="titulo">
						<div class="mask flex-center">
							<center class="">
								<h1 class="white-text h1-responsive titulo-apartado">Aviso de privacidad</h1>
								<h6 class="white-text h6-responsive">Ultima revisión 25-Julio-2016</h6>
							</center>
						</div>
					</div>
					<!-- Fin Encabezado -->

					<!-- Contenido -->
					<div class="col-md-10 col-sm-10 col-xs-12 jumbotron col-md-offset-1 col-sm-offset-1 animated bounceInRight secciones" id="descripcion" >
						<p style="font-size:1.1em;"><b style="font-size:2em; color:#f68e55;">E</b>n <b>Curiosity Educación</b> estamos convencidos que el
						 principal activo son nuestros clientes, es por ello que aplicamos lineamientos, políticas, procedimientos y programas de privacidad
						 para proteger su información. <br><br>

						 Como cliente de Curiosity, usted tiene la oportunidad de escoger entre una amplia gama de servicios, sabiendo que sus datos personales
						 estarán protegidos. La seguridad de su información es nuestra prioridad, es por ello que la protegemos mediante el uso, aplicación y
						 mantenimiento de altas medidas de seguridad técnicas, físicas y administrativas.
						 </p>

						<p style="font-size:1.1em;"><b style="font-size:1.1em; color:#f68e55;">Finalidades del tratamiento de sus datos personales:</b><br>

						 Los datos personales que Curiosity recaben, serán utilizados para atender las siguientes finalidades:</p>
						 <p class="tab"><b>El conocimiento de nuestros clientes</b> dentro la plataforma, y comunicación con el mismo así como el informe de servicios adquiridos para sus respectivos hijos.</p>
						 <p class="tab"><b>Ayuda para una mejor experiencia</b> en nuestra plataforma cada dato que usted nos brinda nos ayuda a saber quien esta con nosotros. Relacionar padres e hijos y poder
						 darle un servicio más personalizado. El perfil curiosity es una sección de nuestra plataforma donde se mostrará mucha de la información que usted nos brinda y en algunas otras secciones
						 se muestra información que se obtiene dependiendo de ciertos datos obtenidos (gustos, populares etc).</p>
						 <p class="tab"><b>Las contraseñas de las cuentas</b> que usted posee (ej. cuenta padre y cuentas hijo) cuentan con un hash de encriptación de esa manera obtener las contraseñas del
						 servidor no basta para acceder a su cuenta.</p>
						 <p class="tab"><b>La información de su tarjeta de pago </b> se destruye al instante al momento de su uso. No guardamos datos de la tarjeta en nuestra base de datos nos referenciamos
						 a ella a través de un token generado dinámicamente(Este jamás es igual en los distintos usos). </p><br>

						<p style="font-size:1.1em;"><b style="font-size:1.1em; color:#f68e55;">Finalidades no indispensables:</b><br>

						 Los datos personales que Curiosity recaben, serán utilizados para atender las siguientes finalidades:</p>

						 <p class="tab"><b>(I)</b> Mercadotecnia, publicidad y prospección comercial. </p>
						 <p class="tab"><b>(II)</b> Ofrecerle, en su caso, otros servicios propios o de cualquiera de sus afiliadas, subsidiarias, sociedades controladoras, asociadas, comisionistas o sociedades
						 integrantes de Curiosity. </p>
						 <p class="tab"><b>(III)</b> Remitirle promociones de otros bienes o servicios relacionados con los citados productos. </p>
						 <p class="tab"><b>(IV)</b> Hacer de su conocimiento o invitarle a participar en nuestras actividades no lucrativas de compromiso social que tengan como objetivo promover el desarrollo de
						 las personas, a través de proyectos educativos, sociales, ecológicos y culturales. </p>
						 <p class="tab"><b>(V)</b> Realizar análisis estadístico, de generación de modelos de información y/o perfiles de comportamiento actual y predictivo. Participar en encuestas, sorteos y promociones. </p>
					</div>
					<!-- Fin de Contenido -->


			</div>
		</main>

	<script src="js/jquery-2.2.3.min.js"></script>
	<script src="js/mdb.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
    		$(".button-collapse").sideNav();
			if($("div#descripcion")){
				$($(this)).show();
			}else{
				$(".secciones").hide();
			}

			$(".item").click(function(event){
				event.preventDefault();
				$(".secciones").hide();
				$($(this).attr("href")).show();
			});

  		});
	</script>
</body>
</html>
