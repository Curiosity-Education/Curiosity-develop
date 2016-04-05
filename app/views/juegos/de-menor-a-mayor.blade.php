@extends('juegos.vista_juego_layer')

@section('juego_css')
  {{HTML::style('/packages/css/curiosity/juegos/de-menor-a-mayor.css')}}
@stop

@section('title')
  Menor-Mayor
@stop

@section('juego')

  <!-- SECCION DONDE SE DESARROLLARÁ EL JUEGO EN SI -->
  <div id="zona-play" hidden="hidden">
    <div class="row">
      <div class="col-md-10 text-left">
        <h4><b id="act-reglas">Selecciona los numeros de menor a mayor </b></h4>
      </div>
      <div class="col-md-2 text-right">
        <div class="temp">
          <h5><b>Tiempo Restante</b></h5>
          <h3 id="temp-count"></h3>
        </div>
      </div>
    </div>
    <div id="game">
    </div>
    <div class="row">
      <div class="col-xs-12">
        <div class="zona-puntaje">
          <div class="row">
            <div class="col-xs-6">
              <h3>
                <span class="fa fa-trophy"></span>
                <b id="countPuntaje"></b>
                <b>Puntos</b>
              </h3>
            </div>
            <div class="col-xs-2">
            	<div id="combo"></div>
            </div>
            <div class="col-xs-4 text-right">
              <div class="verific"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@stop

@section('juego_js')
  {{HTML::script('/packages/js/curiosity/juegos/de-menor-a-mayor.js')}}
@stop
