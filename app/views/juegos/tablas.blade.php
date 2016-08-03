@extends('juegos.vista_juego_layer')

@section('juego_css')
  {{HTML::style('/packages/css/curiosity/juegos/tablas.css')}}
  {{HTML::style('/packages/jquery-ui-1.11.4.custom/jquery-ui.min.css')}}
@stop

@section('title')
  tablas
@stop
@section('juego')

    <!-- SECCION DONDE SE DESARROLLARÁ EL JUEGO EN SI -->
    <audio id="sound-correct" src="{{asset('/packages/sounds/juegos/correct.mp3')}}"></audio>
    <audio id="sound-correct1" src="{{asset('/packages/sounds/juegos/correct1.mp3')}}"></audio>
    <audio id="sound-error" src="{{asset('/packages/sounds/juegos/error.mp3')}}"></audio>

@stop
@section('juego_end')
 <div class="row stars">
      <div id="niveles" class="col-md-4">
          <i class="fa fa-star fa-2x"></i>
          <i class="fa fa-star fa-2x"></i>
          <i class="fa fa-star fa-2x"></i>
          <i class="fa fa-star fa-2x"></i>
          <i class="fa fa-star fa-2x"></i>
          <i class="fa fa-star fa-2x"></i>
          <i class="fa fa-star fa-2x"></i>
          <i class="fa fa-star fa-2x"></i>
          <i class="fa fa-star fa-2x"></i>
          <i class="fa fa-star fa-2x"></i>
      </div>
  </div>
  <img src="{{asset('packages/images/games/start.png')}}" class="img-responsive img-start"/>
  <img src="{{asset('packages/images/games/incorrecto.png')}}" class="img-responsive img-incorrect"/>
