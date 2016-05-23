@extends('admin_base')

@section('title')
  Admin. Inteligencia
@stop

@section('mi_css')
@stop

@section('titulo_contenido')
  Administrar Tipos de Inteligencia
@stop

@section('migas')
  <li><a href="/adminNivel">Grados Escolares</a></li>
  <li class="fa fa-angle-right separatorBrand"></li>
  <li><a href="/adminInteligencia{{$perteneciente}}" class="brandActive">{{$objetos2[0]['nombre']}}</a></li>
@stop

@section('panel_opcion')
<!-- Sección General -->

<div id="viewSection">
  @if(!Entrust::can('subir_juegos') || Auth::user()->hasRole('root'))
  <div class='col-md-4'>
    <div class='box box-widget widget-title' id="addNew">
      <div class='widget-title-header'></div>
      <div class='widget-title-image'>
        <i class="fa fa-plus-circle"></i>
        <h4>Agregar Nuevo</h4>
      </div>
      <div class='box-footer'></div>
    </div>
  </div>
  @endif

  <form id="imagenForm" class="form-horizontal">
    <input type="file" class="hidden" id="up-image" accept="image/jpeg,image/png" name="up-image">
  </form>

@foreach($objetos as $objeto)
  <div class='col-md-4 objeto' data-id = {{ $objeto->id }} data-id-remove = {{$objeto->id}}>
    <div class='box box-widget widget-title'>
      <div class="widget-title-header" style="background-color: {{$objeto->bg_color}}">
        <h3 class='widget-title-set text-center' data-descrip='{{$objeto->descripcion}}' data-color="{{$objeto->bg_color}}" data-estatus='{{$objeto->estatus}}' id={{$objeto->id}}>{{$objeto->nombre}}</h3>
        <h5 class='widget-title-desc'></h5>
      </div>
      <div class='widget-title-image'>
        <img class='img-circle img-effect tooltipShow' title="Cambiar imagen" src='/packages/images/inteligencias/{{$objeto->imagen}}' data-id-img={{$objeto->id}}>
      </div>
      <div class='box-footer'>
        <div class='row'>
        @if(!Entrust::can('subir_juegos') || Auth::user()->hasRole('root'))
          <div class='col-xs-4 border-right'>
            <div class='description-block btnUpdate' data-id = {{ $objeto->id }}>
              <span class='fa fa-refresh fa-3x' title="Actualizar" ></span>
              <br>
              <span class='description-text'>ACTUALIZAR<br></span>
            </div>
          </div>
          <div class='col-xs-4 border-right'>
            <div class='description-block btnRemove' data-id = {{ $objeto->id }}>
              <span class='fa fa-remove fa-3x' title="Eliminar"></span>
              <br>
              <span class='description-text' >Eliminar</span>
            </div>
          </div>
          @endif
          <div class='col-xs-4'>
            <div class='description-block btnIn'
              data-id-enter={{$objeto->id}}
              data-nivelid={{$perteneciente}}>
              <span class='fa fa-arrow-right fa-3x'></span>
              <br>
              <span class='description-text'>Ingresar</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  @endforeach
</div>

<!-- Sección de Administración -->
  <div class="col-md-12" id="adminSection" hidden="hidden">
    <form  method="POST" class="form-horizontal" id="formulario">
      <div class="form-group">
        <label for="nombre">Nombre</label>
        <input type="text" class="form-control" id="nombre" name="nombre">
      </div>
      <div class="form-group">
        <label for="descripcion">Descripción</label>
        <textarea name="descripcion" class="form-control" id="descripcion" rows="5"></textarea>
      </div>
      <div class="form-group">
        <label for="color">Seleccionar Color:</label>
        &nbsp;&nbsp;
        <input type="color" name="color" id="color">
      </div>
      <div class="form-group" hidden="hidden" id="botonEstatus">
        <label>Click para bloquear/desbloquear</label><br>
        <i class="fa fa-lock fa-4x" id="btnLock"></i>
      </div>
    </form>
    <div class="form-group text-right">
      <button type="button" class="btn btn-warning" id="cancelarEnv">
        <i class="fa fa-remove"></i>
        Cancelar
      </button>
      <button type="button" class="btn btn-primary" data-nivel={{$perteneciente}} id="enviarEnv">
        <i class="fa fa-check"></i>
        Guardar
      </button>
    </div>
  </div>

@stop

@section('mi_js')
  {{HTML::script('/packages/js/curiosity/inteligenciasAdmin.js')}}
@stop
