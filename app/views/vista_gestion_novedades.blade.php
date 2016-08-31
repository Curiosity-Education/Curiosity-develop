@extends('admin_base')
@section('mi_css')
 {{HTML::style('/packages/css/curiosity/gestion_novedades.css')}}
@stop

@section('title')
	 Gestión Novedades
@stop


@section('titulo_contenido')
	Gestión de Novedades
@stop

@section('titulo_small')

@stop


@section('panel_opcion')
<div class="col-md-12">
	<div class="row">
		<!-- Panel de novedad para papá -->
		<div class="col-md-6">
			<h3><i class="fa fa-list-ul"></i> Novedades Activas para Padre</h3><hr class="hr-novedad">

			<div class="col-md-4">
				<div class="panel panel-default">
                	<div class="panel-body">
                    	<h2>Titulo</h2>
                    	<p>Link para el PDF</p>
                	</div>
                	<div class="panel-footer">
                		<a href="#" class="tooltipShow " title="eliminar"><span class="fa fa-trash"></span></a>
                		<a href="#" class="tooltipShow " title="editar_nov_papa" data-toggle="modal" data-target="#novedad_papa"><span class="fa fa-pencil-square-o"></span></a>
                	</div>
            	</div>
			</div>
			<div class="col-md-4">
				<div class="panel panel-default">
                	<div class="panel-body">
                    	<h2>Titulo</h2>
                    	<p>Link para el PDF</p>
                	</div>
                	<div class="panel-footer">
                		<a href="#" class="tooltipShow " title="eliminar"><span class="fa fa-trash"></span></a>
                		<a href="#" class="tooltipShow " title="editar_nov_papa" data-toggle="modal" data-target="#novedad_papa"><span class="fa fa-pencil-square-o"></span></a>
                	</div>
            	</div>
			</div>
			<div class="col-md-4">
				<div class="panel panel-default">
                	<div class="panel-body">
                    	<h2>Titulo</h2>
                    	<p>Link para el PDF</p>
                	</div>
                	<div class="panel-footer">
                		<a href="#" class="tooltipShow " title="eliminar"><span class="fa fa-trash"></span></a>
                		<a href="#" class="tooltipShow " title="editar_nov_papa" data-toggle="modal" data-target="#novedad_papa"><span class="fa fa-pencil-square-o"></span></a>
                	</div>
            	</div>
			</div>
			<div class="col-md-12">
				<div class="row"><hr class="hr-novedad"></div>
				<center><button id="agregar_nov_papa" class="btn btn-primary" data-toggle="modal" data-target="#novedad_papa">Agregar nueva novedad</button></center>
			</div>
		</div>

		<!-- Panel de novedad para hijo -->
		<div class="col-md-6">
			<h3><i class="fa fa-list-ul"></i> Novedades Activas para Hijo</h3><hr class="hr-novedad">

			<div class="col-md-4">
				<div class="panel panel-default">
                	<div class="panel-body">
                    	<h2>Titulo</h2>
                    	<p>Link para el dirigirlo</p>
                	</div>
                	<div class="panel-footer">
                		<a href="#" class="tooltipShow" title="eliminar"><span class="fa fa-trash"></span></a>
                		<a href="#" class="tooltipShow" title="editar_nov_hijo" data-toggle="modal" data-target="#novedad_hijo"><span class="fa fa-pencil-square-o"></span></a>
                	</div>
            	</div>
			</div>
			<div class="col-md-4">
				<div class="panel panel-default">
                	<div class="panel-body">
                    	<h2>Titulo</h2>
                    	<p>Link para el dirigirlo</p>
                	</div>
                	<div class="panel-footer">
                		<a href="#" class="tooltipShow" title="eliminar"><span class="fa fa-trash"></span></a>
                		<a href="#" class="tooltipShow" title="editar_nov_hijo" data-toggle="modal" data-target="#novedad_hijo"><span class="fa fa-pencil-square-o"></span></a>
                	</div>
            	</div>
			</div>
			<div class="col-md-4">
				<div class="panel panel-default">
                	<div class="panel-body">
                    	<h2>Titulo</h2>
                    	<p>Link para el dirigirlo</p>
                	</div>
                	<div class="panel-footer">
                		<a href="#" class="tooltipShow" title="eliminar"><span class="fa fa-trash"></span></a>
                		<a href="#" class="tooltipShow" title="editar_nov_hijo" data-toggle="modal" data-target="#novedad_hijo"><span class="fa fa-pencil-square-o"></span></a>
                	</div>
            	</div>
			</div>
			<div class="col-md-12">
				<div class="row"><hr class="hr-novedad"></div>
				<center><button id="agregar_nov_hijo" class="btn btn-primary" data-toggle="modal" data-target="#novedad_hijo">Agregar nueva novedad</button></center>
			</div>
	</div>
</div>

<!-- Modal de registro de novedad del padre -->

