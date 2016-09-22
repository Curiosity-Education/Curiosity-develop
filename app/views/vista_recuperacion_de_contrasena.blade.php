@extends('principalMaster')

@section('css')
  {{HTML::style('/packages/css/curiosity/loginStyle.css')}}
  {{HTML::style('/packages/css/libs/notificacion_toast/jquery.toast.css')}}
  <style>
      #header-frm{
          color: #f2f2f2;
          display: block;
          background: rgba(12, 90, 157, 0.98);
          margin-top: -50.5px;
          margin-bottom: 10px;
          margin-left: -28px;
          width: 33.8em;
          padding: 2em;
          border-top-left-radius: 10px;
          border-top-right-radius: 10px;
      }
      .header-row-first > h3,span{
          display:inline;
      }
      #input-user{
        margin-top: 2em;
        margin-bottom: 2em;
      }

  </style>
@stop

@section('title')
  Curiosity | login
@stop

@section('menu')
<li class='nav-item anc'>
  <a class='nav-link' href='/'>{{Lang::get('landingPage.menu.home')}} <span class='sr-only'>(current)</span></a>
</li>
<li class='nav-item'>
  &nbsp;&nbsp;&nbsp;&nbsp;
  <a class='btn danger-rounded-outline waves-effect pull-right' style='color:#fff; margin-left:-15px;' href='/suscripcion'>{{Lang::get('landingPage.menu.createAccount')}}</a>
</li>
@stop


@section('contenido')
  <audio src='/packages/notificaciones/music.mp3' id='notyAudio'></audio>
  <section id='background'>
    <section>
      <section class='container' style='padding-top:80px;'>
        <div class='row'>
          <div class='col-md-6 col-md-offset-3'>
           <br><br>
            <div class='login-box'>
              <div class='login-txt'>
              <div id="header-frm">
                <div class="header-row-first">
                    <h3 class="pull-left">Recuperar Contraseña</h3>
                    <span class="fa fa-lock fa-2x pull-right"></span><br>
                </div>
                <small class="pull-left">Ingresa el correo con el que fue tu registro.</small><br>
              </div>
                <form action='' method='post'>
                  <div class='form-group' id='input-user'>
                    <div class='input-group'>
                      <span for='username' class='input-group-addon' id='login-icon-user'>
                        <span class='fa fa-envelope'></span>
                      </span>
                      <input type='text' class='form-control inputLogin'  style='-webkit-user-select: text;' placeholder='Email de su registro' name='username' id='username'/>
                    </div>
                  </div>

                </form>
              </div>

              <button type='button' name='send_mail_rc' class='btn btn-warning btn-block' id='send_mail_rc'>
                <span class='fa fa-key'></span> &nbsp;
                Solicitar Cambio
              </button>

              </div>
            </div>
            <center><span class="fa fa-life-ring spanIcon"></span></center>
            <p class="frasePie">
              Porque a la cima no se llega superando a los demás, sino  superándose a sí mismo.
            </p>
          </div>
        </div>
      </section>
    </section>
  </section>
@stop

@section('js')
  {{HTML::script('/packages/js/curiosity/desktop-notify.js')}}
  {{HTML::script('/packages/js/libs/notificacion_toast/jquery.toast.js')}}
  {{HTML::script('/packages/js/curiosity/curiosity.js')}}
  {{HTML::script('/packages/js/curiosity/recuperarPass.js')}}
  <script>
      var wid = $(".login-box").width();
      $("#header-frm").width(wid-8);

      $(window).resize(function(){
          var wid = $(".login-box").width();
          console.log(wid);
          $("#header-frm").width((wid-6));
      });
  </script>
@stop
