@extends('admin_base')
@section('mi_css')
   {{HTML::style('/packages/css/curiosity/caledarFlat.css')}}
   {{HTML::style('/packages/css/curiosity/perfilHijoResp.css')}}
@stop

@section('title')
   Perfil | {{Auth::user()->username}}
@stop


@section('panel_opcion')
<!-- Formulario de actualizacion de datos -->
<div class="col-md-12" id="updatedatachild">
   <div>
      <form class="form-horizontal" id="frm_user">
         <h2 id="tit-secupd">Actualiza tus datos</h2>
         <section class="sectionUpdate">
            <div class="form-group">
               <label for="username_padre"><h3 class="title-input fontHijo"><b>Nombre de usuario</b></h3></label>
               <div class="input-group groupInputWidth">
                  <span class="input-group-addon addonskstyle">
                     <spna class="fa fa-user"></spna>
                  </span>
                  <input type="text"  name="username_persona" id="username_persona" value="{{Auth::user()->username}}" class="form-control inputData" placeholder="Nombre de Usuario">
               </div>
            </div>

            <div class="form-group">
               <div class="input-group groupInputWidth">
                  <span class="input-group-addon addonskstyle">
                     <spna class="fa fa-lock"></spna>
                  </span>
                  <input type="password" name="password_persona" id="password_persona" value="" class="form-control inputData" placeholder="Contraseña Actual">
               </div>
            </div>

            <div class="form-group">
               <div class="input-group groupInputWidth">
                  <span class="input-group-addon addonskstyle">
                     <spna class="fa fa-lock"></spna>
                  </span>
                  <input type="password" name="password_new" id="password_new" value="" class="form-control inputData" placeholder="Contraseña  Nueva">
               </div>
            </div>

            <div class="form-group">
               <div class="input-group groupInputWidth">
                  <span class="input-group-addon addonskstyle">
                     <spna class="fa fa-lock"></spna>
                  </span>
                  <input type="password" name="cpassword_new" id="cpassword_new" value="" class="form-control inputData" placeholder="Confirmar nueva contraseña">
               </div>
            </div>
         </section>

         <section class="sectionUpdate">
            <div class="form-group">
               <label for="username_persona"><h3 class="title-input fontHijo"><b>Nombre(s) y Apellidos</b></h3></label>
               <div class="input-group groupInputWidth">
                  <span class="input-group-addon addonskstyle">
                     <spna class="fa fa-user"></spna>
                  </span>
                  <input type="text" name="nombre_persona" id="nombre_persona" value="{{Auth::user()->persona()->first()->nombre}}" class="form-control inputData" placeholder="Nombre(s)">
               </div>
            </div>

            <div class="form-group">
               <div class="input-group groupInputWidth">
                  <span class="input-group-addon addonskstyle">
                     <spna class="fa fa-chevron-right"></spna>
                  </span>
                  <input type="text" name="apellido_paterno_persona" id="apellido_paterno_persona" value="{{Auth::user()->persona()->first()->apellido_paterno}}" class="form-control inputData" placeholder="Apellido Paterno">
               </div>
            </div>

            <div class="form-group">
               <div class="input-group groupInputWidth">
                  <span class="input-group-addon addonskstyle">
                     <spna class="fa fa-chevron-right"></spna>
                  </span>
                  <input type="text" name="apellido_materno_persona" id="apellido_materno_persona" value="{{Auth::user()->persona()->first()->apellido_materno}}" class="form-control inputData" placeholder="Apellido Materno">
               </div>
            </div>

            <div class="form-group">
               <label for="sexo"><h3 class="title-input fontHijo"><b>Sexo</b></h3></label>
               <div class="input-group groupInputWidth">
                  <span class="input-group-addon addonskstyle">
                     <span class="fa fa-venus-mars"></span>
                  </span>
                  <select class="form-control inputData" value="{{Auth::user()->persona()->first()->sexo}}" name="sexo_persona" id="sexo_persona">
                     <option value="m">Masculino</option>
                     <option value="f">Femenino</option>
                  </select>
               </div>
            </div>

            <div class="form-group" hidden="hidden">
               <label for="fecha_nacimiento"><h3 class="title-input fontHijo"><b>Fecha de Nacimiento</b></h3></label>
               <div class="input-group groupInputWidth">
                  <span class="input-group-addon addonskstyle">
                     <span class="fa fa-calendar"></span>
                  </span>
                  <input type="text" value="{{Auth::user()->persona()->first()->fecha_nacimiento}}" class="dpk form-control inputData" name="fecha_nacimiento_persona" id="fecha_nacimiento_persona">
               </div>
            </div>
         </section>
      </form>
      <div class="row">
         <div class="col-md-12">
            <div class="text-right">
               <button type="button" class="btn" id="btnCncl">
                  Cancelar
               </button>
               <button type="button" class="btn" id="btnupdate">
                  Guardar
               </button>
            </div>
         </div>
      </div>
   </div>
