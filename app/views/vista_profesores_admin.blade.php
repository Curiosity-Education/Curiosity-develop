@extends('admin_base')

@section('title')
  Admin. Profesores
@stop

@section('mi_css')
  {{ HTML::style('/packages/css/libs/bootstrap_table/bootstrap-table.css') }}
  {{ HTML::style('/packages/css/curiosity/profesores.css') }}
@stop

@section('titulo_contenido')
  Administrar Profesores
@stop

@section('migas')
  <li><a href="/adminProfesor" class="brandActive">Profesores</a></li>
  <li class="fa fa-angle-right separatorBrand"></li>
@stop

@section('panel_opcion')
  <div id="zonaData">
    <div id="toolbar" class="btn-group">
      <button type="button" class="btn btn-default tooltipShow" id="agregar" title="Registrar Nuevo">
          <i class="fa fa-plus"></i>
      </button>
      <button type="button" class="btn btn-default tooltipShow" id="actualizar" title="Modificar Seleccionado">
          <i class="fa fa-refresh"></i>
      </button>
      <button type="button" class="btn btn-default tooltipShow" id="eliminar" title="Eliminar Seleccionado">
          <i class="fa fa-trash"></i>
      </button>
    </div>

    <div class='col-md-12'>
      <table id="tabla-profesores" class="table table-stripped table-responsive"
        data-pagination="true"
        data-search="true"
        data-show-toggle="true"
        data-show-columns="true"
        data-toolbar="#toolbar"
        data-click-to-select="true"
        data-select-item-name="radioSelect"
        data-minimum-count-columns='2'
        data-page-list="[10, 25, 50, 100, Todo]">
        <thead id="tabla-head-profesores">
          <tr>
            <th data-field="state" data-radio="true"></th>
            <th data-field='profesor'>Profesor</th>
            <th data-field='email'>E-Mail</th>
            <th data-field='escuela'>Escuela</th>
          </tr>
        </thead>
      </table>
    </div>
  </div>

<!-- Sección de Administración -->
  <div class="col-md-12" id="adminSection" hidden="hidden">
    <div class="form-group">
      <label for="nombre">Nombre</label>
      <input type="text" class="form-control" id="nombre" name="nombre">
    </div>
    <div class="form-group">
      <label for="ape_p">Apellido Paterno</label>
      <input type="text" class="form-control" id="ape_p" name="ape_p">
    </div>
    <div class="form-group">
      <label for="ape_m">Apellido Materno</label>
      <input type="text" class="form-control" id="ape_m" name="ape_m">
    </div>
    <div class="form-group">
      <label for="escuela">Escuela a que pertenece</label>
      <select class="form-control" id="escuela" name="escuela">
        <option value=''></option>
        @foreach($escuelas as $escuela)
        <option value='{{$escuela->id}}'>{{$escuela->nombre}}</option>
        @endforeach
      </select>
    </div>
    <div class="form-group">
      <label for="email">Correo Electrónico</label>
      <input type="text" class="form-control" id="email" name="email">
    </div>
    <div class="form-group">
      <label for="gustos">Gustos</label>
      <textarea type="text" class="form-control" id="gustos" name="gustos"></textarea>
    </div>
    <label for="logotipo">Foto</label>
    <form id="foto_profe">
      <input type="file" class="form-control" id="foto" name="foto" accept="image/jpeg,image/png,image/jpg">
    </form>
    <div class="form-group text-right">
      <br>
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
  {{HTML::script('/packages/js/libs/bootstrap_table/bootstrap-table.js')}}
  {{HTML::script('/packages/js/libs/bootstrap_table/locale/bootstrap-table-es-MX.js')}}
  {{HTML::script('/packages/js/curiosity/profesoresAdmin.js')}}
@stop
