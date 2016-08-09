<!DOCTYPE html5>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<link rel="icon" type="image/png" href="/media/logo.png">
	<meta http-equiv="X-UA-Compatible" content="IE=Edge">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	{{ HTML::style('/packages/css/libs/css-mdb/bootstrap.min.css') }}
	{{ HTML::style('/packages/css/libs/css-mdb/mdb.min.css') }}
	{{ HTML::style('/packages/css/curiosity/style-index.css') }}
	{{ HTML::style('/packages/css/libs/awensome/css/font-awesome.min.css') }}
	<title>Preguntas frecuentes</title>
</head>
<body>
	<div class="col-md-12 view hm-black-strong" id="preguntas">
		<div class="mask flex-center" id="content-titulo">
        	<ul class="animated rubberBand">
  				<li class="container-fluid">
  					<h1 class="h1-responsive font-curiosity titulo-apartado white-text">Preguntas Frecuentes</h1>
  				</li>
  				<li class="container-fluid">
  					<h5 class="h5-responsive titulo-apartado white-text"><a href="/">Inicio</a> | <a href="/mentores">Mentores</a> | <a href="/nuestro_equipo">Nuestro equipo</a></h5>
  				</li>
  			</ul>
    	</div>
	</div>
	<div class="container">
		<div class="col-md-10 col-md-offset-1">
			<div class="introduccion">
				<p class="text-xs-center">Te ofrecemos las preguntas que son más recurrentes en nuestra plataforma, para de esta forma poder ayudarte si tienes alguna duda
				ya que aquí encontrarás la respuesta a todas ellas.
				</p>
				<hr class="hr-apartado">
			</div>
		</div>
		<div class="col-md-12" id="content-integrantes">
			<!--Main wrapper-->
			<div class="horizontal-listing z-depth-1 " id="content-elemento">
				<!--First row-->
				<div class="row">
					<!--Image column-->
					<div class="col-sm-4">
						<div class="view overlay hm-white-slight">
							<img src="/packages/images/landing/interrogante.jpg" class="img-fluid" alt="">
							<a>
								<div class="mask"></div>
							</a>
						</div>
					</div>
					<!--/.Image column-->

					<!--Content column-->
					<div class="col-sm-8">
						<a><h2>¿México será campeón este mundial?</h2></a>

						<!--<div class="card-data">
							<ul>
								<li><i class="fa fa-clock-o"></i> 05/10/2015</li>
								<li><a><i class="fa fa-comments-o"></i>12</a></li>
								<li><a><i class="fa fa-facebook"> </i>21</a></li>
								<li><a><i class="fa fa-twitter"> </i>5</a></li>
							</ul>
						</div>-->

						<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Blanditiis incidunt accusantium maxime odit nemo corporis, magnam quam eos quasi architecto inventore provident hic neque aspernatur, ipsa tempore vero numquam totam.</p>
					</div>
					<!--/.Content column-->

				</div>
				<!--/.First row-->

				<!--Second row-->
				<div class="row">
					<!--Image column-->
					<div class="col-sm-4">
						<div class="view overlay hm-white-slight">
							<img src="/packages/images/landing/interrogante.jpg" class="img-fluid" alt="">
							<a>
								<div class="mask"></div>
							</a>
						</div>
					</div>
					<!--/.Image column-->

					<!--Content column-->
					<div class="col-sm-8">
						<a><h2>¿Qué tan eficaz es su diagnostico del pensamiento?</h2></a>

						<!--<div class="card-data">
							<ul>
								<li><i class="fa fa-clock-o"></i> 05/10/2015</li>
								<li><a><i class="fa fa-comments-o"></i>12</a></li>
								<li><a><i class="fa fa-facebook"> </i>21</a></li>
								<li><a><i class="fa fa-twitter"> </i>5</a></li>
							</ul>
						</div>-->

						<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Blanditiis incidunt accusantium maxime odit nemo corporis, magnam quam eos quasi architecto inventore provident hic neque aspernatur, ipsa tempore vero numquam totam.</p>
					</div>
					<!--/.Content column-->

				</div>
				<!--/.Second row-->

				<!--Third row-->
				<div class="row">
					<!--Image column-->
					<div class="col-sm-4">
						<div class="view overlay hm-white-slight">
							<img src="/packages/images/landing/interrogante.jpg" class="img-fluid" alt="">
							<a>
								<div class="mask"></div>
							</a>
						</div>
					</div>
					<!--/.Image column-->

					<!--Content column-->
					<div class="col-sm-8 ">
						<a><h2>¿Es posible registrar mas de 3 hijos?</h2></a>

						<!--<div class="card-data">
							<ul>
								<li><i class="fa fa-clock-o"></i> 05/10/2015</li>
								<li><a><i class="fa fa-comments-o"></i>12</a></li>
								<li><a><i class="fa fa-facebook"> </i>21</a></li>
								<li><a><i class="fa fa-twitter"> </i>5</a></li>
							</ul>
						</div>-->

						<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Blanditiis incidunt accusantium maxime odit nemo corporis, magnam quam eos quasi architecto inventore provident hic neque aspernatur, ipsa tempore vero numquam totam.</p>
					</div>
					<!--/.Content column-->

				</div>
				<!--/.Third row-->

			</div>
			<!--/.Main wrapper-->
		</div>
	</div>
	
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
	</script>
</body>
</html>