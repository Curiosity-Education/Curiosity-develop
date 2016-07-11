@extends('juegos.vista_juego_layer')
@section('juego_css')
  {{HTML::style('/packages/css/curiosity/juegos/conteo-basico.css')}}
@stop
@section('title')
  Conteo de Comida
@stop

@section('juego')
<!-- SECCION DONDE SE DESARROLLARÁ EL JUEGO EN SI -->
   @section('game')
    <div class="container contenedor-padre">
        <div class="row">
            <div class="col-md-12">
                 <div class="conteiner contenedor1">
                     <div class="row">
                        <div class="col-md-12">
                           <div class="iconos">

                            </div>
                        </div>
                      </div>
                    </div>
                <div class="conteiner contenedor2">
                    <div class="row">
                        <div class="col-md-12">
                        <div class="barajas">
                            <div id="cartas">
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @stop
@stop

@section('juego_js')
  {{HTML::script('/packages/js/curiosity/juegos/conteo-basico.js')}}
@stop
