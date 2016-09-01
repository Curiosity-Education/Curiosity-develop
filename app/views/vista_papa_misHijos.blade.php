@extends('admin_base')
@section('mi_css')
 {{HTML::style('/packages/css/curiosity/helper.css')}}
 {{HTML::style('/packages/css/curiosity/caledarFlat.css')}}
 {{HTML::style('/packages/css/curiosity/mishijos.css')}}
@stop

@section('title')
	Mis Hijos
@stop


@section('titulo_contenido')
	Mis Hijos
@stop

@section('titulo_small')
<div class='row'>
	<div class='col-md-10 col-xs-12 col-sm-10'>
    <button class='btn tooltipShowRight' type='button' style='background-color:#2d96ba; color:white;' id='showHelp'>
		  <i class='fa fa-info-circle'></i>
    </button>
    <div class="modal fade" id="helper" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true" data-keyboard="false">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-body">
            <button type="button" class="close" data-dismiss="modal" id="closehelp" aria-hidden="true">&times;</button>
            <center>
              <span class="fa fa-info-circle" id="iconhelp"></span>
              <br><br>
              <h4 id="tituloHelp">Mis hijos</h4>
              <br>
            </center>
            <div id="cuerpoHelp">
              <p class="text-justify">
                En esta sección se encuentra tus hijos registrados y su progreso en el día. <br>
                <b>Recuerda</b><br>
                Puedes acceder a las estadísticas dando click en la imagen de tu hijo desde tu perfil.
                <br>
                <!-- <small><i><b>Nota: </b> Las estadísticas se generan con las actividades de tus hijos.</i></small> -->
              </p>
              <br>
              <ul>
                <li>
                  <b>Registra a tus hijos</b>
                  <br>
                  Podrás registrar a tus hijos dando click al botón "Registrar hijo/hija" ubicado en la parte superior derecha.
                  <br>
                  <small><i><b>Nota: </b>Si cuentas con una cuenta gratuita únicamente es posible registrar un máximo de 1 (uno) hijo.</i></small>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
	</div>
</div>
@stop


@section('panel_opcion')
<!-- Denegar registro a padre free -->
<div class='modal fade' id='modalPremDad' tabindex='-1' role='dialog' aria-labelledby='' aria-hidden='true' data-keyboard='false'>
  <div class='modal-dialog'>
    <div class='modal-content'>
      <div class='modal-body text-center'>
        <button type='button' class='close' data-dismiss='modal' id='closePrem' aria-hidden='true'>&times;</button>
        <span class='fa fa-star' id='iconPrem'></span>
        <br><br>
        <h4 class='tituloPrem'>Curiosity Educación Premium</h4>
        <br>
        <p class='text-center bodyPrem'>
          Lo sentimos<br>
          Actualmente te encuentras registrado de manera gratuita<br>
          y de esta manera solo es posible registrar a uno de tus hijos <br><br>
          Actualmente estamos en fase Beta. En poco tiempo podras cambiar tu cuenta a premium y aprobechar de todos los beneficios de Curiosity.
        </p>
        <!-- <br>
        <button type='button' id='botonPremium' class='btn btn-primary btn-lg'>
          Notificarle a mis Padres
        </button> -->
      </div>
    </div>
  </div>
</div>

