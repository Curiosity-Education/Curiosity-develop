@extends('admin_base')
@section('mi_css')
 {{HTML::style('/packages/css/curiosity/alert.css')}}
 {{HTML::style('/packages/css/libs/steps/jquery.steps.css')}}
 {{HTML::style('/packages/css/libs/date-picker/datepicker.min.css')}}
 {{HTML::style("/packages/css/libs/cropper/cropper.min.css")}}
 {{HTML::style('/packages/css/curiosity/alert.css')}}
 {{HTML::style('/packages/css/curiosity/perfil.css')}}
@stop

@section('title')
	Perfil | {{Auth::user()->username}}
@stop


@section('titulo_contenido_hijo')
	Mi Perfil
@stop

@section('titulo_small_hijo')
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
                <center><h1 class="title-modal titulo-modal fontHijo">Cambiar y/o Recortar imagen</h1></center>
                <center>
					<i class="fa fa-picture-o" style="color:#65499d; font-size:2em;"></i>
			    </center>
              </div>
              <div class="modal-body">
                <div class="row">
                  <div class="col-md-10">
                 {{Form::open(['method'=>'POST' ,'files'=>'true','url'=>'/foto','id'=>'frm-change-image'])}}
                  {{HTML::image(User::get_imagen_perfil(Auth::user()->id),'Imagen de usuario',array('class'=>'img-responsive cropper-show','id'=>'image'))}}
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

 <!-- MODAL PARA ESCOGER META DE JUEGO -->
 	<div class="modal fade" id="myModal" tabindex="10000" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog modal-sm" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<center><h1 class="modal-title fontHijo" id="myModalLabel">Nivel de juego</h1></center>
			<center><i style="color:#65499d; font-size:2em;" class="fa fa-flag-checkered"></i></center>
		  </div>
		  <div class="modal-body" id="body-nivel">
			<div id="contenedor-modo">
        @foreach($metas as $meta)
          @if($miMeta->id == $meta->id)
    			<input name="modo" type="radio" class="radio pull-left metaType" id="_{{$meta->id}}type" data-type="{{$meta->id}}" checked>
          @else
          <input name="modo" type="radio" class="radio pull-left metaType" id="_{{$meta->id}}type" data-type="{{$meta->id}}">
          @endif
    			<label for="_{{$meta->id}}type">{{$meta->nombre}}</label>
    			<img src="/packages/icons/{{$meta->emoji}}" alt="" style="width:35px; height:35px; margin-top:8px;" class="pull-right"><br>
        @endforeach
			</div>
		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn" id="btnSetMeta" style="background-color:#3cb54a; color:white;">Elegir</button>
		  </div>
		</div>
	  </div>
	</div>
 <!-- FIN MODAL PARA ESCOGER META DE JUEGO -->

   <div class="">
   <!-- Apartado para mostrar lo referente al avatar -->
	   <div class="col-md-3 col-sm-3 col-xs-12 contenedores">
	   <!-- Nombre del avatar del niño -->
		<center><h2 class="fontHijo">Oblivion<hr class="hrHijo"></h2></center>
	   <!-- Imagen del avatar -->
		<center><img src="/packages/images/avatars_curiosity/secuencias/{{$avatar->sprite}}" alt="" class="img-responsive" id="avatar"><hr class="hrHijo"></center>
	   <!-- Mostramos las evoluciones del avatar -->
		<center><h3 class="fontHijo">Evoluciones</h3></center>
   			<div class="col-md-4 col-sm-4 col-xs-4 evolucion"><img src="/packages/images/avatars/lupa.png" title="Evolución 1" alt="" class="img-responsive tooltipShow" id=""></div>
   			<div class="col-md-4 col-sm-4 col-xs-4 evolucion"><img src="/packages/images/avatars/lupa.png" title="Evolución 2" alt="" class="img-responsive tooltipShow" id=""></div>
   			<div class="col-md-4 col-sm-4 col-xs-4 evolucion"><img src="/packages/images/avatars/lupa.png" title="Evolución 3" alt="" class="img-responsive tooltipShow" id=""></div>
   			<!-- Mostramos el nivel actual del avatar -->
   			<div class="col-md-12 col-sm-12 col-xs-12 text-center"><hr class="hrHijo"><h3 class="fontHijo">EVOLUCIÓN ACTUAL: 2 </h3><hr class="hrHijo"></div>
	   </div>
	<!-- FIN Apartado para mostrar lo referente al avatar -->

  	<!-- Apartado de novedades y slider -->
  		<!--
  			Aquí pondremos cosas nuevas que se agregen a curiosity o bien
  			información que queramos mostrarle al niño como dato, no precisamente de curiosity.
  		-->
  			<div class="col-md-4 col-sm-3 col-xs-12">
  				<div class="panel panel-info" id="panel_informativo">
  					<div class="panel-heading" id="heading-novedades">
  						<div class="panel-title">
  							<center><h4 class="fontHijo">LO NUEVO EN CURIOSITY</h4></center>
  						</div>
  					</div>
  					<div class="panel-body">
  						<!-- Mostramos la PRIMERA novedad -->
  						<div class="alert alert-info clearfix fixIndez" id="novedad1">
  							<span class="alert-icon">
  							    <!-- Se cambia el icono segun sea la novedad -->
  								<i class="fa fa-gamepad"></i>
  							</span>
  							<div class="notification-info">
  								<ul class="clearfix notification-meta">
  									<li class="pull-left notification-sender">
  										<!-- Nombre del usuario del niño -->
  										<span>{{Auth::user()->username}}</span><br>
  										<!-- al dar click nos dirigue a donde esta la novedad -->
  										<a href="#" title="click, para saber mas" class="tooltipShow">Nuevo juego de conteo basico</a>
  									</li>
  								</ul>
  							</div>
  						</div>
  						<!-- Mostramos la SEGUNDA novedad -->
  						<div class="alert alert-danger clearfix fixIndez" id="novedad2">
  							<span class="alert-icon">
  								<!-- Se cambia el icono segun sea la novedad -->
  								<i class="fa fa-trophy"></i>
  							</span>
  							<div class="notification-info">
  								<ul class="clearfix notification-meta">
  									<li class="pull-left notification-sender">
  										<!-- Nombre del usuario del niño -->
  										<span>{{Auth::user()->username}}</span><br>
  										<!-- al dar click nos dirigue a donde esta la novedad -->
  										<a href="#" title="click, para saber mas" class="tooltipShow">Evoluciones para tu avatar</a>
  									</li>
  								</ul>
  							</div>
  						</div>
  						<!-- Mostramos la Tercera novedad -->
  						<div class="alert alert-danger clearfix fixIndez" id="novedad3">
  							<span class="alert-icon">
  								<!-- Se cambia el icono segun sea la novedad -->
  								<i class="fa fa-flash"></i>
  							</span>
  							<div class="notification-info">
  								<ul class="clearfix notification-meta">
  									<li class="pull-left notification-sender">
  										<!-- Nombre del usuario del niño -->
  										<span>{{Auth::user()->username}}</span><br>
  										<!-- al dar click nos dirigue a donde esta la novedad -->
  										<a href="#" title="click, para saber mas" class="tooltipShow">Nuevo nivel en tablas</a>
  									</li>
  								</ul>
  							</div>
  						</div>
  					</div>
  				</div>
  			</div>

  			<!--
  				SLIDER
  				las imagenes que aparecen tienen que ver con las novedades, si
  				se agrega sobre un juego en la novedad, se agrega al slider una captura
  				sobre ese nuevo juego.
  			 -->
  			<div class="col-md-5 col-sm-6 col-xs-12" id="slider">
  				<div class="row"><section class="slider-container">
				<ul id="slider" class="slider-wrapper-hijo">
				  <li class="slide-current">
            <center><div id="makeCanvas"></div></center>
					<!-- <center><div id="makeCanvas"><canvas id='grafica_meta' height='300' width='300' style='margin-left:-50px;'></canvas></div></center> -->
						<div class="caption">
					  	<!-- El icono y el texto es igual a la novedad que representa -->
						  <p><i class="fa fa-pie-chart"></i>&nbsp;
                Avances en tu meta diaria
              </p>
						</div>
					</li>
					<!-- <li>
					  <img src="/packages/images/fondos/147H.jpg" alt="img-2" title="Te mostramos el contenido para tus Hijos">
						<div class="caption">
						   <p><i class="fa fa-trophy"></i> Evoluciones para tu avatar.</p>
						</div>
					</li>
					<li>
					  <img src="/packages/images/fondos/videoFondocp.jpg" alt="img-3" title="Te mostramos el contenido para tus Hijos">
						<div class="caption">
						   <p><i class="fa fa-flash"></i> Nuevo nivel en tablas.</p>
						</div>
					</li> -->
				  </ul>
			   </section></div>
  			</div>
  	<!-- FIN Apartado de novedades y slider -->

  	<!-- Apartado de PUNTAJES -->
  	<div class="col-md-9" id="">
  		<div class="row">
  		  <div class="col-md-3">
  			<div class="card animated zoomIn tarjetas" style="display:block;">
  				<div class="header-bg" style="height:70px;"></div>
  				<div class="avatar">
  					<img src="/packages/icons/physics.png" alt="" class="img-effect">
  				</div>
  				<div class="content myContent">
  					<center><p style="margin:0 0 5px;">Nivel de Experiencia</p></center>
  					<!-- Puntaje del niño -->
  					<center><p style="margin:0 0 5px;">{{$experiencia->cantidad_exp}} pts</p></center>
  					<hr class="hrHijo score">
  					<!-- <center><p>Estado:</p></center> -->
  					<!--
  						Estos emoticones que aparecen en los estados serán representados segun un
  						rango, donde cada rango tendra un emoticon propio.
  					-->
            @if ($experiencia->cantidad_exp >= 500 and $experiencia->cantidad_exp < 1000)
              <center><img src="/packages/icons/happiness.png" class="img-responsive" alt="" style="width:35px; height:35px;"></center>
            @elseif ($experiencia->cantidad_exp >= 1000 and $experiencia->cantidad_exp < 1500)
              <center><img src="/packages/icons/happy-1.png" class="img-responsive" alt="" style="width:35px; height:35px;"></center>
            @elseif ($experiencia->cantidad_exp >= 1500)
              <center><img src="/packages/icons/happy-2.png" class="img-responsive" alt="" style="width:35px; height:35px;"></center>
            @else
              <center><img src="/packages/icons/indifferent.png" class="img-responsive" alt="" style="width:35px; height:35px;"></center>
            @endif
  				</div>
  			</div>
  		  </div>
  		  <div class="col-md-3">
  			<div class="card animated zoomIn tarjetas" style="display:block;">
  				<div class="header-bg" style="height:70px;"></div>
  				<div class="avatar">
  					<img src="/packages/icons/medal.png" alt="" class="img-effect">
  				</div>
  				<div class="content myContent">
  					<center><p style="margin:0 0 5px;">CuriosyPesos</p></center>
  					<center><p style="margin:0 0 5px;">$ {{$coins}}</p></center>
  					<hr class="hrHijo score">
  					<!-- <center><p>Estado:</p></center> -->
  					<center><img src="/packages/icons/happiness.png" class="img-responsive" alt="" style="width:35px; height:35px;"></center>
  				</div>
  			</div>
  		  </div>
  		  <div class="col-md-3">
  			<div class="card animated zoomIn tarjetas getHigthCard" style="display:block;">
  				<div class="header-bg" style="height:70px;">
  					<a href="" class="btn pull-right tooltipShow" title="Selecciona tu nivel ideal"
  						data-toggle="modal" data-target="#myModal">
  						<i class="fa fa-bars"></i>
  					</a>
  				</div>
  				<div class="avatar">
  					<!-- GRÁFICA DE META DIARIA -->
  					<img src="/packages/icons/molecule.png" alt="" class="img-effect">
  				</div>
  				<div class="content myContent">
  					<center>
  					<p style="margin:0 0 5px;">Meta diaria</p>
  					</center>
  					<center><p style="margin:0 0 5px;" id="metaName">{{$miMeta->nombre}}</p></center>
  					<hr class="hrHijo score">
  					<!-- <center><p>Estado:</p></center> -->
            @if ($porcAvanceMeta >= 25 and $porcAvanceMeta < 50)
  					<center><img src="/packages/icons/happiness.png" class="img-responsive" alt="" style="width:35px; height:35px;" id="metaEmoji"></center>
            @elseif ($porcAvanceMeta >= 50 and $porcAvanceMeta < 75)
            <center><img src="/packages/icons/happy-1.png" class="img-responsive" alt="" style="width:35px; height:35px;" id="metaEmoji"></center>
            @elseif ($porcAvanceMeta >= 75 and $porcAvanceMeta < 100)
            <center><img src="/packages/icons/happy-2.png" class="img-responsive" alt="" style="width:35px; height:35px;" id="metaEmoji"></center>
            @elseif ($porcAvanceMeta == 100)
            <center><img src="/packages/icons/nerd-2.png" class="img-responsive" alt="" style="width:35px; height:35px;" id="metaEmoji"></center>
            @else
            <center><img src="/packages/icons/indifferent.png" class="img-responsive" alt="" style="width:35px; height:35px;" id="metaEmoji"></center>
            @endif
  				</div>
  			</div>
  		  </div>
  		  <div class="col-md-3">
  			<div class="box box-primary tarjetas" id="imgPerfilChanger">
			   <div class="box-body box-profile">
				  <div class="image-portada">
					<img style="cursor:pointer;" class="profile-user-img img-profile tooltipShow img-responsive img-circle"  data-toggle="modal" data-target="#modalPrueba" title="Cambiar foto de perfil" src='{{User::get_imagen_perfil(Auth::user()->id)}}' alt="User profile picture">
					 <center><h3 class="fontHijo description-block"><br>Aquí tu imagen favorita</h3></center>
				  </div>
			   </div>
			 </div>
  		  </div>
  		</div>
  	</div>
