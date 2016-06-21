@extends('admin_base')

@section('mi_css')
  {{ HTML::style('/packages/css/curiosity/juegos/juego_layer.css') }}
  @yield('juego_css')
@stop
@section('titulo_contenido')
   {{--<label id="juego-titulo">{{ $datos[0]->actividad_nombre }}</label>--}}
@stop
@section('panel_opcion')
@yield('panel_opciones')
   <div class="container">
    <div class="row">
      <div class="col-md-4"></div>
      <div class="col-md-4">
        <div class="modal fade" id="modalPrueba" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true" data-backdrop="static" data-keyboard="false">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header" id="modal-header-juego">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <div class="row">
                  <div class="col-md-4 col-md-offset-4">
                    <img src="/packages/images/cups/win1.png" alt="" class="img-responsive">
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12 text-center" id="modal-puntos">
                    <center><h1><b id="modal-puntos-head"></b></h1></center>
                  </div>
                </div>
              </div>
              <div class="modal-body" id="modal-body-juego">
                <div class="row">
                  <div class="col-md-6">
                      <h4 id="modal-puntos-now"></h4>
                  </div>
                  <div class="col-md-6">
                      <h4 id="modal-puntos-max"></h4>
                  </div>
                </div>
              </div>
              <div class="modal-footer" id="modal-footer-juego">
                <div class="row">
                  <div class="col-md-12">
                    <center>
                      <div class="actividadBotones">
                        <button type="button" class="btn btn-default btnVideo">
                          <span class="fa fa-youtube-play"></span>&nbsp;
                          <b>Ver explicación en video</b>
                        </button>
                      </div>
                    </center>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-4"></div>
    </div>
  </div>

  <div class="modal fade" id="modalVideo" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title" id="">Video de Estudio</h4>
        </div>
        <div class="modal-body">
         {{--<iframe width="100%" height="350" src="{{ $datos[0]->code_embed }}" frameborder="0" allowfullscreen></iframe>--}}
        </div>
        <div class="modal-footer">

        </div>
      </div>
    </div>
  </div>

  <div class="container-fluid cont-game">
      <div class="row">
          <div class="col-xs-12">
              <div class="zona-juego">
                <div id="zona-obj">
                  <div class='row'>
                    <div class='col-md-5 text-center' id='max-pts'>
                      <center>
                        <img src="" class="img-responsive" width="60%" id="imgNivel"/>
                      </center>
                      <div class="row">
                        <div class="col-md-12 cal-titulo">
                          <h3>Máxima Puntuación</h3>
                          {{--<h1><b id="num-max-pts">{{ $maxProm }} pts</b></h1>--}}
                        </div>
                      </div>
                    </div>
                    <div class='col-md-7' id='objetivo'>
                      <div class="row">
                        <div class="col-md-12">
                          <!-- Slider contenedor -->
                          <section class="slider-container">
                            <ul id="slider" class="slider-wrapper">
                              <li class="slide-current">
                                <img src="/packages/images/games/s1.png" alt="img-1">
                                <div class="caption">
                                  <p>Un juego divertido perfecto para ti.</p>
                                </div>
                              </li>
                              <li>
                                <img src="/packages/images/games/s2.png" alt="img-2">
                                <div class="caption">
                                  <p>Un juego divertido perfecto para ti.</p>
                                </div>
                              </li>
                              <li>
                                <img src="/packages/images/games/s3.png" alt="img-3">
                                <div class="caption">
                                  <p>Un juego divertido perfecto para ti.</p>
                                </div>
                              </li>
                            </ul>
                            <!-- INICIO DE MODAL SUMAS Y RESTAS --> 
                              <div class="modal fade" id="modal-instrucciones" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                  <div class="modal-header">
                                  
                                  <center><h3 class="modal-title" id="myModalLabel"><i class="icon fa fa-flag-checkered"></i> INSTRUCCIONES DE JUEGO </h3></center>
                                  <center><h4 class="modal-title" id="titulo-juego">| Sumas y Restas |<hr></h4></center>
                                  </div>
                                  <div class="modal-body">
                                  <div class="contenedor-video wow slideInRight" data-wow-duration="1s">
                                    <div class="container-fluid">
                                      <div class="col-md-12 col-xs-12" id="video">
                                        <video src="/packages/video/games/instrucciones/sumas_restas.mp4" controls></video>
                                      </div>
                                    </div>
                                  </div><br>
                                  <div class="contenedor-texto wow slideInLeft" data-wow-duration="1s">
                                    <div class="container-fluid">
                                      <div class="col-md-12 col-xs-12" id="texto">
                                        <center><p>1. Decide qué circulo tiene el resultado más alto y tócala.</p></center>
                                        <center><p>2. Si los resultados son iguales, toca el botón iguales.</p></center>
                                      </div>
                                    </div>
                                  </div>
                                  <hr>
                                  
                                    <div class="container-fluid">
                                    <div class="col-md-5 col-md-offset-7 col-xs-12">
                                      <button id="omitir" type="button" class="btn form-control" data-dismiss="modal" aria-label="Close"><i class="icon fa fa-times-circle"></i> saltar instrucciones</button>
                                     </div>
                                    </div>
                                  </div>
                                  </div>
                                </div>
                              </div>
                        
                            <!-- Controles -->
                            <!--<ul id="slider-controls" class="slider-controls">

                            </ul>-->
                          </section>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-5">
                          <div class="text-right boton-instrucciones">
                            <button type="button" class="btn btn-info btn-lg" id="btn-instrucciones" data-toggle="modal" data-target="#modal-instrucciones">
                              <i class="fa fa-book"></i> Instrucciones
                            </button>
                          </div>
                        </div> 
                        <div class="col-md-7">
                          <div class="text-right boton-comezar">
                            <button type="button" class="btn btn-info btn-lg" id="btn-comenzar">
                              <i class="fa fa-gamepad"></i> Comenzar Actividad
                            </button>
                          </div>
                        </div>
                       </div>
                    </div>
                  </div>
                </div>
                @yield('juego')
             <!-- Modal para el menu de pausa -->
              <div id="zona-play" hidden="hidden">
                <div class="row">
                  <div class="col-md-4"></div>
                  <div class="col-md-4">
                     <div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" id="menu-juego" data-backdrop="static" data-keyboard="false">
                      <div class="modal-dialog modal-sm">
                      <div class="modal-content col-md-12 col-xs-12" id="modal-conten-pausa">
                        <div class="col-md-12 col-xs-12" id="content"><br>
                          <center><h3 class="" id="titulo">Menu de Juego</h3> <hr></center>
                       
                          <div class="col-md-12">
                            <center><h4 role="button" class="btn form-control modal-title myModalLabel" data-dismiss="modal" id="continuar"><i class="icon fa fa-play"></i> Continuar</h4></center>
                            <center><h4 role="button" class="btn form-control modal-title myModalLabel" data-dismiss="modal" id="reiniciar"><i class="icon fa fa-refresh"></i> Reiniciar juego</h4></center>
                            <center><h4 role="button" class="btn form-control modal-title myModalLabel" id="ayuda"><i class="icon fa fa-question-circle"></i> Ayuda</h4></center>
                            <center><h4 role="button" class="btn form-control modal-title myModalLabel" data-dismiss="modal" id="salir_juego"><i class="icon fa fa-sign-out"></i> Salir del juego</h4></center>
                            
                          </div>
                        </div>
                      </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-4"></div>
                </div>
                <canvas id="mycanvas" style="" width="130px" height="130px"></canvas>
                <div class="row">
                  <div class="col-md-10 text-left">
                      <button id="pausa" class="btn btn-warning" data-toggle="modal" data-target="#menu-juego"><i class="fa fa-pause"></i></button>
                  </div>
                  <div class="col-md-2 text-right">
                    <div class="temp">
                      <label id="temp-static">1:00</label>
                      <label id="temp-count"></label>
                    </div>
                  </div>
                </div>
                @yield('game_init')
                <div id="game">
                  @yield('game')
                </div>
                @yield('game_end')
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
                          <div class="verific"></div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
        </div>
    </div>

  <!-- SECCION FINAL DONDE SE COLOCA LA PUNTUACION POR ESTRELLAS Y LOS BOTONES DE DESCARGA Y VIDEO -->
  <div class="row">
    <div class="col-md-4">
      <h3><b>Califica la Actividad</b></h3>
      <span class="cali fa fa-star-o fa-2x"></span>
      <span class="cali fa fa-star-o fa-2x"></span>
      <span class="cali fa fa-star-o fa-2x"></span>
      <span class="cali fa fa-star-o fa-2x"></span>
      <span class="cali fa fa-star-o fa-2x"></span>
    </div>
    <div class="col-md-8 text-right">
      <div class="actividadBotones">
        <a target="_blank" class="btn btn-default btnDownloadPDF" {{--href="/packages/docs/{{ $datos[0]->pdf }}"--}}>
          <span class="fa fa-download"></span>&nbsp;
          <b>Guía de estudio PDF</b>
        </a>
        <button type="button" class="btn btn-default btnVideo">
          <span class="fa fa-youtube-play"></span>&nbsp;
          <b>Ver explicación en video</b>
        </button>
      </div>
    </div>
  </div>
