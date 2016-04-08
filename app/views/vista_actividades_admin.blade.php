@extends('admin_base')

@section('title')
  Admin. Actividades
@stop

@section('mi_css')
    {{HTML::style('/packages/css/curiosity/menu.css')}}
     {{HTML::style('packages/css/libs/dropzone/dropzone.css')}}
@stop

@section('titulo_contenido')
  Administrar Actividades
@stop

@section('migas')
  <li><a href="/adminNivel">Grados Escolares</a></li>
  <li class="fa fa-angle-right separatorBrand"></li>
  <li><a href="/adminInteligencia{{$obj_nivel[0]->id}}">{{$obj_nivel[0]->nombre}}</a></li>
  <li class="fa fa-angle-right separatorBrand"></li>
  <li><a href="/adminBloque{{$obj_inteligencia[0]->id}}_{{$obj_nivel[0]->id}}" class="brandActive">{{$obj_inteligencia[0]->nombre}}</a></li>
  <li class="fa fa-angle-right separatorBrand"></li>
  <li><a href="/adminTema{{$obj_bloque[0]->id}}_{{$obj_inteligencia[0]->id}}_{{$obj_nivel[0]->id}}" class="brandActive">{{$obj_bloque[0]->nombre}}</a></li>
  <li class="fa fa-angle-right separatorBrand"></li>
  <li><a href="/adminActividad{{$obj_tema[0]->id}}_{{$obj_bloque[0]->id}}_{{$obj_inteligencia[0]->id}}_{{$obj_nivel[0]->id}}" class="brandActive">{{$obj_tema[0]->nombre}}</a></li>
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
<div id="actividades">
@foreach($obj_actividades as $actividad)
  <div class='col-md-4 activity objeto' data-object="activity" data-id = {{ $actividad->id }} data-id-remove = {{$actividad->id}}>
    <div class='box box-widget widget-title'>
      <div class="widget-title-header {{ $actividad->bg_color }}">
        <h3 class='widget-title-set text-center' data-descrip='{{$actividad->objetivo}}' data-estatus='{{$actividad->estatus}}' id={{$actividad->id}}>{{$actividad->nombre}}</h3>
        <h5 class='widget-title-desc'></h5>
      </div>
      <div class='widget-title-image'>
        <img class='img-circle img-effect tooltipShow' title="Cambiar imagen" src='/packages/images/actividades/{{$actividad->imagen}}' data-id-img={{$actividad->id}}>
      </div>
      <div class='box-footer'>
        <div class='row'>
          <div class='col-xs-4 border-right'>
            <div class='description-block btnUpdate'
              data-id = {{ $actividad->id }}
              data-id-video={{$actividad->video_id}}
              data-code-embed='{{$actividad->code_embed}}'
              data-pdf='{{$actividad->pdf}}'
              data-prof-id={{$actividad->profesores_id}}>
              <span class='fa fa-refresh fa-3x' title="Actualizar" ></span>
              <br>
              <span class='description-text'>ACTUALIZAR<br></span>
            </div>
          </div>
          <div class='col-xs-4 border-right'>
            <div class='description-block btnRemove' data-id = {{ $actividad->id }}>
              <span class='fa fa-remove fa-3x' title="Eliminar"></span>
              <br>
              <span class='description-text'>Eliminar</span>
            </div>
          </div>
          <div class='col-xs-4'>
            <div class='description-block btnIn' id="entrar-juego"
              data-id-actividad={{$actividad->id}}
              data-id-tema={{$obj_tema[0]['id']}}
              data-id-nivel={{$obj_nivel[0]['id']}}
              data-id-inteligencia={{$obj_inteligencia[0]->id}}
              data-id-bloque={{$obj_bloque[0]->id}}>
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
</div>

