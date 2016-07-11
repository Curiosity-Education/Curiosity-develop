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

@section('titulo_contenido')
  Mi Perfil
@stop

@section('titulo_small')
@stop

@section('panel_opcion')
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="modal  fade" id="modalPrueba" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true" data-backdrop="static" data-keyboard="false">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header" id="modal-header-juego">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h1 class="title-modal">Cambiar y/o Recortar imagen</h1>
              </div>
              <div class="modal-body">
                <div class="row">
                @if(!Auth::user()->hasRole('padre-fb'))
                 <div class="col-md-10">
                 {{Form::open(['method'=>'POST' ,'files'=>'true','url'=>'/foto','id'=>'frm-change-image'])}}
                  {{HTML::Image('packages/images/perfil/original/'.$perfil->foto_perfil,'Imagen de usuario',array('class'=>'img-responsive cropper-show','id'=>'image'))}}
                  <input  name="image" class="btn btn-default" id="inImage"  type="file">
                  <input type="hidden" name="x"/>
                  <input type="hidden" name="y"/>
                  <input type="hidden" name="width"/>
                  <input type="hidden" name="height"/>
                 {{Form::close()}}
                 </div>
                 @endif
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
        <div class="row">
            <div class="col-md-3">

              <!-- Profile Image -->
              <div class="box box-primary">
                <div class="box-body box-profile">
                  <div class="image-portada">
                        @if(!Auth::user()->hasRole('padre-fb'))
                            <img style="cursor:pointer;" class="profile-user-img img-profile tooltipShow img-responsive img-circle"  data-toggle="modal" data-target="#modalPrueba" title="Cambiar foto de perfil" src='/packages/images/perfil/{{$perfil->foto_perfil}}' alt="User profile picture">
                        @else
                            <img style="cursor:pointer;" class="profile-user-img img-profile img-responsive img-circle" data-target="#modalPrueba"  src={{$perfil->foto_perfil}} alt="User profile picture">
                        @endif

                        <h3 class="profile-username text-center"><span id="name-complete">{{$persona->nombre." ".$persona->apellido_paterno." ".$persona->apellido_materno}}</span> <br><small>
                        <span id="username-profile">{{Auth::user()->username}}</span></small></h3>
                  </div>

                 <!--
                  /.Menu-Item-Profile

                  En esta sección se agregarán el
                  menú según el rol logueado
                 -->
                 @if(Auth::user()->hasRole('padre'))
                   <!-- <ul class="list-group list-group-unbordered" id="menu-item-profile">
                     <li class="list-group-item">
                       <b>Estatus</b>
                       <a class="pull-right">
                         <i class="fa fa-circle"></i>
                       </a>
                     </li>
                   </ul> -->
                   <!-- /.Fin de Menú-Item-Profile -->
                   <!-- <a href="#" class="btn btn-primary btn-block">
                   <b><i class="fa fa-credit-card-alt"></i> Información de Pago</b>
                   </a> -->
                 @endif
                </div><!-- /.box-body -->
              </div><!-- /.box -->

              @if(Auth::user()->hasRole('padre') || Auth::user()->hasRole('padre_free') || Auth::user()->hasRole('demo_padre') || Auth::user()->hasRole('padre-fb'))
              <!-- About Me Box -->
              <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Sobre mi</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                <strong><i class="fa fa-user margin-r-5"></i>  E-mail</strong>
                <p class="text-muted">
                  <h6><samll>{{Auth::user()->persona()->first()->padre()->first()->email}}</samll></h6>
                </p>
                <hr>
                 <!-- <strong><i class="fa fa-file-text-o margin-r-5"></i> Notes</strong>
                 <p>HEY!! {{Auth::user()->username}}, bienvenido al mundo <b>Curiosity</b> !!! </p> -->
                </div><!-- /.box-body -->
              </div><!-- /.box -->
              @endif
            </div><!-- /.col -->
            <div class="col-md-9">
              <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                  @if(Auth::user()->hasRole('padre') || Auth::user()->hasRole('padre_free') || Auth::user()->hasRole('demo_padre') || Auth::user()->hasRole('padre-fb'))

                   <li class="active">
                     <a href="#hijosPerfil" data-toggle="tab">
                       <i class="fa fa-group"></i>
                       Mis Hijos
                    </a>
                  </li>
                 @endif

                 @if(Auth::user()->hasRole('padre') || Auth::user()->hasRole('padre_free') || Auth::user()->hasRole('demo_padre') || Auth::user()->hasRole('padre-fb'))
                  <li id="data" data-id="{{Auth::user()->persona()->first()->padre()->pluck('id')}}">
                    <a href="#alerta" data-toggle="tab">
                      <i class="fa fa-warning"></i>
                      Alertas
                    </a>
                  </li>
                  @endif

                  @if(Auth::user()->hasRole('padre') || Auth::user()->hasRole('padre_free') || Auth::user()->hasRole('demo_padre') || Auth::user()->hasRole('padre-fb'))

                   <li id="data">
                     <a href="#graficas" data-toggle="tab">
                       <i class="fa fa-bar-chart"></i>
                       Puntajes
                     </a>
                   </li>
                   @endif
                  @if(Auth::user()->hasRole('hijo'))
                    <!-- <li class="active">
                      <a href="#bestPuntajes" data-toggle="tab">
                        <i class="fa fa-star"></i>
                        Mejores Puntajes
                      </a>
                    </li> -->
                  @endif

                 @if(Auth::user()->hasRole('padre') || Auth::user()->hasRole('padre_free') || Auth::user()->hasRole('demo_padre') || Auth::user()->hasRole('padre-fb'))
                   <li>
                    <a href="#reg-hijos" data-toggle="tab" id="tabRegHijos" data-dad='{{Auth::user()->roles[0]->name}}'>
                      <i class="fa fa-child"></i>
                      Registro de hijos
                    </a>
                  </li>
                 @endif
                 @if(Auth::user()->hasRole('root') || Auth::user()->hasRole('content manager'))
                  <li>
                    <a href="#reg-admins" data-toggle="tab">
                      <i class="fa fa-gears"></i>
                      Agregar administrativos
                    </a>
                  </li>
                 @endif
                 @if(!Auth::user()->hasRole('padre-fb'))
                  <li>
                    <a href="#settings" data-toggle="tab">
                      <i class="fa fa-user"></i>
                      Modificar mi Perfil
                    </a>
                  </li>
                </ul>
                @endif
                <div class="tab-content">
                  @if(Auth::user()->hasRole('hijo'))
                  <div class="active tab-pane" id="bestPuntajes">

                  </div>
                  @endif
                  @if(Auth::User()->hasRole('root') || Auth::User()->hasRole('content manager'))
                  <div class="tab-pane" id="reg-admins">
                    <form class="form-horizontal" id="frm-reg-admins">
                      <div id="wizard-admin">
                        <h4>Datos de Usuario</h4>
                        <section>
                          <div class="form-group">
                            <div class="input-group">
                              <span class="input-group-addon">
                                <span class="fa fa-user"></span>
                              </span>
                              <input type="text" name="username_admin" id="username_admin" class="form-control" placeholder="nombre de usuario">
                            </div>
                          </div>
                          <div class="form-group">
                            <div class="input-group">
                              <span class="input-group-addon">
                                <span class="fa fa-lock"></span>
                              </span>
                              <input type="password" name="password_admin" id="password_admin" class="form-control" placeholder="contraseña">
                            </div>
                          </div>
                          <div class="form-group">
                            <div class="input-group">
                              <span class="input-group-addon">
                                <span class="fa fa-lock"></span>
                              </span>
                              <input type="password" name="cpassword_admin" id="cpassword_admin" class="form-control" placeholder="Confirmar contraseña">
                            </div>
                          </div>
                          <div class="form-group">
                            <label for="rol_admin"><h5 class="title-input"><b>Rol de usuario</b></h5></label>
                            <div class="input-group">
                              <span class="input-group-addon">
                                <span class="fa fa-gear"></span>
                              </span>
                              <select name="role_admin" id="role_admin" class="form-control">
                                @foreach(Role::all() as $role)
                                  @if($role->name!='hijo' && $role->name!='padre' && $role->name!='padre_free' && $role->name!='hijo_free')
                                    @if($role->name=='root')
                                      @if(Auth::User()->hasRole('root'))
                                        <option value="{{$role->id}}">{{$role->name}}</option>
                                      @endif
                                    @else
                                    <option value="{{$role->id}}">{{$role->name}}</option>
                                    @endif
                                  @endif
                                @endforeach
                              </select>
                            </div>
                          </div>
                        </section>
                        <h4>Datos personales</h4>
                        <section>
                          <div class="form-group">
                            <div class="input-group">
                              <span class="input-group-addon">
                                <span class="fa fa-chevron-right"></span>
                              </span>
                              <input type="text" name="nombre_admin" id="nombre-admin" class="form-control" placeholder="Nombre(s)">
                            </div>
                          </div>
                          <div class="form-group">
                            <div class="input-group">
                              <span class="input-group-addon">
                                <span class="fa fa-chevron-right"></span>
                              </span>
                              <input type="text" name="apellido_paterno_admin" id="apellido_paterno_admin" class="form-control" placeholder="Apellido paterno">
                            </div>
                          </div>
                          <div class="form-group">
                            <div class="input-group">
                              <span class="input-group-addon">
                                <span class="fa fa-chevron-right"></span>
                              </span>
                              <input type="text" name="apellido_materno_admin" id="apellido_materno_admin" class="form-control" placeholder="Apellido materno">
                            </div>
                          </div>
                          <div class="form-group">
                            <label for="sexo_admin"><h5 class="title-input"><b>Sexo</b></h5></label>
                            <div class="input-group">
                              <span class="input-group-addon">
                                <span class="fa fa-chevron-right"></span>
                              </span>
                              <select name="sexo_admin" id="sexo_admin" class="form-control">
                                  <option value="m">Masculino</option>
                                  <option value="f">Femenino</option>
                              </select>
                            </div>
                          </div>
                          <div class="form-group">
                            <div class="input-group">
                              <span class="input-group-addon">
                                <span class="fa fa-chevron-right"></span>
                              </span>
                              <input type="text" name="fecha_nacimiento_admin"  id="fecha_nacimiento_admin" class="form-control datepicker" placeholder="fecha de nacimiento">
                            </div>
                          </div>
                        </section>
                      </div>
                    </form>
                  </div>
                  @endif
                  <div class="tab-pane" id="settings">
                    <form class="form-horizontal" id="frm_user">
                      <div id="wizardUser">
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
                        @if(!Auth::User()->hasRole('hijo') || !Auth::User()->hasRole('hijo_free') || !Auth::User()->hasRole('demo_hijo'))
                           <div class="form-group">
                             <label for="telefono"><h4 class="title-input"><b>Número Telefónico</b></h4></label>
                             <div class="input-group">
                               <span class="input-group-addon">
                                <span class="fa fa-phone"></span>
                               </span>
                               <input type="tel" class="form-control form-custom" value="{{Auth::user()->persona()->first()->telefono}}" name="telefono" id="telefono">
                             </div>
                           </div>
                        @endif
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
                            <label for="sexo"><h4 class="title-input"><b>Sexo</b></h4></label>
                            <div class="input-group">
                              <span class="input-group-addon">
                                <span class="fa fa-venus-mars"></span>
                              </span>
                              <select class="form-control form-custom" value="{{Auth::user()->persona()->first()->sexo}}" name="sexo_persona" id="sexo_persona">
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
                             <input type="text" value="{{Auth::user()->persona()->first()->fecha_nacimiento}}" class="datepicker form-control form-custom" name="fecha_nacimiento_persona" id="fecha_nacimiento_persona">
                           </div>
                         </div>
                        </section>
                        <!-- @if(Auth::User()->hasRole('padre') || Auth::User()->hasRole('padre_free') || Auth::User()->hasRole('demo_padre'))
                        <h2>Direccion</h2>
                        <section>
                         <div class="form-group">
                          <label for=""><h4 class="title-input"><b>Estado y ciudad</b></h4></label>
                          <div class="input-group">
                            <span class="input-group-addon">
                              <i class="fa fa-home"></i>
                            </span>
                             <select class="form-control  form-custom" id="estado" name="estado" data-placeholder="Estado">
                               <option value="">Estado</option>
                               @foreach($estados as $estado)
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
                             <select class="form-control  form-custom" id="ciudad_id" name="ciudad_id">
                               <option value="{{Auth::user()->persona()->first()->padre->first()->direccion()->first()->ciudad_id}}">{{Auth::user()->persona()->first()->padre()->first()->direccion()->first()->ciudad()->first()->nombre}}</option>
                               <option>Ciudad</option>
                             </select>
                           </div>
                         </div>
                         <div class="form-group">
                          <label for=""><h4 class="title-input"><b>Colonia y Calle</b></h4></label>
                          <div class="input-group">
                            <span class="input-group-addon">
                              <i class='fa fa-home'></i>
                            </span>
                            <input type="text" value="{{Auth::user()->persona()->first()->padre()->first()->direccion()->first()->colonia}}"  name="colonia" id="colonia" class="form-control form-custom" placeholder="Colonia"/>
                          </div>
                         </div>
                         <div class="form-group">
                          <div class="input-group">
                            <span class="input-group-addon">
                              <i class="fa fa-home"></i>
                            </span>
                            <input type="text" value="{{Auth::user()->persona()->first()->padre()->first()->direccion()->first()->calle}}" name="calle" id="calle" class="form-control form-custom" placeholder="Calle"/>
                          </div>
                         </div>
                         <div class="form-group">
                          <label for=""><h4 class="title-input"><b>Numero de casa y Código postal</b></h4></label>
                          <div class="input-group">
                            <span class="input-group-addon">
                              <i class="fa fa-home"></i>
                            </span>
                            <input type="text" value="{{Auth::user()->persona()->first()->padre()->first()->direccion()->first()->numero}}" class="form-control form-custom" name="numero" id="numero" placeholder="Numero de casa"/>
                          </div>
                         </div>
                         <div class="form-group">
                           <div class="input-group">
                            <span class="input-group-addon">
                              <i class='fa fa-home'></i>
                            </span>
                            <input type="number" name="codigo_postal" id="codigo_postal" value="{{Auth::user()->persona()->first()->padre()->first()->direccion()->first()->codigo_postal}}" id="codigo_postal" placeholder="Codigo Postal" class="form-control form-custom">
                           </div>
                         </div>
                        </section>
                        @endif -->
                      </div>
                    </form>
                  </div><!-- /.tab-pane -->

                     <div class="tab-pane"  id="reg-hijos">
                    <!-- Registro de hijos -->
                       <!-- <div class="row">
                          <div class="col-md-12 first-part">
                            <h3>¿Cuántos hijos deseas registrar?<h3>
                            <ul class="list-hijos">
                              <li class="active">
                                <div class="user-block">
                                   <h1 class="num num1">1</h1>
                                </div>
                              </li>
                               <li class="">
                                <div class="user-block">
                                  <h1 class="num num2">2</h1>
                                </div>
                              </li>
                               <li class="">
                                <div class="user-block">
                                   <h1 class="num num3">3</h1>
                                </div>
                              </li>
                               <li class="">
                                <div class="user-block">
                                   <h1 class="num num4">4</h1>
                                </div>
                              </li>
                               <li class="e">
                                <div class="user-block">
                                   <h1 class="num num5">5</h1>
                                </div>
                              </li>
                               <li class="">
                                <div class="user-block">
                                   <h1 class="num num6">6</h1>
                                </div>
                              </li>
                            </ul>
                          </div>
                        </div>
                        <div class="row" style="padding-right:10%;">
                          <button class="btn btn-info btn-lg pull-right btn-next">Siguiente</button>
                        </div>-->
                        <div class="row" style="padding-right:1%; padding-left:1%">
                          <form class="form-horizontal" id="frm-reg-hijos">
                            <div id="wizard">
                              <h2>Datos generales</h2>
                              <section>
                                <div class="form-group">
                                  <div class="input-group">
                                    <span class="input-group-addon">
                                      <spna  class="fa fa-user"></spna>
                                    </span>
                                    <input type="text"  name="nombre" id="nombre" value="" class="form-control form-custom" placeholder="Nombre del niño/a">
                                  </div>
                                </div>
                                <div class="form-group">
                                  <div class="input-group">
                                    <span class="input-group-addon">
                                      <spna class="fa fa-chevron-right"></spna>
                                    </span>
                                    <input type="text" name="apellido_paterno" id="apellido_paterno" value="" class="form-control form-custom" placeholder="Apellido paterno">
                                  </div>
                                </div>

                                <div class="form-group">
                                  <div class="input-group">
                                    <span class="input-group-addon">
                                      <spna class="fa fa-chevron-right"></spna>
                                    </span>
                                    <input type="text" name="apellido_materno" id="apellido_materno" value="" class="form-control form-custom" placeholder="Apellido materno">
                                  </div>
                                </div>

                                <div class="form-group">
                                  <div class="input-group">
                                    <span class="input-group-addon">
                                      <spna class="fa fa-calendar"></spna>
                                    </span>
                                    <input type="text" name="fecha_nacimiento" id="fecha_nacimiento" value="" class="form-control datepicker_hijo" placeholder="Fecha de nacimiento">
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
                           </section>
                           <h2>Datos escolares</h2>
                           <section>
                              <div class="form-group">
                                <label for="sexo"><h4 class="title-input"><b>Nombre de la Escuela</b></h4></label>
                                <div class="input-group">
                                  <span  class="input-group-addon tooltipShow">
                                    <spna id="return-fa-normal" class="fa fa-chevron-right"></spna>
                                    <span title="ver escuelas" style="color:blue; font-weight:bold"  id="return-select-school" class="fa fa-remove hidden"></span>
                                  </span>
                                  <select name="escuela_id" id="escuela_id"  class="form-control">
                                    {{--@foreach($escuelas  as $escuela)
                                      <option value="{{$escuela->id}}">{{$escuela->nombre}}</option>
                                    @endforeach--}}
                                    <option value="NULL">Otra</option>
                                  </select>
                                  <input type="text" nombre="esc_alt" id="esc_alt" placeholder="nombre de la escuela" value="" class="form-control hidden"/>
                                </div>
                             </div>
                             <div class="form-group">
                                <label for="sexo"><h4 class="title-input"><b>Promedio escolar</b></h4></label>
                                <div class="input-group">
                                  <span class="input-group-addon">
                                    <spna class="fa fa-chevron-right"></spna>
                                  </span>
                                  <input type="text" name="promedio" id="promedio" value="" class="form-control" placeholder="Promedio de su hijo">
                                </div>
                             </div>
                           </section>
                           <h2>Datos de usuario</h2>
                           <section>
                              <div class="form-group">
                                <div class="input-group">
                                  <span class="input-group-addon">
                                    <spna  class="fa fa-user"></spna>
                                  </span>
                                  <input type="text"  name="username_hijo" id="username_hijo" value="" class="form-control form-custom" placeholder="Nombre de Usuario para el niño/a">
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
                                  <input type="password" name="cpassword" id="cpassword" value="" class="form-control form-custom" placeholder="Confirmar Contraseña">
                                </div>
                              </div>
                           </section>
                          </form>
                        </div>
                    </div><!-- /. fin tab registro de hijos -->

                </div><!-- /.tab-content -->


                @if(Auth::user()->hasRole('padre') || Auth::user()->hasRole('root') || Auth::user()->hasRole('padre_free') || Auth::user()->hasRole('demo_padre') || Auth::user()->hasRole('padre-fb'))
                  <section class="active tab-pane" id="hijosPerfil">
                    <div class="container-fluid">
                      <div class="row">
                        <br>
                            {{--@foreach($datosHijos as $hijo)
                              <div class="col-xs-4 col-md-3">
                                <img src="/packages/images/perfil/{{$hijo->foto_perfil}}"
                                class="img-responsive img-circle tooltipShow"
                                title="{{$hijo->nombre}} {{$hijo->apellido_paterno}}  {{$hijo->apellido_materno}}">
                                <center><h4>{{$hijo->username}}</h4></center>
                                <br>
                              </div>
                            @endforeach--}}

                        <br><br>
                      </div>
                    </div>
                  </section>
                @endif

              @if(Auth::user()->hasRole('padre') || Auth::user()->hasRole('root') || Auth::user()->hasRole('padre_free') || Auth::user()->hasRole('demo_padre') || Auth::user()->hasRole('padre-fb'))

              <section class="tab-pane" id="alerta">
                <div class="container-fluid">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="helperTextAlerta text-justify">
                        <br>
                        <h4><b>Bienvenido a la zona de Alertas.</b></h4>
                        En esta zona se mostrarán todos tus hijos que se encuentren con un puntaje por debajo del promedio dependiendo de las actividades que haya realizado.<br><br>
                        <b>Nota: </b> Las estadisticas presentadas son en base a las estadisticas generadas por la misma plataforma Curiosity y sus usuarios.<br><br>
                        Curiosity te brinda a ti como padre, un archivo y un video que te servirán como ayuda para que, si así lo deseas puedas guiar a tu hijo en el tema que esta presentando dificultades especificamente.
                      </div>
                      <div class="alertaBox">
                      </div>
                    </div>
                  </div>
                </div>
              </section>
              @endif

              @if(Auth::user()->hasRole('padre') || Auth::user()->hasRole('root') || Auth::user()->hasRole('padre_free') || Auth::user()->hasRole('demo_padre') || Auth::user()->hasRole('padre-fb'))

              <section class="tab-pane" id="graficas">
                <div class="container-fluid">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="helperTextAlerta text-justify">
                        <br>
                        <h4><b>Bienvenido a la zona de Puntajes.</b></h4>
                        En esta sección usted como padre, podra observar un par de gráficas en las cuales se despliega el puntaje máximo y mínimo obtenido de cada uno de sus hijos durante todo el tiempo de uso de la plataforma.
                        <br><br>
                      </div>
                      <div class="grafContent">
                        <center>
                          <div class="grafMax"></div>
                          <div class="grafMin"></div>
                        </center
                      </div>
                    </div>
                  </div>
                </div>
              </section>
              @endif
              </div><!-- /.nav-tabs-custom -->
            </div><!-- /.col -->
          </div><!-- /.row -->

          <div class="modal fade" id="modalVideo" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true" data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                  <h4 class="modal-title" id="">Video de Estudio</h4>
                </div>
                <div class="modal-body">
                  <iframe width="100%" height="350" id="videoAyuda" frameborder="0" allowfullscreen></iframe>
                </div>
                <div class="modal-footer">
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
{{HTML::script('/packages/js/libs/highcharts/highcharts.js')}}
{{HTML::script('/packages/js/curiosity/alert.js')}}
{{HTML::script('/packages/js/libs/cropper/cropper.min.js')}}
{{HTML::script('/packages/js/curiosity/perfil.js')}}
@if(Auth::user()->hasRole('padre') || Auth::user()->hasRole('padre_free') || Auth::user()->hasRole('demo_padre'))
  {{HTML::script("/packages/js/curiosity/perfilEstadisticas.js")}}
