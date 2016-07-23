<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Pronto</title>
	<link rel="stylesheet" href="/packages/css/libs/css-mdb/bootstrap.min.css">
	<link rel="stylesheet" href="/packages/css/libs/css-mdb/mdb.min.css">
	<style>
		*{
			margin: 0px;
			padding: 0px;
		}

		body{
			background: url("/packages/images/fondo.jpg");
			background-size: cover;
			height: 100%;
		}

		.jumbotron{
			background-color: rgba(0,0,0,0.8);
		}
		
		#logo{
			width: 50px;
			height: 50px;
		}
		
		hr{
			border: 1px solid #fff;
		}
		
		.emoticon{
			width: 40px;
			height: 40px;
			margin-top: 10px;
		}
		
		a.btn{
			margin-top:15px;
			margin-bottom:-10px;
		}
	</style>
</head>
<body><br><br>
	<div class="col-md-8 col-md-offset-2 animated flipInY" id="bg-full">
		<div class="jumbotron">
			<center><img src="/packages/images/logo_png.png" alt="" class="img-fluid" id="logo"></center><hr>
			<h1 class="h1-responsive white-text text-xs-center">
			¡ Hola !, Vemos que estás listo para iniciar</h1>
		</div>
	</div>
	<div class="col-md-6 col-md-offset-3 animated zoomInUp" id="bg-full">
		<div class="jumbotron">
			<h3 class="h3-responsive white-text text-xs-center">
				Por el momento el acceso a la plataforma no se encuentra disponible, pero
				la fecha de inicio esta cerca;
				<center><img src="/packages/images/happy-1.png" alt="" class="img-fluid emoticon"> </center>
				No te preocupes te notificaremos a tu email.
				<center><img src="/packages/images/grades.png" alt="" class="img-fluid emoticon"> </center>
				¡ Gracias, nos vemos PRONTO !.
				<center><a class="btn btn-primary btn-rounded" href="/">Regresar al inicio</a></center>
			</h3>
		</div>
	</div>
</body>
</html>