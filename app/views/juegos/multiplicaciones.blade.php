@extends('juegos.vista_juego_layer')

@section('juego_css')
  {{HTML::style('/packages/css/curiosity/juegos/multiplicaciones.css')}}
@stop

@section('title')
  Multiplicación Mayor
@stop

@section('titulo_small')
@stop

@section('juego')
@stop

@section('game')
    <div class="row">
      <div class="col-md-4 valor-resp">
        <div id="resp-1"></div>
      </div>
      <div class="col-md-4 valor-resp">
        <div id="resp-igual">=</div>
      </div>
      <div class="col-md-4 valor-resp">
        <div id="resp-2"></div>
      </div>
    </div>
@stop

@section('juego_js')
  {{HTML::script('/packages/js/curiosity/juegos/multiplicaciones.js')}}
@stop
