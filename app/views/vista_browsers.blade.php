@extends('admin_base')

@section('title')
  Navegadores mas usados
@stop

@section('mi_css')
  {{ HTML::style('/packages/css/libs/bootstrap_table/bootstrap-table.css') }}
@stop

@section('titulo_contenido')
  Navegadores mas usados
@stop

@section('migas')
  <li><a href="/getBrowsers" class="brandActive">Navegadores</a></li>
  <li class="fa fa-angle-right separatorBrand"></li>
@stop

@section('panel_opcion')
  <div id="zonaData">

    <div class='col-md-12'>
      <table id="tabla-browsers" class="table table-stripped table-responsive"
        data-pagination="true"
        data-search="true"
        data-show-toggle="true"
        data-show-columns="true"
        data-toolbar="#toolbar"
        data-click-to-select="true"
        data-select-item-name="radioSelect"
        data-minimum-count-columns='2'
        data-page-list="[10, 25, 50, 100, Todo]">
        <thead id="">
          <tr>
            <th data-field='browser'>Navegador</th>
            <th data-field='uso_personas'>Personas Usandolo</th>
          </tr>
        </thead>
      </table>
    </div>
  </div>
@stop

@section('mi_js')
  {{HTML::script('/packages/js/libs/bootstrap_table/bootstrap-table.js')}}
  {{HTML::script('/packages/js/libs/bootstrap_table/locale/bootstrap-table-es-MX.js')}}
  {{HTML::script('/packages/js/curiosity/getBrowsersAdmin.js')}}
@stop
