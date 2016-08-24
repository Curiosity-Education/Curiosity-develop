@extends('admin_base')

@section('title')
  Temas Encontrados
@stop

@section('mi_css')
  {{ HTML::style('/packages/css/curiosity/tema.css') }}
  {{ HTML::style('/packages/css/curiosity/temasFound.css') }}
@stop

@section('titulo_contenido')
  Temas encontrados por "{{$dato}}"
@stop

@section('migas')
@stop

@section('panel_opcion')
 <div id="temasFound">
    @if($temas)
      @foreach($temas as $tema)
        <div class='col-md-12 largeCard' data-rol="{{$rol}}" data-estatus="{{$tema->estatusTema}}" data-prem="{{$tema->isPremium}}" data-found="{{$tema->idTema}}" style="border-right: solid 25px {{$tema->colorTema}};">
          <div class="row">
            <div class="col-xs-4 col-md-2">
              <img src="/packages/images/temas/{{$tema->imagenTema}}" class="img-responsive imgTema">
            </div>
            <div class="col-xs-8 col-md-10">
              <h3 class="titleTema"><b>{{$tema->nombreTema}}</b></h3>
              @if(Auth::user()->hasRole('hijo_free') || Auth::user()->hasRole('root') && $tema->isPremium == 1 )
              <span class="fa fa-star isPremiumFound" style="background-color:{{$tema->colorTema}};"></span>
              @endif
              <hr class="dividerTitle">
              <p class="temaDir">
                <span class="fa fa-caret-right"></span>&nbsp;&nbsp;{{$tema->nombreNivel}}&nbsp;
                <span class="fa fa-caret-right"></span>&nbsp;&nbsp;{{$tema->nombreInteligencia}}&nbsp;
                <span class="fa fa-caret-right"></span>&nbsp;&nbsp;{{$tema->nombreBloque}}&nbsp;
              </p>
              <br>
              @if($tema->estatusTema == 'lock')
                <div class="butonEstatusFound text-center">
                  <span class='fa fa-clock-o fa-estatus-color'></span>&nbsp;
                  Próximamente
                </div>
              @endif
            </div>
          </div>
        </div>
      @endforeach
    @else
      <div class='col-md-12 largeCardOut'>
        <center>
          <h1><b>Lo sentimos, no se han encontrado temas por el término establecido</b></h1>
        </center>
      </div>
    @endif
</div>

@stop

@section('mi_js')
  {{ HTML::script('/packages/js/curiosity/temasFound.js') }}
  <script type="text/javascript">
    $("#navbar-search-input").val("{{$dato}}");
  </script>
@stop
