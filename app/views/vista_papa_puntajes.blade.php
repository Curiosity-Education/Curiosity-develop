@extends('admin_base')
@section('mi_css')
 {{HTML::style('/packages/css/curiosity/puntajesdad.css')}}
 {{HTML::style('/packages/css/curiosity/helper.css')}}
@stop

@section('title')
	Puntajes | {{Auth::user()->username}}
@stop


@section('titulo_contenido')
	Estadísticas de mis hijos
@stop

@section('titulo_small')
<div class='row'>
	<div class='col-md-10 col-xs-12 col-sm-10'>
		<button class='btn tooltipShowRight' type='button' style='background-color:#2d96ba; color:white;' id='showHelp'>
		  <i class='fa fa-info-circle'></i>
    </button>
    <div class="modal fade" id="helper" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true" data-keyboard="false">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-body">
            <button type="button" class="close" data-dismiss="modal" id="closehelp" aria-hidden="true">&times;</button>
            <center>
              <span class="fa fa-info-circle" id="iconhelp"></span>
              <br><br>
              <h4 id="tituloHelp">Sección de Estadísticas de mis hijos</h4>
              <br>
            </center>
            <div id="cuerpoHelp">
              <p class="text-justify">
                En la sección de estadísticas se muestra primeramente a cada uno de tus hijos registrados. Junto a cada uno
                de ellos podrás observar de manera agrupada lo siguiente:
              </p>
              <br>
              <ul>
                <li>
                  <b>Seguimiento de actividades diarias</b>
                  <br>
                  Se muestra una gráfica en la cual podrás observar cada uno de los últimos 7 (siete) días en los que tu hijo a ingresado a
                  <i>Curiosity.com.mx</i>, y por cada uno de estos días se muestra cuántos fueron sus juegos terminados. <br>
                  Esto lo hacemos para que tú como padre puedas observar y hacer un seguimiento del empeño y esfuerzo de tus hijos.
                  <br>
                  <small><i><b>Nota: </b>Las fechas de cada gráfica se muestran con el formato (yyyy-mm-dd)</i></small>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
	</div>
</div>
@stop


@section('panel_opcion')
<div class="container-fluid" id="seccionesHijos"></div>
@stop


@section('mi_js')
{{HTML::script('/packages/js/libs/chart/Chart.bundle.min.js')}}
{{HTML::script('/packages/js/curiosity/puntajesHijo.js')}}
@stop
