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
			<h2 class="text-center"><i class="fa fa-check-square-o icon-papa"></i> Novedades Activas para Padre
			</h2>
			<center><button id="agregar_nov_papa" class="btn bg-papabtn " data-toggle="modal" data-target="#novedad_papa">Agregar nueva novedad</button></center>
			<hr class="hr-novedad">
			@foreach($novedades_papa as $novedad_papa)
			<div class="col-md-12">
				<div class="panel">
					<div class="panel-heading bg-papabtn">
						<h3 class="panel-title">{{$novedad_papa -> titulo}}

						</h3>
						<span class="pull-right clickable tooltipShow" title="ver mas"><i class="glyphicon glyphicon-minus"></i></span>
						<a class="editar_nov_papaClass" data-toggle="modal" data-target="#novedad_papa" id="editar_nov_papa" data-yd="{{$novedad_papa -> id}}" data-tit="{{$novedad_papa -> titulo}}" data-arc="{{$novedad_papa -> pdf}}">
							<span class="pull-right tooltipShow forma" title="editar"><i class="glyphicon glyphicon-pencil"></i></span>
						</a>
						<a class="eliminar_nov_papaClass" id="eliminar_nov_papa" data-yd="{{$novedad_papa -> id}}">
							<span class="pull-right tooltipShow forma" title="eliminar"><i class="glyphicon glyphicon-trash"></i></span>
						</a>
					</div>
					<div class="panel-body">
						<p><a class="archivo" href="/packages/docs/novedades/{{$novedad_papa -> pdf}}" target="_blank">{{$novedad_papa -> pdf}}</a></p>
					 </div>
            	</div>
			</div>
			@endforeach
		</div>

		<!-- Panel de novedad para hijo -->
		<div class="col-md-6">
			<h2 class="text-center"><i class="fa fa-check-square-o icon-hijo"></i> Novedades Activas para Hijo
			</h2>
			<center><button id="agregar_nov_hijo" class="btn bg-hijobtn " data-toggle="modal" data-target="#novedad_hijo">Agregar nueva novedad</button></center>
			<hr class="hr-novedad">
			@foreach($novedades_hijo as $novedad_hijo)
			<div class="col-md-12">
				<div class="panel">
					<div class="panel-heading bg-hijobtn">
						<h3 class="panel-title">{{$novedad_hijo -> titulo}}

						</h3>
						<span class="pull-right clickable tooltipShow" title="ver mas"><i class="glyphicon glyphicon-minus"></i></span>
						<a class="editar_nov_hijoClass" data-toggle="modal" data-target="#novedad_hijo" id="editar_nov_hijo" data-yd="{{$novedad_hijo -> id}}" data-tit="{{$novedad_hijo -> titulo}}" data-lk="{{$novedad_hijo -> uri}}">
							<span class="pull-right tooltipShow forma" title="editar"><i class="glyphicon glyphicon-pencil"></i></span>
						</a>
						<a class="eliminar_nov_hijoClass" id="eliminar_nov_hijo" data-yd="{{$novedad_hijo -> id}}">
							<span class="pull-right tooltipShow forma" title="eliminar"><i class="glyphicon glyphicon-trash"></i></span>
						</a>
					</div>
					<div class="panel-body">
						<p><a class="" href="{{$novedad_hijo -> uri}}" target="_blank">{{$novedad_hijo -> uri}}</a></p>
					 </div>
            	</div>
			</div>
			@endforeach
	</div>
</div>

<!-- Modal de registro de novedad del padre -->

