@extends('admin_base')

@section('title')
  Temas
@stop

@section('mi_css')
<style media="screen">
  .isPremium{
    position: absolute;
    width: 35px;
    height: 35px;
    border-radius: 50%;
    margin: 10px;
    color: rgba(255, 255, 255, .9) !important;
    font-size: 1.7em;
    padding-left: 10px;
    padding-top: 8px;
    box-shadow: 2px 2px 5px rgba(0, 0, 0, .6);
  }
</style>
@stop

@section('titulo_contenido')
  Temas
@stop

@section('migas')
  <li><a href="/nivel">Grados Escolares</a></li>
  <li class="fa fa-angle-right separatorBrand"></li>
  <li><a href="/inteligencia{{$objetos[0]['nivel_id']}}">{{$objetos[0]['nivel_nombre']}}</a></li>
  <li class="fa fa-angle-right separatorBrand"></li>
  <li><a href="/bloque{{$objetos[0]['inteligencia_id']}}">{{$objetos[0]['inteligencia_nombre']}}</a></li>
  <li class="fa fa-angle-right separatorBrand"></li>
  <li><a href="/tema{{$objetos[0]['bloque_id']}}">{{$objetos[0]['bloque_nombre']}}</a></li>
@stop

@section('panel_opcion')
  @foreach($objetos as $objeto)
  <div class='col-md-4 objeto'>
    <div class='box box-widget widget-title objetoPointer' data-rol='{{$rol}}'' data-prem='{{ $objeto->isPremium }}' data-estatus={{$objeto->estatus}} data-id = {{ $objeto->id }}>
      @if(Auth::user()->hasRole('hijo_free') || Auth::user()->hasRole('root') && $objeto->isPremium == 1 )
      <!-- <img src="/packages/images/premium.png" class="img-responsive isPremium"/> -->
      <span class="fa fa-lock isPremium" style="background-color: {{$objeto->bg_color}}"></span>
      @endif
      <div class="widget-title-header" style="background-color: {{$objeto->bg_color}}">
        <h3 class='widget-title-set text-center'> {{$objeto->nombre}} </h3>
        <h5 class='widget-title-desc'></h5>
      </div>
      @if($objeto->estatus == "lock")
      <div class="butonEstatus text-center" style="background-color: {{$objeto->bg_color}}">
        <span class='fa fa-clock-o fa-estatus-color'></span>&nbsp;
        Próximamente
      </div>
      @endif
      <div class='widget-title-image'>
        <img class='img-circle' src='/packages/images/temas/{{$objeto->imagen}}'>
      </div>
      <div class='box-footer'>
        <div class='row'>
          <div class='col-xs-4 border-right'>
            <div class='description-block'>
            </div>
          </div>
          <div class='col-xs-4 border-right'>
            @if($objeto->estatus != "lock")
              <div class='description-block'>
                <span class='fa fa-star fa-star-color fa-4x tooltipShow' title='{{$objeto->descripcion}}'></span>
              </div>
            @endif
          </div>
          <div class='col-xs-4'>
            <div class='description-block btnIn'>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  @endforeach
@stop

@section('mi_js')
  {{HTML::script('/packages/js/curiosity/tema.js')}}
@stop
