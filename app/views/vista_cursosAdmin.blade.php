@extends('admin_base')

@section('title')
  gestión cursos
@stop

@section('mi_css')
	{{HTML::style('packages/css/curiosity/cursos.css')}}

@stop
@section('titulo_contenido')
  Gestión de Cursos
@stop


@section('titulo_small')
@stop

@section('panel_opcion')

<div class='col-md-4'>
  <div class='box box-widget widget-user biblioteca'>
    <div class='widget-user-header bg-green'>
      <h3 class='widget-user-username text-center'>Primer Grado</h3>
      <h5 class='widget-user-desc'></h5>
    </div>
    <div class='widget-user-image'>
      <img class='img-circle' src='/packages/images/avatars/avt-cu-default.png'>
    </div>
    <div class='box-footer'>
      <div class='row'>
        <div class='col-xs-4 border-right'>
          <div class='description-block'>
            <span class='fa fa-refresh fa-3x' title="actualizar este curso" ></span>
            <br>
            <span class='description-text'>ACTUALIZAR<br></span>
          </div>
        </div>
        <div class='col-xs-4 border-right'>
          <div class='description-block'>
            <span class='fa fa-remove fa-3x' title="eliminar este curso"></span>
            <br>
            <span class='description-text' >Eliminar</span>
          </div>
        </div>
        <div class='col-xs-4'>
          <div class='description-block'>
            <span class='fa fa-arrow-right fa-3x'></span>
            <br>
            <span class='description-text'>Ingresar</span>
          </div>
        </div>
      </div>
    </div>
  </div>
</div><!-- primer grado-->

<div class='col-md-4'>
  <div class='box box-widget widget-user biblioteca'>
    <div class='widget-user-header bg-red'>
      <h3 class='widget-user-username text-center'>Segundo Grado</h3>
      <h5 class='widget-user-desc'></h5>
    </div>
    <div class='widget-user-image'>
      <img class='img-circle' src='/packages/images/avatars/avt-cu-default.png'>
    </div>
    <div class='box-footer'>
      <div class='row'>
        <div class='col-xs-4 border-right'>
          <div class='description-block'>
            <span class='fa fa-refresh fa-3x' title="actualizar este curso"></span>
            <br>
            <span class='description-text'>ACTUALIZAR</span>
          </div>
        </div>
        <div class='col-xs-4 border-right'>
          <div class='description-block'>
            <span class='fa fa-remove fa-3x' title="eliminar este curso"></span>
            <br>
            <span class='description-text' >Eliminar</span>
          </div>
        </div>
        <div class='col-xs-4'>
          <div class='description-block'>
            <span class='fa fa-arrow-right fa-3x'></span>
            <br>
            <span class='description-text'>Ingresar</span>
          </div>
        </div>
      </div>
    </div>
  </div>
</div><!--segundo grado-->

<div class='col-md-4'>
  <a href="javascript:void()">
  <div class='box box-widget widget-user biblioteca'>
    <div class='widget-user-header bg-teal-active'>
      <h3 class='widget-user-username text-center'>Tercer Grado</h3>
      <h5 class='widget-user-desc'></h5>
    </div>
    <div class='widget-user-image'>
      <img class='img-circle' src='/packages/images/avatars/avt-cu-default.png'>
    </div>
    <div class='box-footer'>
      <div class='row'>
        <div class='col-xs-4 border-right'>
          <div class='description-block'>
            <span class='fa fa-refresh fa-3x' title="actualizar este curso"></span>
            <br>
            <span class='description-text'>ACTUALIZAR</span>
          </div>
        </div>
        <div class='col-xs-4 border-right'>
          <div class='description-block'>
            <span class='fa fa-remove fa-3x' title="eliminar este curso"></span>
            <br>
            <span class='description-text' >Eliminar</span>
          </div>
        </div>
        <div class='col-xs-4'>
          <div class='description-block'>
            <span class='fa fa-arrow-right fa-3x'></span>
            <br>
            <span class='description-text'>Ingresar</span>
          </div>
        </div>
      </div>
    </div>
  </div>
  </a>
