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

@stop

@section('game')
  <div class="row operaciones"></div>
  <div class="row options">
    <div class="col-md-4"></div>
    <div class="col-md-6 "></div>
  </div>
@stop
@section('juego_js')
  {{HTML::script('packages/js/curiosity/juegos/operaciones_aritmeticas.js')}}
@stop
