@extends('juegos.vista_juego_layer')

@section('juego_css')
  {{HTML::style('/packages/css/curiosity/juegos/fracciones.css')}}
@stop

@section('title')
  Menor-Mayor
@stop

@section('juego')
@stop

@section('game')
    <div id="principal">
        <div id="pregunta" class="medio2">
            <div class="eq-c">
                <div class="fraction">
                    <span id="num1">1</span>
                    <span class="fdn" id="num2">2</span>
                </div>
                <div id="simbolo">+</div>
                <div class="fraction">
                    <span id="num3">3</span>
                    <span class="fdn" id="num4">4</span>
                </div>
            </div>  
        </div>
        <div id="respuestas" class="row">
            <div id="op1" class="respuesta medio3 col-md-3 col-sm-3 col-xs-3">
                <div id="entero1" class="entero"></div>
                <div class="fraction">
                    <span id="rn1">1</span>
                    <span class="fdn" id="rn2">2</span>
                </div>
            </div>
            <div id="op2" class="respuesta medio3 col-md-3 col-sm-3 col-xs-3">
                <div class="fraction">
                    <div id="entero2" class="entero"></div>
                    <span id="rn3">1</span>
                    <span class="fdn" id="rn4">2</span>
                </div>
            </div>
            <div id="op3" class="respuesta medio3 col-md-3 col-sm-3 col-xs-3">
                <div class="fraction">
                    <div id="entero3" class="entero"></div>
                    <span id="rn5">1</span>
                    <span class="fdn" id="rn6">2</span>
                </div>
            </div>
            <div id="op4" class="respuesta medio3 col-md-3 col-sm-3 col-xs-3">
                <div class="fraction">
                    <div id="entero4" class="entero"></div>
                    <span id="rn7">1</span>
                    <span class="fdn" id="rn8">2</span>
                </div>
            </div>
        </div>
    </div>
@stop

@section('juego_js')
  {{HTML::script('packages/js/curiosity/juegos/fracciones.js')}}
 
@stop

