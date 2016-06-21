@extends('admin_base')

@section('title')
  Tipos de Inteligencia
@stop

@section('mi_css')
@stop

@section('titulo_contenido')
  Tipos de Inteligencia
@stop

@section('migas')
  <li><a href="/inicio">Inicio</a></li>
  <li class="fa fa-angle-right separatorBrand"></li>
  <li><a href="/inteligencia{{$perteneciente}}" class="brandActive">{{$objetos2[0]->nombre}}</a></li>
@stop

@section('panel_opcion')
  @foreach($objetos as $objeto)
  <div class='col-md-4 objeto'>
    <div class='box box-widget widget-title objetoPointer' data-estatus={{$objeto->estatus}} data-id = {{ $objeto->id }}>
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
        <img class='img-circle' src='/packages/images/inteligencias/{{$objeto->imagen}}'>
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
  {{HTML::script('/packages/js/curiosity/inteligencia.js')}}
@stop
