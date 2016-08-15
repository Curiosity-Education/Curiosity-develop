@extends('admin_base')

@section('title')
  Admin. Avatar
@stop

@section('mi_css')
  {{HTML::style('packages/css/libs/dropzone/dropzone.css')}}
  {{HTML::style('/packages/css/curiosity/gestionAvatar.css')}}
@stop

@section('titulo_contenido')
  Administrar Avatar
@stop

@section('migas')
@stop

@section('panel_opcion')
<!-- Botonera de gestion -->
<div class='row botoneraAvatar'>
  <div class='col-xs-12 text-right'>
    <button type='button' class='btn btn-default btn-lg btn-gestion-avatar tooltipShow' title="Regresar" style='background-color:#ed6922; color:white;' id='back'>
      <span class='fa fa-reply'></span>
    </button>
    <button type='button' class='btn btn-default btn-lg btn-gestion-avatar tooltipShow' title="Registrar avatar" style='background-color:#2d96ba; color:white;' id='addNew'>
      <span class='fa fa-user-plus'></span>
    </button>
    <button type='button' class='btn btn-default btn-lg btn-gestion-avatar tooltipShow' title="Registrar nuevo estilo" style='background-color:#2d96ba; color:white;' id='newEstilo'>
      <span class='fa fa-plus'></span>
    </button>
    <button type='button' class='btn btn-default btn-lg btn-gestion-avatar tooltipShow' title="Registrar nueva secuencia" style='background-color:#2d96ba; color:white;' id='newSecuencia'>
      <span class='fa fa-plus'></span>
    </button>
    <button type='button' class='btn btn-default btn-lg btn-gestion-avatar tooltipShow' title="Secuencias (acciones)" style='background-color:#2d96ba; color:white;' id='addSecuencias'>
      <span class='fa fa-male'></span>
    </button>
    <button type='button' class='btn btn-default btn-lg btn-gestion-avatar tooltipShow' title="Estilos del avatar" style='background-color:#3cb54a; color:white;' id='addEstilos'>
      <span class='fa fa-paint-brush'></span>
    </button>
  </div>
</div>

<div class='row'>
  <div id='viewSection'>
    <!-- Avatars -->
    @foreach ($avatars as $avatar)
    <div class='col-xs-6 col-sm-4 col-md-3'>
      <div class='avatarFace' style='background:url(/packages/images/avatars_curiosity/estilos/{{$avatar->preview}});background-position: center;background-repeat: no-repeat;background-size: cover;'>
        <div class="botonesAvatarFace">
          <button type='button' class='btn btn-info btn-fab tooltipShow gestionarAv' title='Gestionar' data-dat='{{$avatar}}'>
            <span class='fa fa-gears'></span>
          </button>
          <button type='button' class='btn btn-danger btn-fab tooltipShow eliminarAv' title='Eliminar' data-dat='{{$avatar}}'>
            <span class='fa fa-times'></span>
          </button>
        </div>
      </div>
    </div>
    @endforeach
  </div>
</div>

<div class="row"><div id="viewEstilos"></div></div>
<div class="row"><div id="viewSecuencias"></div></div>


<!-- Gestión de nuevo avatar -->
<section class='container-fluid'>
  <div class='row seccionAdmin' id='avatar'>
    <div class='form-group'>
      <label for='nombreAvatar'>Nombre del avatar</label>
      <input type='text' class='form-control' id='nombreAvatar' name='nombreAvatar'>
    </div>
    <div class='form-group'>
      <label for='sexoAvatar'>Sexo del avatar</label>
      <select class='form-control' name='sexoAvatar' id='sexoAvatar'>
        <option value='m'>Masculino</option>
        <option value='f'>Femenino</option>
      </select>
    </div>
    <div class='form-group'>
      <label for='historiaAvatar'>Historia del avatar</label>
      <textarea name='historiaAvatar' id='historiaAvatar' cols='30' rows='10' class='form-control'></textarea>
    </div>
    <div class='form-group'>
      <label for='prevAvatar'>Imagen previa para default</label>
      <form id='formImgPrev'>
        <input type='file' class='form-control' id='prevAvatar' name='prevAvatar'>
      </form>
      <div class='btnUploadImg'><span class='fa fa-file-image-o fa-3x'></span><br><br>click para seleccionar</div>
    </div>
    <div class='form-group text-right'>
      <button class='btn btn-success' id='guardarAvatar'>
        <span class='fa fa-upload'></span>&nbsp;
        Guardar
      </button>
    </div>
  </div>
