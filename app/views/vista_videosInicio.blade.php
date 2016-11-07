@extends('admin_base')

@section('title')
  Admin. Videos inicio
@stop

@section('mi_css')
  {{ HTML::style('/packages/css/libs/bootstrap_table/bootstrap-table.css') }}
  {{ HTML::style('/packages/css/curiosity/videosInicio.css') }}
  <script type="text/javascript">
        var y_star;
        function allowDrop(ev) {
            ev.preventDefault();
        }
      
        function drag(ev) {
            console.log(ev.target);
            ev.dataTransfer.setData("text",ev.target.getAttribute("data-index"));
            console.log(ev.target.id);
            y_star = ev.pageY;
        }
        
        function drop(ev) {
            console.log(ev.target);
            ev.preventDefault();
            var data = ev.dataTransfer.getData("text");
            console.log(ev.target);
            if(y_star>ev.pageY){
                $("[data-index="+data+"]").insertBefore(ev.target.parentElement);
            //    $("table").trigger("changeColumns");
            }else{
                $("[data-index="+data+"]").insertAfter(ev.target.parentElement);
             //   $("table").trigger("changeColumns");
            }
            $("table").trigger("changeColumns");
        }
  </script>
@stop

@section('titulo_contenido')
  Administrar Videos
@stop

@section('migas')
  <li><a href="/videoInicio" class="brandActive">Videos de Inicio</a></li>
  <li class="fa fa-angle-right separatorBrand"></li>
@stop

@section('panel_opcion')
   <!-- Modal para reproduccion de video -->
    <div class="modal fade" id="modalVideo" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true" data-backdrop="static" data-keyboard="false">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true" id="btnclvid">&times;</button>
            <h4 class="modal-title" id="titvid">¡Video explicativo!</h4>
          </div>
          <div class="modal-body">
            <iframe width="100%" height="350" src="" frameborder="0" allowfullscreen  id="ifr-video"></iframe>
          </div>
          <div class="modal-footer"></div>
        </div>
      </div>
    </div>
    
  <div id="zonaData">
    <div id="toolbar" class="btn-group">
      <button type='button' disabled  class='btn btn-default playSelected' id='btnSave'><i class='fa fa-save'></i>&nbsp;
         Guardar cambios
      </button>
    </div>

    <div class='col-md-12'>
      <table id="tabla-videos" class="table table-stripped table-responsive"
        data-toolbar="#toolbar"
        data-click-to-select="true"
        data-select-item-name="checkboxSelect"
        data-minimum-count-columns='2'
        data-page-list="[10, 25, 50, 100, Todo]">
        <thead id="tabla-head-videos">
          <tr>
            <th data-field="cont">No</th>
            <th data-field='grado'>Grado</th>
            <th data-field='inteligencia'>Inteligencia</th>
            <th data-field='bloque'>Bloque</th>
            <th data-field='tema'>Tema</th>
            <th data-field='actividad'>Actividad</th>
            <th data-field='embedSelected'>Video</th>
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
