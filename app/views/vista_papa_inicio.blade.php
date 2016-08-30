@extends('admin_base')
@section('mi_css')
 {{HTML::style('/packages/css/libs/steps/jquery.steps.css')}}
 {{HTML::style('/packages/css/libs/date-picker/datepicker.min.css')}}
 {{HTML::style('/packages/css/curiosity/perfil.css')}}
 {{HTML::style('/packages/css/curiosity/dadProfile.css')}}
@stop

@section('title')
	Perfil | {{Auth::user()->username}}
@stop


@section('titulo_contenido')
	Inicio
@stop

@section('titulo_small')
	Bienvenido {{Auth::user()->username}}
@stop


@section('panel_opcion')

<!-- VENTANA MODAL PARA ELEGIR FOTO DE PERFIL -->
<div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="modal  fade" id="modalPrueba" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true" data-backdrop="static" data-keyboard="false">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header" id="modal-header-juego">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <center><h2 class="title-modal titulo-modal">Cambiar y/o Recortar imagen</h2></center>
                <center>
					<i class="fa fa-picture-o" style="color:#65499d; font-size:2em;"></i>
			    </center>
              </div>
              <div class="modal-body">
                <div class="row">
                  <div class="col-md-10">
                 {{Form::open(['method'=>'POST' ,'files'=>'true','url'=>'/foto','id'=>'frm-change-image'])}}
                  {{HTML::Image(User::get_imagen_perfil(Auth::user()->id),'Imagen de usuario',array('class'=>'img-responsive cropper-show','id'=>'image'))}}
                  <input  name="image" class="btn btn-default" id="inImage"  type="file">
                  <input type="hidden" name="x"/>
                  <input type="hidden" name="y"/>
                  <input type="hidden" name="width"/>
                  <input type="hidden" name="height"/>
                 {{Form::close()}}
                 </div>
                 <div class="col-md-2">
                 <div class="preview" style="width:120%;height:120%;border-radius:100%;overflow:hidden;border:3px solid #777;">
                 </div>
                </div>
              </div>
              </div>
              <div class="modal-footer" id="modal-footer-juego">
                <div class="row">
                  <div class="col-md-12">
                    <center>
                      <div class="actividadBotones">
                        <button type="button" class="btn btn-success btnRecortar">
                          <span class="fa fa-cut"></span>&nbsp;
                          <b>Recortar y/o cambiar imagen</b>
                        </button>
                      </div>
                    </center>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
 <!-- FIN DE MODAL ELEGIR FOTO PERFIL -->

 <!-- Modal para modificar datos del Papá -->
      	<div class="row">
				  <div class="">
					<div class="modal fade " id="editar_datos_papa" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
					  <div class="modal-dialog modal-lg">
						<div class="modal-content">
						  <div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<center>
							  <h2 class="modal-title titulo-modal" id="myModalLabel"> Modificar mis datos </h2>
							</center>
							<center>
								<i class="fa fa-edit" style="color:#65499d; font-size:2em;"></i>
							</center>
						  </div>
						  <div class="modal-body">
							<div class="row" style="padding-right:1%; padding-left:1%">
							  <form class="form-horizontal" id="frm_user_papa">
								  <div id="wizard1">
									<h2>Datos de Usuario</h2>
									<section>
									  <div class="form-group">
									   <label for="username_padre"><h4 class="title-input"><b>Nombre de usuario</b></h4></label>
										<div class="input-group">
										  <span class="input-group-addon">
											<spna  class="fa fa-user"></spna>
										  </span>
										  <input type="text"  name="username_persona" id="username_persona" value="{{Auth::user()->username}}" class="form-control form-custom" placeholder="Nombre de Usuario">
										</div>
									  </div>

									  <div class="form-group">
										<div class="input-group">
										  <span class="input-group-addon">
											<spna class="fa fa-lock"></spna>
										  </span>
										  <input type="password" name="password_persona" id="password_persona" value="" class="form-control form-custom" placeholder="Contraseña Actual">
										</div>
									  </div>

									   <div class="form-group">
										<div class="input-group">
										  <span class="input-group-addon">
											<spna class="fa fa-lock"></spna>
										  </span>
										  <input type="password" name="password_new" id="password_new" value="" class="form-control form-custom" placeholder="Contraseña Nueva">
										</div>
									  </div>

									   <div class="form-group">
										<div class="input-group">
										  <span class="input-group-addon">
											<spna class="fa fa-lock"></spna>
										  </span>
										  <input type="password" name="cpassword_new" id="cpassword_new" value="" class="form-control form-custom" placeholder="Confirmar nueva contraseña">
										</div>
									  </div>
									</section>

									<h2>Datos Personales</h2>
									<section>
									  <div class="form-group">
										<label for="username_persona"><h4 class="title-input"><b>Nombre(s) y Apellidos</b></h4></label>
										<div class="input-group">
										  <span class="input-group-addon">
											<spna class="fa fa-user"></spna>
										  </span>
										  <input type="text" name="nombre_persona" id="nombre_persona" value="{{Auth::user()->persona()->first()->nombre}}" class="form-control" placeholder="Nombre(s)">
										</div>
									  </div>

									  <div class="form-group">
										<div class="input-group">
										  <span class="input-group-addon">
											<spna class="fa fa-chevron-right"></spna>
										  </span>
										  <input type="text" name="apellido_paterno_persona" id="apellido_paterno_persona" value="{{Auth::user()->persona()->first()->apellido_paterno}}" class="form-control" placeholder="Apellido Paterno">
										</div>
									  </div>

									  <div class="form-group">
										<div class="input-group">
										  <span class="input-group-addon">
											<spna class="fa fa-chevron-right"></spna>
										  </span>
										  <input type="text" name="apellido_materno_persona" id="apellido_materno_persona" value="{{Auth::user()->persona()->first()->apellido_materno}}" class="form-control" placeholder="Apellido Materno">
										</div>
									  </div>

                    <div class="form-group">
                    <label for="email"><h4 class="title-input"><b>Correo electrónico</b></h4></label>
										<div class="input-group">
										  <span class="input-group-addon">
											<spna class="fa fa-envelope"></spna>
										  </span>
										  <input type="text" name="email" id="email" value="{{Auth::user()->persona()->first()->padre()->first()->email}}" class="form-control" placeholder="Correo electrónico">
										</div>
									  </div>

									  <div class="form-group">
										<label for="sexo"><h4 class="title-input"><b>Sexo</b></h4></label>
										<div class="input-group">
										  <span class="input-group-addon">
											<span class="fa fa-venus-mars"></span>
										  </span>
										  <select class="form-control form-custom" value="{{Auth::user()->persona()->first()->sexo}}" name="sexo_persona" id="sexo_persona">
                        @if (Auth::user()->persona()->first()->sexo == "m")
											  <option value="m" selected>Masculino</option>
                        @else
                        <option value="m">Masculino</option>
                        @endif
                        @if(Auth::user()->persona()->first()->sexo == "f")
											  <option value="f" selected>Femenino</option>
                        @else
                        <option value="f">Masculino</option>
                        @endif
										  </select>
										</div>
									 </div>

									 <div class="form-group">
									   <label for="fecha_nacimiento"><h4 class="title-input"><b>Fecha de Nacimiento</b></h4></label>
									   <div class="input-group">
										 <span class="input-group-addon">
										  <span class="fa fa-calendar"></span>
										 </span>
										 <input type="text" value="{{Auth::user()->persona()->first()->fecha_nacimiento}}" class="datepicker form-control form-custom" name="fecha_nacimiento_persona" id="fecha_nacimiento_persona">
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
      <!-- Fin de modal para modificar datos del Papá -->

 <!-- Datos de usuario y personal -->

 	<div class="col-md-3">
 		<!-- CUADRO DATOS USUARIO -->
 		<div class="box box-primary color-top">
      <div class="box-body box-profile">
         <div class="image-portada">
           <img style="cursor:pointer;" class="profile-user-img img-profile tooltipShow img-responsive img-circle"  data-toggle="modal" data-target="#modalPrueba" title="Cambiar foto de perfil" src='{{User::get_imagen_perfil(Auth::user()->id)}}' alt="User profile picture">
            <center><h4 style="margin-top: 35px;margin-bottom: -20px;">Aquí tu imagen favorita</h4></center>
         </div>
      </div>
    </div>
    <!-- CUADRO DATOS PERSONAL -->
    <div class="box box-primary color-top">
      <div class="box-header with-border">
        <center><h3 class="box-title" id="tit-mydata">Mis Datos</h3></center>
      </div>
      <div class="box-body">
        <strong><i class="fa fa-envelope margin-r-5"></i>  Correo</strong>
         <p class="text-muted">
            <samll id="textEmail">{{Auth::user()->persona->padre->email}}</samll>
         </p>
      </div>
      <div class="box-body">
        <strong><i class="fa fa-user margin-r-5"></i>  Nombre de usuario</strong>
         <p class="text-muted">
            <samll id="textUser">{{Auth::user()->username}}</samll>
         </p>
      </div>
      <center>
        <button class="btn btn-primary btn-sm form-control frm_datosP" id="edit_datos">Editar mis datos</button>
      </center>
    </div>
  </div>
 <!-- FIN Datos de usuario y personal -->

 <!-- SECCIÓN DE NOVEDADES -->
  <div class="col-md-9">
    <div class="col-md-6">
      <div id="noticias" class="secbox">
        <h1 id="tit-news">¡Novedades Curiosity!</h1>
      </div>
    </div>
    <div class="col-md-6">
      <div class="row">
        <div id="sec1" class="secbox">
          <h1 id="tit-sec1" class="titsecs">titulo</h1>
        </div>
      </div>
      <div class="row">
        <div id="sec2" class="secbox">
          <h1 id="tit-sec2" class="titsecs">titulo</h1>
        </div>
      </div>
    </div>
  </div>
 <!-- FIN DE SECCIÓN DE NOVEDADES -->

 <!-- SECCION MIS HIJOS -->
  <div class="container-fluid">
    <div class="col-xs-12 contenedores color-top" id="">
   	  <h3 id="tit-mychild"><i class="fa fa-child"></i> Mis Hijos</h3>
   	  @foreach ($datosHijos as $hijo)
   	  <div class="col-md-2 col-xs-4 col-sm-3 contenedor">
    		<div class="div-img">
    			<img src="/packages/images/perfil/{{$hijo->foto_perfil}}" alt="" class="img-responsive img-thumbnail img" >
    			<div class="text">
    				<center>{{$hijo->nombre}}</center>
    			</div>
    		</div>
  	  </div>
  	  @endforeach
   	</div>
  </div>
@stop


@section('mi_js')
{{HTML::script("/packages/js/libs/validation/jquery.validate.min.js")}}
{{HTML::script("/packages/js/libs/validation/localization/messages_es.min.js")}}
{{HTML::script('/packages/js/libs/validation/additional-methods.min.js')}}
{{HTML::script('/packages/js/libs/steps/jquery.steps.min.js')}}
{{HTML::script('/packages/js/libs/mask/jquery-mask/jquery.mask.js')}}
{{HTML::script('/packages/js/libs/date-picker/bootstrap-datepicker.min.js')}}
{{HTML::script('/packages/js/curiosity/perfil.js')}}
{{HTML::script('/packages/js/curiosity/padrePerfil.js')}}

@stop
