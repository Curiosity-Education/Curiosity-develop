@extends('admin_base')

@section('title')
  Admin. Videos inicio
@stop

@section('mi_css')
  {{ HTML::style('/packages/css/libs/bootstrap_table/bootstrap-table.css') }}
  {{ HTML::style('/packages/css/curiosity/videosInicio.css') }}
@stop

@section('titulo_contenido')
  Administrar Videos
@stop

@section('migas')
  <li><a href="/videoInicio" class="brandActive">Videos de Inicio</a></li>
  <li class="fa fa-angle-right separatorBrand"></li>
@stop

@section('panel_opcion')
  <div id="zonaData">
    <div id="toolbar" class="btn-group">
      <button type="button" class="btn btn-default" id="playSelected">
          <i class="fa fa-play"></i>&nbsp;
          Reproducir Seleccionado
      </button>
    </div>

    <div class='col-md-12'>
      <table id="tabla-videos" class="table table-stripped table-responsive"
        data-pagination="true"
        data-search="true"
        data-show-toggle="true"
        data-show-columns="true"
        data-toolbar="#toolbar"
        data-click-to-select="true"
        data-select-item-name="radioSelect"
        data-minimum-count-columns='2'
        data-page-list="[10, 25, 50, 100, Todo]">
        <thead id="tabla-head-videos">
          <tr>
            <th data-field="state" data-radio="true"></th>
            <th data-field='grado'>Grado</th>
            <th data-field='inteligencia'>Inteligencia</th>
            <th data-field='bloque'>Bloque</th>
            <th data-field='tema'>Tema</th>
            <th data-field='actividad'>Actividad</th>
          </tr>
        </thead>
      </table>
    </div>
  </div>

@stop

@section('mi_js')
  {{HTML::script('/packages/js/libs/bootstrap_table/bootstrap-table.js')}}
  {{HTML::script('/packages/js/libs/bootstrap_table/locale/bootstrap-table-es-MX.js')}}
  {{HTML::script('/packages/js/curiosity/videosInicio.js')}}
@stop