@stop

@section('mi_js')
{{HTML::script("/packages/js/libs/validation/jquery.validate.min.js")}}
{{HTML::script("/packages/js/libs/validation/localization/messages_es.min.js")}}
{{HTML::script('/packages/js/libs/validation/additional-methods.min.js')}}
{{HTML::script('/packages/js/libs/steps/jquery.steps.min.js')}}
{{HTML::script('/packages/js/libs/noty/packaged/jquery.noty.packaged.min.js')}}
{{HTML::script('/packages/js/libs/noty/layouts/bottomRight.js')}}
{{HTML::script('/packages/js/libs/noty/layouts/topRight.js')}}
{{HTML::script('/packages/js/libs/mask/jquery-mask/jquery.mask.js')}}
{{HTML::script('/packages/js/libs/date-picker/bootstrap-datepicker.min.js')}}
{{HTML::script('/packages/js/curiosity/alert.js')}}
{{HTML::script('/packages/js/libs/cropper/cropper.min.js')}}
{{HTML::script('/packages/js/libs/chart/Chart.min.js')}}
{{HTML::script('/packages/js/curiosity/perfil.js')}}
<script type="text/javascript">
  $(document).ready(function() {

    var avanceMeta = {{$avanceMeta}};
    var faltanMeta = {{$faltanteMeta}};

    function makeMetaChart (avances, faltantes){      
      var canvasCode = "<canvas id='grafica_meta' height='300' width='300' style='margin-left:-50px;'>";
      $("#makeCanvas").html('');
      $("#makeCanvas").append(canvasCode);
      var grafica = $("#makeCanvas").find('#grafica_meta');
      var myChart = new Chart(grafica, {
        type : 'doughnut',
        data : {
          labels : ["Juegos Terminados", "Faltantes"],
          datasets : [{
            data : [avances, faltantes],
            backgroundColor : ["#3cb54a", "rgba(112, 195, 122, 0.4)"],
            hoverBackgroundColor : ["#2f943a", "rgba(112, 195, 122, 0.4)"],
            borderWidth : [3, 3]
          }]
        },
        animation : {
          animateScale : true
        },
        options : {
          responsive : false
        }
      });
    }

    makeMetaChart (avanceMeta, faltanMeta);

    $("#menuDatos").show();

    $(".metaType").click(function(){
      $.each($(".metaType"), function(index, el) {
        $(this).data('is', '0');
      });
      $(this).data('is', '1');
    });

    $("#btnSetMeta").click(function(){
      var $id;
      $.each($(".metaType"), function(index, el) {
        if ($(this).data('is') == '1'){
          $id = $(this).data('type');
        }
      });
      if ($id != undefined){
        $.ajax({
          url: '/metaChange',
          type: 'POST',
          data: {data : $id}
        })
        .done(function(response) {
          makeMetaChart (response['avanceMeta'], response['faltanteMeta']);
          var porc = response['porcAvanceMeta'];
          $("#metaName").text(response['miMeta']['nombre']);
          if (porc >= 25 && porc < 50){
            $("#metaEmoji").attr('src', "/packages/icons/happiness.png");
          }
          else if (porc >= 50 && porc < 75){
            $("#metaEmoji").attr('src', "/packages/icons/happy-1.png");
          }
          else if (porc >= 75 && porc < 100){
            $("#metaEmoji").attr('src', "/packages/icons/happy-2.png");
          }
          else if (porc == 100){
            $("#metaEmoji").attr('src', "/packages/icons/nerd-2.png");
          }
          else{
            $("#metaEmoji").attr('src', "/packages/icons/indifferent.png");
          }
          $("#myModal").modal('hide');
        })
        .fail(function(error) {
          console.log(error);
        });

      }
      else{
        $("#myModal").modal('hide');
      }
    });

  });
</script>
@stop