</div>
@stop

@section('mi_js')

  {{ HTML::script('/packages/js/libs/jquery-ui/jquery-ui.min.js') }}
  {{ HTML::script('/packages/js/curiosity/juegos/juegos_layer.js') }}
  <script type="text/javascript">
    $juego.game.setMaxPuntuacion({{$maxProm}});
    {{--
      var cali=0;
     @if(Auth::user()->hasRole('hijo') || Auth::user()->hasRole("demo_hijo") || Auth::user()->hasRole("hijo_free"))
         $.ajax({
             url:"/actividad-get-cali",
             type:"post"
         }).done(function(r){
             cali =r;
             $.each($(".cali"),function(i,o){
               if(i<r){
                   $(o).attr("class","cali fa fa-star fa-2x");
               }
             });
         }).fail(function(e){
             console.error(e);
         });
     @endif
     $(".cali").hover(function(){
         $(".cali").attr("class","cali fa fa-star-o fa-2x");
         var calificacion = $(this).index();
          $.each($(".cali"),function(i,o){
            if(i<calificacion){
                $(o).attr("class","cali fa fa-star fa-2x");
            }
         });
     });
     $(".cali").mouseleave(function(){
         $(".cali").attr("class","cali fa fa-star-o fa-2x");
         $.each($(".cali"),function(i,o){
             if(i<cali){
                 $(o).attr("class","cali fa fa-star fa-2x");
             }
         });
     });
     $(".cali").click(function(){
         $(".cali").attr("class","cali fa fa-star-o fa-2x");
         var calificacion = $(this).index();
         cali = calificacion;
         $.each($(".cali"),function(i,o){
            if(i<calificacion){
                $(o).attr("class","cali fa fa-star fa-2x");
            }
         });
         @if(Auth::user()->hasRole('hijo') || Auth::user()->hasRole("demo_hijo") || Auth::user()->hasRole("hijo_free"))
         $.ajax({
             url:"/actividad-save-cali",
             type:"post",
             data:{calificacion:calificacion}
         }).done(function(r){
             console.info(r);
         }).fail(function(e){
             console.error(e);
         });
         @endif
     });
        --}}
  </script>
  @yield('juego_js')
@stop
