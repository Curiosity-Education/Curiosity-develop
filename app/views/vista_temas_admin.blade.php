@extends('admin_base')

@section('title')
  Admin. Temas
@stop

@section('mi_css')
@stop

@section('titulo_contenido')
  Administrar Temas
@stop

@section('migas')
  <li><a href="/adminNivel">Grados Escolares</a></li>
  <li class="fa fa-angle-right separatorBrand"></li>
  <li><a href="/adminInteligencia{{$obj_nivel[0]->id}}">{{$obj_nivel[0]->nombre}}</a></li>
  <li class="fa fa-angle-right separatorBrand"></li>
  <li><a href="/adminBloque{{$obj_inteligencia[0]->id}}_{{$obj_nivel[0]->id}}" class="brandActive">{{$obj_inteligencia[0]->nombre}}</a></li>
  <li class="fa fa-angle-right separatorBrand"></li>
  <li><a href="/adminTema{{$obj_bloque[0]->id}}_{{$obj_inteligencia[0]->id}}_{{$obj_nivel[0]->id}}" class="brandActive">{{$obj_bloque[0]->nombre}}</a></li>
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

@foreach($obj_temas as $tema)
  <div class='col-md-4 objeto' data-id = {{ $tema->id }} data-id-remove = {{$tema->id}}>
    <div class='box box-widget widget-title'>
      <div class="widget-title-header {{ $tema->bg_color }}">
        <h3 class='widget-title-set text-center' data-descrip='{{$tema->descripcion}}' data-estatus='{{$tema->estatus}}' id={{$tema->id}}>{{$tema->nombre}}</h3>
        <h5 class='widget-title-desc'></h5>
      </div>
      <div class='widget-title-image'>
        <img class='img-circle img-effect tooltipShow' title="Cambiar imagen" src='/packages/images/temas/{{$tema->imagen}}' data-id-img={{$tema->id}}>
      </div>
      <div class='box-footer'>
        <div class='row'>
        @if(!Entrust::can('subir_juegos') || Auth::user()->hasRole('root'))
          <div class='col-xs-4 border-right'>
            <div class='description-block btnUpdate' data-id = {{ $tema->id }}>
              <span class='fa fa-refresh fa-3x' title="Actualizar" ></span>
              <br>
              <span class='description-text'>ACTUALIZAR<br></span>
            </div>
          </div>
          <div class='col-xs-4 border-right'>
            <div class='description-block btnRemove' data-id = {{ $tema->id }}>
              <span class='fa fa-remove fa-3x' title="Eliminar"></span>
              <br>
              <span class='description-text'>Eliminar</span>
            </div>
          </div>
          @endif
          <div class='col-xs-4'>
            <div class='description-block btnIn'
              data-id-tema={{$tema->id}}
              data-id-bloque={{$obj_bloque[0]['id']}}
              data-id-inteligencia={{$obj_inteligencia[0]['id']}}
              data-id-nivel={{$obj_nivel[0]['id']}}>
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
      <button type="button" class="btn btn-primary"
        data-nivel={{$obj_nivel[0]['id']}}
        data-inteligencia={{$obj_inteligencia[0]['id']}} id="enviarEnv"
        data-bloque={{$obj_bloque[0]['id']}}>
        <i class="fa fa-check"></i>
        Guardar
      </button>
    </div>
  </div>

@stop

@section('mi_js')
  {{HTML::script('/packages/js/curiosity/temasAdmin.js')}}
@stop