</div>
<!-- Fin formulario de actualizacion de datos -->
<!-- VENTANA MODAL PARA ELEGIR FOTO DE PERFIL -->
<div class="container">
   <div class="row">
      <div class="col-md-12">
         <div class="modal  fade" id="modalPrueba" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true" data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog modal-lg" id="modalDialog">
               <div class="modal-content" id="modalContent">
                  <div class="modal-header" id="modal-header-juego">
                     <button type="button" class="close" data-dismiss="modal" aria-hidden="true" id="btnCloseModal">&times;</button>
                     <center>
                        <h2 class="tit-modalhead">
                           <i class="fa fa-picture-o"></i>&nbsp;
                           Cambiar y/o Recortar imagen
                        </h2>
                     </center>
                  </div>
                  <div class="modal-body">
                     <div class="row">
                        <div class="col-md-8">
                           <img src="{{User::get_imagen_perfil(Auth::user()->id)}}" alt="Imagen de usuario" class="img-responsive" id="imageH" style="max-width:100%;">
                           {{Form::open(['method'=>'POST' ,'files'=>'true','url'=>'/foto','id'=>'frm_change_image_H'])}}
                           <input name="inImageH" id="inImageH" type="file" style="display:none;">
                           {{Form::close()}}
                           <a href="javascript:void(0)" for="inImageH" class="btn" id="btnselectprofile">
                              <span class="fa fa-folder-open"></span>&nbsp;
                              Seleccionar Imagen desde Archivos
                           </a>
                        </div>
                        <div class="col-md-4">
                           <center>
                              <div class="preview"></div>
                           </center>
                           <div class="datainfo">
                              <label class="datalabel">Ancho (px)</label>
                              <input type="text" class="input-prof" readonly='true' name="width" id="datW"/>
                              <label class="datalabel">Alto (px)</label>
                              <input type="text" class="input-prof" readonly='true' name="height" id="datH"/>
                              <label class="datalabel">Posición (x)</label>
                              <input type="text" class="input-prof" readonly='true' name="x" id="datX"/>
                              <label class="datalabel">Posición (y)</label>
                              <input type="text" class="input-prof" readonly='true' name="y" id="datY"/>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="modal-footer" id="modalFooter">
                     <div class="row">
                        <div class="col-md-12">
                           <center>
                              <div class="actividadBotones text-right">
                                 <button type="button" class="btn btn-success btnRecortar" id="btnRecortarH">
                                    Guardar Cambios
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
            <center><h1 class="modal-title fontHijo" id="myModalLabel">Meta Diaria</h1></center>
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

