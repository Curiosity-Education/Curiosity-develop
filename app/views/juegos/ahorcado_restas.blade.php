@extends('juegos.vista_juego_layer')

@section('juego_css')
  {{HTML::style('/packages/css/curiosity/juegos/ahorcado_restas.css')}}
@stop

@section('title')
  ahorcado
@stop
@section('panel_opciones')
@section('game_end')
<div class="lives">
      <i class="fa fa-heart"></i>
      <i class="fa fa-heart"></i>
      <i class="fa fa-heart"></i>
      <i class="fa fa-heart"></i>
      <i class="fa fa-heart"></i>
      <i class="fa fa-heart"></i>
</div>

@stop
@section('game')
<!-- SECCION DONDE SE DESARROLLARÁ EL JUEGO EN SI -->
    <div id="game" class="row">
      <div class='col-md-7 first-part-game'>
        <!-- all horcado here-->
        <canvas id="can">Sorry, your browser doesn't support the HTML5 element canvas.</canvas>
      </div>
      <div class="col-md-5 second-part-game">
        <!-- all operation here-->
        <div class="zona-operation">
          <h2 class="fa fa-minus fa-plus"></h2>
          <table class="operation">
            <thead>
              <tr>
                <th>C</th>
                <th>D</th>
                <th>U</th>
              </tr>
            </thead>
            <tbody>
              <tr class="first-operation">
                <td></td>
                <td></td>
                <td></td>
              </tr>
              <tr class="second-operation">
                <td></td>
                <td></td>
                <td></td>
              </tr>
              <tr class="result-operation">
                <td>_</td>
                <td>_</td>
                <td>_</td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="zona-numeros row">
          <div class="col-md-10 numeros">
            <div class="row">
                <h1 class="num">1</h1>
                <h1 class="num">2</h1>
                <h1 class="num">3</h1>
                <h1 id="delete"><i class="fa fa-arrow-left"></i></h1>
            </div>
            <div class="row">
                <h1 class="num">4</h1>
                <h1 class="num">5</h1>
                <h1 class="num">6</h1>
                <h1 id="check"><i class="fa fa-check-circle"></i></h1>
            </div>
            <div class="row">
                <h1 class="num">7</h1>
                <h1 class="num">8</h1>
                <h1 class="num">9</h1>
                <h1 class="num">0</h1>
            </div>
          </div>
        </div>
      </div>
    </div>
@stop
@section('juego_js')
  {{HTML::script('packages/js/curiosity/juegos/ahorcado_restas.js')}}
@stop
