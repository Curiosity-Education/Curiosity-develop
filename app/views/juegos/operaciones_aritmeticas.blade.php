@extends('juegos.vista_juego_layer')
@section('juego_css')
  {{HTML::style('/packages/css/curiosity/juegos/operaciones_aritmeticas.css')}}
@stop
@section('title')
 Incógnita
@stop
@section('juego')
         <!-- SECCION DONDE SE DESARROLLARÁ EL JUEGO EN SI -->
         <audio src="{{asset('packages/sounds/juegos/fondo.mp3')}}" loop="true" id="sound-fondo"></audio>
           <div id="zona-play">
            <div class="row">
              <div class="col-md-12 text-right">
                <div class="temp">
                  <h3><label id="temp-count"></label></h3>
                </div>
              </div>
            </div>
            <div id="game">
              <div class="row operaciones"></div>
              <div class="row options">
                <div class="col-md-4"></div>
                <div class="col-md-6 "></div>
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
  {{HTML::script('packages/js/curiosity/juegos/operaciones_aritmeticas.js')}}
@stop
