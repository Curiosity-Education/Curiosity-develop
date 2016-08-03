@extends('juegos.vista_juego_layer')

@section('juego_css')
  {{HTML::style('/packages/css/curiosity/juegos/figuras_lados.css')}}
@stop

@section('title')
  Figuras y Lados
@stop

@section('juego')
@stop

@section('game')
<div class="container-fluid">
    <div class="row">
        <div class="principal">
            <div class="col-md-6 col-sm-6 col-xs-7" id="seccion1">
                <div class="cuadroimg text-center">
                    <div class="row-fluid aleatorio">
                        <div class="col-md-5 col-sm-5 col-xs-5" id="figura1"></div>
                        <div class="p col-md-2 col-sm-2 col-xs-2 text-center" id="simbolo"></div>
                        <div class="col-md-5 col-sm-5 col-xs-5" id="figura2"></div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-sm-6 col-xs-5 notesalgas">
                <div id="figurita"></div>
                <div class="row">
                    <div class="col-md-2 col-md-2 col-xs-2 pad">
                        <div class="carta" id="c0">
                            <div class="tecla text-center">0</div>
                        </div>
                    </div>
                    <div class="col-md-2 col-sm-2 col-xs-2 pad">
                        <div class="carta" id="c1">
                            <div class="tecla text-center">1</div></div>
                        </div>
                    <div class="col-md-2 col-sm-2 col-xs-2 pad">
                        <div class="carta" id="c2">
                            <div class="tecla text-center">2</div></div>
                        </div>
                    <div class="col-md-2 col-sm-2 col-xs-2 pad">
                        <div class="carta" id="c3">
                            <div class="tecla text-center">3</div></div>
                        </div>
                    <div class="col-md-2 col-sm-2 col-xs-2 pad">
                        <div class="carta" id="c4">
                            <div class="tecla text-center">4</div></div>
                        </div>
                    <div class="col-md-2 col-sm-2 col-xs-2 pad">
                        <div class="carta" id="borrar">
                            <div class="iconos2 text-center">
                                <div class="fa fa-arrow-left" aria-hidden="true"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-2 col-sm-2 col-xs-2 pad">
                        <div class="carta" id="c5">
                            <div class="tecla text-center">5</div></div>
                        </div>
                    <div class="col-md-2 col-sm-2 col-xs-2 pad">
                        <div class="carta" id="c6">
                            <div class="tecla text-center">6</div></div>
                        </div>
                    <div class="col-md-2 col-sm-2 col-xs-2 pad">
                        <div class="carta" id="c7">
                            <div class="tecla text-center">7</div></div>
                        </div>
                    <div class="col-md-2 col-sm-2 col-xs-2 pad">
                        <div class="carta" id="c8">
                            <div class="tecla text-center">8</div></div>
                        </div>
                    <div class="col-md-2 col-sm-2 col-xs-2 pad">
                        <div class="carta" id="c9">
                            <div class="tecla text-center">9</div></div>
                        </div>
                    <div class="col-md-2 col-sm-2 col-xs-2 pad">
                        <div class="carta" id="comprobar">
                            <div class="iconos text-center">
                                <i class="fa fa-check" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="respuestadiv col-md-12 col-sm-12 col-xs-12">
                        <div class="respuestatext text-center" id="respuesta">R = </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop

@section('juego_js')
  {{HTML::script('/packages/js/curiosity/juegos/figuras_lados.js')}}
@stop