<!-- VENTANA PARA EL REGISTRO DE UN NUEVO HIJO -->
<div class='container-fluid' id="secreghijo">
  <div class='col-md-12'>
	  <h2 id='tit-regh'> Registrar hijo/a </h2>
        <div class='row'>
          <form class='form-horizontal' id='frm-reg-hijos'>
            <div>
              <section class="box-regh">
                <div class='form-group'>
                 <label for='sexo'><h4 class='title-input'><b>Nombre de tu Hijo</b></h4></label>
                  <div class='input-group'>
                    <span class='input-group-addon addonStyle'>
                      <span  class='fa fa-user'></span>
                    </span>
                    <input type='text'  name='nombre' id='nombre' value='' class='form-control form-custom-step' placeholder='Nombre del niño/a'>
                  </div>
                </div>
                <div class='form-group'>
                  <div class='input-group'>
                    <span class='input-group-addon addonStyle'>
                      <span class='fa fa-chevron-right'></span>
                    </span>
                    <input type='text' name='apellido_paterno' id='apellido_paterno' value='' class='form-control form-custom-step' placeholder='Apellido paterno'>
                  </div>
                </div>

                <div class='form-group'>
                  <div class='input-group'>
                    <span class='input-group-addon addonStyle'>
                      <span class='fa fa-chevron-right'></span>
                    </span>
                    <input type='text' name='apellido_materno' id='apellido_materno' value='' class='form-control form-custom-step' placeholder='Apellido materno'>
                  </div>
                </div>

                <div class='form-group'>
                  <div class='input-group'>
                    <span class='input-group-addon addonStyle'>
                      <span class='fa fa-calendar'></span>
                    </span>
                    <input type='text' name='fecha_nacimiento' id='fecha_nacimiento' class='form-control form-custom-step' placeholder='Fecha de nacimiento' readonly="true">
                  </div>
                </div>
                <div class='form-group'>
                    <label for='sexo'><h4 class='title-input'><b>Sexo</b></h4></label>
                    <div class='input-group'>
                      <span class='input-group-addon addonStyle'>
                        <span class='fa fa-venus-mars'></span>
                      </span>
                      <select class='form-control form-custom-step' name='sexo' id='sexo'>
                        <option value='m'>Masculino</option>
                        <option value='f'>Femenino</option>
                      </select>
                    </div>
                 </div>
           </section>
           <section class="box-regh">
             <div class='form-group'>
                <label for='grado'><h4 class='title-input'><b>Grado escolar actual</b></h4></label>
                <div class='input-group'>
                  <span class='input-group-addon addonStyle'>
                    <span class='fa fa-chevron-right'></span>
                  </span>
                  <select name='grado' id='grado' class='form-control form-custom-step'>
                    <option value='1'>Primero</option>
                    <option value='2'>Segundo</option>
                    <option value='3'>Tercero</option>
                    <option value='4'>Cuarto</option>
                    <option value='5'>Quinto</option>
                    <option value='6'>Sexto</option>
                  </select>
                </div>
             </div>
             <div class='form-group'>
                <label for='sexo'><h4 class='title-input'><b>Promedio escolar</b></h4></label>
                <div class='input-group'>
                  <span class='input-group-addon addonStyle'>
                    <span class='fa fa-chevron-right'></span>
                  </span>
                  <input type='text' name='promedio' id='promedio' value='' class='form-control form-custom-step' placeholder='Promedio de su hijo'>
                </div>
             </div>
           </section>
           <section class="box-regh">
             <h4 class='title-input' id="tit-userh"><b>Datos de Usuario de tu Hijo</b></h4>
              <div class='form-group'>
                <div class='input-group'>
                  <span class='input-group-addon addonStyle'>
                    <span  class='fa fa-user'></span>
                  </span>
                  <input type='text'  name='username_hijo' id='username_hijo' value='' class='form-control form-custom-step' placeholder='Nombre de Usuario para el niño/a'>
                </div>
              </div>

              <div class='form-group'>
                <div class='input-group'>
                  <span class='input-group-addon addonStyle'>
                    <span class='fa fa-lock'></span>
                  </span>
                  <input type='password' name='password' id='password' value='' class='form-control form-custom-step' placeholder='Contraseña'>
                </div>
              </div>

              <div class='form-group'>
                <div class='input-group'>
                  <span class='input-group-addon addonStyle'>
                    <span class='fa fa-lock'></span>
                  </span>
                  <input type='password' name='cpassword' id='cpassword' value='' class='form-control form-custom-step' placeholder='Confirmar Contraseña'>
                </div>
              </div>
		      </section>
        </div>
      </form>
      <div class="row">
        <div class="col-md-12 text-right">
          <button type="button" class="btn" id="btn-clh">
            <span class="fa fa-times"></span>&nbsp;
            Cancelar
          </button>
          <button type="button" class="btn" id="btn-svh">
            <span class="fa fa-upload"></span>&nbsp;
            Guardar Registro
          </button>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- SECCION DONDE MOSTRAMOS HIJO Y AVATAR -->
<div class='container-fluid'>
	<div class='col-xs-12' id='hijosInfo'>
    <div class="row">
      <div class="col-md-12"  id="tit-mishijos">
        <div class="col-sm-6">
          <h3 id="tit-hijos">
            <i class='fa fa-child'></i>&nbsp;
            Mis Hijos
          </h3>
        </div>
        <div class="col-md-6 text-right">
          <button class='btn' id='tabRegHijos' data-dad='{{$rol}}'>
            <span class="fa fa-plus"></span>&nbsp;
            Registrar hijo/a
          </button>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12" id="thisAppnd">
        @foreach ($datosHijos as $hijo)
      	 	<div class='col-xs-6 col-sm-4 col-md-4'>
      	 		<div class='hijo_avatar'>
      			<center>
              <img src='/packages/images/perfil/{{$hijo->foto_perfil}}' class='img-responsive img-rounded imgprfh'>
            </center>
      			<div style='margin-top: 15px;margin-bottom: 20px;margin-left: 25px;'>
              <p class='nombres'>{{$hijo->nombre}} <br> {{$hijo->apellido_paterno}} <br> {{$hijo->apellido_materno}}</p>
      				<p class='nombres' style='color:black;'>{{$hijo->username}}</p>
      			</div>
      	 		</div>
      	 	</div>
        @endforeach
      </div>
    </div>
  </div>
</div>
@stop


@section('mi_js')
{{HTML::script('/packages/js/libs/validation/jquery.validate.min.js')}}
{{HTML::script('/packages/js/libs/validation/localization/messages_es.min.js')}}
{{HTML::script('/packages/js/libs/validation/additional-methods.min.js')}}
{{HTML::script('/packages/js/curiosity/freeValidationDad.js')}}
{{HTML::script('/packages/js/curiosity/mishijos.js')}}
<script type="text/javascript" src="/packages/js/libs/mdb/tether.min.js"></script>
<script type="text/javascript" src="/packages/js/libs/mdb/mdb.min.js"></script>
@stop