<div class="row">
	<div class="">
		<div class="modal fade " data-backdrop="static" data-keyboard="false" id="novedad_papa" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
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
							<form action="/agregarNovedad_papa" method="post" id="agregarNovedad_papa" class="formularios" enctype="multipart/form-data">
								<center><h3><i class="fa fa-plus-square icon-papa"></i> Agregar Novedad</h3></center><hr class="hr-novedad">
								<div class="input-group">
								   <span class="input-group-addon"><i class="fa fa-tag"></i></span>
								   <input type="text" class="form-control" placeholder="Titulo de la novedad" name="titulo_papa" id="titulo_papa">
							   	</div><br>
							   	<div class="input-group">
								   <span class="input-group-addon"><i class="fa fa-file-pdf-o"></i></span>
								   <input type="file" class="form-control pdf" name="pdf" id="pdf">
							   	</div>
							   	<br>
							   	<div class="pull-right">
							   		<button class="btn btn-success " type="submit" id="btn_add_papa">Registar la novedad</button>
							   		<button class="btn btn-warning" type="button" class="cancelar" id="cancelar">Cancelar</button>
							   	</div>
							</form>

							<!-- Formulario para editar de novedad -->
							<form action="/editarNovedad_papa" method="post" id="editarNovedad_papa" class="formularios" enctype="multipart/form-data">
								<center><h3><i class="fa fa-pencil-square icon-papa"></i> Editar Novedad</h3></center><hr class="hr-novedad">
								<div class="input-group">
								   <span class="input-group-addon"><i class="fa fa-tag"></i></span>
								   <input type="text" class="form-control" placeholder="Titulo de la novedad" name="tituloEditar_papa" id="tituloEditar_papa">
							   	</div><br>
							   	<button type="button" class="btn btn-primary" id="mostrar_input">Seleccionar otro archivo</button>
							   	<div class="input-group" hidden="hidden" id="input_pdfEditar">
								   <span class="input-group-addon"><i class="fa fa-file-pdf-o"></i></span>
								   <input type="file" class="form-control pdf" name="pdf_edit" id="pdf_edit">
							   	</div>
							   	<br>
							   	<div class="pull-right">
							   		<button class="btn btn-success" type="submit" id="btn_edit_papa">Editar la novedad</button>
							   		<button class="btn btn-warning" type="button" class="cancelar" id="cancelar">Cancelar</button>
							   	</div>
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
		<div class="modal fade " data-backdrop="static" data-keyboard="false" id="novedad_hijo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
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
							<form action="/agregarNovedad_hijo" method="post" id="agregarNovedad_hijo" class="formularios" enctype="multipart/form-data">
								<center><h3><i class="fa fa-plus-square icon-hijo"></i> Agregar Novedad</h3></center><hr class="hr-novedad">
								<div class="input-group">
								   <input type="hidden" class="form-control" placeholder="id de la novedad" name="id_novpapa" id="id_novpapa">
							   	</div><br>
								<div class="input-group">
								   <span class="input-group-addon"><i class="fa fa-tag"></i></span>
								   <input type="text" class="form-control" placeholder="Titulo de la novedad" name="tituloNov_hijo" id="tituloNov_hijo">
							   	</div><br>
							   	<div class="input-group">
								   <span class="input-group-addon"><i class="fa fa-link"></i></span>
								   <input type="text" class="form-control" placeholder="Link para dirigir a la novedad en la plataforma" name="link" id="link">
							   	</div>
							   	<br>
							   	<div class="pull-right">
							   		<button class="btn btn-success" type="submit" id="btn_add_hijo">Registar la novedad</button>
							   		<button class="btn btn-warning" type="button" class="cancelar" id="cancelarH">Cancelar</button>
							   	</div>
							</form>

							<!-- Formulario para editar de novedad -->
							<form action="/editarNovedad_hijo" method="post" id="editarNovedad_hijo" class="formularios" enctype="multipart/form-data">
								<center><h3><i class="fa fa-pencil-square icon-hijo"></i> Editar Novedad</h3></center><hr class="hr-novedad">
								<div class="input-group">
								   <input type="hidden" class="form-control" placeholder="id de la novedad" name="id_novhijo" id="id_novhijo">
							   	</div><br>
								<div class="input-group">
								   <span class="input-group-addon"><i class="fa fa-tag"></i></span>
								   <input type="text" class="form-control" placeholder="Titulo de la novedad" name="tituloEditar_hijo" id="tituloEditar_hijo">
							   	</div><br>
							   	<div class="input-group">
								   <span class="input-group-addon"><i class="fa fa-link"></i></span>
								   <input type="text" class="form-control" placeholder="Link para dirigir a la novedad en la plataforma" name="link_edit" id="link_edit">
							   	</div>
							   	<br>
							   	<div class="pull-right">
							   		<button class="btn btn-success" type="submit" id="btn_edit_hijo">Editar la novedad</button>
							   		<button class="btn btn-warning" type="button" class="cancelar" id="cancelarH">Cancelar</button>
							   	</div>
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
