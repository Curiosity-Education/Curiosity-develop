@extends('principalMaster')

@section('css')
  {{HTML::style('/packages/css/libs/date-picker/datepicker.min.css')}}
  {{ HTML::style('/packages/css/libs/sweetalert/sweetalert.css') }}
  {{HTML::style('/packages/css/libs/notificacion_toast/jquery.toast.css')}}
	{{HTML::style('/packages/css/curiosity/regStyle.css')}}
@stop

@section('title')
  Curiosity | Regístro
@stop

@section('menu')
  <li class='nav-item anc'>
    <a class='nav-link' href='/'>Inicio <span class='sr-only'>(current)</span></a>
  </li>
  <li class="nav-item">
  	<a class="btn success-rounded-outline waves-effect pull-right" style="color:#fff;" href="/login">{{Lang::get('landingPage.menu.logIn')}}</a>
  </li>
@stop

@section('contenido')
  <audio src='/packages/notificaciones/music.mp3' id='notyAudio'></audio>
  <div class="mascara">
  	<div class="">
  		<div class="container-fluid">
  			<div class="col-md-10 col-md-offset-1" id="wrapper-form" style="margin-bottom:30px;border-radius:10px;">
  				<center>
  					<h1 class="h1-responsive white-text titulo">
  						¡Bienvenido a la cuenta padre curiosity!
  					</h1>
  				</center>
  				<!-- <hr style="border:1px solid white;"> -->
  				<form class="form" id="frm-registro" method="post">
  					<div class="col-md-6">
  						<div class="formContent" style="padding-bottom:45px;">
  							<center><h4 class="step">Datos personales</h4></center>
  							<!-- datos de generales -->
  							<div class="md-form form-group">
  								<i class="fa fa-user prefix"></i>
  								<input type="text" id="nombre" class="form-control validate" name="nombre">
  								<label for="nombre" data-error="" data-success="">Nombre (s)</label>
  							</div>

  							<div class="md-form form-group">
  								<i class="fa fa-user prefix"></i>
  								<input type="text" id="ap_paterno" class="form-control validate" name="apellido_paterno">
  								<label for="ap_paterno" data-error="" data-success="">Apellido paterno</label>
  							</div>

  							<div class="md-form form-group">
  								<i class="fa fa-user prefix"></i>
  								<input type="text" id="ap_materno" class="form-control validate" name="apellido_materno">
  								<label for="ap_materno" data-error="" data-success="">Apellido materno</label>
  							</div>

  							<div class="md-form form-group">
  								<select class="mdb-select" name="sexo" id="sexo">
  									<option value="" disabled selected>Sexo</option>
  									<option value="m" data-icon="http://mdbootstrap.com/wp-content/uploads/2015/10/avatar-1.jpg" class="img-circle">Masculino</option>
  									<option value="f" data-icon="http://mdbootstrap.com/wp-content/uploads/2015/10/avatar-2.jpg" class="img-circle">Femenino</option>
  								</select>
  							</div>

  							<div class="md-form form-group">
  							<i class="fa fa-calendar prefix"></i>
  								<input placeholder="Fecha de nacimiento" type="text" id="fecha_nacimiento" class="form-control datepicker" name="fecha_nacimiento" readonly="true">
  							</div>
  						</div>
  					</div>
  					<!--  -->
  					<div class="col-md-6">
  						<div class="formContent">
                <center><h4 class="step">Datos de usuario</h4></center>
  							<!-- datos de usuario -->
  							<div class="md-form form-group">
  								<i class="fa fa-user prefix"></i>
  								<input type="text" id="username" class="form-control validate" name="username" id="username">
  								<label for="username" data-error="" data-success="">Nombre de usuario</label>
  							</div>

  							<div class="md-form form-group">
  								<i class="fa fa-lock prefix"></i>
  								<input type="password" id="password" class="form-control validate" name="password" id="password">
  								<label for="password" data-error="" data-success="">Contraseña</label>
  							</div>

  							<div class="md-form form-group">
  								<i class="fa fa-lock prefix"></i>
  								<input type="password" id="password_confirm" class="form-control validate" name="cpassword">
  								<label for="password_confirm" data-error="" data-success="">Confirmar contraseña</label>
  							</div>

  							<div class="md-form form-group">
  								<i class="fa fa-lock prefix"></i>
  								<input type="email" id="email" class="form-control validate" name="email">
  								<label for="email" data-error="" data-success="">Correo electrónico</label>
  							</div>
  							<div class="md-form form-group">
  								<i class="fa fa-square-o prefix" id="terms"></i>
  								<h6 id="termsLabel">
                    He leído los
                    <a href="/terminos-y-condiciones" onclick="this.target='_blank' " id="termsLink">terminos y condiciones</a>
                    presentados por Curiosity Educación y al completar el registro
                    ACEPTO cada una de las normas y especificaciones establecidas.
                  </h6>
  							</div>
  						</div>
  					</div>
  				</form>
  				<button type="button" class="btn btn-warning pull-right btn-Reg" id="regAc">
  					Guardar
  				</button>
  				<button type="button" class="btn pull-right btn-Reg" id="regcanceled">
  					Reestablecer
  				</button>
  			</div>
  		</div>
  	</div>
  </div>
@stop

@section('js')
  {{HTML::script('packages/js/curiosity/alert.js')}}
  {{HTML::script('/packages/js/curiosity/desktop-notify.js')}}
  {{HTML::script('/packages/js/libs/validation/jquery.validate.min.js')}}
  {{HTML::script('/packages/js/libs/validation/localization/messages_es.min.js')}}
  {{HTML::script('/packages/js/libs/validation/additional-methods.min.js')}}
  {{HTML::script('/packages/js/libs/date-picker/bootstrap-datepicker.min.js')}}
  {{HTML::script('/packages/js/libs/mask/jquery-mask/jquery.mask.js')}}
  {{HTML::script('/packages/js/libs/sweetalert/sweetalert.min.js')}}
  {{HTML::script('/packages/js/libs/notificacion_toast/jquery.toast.js')}}
  {{HTML::script('/packages/js/curiosity/curiosity.js')}}
  {{HTML::script('/packages/js/curiosity/registro_padre.js')}}
@stop
