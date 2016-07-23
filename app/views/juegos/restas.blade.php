@extends('juegos.vista_juego_layer')

@section('juego_css')
  {{HTML::style('/packages/css/curiosity/juegos/restas.css')}}
@stop

@section('title')
  Restas
@stop

@section('titulo_small')
@stop

@section('juego')
         
@stop

@section('game')
 <!-- SECCION DONDE SE DESARROLLARÁ EL JUEGO EN SI -->
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
@stop

@section('juego_js')
  {{HTML::script('/packages/js/curiosity/juegos/restas.js')}}
@stop