<!-- CONTENIDO DEL PERFIL -->
<section id="sectionGralPerfil">
   <div class="col-md-3 hidden-sm hidden-xs" id="contAvatar">
      <!-- Nombre del avatar del niño -->
      <center><h4 class="fontHijo" id="nameAvatar">¡Hola! Soy {{$nombreAvatar}}</h4></center>
      <!-- Imagen del avatar -->
      <center>
         <img src="/packages/images/avatars_curiosity/secuencias/Boy_0149.png" class="img-responsive" id="avatar">
         {{--<img src="/packages/images/avatars_curiosity/secuencias/{{$avatar->sprite}}" class="img-responsive" id="avatar">--}}
      </center>
      <!-- <center>
         <a href="/tienda" class="irAvatarStore">
            <i class="fa fa-shopping-bag"></i>&nbsp;
            Tienda Curiosity
         </a>
      </center> -->
   </div>
   <div class="col-md-9">
      <div class="row">
         <div class="col-sm-6">
            <div id="panel_informativo">
               <h4>¡Bienvenido a Curiosity!</h4>
               <center><img src="/packages/images/chicos.png" class="img-responsive"></center>
               {{--<!-- Mostramos las novedades -->
                  <!-- ///////////////////////// -->
               <div class="alert alert-info clearfix fixIndez" style="background-color:#e87eb1 !important;">
                  <!-- Icono -->
                  <span class="alert-icon" style="background-color:#fff;"><i class="fa fa-check"></i></span>
                  <div class="notification-info">
                     <ul class="clearfix notification-meta">
                        <li class="pull-left notification-sender">
                           <!-- titulo de la novedad -->
                           <span class="titleAlert">Título</span><br>
                           <!-- link -->
                           <a href="#" class="textAlert"> >> Clíck aquí para conocer más << </a>
                        </li>
                     </ul>
                  </div>
               </div>
               <!-- ///////////////////////// -->--}}
            </div>
         </div>
         <div class="col-sm-6">
            <div id="slider">
               <div class="row">
                  <section class="slider-container">
                     <ul id="slider" class="slider-wrapper-hijo color-top">
                        <li class="slide-current">
                           <center><div id="makeCanvas"></div></center>
                           <div class="caption">
                              <p><i class="fa fa-pie-chart"></i> &nbsp; Avances en tu meta diaria </p>
                           </div>
                        </li>
                     </ul>
                  </section>
               </div>
            </div>
         </div>
      </div>
      <br>
      <div class="row">
         <div class="col-sm-4 col-md-3">
            <div class="card animated zoomIn tarjetas cardInfo" style="display:block;">
               <div class="header-bg"></div>
               <div class="avatar">
                  <img src="/packages/icons/physics.png" class="img-effect">
               </div>
               <div class="myContent">
                  <center>
                     <p style="margin:0 0 5px;" class="titlePanelInfo">
                        Nivel de Experiencia <br>
                        {{$experiencia->cantidad_exp}} pts
                     </p>
                  </center>
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
         <div class="col-sm-4 col-md-3">
            <div class="card animated zoomIn tarjetas cardInfo" style="display:block;">
               <div class="header-bg"></div>
               <div class="avatar">
                  <img src="/packages/icons/medal.png" alt="" class="img-effect">
               </div>
               <div class="myContent">
                  <center><p style="margin:0 0 5px;" class="titlePanelInfo">Curiosity Coins <br> {{$coins}} cc</p></center>
                  <hr class="hrHijo score">
                  @if ($coins >= 500 and $coins < 1000)
                  <center><img src="/packages/icons/happiness.png" class="img-responsive" alt="" style="width:35px; height:35px;"></center>
                  @elseif ($coins >= 1000 and $coins < 1500)
                  <center><img src="/packages/icons/happy-1.png" class="img-responsive" alt="" style="width:35px; height:35px;"></center>
                  @elseif ($coins >= 1500)
                  <center><img src="/packages/icons/happy-2.png" class="img-responsive" alt="" style="width:35px; height:35px;"></center>
                  @else
                  <center><img src="/packages/icons/indifferent.png" class="img-responsive" alt="" style="width:35px; height:35px;"></center>
                  @endif
               </div>
            </div>
         </div>
         <div class="col-sm-4 col-md-3">
            <div class="card animated zoomIn tarjetas cardInfo getHigthCard" style="display:block;">
               <div class="header-bg">
                  <!-- <a href="" class="pull-right tooltipShow" title="Selecciona tu nivel ideal"
                     data-toggle="modal" data-target="#myModal">
                     <i class="fa fa-bars"></i>
                  </a> -->
               </div>
               <div class="avatar">
                  <!-- GRÁFICA DE META DIARIA -->
                  <img src="/packages/icons/molecule.png" alt="" class="img-effect">
               </div>
               <div class="myContent">
                  <center>
                     <p style="margin:0 0 5px;" class="titlePanelInfo">Meta diaria <br> {{$miMeta->nombre}}</p>
                  </center>
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
         <div class="col-sm-12 col-md-3">
            <div class="color-top" id="imgPerfilChanger">
               <img class="profile-user-img img-profile img-responsive img-circle" src='{{User::get_imagen_perfil(Auth::user()->id)}}' alt="User profile picture">
               <h5>{{Auth::user()->username}}</h5>
               <!-- <img style="cursor:pointer;" class="profile-user-img img-profile tooltipShow img-responsive img-circle"  data-toggle="modal" data-target="#modalPrueba" title="Cambiar foto de perfil" src='{{User::get_imagen_perfil(Auth::user()->id)}}' alt="User profile picture"> -->
               <!-- <center><h3 class="fontHijo description-block"><br>Elige tu imagen favorita</h3></center> -->
            </div>
         </div>
      </div>
   </div>
</section>
@stop

@section('mi_js')
   {{HTML::script('/packages/js/libs/validation/additional-methods.min.js')}}
   {{HTML::script('/packages/js/libs/chart/Chart.min.js')}}
   {{HTML::script('/packages/js/curiosity/getspav.js')}}
   {{HTML::script('/packages/js/curiosity/updateDataHijo.js')}}
   {{HTML::script('/packages/js/libs/mdb/tether.min.js')}}
   <script type="text/javascript">
      $(document).ready(function() {
         $curiosity.menu.setPaginaId("#menuPerfil");
         //$sprite.putSpriteSelected('esperar', $("#avatar"));
         var avanceMeta = {{$avanceMeta}};
         var faltanMeta = {{$faltanteMeta}};

         function makeMetaChart (avances, faltantes){
            var canvasCode = "<canvas id='grafica_meta' height='290' width='290' style='margin-left:-50px;'>";
            $("#makeCanvas").html('');
            $("#makeCanvas").append(canvasCode);
            var grafica = $("#makeCanvas").find('#grafica_meta');
            var myChart = new Chart(grafica, {
               type : 'doughnut',
               data : {
                  labels : ["Juegos Terminados", "Faltantes"],
                  datasets : [{
                     data : [avances, faltantes],
                     backgroundColor : ["#3cb54a", "rgba(255, 255, 255, 1)"],
                     hoverBackgroundColor : ["#2f943a", "rgba(195, 228, 199, 1)"],
                     borderColor : ["#3cb54a", "rgba(195, 228, 199, 1)"],
                     borderWidth : [1, 1]
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

         $("#btnselectprofile").click(function(event) {
            $("#inImageH").trigger('click');
         });

         $("#menuDatos").show();
      });
   </script>
@stop