@stop
@section('game')
          <button data-toggle="modal" hidden data-target="#nivel-tablas"></button>
          <div class="modal fade" id="nivel-tablas" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
              <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                <h3 class="modal-title" id="myModalLabel"><i class="icon fa fa-check-square-o"></i> SELECCIONA EL NIVEL <hr></h3>
                </div>
                <div class="modal-body">
                <div class="contenedor-nivel">
                  <div class="container-fluid">
                    <div class="col-md-12 col-xs-12">
                      <div class="">
                        <div class="col-md-4 col-xs-12">
                          <button id="" class="niveles btn form-control active"><i class="icon fa fa-star"></i> 1</button>
                        </div>
                        <div class="col-md-4 col-xs-12">
                          <button id="" class="niveles btn form-control"><i class="icon fa fa-star"></i> 2</button>
                        </div>
                        <div class="col-md-4 col-xs-12">
                          <button id="" class="niveles btn form-control"><i class="icon fa fa-star"></i> 3</button>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="container-fluid">
                    <div class="col-md-12 col-xs-12">
                      <div class="">
                        <div class="col-md-4 col-xs-12">
                          <button id="" class="niveles btn form-control"><i class="icon fa fa-star"></i> 4</button>
                        </div>
                        <div class="col-md-4 col-xs-12">
                          <button id="" class="niveles btn form-control"><i class="icon fa fa-star"></i> 5</button>
                        </div>
                        <div class="col-md-4 col-xs-12">
                          <button id="" class="niveles btn form-control"><i class="icon fa fa-star"></i> 6</button>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="container-fluid">
                    <div class="col-md-12 col-xs-12">
                      <div class="">
                        <div class="col-md-4 col-xs-12">
                          <button id="" class="niveles btn form-control"><i class="icon fa fa-star"></i> 7</button>
                        </div>
                        <div class="col-md-4 col-xs-12">
                          <button id="" class="niveles btn form-control"><i class="icon fa fa-star"></i> 8</button>
                        </div>
                        <div class="col-md-4 col-xs-12">
                          <button id="" class="niveles btn form-control"><i class="icon fa fa-star"></i> 9</button>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="container-fluid"><br>
                  <div class="col-md-4 col-xs-8 col-xs-offset-">
                    <img src="/packages/images/games/lupa-rosa.png" alt="" id="avatar">
                  </div>
                  <div class="col-md-7 col-md-offset-1 col-xs-12">
                    <h4 class="modal-title"><i class="icon fa fa-mortar-board"></i> SELECCIONA EL MODO <hr></h4>
                    <div class="row">
                      <div class="col-md-12 col-xs-12" id="contenedor-modo">
                        <div class="col-md-4 col-md-offset-">
                          <input name="modo" type="radio" class="radio" id="actividad" checked>
                          <label for="actividad">Actividad</label>
                        </div>
                        <div class="col-md-4 col-md-offset-2">
                          <input name="modo" type="radio" class="radio" id="practica">
                          <label for="practica">Práctica</label>
                        </div>
                      </div>
                    </div>
                  </div>
                  </div><hr>
                <div class="container-fluid">
                  <div class="col-md-4 col-md-offset-8 col-xs-12">
                  <button id="jugar" type="button"  data-dismiss="modal" class="btn form-control"><i class="icon fa fa-play"></i> Jugar</button>
                 </div>
                </div>
              </div>
              </div>
            </div>
          </div>
      <div class="row">
          <div class="tables col-md-12">
             <div class="row">
               <div class="col-md-6">
                  <table class="table">
                     <tbody>
                          <tr class="tb activ text-justify">
                              <td><i class="fa check fa-square-o fa-2x"></i></td>
                              <td><p class="n1"></p></td><td><i class="fa fa-remove"></i></td><td><p class="n2"></p></td><td><p class="equal">=</p></td><td> <p class="res">&#63;</p></td>
                           </tr>
                          <tr class="tb">
                              <td><i class="fa check fa-square-o fa-2x"></i></td>
                              <td><p class="n1"></p></td>
                              <td><i class="fa fa-remove"></i></td>
                              <td><p class="n2"></p></td>
                              <td><p class="equal">=</p></td>
                              <td><p class="res"></p></td>
                          </tr>
                          <tr class="tb">
                              <td><i class="fa check fa-square-o fa-2x"></i></td>
                              <td><p class="n1"></p></td> <td><i class="fa fa-remove"></i></td><td> <p class="n2"></p></td><td> <p class="equal">=</p></td><td> <p class="res"></p></td>
                         </tr>
                          <tr class="tb">
                              <td><i class="fa check fa-square-o"></i></td>
                              <td><p class="n1"></p></td> <td><i class="fa fa-remove"></i></td><td> <p class="n2"></p></td><td> <p class="equal">=</p></td><td> <p class="res"></p></td>
                         </tr>
                          <tr class="tb">
                              <td><i class="fa check fa-square-o"></i></td>
                              <td><p class="n1"></p></td> <td><i class="fa fa-remove"></i></td><td> <p class="n2"></p></td><td> <p class="equal">=</p></td><td> <p class="res"></p></td>
                         </tr>
                          <tr class="tb">
                              <td><i class="fa check fa-square-o"></i></td>
                              <td><p class="n1"></p></td> <td><i class="fa fa-remove"></i></td><td> <p class="n2"></p></td><td> <p class="equal">=</p></td><td> <p class="res"></p></td>
                         </tr>
                          <tr class="tb">
                              <td><i class="fa check fa-square-o"></i></td>
                              <td><p class="n1"></p></td> <td><i class="fa fa-remove"></i></td><td> <p class="n2"></p></td><td> <p class="equal">=</p></td><td> <p class="res"></p></td>
                         </tr>
                          <tr class="tb">
                              <td><i class="fa check fa-square-o"></i></td>
                              <td><p class="n1"></p></td> <td><i class="fa fa-remove"></i></td><td> <p class="n2"></p></td><td> <p class="equal">=</p></td><td> <p class="res"></p></td>
                         </tr>
                          <tr class="tb">
                              <td><i class="fa check fa-square-o"></i></td>
                              <td><p class="n1"></p></td> <td><i class="fa fa-remove"></i></td><td> <p class="n2"></p></td><td> <p class="equal">=</p></td><td> <p class="res"></p></td>
                         </tr>
                          <tr class="tb">
                              <td><i class="fa check fa-square-o"></i></td>
                              <td><p class="n1"></p></td> <td><i class="fa fa-remove"></i></td><td> <p class="n2"></p></td> <td><p class="equal">=</p></td><td> <p class="res"></p></td>
                         </tr>
                      </tbody>
                  </table>
               </div>
               <div class="col-md-6 tb-respuestas">
                   <div class="row zona-numeros">
                      <h2>0</h2><h2>1</h2><h2>2</h2><h2>3</h2><h2>4</h2>
                      <br>
                      <h2>5</h2><h2>6</h2><h2>7</h2><h2>8</h2><h2>9</h2>
                   </div>
                   <div class="row zona-respuestas">
                       <div class="advice text-center col-md-12"><p>Arrastra la respuesta aquí</p> <i class="fa fa-hand-o-down"></i></div>
                       <h1 class="n-res1 col-md-3 center-cont"></h1>
                       <h1 class="n-res2 col-md-3 hidden"></h1>
                   </div>
               </div>
             </div>
          </div>
      </div>
@stop
@section('juego_js')

  {{HTML::script('/packages/js/curiosity/juegos/tablas.js')}}
@stop
