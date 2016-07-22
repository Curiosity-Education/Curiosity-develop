@extends('admin_base')
@section('mi_css')
 {{HTML::style('/packages/css/libs/date-picker/datepicker.min.css')}}
 {{HTML::style('/packages/css/curiosity/perfil.css')}}

@stop

@section('title')
	Alertas | {{Auth::user()->username}}
@stop


@section('titulo_contenido')
	Alertas
@stop

@section('titulo_small')
<div class="row">
	<div class="col-md-10 col-xs-12 col-sm-10">
		<button class="btn tooltipShowRight" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample"
	  	style="background-color:#2d96ba; color:white;" data-toggle="tooltip" title="Información sobre esta sección">
		  <i class="fa fa-info-circle"></i></button>
		<div class="collapse" id="collapseExample" style="margin-top:5px;">
		  <div class="well" style="color:black; z-index:1; position:absolute;
		  background-color:white; border:2px solid #e3e3e3;">
			Aquí te mostramos los mensajes que tenemos para ti donde te informamos el avance de
			tus hijos y si todo va bien o existe algún problema. <hr class="hr" style="background-color:#2d96ba; margin-bottom:0px;">
		  </div>
		</div>
	</div>
</div>
@stop


@section('panel_opcion')
<div class="col-md-12 col-sm-12 col-xs-12">
	<!-- APARTADO DE DATAPICKER PARA FILTRAR LAS ALERTAS -->
	<div class="col-md-4 col-sm-4 col-xs-12 contenedores" id="">
		<h3 class="fontPapa"><i class="fa fa-calendar"></i> Selecciona una fecha <br>
		<small>una vez seleccionada, si hay alertas en esa fecha, se mostrarán.</small><hr class="hr"></h3>
		<div id="sandbox-container" class="">
			<center><div id="data_picker"></div></center>
		</div><hr class="hr">
	</div>
	<!-- CONTENEDOR DONDE SE MUESTRAN LAS ALERTAS -->
	<div class="col-md-7 col-md-offset-1 col-sm-8 col-xs-12 contenedores" id="alerta" style="">
		<h3><i class="fa fa-bullhorn"></i> Alerta
		<!-- Boton para regresar al dia actual -->
		<button class="btn pull-right" id="alerta_actual" style="background-color:#44c6ee; color:white;">Hoy</button>
		<hr class="hr"></h3>
		<div class="alertaBox">
  		<!-- Nombre del padre en la alerta -->
   		<p class="" id="usuario">{{Auth::user()->persona->nombre}}</p>
    </div>
	</div>
</div>
@stop


@section('mi_js')
{{HTML::script('/packages/js/libs/date-picker/bootstrap-datepicker.min.js')}}

<script type="text/javascript">

	$('#sandbox-container div#data_picker').datepicker({
		todayHighlight: true,
		language: "es",
	});

	$('#sandbox-container div#data_picker div.datepicker-inline').attr('id','alert-picker');  

</script>
@stop
