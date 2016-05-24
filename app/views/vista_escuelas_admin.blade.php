@extends('admin_base')

@section('title')
  Admin. Escuelas
@stop

@section('mi_css')
  <style type="text/css">
    .boxEscuela{
      min-width: 100%;
      height: auto;
      cursor: pointer;
    }
    .boxEscuela > .fa-plus-circle{
      font-size: 7em;
    }
    .boxEscuelaAdd{
      padding: 10px;
      box-sizing:border-box;
    }
    .boxEscuelaAdd > h4{
      font-size: 1em;
      font-weight: bold;
    }
    .boxEscuelaLog:hover{
      opacity: .5;
      transition:.4s;
    }
  </style>
@stop

@section('titulo_contenido')
  Administrar Escuelas
@stop

@section('migas')
  <li><a href="/adminEscuelas" class="brandActive">Escuelas</a></li>
  <li class="fa fa-angle-right separatorBrand"></li>
@stop

@section('panel_opcion')
<!-- Sección General -->

<div id="viewSection">
  <div class='col-xs-4 col-sm-3 col-md-2'>
    <div class='boxEscuelaAdd boxEscuela text-center' id="addNew">
      <i class="fa fa-plus-circle"></i>
      <h4>Agregar Nuevo</h4>
    </div>
  </div>

  @foreach($escuelas as $escuela)
    <div class='col-xs-4 col-sm-3 col-md-2' id='{{$escuela->id}}'>
      <div class='boxEscuela boxEscuelaLog' data-escuela-id='{{$escuela->id}}' data-escuela-web='{{$escuela->web}}' data-escuela-nombre='{{$escuela->nombre}}'>
        <img src='/packages/images/escuelas/{{$escuela->logotipo}}' class='img-responsive tooltipShow' title="Click para gestionar">
      </div>
    </div>
  @endforeach
</div>

<!-- Sección de Administración -->
  <div class="col-md-12" id="adminSection" hidden="hidden">
    <div class="form-group">
        <label for="nombre">Nombre</label>
        <input type="text" class="form-control" id="nombre" name="nombre">
      </div>
      <div class="form-group">
        <label for="web">Página Web</label>
        <input type="text" class="form-control" id="web" name="web">
      </div>
      <label for="logotipo">Logotipo de Escuela</label>
      <form id="formLogo">
        <input type="file" class="form-control" id="logotipo" name="logotipo" accept="image/jpeg,image/png,image/jpg">
    </form>
    <div class="form-group text-right">
      <br>
      <button type="button" class="btn btn-warning" id="cancelarEnv">
        <i class="fa fa-remove"></i>
        Cancelar
      </button>
      <button type="button" class="btn btn-danger" id="eliminarEnv" hidden="hidden">
        <i class="fa fa-remove"></i>
        Eliminar
      </button>
      <button type="button" class="btn btn-primary" id="enviarEnv">
        <i class="fa fa-check"></i>
        Guardar
      </button>
    </div>
  </div>

@stop

@section('mi_js')
  {{HTML::script('/packages/js/curiosity/escuelasAdmin.js')}}
@stop
