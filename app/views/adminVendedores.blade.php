@extends('admin_base')

@section('title')
  Admin. Vendedores
@stop

@section('mi_css')
  {{ HTML::style('/packages/css/libs/bootstrap_table/bootstrap-table.css') }}
  {{ HTML::style('/packages/css/curiosity/vendedores.css') }}
@stop

@section('titulo_contenido')
  Administrar Vendedores
@stop

@section('migas')
  <li><a href="/lista-vendedores" class="brandActive">Vendedores</a></li>
  <li class="fa fa-angle-right separatorBrand"></li>
@stop

@section('panel_opcion')
  <section class="" id="tablaInicialV">
    <div id="zonaDataV">
      <div id="toolbarV" class="btn-group">
        <button type="button" class="btn btn-default tooltipShow" id="registrarV" title="Registrar nuevo vendedor">
            <i class="fa fa-plus"></i>
        </button>
        <button type="button" class="btn btn-default tooltipShow" id="actualizarV" title="Modificar vendedor seleccionado">
            <i class="fa fa-refresh"></i>
        </button>
        <button type="button" class="btn btn-default tooltipShow" id="eliminarV" title="Eliminar vendedor seleccionado">
            <i class="fa fa-trash"></i>
        </button>
      </div>

      <div class='col-md-12'>
        <table id="tabla-vendedores" class="table table-stripped table-responsive"
          data-pagination="true"
          data-search="true"
          data-show-toggle="true"
          data-show-columns="true"
          data-toolbar="#toolbar"
          data-click-to-select="true"
          data-select-item-name="radioSelect"
          data-minimum-count-columns='2'
          data-page-list="[10, 25, 50, 100, Todo]">
          <thead id="tabla-head-vendedores">
            <tr>
              <th data-field="state" data-radio="true"></th>
              <th data-field='nombre'>Nombre de vendedor</th>
              <th data-field='email'>E-Mail</th>
              <th data-field='tel'>Teléfono</th>
              <th data-field='codigo'>Código de ventas</th>
            </tr>
          </thead>
        </table>
      </div>
    </div>
  </section>

  <section class="col-xs-12" id="gestionDatosV">
    <h4>Información del vendedor</h4>
    <div class="col-xs-12 col-md-10">
      <form action="" id="formV">

        <div class="form-group">
          <div class="input-group inputGroupV">
            <span class="input-group-addon estiloSpanV"><span class="fa fa-user"></span></span>
            <input type="text" class="form-control" placeholder="Nombre" name="nombreV" id="nombreV">
          </div>
        </div>
        <div class="form-group">
          <div class="input-group inputGroupV">
            <span class="input-group-addon estiloSpanV"><span class="fa fa-user"></span></span>
            <input type="text" class="form-control" placeholder="Apellidos" name="appellidosV" id="appellidosV">
          </div>
        </div>
        <div class="form-group">
          <div class="input-group inputGroupV">
            <span class="input-group-addon estiloSpanV"><span class="fa fa-user"></span></span>
            <input type="email" class="form-control" placeholder="Correo Electrónico" name="correoV" id="correoV">
          </div>
        </div>
        <div class="form-group">
          <div class="input-group inputGroupV">
            <span class="input-group-addon estiloSpanV"><span class="fa fa-user"></span></span>
            <input type="text" class="form-control" placeholder="Teléfono" name="telV" id="telV">
          </div>
        </div>
        <div class="form-group">
          <div class="input-group inputGroupV">
            <span class="input-group-addon estiloSpanV"><span class="fa fa-user"></span></span>
            <select name="sexoV" id="sexoV" class="form-control">
              <option value="">Selecciona el sexo</option>
              <option value="m">Masculino</option>
              <option value="f">Femenino</option>
            </select>
          </div>
        </div>
        <div class="form-group">
          <div class="input-group inputGroupV">
            <span class="input-group-addon estiloSpanV"><span class="fa fa-user"></span></span>
            <select class="form-control" name="estadoV" id="estadoV">
              <option value="">Selecciona el estado donde vive</option>
            </select>
          </div>
        </div>
        <div class="form-group">
          <div class="input-group inputGroupV">
            <span class="input-group-addon estiloSpanV"><span class="fa fa-user"></span></span>
            <select class="form-control" name="ciudadV" id="ciudadV">
              <option value="">Selecciona un estado para seleccionar una ciudad</option>
            </select>
          </div>
        </div>

      </form>
      <div class="text-right">
        <button class="btn btn-default" id="btnCancelarV">
          <span class="fa fa-user"></span>&nbsp;
          Cancelar
        </button>
        <button class="btn btn-default" id="btnGuardarV">
          <span class="fa fa-user"></span>&nbsp;
          Guardar
        </button>
      </div>
    </div>
    <div class="col-md-2 hidden-xs hidden-sm">
      <center>
        <form action="" id="formImagenV"><input type="file" id="imagenV" name="imagenV"></form>
        <img src="" id="imgV" class="img-responsive img-thumbnail"><br>
        <button class="btn btn-default" id="btnImgV">
          Cambiar Imagen
        </button>
      </center>
    </div>
  </section>
@stop

@section('mi_js')
  {{HTML::script('/packages/js/libs/bootstrap-select-1.11.2/js/bootstrap-select.js')}}
  {{HTML::script('/packages/js/libs/bootstrap_table/bootstrap-table.js')}}
  {{HTML::script('/packages/js/libs/bootstrap_table/locale/bootstrap-table-es-MX.js')}}
  {{HTML::script('/packages/js/curiosity/vendedorAdminServicios.js')}}
  {{HTML::script('/packages/js/curiosity/vendedorAdmin.js')}}
@stop
