@extends('juegos.vista_juego_layer')

@section('juego_css')
  {{HTML::style('/packages/css/curiosity/juegos/sumas_restas.css')}}
@stop

@section('title')
  Sumas y Restas
@stop

@section('titulo_small')
@stop

@section('juego')
          <!-- SECCION DONDE SE DESARROLLARÁ EL JUEGO EN SI -->
          <div id="zona-play" hidden="hidden">
            <div class="row">
              <div class="col-md-12 text-right">
                <div class="temp">
                  <label id="temp-count"></label>
                </div>
              </div>
              <!-- <div class="col-md-2 text-right">
                <div class="temp">
                  <h5><b>Tiempo Restante</b></h5>
                  <h3 id="temp-count"></h3>
                </div>
              </div> -->
            </div>
            <div class="row">
              <div class="col-xs-6 col-md-4 valor-resp">
                <div id="resp-1"></div>
              </div>
              <div class="col-xs-6 col-md-4 valor-resp">
                <div id="resp-igual">=</div>
              </div>
              <div class="col-xs-6 col-xs-offset-3 col-md-4 col-md-offset-0 valor-resp">
                <div id="resp-2"></div>
              </div>
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
                      <div class="verific">
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
@stop

@section('juego_js')
  {{HTML::script('/packages/js/curiosity/juegos/sumas_restas.js')}}
@stop