@endif
@if(Auth::user()->hasRole('padre_free'))
  {{HTML::script("/packages/js/curiosity/freeValidationDad.js")}}
@endif

<script>
  $(function ()
  {
    $("#wizardUser").steps({
        headerTag: "h2",
        bodyTag: "section",
        transitionEffect: "slideLeft",
        autoFocus:true,
        onFinishing: function (event, currentIndex) {
            if($("#frm-reg-hijos").valid()){
                return true;
            }else{
                return false;
            }
        },
        labels: {
          cancel: "Cancelar",
          //  current: "current step:",
          pagination: "Paginación",
          finish: "Actualizar",
          next: "Siguiente",
          previous: "Anterior",
          loading: "Actualizando ..."
        },
        onStepChanging: function (event, currentIndex, newIndex){
          if(newIndex>currentIndex){
           if($(".current input").valid()){
               return true;
           }else return false;
         }else return true;
        },

  });
  @if(!Auth::User()->hasRole('hijo'))
   var dateNow = new Date();
    dateNow.setMonth(dateNow.getMonth()-216);//restar 19 años a la fecha actual
    $('.datepicker').datepicker({
        "language":"es",
        "format" : "yyyy-mm-dd",
        "endDate":dateNow.getFullYear()+"/"+dateNow.getMonth()+"/"+dateNow.getDate(),
       "autoclose": true,
       "todayHighlight" : true
      });
    @else
    var dateNow = new Date();
    dateNow.setMonth(dateNow.getMonth()-48);//restar 19 años a la fecha actual
    $('.datepicker').datepicker({
        "language":"es",
        "format" : "yyyy-mm-dd",
        "endDate":dateNow.getFullYear()+"/"+dateNow.getMonth()+"/"+dateNow.getDate(),
       "autoclose": true,
       "todayHighlight" : true
      });
  @endif
   var dateNow = new Date();
    dateNow.setMonth(dateNow.getMonth()-48);//restar 19 años a la fecha actual
    $('.datepicker_hijo').datepicker({
        "language":"es",
        "format" : "yyyy-mm-dd",
        "endDate":dateNow.getFullYear()+"/"+dateNow.getMonth()+"/"+dateNow.getDate(),
       "autoclose": true,
       "todayHighlight" : true
      });
  $("#telefono").mask('(000) 000-0000',{placeholder:"(999) 999-9999"});
    $("#codigo_postal").mask("00000");
    $("#numero").mask("ABCDE",{translation:{
                                                    A:{pattern:/^[0-9]/},
                                                    B:{pattern:/([0-9])?/},
                                                    C:{pattern:/([0-9])?/},
                                                    D:{pattern:/([0-9])?/},
                                                    E:{pattern:/([A-Za-z]{1})?$/}
    }});
    $("#frm_user").validate({
        rules:{
            telefono:{required:true,telephone:true,maxlength:14,minlength:14},
            username_persona:{maxlength:50,required:true,remote:{
                url:"/remote-username-update",
                type:"post",
                username:function(){
                    return $("input[name='username']").val();
                }
            }},
            password_new:{maxlength:100,minlength:8},
            cpassword_new:{equalTo:function(){
                return $("input[name='password_new']");
            }},
            nombre_persona:{required:true,maxlength:50,alpha:true},
            apellido_paterno_persona:{required:true,maxlength:30,alpha:true},
            apellido_materno_persona:{required:true,maxlength:30,alpha:true},
            sexo_persona:{required:true,maxlength:1},
            fecha_nacimiento_persona:{required:true,date:true},
            @if(Auth::User()->hasRole('padre'))
            colonia:{maxlength:50},
            calle:{maxlength:50},
            numero:{maxlength:5,numero_casa:true},
            codigo_postal:{number:true,minlength:5,maxlength:5}
            @endif

        },
        messages:{
            cpassword_new:{equalTo:"La contraseña no coincide"},
            username_persona:{
                        required:"No puedes dejaar en blanco este campo",
                        remote:"Este nombre de usuario se encuentra en uso"
            },
            telefono:{required:"No puedes dejar en blanco este campo"},
            password_now:{remote:"La contraseña es incorrecta"}

        },
         errorPlacement: function (error, element) {
            error.appendTo(element.parent().parent());
         }
    });
   $("#frm_user").on("click","a[href='#finish']",function(){
        if($("#frm_user input").valid()){
            $btn =$(this)
            var text_temp = $(this).text();
            $(this).addClass("striped-alert");
            $(this).text("Actualizando...");
            $(this).prop("disabled",true);
            if($("input[name='password_new']").val()!==""){
                var datos={
                    username_persona:$("input[name='username_persona']").val(),
                    password_persona:$("input[name='password_persona']").val(),
                    password_new:$("input[name='password_new']").val(),
                    cpassword_new:$("input[name='cpassword_new']").val(),
                    @if(!Auth::User()->hasRole('hijo'))
                    telefono:$("input[name='telefono']").val(),
                    @endif
                    @if(Auth::User()->hasRole('padre'))
                    ciudad_id:$("select[name='ciudad_id']").val(),
                    colonia:$("input[name='colonia']").val(),
                    calle:$("input[name='calle']").val(),
                    numero:$("input[name='numero']").val(),
                    codigo_postal:$("input[name='codigo_postal']").val(),
                    @endif
                    nombre_persona:$("input[name='nombre_persona']").val(),
                    apellido_paterno_persona:$("input[name='apellido_paterno_persona']").val(),
                    apellido_materno_persona:$("input[name='apellido_materno_persona']").val(),
                    sexo_persona:$("select[name='sexo_persona']").val(),
                    fecha_nacimiento_persona:$("input[name='fecha_nacimiento_persona']").val()

                }
                $.ajax({
                    url:"/updatePerfil",
                    type:"post",
                    data:{data:datos},
                    beforeSend: function(){
                    message = "Espera.. Los datos se estan Actualizando... Verificando información";
                    after = noty({
                                layout: 'bottomRight',
                                theme: 'defaultTheme', // or 'relax'
                                type: 'information',
                                text: message,
                                animation: {
                                    open: {height: 'toggle'}, // jQuery animate function property object
                                    close: {height: 'toggle'}, // jQuery animate function property object
                                    easing: 'swing', // easing
                                    speed: 300 // opening & closing animation speed
                                }
                            });
                    }
                })
                .done(function(r){
                    console.log(r);
                    if($.isPlainObject(r)){
                        alerta.errorOnInputs(r);
                        $curiosity.noty("Algunos campos no fueron obtenidos... Favor de verificar la información  e intentar nuevamente ","warning");
                    }else if(r == "contraseña incorrecta"){
                        //alerta.show("Contraseña incorreca","","warning-alert striped");
                        $curiosity.noty("Contraseña incorreca","warning");
                    }
                    else if(r =="bien"){
                        $("input[name='password_persona']").val('');
                        $("input[name='password_new']").val('');
                        $("input[name='cpassword_new']").val('');
                        $curiosity.noty("Los datos se han actualizado correctamente, su contraseña ha sido cambiada con exito!!","success");
                        $("span#name-complete").text(datos.nombre_persona+" "+datos.apellido_paterno_persona+" "+datos.apellido_materno_persona);
                        $("span#username-profile").text(datos.username_persona);
                        $("label.error").remove();
                        $("#wizard1-t-0").trigger("click");
                    }
                }).always(function(){
                    $btn.text(text_temp);
                    $btn.removeClass("striped-alert");
                    $btn.prop("disabled",false);
                    after.close();
                });
            }else{
                var datos = {
                     username_persona:$("input[name='username_persona']").val(),
                     @if(!Auth::User()->hasRole('hijo'))
                     telefono:$("input[name='telefono']").val(),
                     @endif
                     @if(Auth::User()->hasRole('padre'))
                     ciudad_id:$("select[name='ciudad_id']").val(),
                     colonia:$("input[name='colonia']").val(),
                     calle:$("input[name='calle']").val(),
                     numero:$("input[name='numero']").val(),
                     codigo_postal:$("input[name='codigo_postal']").val(),
                     @endif
                     nombre_persona:$("input[name='nombre_persona']").val(),
                     apellido_paterno_persona:$("input[name='apellido_paterno_persona']").val(),
                     apellido_materno_persona:$("input[name='apellido_materno_persona']").val(),
                     sexo_persona:$("select[name='sexo_persona']").val(),
                     fecha_nacimiento_persona:$("input[name='fecha_nacimiento_persona']").val()
                }
                $.ajax({
                    url:"/updatePerfilUser",
                    type:"post",
                    data:{data:datos},
                    beforeSend: function(){
                    message = "Espera.. Los datos se estan Actualizando... Verificando información";
                    after = noty({
                                layout: 'bottomRight',
                                theme: 'defaultTheme', // or 'relax'
                                type: 'information',
                                text: message,
                                animation: {
                                    open: {height: 'toggle'}, // jQuery animate function property object
                                    close: {height: 'toggle'}, // jQuery animate function property object
                                    easing: 'swing', // easing
                                    speed: 300 // opening & closing animation speed
                                }
                            });
                    }
                }).done(function(r){
                    console.log(r);
                    if($.isPlainObject(r)){
                        alerta.errorOnInputs(r);
                        $curiosity.noty("Algunos campos no fueron obtenidos... Favor de verificar la información  e intentar nuevamente ","warning");
                    }else if(r == "bien"){
                        $curiosity.noty("Los datos se han actualizado correctamente","success");
                        $("label.error").remove();
                        $("span#name-complete").text(datos.nombre_persona+" "+datos.apellido_paterno_persona+" "+datos.apellido_materno_persona);
                        $("span#username-profile").text(datos.username_persona);
                        $("#wizard1-t-0").trigger("click");
                    }
                }).always(function(r){
                    $btn.text(text_temp);
                    $btn.removeClass("striped-alert");
                    $btn.prop("disabled",false);
                    after.close();
                });
            }
        }else {

        }
       /* $.ajax({
            url:"/updatePerfil",
            type:"post",
            data:{
                data:datos
            }
        }).done(function(r){
            console.log(r);
        });*/
    });
    $('#image').cropper({
    aspectRatio: 1/1,
    responsive: true,
    autoCropArea:1,
    preview:".preview",
    dragMode:'move',
    crop: function(e) {
      // Output the result data for cropping image.
      $("input[name='x']").val(e.x);
      $("input[name='y']").val(e.y);
      $("input[name='width']").val(e.width);
      $("input[name='height']").val(e.height);

    }
    });
    $("img[data-target='#modalPrueba']").click(function(){


    });
     $(".btnRecortar").click(function(){
         var formData = new FormData(document.getElementById('frm-change-image'));
          $.ajax({
            url:$("#frm-change-image").attr("action"),
            type:$("#frm-change-image").attr("method"),
            data:formData,
            cache:false,
            contentType:false,
            processData:false,
            beforeSend: function(){
                message = "Espera.. La imagen se esta recortando...";
                after = noty({
                            layout: 'topRight',
                            theme: 'defaultTheme', // or 'relax'
                            type: 'information',
                            text: message,
                            animation: {
                                open: {height: 'toggle'}, // jQuery animate function property object
                                close: {height: 'toggle'}, // jQuery animate function property object
                                easing: 'swing', // easing
                                speed: 300 // opening & closing animation speed
                            }
                        });
                }

         }).done(function(r){
            console.log(r);
            $(".img-profile").attr("src",r);
            $curiosity.noty("La imagen fue guardada y/o recortada exitosamente","success");
            $("button[data-dismiss='modal']").trigger("click");
         }).fail(function(){

         }).always(function(){
          after.close();
       });
     });
        var $inputImage = $('#inImage');
        var URL = window.URL || window.webkitURL;
        var blobURL;
        var $image = $('#image');

            $inputImage.change(function () {
              var files = this.files;
              var file;

              if (!$image.data('cropper')) {
                return;
              }

              if (files && files.length) {
                file = files[0];
                if (/^image\/\w+$/.test(file.type)) {
                    blobURL = URL.createObjectURL(file);
                    $image.one('built.cropper', function () {


                    URL.revokeObjectURL(blobURL);
                  }).cropper('reset').cropper('replace', blobURL);

                } else {
                  window.alert('Please choose an image file.');
                }
              }
      });
});
</script>
@stop