<!-- Sección de Administración -->
  <div class="col-md-12" id="adminSection" hidden="hidden">
    <form  method="POST" class="form-horizontal" id="formulario">
      <div class="form-group">
        <label for="nombre">Nombre</label>
        <input type="text" class="form-control" id="nombre" name="nombre">
      </div>
      <div class="form-group">
        <label for="descripcion">Objetivo</label>
        <textarea name="descripcion" class="form-control" id="descripcion" rows="5"></textarea>
      </div>
      <div class="form-group">
        <label for="video">Video (EMBED CODE)</label>
        <textarea name="video" class="form-control" id="video" rows="3"></textarea>
      </div>
      <div class="form-group">
        <label for="video">Profesor Encargado</label>
        <select name="profesores" id="profesores" class="form-control">
          <option value=""></option>
          @foreach($obj_profesores as $profesor)
            <option value={{$profesor['id']}}>{{$profesor['nombre']}} {{$profesor['apellido_paterno']}} {{$profesor['apellido_materno']}}</option>
          @endforeach
        </select>
      </div>
      <div class="form-group" hidden="hidden" id="botonEstatus">
        <label>Click para bloquear/desbloquear</label><br>
        <i class="fa fa-lock fa-4x" id="btnLock"></i>
      </div>
    </form>
    <h5><b>Seleccionar PDF</b></h5>
    <form id="formPDF" class="form-horizontal">
      <input type="file" class="form-control" id="archivoPDF" name="archivoPDF">
    </form>
    <br>
    <div class="form-group text-right">
      <button type="button" class="btn btn-warning" id="cancelarEnv">
        <i class="fa fa-remove"></i>
        Cancelar
      </button>
      <button type="button" class="btn btn-primary"
        data-nivel={{$obj_nivel[0]['id']}}
        data-inteligencia={{$obj_inteligencia[0]['id']}} id="enviarEnv"
        data-bloque={{$obj_bloque[0]['id']}}
        data-tema={{$obj_tema[0]['id']}}>
        <i class="fa fa-check"></i>
        Guardar
      </button>
    </div>
  </div>

  <!------Menu desplegable para subir juegos -->
  <div id="menu" class="menu hide">
        <ul class="menu-ul">
            <li class="menu-ul-li" id="asignar_juego"><i class="fa fa-gamepad fa-2x"></i> Asignar juego</li>
            <li class="menu-ul-li" id="mover_juego"><i class="fa fa-arrows fa-2x"></i> Mover juego</li>
            <li class="menu-ul-li" id="eliminar_juego"><i class="fa fa-trash fa-2x"></i> Eliminar juego</li>
        </ul>
  </div>

  <!-- Modal -->
    <div class="modal fade" id="subir_juego" data-id-actividad="" tabindex="-1" role="dialog" aria-labelledby="" data-backdrop="static" data-keyboard="false">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" id="close_modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Registro de Juegos</h4>
          </div>
          <div class="modal-body">
            <div class='col-md-12'>
                            {{Form::open(array(
                                                    'files'=>true,
                                                    'class'=>'dropzone',
                                                    'method'=>'POST',
                                                    'id'=>'my-dropzone',
                                                    'style'=>'border-radius:5px; background-image:url(/packages/images/fondos/fondo.jpg);'
                            ))}}

                                <button id="subirJuego" class="btn btn-primary" type="button" style="margin-left:300px;"><i class="fa fa-upload"></i> Subir Archivo</button>
                                <button id="removeFile" class="btn btn-danger" type="button" disabled="true" style="margin-left:300px;"><i class="fa fa-times"></i> Quitar Archivo</button>
                                <div class="fallback">
                                    <input type="file" class="fallback"  accept="application/zip" name="juego_zip" id="juego_zip">

                                </div>
                                <div class="dz-message" style="width:400px; height:200px; border-style:dashed; border-color:#ffffff;"> Suelta tus archivos aqui..</div>
                                      <h4>Total de archivos cargados: <b id="toload">0</b></h4>
                                      <h4 id="progress"></h4><h4 id="bytesSent"></h4>
                                 <div class="dropzone-previews"></div>
                            {{Form::close()}}
                    <!--<section class="form-group dropzones">
                        <label>Subir Juego</label>
                        <form action="/subirZIP" enctype="multipart/form-data" id="frm_subir_juego">
                            <input type="file" class="fallback"  accept="application/x-zip-compressed" name="juego_zip" id="juego_zip">
                        </form>
                    </section>--->
                    <h3 class="hide text-center" id="archivosUpload">Archivos que se subieron</h3>
                    <div id="archivos" class="col-md-12">

                    </div>
            </div>
         </div>
          <div class="modal-footer">
          </div>
        </div>
      </div>
    </div>

@stop

@section('mi_js')
  {{HTML::script('/packages/js/curiosity/actividadesAdmin.js')}}
  {{HTML::script('packages/js/libs/dropzone/dropzone.js')}}
@stop
