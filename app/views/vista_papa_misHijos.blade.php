@extends('admin_base')
@section('mi_css')
 {{HTML::style('/packages/css/libs/steps/jquery.steps.css')}}
 {{HTML::style('/packages/css/libs/date-picker/datepicker.min.css')}}
 {{HTML::style('/packages/css/curiosity/perfil.css')}}
 {{HTML::style('/packages/css/curiosity/helper.css')}}
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
              <h4 id="tituloHelp">Sección Mis Hijos</h4>
              <br>
            </center>
            <div id="cuerpoHelp">
              <p class="text-justify">
                Esta sección muestra a tus hijos registrados dentro de Curiosity,
                De no contar con ninguno de tus hijos registrados aún, la sección se mostrará vacía.
              </p>
              <br>
              <ul>
                <li>
                  <b>Registra a tus hijos</b>
                  <br>
                  Podrás registrar a tus hijos únicamente con pulsar el botón ubicado en la parte superior
                  derecha llamado "Registrar nuevo hijo". Una vez hecho click se despliega una ventana con
                  un pequeño formulario que deberás llenar, el cual proporciona la información necesaria para
                  completar el registro de tus hijos y así brindarles una mayor calidad de contenido.
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

<!-- VENTANA MODAL PARA EL REGISTRO DE UN NUEVO HIJO -->
<div class='row'>
  <div class=''>
  	<div class='modal fade ' id='registro_hijo' tabindex='-1' role='dialog' aria-labelledby='myModalLabel'>
	  <div class='modal-dialog modal-lg'>
		<div class='modal-content'>
		  <div class='modal-header'>
			<button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
			<center>
			  <h2 class='modal-title titulo-modal' id='myModalLabel'> Registro de un nuevo hijo </h2>
			</center>
			<center>
				<i class='fa fa-female' style='color:#65499d; font-size:2em;'></i>
				<i class='fa fa-male' style='color:#65499d; font-size:2em;'></i>
			</center>
		  </div>
		  <div class='modal-body'>
            <div class='row' style='padding-right:1%; padding-left:1%'>
              <form class='form-horizontal' id='frm-reg-hijos'>
                <div id='wizard'>
                  <h2>Datos generales</h2>
                  <section>
                    <div class='form-group'>
                     <label for='sexo'><h4 class='title-input'><b>Nombre</b></h4></label>
                      <div class='input-group'>
                        <span class='input-group-addon'>
                          <spna  class='fa fa-user'></spna>
                        </span>
                        <input type='text'  name='nombre' id='nombre' value='' class='form-control form-custom' placeholder='Nombre del niño/a'>
                      </div>
                    </div>
                    <div class='form-group'>
                      <div class='input-group'>
                        <span class='input-group-addon'>
                          <spna class='fa fa-chevron-right'></spna>
                        </span>
                        <input type='text' name='apellido_paterno' id='apellido_paterno' value='' class='form-control form-custom' placeholder='Apellido paterno'>
                      </div>
                    </div>

                    <div class='form-group'>
                      <div class='input-group'>
                        <span class='input-group-addon'>
                          <spna class='fa fa-chevron-right'></spna>
                        </span>
                        <input type='text' name='apellido_materno' id='apellido_materno' value='' class='form-control form-custom' placeholder='Apellido materno'>
                      </div>
                    </div>

                    <div class='form-group'>
                      <div class='input-group'>
                        <span class='input-group-addon'>
                          <spna class='fa fa-calendar'></spna>
                        </span>
                        <input type='text' name='fecha_nacimiento' id='fecha_nacimiento' value='' class='form-control datepicker_hijo' placeholder='Fecha de nacimiento'>
                      </div>
                    </div>
                    <div class='form-group'>
                        <label for='sexo'><h4 class='title-input'><b>Sexo</b></h4></label>
                        <div class='input-group'>
                          <span class='input-group-addon'>
                            <span class='fa fa-venus-mars'></span>
                          </span>
                          <select class='form-control form-custom' name='sexo' id='sexo'>
                            <option value='m'>Masculino</option>
                            <option value='f'>Femenino</option>
                          </select>
                        </div>
                     </div>
               </section>
               <h2>Datos escolares</h2>
               <section>
                 <div class='form-group'>
                    <label for='grado'><h4 class='title-input'><b>Grado escolar actualr</b></h4></label>
                    <div class='input-group'>
                      <span class='input-group-addon'>
                        <spna class='fa fa-chevron-right'></spna>
                      </span>
                      <select name='grado' id='grado' class='form-control'>
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
                      <span class='input-group-addon'>
                        <spna class='fa fa-chevron-right'></spna>
                      </span>
                      <input type='text' name='promedio' id='promedio' value='' class='form-control' placeholder='Promedio de su hijo'>
                    </div>
                 </div>
               </section>
               <h2>Datos de usuario</h2>
               <section>
                  <div class='form-group'>
                    <div class='input-group'>
                      <span class='input-group-addon'>
                        <spna  class='fa fa-user'></spna>
                      </span>
                      <input type='text'  name='username_hijo' id='username_hijo' value='' class='form-control form-custom' placeholder='Nombre de Usuario para el niño/a'>
                    </div>
                  </div>

                  <div class='form-group'>
                    <div class='input-group'>
                      <span class='input-group-addon'>
                        <spna class='fa fa-lock'></spna>
                      </span>
                      <input type='password' name='password' id='password' value='' class='form-control form-custom' placeholder='Contraseña'>
                    </div>
                  </div>

                  <div class='form-group'>
                    <div class='input-group'>
                      <span class='input-group-addon'>
                        <spna class='fa fa-lock'></spna>
                      </span>
                      <input type='password' name='cpassword' id='cpassword' value='' class='form-control form-custom' placeholder='Confirmar Contraseña'>
                    </div>
                  </div>
				      </section>
            </div>
          </form>
        </div>
		  </div>
		</div>
	  </div>
    </div>
  </div>
</div>

<!-- SECCION DONDE MOSTRAMOS HIJO Y AVATAR -->
<div class='container-fluid'>
	<div class='col-xs-12 contenedores' id='hijosInfo'>
	  <h3><i class='fa fa-child'></i> Mis Hijos
	  <button class='btn pull-right' style='background-color:#94bc3d; color:white;' id='tabRegHijos' data-dad='{{$rol}}'>
      <span class="fa fa-plus"></span>&nbsp;
      Registrar nuevo hijo
    </button></h3>
	  <hr class='hr'>
    @foreach ($datosHijos as $hijo)
 	 	<div class='col-md-4 col-sm-6'>
 	 		<div class='hijo_avatar' style='margin-bottom:20px;'>
				<center>
          <img src='/packages/images/perfil/{{$hijo->foto_perfil}}' class='img-responsive img-rounded' style='margin-top: 20px;'>
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
@stop


@section('mi_js')
{{HTML::script('/packages/js/libs/validation/jquery.validate.min.js')}}
{{HTML::script('/packages/js/libs/validation/localization/messages_es.min.js')}}
{{HTML::script('/packages/js/libs/validation/additional-methods.min.js')}}
{{HTML::script('/packages/js/libs/steps/jquery.steps.min.js')}}
{{HTML::script('/packages/js/curiosity/perfil.js')}}
{{HTML::script('/packages/js/curiosity/freeValidationDad.js')}}
<script type="text/javascript">
  $(document).ready(function() {
    $curiosity.menu.setPaginaId("#menuMisHijos");

    $("#showHelp").click(function(){
      $("#helper").modal('show');
    });

  });
</script>
@stop
