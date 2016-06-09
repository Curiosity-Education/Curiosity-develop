<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<link rel="icon" type="image/png" href="/packages/images/Curiosity.png">
	<meta http-equiv="X-UA-Compatible" content="IE=Edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
  {{HTML::style('/packages/css/libs/bootstrap/bootstrap.min.css')}}
  {{HTML::style('/packages/css/libs/awensome/css/font-awesome.min.css')}}
  {{HTML::style('/packages/css/curiosity/registro.css')}}
  {{HTML::style('/packages/css/libs/steps/jquery.steps.css')}}
  {{HTML::style('/packages/css/libs/date-picker/datepicker.min.css')}}
  {{HTML::style('/packages/css/curiosity/alert.css')}}
  <title>Curiosity</title>
</head>
<!-- Navbar menu -->
<div class="navbar navbar-default navbar-fixed-top bg-blue" role="navigation">
  <div class="container-fluid">
    <div class="navbar-header">
      <button class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
        <span class="icon icon-bar"></span>
        <span class="icon icon-bar"></span>
        <span class="icon icon-bar"></span>
      </button>
      <a href="javascript:void(0)" class="navbar-brand">
				<span>{{HTML::image('/packages/images/Curiosity-mini.png')}}</span>
        Curiosity<small>.com.mx</small>
      </a>
    </div>
    <div class="collapse navbar-collapse">
      <ul class="nav navbar-nav navbar-right main-navigation">
        <li><a href="/" id="link-inicio">Inicio</a></li>
        <li><a href="/login">Iniciar Sesión</a></li>
      </ul>
    </div>
  </div>
</div>

