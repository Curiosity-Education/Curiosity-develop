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
			background: url("/packages/images/exito.jpg") repeat center center fixed;
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
		
		#cuadro{
			width: 360px;
			height: 360px;
			margin-left: 100px;
			background-color: aqua;
		}
		
		a.btn{
			margin-top: 15px;
			margin-bottom: -10px;
		}
		
		.esquinas{
			border-radius: 3px;
		}
	</style>
</head>
<body><br>
	<div class="col-md-8 col-md-offset-2 jumbotron esquinas animated flipInY" id="bg-full">
		<div>
			<center><img src="/packages/images/logo_png.png" alt="familia" class="img-fluid" id="logo"></center><hr>
			<h1 class="h1-responsive white-text text-xs-center">
				¡ Bienvenido a Curiosity !
			</h1>
		</div>
	</div>
	<div class="col-md-8 col-md-offset-2 jumbotron esquinas animated zoomInRight">
		<div class="">
			<p class="h4-responsive white-text text-xs-center">
				Ahora formas parte de la familia Curiosity, lo cual nos pone muy felices; 
				disfruta de esta aventura y recuerda, ¡Que tu curiosidad no tenga límites!
			</p>
			<div class="col-md-4 col-md-offset-4">
				<img src="/packages/images/familia.jpg" alt="familia" class="img-fluid esquinas">
				<center><a class="btn btn-primary btn-rounded" href="#inicio">Regresar al inicio</a></center>
			</div>
		</div>
	</div>
</body>
</html>