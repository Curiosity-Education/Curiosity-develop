@extends('admin_base')

@section('title')
  Actividades (Juegos)
@stop

@section('mi_css')
@stop

@section('titulo_contenido')
  Actividades (Juegos)
@stop

@section('migas')
  <li><a href="/nivel">Grados Escolares</a></li>
  <li class="fa fa-angle-right separatorBrand"></li>
  <li><a href="/inteligencia{{$objetos[0]['nivel_id']}}">{{$objetos[0]['nivel_nombre']}}</a></li>
  <li class="fa fa-angle-right separatorBrand"></li>
  <li><a href="/bloque{{$objetos[0]['inteligencia_id']}}">{{$objetos[0]['inteligencia_nombre']}}</a></li>
  <li class="fa fa-angle-right separatorBrand"></li>
  <li><a href="/tema{{$objetos[0]['bloque_id']}}">{{$objetos[0]['bloque_nombre']}}</a></li>
  <li class="fa fa-angle-right separatorBrand"></li>
  <li><a href="/actividad{{$objetos[0]['tema_id']}}">{{$objetos[0]['tema_nombre']}}</a></li>
@stop

@section('panel_opcion')
 <div id="actividades">
  @foreach($objetos as $objeto)
  <div class='col-md-4 objeto'>
    <div class='box box-widget widget-title objetoPointer' data-estatus={{ $objeto->estatus }} data-id = {{ $objeto->id }}>
      <div class="widget-title-header {{ $objeto->bg_color }}">
        <h3 class='widget-title-set text-center'> {{$objeto->nombre}} </h3>
        <h5 class='widget-title-desc'></h5>
      </div>
      @if($objeto->estatus == "lock")
        <div class="butonEstatus text-center {{$objeto->bg_color}}">
          <span class='fa fa-lock fa-2x fa-estatus-color' title="Estatus" ></span>
        </div>
      @endif
      <div class='widget-title-image'>
        <img class='img-circle' src='/packages/images/actividades/{{$objeto->imagen}}'>
      </div>
      <div class='box-footer'>
        <div class='row'>
          <div class='col-xs-4 border-right'>
            <div class='description-block'>
            </div>
          </div>
          <div class='col-xs-4 border-right'>
            <div class='description-block'>
              <span class='fa fa-star fa-star-color fa-4x tooltipShow' title='{{$objeto->descripcion}}'></span>
            </div>
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
</div>
@stop

@section('mi_js')
  {{HTML::script('/packages/js/curiosity/actividad.js')}}
@stop