</section>
<!-- Gestion de estilos -->
<section class='container-fluid'>
  <div class='row seccionAdmin' id='estilos'>
    <div class="formRegEstilo">
      <div class='form-group'>
        <label for='nombreEstilo'>Nombre del estilo</label>
        <input type='text' class='form-control' id='nombreEstilo' name='nombreEstilo'>
      </div>
      <div class='form-group'>
        <label for='valorEstilo'>Valor de adquicisión</label>
        <input type='text' class='form-control' id='valorEstilo' name='valorEstilo'>
      </div>
      <div class='form-group'>
        <label for='descripcionEstilo'>Descripción del estilo</label>
        <textarea name='descripcionEstilo' id='descripcionEstilo' cols='30' rows='10' class='form-control'></textarea>
      </div>
      <div class='form-group'>
        <label for='prevAvatar'>Imagen previa de estilo</label>
        <div class='btnUploadImg'><span class='fa fa-file-image-o fa-3x'></span><br><br>click para seleccionar</div>
      </div>
      <div class='form-group text-right'>
        <button class='btn btn-success' id='guardarEstilo'>
          <span class='fa fa-upload'></span>&nbsp;
          Guardar Estilo
        </button>
      </div>
    </div>
  </div>
</section>
<!-- Gestion de secuencias -->
<section class='container-fluid'>
  <div class='row seccionAdmin' id='secuencias'>
    <div class="formRegSecuencia">
      <div class='form-group'>
        <label for='tipoSecuencia'>Tipo de secuencia</label>
        <select class="form-control" name="tipoSecuencia" id="tipoSecuencia">
          <option value=''></option>
          @foreach($tipos as $tipo)
            <option value='{{$tipo->id}}'>{{$tipo->nombre}}</option>
          @endforeach
        </select>
      </div>
      <div class='form-group'>
        <form id="filesecuenceForm">
          <input type="file" id="filesecuence" name="filesecuence">
        </form>
        <!-- <label for='filesecuence'>Imagen previa de secuencia</label> -->
        <div class="btnUploadSec" id="dropper">
          Da click aquí para seleccionar tu archivo .zip
        </div>
        <!-- <label for='prevAvatar'>Imagen previa de secuencia</label> -->
        <!-- <div class='btnUploadImg'><span class='fa fa-file-image-o fa-3x'></span><br><br>click para seleccionar</div> -->
      </div>
      {{--<div class="col-md-12">
        <div class="zonedrop">
          {{Form::open(array(
            'files'=>true,
            'class'=>'dropzone',
            'method'=>'POST',
            'id'=>'my-dropzone'
          ))}}
            <!-- <button id="subirJuego" class="btn btn-primary" type="button" style="margin-left:300px;">
              <i class="fa fa-upload"></i>&nbsp;
              Subir Archivo
            </button>
            <button id="removeFile" class="btn btn-danger" type="button" disabled="true" style="margin-left:300px;">
              <i class="fa fa-times"></i>&nbsp;
              Quitar Archivo
            </button> -->
            <div class="fallback">
              <input type="file" class="fallback"  accept="application/zip" name="juego_zip" id="juego_zip">
            </div>
            <div class="dz-message" id="dropper">
              Suelta tus archivos aqui..
            </div>
            <h4 class="infouploadedfiles">Total de archivos cargados: <b id="toload">0</b></h4>
            <h4 id="progress"></h4><h4 id="bytesSent"></h4>
            <div class="dropzone-previews"></div>
          {{Form::close()}}
          <h3 class="hide text-center" id="archivosUpload">Archivos que se subieron</h3>
          <div id="archivos" class="col-md-12"></div>
        </div>
      </div>--}}
      <div class='form-group text-right'>
        <button class='btn btn-success' id='guardarSecuencia'>
          <span class='fa fa-upload'></span>&nbsp;
          Guardar Secuencia
        </button>
      </div>
    </div>
  </div>
</section>



@stop

@section('mi_js')
  {{HTML::script('packages/js/libs/dropzone/dropzone.js')}}
  {{HTML::script('/packages/js/curiosity/avatar_estrucs.js')}}
  {{HTML::script('/packages/js/curiosity/avatar.js')}}
  {{HTML::script('/packages/js/curiosity/gestionAvatar.js')}}
@stop