<div class="row">
	<div class="">
		<div class="modal fade " id="novedad_papa" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<center>
							<h2 class="modal-title titulo-modal" id="myModalLabel"> Novedades para Padre </h2>
						</center>
					</div>
					<div class="modal-body">
						<div class="row" style="padding-right:1%; padding-left:1%">
							<!-- Formulario para alta de novedad -->
							<form action="/agregarNovedad" method="post" id="agregarNovedad_papa" class="formularios">
								<center><h3><i class="fa fa-plus-square"></i> Agregar Novedad</h3></center><hr class="hr-novedad">
								<div class="input-group">
								   <span class="input-group-addon"><i class="fa fa-tag"></i></span>
								   <input type="text" class="form-control" placeholder="Titulo de la novedad" name="titulo" id="titulo">
							   	</div><br>
							   	<div class="input-group">
								   <span class="input-group-addon"><i class="fa fa-file-pdf-o"></i></span>
								   <input type="file" class="form-control" name="pdf" id="pdf">
							   	</div>
							   	<br>
							   	<center><button class="btn btn-success" type="submit" id="add_novedad">Registar la novedad</button></center>
							</form>

							<!-- Formulario para editar de novedad -->
							<form action="/editarNovedad" method="post" id="editarNovedad_papa" class="formularios">
								<center><h3><i class="fa fa-pencil-square"></i> Editar Novedad</h3></center><hr class="hr-novedad">
								<div class="input-group">
								   <span class="input-group-addon"><i class="fa fa-tag"></i></span>
								   <input type="text" class="form-control" placeholder="Titulo de la novedad" name="titulo" id="titulo">
							   	</div><br>
							   	<div class="input-group">
								   <span class="input-group-addon"><i class="fa fa-file-pdf-o"></i></span>
								   <input type="file" class="form-control" name="pdf" id="pdf">
							   	</div>
							   	<br>
							   	<center><button class="btn btn-success" type="submit" id="add_novedad">Editar la novedad</button></center>
							</form>
						</div>
					</div>
				</div>
		 	</div>
		</div>
	</div>
</div>

<!-- FIN Modal de registro de novedad del padre -->

<!-- Modal de registro de novedad del hijo -->

<div class="row">
	<div class="">
		<div class="modal fade " id="novedad_hijo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<center>
							<h2 class="modal-title titulo-modal" id="myModalLabel"> Novedades para Hijo </h2>
						</center>
					</div>
					<div class="modal-body">
						<div class="row" style="padding-right:1%; padding-left:1%">
							<!-- Formulario para alta de novedad -->
							<form action="/agregarNovedad" method="post" id="agregarNovedad_hijo" class="formularios">
								<center><h3><i class="fa fa-plus-square"></i> Agregar Novedad</h3></center><hr class="hr-novedad">
								<div class="input-group">
								   <span class="input-group-addon"><i class="fa fa-tag"></i></span>
								   <input type="text" class="form-control" placeholder="Titulo de la novedad" name="titulo" id="titulo">
							   	</div><br>
							   	<div class="input-group">
								   <span class="input-group-addon"><i class="fa fa-link"></i></span>
								   <input type="text" class="form-control" placeholder="Link para dirigir a la novedad en la plataforma" name="link" id="link">
							   	</div>
							   	<br>
							   	<center><button class="btn btn-success" type="submit" id="add_novedad">Registar la novedad</button></center>
							</form>

							<!-- Formulario para editar de novedad -->
							<form action="/editarNovedad" method="post" id="editarNovedad_hijo" class="formularios">
								<center><h3><i class="fa fa-pencil-square"></i> Editar Novedad</h3></center><hr class="hr-novedad">
								<div class="input-group">
								   <span class="input-group-addon"><i class="fa fa-tag"></i></span>
								   <input type="text" class="form-control" placeholder="Titulo de la novedad" name="titulo" id="titulo">
							   	</div><br>
							   	<div class="input-group">
								   <span class="input-group-addon"><i class="fa fa-link"></i></span>
								   <input type="text" class="form-control" placeholder="Link para dirigir a la novedad en la plataforma" name="link" id="link">
							   	</div>
							   	<br>
							   	<center><button class="btn btn-success" type="submit" id="add_novedad">Editar la novedad</button></center>
							</form>
						</div>
					</div>
				</div>
		 	</div>
		</div>
	</div>
</div>

<!-- FIN Modal de registro de novedad del hijo -->
@stop


@section('mi_js')
{{HTML::script("/packages/js/libs/validation/jquery.validate.min.js")}}
{{HTML::script("/packages/js/libs/validation/localization/messages_es.min.js")}}
{{HTML::script('/packages/js/libs/validation/additional-methods.min.js')}}
{{HTML::script('/packages/js/libs/mask/jquery-mask/jquery.mask.js')}}
{{HTML::script('/packages/js/curiosity/gestion_novedades.js')}}

@stop