<section class="container" id="registro">
  <div class="row">
    <div class="col-xs-12">
			<div class="well well-lg" id="registro-well">
				<div class="row">
					<div class="col-xs-12">
						<form  action="" method="post" class="form-horizontal" id="frm-registro">

							<div id="wizard">
								<h2>Datos de Usuario</h2>
								<section>
									<div class="form-group">
										<div class="input-group">
											<span class="input-group-addon">
												<spna  class="fa fa-user"></spna>
											</span>
											<input type="text"  name="username" id="username" value="" class="form-control form-custom" placeholder="Nombre de Usuario">
										</div>
									</div>

									<div class="form-group">
										<div class="input-group">
											<span class="input-group-addon">
												<spna class="fa fa-lock"></spna>
											</span>
											<input type="password" name="password" id="password" value="" class="form-control form-custom" placeholder="Contraseña">
										</div>
									</div>

									<div class="form-group">
										<div class="input-group">
											<span class="input-group-addon">
												<spna class="fa fa-lock"></spna>
											</span>
											<input type="password" name="cpassword" value="" class="form-control form-custom" placeholder="Confirmar Contraseña">
										</div>
									</div>

									<div class="form-group">
										<div class="input-group">
											<span class="input-group-addon">
												<spna class="fa fa-envelope"></spna>
											</span>
											<input type="email" name="email" value="" class="form-control form-custom" placeholder="Correo Elecronico">
										</div>
									</div>
									 <div class="form-group">
										 <label for="telefono"><h4 class="title-input"><b>Número Telefónico</b></h4></label>
										 <div class="input-group">
										   <span class="input-group-addon">
										   	<span class="fa fa-phone"></span>
										   </span>
										   <input type="tel" class="form-control form-custom" name="telefono" id="telefono">
										 </div>
									 </div>
								</section>

								<h2>Datos Generales</h2>
								<section>
									<div class="form-group">
										<div class="input-group">
											<span class="input-group-addon">
												<spna class="fa fa-user"></spna>
											</span>
											<input type="text" name="nombre" value="" class="form-control" placeholder="Nombre(s)">
										</div>
									</div>

									<div class="form-group">
										<div class="input-group">
											<span class="input-group-addon">
												<spna class="fa fa-chevron-right"></spna>
											</span>
											<input type="text" name="apellido_paterno" value="" class="form-control" placeholder="Apellido Paterno">
										</div>
									</div>

									<div class="form-group">
										<div class="input-group">
											<span class="input-group-addon">
												<spna class="fa fa-chevron-right"></spna>
											</span>
											<input type="text" name="apellido_materno" value="" class="form-control" placeholder="Apellido Materno">
										</div>
									</div>

									<div class="form-group">
										<label for="sexo"><h4 class="title-input"><b>Sexo</b></h4></label>
										<div class="input-group">
										  <span class="input-group-addon">
										  	<span class="fa fa-venus-mars"></span>
										  </span>
											<select class="form-control form-custom" name="sexo" id="sexo">
												<option value="m">Masculino</option>
												<option value="f">Femenino</option>
											</select>
										</div>
								 </div>

								 <div class="form-group">
									 <label for="fecha_nacimiento"><h4 class="title-input"><b>Fecha de Nacimiento</b></h4></label>
									 <div class="input-group">
									   <span class="input-group-addon">
									   	<span class="fa fa-calendar"></span>
									   </span>
									   <input type="text" class="datepicker form-control form-custom" name="fecha_nacimiento" id="fecha_nacimiento">
									 </div>
								 </div>
								</section>

								<h2>Direccion</h2>
								<section>
								 <div class="form-group">
								 	<div class="input-group">
								 		<span class="input-group-addon">
								 			<i class="fa fa-home"></i>
								 		</span>
										 <select class="form-control  form-custom" id="estado" name="estado" data-placeholder="Estado">
											 <option value="">Estado</option>
											 @foreach($datos["estados"] as $estado)
											 	<option value="{{$estado->id}}">{{$estado->nombre}}</option>
											 @endforeach
										 </select>
									 </div>
								 </div>

								 <div class="form-group">
								 	<div class="input-group">
								 		 <span class='input-group-addon'>
								 		 	<i class="fa fa-home"></i>
								 		 </span>
										 <select class="form-control  form-custom" name="ciudad">
											 <option value="">Ciudad</option>
										 </select>
									 </div>
								 </div>
								 <div class="form-group">
								 	<div class="input-group">
								 		<span class="input-group-addon">
								 			<i class='fa fa-home'></i>
								 		</span>
								 		<input type="text"  name="colonia" class="form-control form-custom" placeholder="Colonia"/>
								 	</div>
								 </div>
								 <div class="form-group">
								 	<div class="input-group">
								 		<span class="input-group-addon">
								 			<i class="fa fa-home"></i>
								 		</span>
								 		<input type="text" name="calle" class="form-control form-custom" placeholder="Calle"/>
								 	</div>
								 </div>
								 <div class="form-group">
								 	<div class="input-group">
								 		<span class="input-group-addon">
								 			<i class="fa fa-home"></i>
								 		</span>
								 		<input type="text" class="form-control form-custom" name="numero" placeholder="Numero de casa"/>
								 	</div>
								 </div>
								 <div class="form-group">
								 	 <div class="input-group">
								 	 	<span class="input-group-addon">
								 	 		<i class='fa fa-home'></i>
								 	 	</span>
									 	<input type="number" name="codigo_postal" id="codigo_postal" placeholder="Codigo Postal" class="form-control form-custom">
									 </div>
								 </div>
								</section>

							<!-- <h2>Pagos</h2>
								<section>
										<div class="form-group">
										  <div class="input-group">
										    <span class="input-group-addon">
										    	<span class="fa fa-user"></span>
										    </span>
										    <input type="text" name="tarjetahabiente" class="form-control" placeholder="Nombre del Tarjetahabiente">
										  </div>
										</div>

										<div class="form-group">
										  <div class="input-group">
										    <span class="input-group-addon">
										    	<span class="fa fa-cc-visa"></span>
										    </span>
										    <input type="text" class="form-control" name="numero_tarjeta" placeholder="Numero de Tarjeta">
										  </div>
										</div>

										<div class="form-group">
										  <div class="input-group">
										    <span class="input-group-addon">
										    	<span class="fa fa-credit-card"></span>
										    </span>
										    <input type="text" name="cvc" class="form-control" placeholder="CVC">
										  </div>
										</div>

										<div class="form-group">
											<label for="fec_nac"><h4 class="title-input"><b>Fecha de Expiración</b></h4></label>
										  <div class="input-group">
										    <span class="input-group-addon">
										    	<span class="fa fa-calendar-times-o"></span>
										    </span>
										    <input type="text" name="fecha_expiracion" class="form-control form-custom">
										  </div>
										</div>
								</section> -->
							</div>

						</form>
					</div>
				</div>
	    </div>
    </div>
  </div>