</div>

<div class='col-md-4'>
  <div class='box box-widget widget-user biblioteca'>
    <div class='widget-user-header bg-purple'>
      <h3 class='widget-user-username text-center'>Cuarto Grado</h3>
      <h5 class='widget-user-desc'></h5>
    </div>
    <div class='widget-user-image'>
      <img class='img-circle' src='/packages/images/avatars/avt-cu-default.png'>
    </div>
    <div class='box-footer'>
      <div class='row'>
        <div class='col-xs-4 border-right'>
          <div class='description-block'>
            <span class='fa fa-refresh fa-3x' title="actualizar este curso"></span>
            <br>
            <span class='description-text'>ACTUALIZAR</span>
          </div>
        </div>
        <div class='col-xs-4 border-right'>
          <div class='description-block'>
            <span class='fa fa-remove fa-3x' title="eliminar este curso"></span>
            <br>
            <span class='description-text' >Eliminar</span>
          </div>
        </div>
        <div class='col-xs-4'>
          <div class='description-block'>
            <span class='fa fa-arrow-right fa-3x'></span>
            <br>
            <span class='description-text'>Ingresar</span>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<input type="file" class="hidden" id="up-image" accept="image/jpeg,image/png">
<div class='col-md-4'>
  <div class='box box-widget widget-user biblioteca'>
    <div class='widget-user-header bg-yellow-active'>
      <h3 class='widget-user-username text-center'>Quinto Grado</h3>
      <h5 class='widget-user-desc'></h5>
    </div>
    <div class='widget-user-image'>
      <img class='img-circle' src='/packages/images/avatars/avt-cu-default.png'>
    </div>
    <div class='box-footer'>
      <div class='row'>
        <div class='col-xs-4 border-right'>
          <div class='description-block'>
            <span class='fa fa-refresh fa-3x' title="actualizar este curso"></span>
            <br>
            <span class='description-text'>ACTUALIZAR</span>
          </div>
        </div>
        <div class='col-xs-4 border-right'>
          <div class='description-block'>
            <span class='fa fa-remove fa-3x' title="eliminar este curso"></span>
            <br>
            <span class='description-text' >Eliminar</span>
          </div>
        </div>
        <div class='col-xs-4'>
          <div class='description-block'>
            <span class='fa fa-arrow-right fa-3x'></span>
            <br>
            <span class='description-text'>Ingresar</span>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class='col-md-4'>
  <div class='box box-widget widget-user biblioteca'>
    <div class='widget-user-header bg-maroon'>
      <h3 class='widget-user-username text-center'>Sexto Grado</h3>
      <h5 class='widget-user-desc'></h5>
    </div>
    <div class='widget-user-image'>
      <img class='img-circle' src='/packages/images/avatars/avt-cu-default.png'>
    </div>
    <div class='box-footer'>
      <div class='row'>
        <div class='col-xs-4 border-right'>
          <div class='description-block'>
            <span class='fa fa-refresh fa-3x' title="actualizar este curso"></span>
            <br>
            <span class='description-text'>ACTUALIZAR</span>
          </div>
        </div>
        <div class='col-xs-4 border-right'>
          <div class='description-block'>
            <span class='fa fa-remove fa-3x' title="eliminar este curso"></span>
            <br>
            <span class='description-text' >Eliminar</span>
          </div>
        </div>
        <div class='col-xs-4'>
          <div class='description-block'>
            <span class='fa fa-arrow-right fa-3x'></span>
            <br>
            <span class='description-text'>Ingresar</span>
          </div>
        </div>
      </div>
    </div>
  </div>

@stop


@section('mi_js')
  {{HTML::script('packages/js/curiosity/cursos.js')}}
@stop
