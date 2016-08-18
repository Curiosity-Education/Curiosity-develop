@extends('admin_base')

@section('title')
  Inicio
@stop

@section('mi_css')
  {{HTML::style('/packages/css/curiosity/home_actividades.css')}}
  {{HTML::style('/packages/css/libs/slick-carousel-1_6/slick.css')}}
  {{HTML::style('/packages/css/libs/slick-carousel-1_6/slick-theme.css')}}
@stop

@section('titulo_contenido')
Bienvenido a Curiosity
@stop

@section('migas')
  <li class="hidden-xs"><a href="javascript:void(0)" style="cursor:default;">¡Que tu curiosidad no tenga límites!</a></li>
@stop

@section('panel_opcion')
  <section class="panelWelcome">
    <div class="row">
      <div class="col-sm-4">
        <center><img src="/packages/images/curiosityGif.gif" id="avatarWelcome"></center>
      </div>
      <div class="col-sm-8 text-center">
        <h2 style="font-family: Kiddish !important;"><b>¡Aprende mientras te diviertes!</b></h2>
        <p id="text">
          Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ipsam, porro velit, recusandae temporibus blanditiis eaque aliquam modi maxime magnam, assumenda incidunt necessitatibus fugit optio amet nisi enim autem culpa doloremque.
        </p>
        <br>
        <h6 class="pull-right"><i class="references">Nombre de alguien</i></h6>
      </div>
    </div>
  </section>

  <section class="carruselNews">
    <div id="myCarousel" class="carousel slide" data-ride="carousel">
      <!-- Indicators -->
      <ol class="carousel-indicators"></ol>

      <!-- Wrapper for slides -->
      <div class="carousel-inner" role="listbox" id="carrusel-list">
        @foreach($nuevos as $nuevo)
        <div class="item">
          <div class="imgSlideNew" style='background:{{$nuevo->bg_color}};background-position: center;background-repeat: no-repeat;background-size: cover;'></div>
          <div class="carousel-caption">
            <h3>{{$nuevo->nombre}}</h3>
            <p class="hidden-xs">{{$nuevo->objetivo}}</p>
            <button type="button" class="btn btn-warning btnPlay gotoplay" data-as='{{$nuevo}}' data-r='{{$rol}}'>
              <span class="fa fa-play"></span>&nbsp;
              Comenzar a jugar
            </button>
            <br><br>
          </div>
        </div>
        @endforeach
      </div>

      <!-- Left and right controls -->
      <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>
    </div>
  </section>

  <section class="panels">
    <div class="row">
      <div class="col-sm-6">
        <div class="panelsLook panelPopular">
          <center><h4 style="background-color: #ed6922;">Juegos Más Populares</h4></center>
          @foreach($populares as $popular)
          <div class='row elementObj gotoplay' data-as='{{$popular}}' data-r='{{$rol}}'>
            <div class='col-xs-3 col-sm-2'>
              <img src='/packages/images/actividades/{{$popular->imagen}}' class='img-circle img-responsive'>
            </div>
            <div class='col-xs-9 col-sm-10 nameGamePanels'>
              <h5>{{$popular->nombre}}</h5>
              <h6>{{$popular->nombreNivel}} > {{$popular->nombreInteligencia}} > {{$popular->nombreBloque}} > {{$popular->nombreTema}}</h6>
              @if($popular->estatus == "lock")
              <span class="fa fa-clock-o isLockThis"></span>
              @endif
              @if($popular->premium == 1 and Auth::User()->hasRole('hijo_free'))
              <span class="fa fa-star isPremiumThis"></span>
              @endif
            </div>
          </div>
          @endforeach
        </div>
      </div>
      <div class="col-sm-6">
        <div class="panelsLook panelRanking">
          <center><h4 style="background-color: #3cb54a;">Juegos Mejor Calificados</h4></center>
          <!--  -->
          @foreach($ranking as $rank)
          <div class='row elementObj gotoplay' data-as='{{$rank}}' data-r='{{$rol}}'>
            <div class='col-xs-3 col-sm-2'>
              <img src='/packages/images/actividades/{{$rank->imagen}}' class='img-circle img-responsive'>
            </div>
            <div class='col-xs-9 col-sm-10 nameGamePanels'>
              <h5>{{$rank->nombre}}</h5>
              <h6>{{$rank->nombreNivel}} > {{$rank->nombreInteligencia}} > {{$rank->nombreBloque}} > {{$rank->nombreTema}}</h6>
              @if($rank->estatus == "lock")
              <span class="fa fa-clock-o isLockThis"></span>
              @endif
              @if($rank->premium == 1 and Auth::User()->hasRole('hijo_free'))
              <span class="fa fa-star isPremiumThis"></span>
              @endif
            </div>
          </div>
          @endforeach
          <!--  -->
        </div>
      </div>
      @if(!$recomendables)
      <div hidden="hidden">
      @else
       <div class="col-xs-12">
       @endif

        <div class="panelsLook panelParaTi">
          <center><h4 style="background-color: #44c6ee;">Juegos Recomendados para Tí</h4></center>
          @foreach($recomendables as $recomendable)
              <div class='row elementObj gotoplay' data-as='{{$recomendable}}' data-r='{{$rol}}'>
                <div class='col-xs-3 col-sm-1'>
                  <img src='/packages/images/actividades/{{$recomendable->imagen}}' class='img-circle img-responsive'>
                </div>
                <div class='col-xs-9 col-sm-11 nameGamePanels'>
                  <h5>{{$recomendable->nombre}}</h5>
                  <h6>{{$recomendable->nombreNivel}} > {{$recomendable->nombreInteligencia}} > {{$recomendable->nombreBloque}} > {{$recomendable->nombreTema}}</h6>
                  @if($recomendable->estatus == "lock")
                  <span class="fa fa-clock-o isLockThis"></span>
                  @endif
                  @if($recomendable->premium == 1 and Auth::User()->hasRole('hijo_free'))
                  <span class="fa fa-star isPremiumThis"></span>
                  @endif
                </div>
              </div>
          @endforeach
        </div>
      </div>
    </div>
  </section>

  <section class="row divisorGrados">
    <div class="col-xs-12">
      <center>
        <h3 style="font-family: Kiddish !important; font-size:2.5em;">
          <b><span class="tilde">~ </span>Nuevos Videos<span class="tilde"> ~</span></b>
        </h3>
        <br><br>
      </center>
    </div>
  </section>

  <div class="container-fluid">
    <div class="col-md-12">
      <section class="slickVideos">
        @foreach($videos as $video)
        <div class='col-xs-6 col-md-3'>
          <iframe width='100%' src='{{$video->code_embed}}' frameborder='0'></iframe>
        </div>
        @endforeach
        <!-- <div class="row">
          <div class="col-xs-12">
            <center>
              <button type="button" class="videosArrow" id="gotoback">
                <span class="fa fa-chevron-left"></span>
              </button>
              <button type="button" class="videosArrow" id="gotonext">
                <span class="fa fa-chevron-right"></span>
              </button>
            </center>
          </div>
        </div> -->
      </section>
    </div>
  </div>

  <br><br>

  <section class="row divisorGrados">
    <div class="col-xs-12">
      <center>
        <h3 style="font-family: Kiddish !important; font-size:2.5em;">
          <b><span class="tilde">~ </span>Grado Escolar<span class="tilde"> ~</span></b>
        </h3>
      </center>
    </div>
  </section>

  <section class="row grades">
    @foreach($grados as $grado)
    <div class="col-xs-4 col-md-2 grade">
      <img src="/packages/images/niveles/{{$grado->imagen}}" class="img-responsive imgGrade"
      data-grade='{{$grado->id}}'
      data-status="{{$grado->estatus}}">
    </div>
    @endforeach
  </section>
@stop

@section('mi_js')
  {{HTML::script('/packages/js/libs/slick-carousel-1_6/slick.min.js')}}
  {{HTML::script('/packages/js/curiosity/home_actividades.js')}}
@stop
