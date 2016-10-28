@extends('admin_base') 
@section('title') 
   Planes de membresias
@stop 
@section('mi_css') 
    <!--Links css--> 
@stop 
@section('titulo_contenido') 
   <!--Titulo del contenido--> 
   Planes de membresias
@stop 
@section('migas') 
   <!--Migas de retorno--> 
@stop 
@section('panel_opcion') 
   <!--Contenido completo--> 
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
      <table id="tabla-planes" class="table table-stripped table-responsive"
        data-pagination="true"
        data-search="true"
        data-show-toggle="true"
        data-show-columns="true"
        data-toolbar="#toolbar"
        data-click-to-select="true"
        data-select-item-name="radioSelect"
        data-minimum-count-columns='2'
        data-page-list="[10, 25, 50, 100, Todo]">
        <thead id="tabla-head-planes">
          <tr>
            <th data-field="state" data-radio="true"></th>
            <th data-field='id'>id</th>
            <th data-field='name'>Nombre</th>
            <th data-field='interval'>Intervalo</th>
            <th data-field='amount'>Monto</th>
            <th data-field='currency'>Moneda</th>
            <th data-field='type'>Tipo</th>
            <th data-field='active'>Tipo</th>
          </tr>
        </thead>
      </table>
    </div>
  </div>

<!-- Sección de Administración -->
  <div class="col-md-12" id="adminSection" hidden="hidden">
    <form id="frm_planes">
      <div class="form-group">
        <label for="nombre">Nombre</label>
        <input type="text" class="form-control" id="nombre" name="nombre">
      </div>
      <div class="form-group">
        <label for="interval">Intervalo de cobro</label>
        <select class="form-control" id="interval" name="interval">
          <option value='month' selected>Mensual</option>
          <option value='semester'>Semestral</option>
          <option value='year'>Anual</option>
        </select>
      </div>
      <div class="form-group">
        <label for="amount">Monto</label>
        <input type="number" class="form-control" id="amount" name="amount">
      </div>
      <div class="form-group">
        <label for="currency">Tipo de moneda</label>
        <select class="form-control" id="currency" name="currency">
          <option value='mxn' selected>MXN</option>
          <option value='usd'>USD</option>
        </select>
      </div>
      <div class="form-group">
        <label for="type">Tipo</label>
        <select class="form-control" id="type" name="type">
          <option value='gold' selected>Gold</option>
          <option value='silver'>Silver</option>
          <option value='bronze'>Bronze</option>
        </select>
      </div>
      <div class="form-group">
        <label for="active">Tipo</label>
        <select class="form-control" id="active" name="active">
          <option value='1' selected>Activado</option>
          <option value='0'>Desactivado</option>
        </select>
      </div>
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
   <!--Script Javascript--> 
   {{HTML::script('packages/js/curiosity/planes.js')}}
@stop 