</section>

{{HTML::script('/packages/js/libs/jquery/jquery.min.js')}}
{{HTML::script('/packages/js/libs/bootstrap/bootstrap.min.js')}}
{{HTML::script('/packages/js/libs/steps/jquery.steps.min.js')}}
{{HTML::script('packages/js/curiosity/alert.js')}}
{{HTML::script('/packages/js/libs/noty/packaged/jquery.noty.packaged.min.js')}}
{{HTML::script('/packages/js/libs/noty/layouts/bottomRight.js')}}
{{HTML::script('/packages/js/libs/noty/layouts/topRight.js')}}
{{HTML::script('/packages/js/libs/validation/jquery.validate.min.js')}}
{{HTML::script('/packages/js/libs/validation/localization/messages_es.min.js')}}
{{HTML::script('/packages/js/libs/validation/additional-methods.min.js')}}
{{HTML::script('/packages/js/libs/date-picker/bootstrap-datepicker.min.js')}}
{{HTML::script('/packages/js/libs/mask/jquery-mask/jquery.mask.js')}}
{{HTML::script('/packages/js/curiosity/registro_padre.js')}}
<script>
  $(function ()
  {
    $("#wizard").steps({
        headerTag: "h2",
        bodyTag: "section",
        transitionEffect: "slideLeft",
        autoFocus:true,
        Next:"Siguiente",
        Finish:"Finalizar",
        onFinishing: function (event, currentIndex) {
            if($form.valid()){
                return true;
            }else{
                return false;
            }
        },
        onStepChanging: function (event, currentIndex, newIndex){
        	if(newIndex>currentIndex){
	           if($(".current input").valid()){
	               return true;
	           }else return false;
	       }else return true;
        },
   /*headerTag: "h1",
    bodyTag: "div",
    contentContainerTag: "div",
    actionContainerTag: "div",
    stepsContainerTag: "div",
    cssClass: "wizard",
    stepsOrientation: $.fn.steps.stepsOrientation.horizontal,

    /* Templates */
   /* titleTemplate: '<span class="number">#index#.</span> #title#',
    loadingTemplate: '<span class="spinner"></span> #text#',

    /* Behaviour */
    /*autoFocus: false,
    enableAllSteps: false,
    enableKeyNavigation: true,
    enablePagination: true,
    suppressPaginationOnFocus: true,
    enableContentCache: true,
    enableCancelButton: true,
    enableFinishButton: true,
    preloadContent: false,
    showFinishButtonAlways: false,
    forceMoveForward: false,
    saveState: false,
    startIndex: 0,

    /* Transition Effects */
    /*transitionEffect: $.fn.steps.transitionEffect.none,
    transitionEffectSpeed: 200,

    /* Events */
   /* onStepChanging: function (event, currentIndex, newIndex) { return true; },
    onStepChanged: function (event, currentIndex, priorIndex) { }},
    onCanceled: function (event) { },
    onFinishing: function (event, currentIndex) { return true; },
    onFinished: function (event, currentIndex) { },

    /* Labels */
    labels: {
        cancel: "Cancelar",
      //  current: "current step:",
        pagination: "Paginación",
        finish: "Finalizar",
        next: "Siguiente",
        previous: "Anterior",
        loading: "Cargando ..."
    }

  });
});
</script>
</body>
</html>
