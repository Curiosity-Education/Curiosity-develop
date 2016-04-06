@extends('admin_base')

@section('title')
  Admin. Grados
@stop

@section('mi_css')
@stop

@section('titulo_contenido')
  Administrar Grados Escolares
@stop

@section('migas')
  <li><a href="/adminNivel" class="brandActive">Grados Escolares</a></li>
  <li class="fa fa-angle-right separatorBrand"></li>
@stop

@section('panel_opcion')
<!-- Sección General -->

<div id="viewSection">
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

  <form id="imagenForm" class="form-horizontal">
    <input type="file" class="hidden" id="up-image" accept="image/jpeg,image/png" name="up-image">
  </form>

@foreach($niveles as $nivel)
  <div class='col-md-4 objeto' data-id = {{ $nivel->id }}>
    <div class='box box-widget widget-title'>
      <div class="widget-title-header {{ $nivel->bg_color }}">
        <h3 class='widget-title-set text-center' data-descrip='{{$nivel->descripcion}}' data-estatus='{{$nivel->estatus}}' id={{$nivel->id}}>{{$nivel->nombre}}</h3>
        <h5 class='widget-title-desc'></h5>
      </div>
      <div class='widget-title-image'>
        <img class='img-circle img-effect' src='/packages/images/niveles/{{$nivel->imagen}}' data-id = {{ $nivel->id }}>
      </div>
      <div class='box-footer'>
        <div class='row'>
          <div class='col-xs-4 border-right'>
            <div class='description-block btnUpdate' data-id = {{ $nivel->id }}>
              <span class='fa fa-refresh fa-3x' title="Actualizar" ></span>
              <br>
              <span class='description-text'>ACTUALIZAR<br></span>
            </div>
          </div>
          <div class='col-xs-4 border-right'>
            <div class='description-block btnRemove' data-id = {{ $nivel->id }}>
              <span class='fa fa-remove fa-3x' title="Eliminar"></span>
              <br>
              <span class='description-text' >Eliminar</span>
            </div>
          </div>
          <div class='col-xs-4'>
            <div class='description-block btnIn' data-id = {{ $nivel->id }}>
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
      <button type="button" class="btn btn-primary" id="enviarEnv">
        <i class="fa fa-check"></i>
        Guardar
      </button>
    </div>
  </div>

@stop

@section('mi_js')
  {{HTML::script('/packages/js/curiosity/nivelesAdmin.js')}}
@stop
