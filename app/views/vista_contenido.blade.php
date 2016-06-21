@extends('admin_base')

@section('title')
  Contenido
@stop

@section('mi_css')
@stop

@section('titulo_contenido')
@stop

@section('migas')
@stop

@section('panel_opcion')
@foreach($inteligencias as $intel)
<div class='col-md-4 objeto'>
  <div class='box box-widget widget-title objetoPointer' data-estatus='{{$intel->estatus}}' data-id='{{$intel->id}}' data-roletype='inteligencia'>
    <div class='widget-title-header' style='background-color: {{$intel->bg_color}}'>
      <h3 class='widget-title-set text-center'> {{$intel->nombre}} </h3>
      <h5 class='widget-title-desc'></h5>
    </div>
    @if($intel->estatus == 'lock')
      <div class='butonEstatus text-center' style='background-color: {{$intel->bg_color}}'>
        <span class='fa fa-clock-o fa-estatus-color'></span>&nbsp;
        Próximamente
      </div>
    @endif
    <div class='widget-title-image'>
      <img class='img-circle' src='/packages/images/niveles/{{$intel->imagen}}'>
    </div>
    <div class='box-footer'>
      <div class='row'>
        <div class='col-xs-4 border-right'>
          <div class='description-block'>
          </div>
        </div>
        <div class='col-xs-4 border-right'>
          @if($intel->estatus != 'lock')
            <div class='description-block'>
              <span class='fa fa-star fa-star-color fa-4x tooltipShow' title=''></span>
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
  <script type='text/javascript'>
    $(document).ready(function() {

      var $contenido = {
        estructura : function(roleType, id, nombre, estatus, imagen, color, descripcion){
          var lock = "<div class='col-md-4 objeto'>"+
            "<div class='box box-widget widget-title objetoPointer' data-estatus='"+estatus+"' data-id='"+id+"' data-roletype='"+roleType+"'>"+
              "<div class='widget-title-header' style='background-color: "+color+"'>"+
                "<h3 class='widget-title-set text-center'> "+nombre+" </h3>"+
                "<h5 class='widget-title-desc'></h5>"+
              "</div>"+
                "<div class='butonEstatus text-center' style='background-color: "+color+"'>"+
                  "<span class='fa fa-clock-o fa-estatus-color'></span>&nbsp;"+
                  "Próximamente"+
                "</div>"+
              "<div class='widget-title-image'>"+
                "<img class='img-circle' src='/packages/images/niveles/"+imagen+"'>"+
              "</div>"+
              "<div class='box-footer'>"+
                "<div class='row'>"+
                  "<div class='col-xs-4 border-right'>"+
                    "<div class='description-block'>"+
                    "</div>"+
                  "</div>"+
                  "<div class='col-xs-4 border-right'>"+
                  "</div>"+
                  "<div class='col-xs-4'>"+
                    "<div class='description-block btnIn'>"
                    "</div>"+
                  "</div>"+
                "</div>"+
              "</div>"+
            "</div>"+
          "</div>";
          var unlock = "<div class='col-md-4 objeto hidden'>"+
            "<div class='box box-widget widget-title objetoPointer' data-estatus='"+estatus+"' data-id='"+id+"' data-roletype='"+roleType+"'>"+
              "<div class='widget-title-header' style='background-color: "+color+"'>"+
                "<h3 class='widget-title-set text-center'> "+nombre+" </h3>"+
                "<h5 class='widget-title-desc'></h5>"+
              "</div>"+
              "<div class='widget-title-image'>"+
                "<img class='img-circle' src='/packages/images/niveles/"+imagen+"'>"+
              "</div>"+
              "<div class='box-footer'>"+
                "<div class='row'>"+
                  "<div class='col-xs-4 border-right'>"+
                    "<div class='description-block'>"+
                    "</div>"+
                  "</div>"+
                  "<div class='col-xs-4 border-right'>"+
                    "<div class='description-block'>"+
                      "<span class='fa fa-star fa-star-color fa-4x tooltipShow' title='"+descripcion+"'></span>"+
                    "</div>"+
                  "</div>"+
                  "<div class='col-xs-4'>"+
                    "<div class='description-block btnIn'>"
                    "</div>"+
                  "</div>"+
                "</div>"+
              "</div>"+
            "</div>"+
          "</div>";
          if(estatus == "lock"){
            return lock;
          }
          else{
            return unlock;
          }
        },
        putElement : function(html){
          $("#make-all").append(html);
        }
      }

      $('#make-all').on('click', '.objeto > .objetoPointer', function() {
        var $este = $(this);
        var roleType = $este.data('roletype');
        if($este.data('estatus') == 'unlock'){
          if(roleType != 'bloque'){
            $('.objeto').fadeOut('fast', function(){
              $(this).remove();
            });
            var elemento = $contenido.estructura('bloque', '1', 'bloque 1', 'lock', 'default.png', 'red');
            $contenido.putElement(elemento);
          }
          else{
            alert("este es un bloque");
          }
        }
        else{
          $curiosity.noty('Disponible próximamente', 'warning');
        }
      });
    });
  </script>
@stop
