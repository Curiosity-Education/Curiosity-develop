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

<div class="modal fade" id="modalPremium" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true" data-keyboard="false">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body text-center">
        <button type="button" class="close" data-dismiss="modal" id="closePrem" aria-hidden="true">&times;</button>
        <span class="fa fa-star" id="iconPrem"></span>
        <br><br>
        <h4 class="tituloPrem">Desbloquea el Tema.</h4>
        <br>
        <p class="text-center bodyPrem">
          Este Tema se encuentra bloqueado por hoy.<br>
          Puedes Jugar en él pasándote a Premium ahora.<br><br>
          Cuentale ahora a tus padres, No esperes más!!
        </p>
        <!-- <br>
        <button type="button" id="botonPremium" class="btn btn-primary btn-lg">
          Notificarle a mis Padres
        </button> -->
      </div>
    </div>
  </div>
</div>

@stop

@section('mi_js')
  {{ HTML::script('/packages/js/curiosity/temasFound.js') }}
@stop
