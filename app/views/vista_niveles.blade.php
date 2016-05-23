@extends('admin_base')

@section('title')
  Niveles
@stop

@section('mi_css')
@stop

@section('titulo_contenido')
  Grados Escolares
@stop

@section('migas')
  <li><a href="/nivel" class="brandActive">Grados Escolares</a></li>
  <li class="fa fa-angle-right separatorBrand"></li>
@stop

@section('panel_opcion')
  @foreach($niveles as $nivel)
    <div class='col-md-4 objeto'>
      <div class='box box-widget widget-title objetoPointer' data-estatus={{$nivel->estatus}} data-id = {{ $nivel->id }}>
        <div class="widget-title-header" style="background-color: {{$nivel->bg_color}}">
          <h3 class='widget-title-set text-center'> {{$nivel->nombre}} </h3>
          <h5 class='widget-title-desc'></h5>
        </div>
        @if($nivel->estatus == "lock")
          <div class="butonEstatus text-center" style="background-color: {{$nivel->bg_color}}">
            <span class='fa fa-clock-o fa-estatus-color'></span>&nbsp;
            Próximamente
          </div>
        @endif
        <div class='widget-title-image'>
          <img class='img-circle' src='/packages/images/niveles/{{$nivel->imagen}}'>
        </div>
        <div class='box-footer'>
          <div class='row'>
            <div class='col-xs-4 border-right'>
              <div class='description-block'>
              </div>
            </div>
            <div class='col-xs-4 border-right'>
              @if($nivel->estatus != "lock")
                <div class='description-block'>
                  <span class='fa fa-star fa-star-color fa-4x tooltipShow' title='{{$nivel->descripcion}}'></span>
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
  {{HTML::script('/packages/js/curiosity/nivel.js')}}
@stop
